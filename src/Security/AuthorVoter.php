<?php


namespace App\Security;


use App\Entity\Book;
use App\Entity\Review;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AuthorVoter extends Voter
{

    protected function supports(string $attribute, $subject)
    {
        return $attribute === 'AUTHOR' && ($subject instanceof Book || $subject instanceof Review);
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if(!$user instanceof User){
            return false;
        }
        return $subject->getAuthor()->getId() === $user->getId();
    }
}