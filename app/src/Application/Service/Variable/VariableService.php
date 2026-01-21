<?php

namespace Application\Service\Variable;

use Application\DTO\Variable\CreateVariableDTO;
use Symfony\Component\HttpFoundation\Request;

class VariableService {
    public function requestHasRequiredData(Request $request): bool
    {
        $payload = $request->getPayload();

        return !$payload->has('varKey') || !$payload->has('varValue') || !$payload->has('projectSlug');
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
