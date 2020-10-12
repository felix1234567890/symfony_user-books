<?php

namespace App\Serializer\Normalizer;

use App\Entity\User;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class UserNormalizer implements NormalizerInterface, NormalizerAwareInterface,CacheableSupportsMethodInterface
{
    use NormalizerAwareTrait;
    public function normalize($object, string $format = null, array $context = array()): array
    {
       $data = [
           'username'=> $object->getUsername(),
           'email' => $object->getEmail(),
           'createdAt' => $this->normalizer->normalize($object->getCreatedAt()),
           'updatedAt' => $this->normalizer->normalize($object->getCreatedAt()),
       ];
        return $data;
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof User;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
