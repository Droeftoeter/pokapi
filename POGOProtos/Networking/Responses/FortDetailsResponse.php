<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : POGOProtos.Networking.Responses.proto
 */


namespace POGOProtos\Networking\Responses;

/**
 * Protobuf message : POGOProtos.Networking.Responses.FortDetailsResponse
 */
class FortDetailsResponse extends \Protobuf\AbstractMessage
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
     * fort_id optional string = 1
     *
     * @var string
     */
    protected $fort_id = null;

    /**
     * team_color optional enum = 2
     *
     * @var \POGOProtos\Enums\TeamColor
     */
    protected $team_color = null;

    /**
     * pokemon_data optional message = 3
     *
     * @var \POGOProtos\Data\PokemonData
     */
    protected $pokemon_data = null;

    /**
     * name optional string = 4
     *
     * @var string
     */
    protected $name = null;

    /**
     * image_urls repeated string = 5
     *
     * @var \Protobuf\Collection
     */
    protected $image_urls = null;

    /**
     * fp optional int32 = 6
     *
     * @var int
     */
    protected $fp = null;

    /**
     * stamina optional int32 = 7
     *
     * @var int
     */
    protected $stamina = null;

    /**
     * max_stamina optional int32 = 8
     *
     * @var int
     */
    protected $max_stamina = null;

    /**
     * type optional enum = 9
     *
     * @var \POGOProtos\Map\Fort\FortType
     */
    protected $type = null;

    /**
     * latitude optional double = 10
     *
     * @var float
     */
    protected $latitude = null;

    /**
     * longitude optional double = 11
     *
     * @var float
     */
    protected $longitude = null;

    /**
     * description optional string = 12
     *
     * @var string
     */
    protected $description = null;

    /**
     * modifiers repeated message = 13
     *
     * @var \Protobuf\Collection<\POGOProtos\Map\Fort\FortModifier>
     */
    protected $modifiers = null;

    /**
     * Check if 'fort_id' has a value
     *
     * @return bool
     */
    public function hasFortId()
    {
        return $this->fort_id !== null;
    }

    /**
     * Get 'fort_id' value
     *
     * @return string
     */
    public function getFortId()
    {
        return $this->fort_id;
    }

    /**
     * Set 'fort_id' value
     *
     * @param string $value
     */
    public function setFortId($value = null)
    {
        $this->fort_id = $value;
    }

    /**
     * Check if 'team_color' has a value
     *
     * @return bool
     */
    public function hasTeamColor()
    {
        return $this->team_color !== null;
    }

    /**
     * Get 'team_color' value
     *
     * @return \POGOProtos\Enums\TeamColor
     */
    public function getTeamColor()
    {
        return $this->team_color;
    }

    /**
     * Set 'team_color' value
     *
     * @param \POGOProtos\Enums\TeamColor $value
     */
    public function setTeamColor(\POGOProtos\Enums\TeamColor $value = null)
    {
        $this->team_color = $value;
    }

    /**
     * Check if 'pokemon_data' has a value
     *
     * @return bool
     */
    public function hasPokemonData()
    {
        return $this->pokemon_data !== null;
    }

    /**
     * Get 'pokemon_data' value
     *
     * @return \POGOProtos\Data\PokemonData
     */
    public function getPokemonData()
    {
        return $this->pokemon_data;
    }

    /**
     * Set 'pokemon_data' value
     *
     * @param \POGOProtos\Data\PokemonData $value
     */
    public function setPokemonData(\POGOProtos\Data\PokemonData $value = null)
    {
        $this->pokemon_data = $value;
    }

    /**
     * Check if 'name' has a value
     *
     * @return bool
     */
    public function hasName()
    {
        return $this->name !== null;
    }

    /**
     * Get 'name' value
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set 'name' value
     *
     * @param string $value
     */
    public function setName($value = null)
    {
        $this->name = $value;
    }

    /**
     * Check if 'image_urls' has a value
     *
     * @return bool
     */
    public function hasImageUrlsList()
    {
        return $this->image_urls !== null;
    }

    /**
     * Get 'image_urls' value
     *
     * @return \Protobuf\Collection
     */
    public function getImageUrlsList()
    {
        return $this->image_urls;
    }

    /**
     * Set 'image_urls' value
     *
     * @param \Protobuf\Collection $value
     */
    public function setImageUrlsList(\Protobuf\Collection $value = null)
    {
        $this->image_urls = $value;
    }

    /**
     * Add a new element to 'image_urls'
     *
     * @param string $value
     */
    public function addImageUrls($value)
    {
        if ($this->image_urls === null) {
            $this->image_urls = new \Protobuf\ScalarCollection();
        }

        $this->image_urls->add($value);
    }

    /**
     * Check if 'fp' has a value
     *
     * @return bool
     */
    public function hasFp()
    {
        return $this->fp !== null;
    }

    /**
     * Get 'fp' value
     *
     * @return int
     */
    public function getFp()
    {
        return $this->fp;
    }

    /**
     * Set 'fp' value
     *
     * @param int $value
     */
    public function setFp($value = null)
    {
        $this->fp = $value;
    }

    /**
     * Check if 'stamina' has a value
     *
     * @return bool
     */
    public function hasStamina()
    {
        return $this->stamina !== null;
    }

    /**
     * Get 'stamina' value
     *
     * @return int
     */
    public function getStamina()
    {
        return $this->stamina;
    }

    /**
     * Set 'stamina' value
     *
     * @param int $value
     */
    public function setStamina($value = null)
    {
        $this->stamina = $value;
    }

    /**
     * Check if 'max_stamina' has a value
     *
     * @return bool
     */
    public function hasMaxStamina()
    {
        return $this->max_stamina !== null;
    }

    /**
     * Get 'max_stamina' value
     *
     * @return int
     */
    public function getMaxStamina()
    {
        return $this->max_stamina;
    }

    /**
     * Set 'max_stamina' value
     *
     * @param int $value
     */
    public function setMaxStamina($value = null)
    {
        $this->max_stamina = $value;
    }

    /**
     * Check if 'type' has a value
     *
     * @return bool
     */
    public function hasType()
    {
        return $this->type !== null;
    }

    /**
     * Get 'type' value
     *
     * @return \POGOProtos\Map\Fort\FortType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set 'type' value
     *
     * @param \POGOProtos\Map\Fort\FortType $value
     */
    public function setType(\POGOProtos\Map\Fort\FortType $value = null)
    {
        $this->type = $value;
    }

    /**
     * Check if 'latitude' has a value
     *
     * @return bool
     */
    public function hasLatitude()
    {
        return $this->latitude !== null;
    }

    /**
     * Get 'latitude' value
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set 'latitude' value
     *
     * @param float $value
     */
    public function setLatitude($value = null)
    {
        $this->latitude = $value;
    }

    /**
     * Check if 'longitude' has a value
     *
     * @return bool
     */
    public function hasLongitude()
    {
        return $this->longitude !== null;
    }

    /**
     * Get 'longitude' value
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set 'longitude' value
     *
     * @param float $value
     */
    public function setLongitude($value = null)
    {
        $this->longitude = $value;
    }

    /**
     * Check if 'description' has a value
     *
     * @return bool
     */
    public function hasDescription()
    {
        return $this->description !== null;
    }

    /**
     * Get 'description' value
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set 'description' value
     *
     * @param string $value
     */
    public function setDescription($value = null)
    {
        $this->description = $value;
    }

    /**
     * Check if 'modifiers' has a value
     *
     * @return bool
     */
    public function hasModifiersList()
    {
        return $this->modifiers !== null;
    }

    /**
     * Get 'modifiers' value
     *
     * @return \Protobuf\Collection<\POGOProtos\Map\Fort\FortModifier>
     */
    public function getModifiersList()
    {
        return $this->modifiers;
    }

    /**
     * Set 'modifiers' value
     *
     * @param \Protobuf\Collection<\POGOProtos\Map\Fort\FortModifier> $value
     */
    public function setModifiersList(\Protobuf\Collection $value = null)
    {
        $this->modifiers = $value;
    }

    /**
     * Add a new element to 'modifiers'
     *
     * @param \POGOProtos\Map\Fort\FortModifier $value
     */
    public function addModifiers(\POGOProtos\Map\Fort\FortModifier $value)
    {
        if ($this->modifiers === null) {
            $this->modifiers = new \Protobuf\MessageCollection();
        }

        $this->modifiers->add($value);
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
            'fort_id' => null,
            'team_color' => null,
            'pokemon_data' => null,
            'name' => null,
            'image_urls' => [],
            'fp' => null,
            'stamina' => null,
            'max_stamina' => null,
            'type' => null,
            'latitude' => null,
            'longitude' => null,
            'description' => null,
            'modifiers' => []
        ], $values);

        $message->setFortId($values['fort_id']);
        $message->setTeamColor($values['team_color']);
        $message->setPokemonData($values['pokemon_data']);
        $message->setName($values['name']);
        $message->setFp($values['fp']);
        $message->setStamina($values['stamina']);
        $message->setMaxStamina($values['max_stamina']);
        $message->setType($values['type']);
        $message->setLatitude($values['latitude']);
        $message->setLongitude($values['longitude']);
        $message->setDescription($values['description']);

        foreach ($values['image_urls'] as $item) {
            $message->addImageUrls($item);
        }

        foreach ($values['modifiers'] as $item) {
            $message->addModifiers($item);
        }

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'FortDetailsResponse',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'fort_id',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_STRING(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'team_color',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_ENUM(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Enums.TeamColor'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 3,
                    'name' => 'pokemon_data',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Data.PokemonData'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 4,
                    'name' => 'name',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_STRING(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 5,
                    'name' => 'image_urls',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_STRING(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REPEATED()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 6,
                    'name' => 'fp',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT32(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 7,
                    'name' => 'stamina',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT32(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 8,
                    'name' => 'max_stamina',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_INT32(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 9,
                    'name' => 'type',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_ENUM(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Map.Fort.FortType'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 10,
                    'name' => 'latitude',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_DOUBLE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 11,
                    'name' => 'longitude',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_DOUBLE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 12,
                    'name' => 'description',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_STRING(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL()
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 13,
                    'name' => 'modifiers',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_REPEATED(),
                    'type_name' => '.POGOProtos.Map.Fort.FortModifier'
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

        if ($this->fort_id !== null) {
            $writer->writeVarint($stream, 10);
            $writer->writeString($stream, $this->fort_id);
        }

        if ($this->team_color !== null) {
            $writer->writeVarint($stream, 16);
            $writer->writeVarint($stream, $this->team_color->value());
        }

        if ($this->pokemon_data !== null) {
            $writer->writeVarint($stream, 26);
            $writer->writeVarint($stream, $this->pokemon_data->serializedSize($sizeContext));
            $this->pokemon_data->writeTo($context);
        }

        if ($this->name !== null) {
            $writer->writeVarint($stream, 34);
            $writer->writeString($stream, $this->name);
        }

        if ($this->image_urls !== null) {
            foreach ($this->image_urls as $val) {
                $writer->writeVarint($stream, 42);
                $writer->writeString($stream, $val);
            }
        }

        if ($this->fp !== null) {
            $writer->writeVarint($stream, 48);
            $writer->writeVarint($stream, $this->fp);
        }

        if ($this->stamina !== null) {
            $writer->writeVarint($stream, 56);
            $writer->writeVarint($stream, $this->stamina);
        }

        if ($this->max_stamina !== null) {
            $writer->writeVarint($stream, 64);
            $writer->writeVarint($stream, $this->max_stamina);
        }

        if ($this->type !== null) {
            $writer->writeVarint($stream, 72);
            $writer->writeVarint($stream, $this->type->value());
        }

        if ($this->latitude !== null) {
            $writer->writeVarint($stream, 81);
            $writer->writeDouble($stream, $this->latitude);
        }

        if ($this->longitude !== null) {
            $writer->writeVarint($stream, 89);
            $writer->writeDouble($stream, $this->longitude);
        }

        if ($this->description !== null) {
            $writer->writeVarint($stream, 98);
            $writer->writeString($stream, $this->description);
        }

        if ($this->modifiers !== null) {
            foreach ($this->modifiers as $val) {
                $writer->writeVarint($stream, 106);
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
                \Protobuf\WireFormat::assertWireType($wire, 9);

                $this->fort_id = $reader->readString($stream);

                continue;
            }

            if ($tag === 2) {
                \Protobuf\WireFormat::assertWireType($wire, 14);

                $this->team_color = \POGOProtos\Enums\TeamColor::valueOf($reader->readVarint($stream));

                continue;
            }

            if ($tag === 3) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \POGOProtos\Data\PokemonData();

                $this->pokemon_data = $innerMessage;

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

                continue;
            }

            if ($tag === 4) {
                \Protobuf\WireFormat::assertWireType($wire, 9);

                $this->name = $reader->readString($stream);

                continue;
            }

            if ($tag === 5) {
                \Protobuf\WireFormat::assertWireType($wire, 9);

                if ($this->image_urls === null) {
                    $this->image_urls = new \Protobuf\ScalarCollection();
                }

                $this->image_urls->add($reader->readString($stream));

                continue;
            }

            if ($tag === 6) {
                \Protobuf\WireFormat::assertWireType($wire, 5);

                $this->fp = $reader->readVarint($stream);

                continue;
            }

            if ($tag === 7) {
                \Protobuf\WireFormat::assertWireType($wire, 5);

                $this->stamina = $reader->readVarint($stream);

                continue;
            }

            if ($tag === 8) {
                \Protobuf\WireFormat::assertWireType($wire, 5);

                $this->max_stamina = $reader->readVarint($stream);

                continue;
            }

            if ($tag === 9) {
                \Protobuf\WireFormat::assertWireType($wire, 14);

                $this->type = \POGOProtos\Map\Fort\FortType::valueOf($reader->readVarint($stream));

                continue;
            }

            if ($tag === 10) {
                \Protobuf\WireFormat::assertWireType($wire, 1);

                $this->latitude = $reader->readDouble($stream);

                continue;
            }

            if ($tag === 11) {
                \Protobuf\WireFormat::assertWireType($wire, 1);

                $this->longitude = $reader->readDouble($stream);

                continue;
            }

            if ($tag === 12) {
                \Protobuf\WireFormat::assertWireType($wire, 9);

                $this->description = $reader->readString($stream);

                continue;
            }

            if ($tag === 13) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \POGOProtos\Map\Fort\FortModifier();

                if ($this->modifiers === null) {
                    $this->modifiers = new \Protobuf\MessageCollection();
                }

                $this->modifiers->add($innerMessage);

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

        if ($this->fort_id !== null) {
            $size += 1;
            $size += $calculator->computeStringSize($this->fort_id);
        }

        if ($this->team_color !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->team_color->value());
        }

        if ($this->pokemon_data !== null) {
            $innerSize = $this->pokemon_data->serializedSize($context);

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->name !== null) {
            $size += 1;
            $size += $calculator->computeStringSize($this->name);
        }

        if ($this->image_urls !== null) {
            foreach ($this->image_urls as $val) {
                $size += 1;
                $size += $calculator->computeStringSize($val);
            }
        }

        if ($this->fp !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->fp);
        }

        if ($this->stamina !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->stamina);
        }

        if ($this->max_stamina !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->max_stamina);
        }

        if ($this->type !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->type->value());
        }

        if ($this->latitude !== null) {
            $size += 1;
            $size += 8;
        }

        if ($this->longitude !== null) {
            $size += 1;
            $size += 8;
        }

        if ($this->description !== null) {
            $size += 1;
            $size += $calculator->computeStringSize($this->description);
        }

        if ($this->modifiers !== null) {
            foreach ($this->modifiers as $val) {
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
        $this->fort_id = null;
        $this->team_color = null;
        $this->pokemon_data = null;
        $this->name = null;
        $this->image_urls = null;
        $this->fp = null;
        $this->stamina = null;
        $this->max_stamina = null;
        $this->type = null;
        $this->latitude = null;
        $this->longitude = null;
        $this->description = null;
        $this->modifiers = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \POGOProtos\Networking\Responses\FortDetailsResponse) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->fort_id = ($message->fort_id !== null) ? $message->fort_id : $this->fort_id;
        $this->team_color = ($message->team_color !== null) ? $message->team_color : $this->team_color;
        $this->pokemon_data = ($message->pokemon_data !== null) ? $message->pokemon_data : $this->pokemon_data;
        $this->name = ($message->name !== null) ? $message->name : $this->name;
        $this->image_urls = ($message->image_urls !== null) ? $message->image_urls : $this->image_urls;
        $this->fp = ($message->fp !== null) ? $message->fp : $this->fp;
        $this->stamina = ($message->stamina !== null) ? $message->stamina : $this->stamina;
        $this->max_stamina = ($message->max_stamina !== null) ? $message->max_stamina : $this->max_stamina;
        $this->type = ($message->type !== null) ? $message->type : $this->type;
        $this->latitude = ($message->latitude !== null) ? $message->latitude : $this->latitude;
        $this->longitude = ($message->longitude !== null) ? $message->longitude : $this->longitude;
        $this->description = ($message->description !== null) ? $message->description : $this->description;
        $this->modifiers = ($message->modifiers !== null) ? $message->modifiers : $this->modifiers;
    }


}

