<?php

namespace App\Controller\Review;

use App\Entity\Book;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Security\UserResolver;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/books/{slug}/reviews", name="create_review", methods={"POST"})
 * @View(statusCode=201)
 */
class CreateReviewController
{
    private FormFactoryInterface $formFactory;

    private EntityManagerInterface $entityManager;

    private UserResolver $userResolver;

    public function __construct(
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        UserResolver $userResolver
    ) {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->userResolver = $userResolver;
    }
    public function __invoke(Request $request, Book $book)
    {
       $author = $this->userResolver->getCurrentUser();
       $review = new Review();
       $review->setAuthor($author);
       $review->setBook($book);

        $form = $this->formFactory->createNamed('review', ReviewType::class, $review);
        $form->submit($request->request->get('review'));

        if ($form->isValid()) {
            $this->entityManager->persist($review);
            $this->entityManager->flush();
            return ['review' => $review];
        }
        return ['form' => $form];
    }
}
