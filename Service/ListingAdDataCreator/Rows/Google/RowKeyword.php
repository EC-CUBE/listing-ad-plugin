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

namespace Plugin\ListingAdCsv\Service\ListingAdDataCreator\Rows\Google;

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
            $container->setCampaign($campaign->getCampaignName());
            $container->setAdGroup($adGroup->getName());
            $container->setMaxCpc('0');
            $container->setKeyword($keyword);
            $container->setCriterionType($this->getMatchTypeText($campaign->getMatchType()));
            $container->setCampaignStatus('Active');
            $container->setAdGroupStatus('Active');
            $container->setStatus('Active');
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
            case 0: return 'Exact';
            case 1: return 'Broad';
            case 2: return 'Phrase';
            default: return 'Phrase';
        }
    }
}