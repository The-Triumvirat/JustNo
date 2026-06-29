<?php

use App\Models\NoReason;

test('the random no endpoint returns its public contract', function () {
    NoReason::create(['reason' => 'API reason']);
    $this->getJson('/api/v1/no')->assertOk()->assertJsonStructure(['id', 'reason']);
});

test('a no reason can be retrieved by id', function () {
    $noReason = NoReason::create(['reason' => 'Specific API reason']);

    $this->getJson('/api/v1/no/' . $noReason->id)->assertOk()->assertExactJson([
        'id' => $noReason->id,
        'reason' => 'Specific API reason',
    ]);
});

test('a missing no reason returns a json not found response', function () {
    $this->getJson('/api/v1/no/999999')->assertNotFound()->assertExactJson([
        'message' => 'No Reason not found',
        'id' => '999999',
    ]);
});

test('the no reason count endpoint returns the current count', function () {
    NoReason::insert([
        ['reason' => 'Counted reason one', 'created_at' => now(), 'updated_at' => now()],
        ['reason' => 'Counted reason two', 'created_at' => now(), 'updated_at' => now()],
    ]);

    $this->getJson('/api/v1/no/count')->assertOk()->assertExactJson(['count' => 2]);
});

test('the api health and status endpoints report an operational service', function () {
    $this->getJson('/api/v1/health')->assertOk()->assertJson(['status' => 'ok']);
    $this->getJson('/api/v1/status')->assertOk()->assertJson([
        'service' => 'JustNo',
        'status' => 'ok',
        'version' => 'v1',
        'db' => 'ok',
    ])->assertJsonStructure(['uptime', 'time']);
});

test('the tea endpoint remains a teapot', function () {
    $this->getJson('/api/v1/tea')->assertStatus(418)->assertJson([
        'id' => 42,
        'reason' => "Nope. I'm a teapot",
    ]);
});
