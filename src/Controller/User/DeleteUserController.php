<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Security\UserResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/users/{id}", name="delete_user", methods={"DELETE"})
 */
class DeleteUserController
{
    private UserResolver $userResolver;
    private EntityManagerInterface $entityManager;
    public function __construct(UserResolver $userResolver, EntityManagerInterface $entityManager)
    {
        $this->userResolver = $userResolver;
        $this->entityManager = $entityManager;
    }

    public function __invoke(User $user)
    {
        $currentUser = $this->userResolver->getCurrentUser();
        if($user->getId() !== $currentUser->getId()){
            throw new AccessDeniedHttpException("You are not allowed to delete someone else's profile" );
        }
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}
