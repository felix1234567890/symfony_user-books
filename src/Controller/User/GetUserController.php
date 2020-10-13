<?php

namespace App\Controller\User;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/users/{id}", name="get_user", methods={"GET"}, requirements={"id"="\d+"})
 */
class GetUserController
{

    public function __invoke(User $user)
    {
        return ['user'=> $user];
    }
}
