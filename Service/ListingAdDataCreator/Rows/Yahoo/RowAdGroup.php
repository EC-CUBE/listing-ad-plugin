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

use Plugin\ListingAdCsv\Service\ListingAdDataCreator\Campaign\CampaignInterface;

class RowAdGroup
{
    private $containers = array();

    /**
     * RowCampaign constructor.
     * @param CampaignInterface $campaign
     */
    public function __construct(CampaignInterface $campaign)
    {
        foreach ($campaign->getAdGroups() as $adGroup) {
            // 広告行：追加
            $ad_keyword = new RowAd($campaign, $adGroup);
            foreach ($ad_keyword->getContainers() as $container) {
                array_push($this->containers, $container);
            }

            // グループ行：固有のパラメータを設定して追加
            $container = new ColumnContainer();
            $container->setCampaignName($campaign->getCampaignName());
            $container->setAdGroupName($adGroup->getName());
            $container->setComponentType('広告グループ');
            $container->setIsDelivery('オン');
            $container->setMaxCpc($campaign->getMaxCpc());
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
