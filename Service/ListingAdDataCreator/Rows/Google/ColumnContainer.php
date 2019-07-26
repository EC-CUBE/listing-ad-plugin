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

class ColumnContainer
{
    /**
     * CSVの列 定義マップ
     * CSVファイルにはこの列の順番で出力されます
     * key: ヘッダー名
     * value: 出力するプロパティ名
     */
    private static $column_map = array(
        'Campaign' => 'campaign',
        'Labels' => 'labels',
        'Campaign Daily Budget' => 'campaign_daily_budget',
        'Networks' => 'networks',
        'Languages' => 'languages',
        'Enhanced CPC' => 'enhanced_cpc',
        'ID' => 'id',
        'Location' => 'location',
        'Ad Schedule' => 'ad_schedule',
        'Ad Group' => 'ad_group',
        'Max CPC' => 'max_cpc',
        'Display Network Max CPC' => 'display_network_max_cpc',
        'Max CPM' => 'max_cpm',
        'CPA Bid' => 'cpa_bid',
        'Keyword' => 'keyword',
        'Criterion Type' => 'criterion_type',
        'First page bid' => 'first_page_bid',
        'Top of page bid' => 'top_of_page_bid',
        'Quality score' => 'quality_score',
        'Bid Modifier' => 'bid_modifier',
        'Campaign Type' => 'campaign_type',
        'Headline' => 'headline',
        'Description Line 1' => 'description_line_1',
        'Description Line 2' => 'description_line_2',
        'Display URL' => 'display_url',
        'Final URL' => 'final_url',
        'Device Preference' => 'device_preference',
        'Campaign Status' => 'campaign_status',
        'Ad Group Status' => 'ad_group_status',
        'Status' => 'status',
        'Approval status' => 'approval_status',
        'Comment' => 'comment',
    );

    /**
     * @var string
     */
    private $campaign = '';
    /**
     * @var string
     */
    private $labels = '';
    /**
     * @var string
     */
    private $campaign_daily_budget = '';
    /**
     * @var string
     */
    private $networks = '';
    /**
     * @var string
     */
    private $languages = '';
    /**
     * @var string
     */
    private $enhanced_cpc = '';
    /**
     * @var string
     */
    private $id = '';
    /**
     * @var string
     */
    private $location = '';
    /**
     * @var string
     */
    private $ad_schedule = '';
    /**
     * @var string
     */
    private $ad_group = '';
    /**
     * @var string
     */
    private $max_cpc = '';
    /**
     * @var string
     */
    private $display_network_max_cpc = '';
    /**
     * @var string
     */
    private $max_cpm = '';
    /**
     * @var string
     */
    private $cpa_bid = '';
    /**
     * @var string
     */
    private $keyword = '';
    /**
     * @var string
     */
    private $criterion_type = '';
    /**
     * @var string
     */
    private $first_page_bid = '';
    /**
     * @var string
     */
    private $top_of_page_bid = '';
    /**
     * @var string
     */
    private $quality_score = '';
    /**
     * @var string
     */
    private $bid_modifier = '';
    /**
     * @var string
     */
    private $campaign_type = '';
    /**
     * @var string
     */
    private $headline = '';
    /**
     * @var string
     */
    private $description_line_1 = '';
    /**
     * @var string
     */
    private $description_line_2 = '';
    /**
     * @var string
     */
    private $display_url = '';
    /**
     * @var string
     */
    private $final_url = '';
    /**
     * @var string
     */
    private $device_preference = '';
    /**
     * @var string
     */
    private $campaign_status = '';
    /**
     * @var string
     */
    private $ad_group_status = '';
    /**
     * @var string
     */
    private $status = '';
    /**
     * @var string
     */
    private $approval_status = '';
    /**
     * @var string
     */
    private $comment = '';

    /**
     * @param string $campaign
     */
    public function setCampaign($campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * @param string $labels
     */
    public function setLabels($labels)
    {
        $this->labels = $labels;
    }

    /**
     * @param string $campaign_daily_budget
     */
    public function setCampaignDailyBudget($campaign_daily_budget)
    {
        $this->campaign_daily_budget = $campaign_daily_budget;
    }

    /**
     * @param string $networks
     */
    public function setNetworks($networks)
    {
        $this->networks = $networks;
    }

    /**
     * @param string $languages
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }

    /**
     * @param string $enhanced_cpc
     */
    public function setEnhancedCpc($enhanced_cpc)
    {
        $this->enhanced_cpc = $enhanced_cpc;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @param string $ad_schedule
     */
    public function setAdSchedule($ad_schedule)
    {
        $this->ad_schedule = $ad_schedule;
    }

    /**
     * @param string $ad_group
     */
    public function setAdGroup($ad_group)
    {
        $this->ad_group = $ad_group;
    }

    /**
     * @param string $max_cpc
     */
    public function setMaxCpc($max_cpc)
    {
        $this->max_cpc = $max_cpc;
    }

    /**
     * @param string $display_network_max_cpc
     */
    public function setDisplayNetworkMaxCpc($display_network_max_cpc)
    {
        $this->display_network_max_cpc = $display_network_max_cpc;
    }

    /**
     * @param string $max_cpm
     */
    public function setMaxCpm($max_cpm)
    {
        $this->max_cpm = $max_cpm;
    }

    /**
     * @param string $cpa_bid
     */
    public function setCpaBid($cpa_bid)
    {
        $this->cpa_bid = $cpa_bid;
    }

    /**
     * @param string $keyword
     */
    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @param string $criterion_type
     */
    public function setCriterionType($criterion_type)
    {
        $this->criterion_type = $criterion_type;
    }

    /**
     * @param string $first_page_bid
     */
    public function setFirstPageBid($first_page_bid)
    {
        $this->first_page_bid = $first_page_bid;
    }

    /**
     * @param string $top_of_page_bid
     */
    public function setTopOfPageBid($top_of_page_bid)
    {
        $this->top_of_page_bid = $top_of_page_bid;
    }

    /**
     * @param string $quality_score
     */
    public function setQualityScore($quality_score)
    {
        $this->quality_score = $quality_score;
    }

    /**
     * @param string $bid_modifier
     */
    public function setBidModifier($bid_modifier)
    {
        $this->bid_modifier = $bid_modifier;
    }

    /**
     * @param string $campaign_type
     */
    public function setCampaignType($campaign_type)
    {
        $this->campaign_type = $campaign_type;
    }

    /**
     * @param string $headline
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    /**
     * @param string $description_line_1
     */
    public function setDescriptionLine1($description_line_1)
    {
        $this->description_line_1 = $description_line_1;
    }

    /**
     * @param string $description_line_2
     */
    public function setDescriptionLine2($description_line_2)
    {
        $this->description_line_2 = $description_line_2;
    }

    /**
     * @param string $display_url
     */
    public function setDisplayUrl($display_url)
    {
        $this->display_url = $display_url;
    }

    /**
     * @param string $final_url
     */
    public function setFinalUrl($final_url)
    {
        $this->final_url = $final_url;
    }

    /**
     * @param string $device_preference
     */
    public function setDevicePreference($device_preference)
    {
        $this->device_preference = $device_preference;
    }

    /**
     * @param string $campaign_status
     */
    public function setCampaignStatus($campaign_status)
    {
        $this->campaign_status = $campaign_status;
    }

    /**
     * @param string $ad_group_status
     */
    public function setAdGroupStatus($ad_group_status)
    {
        $this->ad_group_status = $ad_group_status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param string $approval_status
     */
    public function setApprovalStatus($approval_status)
    {
        $this->approval_status = $approval_status;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
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
