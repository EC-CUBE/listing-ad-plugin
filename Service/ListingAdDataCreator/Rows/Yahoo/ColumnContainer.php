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

class ColumnContainer
{
    /**
     * CSVの列 定義マップ
     * CSVファイルにはこの列の順番で出力されます
     * key: ヘッダー名
     * value: 出力するプロパティ名
     */
    private static $column_map = array(
        'キャンペーン名' => 'campaign_name',
        ' 広告グループ名' => 'ad_group_name',
        ' コンポーネントの種類' => 'component_type',
        ' 配信設定' => 'is_delivery',
        ' 配信状況' => 'delivery_status',
        ' マッチタイプ' => 'match_type',
        ' キーワード' => 'keyword',
        ' カスタムURL' => 'custom_url',
        ' 入札価格' => 'max_cpc',
        ' 広告名' => 'ad_name',
        ' タイトル' => 'ad_title',
        ' 説明文1' => 'ad_description_1',
        ' 説明文2' => 'ad_description_2',
        ' 表示URL' => 'ad_display_url',
        ' リンク先URL' => 'ad_link_url',
        ' キャンペーン予算（日額）' => 'daily_budget',
        ' キャンペーン開始日' => 'start_date',
        ' デバイス' => 'device',
        ' 配信先' => 'delivery_target',
        ' スマートフォン入札価格調整率（%）' => 'bid_adjustment',
        ' 広告タイプ' => 'ad_type',
        ' キャリア' => 'career',
        ' 優先デバイス' => 'priority_device',
        ' キャンペーンID' => 'campaign_id',
        ' 広告グループID' => 'ad_group_id',
        ' キーワードID' => 'keyword_id',
        ' 広告ID' => 'ad_id',
        ' エラーメッセージ' => 'error_message',
    );

    /**
     * @var string
     */
    private $campaign_name = '';

    /**
     * @var string
     */
    private $ad_group_name = '';

    /**
     * @var string
     */
    private $component_type = '';

    /**
     * @var string
     */
    private $is_delivery = '';

    /**
     * @var string
     */
    private $delivery_status = '';

    /**
     * @var string
     */
    private $match_type = '';

    /**
     * @var string
     */
    private $keyword = '';

    /**
     * @var string
     */
    private $custom_url = '';

    /**
     * @var string
     */
    private $max_cpc = '';

    /**
     * @var string
     */
    private $ad_name = '';

    /**
     * @var string
     */
    private $ad_title = '';

    /**
     * @var string
     */
    private $ad_description_1 = '';


    /**
     * @var string
     */
    private $ad_description_2 = '';


    /**
     * @var string
     */
    private $ad_display_url = '';


    /**
     * @var string
     */
    private $ad_link_url = '';


    /**
     * @var string
     */
    private $daily_budget = '';

    /**
     * @var string
     */
    private $start_date = '';

    /**
     * @var string
     */
    private $device = '';

    /**
     * @var string
     */
    private $delivery_target = '';

    /**
     * @var string
     */
    private $bid_adjustment = '';

    /**
     * @var string
     */
    private $ad_type = '';

    /**
     * @var string
     */
    private $career = '';

    /**
     * @var string
     */
    private $priority_device = '';

    /**
     * @var string
     */
    private $campaign_id = '';

    /**
     * @var string
     */
    private $ad_group_id = '';

    /**
     * @var string
     */
    private $keyword_id = '';

    /**
     * @var string
     */
    private $ad_id = '';

    /**
     * @var string
     */
    private $error_message = '';

    /**
     * @param string $campaign_name
     */
    public function setCampaignName($campaign_name)
    {
        $this->campaign_name = $campaign_name;
    }

    /**
     * @param string $ad_group_name
     */
    public function setAdGroupName($ad_group_name)
    {
        $this->ad_group_name = $ad_group_name;
    }

    /**
     * @param string $component_type
     */
    public function setComponentType($component_type)
    {
        $this->component_type = $component_type;
    }

    /**
     * @param string $is_delivery
     */
    public function setIsDelivery($is_delivery)
    {
        $this->is_delivery = $is_delivery;
    }

    /**
     * @param string $delivery_status
     */
    public function setDeliveryStatus($delivery_status)
    {
        $this->delivery_status = $delivery_status;
    }

    /**
     * @param string $match_type
     */
    public function setMatchType($match_type)
    {
        $this->match_type = $match_type;
    }

    /**
     * @param string $keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @param string $custom_url
     */
    public function setCustomUrl($custom_url)
    {
        $this->custom_url = $custom_url;
    }

    /**
     * @param string $max_cpc
     */
    public function setMaxCpc($max_cpc)
    {
        $this->max_cpc = $max_cpc;
    }

    /**
     * @param string $ad_name
     */
    public function setAdName($ad_name)
    {
        $this->ad_name = $ad_name;
    }

    /**
     * @param string $ad_title
     */
    public function setAdTitle($ad_title)
    {
        $this->ad_title = $ad_title;
    }

    /**
     * @param string $ad_description_1
     */
    public function setAdDescription1($ad_description_1)
    {
        $this->ad_description_1 = $ad_description_1;
    }

    /**
     * @param string $ad_description_2
     */
    public function setAdDescription2($ad_description_2)
    {
        $this->ad_description_2 = $ad_description_2;
    }

    /**
     * @param string $ad_display_url
     */
    public function setAdDisplayUrl($ad_display_url)
    {
        $this->ad_display_url = $ad_display_url;
    }

    /**
     * @param string $ad_link_url
     */
    public function setAdLinkUrl($ad_link_url)
    {
        $this->ad_link_url = $ad_link_url;
    }

    /**
     * @param string $daily_budget
     */
    public function setDailyBudget($daily_budget)
    {
        $this->daily_budget = $daily_budget;
    }

    /**
     * @param string $start_date
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    /**
     * @param string $device
     */
    public function setDevice($device)
    {
        $this->device = $device;
    }

    /**
     * @param string $delivery_target
     */
    public function setDeliveryTarget($delivery_target)
    {
        $this->delivery_target = $delivery_target;
    }

    /**
     * @param string $bid_adjustment
     */
    public function setBidAdjustment($bid_adjustment)
    {
        $this->bid_adjustment = $bid_adjustment;
    }

    /**
     * @param string $ad_type
     */
    public function setAdType($ad_type)
    {
        $this->ad_type = $ad_type;
    }

    /**
     * @param string $career
     */
    public function setCareer($career)
    {
        $this->career = $career;
    }

    /**
     * @param string $priority_device
     */
    public function setPriorityDevice($priority_device)
    {
        $this->priority_device = $priority_device;
    }

    /**
     * @param string $campaign_id
     */
    public function setCampaignId($campaign_id)
    {
        $this->campaign_id = $campaign_id;
    }

    /**
     * @param string $ad_group_id
     */
    public function setAdGroupId($ad_group_id)
    {
        $this->ad_group_id = $ad_group_id;
    }

    /**
     * @param string $keyword_id
     */
    public function setKeywordId($keyword_id)
    {
        $this->keyword_id = $keyword_id;
    }

    /**
     * @param string $ad_id
     */
    public function setAdId($ad_id)
    {
        $this->ad_id = $ad_id;
    }

    /**
     * @param string $error_message
     */
    public function setErrorMessage($error_message)
    {
        $this->error_message = $error_message;
    }

    /**
     * @return string
     */
    public function getRow()
    {
        $property_names = array_values(self::$column_map);
        $row_data_array = array();
        foreach ($property_names as $property) {
            if (!property_exists($this, $property)) continue;

            array_push($row_data_array, $this->$property);
        }
        return $row_data_array;
    }

    /**
     * @return string[]
     */
    public static function getHeaderNames()
    {
        return array_keys(self::$column_map);
    }
}
