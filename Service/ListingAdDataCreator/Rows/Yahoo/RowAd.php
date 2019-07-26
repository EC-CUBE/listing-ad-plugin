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

namespace Plugin\ListingAdCsv\Service\ListingAdDataCreator\Rows\Yahoo;

use Plugin\ListingAdCsv\Service\ListingAdDataCreator\AdData\AdGroup;
use Plugin\ListingAdCsv\Service\ListingAdDataCreator\Campaign\CampaignInterface;

class RowAd
{
    private $containers = array();

    /**
     * RowCampaign constructor.
     * @param CampaignInterface $campaign
     * @param AdGroup $adGroup
     */
    public function __construct(CampaignInterface $campaign, AdGroup $adGroup)
    {
        // キーワード行：追加
        $ad_keyword = new RowKeyword($campaign, $adGroup);
        foreach ($ad_keyword->getContainers() as $container) {
            array_push($this->containers, $container);
        }

        // 広告行：固有のパラメータを設定して追加
        $container = new ColumnContainer();
        $container->setCampaignName($campaign->getCampaignName());
        $container->setAdGroupName($adGroup->getName());
        $container->setComponentType('広告');
        $container->setIsDelivery('オン');
        $container->setAdName($adGroup->getAdContents()->getAdInnerName());
        $container->setAdTitle($adGroup->getAdContents()->getHeadline());
        $container->setAdDescription1($adGroup->getAdContents()->getDescription1());
        $container->setAdDescription2($adGroup->getAdContents()->getDescription2());
        $container->setAdDisplayUrl($adGroup->getAdContents()->getDisplayUrl());
        $container->setAdLinkUrl($adGroup->getAdContents()->getLinkUrl());
        $container->setAdType('テキスト（15・19-19）');
        array_push($this->containers, $container);
    }

    /**
     * @return ColumnContainer[]
     */
    public function getContainers()
    {
        return $this->containers;
    }
}
