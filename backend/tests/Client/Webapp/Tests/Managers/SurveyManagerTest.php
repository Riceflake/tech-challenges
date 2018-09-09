<?php
/**
 * Created by PhpStorm.
 * User: franckzhang
 * Date: 0909//2018
 * Time: 23:52
 */

use IWD\JOBINTERVIEW\Client\Webapp\Managers\SurveyManager;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Constraint\IsType;

define('ROOT_PATH', realpath('.'));

class SurveyManagerTest extends TestCase
{
    /**
     * @var SurveyManager
     */
    private $surveyManager;

    /**
     * @var Array
     */
    private $XX1;

    /**
     * @var Array
     */
    private $XX2;

    /**
     * @var Array
     */
    private $XX3;

    /**
     * SurveyManagerTest constructor.
     */
    public function setUp()
    {
        $this->surveyManager = new SurveyManager();
        $this->XX1 = $this->surveyManager->getSurveysAggregationByCode('XX1');
        $this->XX2 = $this->surveyManager->getSurveysAggregationByCode('XX2');
        $this->XX3 = $this->surveyManager->getSurveysAggregationByCode('XX3');
    }

    public function testGetSurveys()
    {
        $this->assertEquals(count($this->surveyManager->getSurveys()), 3);
    }

    public function testGetSurveysAggregationByCode()
    {
        $this->assertInternalType(IsType::TYPE_ARRAY, $this->XX1['qcm']);

        $this->assertEquals($this->XX1['average'], 697.200000000000045474735088646411895751953125);
        $this->assertEquals($this->XX2['average'], 4733.3333333333330301684327423572540283203125);
        $this->assertEquals($this->XX3['average'], 6200);

        $datesCount = $this->XX1['dates'];
        $this->assertEquals(count($datesCount), 5);
    }
}
