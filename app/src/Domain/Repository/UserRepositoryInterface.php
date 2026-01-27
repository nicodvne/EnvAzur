<?php

namespace Domain\Repository;

use Domain\Entity\User;

interface UserRepositoryInterface
{
    public function createUser(User $user): void;

    public function getUserByEmail(string $email): ?User;
}
