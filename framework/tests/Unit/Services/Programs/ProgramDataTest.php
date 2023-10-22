<?php

use App\Services\Programs\ProgramData;

test('ProgramData returns valid weekday', function () {
    $expect = 1;

    //準備
    $programData = new ProgramData();
    $programData->setWeekday($expect);

    //実行
    $actual = $programData->getWeekday();

    //検証
    expect($actual)->toBe($expect);
});
