<?php

use Laravel\Fortify\Features;

beforeEach(function () {
    $this->skipUnlessFortifyHas(Features::registration());
    $this->seed();
});

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertOk();
});

test('new users can register', function () {
    $response = $this->post(route('register.store'), [
        'name' => 'John Doe',
        'email' => 'test@example.com',
        'library_name' => 'Test Library',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    $this->assertAuthenticated();
});