<?php
/**
 * @category Stagem
 * @package Stagem_ZfcAsn
 * @author Vlad Kozak <vlad.gem.typ@gmail.com>
 * @datetime: 20.02.2018 14:14
 */

namespace Stagem\ZfcAsn\Service\Helper;

use Zend\Http\Client;

class FacebookService
{
    private $config;

    protected $accessTokenUrl = 'https://graph.facebook.com/v2.9/oauth/access_token?';

    protected $getInfoUrl = 'https://graph.facebook.com/v2.9/me?';

    public function __construct(array $config)
    {
        $this->config = $config['social_networks']['facebook'];
    }

    protected function getAdapterConfig () {
        $config = array(
            'adapter'   => 'Zend\Http\Client\Adapter\Curl',
            'curloptions' => array(CURLOPT_FOLLOWLOCATION => true),
        );

        return $config;
    }

    /**
     * @return string
     */
    public function getFacebookAuthUrl($scope = 'public_profile,email,user_location')
    {
        return "https://www.facebook.com/v2.9/dialog/oauth?client_id={$this->config['id']}&redirect_uri={$this->config['redirectUri']}&response_type=code&scope={$scope}";
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getFacebookUserInfo($code)
    {
        $token = $this->getToken($code);
        $userInfo = $this->getUserInfo($token, $code);

        return $userInfo;

    }

    /**
     * @param $code
     * @return mixed
     */
    public function getToken ($code) {
        if (!$code) {
            \Zend\Debug\Debug::dump(iconv("CP1251//IGNORE", "UTF-8", "Don't exist code"));
        }

        $parameters = $this->generateGetParameters($code);
        $response =  $this->sendGetRequest($this->accessTokenUrl , $parameters);

        return $response->access_token;
    }

    /**
     * @param $token
     * @param $code
     * @return mixed
     */
    public function getUserInfo($token, $code) {
        if (!$token) {
            \Zend\Debug\Debug::dump(iconv("CP1251//IGNORE", "UTF-8", "Error token"));
        }

        $parameters = $this->generateGetParameters($code, $token, $this->config['fields']);
        return $this->sendGetRequest($this->getInfoUrl , $parameters);
    }

    /**
     * @param $url
     * @param $parameters
     * @return mixed
     */
    public function sendGetRequest($url, $parameters) {
        $client = new Client($url, $this->getAdapterConfig());

        $client->setParameterGet($parameters);

        $response = $client->send();
        return json_decode($response->getBody());
    }

    /**
     * @param $code
     * @param null $token
     * @param null $fields
     * @return array
     */
    public function generateGetParameters($code, $token = null, $fields = null) {
        $parameters = [
            'client_id'         => $this->config['id'],
            'redirect_uri'      => $this->config['redirectUri'],
            'client_secret'     => $this->config['secret'],
            'state'             => '{st=state123abc,ds=123456789}',
            'code'               => $code
        ];

        if ($fields) {
            $parameters['fields'] = $fields;
        }
        if ($token) {
            $parameters['access_token'] = $token;
        }

        return $parameters;
    }



}