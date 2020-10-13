<?php

namespace App\Controller\User;

use App\Repository\UserRepository;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/users", name="users_list", methods={"GET"})
 * @QueryParam(name="search", requirements="[A-Za-z0-9]+", nullable=true)
 * @QueryParam(name="limit", requirements="\d+")
 * @QueryParam(name="offset", requirements="\d+", default="0")
 */
class UsersListController
{
    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function __invoke(ParamFetcher $paramFetcher)
    {
        $offset = (int) $paramFetcher->get('offset');
        $limit = (int) $paramFetcher->get('limit');
        $search = $paramFetcher->get('search');

        if(!$limit && !$search) {
            $users = $this->userRepository->findAll();
        } else if(!$limit && $search){
            $users = $this->userRepository->searchUsers($search);
        }
        else {
            $users = $this->userRepository->paginateUsers($offset, $limit);
        }
        $usersCount = $this->userRepository->getUserCount();
        return [
            'usersCount' => $usersCount,
            'users'=> $users
        ];
    }
}
