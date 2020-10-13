<?php

namespace App\Controller\Review;

use App\Entity\User;
use App\Repository\ReviewRepository;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/users/{id}/reviews", name="get_reviews", methods={"GET"})
 */
class GetUserReviewsController
{
    private ReviewRepository $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function __invoke(User $user)
    {
        return [
            'reviews' => $this->reviewRepository->findBy(['author'=>$user])
        ];
    }
}
