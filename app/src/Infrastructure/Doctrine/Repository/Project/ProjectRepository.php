<?php

namespace Infrastructure\Doctrine\Repository\Project;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Entity\Project;
use Domain\Repository\ProjectRepositoryInterface;
use Infrastructure\Doctrine\Entity\Project\Project as DoctrineProjectEntity;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em,
    ){}

    public function save(Project $project): void
    {
        $doctrineProject = new DoctrineProjectEntity();
        $doctrineProject->name = $project->getName();

        $this->em->persist($doctrineProject);
        $this->em->flush();

        $project->setId($doctrineProject->id);
    }
}