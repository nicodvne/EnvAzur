<?php

namespace Domain\Repository;

use Domain\Entity\Variable;

interface VariableRepositoryInterface
{
    public function findByKey(string $varKey): Variable;

    public function findByProjectAndKey(int $projectId, string $varKey): Variable;

    public function findAllByProject(int $projectId): array;

    public function save(Variable $variable): void;
}
