<?php
// TODO: 27/01, modificata e riportata alla versione precedente
namespace Creativestyle\Bundle\AkeneoBundle\ImportExport\Serializer\Normalizer;

use Creativestyle\Bundle\AkeneoBundle\Integration\AkeneoChannel;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;

class AkeneoNormalizerWrapper implements ContextAwareDenormalizerInterface
{
    /** @var ContextAwareDenormalizerInterface */
    private $fileNormalizer;

    public function __construct(ContextAwareDenormalizerInterface $fileNormalizer)
    {
        $this->fileNormalizer = $fileNormalizer;
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        $supports = $this->fileNormalizer->supportsDenormalization($data, $type, $format, $context);
        if ($supports) {
            return AkeneoChannel::TYPE === ($context['channelType'] ?? null);
        }

        return $supports;
    }

    public function denormalize($data, $type, $format = null, array $context = [])
    {
        return $this->fileNormalizer->denormalize($data, $type, $format, $context);
    }
}
