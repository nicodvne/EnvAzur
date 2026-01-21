<?php

namespace Application\UseCase\Project;

use Application\DTO\Project\CreateProjectDTO;
use Domain\Entity\Project;
use Domain\Repository\ProjectRepositoryInterface;

class CreateProjectHandler
{
    public function __construct(
        private ProjectRepositoryInterface $projectRepository,
    ){}

    /**
     * @throws \Exception
     * @throws UniqueConstraintViolationException
     */
    public function handle(CreateProjectDTO $dto): Project
    {
        $project = new Project($dto->name, $dto->description);
        $project->setSlug($dto->slug);
        
        $this->projectRepository->save($project);

        return $project;
    }
}
