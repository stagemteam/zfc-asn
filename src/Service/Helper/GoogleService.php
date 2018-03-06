<?php
/**
 * @category Stagem
 * @package Stagem_ZfcAsn
 * @author Vlad Kozak <vlad.gem.typ@gmail.com>
 * @datetime: 20.02.2018 14:14
 */

namespace Stagem\ZfcAsn\Service\Helper;

use Exception\Exception;
use Google_Client;
use Google_Service_Oauth2;

class GoogleService
{
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config['social_networks']['google'];
    }

    /**
     * @return string
     */
    public function getGoogleAuthUrl()
    {
        try {
            $gClient = $this->getGoogleClient();
        } catch (\Exception $e) {
            \Zend\Debug\Debug::dump(iconv("CP1251//IGNORE", "UTF-8", $e->getMessage()));
            \Zend\Debug\Debug::dump($e->getTraceAsString());
            die(__METHOD__);
        }
        return $gClient->createAuthUrl();
    }

    /**
     * @return Google_Client
     */
    public function getGoogleClient()
    {
        $gClient = new Google_Client();
        $gClient->setClientId($this->config['clientId']);
        $gClient->setClientSecret($this->config['clientSecret']);
        $gClient->setRedirectUri($this->config['redirectUri']);
        $gClient->setApplicationName("Collective Mind");
        $gClient->addScope($this->config['scope']);
        return $gClient;
    }

    /**
     * @param $code
     * @return \Google_Service_Oauth2_Userinfoplus
     */
    public function getGoogleUserInfo($code)
    {
        try {
            $gClient = $this->getGoogleClient();
        } catch (\Exception $e) {
            \Zend\Debug\Debug::dump(iconv("CP1251//IGNORE", "UTF-8", $e->getMessage()));
            \Zend\Debug\Debug::dump($e->getTraceAsString());
            die(__METHOD__);
        }
        $gClient->fetchAccessTokenWithAuthCode($code);
        $oAuth = new Google_Service_Oauth2($gClient);
        $userData = $oAuth->userinfo_v2_me->get();
        return $userData;
    }

}