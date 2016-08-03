<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : POGOProtos.Data.Battle.proto
 */


namespace POGOProtos\Data\Battle;

/**
 * Protobuf message : POGOProtos.Data.Battle.BattleParticipant
 */
class BattleParticipant extends \Protobuf\AbstractMessage
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
     * active_pokemon optional message = 1
     *
     * @var \POGOProtos\Data\Battle\BattlePokemonInfo
     */
    protected $active_pokemon = null;

    /**
     * trainer_public_profile optional message = 2
     *
     * @var \POGOProtos\Data\Player\PlayerPublicProfile
     */
    protected $trainer_public_profile = null;

    /**
     * reverse_pokemon repeated message = 3
     *
     * @var \Protobuf\Collection<\POGOProtos\Data\Battle\BattlePokemonInfo>
     */
    protected $reverse_pokemon = null;

    /**
     * defeated_pokemon repeated message = 4
     *
     * @var \Protobuf\Collection<\POGOProtos\Data\Battle\BattlePokemonInfo>
     */
    protected $defeated_pokemon = null;

    /**
     * Check if 'active_pokemon' has a value
     *
     * @return bool
     */
    public function hasActivePokemon()
    {
        return $this->active_pokemon !== null;
    }

    /**
     * Get 'active_pokemon' value
     *
     * @return \POGOProtos\Data\Battle\BattlePokemonInfo
     */
    public function getActivePokemon()
    {
        return $this->active_pokemon;
    }

    /**
     * Set 'active_pokemon' value
     *
     * @param \POGOProtos\Data\Battle\BattlePokemonInfo $value
     */
    public function setActivePokemon(\POGOProtos\Data\Battle\BattlePokemonInfo $value = null)
    {
        $this->active_pokemon = $value;
    }

    /**
     * Check if 'trainer_public_profile' has a value
     *
     * @return bool
     */
    public function hasTrainerPublicProfile()
    {
        return $this->trainer_public_profile !== null;
    }

    /**
     * Get 'trainer_public_profile' value
     *
     * @return \POGOProtos\Data\Player\PlayerPublicProfile
     */
    public function getTrainerPublicProfile()
    {
        return $this->trainer_public_profile;
    }

    /**
     * Set 'trainer_public_profile' value
     *
     * @param \POGOProtos\Data\Player\PlayerPublicProfile $value
     */
    public function setTrainerPublicProfile(\POGOProtos\Data\Player\PlayerPublicProfile $value = null)
    {
        $this->trainer_public_profile = $value;
    }

    /**
     * Check if 'reverse_pokemon' has a value
     *
     * @return bool
     */
    public function hasReversePokemonList()
    {
        return $this->reverse_pokemon !== null;
    }

    /**
     * Get 'reverse_pokemon' value
     *
     * @return \Protobuf\Collection<\POGOProtos\Data\Battle\BattlePokemonInfo>
     */
    public function getReversePokemonList()
    {
        return $this->reverse_pokemon;
    }

    /**
     * Set 'reverse_pokemon' value
     *
     * @param \Protobuf\Collection<\POGOProtos\Data\Battle\BattlePokemonInfo> $value
     */
    public function setReversePokemonList(\Protobuf\Collection $value = null)
    {
        $this->reverse_pokemon = $value;
    }

    /**
     * Add a new element to 'reverse_pokemon'
     *
     * @param \POGOProtos\Data\Battle\BattlePokemonInfo $value
     */
    public function addReversePokemon(\POGOProtos\Data\Battle\BattlePokemonInfo $value)
    {
        if ($this->reverse_pokemon === null) {
            $this->reverse_pokemon = new \Protobuf\MessageCollection();
        }

        $this->reverse_pokemon->add($value);
    }

    /**
     * Check if 'defeated_pokemon' has a value
     *
     * @return bool
     */
    public function hasDefeatedPokemonList()
    {
        return $this->defeated_pokemon !== null;
    }

    /**
     * Get 'defeated_pokemon' value
     *
     * @return \Protobuf\Collection<\POGOProtos\Data\Battle\BattlePokemonInfo>
     */
    public function getDefeatedPokemonList()
    {
        return $this->defeated_pokemon;
    }

    /**
     * Set 'defeated_pokemon' value
     *
     * @param \Protobuf\Collection<\POGOProtos\Data\Battle\BattlePokemonInfo> $value
     */
    public function setDefeatedPokemonList(\Protobuf\Collection $value = null)
    {
        $this->defeated_pokemon = $value;
    }

    /**
     * Add a new element to 'defeated_pokemon'
     *
     * @param \POGOProtos\Data\Battle\BattlePokemonInfo $value
     */
    public function addDefeatedPokemon(\POGOProtos\Data\Battle\BattlePokemonInfo $value)
    {
        if ($this->defeated_pokemon === null) {
            $this->defeated_pokemon = new \Protobuf\MessageCollection();
        }

        $this->defeated_pokemon->add($value);
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
            'active_pokemon' => null,
            'trainer_public_profile' => null,
            'reverse_pokemon' => [],
            'defeated_pokemon' => []
        ], $values);

        $message->setActivePokemon($values['active_pokemon']);
        $message->setTrainerPublicProfile($values['trainer_public_profile']);

        foreach ($values['reverse_pokemon'] as $item) {
            $message->addReversePokemon($item);
        }

        foreach ($values['defeated_pokemon'] as $item) {
            $message->addDefeatedPokemon($item);
        }

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'BattleParticipant',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'active_pokemon',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Data.Battle.BattlePokemonInfo'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'trainer_public_profile',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Data.Player.PlayerPublicProfile'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 3,
                    'name' => 'reverse_pokemon',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REPEATED(),
                    'type_name' => '.POGOProtos.Data.Battle.BattlePokemonInfo'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 4,
                    'name' => 'defeated_pokemon',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REPEATED(),
                    'type_name' => '.POGOProtos.Data.Battle.BattlePokemonInfo'
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

        if ($this->active_pokemon !== null) {
            $writer->writeVarint($stream, 10);
            $writer->writeVarint($stream, $this->active_pokemon->serializedSize($sizeContext));
            $this->active_pokemon->writeTo($context);
        }

        if ($this->trainer_public_profile !== null) {
            $writer->writeVarint($stream, 18);
            $writer->writeVarint($stream, $this->trainer_public_profile->serializedSize($sizeContext));
            $this->trainer_public_profile->writeTo($context);
        }

        if ($this->reverse_pokemon !== null) {
            foreach ($this->reverse_pokemon as $val) {
                $writer->writeVarint($stream, 26);
                $writer->writeVarint($stream, $val->serializedSize($sizeContext));
                $val->writeTo($context);
            }
        }

        if ($this->defeated_pokemon !== null) {
            foreach ($this->defeated_pokemon as $val) {
                $writer->writeVarint($stream, 34);
                $writer->writeVarint($stream, $val->serializedSize($sizeContext));
                $val->writeTo($context);
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
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \POGOProtos\Data\Battle\BattlePokemonInfo();

                $this->active_pokemon = $innerMessage;

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            if ($tag === 2) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \POGOProtos\Data\Player\PlayerPublicProfile();

                $this->trainer_public_profile = $innerMessage;

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            if ($tag === 3) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \POGOProtos\Data\Battle\BattlePokemonInfo();

                if ($this->reverse_pokemon === null) {
                    $this->reverse_pokemon = new \Protobuf\MessageCollection();
                }

                $this->reverse_pokemon->add($innerMessage);

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            if ($tag === 4) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \POGOProtos\Data\Battle\BattlePokemonInfo();

                if ($this->defeated_pokemon === null) {
                    $this->defeated_pokemon = new \Protobuf\MessageCollection();
                }

                $this->defeated_pokemon->add($innerMessage);

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

        if ($this->active_pokemon !== null) {
            $innerSize = $this->active_pokemon->serializedSize($context);

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->trainer_public_profile !== null) {
            $innerSize = $this->trainer_public_profile->serializedSize($context);

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->reverse_pokemon !== null) {
            foreach ($this->reverse_pokemon as $val) {
                $innerSize = $val->serializedSize($context);

                $size += 1;
                $size += $innerSize;
                $size += $calculator->computeVarintSize($innerSize);
            }
        }

        if ($this->defeated_pokemon !== null) {
            foreach ($this->defeated_pokemon as $val) {
                $innerSize = $val->serializedSize($context);

                $size += 1;
                $size += $innerSize;
                $size += $calculator->computeVarintSize($innerSize);
            }
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
        $this->active_pokemon = null;
        $this->trainer_public_profile = null;
        $this->reverse_pokemon = null;
        $this->defeated_pokemon = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \POGOProtos\Data\Battle\BattleParticipant) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->active_pokemon = ($message->active_pokemon !== null) ? $message->active_pokemon : $this->active_pokemon;
        $this->trainer_public_profile = ($message->trainer_public_profile !== null) ? $message->trainer_public_profile : $this->trainer_public_profile;
        $this->reverse_pokemon = ($message->reverse_pokemon !== null) ? $message->reverse_pokemon : $this->reverse_pokemon;
        $this->defeated_pokemon = ($message->defeated_pokemon !== null) ? $message->defeated_pokemon : $this->defeated_pokemon;
    }


}

