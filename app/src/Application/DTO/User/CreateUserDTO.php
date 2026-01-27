<?php

namespace Application\DTO\User;

class CreateUserDTO
{
    public string $username;
    public string $email;
    public string $password;
    public array $projects;
    public array $roles;
}
