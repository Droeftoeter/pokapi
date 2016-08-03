<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : POGOProtos.Networking.Envelopes.proto
 */


namespace POGOProtos\Networking\Envelopes;

/**
 * Protobuf message : POGOProtos.Networking.Envelopes.Unknown6Response
 */
class Unknown6Response extends \Protobuf\AbstractMessage
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
     * response_type optional int32 = 1
     *
     * @var int
     */
    protected $response_type = null;

    /**
     * unknown2 optional message = 2
     *
     * @var \POGOProtos\Networking\Envelopes\Unknown6Response\Unknown2
     */
    protected $unknown2 = null;

    /**
     * Check if 'response_type' has a value
     *
     * @return bool
     */
    public function hasResponseType()
    {
        return $this->response_type !== null;
    }

    /**
     * Get 'response_type' value
     *
     * @return int
     */
    public function getResponseType()
    {
        return $this->response_type;
    }

    /**
     * Set 'response_type' value
     *
     * @param int $value
     */
    public function setResponseType($value = null)
    {
        $this->response_type = $value;
    }

    /**
     * Check if 'unknown2' has a value
     *
     * @return bool
     */
    public function hasUnknown2()
    {
        return $this->unknown2 !== null;
    }

    /**
     * Get 'unknown2' value
     *
     * @return \POGOProtos\Networking\Envelopes\Unknown6Response\Unknown2
     */
    public function getUnknown2()
    {
        return $this->unknown2;
    }

    /**
     * Set 'unknown2' value
     *
     * @param \POGOProtos\Networking\Envelopes\Unknown6Response\Unknown2 $value
     */
    public function setUnknown2(\POGOProtos\Networking\Envelopes\Unknown6Response\Unknown2 $value = null)
    {
        $this->unknown2 = $value;
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
            'response_type' => null,
            'unknown2' => null
        ], $values);

        $message->setResponseType($values['response_type']);
        $message->setUnknown2($values['unknown2']);

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'Unknown6Response',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'response_type',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT32(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'unknown2',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Networking.Envelopes.Unknown6Response.Unknown2'
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

        if ($this->response_type !== null) {
            $writer->writeVarint($stream, 8);
            $writer->writeVarint($stream, $this->response_type);
        }

        if ($this->unknown2 !== null) {
            $writer->writeVarint($stream, 18);
            $writer->writeVarint($stream, $this->unknown2->serializedSize($sizeContext));
            $this->unknown2->writeTo($context);
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
                \Protobuf\WireFormat::assertWireType($wire, 5);

                $this->response_type = $reader->readVarint($stream);

                continue;
            }

            if ($tag === 2) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \POGOProtos\Networking\Envelopes\Unknown6Response\Unknown2();

                $this->unknown2 = $innerMessage;

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

        if ($this->response_type !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->response_type);
        }

        if ($this->unknown2 !== null) {
            $innerSize = $this->unknown2->serializedSize($context);

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
        $this->response_type = null;
        $this->unknown2 = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \POGOProtos\Networking\Envelopes\Unknown6Response) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->response_type = ($message->response_type !== null) ? $message->response_type : $this->response_type;
        $this->unknown2 = ($message->unknown2 !== null) ? $message->unknown2 : $this->unknown2;
    }


}

