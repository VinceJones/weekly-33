<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 1/7/16
 * Time: 7:34 PM
 */

namespace PHPWeekly\Entity;


use Doctrine\Common\Collections\ArrayCollection;

class ResponseHistory extends ArrayCollection
{
    /**
     * @return array
     */
    public function getHistory()
    {
        return $this->getValues();
    }

    /**
     * @param array $history
     */
    public function setHistory(array $history = [])
    {
        $this->__construct($history);
    }
}