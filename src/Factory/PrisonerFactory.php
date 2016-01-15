<?php

/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 1/7/16
 * Time: 9:52 PM
 */
namespace PHPWeekly\Factory;

use PHPWeekly\Entity\Prisoner;
use PHPWeekly\Entity\Response;
use PHPWeekly\Provider\ResponseHistoryProvider;

class PrisonerFactory
{
    /**
     * @var ResponseHistoryProvider
     */
    private $historyProvider;

    /**
     * PrisonerFactory constructor.
     */
    public function __construct(ResponseHistoryProvider $historyProvider)
    {
        $this->historyProvider = $historyProvider;
    }

    /**
     * @param string $name
     * @param string $discipline
     * @param string $previousResponse
     * @return Prisoner
     */
    public function make($name, $discipline, $previousResponse = null)
    {
        $prisoner = new Prisoner();
        $prisoner->setName($name);
        $prisoner->setDiscipline($discipline);

        $history = $this->historyProvider->getHistory($prisoner);

        $prisoner->setResponseHistory($history);

        if ($previousResponse) {
            $response = new Response();
            $response->setValue($previousResponse);
            $history->add($response);
        }

        return $prisoner;
    }
}