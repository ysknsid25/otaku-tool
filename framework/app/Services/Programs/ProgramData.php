<?php

namespace App\Services\Programs;

class ProgramData
{
    private $id = 0;
    private $programnm = '';
    private $weekday = 0;
    private $onAirTime = '';
    private $personalities = [];
    private $onAirTimeService = null;
    private $isNofityTarget = false;

    public function __construct()
    {
        $this->onAirTimeService = new OnAirTimeService();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setProgramNm($programnm)
    {
        $this->programnm = $programnm;
    }

    public function getPrgoramNm()
    {
        return $this->programnm;
    }

    public function setWeekday($weekday)
    {
        $this->weekday = $weekday;
    }

    public function getWeekday()
    {
        return $this->weekday;
    }

    public function setOnAirTime($begintime, $endtime)
    {
        $this->onAirTime = $this->onAirTimeService->getOnAirTime($begintime, $endtime);
    }

    public function getOnAirTime()
    {
        return $this->onAirTime;
    }

    public function setPersonalities($personality)
    {
        $this->personalities[] = $personality;
    }

    public function getPersonalities()
    {
        return join(', ', $this->personalities);
    }

    public function setIsNotifyTarget($isNotifyTarget)
    {
        $this->isNofityTarget = $isNotifyTarget;
    }

    public function isNotifyTarget()
    {
        return $this->isNofityTarget;
    }
}
