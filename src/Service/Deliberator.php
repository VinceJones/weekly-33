<?php
/**
 * Created by PhpStorm.
 * User: Vince
 * Date: 1/7/16
 * Time: 8:43 PM
 */

namespace PHPWeekly\Service;


class Deliberator
{
    const CONFESS = 'confess';
    const SILENT = 'silent';

    /**
     * @param Prisoner $me
     * @param Prisoner $otherGuy
     */
    public function __construct(Prisoner $me, Prisoner $otherGuy)
    {
        $this->myLastAnswer = strtolower($me->getPreviousResponse());
        $this->otherGuyLastAnswer = strtolower($otherGuy->getPreviousResponse());
    }

    /**
     * @param \PHPWeekly\Service\FileWhisperer $file
     * @param $confidence
     * @return string
     */
    public function getGreaterAvg(FileWhisperer $file, $confidence)
    {
        $silent = self::SILENT;
        $confess = self::CONFESS;
        $silentCount = 0;
        $confessCount = 0;

        $fileArray = $file->explodeFile();

        foreach ($fileArray as $answer) {
            if (strtolower($answer) == 'silent') {
                $silentCount = $silentCount + 1;
            } else {
                $confessCount = $confessCount + 1;
            }
        }

        $totalCount = $file->countFile();
        $avgSilentPercent = ($silentCount / $totalCount);
        $avgConfessPercent = 1 - $avgSilentPercent;

        if (($avgSilentPercent + $confidence) > $avgConfessPercent) {
            $answer = $silent;
        } else {
            $answer = $confess;
        }

        return $answer;
    }

    /**
     * @param \PHPWeekly\Service\FileWhisperer $myFile
     * @param \PHPWeekly\Service\FileWhisperer $otherGuyFile
     * @return array
     */
    public function getScore(FileWhisperer $myFile, FileWhisperer $otherGuyFile)
    {

        $myFileArray = $myFile->explodeFile();
        $otherGuyFileArray = $otherGuyFile->explodeFile();
        $silent = self::SILENT;
        $confess = self::CONFESS;
        $myScore = 0;
        $otherGuyScore = 0;

        for ($i = 0; $i < $myFile->countFile(); $i++) {
            switch ($myFileArray[$i]) {
                case $silent:

                    switch ($otherGuyFileArray[$i]) {
                        case $silent:
                            $myScore = $myScore + 1;
                            $otherGuyScore = $otherGuyScore + 1;
                            break;
                        case $confess:
                            $myScore = $myScore + 3;
                            $otherGuyScore = $otherGuyScore + 0;
                            break;
                        default:
                            $myScore = $myScore + 0;
                            $otherGuyScore = $otherGuyScore + 0;
                            break;
                    }
                    break;

                case $confess:

                    switch ($otherGuyFileArray[$i]) {
                        case $silent:
                            $myScore = $myScore + 0;
                            $otherGuyScore = $otherGuyScore + 3;
                            break;
                        case $confess:
                            $myScore = $myScore + 2;
                            $otherGuyScore = $otherGuyScore + 2;
                            break;
                        default:
                            $myScore = $myScore + 0;
                            $otherGuyScore = $otherGuyScore + 0;
                            break;
                    }
                    break;

                default:
                    $myScore = $myScore + 0;
                    $otherGuyScore = $otherGuyScore + 0;
                    break;
            }
        }

        $scores = [$myScore, $otherGuyScore];
        return $scores;
    }

    /**
     * @param \PHPWeekly\Service\FileWhisperer $myFile
     * @param \PHPWeekly\Service\FileWhisperer $otherGuyFile
     * @return int
     */
    public function getX(FileWhisperer $myFile, FileWhisperer $otherGuyFile)
    {
        $scores = $this->getScore($myFile, $otherGuyFile);

        if ($scores[0] <= $scores[1]) {
            return 3;
        } else {
            return 2;
        }
    }

    /**
     * @param \PHPWeekly\Service\FileWhisperer $myFile
     * @param \PHPWeekly\Service\FileWhisperer $otherGuyFile
     * @return string
     */
    public function getAnswer(FileWhisperer $myFile, FileWhisperer $otherGuyFile)
    {
        $silent = self::SILENT;
        $confess = self::CONFESS;
        $x = $this->getX($myFile, $otherGuyFile);

        if ($otherGuyFile->countFile() <= 1) {
            return $silent;
        }

        if ($otherGuyFile->countFile() > 98) {
            return $confess;
        }

        if ($this->myLastAnswer == $silent && $this->otherGuyLastAnswer == $silent) {
            return $silent;
        }

        if ($this->myLastAnswer == $silent && $this->otherGuyLastAnswer == $confess) {
            $confidence = ($x - 1) / ((3 * $x) + 2);
            $answer = $this->getGreaterAvg($myFile, $confidence);

            return $answer;
        }

        if ($this->myLastAnswer == $confess && $this->otherGuyLastAnswer == $silent) {
            return $silent;
        }

        if ($this->myLastAnswer == $confess && $this->otherGuyLastAnswer == $confess) {
            $confidence = (2 * ($x - 1)) / ((3 * $x) + 2);
            $answer = $this->getGreaterAvg($myFile, $confidence);

            return $answer;
        }

        return $confess;
    }
}