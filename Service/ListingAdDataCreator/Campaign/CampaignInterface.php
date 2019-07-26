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

namespace Plugin\ListingAdCsv\Service\ListingAdDataCreator\Campaign;

use Plugin\ListingAdCsv\Service\ListingAdDataCreator\AdData\AdGroup;

interface CampaignInterface
{
    /**
     * キャンペーン名を取得する
     * @return string
     */
    public function getCampaignName();

    /**
     * キャンペーンに含まれる広告グループ情報を取得する
     * @return AdGroup[]
     */
    public function getAdGroups();

    /**
     * クリック単価を取得する
     * @return string
     */
    public function getMaxCpc();

    /**
     * キャンペーン予算(日額)を取得する
     * @return string
     */
    public function getDailyBudget();

    /**
     * キャンペーンの配信状態を取得する
     * @return boolean
     */
    public function isCampaignStatus();

    /**
     * キーワードのマッチタイプを取得する
     * @return int
     */
    public function getMatchType();
}
