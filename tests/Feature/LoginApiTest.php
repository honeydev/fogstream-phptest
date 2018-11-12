<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\traits\CreateUsersTrait;

class LoginApiTest extends TestCase
{
    use DatabaseMigrations;
    use CreateUsersTrait;

    public function testLoginSuccess()
    {
        /**
         * TODO implement
         */
    }
}
