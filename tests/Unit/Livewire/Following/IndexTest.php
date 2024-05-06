<?php

declare(strict_types=1);

use App\Livewire\Following\Index;
use App\Models\User;
use Livewire\Livewire;

test('render', function () {
    $user = User::factory()->create();

    $component = Livewire::actingAs($user)->test(Index::class, [
        'userId' => $user->id,
    ]);

    $component->assertOk();
});

test('render with following', function () {
    $user = User::factory()->create();
    $following = User::factory(10)->create();

    $user->following()->sync($following->pluck('id'));

    $component = Livewire::actingAs($user)->test(Index::class, [
        'userId' => $user->id,
    ]);

    $component->set('isOpened', true);

    $component->refresh();

    $following->each(function (User $user) use ($component): void {
        $component->assertSee($user->name);
    });
});
