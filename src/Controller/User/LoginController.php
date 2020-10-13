<?php

namespace App\Controller\User;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/login", name="login", methods={"POST"})
 */
class LoginController
{

    public function __invoke()
    {
        throw new \RuntimeException('Should not be reached.');
    }
}
