<?php

use App\Models\User;

test('an authenticated admin can log out with a post request', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this
        ->actingAs($admin)
        ->post(route('backoffice.logout'))
        ->assertRedirect(route('backoffice.login'))
        ->assertSessionHas('success', 'You have been signed out.');

    $this->assertGuest();
});

test('the backoffice logout route rejects get requests', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this
        ->actingAs($admin)
        ->get(route('backoffice.logout'))
        ->assertMethodNotAllowed();

    $this->assertAuthenticatedAs($admin);
});
