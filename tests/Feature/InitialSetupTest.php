<?php

use App\Models\NoReason;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    config(['setup.admin_email' => 'owner@justno.test', 'setup.admin_password' => bin2hex(random_bytes(24))]);
});

test('initial setup creates an active admin with a hashed password and example reasons', function () {
    $this->seed();
    $admin = User::sole();
    expect($admin->role)->toBe('admin')
        ->and((bool) $admin->is_active)->toBeTrue()
        ->and(Hash::check(config('setup.admin_password'), $admin->password))->toBeTrue()
        ->and(NoReason::count())->toBe(10);

    $this->post(route('backoffice.login.store'), [
        'login' => $admin->email,
        'password' => config('setup.admin_password'),
    ])->assertRedirect(route('backoffice.dashboard'));
    $this->assertAuthenticatedAs($admin);
});

test('repeating initial setup does not duplicate data or reset the admin password', function () {
    $this->seed();
    $hash = User::sole()->password;
    config(['setup.admin_password' => bin2hex(random_bytes(24))]);
    $this->seed();
    expect(User::count())->toBe(1)
        ->and(User::sole()->password)->toBe($hash)
        ->and(NoReason::count())->toBe(10);
});

test('initial setup rejects missing or short passwords', function ($password) {
    config(['setup.admin_password' => $password]);
    expect(fn () => $this->seed())->toThrow(RuntimeException::class);
    expect(User::count())->toBe(0)->and(NoReason::count())->toBe(0);
})->with([null, 'robert.123']);

test('initial setup does not promote an existing regular user', function () {
    User::factory()->create(['email' => 'owner@justno.test', 'role' => 'user']);
    expect(fn () => $this->seed())->toThrow(RuntimeException::class);
    expect(User::sole()->role)->toBe('user');
});

test('production setup creates the configured admin without example reasons', function () {
    app()->instance('env', 'production');
    $this->artisan('db:seed', ['--force' => true])->assertSuccessful();
    expect(User::sole()->role)->toBe('admin')->and(NoReason::count())->toBe(0);
});
