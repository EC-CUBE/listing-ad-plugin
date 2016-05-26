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

    /**
     * GiftWrappingEvent constructor.
     * @param  \Eccube\Application $app
     */
    public function __construct($app)
    {
        $this->app = $app;
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

        $request = $event->getRequest();
        $response = $event->getResponse();

        $html = $this->getHtmlWrapping($request, $response);
        $response->setContent($html);

        $event->setResponse($response);
    }

    /**
     * HTMLの加工
     *
     * @param Request $request
     * @param Response $response
     * @return string
     */
    private function getHtmlWrapping($request, $response)
    {
        $crawler = new Crawler($response->getContent());
        $html = $this->getHtml($crawler);
        /** @var FormFactory $formFactory */
//        $formFactory = $this->app['form.factory'];
//        $form = $formFactory->createBuilder('shopping')->getForm();
//
       $parts = $this->app->renderView('ListingAdCsv\Resource\template\Admin\dropdown_parts.twig');

        // TODO 挿入位置の指定方法、もっとよい方法ないのか？
        try {
            $crawler = $crawler->filter('ul.sort-dd');
            if ($crawler->count() != 0) {
                $oldHtml = $crawler->last()->html();
                $newHtml = $oldHtml . $parts;
                $html = str_replace($oldHtml, $newHtml, $html);
            }
        } catch (\InvalidArgumentException $e) {
            // ignore
        }

        return $html;
    }

    /**
     * 解析用HTMLを取得
     *
     * @param Crawler $crawler
     * @return string
     */
    private function getHtml(Crawler $crawler)
    {
        $html = '';

        /** @var \DOMElement $domElement */
        foreach ($crawler as $domElement) {
            $domElement->ownerDocument->formatOutput = true;
            $html .= $domElement->ownerDocument->saveHTML();
        }

        return html_entity_decode($html, ENT_NOQUOTES, 'UTF-8');
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