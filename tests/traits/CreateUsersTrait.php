<?php

declare(strict_types=1);

namespace Tests\traits;


trait CreateUsersTrait
{
    /**
     * @param $count
     * @param array $attributes
     * @return array
     */
    public function createUsers(int $count, array $attributes = []): array
    {
//        parent::setUp();
        $users = [];
        for ($i = 0; $i < $count; $i++) {
            $users[] = factory(\News\User::class)->create($attributes);
        }
        return $users;
    }
}
