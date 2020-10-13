<?php

namespace App\Controller\Book;

use App\Entity\Book;
use App\Form\BookType;
use App\Security\UserResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/books", name="create_book", methods={"POST"})
 */
class CreateBookController
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
    public function __invoke(Request $request)
    {
     $user = $this->userResolver->getCurrentUser();
     $book = new Book();
     $book->setAuthor($user);
     $form = $this->formFactory->createNamed('book', BookType::class, $book);
     $form->submit($request->request->get('book'));

        if ($form->isValid()) {
            $this->entityManager->persist($book);
            $this->entityManager->flush();

            return ['book' => $book];
        }

        return ['form' => $form];
    }
}
