<?php

namespace Application\Service\User;

use Domain\Entity\User;
use Infrastructure\Mapper\User\UserMapper;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordChecker
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ){}

    public function verifyPassword(User $user, string $password): bool
    {
        $persistenceUser = UserMapper::toPersistence($user);

        if (!$persistenceUser) {
            return false;
        }

        return $this->passwordHasher->isPasswordValid($persistenceUser, $password);
    }
}
