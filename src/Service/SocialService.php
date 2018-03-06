<?php
/**
 * @category Stagem
 * @package Stagem_ZfcAsn
 * @author Vlad Kozak <vlad.gem.typ@gmail.com>
 * @datetime: 20.02.2018 14:14
 */

namespace Stagem\ZfcAsn\Service;

use Popov\ZfcCore\Service\DomainServiceAbstract;
use Stagem\ZfcAsn\Service\Helper\GoogleService;
use Stagem\ZfcAsn\Service\Helper\FacebookService;

class SocialService extends DomainServiceAbstract
{
    private $config;

    protected $googleService;

    protected $facebookService;

    public function __construct(array $config, GoogleService $googleService, FacebookService $facebookService)
    {
        $this->config = $config;
        $this->googleService = $googleService;
        $this->facebookService = $facebookService;
    }

    /**
     * @return mixed
     */
    public function getGoogleService()
    {
        return $this->googleService;
    }

    /**
     * @return mixed
     */
    public function getFacebookService()
    {
        return $this->facebookService;
    }
}