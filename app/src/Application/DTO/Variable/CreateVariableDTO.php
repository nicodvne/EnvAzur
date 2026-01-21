<?php

namespace Application\DTO\Variable;

use Infrastructure\Doctrine\Entity\Project\Project;

class CreateVariableDTO {
    public string $varKey;
    public string $varValue;
    public string $projectSlug;
}
