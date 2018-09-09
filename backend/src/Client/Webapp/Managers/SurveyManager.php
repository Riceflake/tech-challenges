<?php

namespace IWD\JOBINTERVIEW\Client\Webapp\Managers;

/**
 * Class SurveyManager
 * @package IWD\JOBINTERVIEW\Client\Webapp\Managers
 */
class SurveyManager
{
    /**
     * @var array
     */
    private $files = [];

    /**
     * SurveyManager constructor.
     */
    public function __construct()
    {
        $this->files = $this->getFiles();
    }

    /**
     * @return array
     */
    function getSurveys()
    {
        $surveys = [];
        $files = $this->getFiles();
        foreach ($files as $file) {
            $survey = (object)array('name' => $file['survey']['name'], 'code' => $file['survey']['code']);
            if (!in_array($survey, $surveys)) {
                array_push($surveys, $survey);
            }
        }
        return json_encode($surveys);
    }

    public function getSurveysAggregationByCode($code)
    {

    }

    /**
     * @param string $directory
     * @return string
     */
    private function getFiles($directory = 'data/')
    {
        $filesName = array_diff(scandir($directory), array('..', '.'));
        $decodedFiles = [];

        foreach ($filesName as $fileName) {
            $file = file_get_contents($directory . $fileName);
            array_push($decodedFiles, json_decode($file, true));
        }

        return $decodedFiles;
    }
}