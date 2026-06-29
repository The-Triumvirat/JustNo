<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('a user can update their password', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this
        ->actingAs($user)
        ->from(route('profile.edit'))
        ->put(route('password.update'), [
            'current_password' => 'password',
            'password' => 'new-secure-password',
            'password_confirmation' => 'new-secure-password',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('profile.edit'));

    expect(Hash::check('new-secure-password', $user->refresh()->password))->toBeTrue();
});

test('the current password is required for a user password update', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this
        ->actingAs($user)
        ->from(route('profile.edit'))
        ->put(route('password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'new-secure-password',
            'password_confirmation' => 'new-secure-password',
        ])
        ->assertSessionHasErrorsIn('updatePassword', 'current_password')
        ->assertRedirect(route('profile.edit'));

    expect(Hash::check('password', $user->refresh()->password))->toBeTrue();
});
