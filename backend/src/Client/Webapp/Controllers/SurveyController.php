<?php

namespace IWD\JOBINTERVIEW\Client\Webapp\Controllers;

use Silex\Api\ControllerProviderInterface;
use Silex\Application;

/**
 * Class SurveyController
 * @package IWD\JOBINTERVIEW\Client\Webapp\Controllers
 */
class SurveyController implements ControllerProviderInterface
{
    /**
    * @param Application $app
    * @return \Silex\ControllerCollection|void
    */
    public function connect(Application $app)
    {
        $factory = $app['controllers_factory'];

        $factory->get('/surveys', function() use ($app) {
            return $app['surveys']->getSurveys();
        });

        $factory->get('surveys/{code}', function ($code) use ($app) {
            return $app['surveys']->getSurveysAggregationByCode($code);
        });

        return $factory;
    }
}