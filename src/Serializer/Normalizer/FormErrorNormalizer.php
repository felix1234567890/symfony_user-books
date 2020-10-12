<?php

namespace App\Serializer\Normalizer;

use RuntimeException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class FormErrorNormalizer implements NormalizerInterface
{

    public function normalize($object, string $format = null, array $context = array()): array
    {
        $data = [
            'code' => $context['status_code'] ?? null,
            'message' => 'Validation Failed',
            'errors' => $this->convertFormToArray($object),
        ];

        if (!is_array($data)) {
            throw new RuntimeException('Normalized form data should be of type array.');
        }
        $data = $data['errors']['children'];
        $data = array_filter($data, fn (array $child) => isset($child['errors']) && \count($child['errors']) > 0);

        return array_map(fn (array $child) => $child['errors'] ?? [], $data);
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof FormInterface && $data->isSubmitted() && !$data->isValid();
    }

    private function convertFormToArray(FormInterface $data): array
    {
        $form = $errors = [];

        foreach ($data->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        if ($errors) {
            $form['errors'] = $errors;
        }

        $children = [];
        foreach ($data->all() as $child) {
            if ($child instanceof FormInterface) {
                $children[$child->getName()] = $this->convertFormToArray($child);
            }
        }

        if ($children) {
            $form['children'] = $children;
        }

        return $form;
    }
}
