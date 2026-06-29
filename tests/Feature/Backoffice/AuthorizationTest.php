<?php

use App\Models\User;

test('guests are redirected to the backoffice login', function () {
    $this->get(route('backoffice.no-reasons.index'))->assertRedirect(route('backoffice.login'));
});

test('regular users cannot access the backoffice', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)->get(route('backoffice.no-reasons.index'))->assertRedirect(route('dashboard'));
});

test('admins can access the backoffice dashboard', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)->get(route('backoffice.dashboard'))->assertOk();
});
