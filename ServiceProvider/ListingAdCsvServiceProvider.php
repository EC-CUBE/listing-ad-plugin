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

namespace Plugin\ListingAdCsv\ServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class ListingAdCsvServiceProvider implements ServiceProviderInterface
{

    /**
     * Registers services on the given app.
     *
     * This method should only be used to configure services and parameters.
     * It should not get services.
     * @param Application $app
     */
    public function register(Application $app)
    {
        $app->match('/' . $app['config']['admin_route'] . '/listing_ad_plugin/export/{type}',
            'Plugin\ListingAdCsv\Controller\ExportController::export')
            ->bind('ListingAdCsv_export');

        // Service
        $app['listing_ad_csv.service.csv.export'] = $app->share(function () use ($app) {
            return new \Plugin\ListingAdCsv\Service\CsvExport\CsvExportService($app['config']['csv_export_encoding']);
        });
        $app['listing_ad_csv.service.listingad.data.creator'] = $app->share(function () use ($app) {
            return new \Plugin\ListingAdCsv\Service\ListingAdDataCreator\ListingAdDataCreatorService();
        });
    }

    /**
     * Bootstraps the application.
     *
     * This method is called after all services are registered
     * and should be used for "dynamic" configuration (whenever
     * a service must be requested).
     * @param Application $app
     */
    public function boot(Application $app)
    {
        // Do nothing
    }
}