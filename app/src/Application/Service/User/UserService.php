<?php

namespace Application\Service\User;

use Application\DTO\User\CreateUserDTO;
use Application\Utils\Utils;
use Infrastructure\Doctrine\Repository\User\UserRepository;

class UserService {

    public function __construct(
        private Utils $utils
    ) {}

    public function buildUserDTO(array $payload): CreateUserDTO {
        $dto = new CreateUserDTO();
        $dto->email = $payload['email'];
        $dto->password = $payload['password'];
        $dto->username = $payload['username'];

        return $dto;
    }

    public function createRequestHasRequiredData(array $payload): bool 
    {
        return $this->utils->arrayHas($payload, 'email') &&
            $this->utils->arrayHas($payload, 'password') &&
            $this->utils->arrayHas($payload, 'username');
    }
}
