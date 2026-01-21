<?php

namespace Application\Service\Project;

class ProjectService {
    
    public function generateSlug(string $name): string {
        $toLower = strtolower($name);

        $slug = preg_replace('/[^a-z0-9]+/i', '-', $toLower);

        $slug = trim($slug, '-');
        
        return $slug;
    }

}
