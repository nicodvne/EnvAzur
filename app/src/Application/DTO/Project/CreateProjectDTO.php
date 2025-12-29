<?php

namespace Application\DTO\Project;

class CreateProjectDTO {
    public string $name;
    public string $slug;
    public ?string $description;
}
