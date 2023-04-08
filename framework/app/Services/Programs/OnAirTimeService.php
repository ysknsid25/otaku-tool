<?php

namespace App\Services\Programs;

class OnAirTimeService
{
    /**
     * 数字型で登録された時間を文字列型に変換する。
     * その際、3桁以下の場合は先頭に0を付与する。
     *
     * @param int $beginTime
     * @param int $endTime
     * @return string
     */
    public function getOnAirTime($beginTime, $endTime)
    {
        $strBeginTime = $this->paddingZero($beginTime);
        $strBeginTime = $this->addColon($strBeginTime);

        $strEndTime = $this->paddingZero($endTime);
        $strEndTime = $this->addColon($strEndTime);

        $onAirTime = $strBeginTime . "-" . $strEndTime;
        return $onAirTime;
    }

    /**
     * 0埋めを行う
     *
     * @param int $time
     * @return void
     */
    public function paddingZero($time)
    {
        if (empty($time)) {
            return "";
        }
        if ($time < 1000) {
            $time = "0" . $time;
        }
        return $time;
    }

    /**
     * コロン付きの時刻を返す
     *
     * @param string $time
     * @return string
     */
    private function addColon($time)
    {
        if (empty($time)) {
            return "";
        }
        $hour = substr($time, 0, 2);
        $minute = substr($time, -2);
        return $hour . ":" . $minute;
    }
}
