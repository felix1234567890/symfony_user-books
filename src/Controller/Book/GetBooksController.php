<?php

namespace App\Controller\Book;

use App\Repository\BookRepository;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/books", name="get_books", methods={"GET"})
 * @QueryParam(name="author", requirements="[A-Za-z0-9]+", nullable=true)
 */
class GetBooksController extends AbstractController
{
    private BookRepository $bookRepository;
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function __invoke(ParamFetcher $paramFetcher)
    {
        $author = $paramFetcher->get('author');
        if($author){
            $books =$this->bookRepository->findAuthorBooks($author);
        } else {
            $books = $this->bookRepository->findAll();
        }

       return [
           'books'=>$books
       ];
    }
}
