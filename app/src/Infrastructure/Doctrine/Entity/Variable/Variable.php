<?php

namespace Infrastructure\Doctrine\Entity\Variable;

use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Doctrine\Entity\Project\Project;

#[ORM\Entity]
#[ORM\Table(name: 'variable')]
class Variable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255)]
    private string $varKey;

    #[ORM\Column(length: 255)]
    private string $varValue;

    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'variables')]
    #[ORM\JoinColumn(nullable: false)]
    private Project $project;

    public function getId(): int
    {
        return $this->id;
    }

    public function getVarKey(): string
    {
        return $this->varKey;
    }

    public function getVarValue(): string
    {
        return $this->varValue;
    }

    public function setVarValue(string $varValue): void
    {
        $this->varValue = $varValue;
    }

    public function changeVarValue(string $varValue): void
    {
        $this->varValue = $varValue;
    }

    public function setVarKey(string $varKey): void
    {
        $this->varKey = $varKey;
    }

    public function getProject(): Project
    {
        return $this->project;
    }

    public function setProject(Project $project): void
    {
        $this->project = $project;
    }


}
