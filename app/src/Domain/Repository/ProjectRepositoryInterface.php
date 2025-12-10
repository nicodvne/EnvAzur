<?php

namespace Domain\Repository;

use Domain\Entity\Project;

interface ProjectRepositoryInterface
{
    //public function findById(int $id): Project;
    public function save(Project $project): void;
}
