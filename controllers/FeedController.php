<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

/**
 * Class FeedController
 * 
 * @author Aaron
 * @package app\controllers
 */
Class FeedController extends Controller {

    //logic for parsing the json resposne of feed api
    // render the view

    const BASE_URL = 'http://www.pinkvilla.com';
    const DEFAULT_PATH = '/photo-gallery-feed-page';

    /**
     * Handles Base feed
     */
    public function handlefeed(Request $request){

        $feedUrl  = self::BASE_URL . self::DEFAULT_PATH;
       
        $feedResp = file_get_contents($feedUrl);
        $feedRespArr = json_decode($feedResp, true);


        foreach( $feedRespArr['nodes'] as $nodeKey => $nodeValue){
            $nodeValue['node']['field_photo_image_section'] = self::BASE_URL . $nodeValue['node']['field_photo_image_section'];
            $nodeValue['node']['path'] = self::BASE_URL . $nodeValue['node']['path'];
            $params['nodes'][] = $nodeValue['node'];
        }

        return $this->render('feed', $params);

    }

    /**
     * Handles multiple feeds
     */
    public function handleMultiplefeeds(Request $request){
        $pageno = (int)$request->getUrlParams();
        if($pageno > 0){
            $feedUrl  = self::BASE_URL . self::DEFAULT_PATH . '/page' . "/$pageno";
        }

        $feedResp = file_get_contents($feedUrl);
        $feedRespArr = json_decode($feedResp, true);


        foreach( $feedRespArr['nodes'] as $nodeKey => $nodeValue){
            $nodeValue['node']['field_photo_image_section'] = self::BASE_URL . $nodeValue['node']['field_photo_image_section'];
            $nodeValue['node']['path'] = self::BASE_URL . $nodeValue['node']['path'];
            $params['nodes'][] = $nodeValue['node'];
        }

        return $this->render('feed', $params);
      
    }



}