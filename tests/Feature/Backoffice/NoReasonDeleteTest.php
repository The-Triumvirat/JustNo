<?php

use App\Models\NoReason;
use App\Models\User;

test('the delete action opens the custom confirmation dialog', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $noReason = NoReason::create(['reason' => 'A reason shown in the dialog']);

    $this
        ->actingAs($admin)
        ->get(route('backoffice.no-reasons.index'))
        ->assertOk()
        ->assertSee('role="dialog"', false)
        ->assertSee(route('backoffice.no-reasons.destroy', $noReason), false)
        ->assertDontSee('confirm(', false);
});

test('an admin can delete a no reason', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $noReason = NoReason::create(['reason' => 'A reason to delete']);

    $response = $this
        ->actingAs($admin)
        ->delete(route('backoffice.no-reasons.destroy', $noReason));

    $response
        ->assertRedirect(route('backoffice.no-reasons.index'))
        ->assertSessionHas('success', 'No Reason deleted successfully.');

    $this->assertDatabaseMissing('no_reasons', ['id' => $noReason->id]);
});

test('a no reason cannot be deleted with a get request', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $noReason = NoReason::create(['reason' => 'A reason to keep']);

    $this
        ->actingAs($admin)
        ->get(route('backoffice.no-reasons.destroy', $noReason))
        ->assertMethodNotAllowed();

    $this->assertDatabaseHas('no_reasons', ['id' => $noReason->id]);
});
