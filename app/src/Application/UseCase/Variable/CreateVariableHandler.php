<?php

namespace Application\UseCase\Variable;

use Application\DTO\Variable\CreateVariableDTO;
use Domain\Entity\Variable;
use Domain\Repository\ProjectRepositoryInterface;
use Domain\Repository\VariableRepositoryInterface;

class CreateVariableHandler 
{
    public function __construct(
        private VariableRepositoryInterface $variableRepository,
        private ProjectRepositoryInterface $projectRepository
    ){}

    public function handle(CreateVariableDTO $dto): Variable
    {
        $project = $this->projectRepository->getOneBySlug($dto->projectSlug);
        $variable = new Variable(
            $dto->varKey,
            $dto->varValue,
            $project
        );

        $this->variableRepository->save($variable);

        return $variable;
    }
}  
