<?php

namespace Domain\Repository;

use Domain\Entity\Project;

interface ProjectRepositoryInterface
{
    public function save(Project $project): void;

    public function delete(Project $project): void;

    public function deleteBySlug(string $projectSlug): void;
}
