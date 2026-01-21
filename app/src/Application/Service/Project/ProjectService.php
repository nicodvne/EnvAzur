<?php

namespace Application\Service\Project;

use Application\DTO\Project\CreateProjectDTO;

class ProjectService {

    public function buildProjectDTO(array $payload): CreateProjectDTO {
        $dto = new CreateProjectDTO();
        $dto->name = $payload['projectName'];
        $dto->description = $payload['projectDescription'] ?? null;
        $dto->slug = $this->generateSlug($dto->name);

        return $dto;
    }
    
    private function generateSlug(string $name): string {
        $toLower = strtolower($name);

        $slug = preg_replace('/[^a-z0-9]+/i', '-', $toLower);

        $slug = trim($slug, '-');

        return $slug;
    }
}
