<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : POGOProtos.Data.Battle.proto
 */


namespace POGOProtos\Data\Battle;

/**
 * Protobuf message : POGOProtos.Data.Battle.BattleResults
 */
class BattleResults extends \Protobuf\AbstractMessage
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
     * gym_state optional message = 1
     *
     * @var \POGOProtos\Data\Gym\GymState
     */
    protected $gym_state = null;

    /**
     * attackers repeated message = 2
     *
     * @var \Protobuf\Collection<\POGOProtos\Data\Battle\BattleParticipant>
     */
    protected $attackers = null;

    /**
     * player_experience_awarded repeated int32 = 3
     *
     * @var \Protobuf\Collection
     */
    protected $player_experience_awarded = null;

    /**
     * next_defender_pokemon_id optional int64 = 4
     *
     * @var int
     */
    protected $next_defender_pokemon_id = null;

    /**
     * gym_points_delta optional int32 = 5
     *
     * @var int
     */
    protected $gym_points_delta = null;

    /**
     * Check if 'gym_state' has a value
     *
     * @return bool
     */
    public function hasGymState()
    {
        return $this->gym_state !== null;
    }

    /**
     * Get 'gym_state' value
     *
     * @return \POGOProtos\Data\Gym\GymState
     */
    public function getGymState()
    {
        return $this->gym_state;
    }

    /**
     * Set 'gym_state' value
     *
     * @param \POGOProtos\Data\Gym\GymState $value
     */
    public function setGymState(\POGOProtos\Data\Gym\GymState $value = null)
    {
        $this->gym_state = $value;
    }

    /**
     * Check if 'attackers' has a value
     *
     * @return bool
     */
    public function hasAttackersList()
    {
        return $this->attackers !== null;
    }

    /**
     * Get 'attackers' value
     *
     * @return \Protobuf\Collection<\POGOProtos\Data\Battle\BattleParticipant>
     */
    public function getAttackersList()
    {
        return $this->attackers;
    }

    /**
     * Set 'attackers' value
     *
     * @param \Protobuf\Collection<\POGOProtos\Data\Battle\BattleParticipant> $value
     */
    public function setAttackersList(\Protobuf\Collection $value = null)
    {
        $this->attackers = $value;
    }

    /**
     * Add a new element to 'attackers'
     *
     * @param \POGOProtos\Data\Battle\BattleParticipant $value
     */
    public function addAttackers(\POGOProtos\Data\Battle\BattleParticipant $value)
    {
        if ($this->attackers === null) {
            $this->attackers = new \Protobuf\MessageCollection();
        }

        $this->attackers->add($value);
    }

    /**
     * Check if 'player_experience_awarded' has a value
     *
     * @return bool
     */
    public function hasPlayerExperienceAwardedList()
    {
        return $this->player_experience_awarded !== null;
    }

    /**
     * Get 'player_experience_awarded' value
     *
     * @return \Protobuf\Collection
     */
    public function getPlayerExperienceAwardedList()
    {
        return $this->player_experience_awarded;
    }

    /**
     * Set 'player_experience_awarded' value
     *
     * @param \Protobuf\Collection $value
     */
    public function setPlayerExperienceAwardedList(\Protobuf\Collection $value = null)
    {
        $this->player_experience_awarded = $value;
    }

    /**
     * Add a new element to 'player_experience_awarded'
     *
     * @param int $value
     */
    public function addPlayerExperienceAwarded($value)
    {
        if ($this->player_experience_awarded === null) {
            $this->player_experience_awarded = new \Protobuf\ScalarCollection();
        }

        $this->player_experience_awarded->add($value);
    }

    /**
     * Check if 'next_defender_pokemon_id' has a value
     *
     * @return bool
     */
    public function hasNextDefenderPokemonId()
    {
        return $this->next_defender_pokemon_id !== null;
    }

    /**
     * Get 'next_defender_pokemon_id' value
     *
     * @return int
     */
    public function getNextDefenderPokemonId()
    {
        return $this->next_defender_pokemon_id;
    }

    /**
     * Set 'next_defender_pokemon_id' value
     *
     * @param int $value
     */
    public function setNextDefenderPokemonId($value = null)
    {
        $this->next_defender_pokemon_id = $value;
    }

    /**
     * Check if 'gym_points_delta' has a value
     *
     * @return bool
     */
    public function hasGymPointsDelta()
    {
        return $this->gym_points_delta !== null;
    }

    /**
     * Get 'gym_points_delta' value
     *
     * @return int
     */
    public function getGymPointsDelta()
    {
        return $this->gym_points_delta;
    }

    /**
     * Set 'gym_points_delta' value
     *
     * @param int $value
     */
    public function setGymPointsDelta($value = null)
    {
        $this->gym_points_delta = $value;
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
            'gym_state' => null,
            'attackers' => [],
            'player_experience_awarded' => [],
            'next_defender_pokemon_id' => null,
            'gym_points_delta' => null
        ], $values);

        $message->setGymState($values['gym_state']);
        $message->setNextDefenderPokemonId($values['next_defender_pokemon_id']);
        $message->setGymPointsDelta($values['gym_points_delta']);

        foreach ($values['attackers'] as $item) {
            $message->addAttackers($item);
        }

        foreach ($values['player_experience_awarded'] as $item) {
            $message->addPlayerExperienceAwarded($item);
        }

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'BattleResults',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'gym_state',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Data.Gym.GymState'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'attackers',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REPEATED(),
                    'type_name' => '.POGOProtos.Data.Battle.BattleParticipant'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 3,
                    'name' => 'player_experience_awarded',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT32(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REPEATED()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 4,
                    'name' => 'next_defender_pokemon_id',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT64(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 5,
                    'name' => 'gym_points_delta',
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

        if ($this->gym_state !== null) {
            $writer->writeVarint($stream, 10);
            $writer->writeVarint($stream, $this->gym_state->serializedSize($sizeContext));
            $this->gym_state->writeTo($context);
        }

        if ($this->attackers !== null) {
            foreach ($this->attackers as $val) {
                $writer->writeVarint($stream, 18);
                $writer->writeVarint($stream, $val->serializedSize($sizeContext));
                $val->writeTo($context);
            }
        }

        if ($this->player_experience_awarded !== null) {
            foreach ($this->player_experience_awarded as $val) {
                $writer->writeVarint($stream, 24);
                $writer->writeVarint($stream, $val);
            }
        }

        if ($this->next_defender_pokemon_id !== null) {
            $writer->writeVarint($stream, 32);
            $writer->writeVarint($stream, $this->next_defender_pokemon_id);
        }

        if ($this->gym_points_delta !== null) {
            $writer->writeVarint($stream, 40);
            $writer->writeVarint($stream, $this->gym_points_delta);
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
                $innerMessage = new \POGOProtos\Data\Gym\GymState();

                $this->gym_state = $innerMessage;

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            if ($tag === 2) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \POGOProtos\Data\Battle\BattleParticipant();

                if ($this->attackers === null) {
                    $this->attackers = new \Protobuf\MessageCollection();
                }

                $this->attackers->add($innerMessage);

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            if ($tag === 3) {
                \Protobuf\WireFormat::assertWireType($wire, 5);

                if ($this->player_experience_awarded === null) {
                    $this->player_experience_awarded = new \Protobuf\ScalarCollection();
                }

                $this->player_experience_awarded->add($reader->readVarint($stream));

                continue;
            }

            if ($tag === 4) {
                \Protobuf\WireFormat::assertWireType($wire, 3);

                $this->next_defender_pokemon_id = $reader->readVarint($stream);

                continue;
            }

            if ($tag === 5) {
                \Protobuf\WireFormat::assertWireType($wire, 5);

                $this->gym_points_delta = $reader->readVarint($stream);

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

        if ($this->gym_state !== null) {
            $innerSize = $this->gym_state->serializedSize($context);

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->attackers !== null) {
            foreach ($this->attackers as $val) {
                $innerSize = $val->serializedSize($context);

                $size += 1;
                $size += $innerSize;
                $size += $calculator->computeVarintSize($innerSize);
            }
        }

        if ($this->player_experience_awarded !== null) {
            foreach ($this->player_experience_awarded as $val) {
                $size += 1;
                $size += $calculator->computeVarintSize($val);
            }
        }

        if ($this->next_defender_pokemon_id !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->next_defender_pokemon_id);
        }

        if ($this->gym_points_delta !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->gym_points_delta);
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
        $this->gym_state = null;
        $this->attackers = null;
        $this->player_experience_awarded = null;
        $this->next_defender_pokemon_id = null;
        $this->gym_points_delta = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \POGOProtos\Data\Battle\BattleResults) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->gym_state = ($message->gym_state !== null) ? $message->gym_state : $this->gym_state;
        $this->attackers = ($message->attackers !== null) ? $message->attackers : $this->attackers;
        $this->player_experience_awarded = ($message->player_experience_awarded !== null) ? $message->player_experience_awarded : $this->player_experience_awarded;
        $this->next_defender_pokemon_id = ($message->next_defender_pokemon_id !== null) ? $message->next_defender_pokemon_id : $this->next_defender_pokemon_id;
        $this->gym_points_delta = ($message->gym_points_delta !== null) ? $message->gym_points_delta : $this->gym_points_delta;
    }


}

