<?php

use App\Models\User;

test('an admin can view their backoffice profile', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this
        ->actingAs($admin)
        ->get(route('backoffice.profile'))
        ->assertOk()
        ->assertSee($admin->name)
        ->assertSee($admin->email);
});

test('an admin can update their profile', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this
        ->actingAs($admin)
        ->from(route('backoffice.profile'))
        ->post(route('backoffice.profile.store'), [
            'name' => 'Updated Admin',
            'email' => 'updated@example.com',
            'phone' => '+49 987 654321',
            'address' => 'Example Street 12',
        ])
        ->assertSessionHasNoErrors()
        ->assertSessionHas('success', 'Profile updated successfully.')
        ->assertRedirect(route('backoffice.profile'));

    expect($admin->refresh())
        ->name->toBe('Updated Admin')
        ->email->toBe('updated@example.com')
        ->phone->toBe('+49 987 654321')
        ->address->toBe('Example Street 12');
});

test('a profile email must be unique', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $otherUser = User::factory()->create();

    $this
        ->actingAs($admin)
        ->from(route('backoffice.profile'))
        ->post(route('backoffice.profile.store'), [
            'name' => $admin->name,
            'email' => $otherUser->email,
        ])
        ->assertSessionHasErrors('email')
        ->assertRedirect(route('backoffice.profile'));

    expect($admin->refresh()->email)->not->toBe($otherUser->email);
});
