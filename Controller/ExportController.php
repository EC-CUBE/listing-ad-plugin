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

namespace Plugin\ListingAdCsv\Controller;

use Eccube\Application;
use Plugin\ListingAdCsv\Service\ListingAdDataCreator\Rows\RowCreatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController
{
    /**
     * CSV出力の共通処理
     * @param Application $app
     * @param Request $request
     * @param string $type CSV出力形式の種類
     * @return StreamedResponse
     */
    public function export(Application $app, Request $request, $type)
    {
        // タイムアウトを無効にする.
        set_time_limit(0);

        $response = new StreamedResponse();
        $response->setCallback(function () use ($app, $request, $type) {
            $app['listing_ad_csv.service.listingad.data.creator']->create($app, $request, $type);
        });

        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename=' . $this->createFileName($type));
        $response->send();

        return $response;
    }

    /**
     * 現在時刻から出力ファイル名を生成
     * @param $type
     * @return string
     */
    private function createFileName($type)
    {
        $now = new \DateTime();
        $filename = 'listing_ad_' . $type . $now->format('_YmdHis') . '.csv';
        return $filename;
    }
}
