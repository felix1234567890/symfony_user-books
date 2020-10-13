<?php

namespace App\Controller\Book;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/books", name="get_books", methods={"GET"})
 */
class GetBooksController extends AbstractController
{
    private BookRepository $bookRepository;
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function __invoke()
    {
       $books = $this->bookRepository->findAll();
       return [
           'books'=>$books
       ];
    }
}
