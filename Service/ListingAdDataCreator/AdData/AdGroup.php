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

namespace Plugin\ListingAdCsv\Service\ListingAdDataCreator\AdData;


use Plugin\ListingAdCsv\Util\CsvContentsUtil;

class AdGroup
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string[]
     */
    private $keywords = array();

    /**
     * @var AdContents
     */
    private $ad_contents;

    /**
     * AdGroup constructor.
     * @param string $name
     * @param AdContents $ad_contents
     */
    public function __construct($name, AdContents $ad_contents)
    {
        $this->name = $name;
        $this->ad_contents = $ad_contents;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string
     */
    public function addKeyword($keyword)
    {
        $keyword = CsvContentsUtil::clipText($keyword, 80);
        array_push($this->keywords, $keyword);
    }

    /**
     * @return string[]
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    public function getAdContents()
    {
        return $this->ad_contents;
    }
}