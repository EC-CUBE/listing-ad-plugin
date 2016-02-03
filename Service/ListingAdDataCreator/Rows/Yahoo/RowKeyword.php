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

namespace Plugin\ListingAdCsv\Service\ListingAdDataCreator\Rows\Yahoo;

use Plugin\ListingAdCsv\Service\ListingAdDataCreator\AdData\AdGroup;
use Plugin\ListingAdCsv\Service\ListingAdDataCreator\Campaign\CampaignInterface;

class RowKeyword
{
    private $containers = array();

    /**
     * RowCampaign constructor.
     * @param CampaignInterface $campaign
     * @param AdGroup $adGroup
     */
    public function __construct(CampaignInterface $campaign, AdGroup $adGroup)
    {
        foreach ($adGroup->getKeywords() as $keyword) {
            // キーワード行：固有のパラメータを設定して追加
            $container = new ColumnContainer();
            $container->setComponentType('キーワード');
            $container->setIsDelivery('オン');
            $container->setCampaignName($campaign->getCampaignName());
            $container->setAdGroupName($adGroup->getName());
            $container->setMatchType($this->getMatchTypeText($campaign->getMatchType()));
            $container->setKeyword($keyword);
            $container->setMaxCpc($campaign->getMaxCpc() . '(一括入札)');
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
     * @param int $type
     * @return string
     */
    private function getMatchTypeText($type)
    {
        switch ($type) {
            case 0: return '完全一致';
            case 1: return '部分一致';
            case 2: return 'フレーズ一致';
            default: return 'フレーズ一致';
        }
    }
}