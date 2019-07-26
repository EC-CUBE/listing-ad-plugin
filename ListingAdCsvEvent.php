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

namespace Plugin\ListingAdCsv;


use Eccube\Common\Constant;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class ListingAdCsvEvent
{
    /** @var \Eccube\Application $app */
    private $app;

    /**
     * @var ListingAdCsvLegacyEvent
     */
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
     * @param FilterResponseEvent $event
     */
    public function onAdminProductInit(FilterResponseEvent $event)
    {
        $this->legacyEvent->onRenderAdminProductBefore($event);
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
