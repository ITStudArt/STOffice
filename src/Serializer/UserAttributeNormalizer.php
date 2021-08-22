<?php

namespace App\Serializer;

use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\SerializerAwareInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserAttributeNormalizer implements ContextAwareNormalizerInterface, SerializerAwareInterface
{

    public function supportsNormalization($data, string $format = null, array $context = [])
    {
        // TODO: Implement supportsNormalization() method.
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        // TODO: Implement normalize() method.
    }

    public function setSerializer(SerializerInterface $serializer)
    {
        // TODO: Implement setSerializer() method.
    }
}