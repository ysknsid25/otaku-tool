<?php

namespace App\Services\Programs;

use App\Models\Program;
use App\Models\Personality;
use App\Models\Notifyprogram;

class ProgramService
{
    /**
     * ログイン日付の番組を取得する
     * @param int $today
     * @param int $userid
     *
     * @return Program
     */
    public function getTodaysPrograms($today, $userid)
    {
        $results = Program::where('weekday', $today)->orderBy('begintime', 'asc')->get();
        $programs = $this->getOnAirInfo($results, $userid);
        return $programs;
    }

    /**
     * 画面上で選択されたレコードのうち、未選択のものを登録する
     *
     * @param int $userid
     * @param array $programids
     * @return void
     */
    public function notifyTargetFirstOrCreate($userid, $programids, $targetDay)
    {
        $notifyProgramModel = new Notifyprogram();
        //元々の通知対象として選択していたが、画面では選択されていない番組を削除する
        $programsAlreadySelected = $notifyProgramModel->userSelectedDailyProgram($userid, $targetDay);
        foreach ($programsAlreadySelected as $program) {
            if (!in_array($program->id, $programids)) {
                $notifyProgram = $notifyProgramModel->where('users_id', $userid)->where('programs_id', $program->id)->first();
                $notifyProgram->delete();
            }
        }

        //画面で選択された番組を通知対象として登録する
        foreach ($programids as $programid) {
            $search = ['users_id' => $userid, 'programs_id' => $programid];
            $create = $search;
            $notifyProgramModel->firstOrCreate(
                $search,
                $create
            );
        }
    }

    /**
     * 番組情報を取得する
     *
     * @param array $results
     * @param int $userid
     * @return array
     */
    private function getOnAirInfo($results, $userid)
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

            $notifyProgramModel = new Notifyprogram();
            $notifyProgram = $notifyProgramModel->where('users_id', $userid)->where('programs_id', $result->id)->first();
            if (!is_null($notifyProgram)) {
                $program->setIsNotifyTarget(true);
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
