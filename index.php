<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 1/7/16
 * Time: 7:55 PM
 */

use PHPWeekly\Factory\PrisonerFactory;
use PHPWeekly\Provider\ResponseHistoryProvider;
use PHPWeekly\Service\Serializer;
use PHPWeekly\Service\Storage;

require_once 'vendor/autoload.php';

if (!isset($argv[1]) || !isset($argv[2])) {
    throw new \InvalidArgumentException('Missing Arguments, provide name and discipline');
}

$partnerPreviousResponse = isset($argv[3]) ? $argv[3] : null;
$playerPreviousResponse = isset($argv[4]) ? $argv[4] : null;

$historyProvider = new ResponseHistoryProvider(new Storage(), new Serializer());
$prisonerFactory = new PrisonerFactory($historyProvider);

$partner = $prisonerFactory->make($argv[1], $argv[2], $partnerPreviousResponse);
$player = $prisonerFactory->make('vjones', 'php', $playerPreviousResponse);

$historyProvider->setHistory($partner);
$historyProvider->setHistory($player);

$playerResponseHistory = $player->getResponseHistory();
$partnerResponseHistory = $partner->getResponseHistory();

foreach($playerResponseHistory as $key => $thing) {
    var_dump($thing->getValue(), $partnerResponseHistory[$key]->getValue());
}
//var_dump($playerResponseHistory[1]);