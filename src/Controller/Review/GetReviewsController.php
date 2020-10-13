<?php

namespace App\Controller\Review;

use App\Entity\Book;
use App\Repository\ReviewRepository;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/books/{slug}/reviews", name="get_reviews", methods={"GET"})
 */
class GetReviewsController
{
    private ReviewRepository $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function __invoke(Book $book)
    {
        return [
            'reviews' => $this->reviewRepository->findBy(['book'=>$book])
        ];
    }
}
