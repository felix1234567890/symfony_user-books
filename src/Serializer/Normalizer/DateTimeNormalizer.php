<?php

namespace App\Serializer\Normalizer;

use Carbon\Carbon;
use DateTime;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DateTimeNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{

    public function normalize($object, string $format = null, array $context = array()): string
    {
      return Carbon::instance($object)->toISOString();
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof DateTime;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
