<?php

use App\Models\NoReason;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

test('no reasons are sorted by oldest first by default', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    NoReason::insert([
        [
            'reason' => 'Older default entry',
            'created_at' => now()->subDay(),
            'updated_at' => now()->subDay(),
        ],
        [
            'reason' => 'Newer default entry',
            'created_at' => now(),
            'updated_at' => now(),
        ],
    ]);

    $this
        ->actingAs($admin)
        ->get(route('backoffice.no-reasons.index'))
        ->assertOk()
        ->assertViewHas('sort', 'oldest')
        ->assertSeeInOrder(['Older default entry', 'Newer default entry']);
});

test('an admin can search no reasons', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    NoReason::create(['reason' => 'Unique searchable reason']);
    NoReason::create(['reason' => 'Completely different entry']);

    $this
        ->actingAs($admin)
        ->get(route('backoffice.no-reasons.index', ['search' => 'searchable']))
        ->assertOk()
        ->assertSee('Unique searchable reason')
        ->assertDontSee('Completely different entry');
});

test('an admin can sort no reasons', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    NoReason::create(['reason' => 'Alpha entry']);
    NoReason::create(['reason' => 'Zulu entry']);

    $this
        ->actingAs($admin)
        ->get(route('backoffice.no-reasons.index', ['sort' => 'alpha_desc']))
        ->assertOk()
        ->assertSeeInOrder(['Zulu entry', 'Alpha entry']);
});

test('an admin can select a supported page size', function (int $size) {
    $admin = User::factory()->create(['role' => 'admin']);
    NoReason::insert(
        collect(range(1, $size + 1))
            ->map(fn (int $number) => [
                'reason' => sprintf('Paginated reason %03d', $number),
                'created_at' => now(),
                'updated_at' => now(),
            ])
            ->all()
    );

    $this
        ->actingAs($admin)
        ->get(route('backoffice.no-reasons.index', ['per_page' => $size]))
        ->assertOk()
        ->assertViewHas(
            'noReasons',
            fn (LengthAwarePaginator $paginator) => $paginator->perPage() === $size
                && $paginator->count() === $size
                && $paginator->total() === $size + 1
        )
        ->assertViewHas('perPage', $size);
})->with([25, 50, 100]);

test('an unsupported page size falls back to 25', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this
        ->actingAs($admin)
        ->get(route('backoffice.no-reasons.index', ['per_page' => 500]))
        ->assertOk()
        ->assertViewHas('noReasons', fn (LengthAwarePaginator $paginator) => $paginator->perPage() === 25)
        ->assertViewHas('perPage', 25);
});
