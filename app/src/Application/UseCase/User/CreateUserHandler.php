<?php

namespace Application\UseCase\User;

use Application\DTO\User\CreateUserDTO;
use Domain\Entity\User;
use Infrastructure\Doctrine\Repository\User\UserRepository;

class CreateUserHandler {
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function handle(CreateUserDTO $dto): User
    {
        $user = new User($dto->username, $dto->email, $dto->password);

        $this->userRepository->createUser($user);

        return $user;
    }
}
