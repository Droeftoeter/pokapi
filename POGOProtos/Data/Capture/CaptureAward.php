<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : POGOProtos.Data.Capture.proto
 */


namespace POGOProtos\Data\Capture;

/**
 * Protobuf message : POGOProtos.Data.Capture.CaptureAward
 */
class CaptureAward extends \Protobuf\AbstractMessage
{

    /**
     * @var \Protobuf\UnknownFieldSet
     */
    protected $unknownFieldSet = null;

    /**
     * @var \Protobuf\Extension\ExtensionFieldMap
     */
    protected $extensions = null;

    /**
     * activity_type repeated enum = 1
     *
     * @var \Protobuf\Collection<\POGOProtos\Enums\ActivityType>
     */
    protected $activity_type = null;

    /**
     * xp repeated int32 = 2
     *
     * @var \Protobuf\Collection
     */
    protected $xp = null;

    /**
     * candy repeated int32 = 3
     *
     * @var \Protobuf\Collection
     */
    protected $candy = null;

    /**
     * stardust repeated int32 = 4
     *
     * @var \Protobuf\Collection
     */
    protected $stardust = null;

    /**
     * Check if 'activity_type' has a value
     *
     * @return bool
     */
    public function hasActivityTypeList()
    {
        return $this->activity_type !== null;
    }

    /**
     * Get 'activity_type' value
     *
     * @return \Protobuf\Collection<\POGOProtos\Enums\ActivityType>
     */
    public function getActivityTypeList()
    {
        return $this->activity_type;
    }

    /**
     * Set 'activity_type' value
     *
     * @param \Protobuf\Collection<\POGOProtos\Enums\ActivityType> $value
     */
    public function setActivityTypeList(\Protobuf\Collection $value = null)
    {
        $this->activity_type = $value;
    }

    /**
     * Add a new element to 'activity_type'
     *
     * @param \POGOProtos\Enums\ActivityType $value
     */
    public function addActivityType(\POGOProtos\Enums\ActivityType $value)
    {
        if ($this->activity_type === null) {
            $this->activity_type = new \Protobuf\EnumCollection();
        }

        $this->activity_type->add($value);
    }

    /**
     * Check if 'xp' has a value
     *
     * @return bool
     */
    public function hasXpList()
    {
        return $this->xp !== null;
    }

    /**
     * Get 'xp' value
     *
     * @return \Protobuf\Collection
     */
    public function getXpList()
    {
        return $this->xp;
    }

    /**
     * Set 'xp' value
     *
     * @param \Protobuf\Collection $value
     */
    public function setXpList(\Protobuf\Collection $value = null)
    {
        $this->xp = $value;
    }

    /**
     * Add a new element to 'xp'
     *
     * @param int $value
     */
    public function addXp($value)
    {
        if ($this->xp === null) {
            $this->xp = new \Protobuf\ScalarCollection();
        }

        $this->xp->add($value);
    }

    /**
     * Check if 'candy' has a value
     *
     * @return bool
     */
    public function hasCandyList()
    {
        return $this->candy !== null;
    }

    /**
     * Get 'candy' value
     *
     * @return \Protobuf\Collection
     */
    public function getCandyList()
    {
        return $this->candy;
    }

    /**
     * Set 'candy' value
     *
     * @param \Protobuf\Collection $value
     */
    public function setCandyList(\Protobuf\Collection $value = null)
    {
        $this->candy = $value;
    }

    /**
     * Add a new element to 'candy'
     *
     * @param int $value
     */
    public function addCandy($value)
    {
        if ($this->candy === null) {
            $this->candy = new \Protobuf\ScalarCollection();
        }

        $this->candy->add($value);
    }

    /**
     * Check if 'stardust' has a value
     *
     * @return bool
     */
    public function hasStardustList()
    {
        return $this->stardust !== null;
    }

    /**
     * Get 'stardust' value
     *
     * @return \Protobuf\Collection
     */
    public function getStardustList()
    {
        return $this->stardust;
    }

    /**
     * Set 'stardust' value
     *
     * @param \Protobuf\Collection $value
     */
    public function setStardustList(\Protobuf\Collection $value = null)
    {
        $this->stardust = $value;
    }

    /**
     * Add a new element to 'stardust'
     *
     * @param int $value
     */
    public function addStardust($value)
    {
        if ($this->stardust === null) {
            $this->stardust = new \Protobuf\ScalarCollection();
        }

        $this->stardust->add($value);
    }

    /**
     * {@inheritdoc}
     */
    public function extensions()
    {
        if ( $this->extensions !== null) {
            return $this->extensions;
        }

        return $this->extensions = new \Protobuf\Extension\ExtensionFieldMap(__CLASS__);
    }

    /**
     * {@inheritdoc}
     */
    public function unknownFieldSet()
    {
        return $this->unknownFieldSet;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromStream($stream, \Protobuf\Configuration $configuration = null)
    {
        return new self($stream, $configuration);
    }

    /**
     * {@inheritdoc}
     */
    public static function fromArray(array $values)
    {
        $message = new self();
        $values  = array_merge([
            'activity_type' => [],
            'xp' => [],
            'candy' => [],
            'stardust' => []
        ], $values);

        foreach ($values['activity_type'] as $item) {
            $message->addActivityType($item);
        }

        foreach ($values['xp'] as $item) {
            $message->addXp($item);
        }

        foreach ($values['candy'] as $item) {
            $message->addCandy($item);
        }

        foreach ($values['stardust'] as $item) {
            $message->addStardust($item);
        }

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'CaptureAward',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'activity_type',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_ENUM(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REPEATED(),
                    'type_name' => '.POGOProtos.Enums.ActivityType'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'xp',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT32(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REPEATED()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 3,
                    'name' => 'candy',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT32(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REPEATED()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 4,
                    'name' => 'stardust',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT32(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REPEATED()
                ]),
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function toStream(\Protobuf\Configuration $configuration = null)
    {
        $config  = $configuration ?: \Protobuf\Configuration::getInstance();
        $context = $config->createWriteContext();
        $stream  = $context->getStream();

        $this->writeTo($context);
        $stream->seek(0);

        return $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function writeTo(\Protobuf\WriteContext $context)
    {
        $stream      = $context->getStream();
        $writer      = $context->getWriter();
        $sizeContext = $context->getComputeSizeContext();

        if ($this->activity_type !== null) {
            $innerSize   = 0;
            $calculator  = $sizeContext->getSizeCalculator();

            foreach ($this->activity_type as $val) {
                $innerSize += $calculator->computeVarintSize($val);
            }

            $writer->writeVarint($stream, 10);
            $writer->writeVarint($stream, $innerSize);

            foreach ($this->activity_type as $val) {
                $writer->writeVarint($stream, $val);
            }
        }

        if ($this->xp !== null) {
            $innerSize   = 0;
            $calculator  = $sizeContext->getSizeCalculator();

            foreach ($this->xp as $val) {
                $innerSize += $calculator->computeVarintSize($val);
            }

            $writer->writeVarint($stream, 18);
            $writer->writeVarint($stream, $innerSize);

            foreach ($this->xp as $val) {
                $writer->writeVarint($stream, $val);
            }
        }

        if ($this->candy !== null) {
            $innerSize   = 0;
            $calculator  = $sizeContext->getSizeCalculator();

            foreach ($this->candy as $val) {
                $innerSize += $calculator->computeVarintSize($val);
            }

            $writer->writeVarint($stream, 26);
            $writer->writeVarint($stream, $innerSize);

            foreach ($this->candy as $val) {
                $writer->writeVarint($stream, $val);
            }
        }

        if ($this->stardust !== null) {
            $innerSize   = 0;
            $calculator  = $sizeContext->getSizeCalculator();

            foreach ($this->stardust as $val) {
                $innerSize += $calculator->computeVarintSize($val);
            }

            $writer->writeVarint($stream, 34);
            $writer->writeVarint($stream, $innerSize);

            foreach ($this->stardust as $val) {
                $writer->writeVarint($stream, $val);
            }
        }

        if ($this->extensions !== null) {
            $this->extensions->writeTo($context);
        }

        return $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function readFrom(\Protobuf\ReadContext $context)
    {
        $reader = $context->getReader();
        $length = $context->getLength();
        $stream = $context->getStream();

        $limit = ($length !== null)
            ? ($stream->tell() + $length)
            : null;

        while ($limit === null || $stream->tell() < $limit) {

            if ($stream->eof()) {
                break;
            }

            $key  = $reader->readVarint($stream);
            $wire = \Protobuf\WireFormat::getTagWireType($key);
            $tag  = \Protobuf\WireFormat::getTagFieldNumber($key);

            if ($stream->eof()) {
                break;
            }

            if ($tag === 1) {
                $innerSize  = $reader->readVarint($stream);
                $innerLimit = $stream->tell() + $innerSize;

                if ($this->activity_type === null) {
                    $this->activity_type = new \Protobuf\EnumCollection();
                }

                while ($stream->tell() < $innerLimit) {
                    $this->activity_type->add($reader->readVarint($stream));
                }

                continue;
            }

            if ($tag === 2) {
                $innerSize  = $reader->readVarint($stream);
                $innerLimit = $stream->tell() + $innerSize;

                if ($this->xp === null) {
                    $this->xp = new \Protobuf\ScalarCollection();
                }

                while ($stream->tell() < $innerLimit) {
                    $this->xp->add($reader->readVarint($stream));
                }

                continue;
            }

            if ($tag === 3) {
                $innerSize  = $reader->readVarint($stream);
                $innerLimit = $stream->tell() + $innerSize;

                if ($this->candy === null) {
                    $this->candy = new \Protobuf\ScalarCollection();
                }

                while ($stream->tell() < $innerLimit) {
                    $this->candy->add($reader->readVarint($stream));
                }

                continue;
            }

            if ($tag === 4) {
                $innerSize  = $reader->readVarint($stream);
                $innerLimit = $stream->tell() + $innerSize;

                if ($this->stardust === null) {
                    $this->stardust = new \Protobuf\ScalarCollection();
                }

                while ($stream->tell() < $innerLimit) {
                    $this->stardust->add($reader->readVarint($stream));
                }

                continue;
            }

            $extensions = $context->getExtensionRegistry();
            $extension  = $extensions ? $extensions->findByNumber(__CLASS__, $tag) : null;

            if ($extension !== null) {
                $this->extensions()->add($extension, $extension->readFrom($context, $wire));

                continue;
            }

            if ($this->unknownFieldSet === null) {
                $this->unknownFieldSet = new \Protobuf\UnknownFieldSet();
            }

            $data    = $reader->readUnknown($stream, $wire);
            $unknown = new \Protobuf\Unknown($tag, $wire, $data);

            $this->unknownFieldSet->add($unknown);

        }
    }

    /**
     * {@inheritdoc}
     */
    public function serializedSize(\Protobuf\ComputeSizeContext $context)
    {
        $calculator = $context->getSizeCalculator();
        $size       = 0;

        if ($this->activity_type !== null) {
            $innerSize = 0;

            foreach ($this->activity_type as $val) {
                $innerSize += $calculator->computeVarintSize($val);
            }

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->xp !== null) {
            $innerSize = 0;

            foreach ($this->xp as $val) {
                $innerSize += $calculator->computeVarintSize($val);
            }

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->candy !== null) {
            $innerSize = 0;

            foreach ($this->candy as $val) {
                $innerSize += $calculator->computeVarintSize($val);
            }

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->stardust !== null) {
            $innerSize = 0;

            foreach ($this->stardust as $val) {
                $innerSize += $calculator->computeVarintSize($val);
            }

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->extensions !== null) {
            $size += $this->extensions->serializedSize($context);
        }

        return $size;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->activity_type = null;
        $this->xp = null;
        $this->candy = null;
        $this->stardust = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \POGOProtos\Data\Capture\CaptureAward) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->activity_type = ($message->activity_type !== null) ? $message->activity_type : $this->activity_type;
        $this->xp = ($message->xp !== null) ? $message->xp : $this->xp;
        $this->candy = ($message->candy !== null) ? $message->candy : $this->candy;
        $this->stardust = ($message->stardust !== null) ? $message->stardust : $this->stardust;
    }


}

