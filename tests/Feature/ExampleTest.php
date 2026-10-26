<?php

use Illuminate\Support\Facades\Route;

it('redirects the home page to login', function () {
    $response = $this->get('/');

    $response->assertRedirect('/login');
});
