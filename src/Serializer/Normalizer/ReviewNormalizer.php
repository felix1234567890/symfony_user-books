<?php

namespace App\Serializer\Normalizer;

use App\Entity\Review;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ReviewNormalizer implements NormalizerInterface,NormalizerAwareInterface, CacheableSupportsMethodInterface
{
   use NormalizerAwareTrait;

    public function normalize($object, string $format = null, array $context = array()): array
    {
        return [
            'id' => $object->getId(),
            'createdAt' => $this->normalizer->normalize($object->getCreatedAt()),
            'updatedAt' => $this->normalizer->normalize($object->getCreatedAt()),
            'text' => $object->getText(),
            'author' => $this->normalizer->normalize($object->getAuthor()),
            'book' => $this->normalizer->normalize($object->getBook()),
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Review;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
