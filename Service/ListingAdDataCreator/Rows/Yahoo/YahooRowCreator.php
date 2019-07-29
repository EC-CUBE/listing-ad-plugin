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
use Plugin\ListingAdCsv\Service\ListingAdDataCreator\Rows\RowCreatorInterface;

/**
 * Yahooスポンサードサーチ入稿用のCSVデータを生成するクラス
 * @package Plugin\ListingAdCsv\Controller\Rows\Yahoo
 */
class YahooRowCreator implements RowCreatorInterface
{

    /**
     * ヘッダー行を取得する
     * @return string[]
     */
    public function GetHeaderRow()
    {
        return ColumnContainer::getHeaderNames();
    }

    /**
     * すべての行を取得する
     * @param CampaignInterface $campaign
     * @return \string[][]
     */
    public function GetRows(CampaignInterface $campaign)
    {
        $top_row = new RowCampaign($campaign);

        $generated_rows = array();
        foreach ($top_row->getContainers() as $container) {
            array_push($generated_rows, $container->getRow());
        }
        return $generated_rows;
    }

    /**
     * CSV出力のタイプ名を取得する
     * @return string
     */
    function getTypeName()
    {
        return 'yahoo';
    }
}
