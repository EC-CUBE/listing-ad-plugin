<?php
/*
* This file is part of EC-CUBE
*
* Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
* https://www.ec-cube.co.jp/
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace Plugin\ListingAdCsv\Service\ListingAdDataCreator\AdData;


use Eccube\Application;
use Eccube\Entity\Product;
use Plugin\ListingAdCsv\Util\CsvContentsUtil;

class AdContents
{

    /**
     * @var string
     */
    private $headline = '';

    /**
     * @var string
     */
    private $description1 = '';

    /**
     * @var string
     */
    private $description2 = '';

    /**
     * @var string
     */
    private $display_url = '';

    /**
     * @var string
     */
    private $link_url = '';

    /**
     * @var string
     */
    private $ad_inner_name = '';

    /**
     * AdContents constructor.
     * @param Application $app
     * @param Product $product
     */
    public function __construct(Application $app, Product $product)
    {
        $shop_name = $app['eccube.repository.base_info']->get()->getShopName();
        $homepage_url = $app->url('homepage');
        $product_url = $app->url('product_detail', array('id' => $product->getId()));

        $this->headline = CsvContentsUtil::clipText($product->getName(), 15);
        $this->description1 = CsvContentsUtil::clipText($product->getDescriptionDetail(), 19);
        $this->description2 = CsvContentsUtil::clipText($shop_name, 19);
        $this->display_url = CsvContentsUtil::removeHttpText(CsvContentsUtil::clipText($homepage_url, 29));
        $this->link_url = CsvContentsUtil::clipText($product_url, 1024);

        $now = new \DateTime();
        $ad_name = $now->format('Ymd') . '_' . str_pad($product->getId(), 4, 0, STR_PAD_LEFT);
        $this->ad_inner_name = CsvContentsUtil::clipText($ad_name, 50);
    }

    /**
     * @return string
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * @return string
     */
    public function getDescription1()
    {
        return $this->description1;
    }

    /**
     * @return string
     */
    public function getDescription2()
    {
        return $this->description2;
    }

    /**
     * @return string
     */
    public function getDisplayUrl()
    {
        return $this->display_url;
    }

    /**
     * @return string
     */
    public function getLinkUrl()
    {
        return $this->link_url;
    }

    /**
     * @return string
     */
    public function getAdInnerName()
    {
        return $this->ad_inner_name;
    }

}
