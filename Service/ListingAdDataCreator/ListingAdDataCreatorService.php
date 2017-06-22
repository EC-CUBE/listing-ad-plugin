<?php
/*
* This file is part of EC-CUBE
*
* Copyright(c) 2000-2016 LOCKON CO.,LTD. All Rights Reserved.
* http://www.lockon.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\ListingAdCsv\Service\ListingAdDataCreator;

use Eccube\Application;
use Eccube\Entity\Product;
use Eccube\Util\FormUtil;
use Plugin\ListingAdCsv\Service\ListingAdDataCreator\Campaign\ProductNameCampaign;
use Plugin\ListingAdCsv\Service\ListingAdDataCreator\Rows\Google\GoogleRowCreator;
use Plugin\ListingAdCsv\Service\ListingAdDataCreator\Rows\RowCreatorInterface;
use Plugin\ListingAdCsv\Service\ListingAdDataCreator\Rows\Yahoo\YahooRowCreator;
use Symfony\Component\HttpFoundation\Request;

class ListingAdDataCreatorService
{
    /**
     * リスティング広告データを生成する
     * @param Application $app
     * @param Request $request
     * @param string $type
     */
    public function create(Application $app, Request $request, $type)
    {
        // 商品データ検索用のクエリビルダを取得
        $this->disableSQLLogger($app);
        $query = $this->getFilteredProductsQuery($app, $request);
        $products = $query->getResult();

        // 出力
        $creator = $this->getCreator($type);
        $this->exportHeaderData($app, $creator);
        $this->exportProductNameCampaign($app, $creator, $products);

        // メモリの解放
        foreach ($products as $product) {
            $app['orm.em']->detach($product);
            $app['orm.em']->clear();
            $query->free();
            flush();
        }
    }

    /**
     * @param string $type
     * @return RowCreatorInterface
     */
    private function getCreator($type)
    {
        switch ($type) {
            case 'google':
                return new GoogleRowCreator();
            case 'yahoo':
                return new YahooRowCreator();
            default:
                return new GoogleRowCreator();
        }
    }

    /**
     * sql loggerを無効にする
     * @param Application $app
     */
    private function disableSQLLogger(Application $app)
    {
        $em = $app['orm.em'];
        $em->getConfiguration()->setSQLLogger(null);
    }

    /**
     * 商品データ検索用のクエリビルダを取得
     *
     * クエリの結果を商品マスターの検索結果と一致させたいので、
     * ProductControllerクラスのexport関数と処理を合わせている。
     * @param Application $app
     * @param Request $request
     * @return \Doctrine\ORM\Query
     */
    private function getFilteredProductsQuery(Application $app, Request $request)
    {
        $qb = $this->getProductQueryBuilder($app, $request);

        $qb->resetDQLPart('select')
            ->resetDQLPart('orderBy')
            ->select('p')
            ->orderBy('p.update_date', 'DESC')
            ->distinct();

        return $qb->getQuery();
    }

    /**
     * 商品検索用のクエリビルダを返す.
     *
     * @param Application $app
     * @param Request $request
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getProductQueryBuilder(Application $app, Request $request)
    {
        $session = $request->getSession();
        $viewData = $session->get('eccube.admin.product.search', array());
        $searchForm = $app['form.factory']->create('admin_search_product');
        $searchData = FormUtil::submitAndGetData($searchForm, $viewData);
        if (isset($viewData['link_status']) && strlen($viewData['link_status'])) {
            $searchData['link_status'] = $app['eccube.repository.master.disp']->find($viewData['link_status']);
        }
        if (isset($viewData['stock_status'])) {
            $searchData['stock_status'] = $viewData['stock_status'];
        }

        // 商品データのクエリビルダを構築
        $qb = $app['eccube.repository.product']->getQueryBuilderBySearchDataForAdmin($searchData);

        return $qb;
    }

    /**
     * ヘッダーを生成して出力
     * @param Application $app
     * @param RowCreatorInterface $creator
     */
    private function exportHeaderData(Application $app, RowCreatorInterface $creator)
    {
        $header = $creator->GetHeaderRow();
        $app['listing_ad_csv.service.csv.export']->exportData($header);
    }

    /**
     * 商品キャンペーンを生成して出力
     * @param Application $app
     * @param RowCreatorInterface $creator
     * @param Product[] $products
     */
    private function exportProductNameCampaign(Application $app, RowCreatorInterface $creator, $products)
    {
        $rows = $creator->GetRows(new ProductNameCampaign($app, $products));
        foreach ($rows as $row) {
            $app['listing_ad_csv.service.csv.export']->exportData($row);
        }
    }
}