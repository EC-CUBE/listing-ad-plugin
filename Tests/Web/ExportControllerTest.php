<?php
/**
 * Created by PhpStorm.
 * User: lqdung
 * Date: 5/27/2016
 * Time: 10:28 AM
 */

namespace Plugin\ListingAdCsv\Tests\Web;


use Eccube\Entity\Product;
use Eccube\Tests\Web\Admin\AbstractAdminWebTestCase;

class ExportControllerTest extends AbstractAdminWebTestCase
{
    /**
     * @param $type
     * @param $expected
     * @dataProvider dataProvider
     */
    public function testExport($type, $expected)
    {
        $this->client->request('GET', $this->app->url('ListingAdCsv_export', array('type' => $type)));
        $this->actual = $this->client->getResponse()->headers->get('Content-Type') == 'application/octet-stream';
        $this->expected = $expected;
        $this->verify();
    }

    /**
     * @param $type
     * @param $expected
     * @dataProvider dataProvider
     */
    public function testExport_WithSearch($type, $expected)
    {
        $Product = $this->createProduct();
        $this->client->request('POST',
            $this->app->url('admin_product'),
            array('admin_search_product' => $this->createSearchForm($Product))
        );
        $this->client->request('GET',
            $this->app->url('ListingAdCsv_export', array('type' => $type)),
            array(), array(),
            array('CONTENT_TYPE' => 'application/json')
        );

        $this->actual = $this->client->getResponse()->headers->get('Content-Type') == 'application/octet-stream';
        $this->expected = $expected;
        $this->verify();
    }

    public function dataProvider()
    {
        return array(
            array('google', true),
            array('yahoo', true),
        );
    }

    private function createSearchForm(Product $Product)
    {
        $Category = $Product->getProductCategories();
        return array(
            '_token' => 'dummy',
            'id' => $Product->getId(),
            'category_id' => $Category[0]->getCategoryId(),
            'status' => array($Product->getStatus()->getId()),
            'create_date_start' => $Product->getCreateDate()->format('Y-m-d'),
            'create_date_end' => $Product->getCreateDate()->modify('+2 days')->format('Y-m-d'),
            'update_date_start' => $Product->getUpdateDate()->format('Y-m-d'),
            'update_date_end' => $Product->getUpdateDate()->modify('+2 days')->format('Y-m-d'),
        );
    }
}