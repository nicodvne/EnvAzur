<?php

namespace Infrastructure\Doctrine\Repository\Variable;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Entity\Variable;
use Domain\Repository\VariableRepositoryInterface;
use Infrastructure\Doctrine\Entity\Project\Project;
use Infrastructure\Doctrine\Entity\Variable\Variable as EntityVariable;

class VariableRepository implements VariableRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em,
    ){}

    public function save(Variable $variable): void
    {
        $doctrineVariable = new EntityVariable();
        $doctrineVariable->setVarKey($variable->getVarKey());
        $doctrineVariable->setVarValue($variable->getVarValue());
        $variableProject = $this->em->find(
            Project::class,
            $variable->getProject()->getId()
        );

        $doctrineVariable->setProject($variableProject);

        $this->em->persist($doctrineVariable);
        $this->em->flush();
    }
}

