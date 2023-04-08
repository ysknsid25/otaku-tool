<?php

namespace App\Services\Programs;

use App\Models\Program;
use App\Models\Personality;


class ProgramService
{
    /**
     * ログイン日付の番組を取得する
     *
     * @return Program
     */
    public function getTodaysPrograms($today)
    {
        $results = Program::where('weekday', $today)->orderBy('begintime', 'asc')->get();
        $programs = $this->getOnAirInfo($results);
        return $programs;
    }

    /**
     * 番組情報を取得する
     *
     * @param array $results
     * @return array
     */
    private function getOnAirInfo($results)
    {
        $programs = array();
        foreach ($results as $result) {
            $program = new ProgramData();
            $program->setId($result->id);
            $program->setProgramNm($result->programnm);
            $program->setWeekday($result->weekday);
            $program->setOnAirTime($result->begintime, $result->endtime);

            $personality = new Personality();
            $actors = $personality->actors($result->id);
            foreach ($actors as $actor) {
                $program->setPersonalities($actor->name);
            }
            $programs[] = $program;
        }
        return $programs;
    }

    /**
     * 曜日を返す
     *
     * @return array
     */
    public function getWeekDays()
    {
        $weekDays = ["0" => "MonDay", "1" => "Tuesday", "2" => "Wednesday", "3" => "Thursday", "4" => "FriDay", "5" => "Saturday", "6" => "SunDay"];
        return $weekDays;
    }

    /**
     * 今日の曜日を返す
     * バッチは0が月曜日で6が日曜日なので、1を引く。負数は6にする
     *
     * @return int
     */
    public function getTargetDay()
    {
        $today = date('w');
        $today = ($today - 1);
        if ($today < 0) {
            $today = 6;
        }
        return $today;
    }
}
