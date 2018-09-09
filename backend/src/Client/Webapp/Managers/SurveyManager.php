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
        foreach ($this->files as $file) {
            $survey = array('name' => $file['survey']['name'], 'code' => $file['survey']['code']);
            if (!in_array($survey, $surveys)) {
                array_push($surveys, $survey);
            }
        }

        return $surveys;
    }

    /**
     * @param $code
     * @return array
     */
    public function getSurveysAggregationByCode($code)
    {
        $qcm = [];
        $total = 0;
        $dates = [];
        $totalFileType = 0;
        foreach ($this->files as $file) {
            if ($file['survey']['code'] === $code) {
                $questions = $file['questions'];
                $data = $this->extractDataFromSurvey($questions);

                $qcm = array_map(function (...$arrays) {
                    return array_sum($arrays);
                }, $qcm, $data['qcm']);
                
                $total += $data['numeric'];
                array_push($dates, $data['date']);

                $totalFileType++;
            }
        }

        $result = [];
        $result['qcm'] = $qcm;
        $result['average'] = $total / $totalFileType;
        $result['dates'] = $dates;

        return $result;
    }


    /**
     * @param array $booleans
     * @return array
     */
    private function convertBooleanArrayToIntegers(array $booleans)
    {
        $integers = [];
        foreach ($booleans as $boolean) {
            array_push($integers, (int)$boolean);
        }
        return $integers;
    }

    /**
     * @param array $questions
     * @return array
     */
    private function extractDataFromSurvey(array $questions)
    {
        $data = [];
        foreach ($questions as $question) {
            $type = $question['type'];
            $answer = $question['answer'];
            if ($type === 'qcm') {
                $data[$type] = $this->convertBooleanArrayToIntegers($answer);
            } else if ($type === 'numeric') {
                $data[$type] = $answer;
            } else if ($type === 'date') {
                $data[$type] = $answer;
            }
        }

        return $data;
    }

    /**
     * @param string $directory
     * @return array
     */
    private function getFiles($directory = 'data/')
    {
        $filesName = array_diff(scandir(ROOT_PATH.'/'.$directory), array('..', '.'));
        $decodedFiles = [];

        foreach ($filesName as $fileName) {
            $file = file_get_contents($directory . $fileName);
            array_push($decodedFiles, json_decode($file, true));
        }

        return $decodedFiles;
    }
}