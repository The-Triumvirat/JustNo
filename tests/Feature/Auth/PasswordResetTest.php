<?php

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset as PasswordResetEvent;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

test('the backoffice forgot password screen can be rendered', function () {
    $this->get(route('backoffice.password.request'))->assertOk()->assertSee('Email Password Reset Link');
});

test('a password reset link can be requested', function () {
    Notification::fake();
    $user = User::factory()->create();

    $this
        ->post(route('backoffice.password.email.store'), ['email' => $user->email])
        ->assertSessionHasNoErrors()
        ->assertSessionHas('status');

    Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification) use ($user) {
        $expectedUrl = route('backoffice.password.reset', [
            'token' => $notification->token,
            'email' => $user->email,
        ]);

        return $notification->toMail($user)->actionUrl === $expectedUrl;
    });
});

test('the backoffice reset password screen can be rendered', function () {
    $user = User::factory()->create();
    $token = Password::createToken($user);

    $this
        ->get(route('backoffice.password.reset', ['token' => $token, 'email' => $user->email]))
        ->assertOk()
        ->assertSee($user->email)
        ->assertSee('Reset password');
});

test('a password can be reset with a valid token', function () {
    Event::fake([PasswordResetEvent::class]);
    $user = User::factory()->create();
    $token = Password::createToken($user);

    $this
        ->post(route('backoffice.password.update'), [
            'token' => $token,
            'email' => $user->email,
            'password' => 'new-secure-password',
            'password_confirmation' => 'new-secure-password',
        ])
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('backoffice.login'));

    expect(Hash::check('new-secure-password', $user->refresh()->password))->toBeTrue();
    Event::assertDispatched(PasswordResetEvent::class);
});

test('an invalid token cannot reset a password', function () {
    $user = User::factory()->create();

    $this
        ->post(route('backoffice.password.update'), [
            'token' => 'invalid-token',
            'email' => $user->email,
            'password' => 'new-secure-password',
            'password_confirmation' => 'new-secure-password',
        ])
        ->assertSessionHasErrors('email');

    expect(Hash::check('password', $user->refresh()->password))->toBeTrue();
});
