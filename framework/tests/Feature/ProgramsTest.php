<?php

use App\Models\Actor;
use App\Models\Notifyprogram;
use App\Models\Personality;
use App\Models\Program;
use App\Models\User;
use App\Services\Programs\ProgramService;

test('A&G Notify page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/programs');

    $response->assertOk();
});

test('A&G Notify program is displayed', function () {
    $programService = new ProgramService();
    $weekDay = $programService->getTargetDay();
    $user = User::factory()->create();
    $progarm = Program::create(
        [
            'programnm' => 'Melody Flag',
            'begintime' => 900,
            'endtime' => 1000,
            'weekday' => $weekDay,
        ],
    );
    $actor = Actor::create(
        [
            'name' => '水瀬いのり',
        ]
    );
    $personality = Personality::create(
        [
            'actors_id' => $actor->id,
            'programs_id' => $progarm->id,
        ]
    );
    $response = $this
        ->actingAs($user)
        ->get('/programs');

    $response->assertSee('Melody Flag');
    $response->assertSee('水瀬いのり');
    $response->assertSee('09:00-10:00');
});

test('A&G Notify program is displayed when search', function () {
    $programService = new ProgramService();
    //翌日を基準にする
    $weekDay = ($programService->getTargetDay() + 1) % 7;
    $user = User::factory()->create();
    $progarm = Program::create(
        [
            'programnm' => 'ひだかくま',
            'begintime' => 2300,
            'endtime' => 2330,
            'weekday' => $weekDay,
        ],
    );
    $tyanrina = Actor::create(
        [
            'name' => '日高里菜',
        ]
    );
    $kumasan = Actor::create(
        [
            'name' => '加隈亜衣',
        ]
    );
    $personalityRina = Personality::create(
        [
            'actors_id' => $tyanrina->id,
            'programs_id' => $progarm->id,
        ]
    );
    $personalityKuma = Personality::create(
        [
            'actors_id' => $kumasan->id,
            'programs_id' => $progarm->id,
        ]
    );
    $response = $this
        ->actingAs($user)
        ->post('/programs', [
            'targetDay' => $weekDay,
        ]);

    $response->assertSee('ひだかくま');
    // $response->assertSee('日高里菜, 加隈亜衣');
    $response->assertSee('23:00-23:30');
});

test('is Notify target registerd', function () {
    $programService = new ProgramService();
    $weekDay = $programService->getTargetDay();
    $user = User::factory()->create();
    $progarm = Program::create(
        [
            'programnm' => 'Melody Flag',
            'begintime' => 900,
            'endtime' => 1000,
            'weekday' => $weekDay,
        ],
    );
    $actor = Actor::create(
        [
            'name' => '水瀬いのり',
        ]
    );
    $personality = Personality::create(
        [
            'actors_id' => $actor->id,
            'programs_id' => $progarm->id,
        ]
    );
    $response = $this
        ->actingAs($user)
        ->patch('/programs', [
            'programs' => [$progarm->id],
            'hidTargetDay' => strval($weekDay),
        ]);

    $notifyProgram = Notifyprogram::where('programs_id', $progarm->id)->where('users_id', $user->id)->first();
    $this->assertNotNull($notifyProgram);
});

test('is Notify target deleted', function () {
    $programService = new ProgramService();
    $weekDay = $programService->getTargetDay();
    $user = User::factory()->create();
    $progarm = Program::create(
        [
            'programnm' => 'Melody Flag',
            'begintime' => 900,
            'endtime' => 1000,
            'weekday' => $weekDay,
        ],
    );
    $actor = Actor::create(
        [
            'name' => '水瀬いのり',
        ]
    );
    $personality = Personality::create(
        [
            'actors_id' => $actor->id,
            'programs_id' => $progarm->id,
        ]
    );
    $response = $this
        ->actingAs($user)
        ->patch('/programs', [
            'programs' => [$progarm->id],
            'hidTargetDay' => strval($weekDay),
        ]);

    $response = $this
        ->actingAs($user)
        ->patch('/programs', [
            'programs' => [],
            'hidTargetDay' => strval($weekDay),
        ]);

    $notifyProgram = Notifyprogram::where('programs_id', $progarm->id)->where('users_id', $user->id)->first();
    $this->assertNull($notifyProgram);
});
