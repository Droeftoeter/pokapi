<?php
/**
 * Generated by Protobuf protoc plugin.
 *
 * File descriptor : POGOProtos.Networking.Responses.proto
 */


namespace POGOProtos\Networking\Responses;

/**
 * Protobuf message : POGOProtos.Networking.Responses.FortDeployPokemonResponse
 */
class FortDeployPokemonResponse extends \Protobuf\AbstractMessage
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
     * @var \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    protected $result = null;

    /**
     * fort_details optional message = 2
     *
     * @var \POGOProtos\Networking\Responses\FortDetailsResponse
     */
    protected $fort_details = null;

    /**
     * pokemon_data optional message = 3
     *
     * @var \POGOProtos\Data\PokemonData
     */
    protected $pokemon_data = null;

    /**
     * gym_state optional message = 4
     *
     * @var \POGOProtos\Data\Gym\GymState
     */
    protected $gym_state = null;

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
     * @return \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set 'result' value
     *
     * @param \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result $value
     */
    public function setResult(\POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result $value = null)
    {
        $this->result = $value;
    }

    /**
     * Check if 'fort_details' has a value
     *
     * @return bool
     */
    public function hasFortDetails()
    {
        return $this->fort_details !== null;
    }

    /**
     * Get 'fort_details' value
     *
     * @return \POGOProtos\Networking\Responses\FortDetailsResponse
     */
    public function getFortDetails()
    {
        return $this->fort_details;
    }

    /**
     * Set 'fort_details' value
     *
     * @param \POGOProtos\Networking\Responses\FortDetailsResponse $value
     */
    public function setFortDetails(\POGOProtos\Networking\Responses\FortDetailsResponse $value = null)
    {
        $this->fort_details = $value;
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
            'fort_details' => null,
            'pokemon_data' => null,
            'gym_state' => null
        ], $values);

        $message->setResult($values['result']);
        $message->setFortDetails($values['fort_details']);
        $message->setPokemonData($values['pokemon_data']);
        $message->setGymState($values['gym_state']);

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public static function descriptor()
    {
        return \google\protobuf\DescriptorProto::fromArray([
            'name'      => 'FortDeployPokemonResponse',
            'field'     => [
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 1,
                    'name' => 'result',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_ENUM(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Networking.Responses.FortDeployPokemonResponse.Result'
                ]),
                \google\protobuf\FieldDescriptorProto::fromArray([
                    'number' => 2,
                    'name' => 'fort_details',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Networking.Responses.FortDetailsResponse'
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
                    'name' => 'gym_state',
                    'type' => \google\protobuf\FieldDescriptorProto\Type::TYPE_MESSAGE(),
                    'label' => \google\protobuf\FieldDescriptorProto\Label::LABEL_OPTIONAL(),
                    'type_name' => '.POGOProtos.Data.Gym.GymState'
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

        if ($this->fort_details !== null) {
            $writer->writeVarint($stream, 18);
            $writer->writeVarint($stream, $this->fort_details->serializedSize($sizeContext));
            $this->fort_details->writeTo($context);
        }

        if ($this->pokemon_data !== null) {
            $writer->writeVarint($stream, 26);
            $writer->writeVarint($stream, $this->pokemon_data->serializedSize($sizeContext));
            $this->pokemon_data->writeTo($context);
        }

        if ($this->gym_state !== null) {
            $writer->writeVarint($stream, 34);
            $writer->writeVarint($stream, $this->gym_state->serializedSize($sizeContext));
            $this->gym_state->writeTo($context);
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

                $this->result = \POGOProtos\Networking\Responses\FortDeployPokemonResponse\Result::valueOf($reader->readVarint($stream));

                continue;
            }

            if ($tag === 2) {
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \POGOProtos\Networking\Responses\FortDetailsResponse();

                $this->fort_details = $innerMessage;

                $context->setLength($innerSize);
                $innerMessage->readFrom($context);
                $context->setLength($length);

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
                \Protobuf\WireFormat::assertWireType($wire, 11);

                $innerSize    = $reader->readVarint($stream);
                $innerMessage = new \POGOProtos\Data\Gym\GymState();

                $this->gym_state = $innerMessage;

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

        if ($this->result !== null) {
            $size += 1;
            $size += $calculator->computeVarintSize($this->result->value());
        }

        if ($this->fort_details !== null) {
            $innerSize = $this->fort_details->serializedSize($context);

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->pokemon_data !== null) {
            $innerSize = $this->pokemon_data->serializedSize($context);

            $size += 1;
            $size += $innerSize;
            $size += $calculator->computeVarintSize($innerSize);
        }

        if ($this->gym_state !== null) {
            $innerSize = $this->gym_state->serializedSize($context);

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
        $this->result = null;
        $this->fort_details = null;
        $this->pokemon_data = null;
        $this->gym_state = null;
    }

    /**
     * {@inheritdoc}
     */
    public function merge(\Protobuf\Message $message)
    {
        if ( ! $message instanceof \POGOProtos\Networking\Responses\FortDeployPokemonResponse) {
            throw new \InvalidArgumentException(sprintf('Argument 1 passed to %s must be a %s, %s given', __METHOD__, __CLASS__, get_class($message)));
        }

        $this->result = ($message->result !== null) ? $message->result : $this->result;
        $this->fort_details = ($message->fort_details !== null) ? $message->fort_details : $this->fort_details;
        $this->pokemon_data = ($message->pokemon_data !== null) ? $message->pokemon_data : $this->pokemon_data;
        $this->gym_state = ($message->gym_state !== null) ? $message->gym_state : $this->gym_state;
    }


}

