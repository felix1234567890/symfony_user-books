<?php

namespace App\Controller\Book;

use App\Entity\Book;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/books/{slug}", name="get_book", methods={"GET"})
 */
class GetBookController
{

    public function __invoke(Book $book)
    {
        return ['book' => $book];
    }
}
