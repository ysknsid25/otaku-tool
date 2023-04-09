<?php

use App\Services\Programs\ProgramService;

test('get WeekDays Are Valid', function () {
    $sut = new ProgramService();
    $exp = ["0" => "MonDay", "1" => "Tuesday", "2" => "Wednesday", "3" => "Thursday", "4" => "FriDay", "5" => "Saturday", "6" => "SunDay"];
    $act = $sut->getWeekDays();
    expect($act === $exp)->toBeTrue();
});

test('getTargetDay is Valid', function () {
    $sut = new ProgramService();
    $exp = date('w');
    $exp = ($exp - 1);
    if ($exp < 0) {
        $exp = 6;
    }
    $act = $sut->getTargetDay();
    expect($act === $exp)->toBeTrue();
});
