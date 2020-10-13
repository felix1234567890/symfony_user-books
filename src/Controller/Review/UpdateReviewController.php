<?php

namespace App\Controller\Review;

use App\Entity\Book;
use App\Entity\Review;
use App\Form\ReviewType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/books/{book}/reviews/{id}", name="update_review", methods={"PUT"})
 * @ParamConverter("book", options={"mapping": {"book": "slug"}})
 * @Security("is_granted('AUTHOR', review)")
 */
class UpdateReviewController
{
    private FormFactoryInterface $formFactory;

    private EntityManagerInterface $entityManager;

    public function __construct(FormFactoryInterface $factory, EntityManagerInterface $manager)
    {
        $this->formFactory = $factory;
        $this->entityManager = $manager;
    }
    public function __invoke(Request $request, Book $book,Review $review)
    {
        if(!$book->getReviews()->contains($review)){
            throw new MethodNotAllowedHttpException("This review doesn't exist on given book");
        }
        $form = $this->formFactory->createNamed('review', ReviewType::class, $review);
        $form->submit($request->request->get('review'), false);
        if($form->isValid()){
            $this->entityManager->flush();
            return ['review' => $review];
        }
        return ['form' => $form];
    }
}
