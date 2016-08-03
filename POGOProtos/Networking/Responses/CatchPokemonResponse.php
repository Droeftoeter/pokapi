<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : POGOProtos.Networking.Responses.proto
 */


namespace POGOProtos\Networking\Responses;

/**
 * Protobuf message : POGOProtos.Networking.Responses.CatchPokemonResponse
 */
class CatchPokemonResponse extends \Protobuf\AbstractMessage
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
     * status optional enum = 1
     *
     * @var \POGOProtos\Networking\Responses\CatchPokemonResponse\CatchStatus
     */
    protected $status = null;

    /**
     * miss_percent optional double = 2
     *
     * @var float
     */
    protected $miss_percent = null;

    /**
     * captured_pokemon_id optional fixed64 = 3
     *
     * @var int
     */
    protected $captured_pokemon_id = null;

    /**
     * capture_award optional message = 4
     *
     * @var \POGOProtos\Data\Capture\CaptureAward
     */
    protected $capture_award = null;

    /**
     * Check if 'status' has a value
     *
     * @return bool
     */
    public function hasStatus()
    {
        return $this->status !== null;
    }

    /**
     * Get 'status' value
     *
     * @return \POGOProtos\Networking\Responses\CatchPokemonResponse\CatchStatus
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set 'status' value
     *
     * @param \POGOProtos\Networking\Responses\CatchPokemonResponse\CatchStatus $value
     */
    public function setStatus(\POGOProtos\Networking\Responses\CatchPokemonResponse\CatchStatus $value = null)
    {
        $this->status = $value;
    }

    /**
     * Check if 'miss_percent' has a value
     *
     * @return bool
     */
    public function hasMissPercent()
    {
        return $this->miss_percent !== null;
    }

    /**
     * Get 'miss_percent' value
     *
     * @return float
     */
    public function getMissPercent()
    {
        return $this->miss_percent;
    }

    /**
     * Set 'miss_percent' value
     *
     * @param float $value
     */
    public function setMissPercent($value = null)
    {
        $this->miss_percent = $value;
    }

    /**
     * Check if 'captured_pokemon_id' has a value
     *
     * @return bool
     */
    public function hasCapturedPokemonId()
    {
        return $this->captured_pokemon_id !== null;
    }

    /**
     * Get 'captured_pokemon_id' value
     *
     * @return int
     */
    public function getCapturedPokemonId()
    {
        return $this->captured_pokemon_id;
    }

    /**
     * Set 'captured_pokemon_id' value
     *
     * @param int $value
     */
    public function setCapturedPokemonId($value = null)
    {
        $this->captured_pokemon_id = $value;
    }

    /**
     * Check if 'capture_award' has a value
     *
     * @return bool
     */
    public function hasCaptureAward()
    {
        return $this->capture_award !== null;
    }

    /**
     * Get 'capture_award' value
     *
     * @return \POGOProtos\Data\Capture\CaptureAward
     */
    public function getCaptureAward()
    {
        return $this->capture_award;
    }

    /**
     * Set 'capture_award' value
     *
     * @param \POGOProtos\Data\Capture\CaptureAward $value
     */
    public function setCaptureAward(\POGOProtos\Data\Capture\CaptureAward $value = null)
    {
        $this->capture_award = $value;
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
            'status' => null,
            'miss_percent' => null,
            'captured_pokemon_id' => null,
            'capture_award' => null
        ], $values);

        $message->setStatus($values['status']);
        $message->setMissPercent($values['miss_percent']);
        $message->setCapturedPokemonId($values['captured_pokemon_id']);
        $message->setCaptureAward($values['capture_award']);

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'CatchPokemonResponse',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'status',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_ENUM(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Networking.Responses.CatchPokemonResponse.CatchStatus'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'miss_percent',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_DOUBLE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 3,
                    'name' => 'captured_pokemon_id',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_FIXED64(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 4,
                    'name' => 'capture_award',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Data.Capture.CaptureAward'
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

        if ($this->status !== null) {
            $writer->writeVarint($stream, 8);
            $writer->writeVarint($stream, $this->status->value());
        }

        if ($this->miss_percent !== null) {
            $writer->writeVarint($stream, 17);
            $writer->writeDouble($stream, $this->miss_percent);
        }

        if ($this->captured_pokemon_id !== null) {
            $writer->writeVarint($stream, 25);
            $writer->writeFixed64($stream, $this->captured_pokemon_id);
        }

        if ($this->capture_award !== null) {
            $writer->writeVarint($stream, 34);
            $writer->writeVarint($stream, $this->capture_award->serializedSize($sizeContext));
            $this->capture_award->writeTo($context);
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
                \Protobuf\WireFormat::assertWireType($wire, 14);

                $this->status = \POGOProtos\Networking\Responses\CatchPokemonResponse\CatchStatus::valueOf($reader->readVarint($stream));

                continue;
            }

            if ($tag === 2) {
                \Protobuf\WireFormat::assertWireType($wire, 1);

                $this->miss_percent = $reader->readDouble($stream);

                continue;
            }

            if ($tag === 3) {
                \Protobuf\WireFormat::assertWireType($wire, 6);

                $this->captured_pokemon_id = $reader->readFixed64($stream);

                continue;
            }

            if ($tag === 4) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \POGOProtos\Data\Capture\CaptureAward();

                $this->capture_award = $innerMessage;

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

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

        if ($this->status !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->status->value());
        }

        if ($this->miss_percent !== null) {
            $size += 1;
            $size += 8;
        }

        if ($this->captured_pokemon_id !== null) {
            $size += 1;
            $size += 8;
        }

        if ($this->capture_award !== null) {
            $innerSize = $this->capture_award->serializedSize($context);

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
        $this->status = null;
        $this->miss_percent = null;
        $this->captured_pokemon_id = null;
        $this->capture_award = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \POGOProtos\Networking\Responses\CatchPokemonResponse) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->status = ($message->status !== null) ? $message->status : $this->status;
        $this->miss_percent = ($message->miss_percent !== null) ? $message->miss_percent : $this->miss_percent;
        $this->captured_pokemon_id = ($message->captured_pokemon_id !== null) ? $message->captured_pokemon_id : $this->captured_pokemon_id;
        $this->capture_award = ($message->capture_award !== null) ? $message->capture_award : $this->capture_award;
    }


}

