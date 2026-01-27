<?php

namespace Application\Service\Variable;

use Application\DTO\Variable\CreateVariableDTO;
use Application\Utils\Utils;

class VariableService {

    public function __construct(
        private Utils $utils
    ) {}

    public function requestHasRequiredData(array $payload): bool
    {
        return $this->utils->arrayHas($payload, 'varKey') && 
            $this->utils->arrayHas($payload, 'varValue') && 
            $this->utils->arrayHas($payload, 'projectSlug');
    }

    public function buildVariableDTO(array $payload): CreateVariableDTO
    {
        $dto = new CreateVariableDTO();
        $dto->varKey = $payload['varKey'];
        $dto->varValue = $payload['varValue'];
        $dto->projectSlug = $payload['projectSlug'];

        return $dto;
    }
} 
