<?php

use App\Models\User;

test('A&G Notify page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/programs');

    $response->assertOk();
});
