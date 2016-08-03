<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : POGOProtos.Networking.Responses.proto
 */


namespace POGOProtos\Networking\Responses;

/**
 * Protobuf message : POGOProtos.Networking.Responses.FortSearchResponse
 */
class FortSearchResponse extends \Protobuf\AbstractMessage
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
     * result optional enum = 1
     *
     * @var \POGOProtos\Networking\Responses\FortSearchResponse\Result
     */
    protected $result = null;

    /**
     * items_awarded repeated message = 2
     *
     * @var \Protobuf\Collection<\POGOProtos\Inventory\Item\ItemAward>
     */
    protected $items_awarded = null;

    /**
     * gems_awarded optional int32 = 3
     *
     * @var int
     */
    protected $gems_awarded = null;

    /**
     * pokemon_data_egg optional message = 4
     *
     * @var \POGOProtos\Data\PokemonData
     */
    protected $pokemon_data_egg = null;

    /**
     * experience_awarded optional int32 = 5
     *
     * @var int
     */
    protected $experience_awarded = null;

    /**
     * cooldown_complete_timestamp_ms optional int64 = 6
     *
     * @var int
     */
    protected $cooldown_complete_timestamp_ms = null;

    /**
     * chain_hack_sequence_number optional int32 = 7
     *
     * @var int
     */
    protected $chain_hack_sequence_number = null;

    /**
     * Check if 'result' has a value
     *
     * @return bool
     */
    public function hasResult()
    {
        return $this->result !== null;
    }

    /**
     * Get 'result' value
     *
     * @return \POGOProtos\Networking\Responses\FortSearchResponse\Result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set 'result' value
     *
     * @param \POGOProtos\Networking\Responses\FortSearchResponse\Result $value
     */
    public function setResult(\POGOProtos\Networking\Responses\FortSearchResponse\Result $value = null)
    {
        $this->result = $value;
    }

    /**
     * Check if 'items_awarded' has a value
     *
     * @return bool
     */
    public function hasItemsAwardedList()
    {
        return $this->items_awarded !== null;
    }

    /**
     * Get 'items_awarded' value
     *
     * @return \Protobuf\Collection<\POGOProtos\Inventory\Item\ItemAward>
     */
    public function getItemsAwardedList()
    {
        return $this->items_awarded;
    }

    /**
     * Set 'items_awarded' value
     *
     * @param \Protobuf\Collection<\POGOProtos\Inventory\Item\ItemAward> $value
     */
    public function setItemsAwardedList(\Protobuf\Collection $value = null)
    {
        $this->items_awarded = $value;
    }

    /**
     * Add a new element to 'items_awarded'
     *
     * @param \POGOProtos\Inventory\Item\ItemAward $value
     */
    public function addItemsAwarded(\POGOProtos\Inventory\Item\ItemAward $value)
    {
        if ($this->items_awarded === null) {
            $this->items_awarded = new \Protobuf\MessageCollection();
        }

        $this->items_awarded->add($value);
    }

    /**
     * Check if 'gems_awarded' has a value
     *
     * @return bool
     */
    public function hasGemsAwarded()
    {
        return $this->gems_awarded !== null;
    }

    /**
     * Get 'gems_awarded' value
     *
     * @return int
     */
    public function getGemsAwarded()
    {
        return $this->gems_awarded;
    }

    /**
     * Set 'gems_awarded' value
     *
     * @param int $value
     */
    public function setGemsAwarded($value = null)
    {
        $this->gems_awarded = $value;
    }

    /**
     * Check if 'pokemon_data_egg' has a value
     *
     * @return bool
     */
    public function hasPokemonDataEgg()
    {
        return $this->pokemon_data_egg !== null;
    }

    /**
     * Get 'pokemon_data_egg' value
     *
     * @return \POGOProtos\Data\PokemonData
     */
    public function getPokemonDataEgg()
    {
        return $this->pokemon_data_egg;
    }

    /**
     * Set 'pokemon_data_egg' value
     *
     * @param \POGOProtos\Data\PokemonData $value
     */
    public function setPokemonDataEgg(\POGOProtos\Data\PokemonData $value = null)
    {
        $this->pokemon_data_egg = $value;
    }

    /**
     * Check if 'experience_awarded' has a value
     *
     * @return bool
     */
    public function hasExperienceAwarded()
    {
        return $this->experience_awarded !== null;
    }

    /**
     * Get 'experience_awarded' value
     *
     * @return int
     */
    public function getExperienceAwarded()
    {
        return $this->experience_awarded;
    }

    /**
     * Set 'experience_awarded' value
     *
     * @param int $value
     */
    public function setExperienceAwarded($value = null)
    {
        $this->experience_awarded = $value;
    }

    /**
     * Check if 'cooldown_complete_timestamp_ms' has a value
     *
     * @return bool
     */
    public function hasCooldownCompleteTimestampMs()
    {
        return $this->cooldown_complete_timestamp_ms !== null;
    }

    /**
     * Get 'cooldown_complete_timestamp_ms' value
     *
     * @return int
     */
    public function getCooldownCompleteTimestampMs()
    {
        return $this->cooldown_complete_timestamp_ms;
    }

    /**
     * Set 'cooldown_complete_timestamp_ms' value
     *
     * @param int $value
     */
    public function setCooldownCompleteTimestampMs($value = null)
    {
        $this->cooldown_complete_timestamp_ms = $value;
    }

    /**
     * Check if 'chain_hack_sequence_number' has a value
     *
     * @return bool
     */
    public function hasChainHackSequenceNumber()
    {
        return $this->chain_hack_sequence_number !== null;
    }

    /**
     * Get 'chain_hack_sequence_number' value
     *
     * @return int
     */
    public function getChainHackSequenceNumber()
    {
        return $this->chain_hack_sequence_number;
    }

    /**
     * Set 'chain_hack_sequence_number' value
     *
     * @param int $value
     */
    public function setChainHackSequenceNumber($value = null)
    {
        $this->chain_hack_sequence_number = $value;
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
            'result' => null,
            'items_awarded' => [],
            'gems_awarded' => null,
            'pokemon_data_egg' => null,
            'experience_awarded' => null,
            'cooldown_complete_timestamp_ms' => null,
            'chain_hack_sequence_number' => null
        ], $values);

        $message->setResult($values['result']);
        $message->setGemsAwarded($values['gems_awarded']);
        $message->setPokemonDataEgg($values['pokemon_data_egg']);
        $message->setExperienceAwarded($values['experience_awarded']);
        $message->setCooldownCompleteTimestampMs($values['cooldown_complete_timestamp_ms']);
        $message->setChainHackSequenceNumber($values['chain_hack_sequence_number']);

        foreach ($values['items_awarded'] as $item) {
            $message->addItemsAwarded($item);
        }

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'FortSearchResponse',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'result',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_ENUM(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Networking.Responses.FortSearchResponse.Result'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'items_awarded',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REPEATED(),
                    'type_name' => '.POGOProtos.Inventory.Item.ItemAward'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 3,
                    'name' => 'gems_awarded',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT32(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 4,
                    'name' => 'pokemon_data_egg',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Data.PokemonData'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 5,
                    'name' => 'experience_awarded',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT32(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 6,
                    'name' => 'cooldown_complete_timestamp_ms',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT64(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 7,
                    'name' => 'chain_hack_sequence_number',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT32(),
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

        if ($this->result !== null) {
            $writer->writeVarint($stream, 8);
            $writer->writeVarint($stream, $this->result->value());
        }

        if ($this->items_awarded !== null) {
            foreach ($this->items_awarded as $val) {
                $writer->writeVarint($stream, 18);
                $writer->writeVarint($stream, $val->serializedSize($sizeContext));
                $val->writeTo($context);
            }
        }

        if ($this->gems_awarded !== null) {
            $writer->writeVarint($stream, 24);
            $writer->writeVarint($stream, $this->gems_awarded);
        }

        if ($this->pokemon_data_egg !== null) {
            $writer->writeVarint($stream, 34);
            $writer->writeVarint($stream, $this->pokemon_data_egg->serializedSize($sizeContext));
            $this->pokemon_data_egg->writeTo($context);
        }

        if ($this->experience_awarded !== null) {
            $writer->writeVarint($stream, 40);
            $writer->writeVarint($stream, $this->experience_awarded);
        }

        if ($this->cooldown_complete_timestamp_ms !== null) {
            $writer->writeVarint($stream, 48);
            $writer->writeVarint($stream, $this->cooldown_complete_timestamp_ms);
        }

        if ($this->chain_hack_sequence_number !== null) {
            $writer->writeVarint($stream, 56);
            $writer->writeVarint($stream, $this->chain_hack_sequence_number);
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

                $this->result = \POGOProtos\Networking\Responses\FortSearchResponse\Result::valueOf($reader->readVarint($stream));

                continue;
            }

            if ($tag === 2) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \POGOProtos\Inventory\Item\ItemAward();

                if ($this->items_awarded === null) {
                    $this->items_awarded = new \Protobuf\MessageCollection();
                }

                $this->items_awarded->add($innerMessage);

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            if ($tag === 3) {
                \Protobuf\WireFormat::assertWireType($wire, 5);

                $this->gems_awarded = $reader->readVarint($stream);

                continue;
            }

            if ($tag === 4) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \POGOProtos\Data\PokemonData();

                $this->pokemon_data_egg = $innerMessage;

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            if ($tag === 5) {
                \Protobuf\WireFormat::assertWireType($wire, 5);

                $this->experience_awarded = $reader->readVarint($stream);

                continue;
            }

            if ($tag === 6) {
                \Protobuf\WireFormat::assertWireType($wire, 3);

                $this->cooldown_complete_timestamp_ms = $reader->readVarint($stream);

                continue;
            }

            if ($tag === 7) {
                \Protobuf\WireFormat::assertWireType($wire, 5);

                $this->chain_hack_sequence_number = $reader->readVarint($stream);

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

        if ($this->result !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->result->value());
        }

        if ($this->items_awarded !== null) {
            foreach ($this->items_awarded as $val) {
                $innerSize = $val->serializedSize($context);

                $size += 1;
                $size += $innerSize;
                $size += $calculator->computeVarintSize($innerSize);
            }
        }

        if ($this->gems_awarded !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->gems_awarded);
        }

        if ($this->pokemon_data_egg !== null) {
            $innerSize = $this->pokemon_data_egg->serializedSize($context);

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->experience_awarded !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->experience_awarded);
        }

        if ($this->cooldown_complete_timestamp_ms !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->cooldown_complete_timestamp_ms);
        }

        if ($this->chain_hack_sequence_number !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->chain_hack_sequence_number);
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
        $this->result = null;
        $this->items_awarded = null;
        $this->gems_awarded = null;
        $this->pokemon_data_egg = null;
        $this->experience_awarded = null;
        $this->cooldown_complete_timestamp_ms = null;
        $this->chain_hack_sequence_number = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \POGOProtos\Networking\Responses\FortSearchResponse) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->result = ($message->result !== null) ? $message->result : $this->result;
        $this->items_awarded = ($message->items_awarded !== null) ? $message->items_awarded : $this->items_awarded;
        $this->gems_awarded = ($message->gems_awarded !== null) ? $message->gems_awarded : $this->gems_awarded;
        $this->pokemon_data_egg = ($message->pokemon_data_egg !== null) ? $message->pokemon_data_egg : $this->pokemon_data_egg;
        $this->experience_awarded = ($message->experience_awarded !== null) ? $message->experience_awarded : $this->experience_awarded;
        $this->cooldown_complete_timestamp_ms = ($message->cooldown_complete_timestamp_ms !== null) ? $message->cooldown_complete_timestamp_ms : $this->cooldown_complete_timestamp_ms;
        $this->chain_hack_sequence_number = ($message->chain_hack_sequence_number !== null) ? $message->chain_hack_sequence_number : $this->chain_hack_sequence_number;
    }


}

