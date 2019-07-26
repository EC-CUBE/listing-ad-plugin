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

namespace Plugin\ListingAdCsv\Service\ListingAdDataCreator\Rows\Google;

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
        // 広告行：固有のパラメータを設定して追加
        $container = new ColumnContainer();
        $container->setCampaign($campaign->getCampaignName());
        $container->setAdGroup($adGroup->getName());
        $container->setHeadline($adGroup->getAdContents()->getHeadline());
        $container->setDescriptionLine1($adGroup->getAdContents()->getDescription1());
        $container->setDescriptionLine2($adGroup->getAdContents()->getDescription2());
        $container->setDisplayUrl($adGroup->getAdContents()->getDisplayUrl());
        $container->setFinalUrl($adGroup->getAdContents()->getLinkUrl());
        $container->setDevicePreference('All');
        $container->setCampaignStatus('Active');
        $container->setAdGroupStatus('Active');
        $container->setStatus('Active');
        array_push($this->containers, $container);

        // キーワード行：追加
        $ad_keyword = new RowKeyword($campaign, $adGroup);
        foreach ($ad_keyword->getContainers() as $container) {
            array_push($this->containers, $container);
        }
    }

    /**
     * @return ColumnContainer[]
     */
    public function getContainers()
    {
        return $this->containers;
    }
}
