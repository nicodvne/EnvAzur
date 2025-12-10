<?php

namespace Domain\Entity;

class Variable
{
    public function __construct(
        private string $varKey,
        private string $varValue,
        private Project $project,
    ) {}

    public function getVarKey(): string
    {
        return $this->varKey;
    }

    public function getVarValue(): string
    {
        return $this->varValue;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    public function changeVarValue(string $varValue): void
    {
        $this->varValue = $varValue;
    }
}
