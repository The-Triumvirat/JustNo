<?php

use App\Models\NoReason;
use App\Models\User;
use Illuminate\Http\UploadedFile;

test('an admin can create a no reason', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this
        ->actingAs($admin)
        ->post(route('backoffice.no-reasons.store'), ['reason' => 'A newly created reason'])
        ->assertRedirect(route('backoffice.no-reasons.index'))
        ->assertSessionHas('success', 'No Reason created successfully.');

    $this->assertDatabaseHas('no_reasons', ['reason' => 'A newly created reason']);
});

test('a no reason is required and limited to 512 characters', function (string $reason) {
    $admin = User::factory()->create(['role' => 'admin']);

    $this
        ->actingAs($admin)
        ->from(route('backoffice.no-reasons.create'))
        ->post(route('backoffice.no-reasons.store'), ['reason' => $reason])
        ->assertSessionHasErrors('reason')
        ->assertRedirect(route('backoffice.no-reasons.create'));
})->with([
    'empty' => '',
    'too long' => fn () => str_repeat('a', 513),
]);

test('duplicate no reasons are rejected with a validation error', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    NoReason::create(['reason' => 'Existing reason']);

    $this
        ->actingAs($admin)
        ->post(route('backoffice.no-reasons.store'), ['reason' => 'Existing reason'])
        ->assertSessionHasErrors('reason');

    expect(NoReason::where('reason', 'Existing reason')->count())->toBe(1);
});

test('an admin can export no reasons as json', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    NoReason::create(['reason' => 'First exported reason']);
    NoReason::create(['reason' => 'Second exported reason']);

    $response = $this
        ->actingAs($admin)
        ->get(route('backoffice.no-reasons.export'))
        ->assertOk()
        ->assertHeader('content-type', 'application/json');

    expect($response->json())->toBe(['First exported reason', 'Second exported reason']);
});

test('an admin can import valid unique reasons from json', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    NoReason::create(['reason' => 'Existing import reason']);
    $file = UploadedFile::fake()->createWithContent('reasons.json', json_encode([
        'First imported reason',
        'Second imported reason',
        'Existing import reason',
        '',
        ['invalid nested value'],
        str_repeat('a', 513),
    ], JSON_THROW_ON_ERROR));

    $this
        ->actingAs($admin)
        ->from(route('backoffice.no-reasons.import.no.reasons'))
        ->post(route('backoffice.no-reasons.import.store'), ['file' => $file])
        ->assertSessionHasNoErrors()
        ->assertSessionHas('success', 'Import abgeschlossen - Importiert: 2 | Übersprungen: 4')
        ->assertRedirect(route('backoffice.no-reasons.import.no.reasons'));

    $this->assertDatabaseHas('no_reasons', ['reason' => 'First imported reason']);
    $this->assertDatabaseHas('no_reasons', ['reason' => 'Second imported reason']);
    expect(NoReason::count())->toBe(3);
});

test('malformed json is rejected without importing data', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $file = UploadedFile::fake()->createWithContent('reasons.json', '{invalid-json');

    $this
        ->actingAs($admin)
        ->post(route('backoffice.no-reasons.import.store'), ['file' => $file])
        ->assertSessionHas('error', 'JSON konnte nicht gelesen werden.');

    expect(NoReason::count())->toBe(0);
});

test('missing no reasons return a not found response', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)->get(route('backoffice.no-reasons.edit', 999999))->assertNotFound();
});
