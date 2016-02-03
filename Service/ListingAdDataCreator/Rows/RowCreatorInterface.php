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

namespace Plugin\ListingAdCsv\Service\ListingAdDataCreator\Rows;

use Plugin\ListingAdCsv\Service\ListingAdDataCreator\Campaign\CampaignInterface;

interface RowCreatorInterface
{

    /**
     * CSV出力のタイプ名を取得する
     * @return string
     */
    function getTypeName();

    /**
     * ヘッダー行を取得する
     * @return string[]
     */
    function GetHeaderRow();

    /**
     * 行を取得する
     * @param CampaignInterface $campaign
     * @return \string[][]
     */
    function GetRows(CampaignInterface $campaign);
}