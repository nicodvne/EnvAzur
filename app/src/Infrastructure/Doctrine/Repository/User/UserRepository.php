<?php

namespace Infrastructure\Doctrine\Repository\User;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Entity\User as EntityUser;
use Domain\Repository\UserRepositoryInterface;
use Infrastructure\Doctrine\Entity\User\User;
use Infrastructure\Mapper\User\UserMapper;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface, UserRepositoryInterface
{
    public function __construct(
        private ManagerRegistry $registry,
        private UserPasswordHasherInterface $passwordHasher
    ){
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function createUser(EntityUser $user): void
    {
        $doctrineUser = new User();
        
        $doctrineUser->setUsername($user->getUsername());
        $doctrineUser->setEmail($user->getEmail());
        $doctrineUser->setPassword(
            $this->passwordHasher->hashPassword($doctrineUser, $user->getPassword())
        );

        $doctrineUser->setRoles(['ROLE_USER']);

        $this->getEntityManager()->persist($doctrineUser);
        $this->getEntityManager()->flush();
    }

    public function getUserByEmail(string $email): ?EntityUser
    {
        $doctrineUser = $this->findOneBy(['email' => $email]);

        if (!$doctrineUser) {
            return null;
        }

        return UserMapper::toDomain($doctrineUser);
    }
}
