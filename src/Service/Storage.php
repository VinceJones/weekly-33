<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 1/7/16
 * Time: 8:01 PM
 */

namespace PHPWeekly\Service;


class Storage
{
    /**
     * @param string $path
     * @return string
     */
    public function read($path)
    {
        if (!file_exists($path)) {
            return '';
        }

        return file_get_contents($path);
    }

    /**
     * @param string $path
     * @param string $data
     * @return bool
     */
    public function write($path, $data)
    {
        $this->init($path);

        return file_put_contents($path, $data);
    }

    /**
     * @param string $path
     * @return bool
     */
    public function delete($path)
    {
        return true;
    }

    /**
     * @param $path
     */
    private function init($path)
    {
        $directory = dirname($path);

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
    }
}