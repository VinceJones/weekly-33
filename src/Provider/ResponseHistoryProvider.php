<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 1/7/16
 * Time: 8:04 PM
 */

namespace PHPWeekly\Provider;


use PHPWeekly\Entity\Prisoner;
use PHPWeekly\Entity\ResponseHistory;
use PHPWeekly\Service\Serializer;
use PHPWeekly\Service\Storage;

class ResponseHistoryProvider
{
    /**
     * @var Storage
     */
    private $storage;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * ResponseHistoryProvider constructor.
     * @param Storage $storage
     * @param Serializer $serializer
     */
    public function __construct(Storage $storage, Serializer $serializer)
    {
        $this->storage = $storage;
        $this->serializer = $serializer;
    }

    /**
     * @param Prisoner $prisoner
     * @return ResponseHistory
     */
    public function getHistory(Prisoner $prisoner)
    {
        $path = $this->getPath($prisoner);
        $data = $this->storage->read($path);

        return !$data ? new ResponseHistory() : $this->serializer->deserialize($data);
    }

    /**
     * @param Prisoner $prisoner
     */
    public function setHistory(Prisoner $prisoner)
    {
        $data = $this->serializer->serialize($prisoner->getResponseHistory());
        $path = $this->getPath($prisoner);

        $this->storage->write($path, $data);
    }

    /**
     * @param Prisoner $prisoner
     * @return string
     */
    private function getPath(Prisoner $prisoner)
    {
        return sprintf('data/%s-%s.txt',
            $prisoner->getName(),
            $prisoner->getDiscipline()
        );
    }
}