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

namespace Plugin\ListingAdCsv;


use Eccube\Common\Constant;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class ListingAdCsvEvent
{
    /** @var \Eccube\Application $app */
    private $app;

    private $legacyEvent;
    /**
     * GiftWrappingEvent constructor.
     * @param  \Eccube\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->legacyEvent = new ListingAdCsvLegacyEvent($app);
    }

    /**
     * New event function on version >= 3.0.9 (new hook point)
     * @param \Eccube\Event\TemplateEvent $event
     */
    public function onAdminProductInit(\Eccube\Event\TemplateEvent $event)
    {
        // content
        $source = $event->getSource();
        // position
        $search = '<li id="result_list__csv_menu" class="dropdown">';
        // template need addition
        $parts = $this->app['twig']->getLoader()->getSource('ListingAdCsv\Resource\template\Admin\dropdown_parts.twig');
        $replace = $parts.$search;
        $source = str_replace($search, $replace, $source);

        $event->setSource($source);
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onRenderAdminProductBefore(FilterResponseEvent $event)
    {
        // support new hook point
        if ($this->supportNewHookPoint()) {
            return;
        }
        $this->legacyEvent->onRenderAdminProductBefore($event);
    }

    /**
     * v3.0.9以降のフックポイントに対応しているのか
     *
     * @return bool
     */
    private function supportNewHookPoint()
    {
        return version_compare('3.0.9', Constant::VERSION, '<=');
    }
}
