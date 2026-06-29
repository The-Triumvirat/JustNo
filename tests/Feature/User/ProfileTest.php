<?php

use App\Models\User;

test('the user profile page can be rendered', function () {
    $user = User::factory()->create(['role' => 'user']);
    $this->actingAs($user)->get(route('profile.edit'))->assertOk()->assertSee($user->email);
});

test('user profile information can be updated', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this
        ->actingAs($user)
        ->patch(route('profile.update'), [
            'name' => 'Updated User',
            'email' => 'updated-user@example.com',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('profile.edit'));

    expect($user->refresh())
        ->name->toBe('Updated User')
        ->email->toBe('updated-user@example.com')
        ->email_verified_at->toBeNull();
});

test('email verification status remains when the email is unchanged', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)->patch(route('profile.update'), [
        'name' => 'Updated User',
        'email' => $user->email,
    ])->assertSessionHasNoErrors();

    expect($user->refresh()->email_verified_at)->not->toBeNull();
});

test('a user can delete their account', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this
        ->actingAs($user)
        ->delete(route('profile.destroy'), ['password' => 'password'])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('home'));

    $this->assertGuest();
    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});

test('the correct password is required to delete an account', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this
        ->actingAs($user)
        ->from(route('profile.edit'))
        ->delete(route('profile.destroy'), ['password' => 'wrong-password'])
        ->assertSessionHasErrorsIn('userDeletion', 'password')
        ->assertRedirect(route('profile.edit'));

    $this->assertDatabaseHas('users', ['id' => $user->id]);
});
