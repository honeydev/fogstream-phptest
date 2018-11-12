<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\traits\CreateUsersTrait;

class RegisterApiTest extends TestCase
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
