<?php
namespace Pokapi\Rpc\Requests;

use POGOProtos\Enums\TutorialState;
use POGOProtos\Networking\Requests\Messages\MarkTutorialCompleteMessage;
use POGOProtos\Networking\Responses\MarkTutorialCompleteResponse;
use POGOProtos\Networking\Requests\RequestType;
use Pokapi\Rpc\Request;

/**
 * Class MarkTutorialComplete
 *
 * @package Pokapi\Rpc\Requests
 * @author Freek Post <freek@kobalt.blue>
 */
class MarkTutorialComplete extends Request
{

    /**
     * {@inheritDoc}
     */
    public function getType() : RequestType
    {
        return RequestType::MARK_TUTORIAL_COMPLETE();
    }

    /**
     * {@inheritDoc}
     */
    public function getMessage()
    {
        $message = new MarkTutorialCompleteMessage();
        $message->addTutorialsCompleted(TutorialState::LEGAL_SCREEN());
        $message->addTutorialsCompleted(TutorialState::FIRST_TIME_EXPERIENCE_COMPLETE());
        $message->setSendMarketingEmails(false);
        $message->setSendPushNotifications(false);
        return new $message();
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse(string $data)
    {
        return new MarkTutorialCompleteResponse();
    }
}
