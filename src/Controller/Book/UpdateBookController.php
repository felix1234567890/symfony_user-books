<?php

namespace App\Controller\Book;

use App\Entity\Book;
use App\Form\BookType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/books/{slug}", name="update_book", methods={"PUT"})
 *
 * @Security("is_granted('AUTHOR', book)")
 */
class UpdateBookController
{
    private FormFactoryInterface $formFactory;

    private EntityManagerInterface $entityManager;

    public function __construct(FormFactoryInterface $factory, EntityManagerInterface $manager)
    {
        $this->formFactory = $factory;
        $this->entityManager = $manager;
    }
    public function __invoke(Request $request, Book $book)
    {
        $form = $this->formFactory->createNamed('book', BookType::class, $book);
        $form->submit($request->request->get('book'), false);
        if($form->isValid()){
            $this->entityManager->flush();
            return ['book' => $book];
        }
        return ['form' => $form];
    }
}
