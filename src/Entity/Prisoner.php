<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 1/7/16
 * Time: 7:29 PM
 */

namespace PHPWeekly\Entity;


class Prisoner
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $discipline;

    /**
     * @var ResponseHistory
     */
    private $responseHistory;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDiscipline()
    {
        return $this->discipline;
    }

    /**
     * @param string $discipline
     */
    public function setDiscipline($discipline)
    {
        $this->discipline = $discipline;
    }

    /**
     * @return ResponseHistory
     */
    public function getResponseHistory()
    {
        return $this->responseHistory;
    }

    /**
     * @param ResponseHistory $responseHistory
     */
    public function setResponseHistory(ResponseHistory $responseHistory)
    {
        $this->responseHistory = $responseHistory;
    }
}