<?php

use App\Models\NoReason;
use App\Models\User;

test('the create page renders the shared form', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this
        ->actingAs($admin)
        ->get(route('backoffice.no-reasons.create'))
        ->assertOk()
        ->assertSee(route('backoffice.no-reasons.store'), false)
        ->assertSee('maxlength="512"', false)
        ->assertSee('Create Reason');
});

test('the edit page renders the shared form with the current value', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $noReason = NoReason::create(['reason' => 'Current reason']);

    $this
        ->actingAs($admin)
        ->get(route('backoffice.no-reasons.edit', $noReason))
        ->assertOk()
        ->assertSee(route('backoffice.no-reasons.update', $noReason), false)
        ->assertSee('name="_method" value="PATCH"', false)
        ->assertSee('Current reason')
        ->assertSee('Save Changes');
});

test('an admin can update a no reason with a patch request', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $noReason = NoReason::create(['reason' => 'Old reason']);

    $this
        ->actingAs($admin)
        ->patch(route('backoffice.no-reasons.update', $noReason), [
            'reason' => 'Updated reason',
        ])
        ->assertRedirect(route('backoffice.no-reasons.index'))
        ->assertSessionHas('success', 'No Reason updated successfully.');

    expect($noReason->refresh()->reason)->toBe('Updated reason');
});
