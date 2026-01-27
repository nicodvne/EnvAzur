<?php

namespace Domain\Repository;

use Domain\Entity\Variable;

interface VariableRepositoryInterface
{
    public function save(Variable $variable): void;
}
