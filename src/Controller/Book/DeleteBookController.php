<?php

namespace App\Controller\Book;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/api/books/{slug}", name="delete_book", methods={"DELETE"})
 *
 * @Security("is_granted('AUTHOR', book)")
 */
class DeleteBookController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->entityManager = $manager;
    }

    public function __invoke(Book $book)
    {
        $this->entityManager->remove($book);
        $this->entityManager->flush();
    }
}
