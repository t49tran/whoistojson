<?php
/**
 * Created by IntelliJ IDEA.
 * User: trant
 * Date: 30/05/2015
 * Time: 3:51 PM
 */
namespace WhoIsToJsonBundle\API;

use \Unirest;

class WhoIsToJson{

    private $api_key;
    private $whois_end_point;
    private $screenshot_end_point;

    public function __construct($api_key,$whois_end_point,$screenshot_end_point){

        $this->api_key = $api_key;
        $this->whois_end_point = $whois_end_point;
        $this->screenshot_end_point = $screenshot_end_point;

    }

    public function whoIs($domain){
        return $this->request($domain,$this->whois_end_point);
    }

    public function captureScreenShot($domain){
        return $this->request($domain,$this->screenshot_end_point);
    }

    public function request($domain,$end_point){
        $request = new Unirest\Request();

        $request->verifyPeer(false);

        $response = $request->get($end_point,
            array(
                "Accept" => "application/json",
                "Authorization" => "Token token=".$this->api_key
            ),
            array(
                "domain" => $domain
            )
        );

        return $response->body;
    }
}

