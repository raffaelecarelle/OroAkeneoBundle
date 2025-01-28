<?php
// TODO: 27/01, modificata e riportata alla versione precedente
namespace Creativestyle\Bundle\AkeneoBundle\ImportExport\Serializer\Normalizer;

use Creativestyle\Bundle\AkeneoBundle\Integration\AkeneoChannel;
use Oro\Bundle\AttachmentBundle\Entity\FileItem;
use Symfony\Component\Serializer\Exception\CircularReferenceException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class FileItemNormalizer implements ContextAwareNormalizerInterface, ContextAwareDenormalizerInterface
{
    /** @var ContextAwareDenormalizerInterface */
    private $fileNormalizer;

    public function __construct(ContextAwareDenormalizerInterface $fileNormalizer)
    {
        $this->fileNormalizer = $fileNormalizer;
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return is_a($type, FileItem::class, true)
            && isset($context['channelType'])
            && AkeneoChannel::TYPE === $context['channelType'];
    }

    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $fileItem = new FileItem();
        $file = $this->fileNormalizer->denormalize($data, $type, $format, $context);
        $fileItem->setFile($file);

        return $fileItem;
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof FileItem;
    }

    public function normalize(mixed $object, ?string $format = null, array $context = [])
    {
        return $object;
    }


}

//
//class FileItemNormalizer implements ContextAwareDenormalizerInterface
//{
//    /** @var ContextAwareDenormalizerInterface */
//    private $fileNormalizer;
//
//    public function __construct(ContextAwareDenormalizerInterface $fileNormalizer)
//    {
//        $this->fileNormalizer = $fileNormalizer;
//    }
//
//    public function supportsDenormalization($data, $type, $format = null, array $context = [])
//    {
//        return is_a($type, FileItem::class, true)
//            && isset($context['channelType'])
//            && AkeneoChannel::TYPE === $context['channelType'];
//    }
//
//    public function denormalize($data, $type, $format = null, array $context = [])
//    {
//        $fileItem = new FileItem();
//        $file = $this->fileNormalizer->denormalize($data, $type, $format, $context);
//        $fileItem->setFile($file);
//
//        return $fileItem;
//    }