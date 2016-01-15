<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 1/7/16
 * Time: 7:45 PM
 */

namespace PHPWeekly\Entity;


class Response
{
    const SILENT = "silent";
    const CONFESS = "confess";

    /**
     * @var string
     */
    private $value;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    function __toString()
    {
        return (string) $this->value;
    }
}