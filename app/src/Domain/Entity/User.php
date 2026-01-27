<?php

namespace Domain\Entity;

class User {
    private string $username;
    private string $email;
    private string $password;
    private array $projects;
    private array $roles;

    public function __construct(string $username, string $email, string $password) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->projects = [];
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getProjects(): array {
        return $this->projects;
    }

    public function getRoles(): array {
        return $this->roles;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function addProject(Project $project): void {
        $this->projects[] = $project;
    }

    public function addRole(string $role): void {
        $this->roles[] = $role;
    }
}
