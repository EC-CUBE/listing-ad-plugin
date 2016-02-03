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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Eccube\Application;
use Eccube\Entity\Product;
use Eccube\Repository\ProductRepository;
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
        $em = $app['orm.em'];
        $qb = $this->getProductQueryBuilder($app, $request, $em);
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
     * @param EntityManager $em
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getProductQueryBuilder(Application $app, Request $request, $em)
    {
        $session = $request->getSession();
        if ($session->has('eccube.admin.product.search')) {
            $searchData = $session->get('eccube.admin.product.search');
            $this->findDeserializeObjects($searchData, $em);
        } else {
            $searchData = array();
        }
        // 商品データのクエリビルダを構築
        $qb = $app['eccube.repository.product']->getQueryBuilderBySearchDataForAdmin($searchData);
        return $qb;
    }

    /**
     * セッションでシリアライズされた Doctrine のオブジェクトを取得し直す.
     *
     * ※特定の検索条件で受注CSVダウンロードをするとシステムエラー #1384 の不具合対応のため、
     * 　本体の修正コードを移植する。
     *
     * XXX self::setExportQueryBuilder() をコールする前に EntityManager を取得したいので、引数で渡している
     *
     * @param array $searchData セッションから取得した検索条件の配列
     * @param EntityManager $em
     */
    protected function findDeserializeObjects(array &$searchData, $em)
    {
        foreach ($searchData as &$Conditions) {
            if ($Conditions instanceof ArrayCollection) {
                $Conditions = new ArrayCollection(
                    array_map(
                        function ($Entity) use ($em) {
                            return $em->getRepository(get_class($Entity))->find($Entity->getId());
                        }, $Conditions->toArray()
                    )
                );
            } elseif ($Conditions instanceof \Eccube\Entity\AbstractEntity) {
                $Conditions = $em->getRepository(get_class($Conditions))->find($Conditions->getId());
            }
        }
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