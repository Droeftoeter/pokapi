<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : POGOProtos.Inventory.proto
 */


namespace POGOProtos\Inventory;

/**
 * Protobuf message : POGOProtos.Inventory.AppliedItem
 */
class AppliedItem extends \Protobuf\AbstractMessage
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
     * item_id optional enum = 1
     *
     * @var \POGOProtos\Inventory\Item\ItemId
     */
    protected $item_id = null;

    /**
     * item_type optional enum = 2
     *
     * @var \POGOProtos\Inventory\Item\ItemType
     */
    protected $item_type = null;

    /**
     * expire_ms optional int64 = 3
     *
     * @var int
     */
    protected $expire_ms = null;

    /**
     * applied_ms optional int64 = 4
     *
     * @var int
     */
    protected $applied_ms = null;

    /**
     * Check if 'item_id' has a value
     *
     * @return bool
     */
    public function hasItemId()
    {
        return $this->item_id !== null;
    }

    /**
     * Get 'item_id' value
     *
     * @return \POGOProtos\Inventory\Item\ItemId
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * Set 'item_id' value
     *
     * @param \POGOProtos\Inventory\Item\ItemId $value
     */
    public function setItemId(\POGOProtos\Inventory\Item\ItemId $value = null)
    {
        $this->item_id = $value;
    }

    /**
     * Check if 'item_type' has a value
     *
     * @return bool
     */
    public function hasItemType()
    {
        return $this->item_type !== null;
    }

    /**
     * Get 'item_type' value
     *
     * @return \POGOProtos\Inventory\Item\ItemType
     */
    public function getItemType()
    {
        return $this->item_type;
    }

    /**
     * Set 'item_type' value
     *
     * @param \POGOProtos\Inventory\Item\ItemType $value
     */
    public function setItemType(\POGOProtos\Inventory\Item\ItemType $value = null)
    {
        $this->item_type = $value;
    }

    /**
     * Check if 'expire_ms' has a value
     *
     * @return bool
     */
    public function hasExpireMs()
    {
        return $this->expire_ms !== null;
    }

    /**
     * Get 'expire_ms' value
     *
     * @return int
     */
    public function getExpireMs()
    {
        return $this->expire_ms;
    }

    /**
     * Set 'expire_ms' value
     *
     * @param int $value
     */
    public function setExpireMs($value = null)
    {
        $this->expire_ms = $value;
    }

    /**
     * Check if 'applied_ms' has a value
     *
     * @return bool
     */
    public function hasAppliedMs()
    {
        return $this->applied_ms !== null;
    }

    /**
     * Get 'applied_ms' value
     *
     * @return int
     */
    public function getAppliedMs()
    {
        return $this->applied_ms;
    }

    /**
     * Set 'applied_ms' value
     *
     * @param int $value
     */
    public function setAppliedMs($value = null)
    {
        $this->applied_ms = $value;
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
            'item_id' => null,
            'item_type' => null,
            'expire_ms' => null,
            'applied_ms' => null
        ], $values);

        $message->setItemId($values['item_id']);
        $message->setItemType($values['item_type']);
        $message->setExpireMs($values['expire_ms']);
        $message->setAppliedMs($values['applied_ms']);

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'AppliedItem',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'item_id',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_ENUM(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Inventory.Item.ItemId'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'item_type',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_ENUM(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Inventory.Item.ItemType'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 3,
                    'name' => 'expire_ms',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT64(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 4,
                    'name' => 'applied_ms',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT64(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
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

        if ($this->item_id !== null) {
            $writer->writeVarint($stream, 8);
            $writer->writeVarint($stream, $this->item_id->value());
        }

        if ($this->item_type !== null) {
            $writer->writeVarint($stream, 16);
            $writer->writeVarint($stream, $this->item_type->value());
        }

        if ($this->expire_ms !== null) {
            $writer->writeVarint($stream, 24);
            $writer->writeVarint($stream, $this->expire_ms);
        }

        if ($this->applied_ms !== null) {
            $writer->writeVarint($stream, 32);
            $writer->writeVarint($stream, $this->applied_ms);
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

                $this->item_id = \POGOProtos\Inventory\Item\ItemId::valueOf($reader->readVarint($stream));

                continue;
            }

            if ($tag === 2) {
                \Protobuf\WireFormat::assertWireType($wire, 14);

                $this->item_type = \POGOProtos\Inventory\Item\ItemType::valueOf($reader->readVarint($stream));

                continue;
            }

            if ($tag === 3) {
                \Protobuf\WireFormat::assertWireType($wire, 3);

                $this->expire_ms = $reader->readVarint($stream);

                continue;
            }

            if ($tag === 4) {
                \Protobuf\WireFormat::assertWireType($wire, 3);

                $this->applied_ms = $reader->readVarint($stream);

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

        if ($this->item_id !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->item_id->value());
        }

        if ($this->item_type !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->item_type->value());
        }

        if ($this->expire_ms !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->expire_ms);
        }

        if ($this->applied_ms !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->applied_ms);
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
        $this->item_id = null;
        $this->item_type = null;
        $this->expire_ms = null;
        $this->applied_ms = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \POGOProtos\Inventory\AppliedItem) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->item_id = ($message->item_id !== null) ? $message->item_id : $this->item_id;
        $this->item_type = ($message->item_type !== null) ? $message->item_type : $this->item_type;
        $this->expire_ms = ($message->expire_ms !== null) ? $message->expire_ms : $this->expire_ms;
        $this->applied_ms = ($message->applied_ms !== null) ? $message->applied_ms : $this->applied_ms;
    }


}

