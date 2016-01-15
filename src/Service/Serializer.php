<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 1/7/16
 * Time: 8:07 PM
 */

namespace PHPWeekly\Service;

class Serializer
{
    public function serialize($serializable)
    {
        return serialize($serializable);
    }

    public function deserialize($data)
    {
        return unserialize($data);
    }
}