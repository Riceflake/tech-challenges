<?php

namespace IWD\JOBINTERVIEW\Client\Webapp\Services;

use IWD\JOBINTERVIEW\Client\Webapp\Managers\SurveyManager;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class SurveyService
 * @package IWD\JOBINTERVIEW\Client\Webapp\Services
 */
class SurveyService implements ServiceProviderInterface
{
    /**
     * @param Container $pimple
     */
    public function register(Container $pimple)
    {
        $pimple['surveys'] = function () {
            return new SurveyManager();
        };
    }
}