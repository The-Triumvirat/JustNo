<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('setup.admin_email');
        if (! is_string($email) || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException('INITIAL_ADMIN_EMAIL must be a valid email address.');
        }

        $existing = User::where('email', $email)->first();
        if ($existing) {
            if ($existing->role !== 'admin' || ! $existing->is_active) {
                throw new RuntimeException('The initial admin email belongs to a non-admin or inactive account.');
            }

            return;
        }

        $password = config('setup.admin_password');
        if (! is_string($password) || strlen($password) < 24) {
            throw new RuntimeException('Set INITIAL_ADMIN_PASSWORD to a randomly generated password of at least 24 characters.');
        }

        $admin = new User;
        $admin->name = 'JustNo Owner';
        $admin->email = $email;
        $admin->password = $password;
        $admin->role = 'admin';
        $admin->is_active = true;
        $admin->save();
    }
}
