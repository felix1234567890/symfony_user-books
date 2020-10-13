<?php

namespace App\Controller\Review;

use App\Entity\Review;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/books/{slug}/reviews/{id}", name="delete_review", methods={"DELETE"})
 * @Security("is_granted('AUTHOR', review)")
 */
class DeleteReviewController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->entityManager = $manager;
    }
    public function __invoke(Review $review)
    {
        {
            $this->entityManager->remove($review);
            $this->entityManager->flush();
        }
    }
}
