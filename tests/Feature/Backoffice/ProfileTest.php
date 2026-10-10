<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;

test('profile uploads reject scripts and SVG even with image filenames', function (string $contents) {
    $admin = User::factory()->create(['role' => 'admin']);
    $temporary = tmpfile();
    fwrite($temporary, $contents);
    $file = new UploadedFile(stream_get_meta_data($temporary)['uri'], 'photo.png', null, null, true);

    $this->actingAs($admin)->post(route('backoffice.profile.store'), [
        'name' => $admin->name,
        'email' => $admin->email,
        'photo' => $file,
    ])->assertSessionHasErrors('photo');
    expect($admin->refresh()->photo)->toBeNull();
})->with([
    'PHP' => '<?php echo "unsafe"; ?>',
    'HTML' => '<html><script>alert(1)</script></html>',
    'SVG' => '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(1)</script></svg>',
]);

test('profile uploads reject images larger than two megabytes', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $png = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+jRZkAAAAASUVORK5CYII=');
    $file = UploadedFile::fake()->createWithContent('photo.png', $png.str_repeat('x', 2048 * 1024));

    $this->actingAs($admin)->post(route('backoffice.profile.store'), [
        'name' => $admin->name,
        'email' => $admin->email,
        'photo' => $file,
    ])->assertSessionHasErrors('photo');
    expect($admin->refresh()->photo)->toBeNull();
});

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
