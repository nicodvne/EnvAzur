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

    public function delete(Project $project): void
    {
        $doctrineProject = $this->em->find(DoctrineProjectEntity::class, $project->getId());

        if ($doctrineProject !== null) {
            $this->em->remove($doctrineProject);
            $this->em->flush();
        }
    }

    public function deleteById(int $projectId): void
    {
        $doctrineProject = $this->em->find(DoctrineProjectEntity::class, $projectId);

        if ($doctrineProject !== null) {
            $this->em->remove($doctrineProject);
            $this->em->flush();
        }
    }
}
