<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

test('an admin can render the change password screen', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this
        ->actingAs($admin)
        ->get(route('backoffice.change.password'))
        ->assertOk()
        ->assertSee(route('backoffice.profile.password.update'), false);
});

test('an admin can change their password', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this
        ->actingAs($admin)
        ->from(route('backoffice.change.password'))
        ->post(route('backoffice.profile.password.update'), [
            'old_password' => 'password',
            'new_password' => 'new-secure-password',
            'new_password_confirmation' => 'new-secure-password',
        ])
        ->assertSessionHasNoErrors()
        ->assertSessionHas('success', 'Password changed successfully.')
        ->assertRedirect(route('backoffice.change.password'));

    expect(Hash::check('new-secure-password', $admin->refresh()->password))->toBeTrue();
});

test('the current password is required to change a password', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this
        ->actingAs($admin)
        ->from(route('backoffice.change.password'))
        ->post(route('backoffice.profile.password.update'), [
            'old_password' => 'wrong-password',
            'new_password' => 'new-secure-password',
            'new_password_confirmation' => 'new-secure-password',
        ])
        ->assertSessionHasErrors('old_password')
        ->assertRedirect(route('backoffice.change.password'));

    expect(Hash::check('password', $admin->refresh()->password))->toBeTrue();
});
