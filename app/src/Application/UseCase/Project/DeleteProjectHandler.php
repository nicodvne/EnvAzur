<?php

namespace Application\UseCase\Project;

use Domain\Repository\ProjectRepositoryInterface;

class DeleteProjectHandler
{
    public function __construct(
        private ProjectRepositoryInterface $projectRepository,
    ){}

    public function handle(int $projectId): void
    {
        $this->projectRepository->deleteById($projectId);
    }
}
