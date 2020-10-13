<?php


namespace App\Security\Guard;

use Lexik\Bundle\JWTAuthenticationBundle\Security\Guard\JWTTokenAuthenticator as BaseJWTAuthenticator;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;

class JWTAuthenticator extends BaseJWTAuthenticator
{
    protected function getTokenExtractor()
    {
        return new AuthorizationHeaderTokenExtractor('Bearer', 'Authorization');
    }
}