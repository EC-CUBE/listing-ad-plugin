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

namespace Plugin\ListingAdCsv\Service\ListingAdDataCreator\Campaign;


use Eccube\Application;
use Eccube\Entity\Product;
use Plugin\ListingAdCsv\Service\ListingAdDataCreator\AdData\AdContents;
use Plugin\ListingAdCsv\Service\ListingAdDataCreator\AdData\AdGroup;
use Plugin\ListingAdCsv\Util\CsvContentsUtil;
use Symfony\Component\Yaml\Yaml;

class ProductNameCampaign implements CampaignInterface
{
    /**
     * @var AdGroup[]
     */
    private $ad_groups = array();

    /**
     * クリック単価
     * @var string
     */
    private $max_cpc = '0';

    /**
     * キャンペーン予算(日額)
     * @var string
     */
    private $daily_budget = '0';

    /**
     * キャンペーンの配信状態
     * @var bool
     */
    private $campaign_status = false;

    /**
     * キーワードのマッチタイプ
     * @var int
     */
    private $match_type = 2;

    /**
     * StoreCategoryCampaign constructor.
     * @param Application $app
     * @param Product[] $products
     */
    public function __construct(Application $app, $products)
    {
        // YAMLからパラメータ読み込み
        $this->LoadParameter();

        foreach ($products as $product) {
            // 商品情報から広告を動的に生成
            $ad_contents = new AdContents($app, $product);

            // 商品名
            $this->createAdGroup($product, $ad_contents);
            // 商品名×カテゴリ
            $this->createAdGroupWithCategory($product, $ad_contents);
            // 商品名×検索ワード
            $this->createAdGroupWithSearchWord($product, $ad_contents);
        }
    }

    /**
     * @return string
     */
    public function getCampaignName()
    {
        return '商品名';
    }

    /**
     * @return array
     */
    public function getAdGroups()
    {
        return $this->ad_groups;
    }

    /**
     * @param Product $product
     * @param AdContents $ad_contents
     * @return AdGroup
     */
    private function createAdGroup(Product $product, AdContents $ad_contents)
    {
        $group_name = CsvContentsUtil::clipText($product->getName(), 50);
        $group = new AdGroup($group_name, $ad_contents);
        $group->addKeyword($product->getName());

        array_push($this->ad_groups, $group);
    }

    /**
     * @param Product $product
     * @param AdContents $ad_contents
     */
    private function createAdGroupWithCategory(Product $product, AdContents $ad_contents)
    {
        $group_name = CsvContentsUtil::clipText($product->getName() . '×' . 'カテゴリ', 50);
        $group = new AdGroup($group_name, $ad_contents);

        $categories = $product->getProductCategories();
        foreach ($categories as $category) {
            $category_name = $category->getCategory()->getName();
            $group->addKeyword($product->getName() . ' ' . $category_name);
        }

        if (0 < count($group->getKeywords())) {
            array_push($this->ad_groups, $group);
        }
    }

    /**
     * @param Product $product
     * @param AdContents $ad_contents
     */
    private function createAdGroupWithSearchWord(Product $product, AdContents $ad_contents)
    {
        $group_name = CsvContentsUtil::clipText($product->getName() . '×' . '検索ワード', 50);
        $group = new AdGroup($group_name, $ad_contents);

        $search_word = $product->getSearchWord();
        $keywords = preg_split('/[\s　、,]+/u', $search_word, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($keywords as $word) {
            $group->addKeyword($product->getName() . ' ' . $word);
        }

        if (0 < count($group->getKeywords())) {
            array_push($this->ad_groups, $group);
        }
    }

    /**
     * @return string
     */
    public function getMaxCpc()
    {
        return $this->max_cpc;
    }

    /**
     * @return string
     */
    public function getDailyBudget()
    {
        return $this->daily_budget;
    }

    /**
     * YAMLファイルからパラメータを読み込む
     */
    private function LoadParameter()
    {
        $ymlPath = __DIR__ . '/../config';
        $config = array();
        $config_yml = $ymlPath . '/config.yml';
        if (file_exists($config_yml)) {
            $config = Yaml::parse(file_get_contents($config_yml));
        }

        $this->max_cpc = $config['MaxCpc'];
        $this->daily_budget = $config['DailyBudget'];
        $this->campaign_status = $config['CampaignStatus'];
        $this->match_type = $config['MatchType'];
    }

    /**
     * @return boolean
     */
    public function isCampaignStatus()
    {
        return $this->campaign_status;
    }

    /**
     * @return int
     */
    public function getMatchType()
    {
        return $this->match_type;
    }
}