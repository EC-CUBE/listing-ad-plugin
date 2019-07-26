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

namespace Plugin\ListingAdCsv\Util;


use Eccube\Util\Str;

class CsvContentsUtil
{

    /**
     * 文字列の先頭から指定した文字数を切り出す
     * 改行コードは削除する。
     * @param $text
     * @param int $count 切り出す文字数
     * @return string
     */
    public static function clipText($text, $count)
    {
        return Str::convertLineFeed(mb_substr($text, 0, $count, 'UTF-8'), '');
    }

    /**
     * 文字列の先頭からhttpの文字列を取り除く
     * @param $text
     * @return string
     */
    public static function removeHttpText($text)
    {
        return str_replace(array('http://', 'https://'), '', $text);
    }
}
