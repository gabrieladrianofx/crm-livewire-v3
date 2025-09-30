<?php

use App\Livewire\Auth\Register;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

pest()->use(RefreshDatabase::class);

it('should render the component', function () {
    Livewire::test(Register::class)
        ->assertOk();
});

it('should be able to register a new user in the system', function () {
    Livewire::test(Register::class)
        ->set('name', 'Joe doe')
        ->set('email', 'joe@doe.com')
        ->set('email_confirmation', 'joe@doe.com')
        ->set('password', 'password')
        ->call('submit')
        ->assertHasNoErrors();

    $this->assertDatabaseHas(
        'users',
        [
            'name'  => 'Joe doe',
            'email' => 'joe@doe.com',
        ]
    );

    $this->assertDatabaseCount('users', 1);
});
