<?php

use App\Services\Programs\OnAirTimeService;

test('OnAirTime Is Valid', function () {
    $sut = new OnAirTimeService();
    $exp = '19:00-20:00';
    $act = $sut->getOnAirTime(1900, 2000);
    expect($act === $exp)->toBeTrue();
});

test('padding Zero', function () {
    $sut = new OnAirTimeService();
    $exp = '0900';
    $act = $sut->paddingZero(900);
    expect($act === $exp)->toBeTrue();
});

test('padding Zero when empty', function () {
    $sut = new OnAirTimeService();
    $exp = '';
    $act = $sut->paddingZero(0);
    expect($act === $exp)->toBeTrue();
});

test('is inserted colon', function () {
    //! privateメソッドのテスト
    $sut = new OnAirTimeService();
    $reflection = new \ReflectionClass($sut);
    $method = $reflection->getMethod('addColon');
    $method->setAccessible(true);
    $act = $method->invoke($sut, '0900');
    $exp = '09:00';
    expect($act === $exp)->toBeTrue();
});

test('is inserted colon when empty', function () {
    //! privateメソッドのテスト
    $sut = new OnAirTimeService();
    $reflection = new \ReflectionClass($sut);
    $method = $reflection->getMethod('addColon');
    $method->setAccessible(true);
    $act = $method->invoke($sut, '');
    $exp = '';
    expect($act === $exp)->toBeTrue();
});
