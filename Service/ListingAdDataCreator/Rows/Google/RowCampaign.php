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

use Plugin\ListingAdCsv\Service\ListingAdDataCreator\Campaign\CampaignInterface;

class RowCampaign
{
    private $containers = array();

    /**
     * RowCampaign constructor.
     * @param CampaignInterface $campaign
     */
    public function __construct(CampaignInterface $campaign)
    {
        // キャンペーン行：固有のパラメータを設定して追加
        $container = new ColumnContainer();
        $container->setCampaign($campaign->getCampaignName());
        $container->setCampaignDailyBudget($campaign->getDailyBudget());
        $container->setNetworks('Search Partners');
        $container->setLanguages('ja');
        $container->setEnhancedCpc('Disabled');
        $container->setBidModifier('0');
        $container->setCampaignType('Search Network only');
        $container->setCampaignStatus($this->getCampaignStatusText($campaign->isCampaignStatus()));
        array_push($this->containers, $container);

        // キャンペーン行（ロケーション）：固有のパラメータを設定して追加
        $container = new ColumnContainer();
        $container->setCampaign($campaign->getCampaignName());
        $container->setId('2392');
        $container->setLocation('日本');
        array_push($this->containers, $container);

        // 広告行：追加
        $ad_group = new RowAdGroup($campaign);
        foreach ($ad_group->getContainers() as $container) {
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

    /**
     * @param boolean $campaign_status
     * @return string
     */
    private function getCampaignStatusText($campaign_status)
    {
        return $campaign_status ? 'Active' : 'Paused';
    }
}
