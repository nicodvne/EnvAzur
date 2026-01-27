<?php

namespace Infrastructure\Mapper\User;

use Domain\Entity\User as DomainUser;
use Infrastructure\Doctrine\Entity\User\User as PersistenceUser;

class UserMapper
{
    public static function toPersistence(DomainUser $domainUser): PersistenceUser
    {
        $persistenceUser = new PersistenceUser();

        $persistenceUser->setUsername($domainUser->getUsername());
        $persistenceUser->setEmail($domainUser->getEmail());
        $persistenceUser->setPassword($domainUser->getPassword());

        return $persistenceUser;
    }

    public static function toDomain(PersistenceUser $user): DomainUser
    {
        return new DomainUser(
            $user->getUsername(),
            $user->getEmail(),
            $user->getPassword()
        );
    }
}
