<?php

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Event;

test('the backoffice login screen can be rendered', function () {
    $this->get(route('backoffice.login'))->assertOk()->assertSee('Backoffice Login');
});

test('an active admin can authenticate with email name or phone', function (string $attribute) {
    $admin = User::factory()->create([
        'role' => 'admin',
        'phone' => '+49 123 456789',
    ]);

    $this
        ->post(route('backoffice.login.store'), [
            'login' => $admin->{$attribute},
            'password' => 'password',
        ])
        ->assertRedirect(route('backoffice.dashboard'))
        ->assertSessionHas('info', 'Welcome back, ' . $admin->name . '.');

    $this->assertAuthenticatedAs($admin);
})->with(['email', 'name', 'phone']);

test('a regular user is redirected to the user dashboard after login', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this
        ->post(route('backoffice.login.store'), [
            'login' => $user->email,
            'password' => 'password',
        ])
        ->assertRedirect(route('dashboard'));

    $this->assertAuthenticatedAs($user);
});

test('invalid credentials do not authenticate a user', function () {
    $user = User::factory()->create();

    $this
        ->post(route('backoffice.login.store'), [
            'login' => $user->email,
            'password' => 'wrong-password',
        ])
        ->assertSessionHasErrors('login');

    $this->assertGuest();
});

test('inactive users cannot authenticate', function () {
    $user = User::factory()->create(['is_active' => false]);

    $this
        ->post(route('backoffice.login.store'), [
            'login' => $user->email,
            'password' => 'password',
        ])
        ->assertSessionHasErrors('login');

    $this->assertGuest();
});

test('login attempts are rate limited', function () {
    Event::fake([Lockout::class]);
    $user = User::factory()->create();

    foreach (range(1, 5) as $attempt) {
        $this->post(route('backoffice.login.store'), [
            'login' => $user->email,
            'password' => 'wrong-password',
        ]);
    }

    $this
        ->post(route('backoffice.login.store'), [
            'login' => $user->email,
            'password' => 'wrong-password',
        ])
        ->assertSessionHasErrors('login');

    $this->assertGuest();
    Event::assertDispatched(Lockout::class);
});

test('an authenticated admin is redirected away from guest auth pages', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this
        ->actingAs($admin)
        ->get(route('backoffice.login'))
        ->assertRedirect(route('backoffice.dashboard'));
});

test('an authenticated user can log out', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this
        ->actingAs($user)
        ->post(route('logout'))
        ->assertRedirect(route('backoffice.login'));

    $this->assertGuest();
});
