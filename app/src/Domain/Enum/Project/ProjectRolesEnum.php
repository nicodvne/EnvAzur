<?php

namespace Domain\Enum\Project;

enum ProjectRolesEnum: string {
    case OWNER = 'owner';
    case MAINTENER = 'maintainer';
    case CONTRIBUTOR = 'contributor';
    case GUEST = 'guest';
}
