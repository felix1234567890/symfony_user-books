<?php

namespace App\Serializer\Normalizer;

use App\Entity\Book;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class BookNormalizer implements NormalizerInterface,NormalizerAwareInterface ,CacheableSupportsMethodInterface
{
   use NormalizerAwareTrait;

    public function normalize($object, string $format = null, array $context = array()): array
    {
        $data = [
            'slug' => $object->getSlug(),
            'title' => $object->getTitle(),
            'description' => $object->getDescription(),
            'createdAt' => $this->normalizer->normalize($object->getCreatedAt()),
            'updatedAt' => $this->normalizer->normalize($object->getCreatedAt()),
            'author' => $this->normalizer->normalize($object->getAuthor()),
        ];

        return $data;
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Book;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
