<?php

namespace Mailery\Campaign\Tracking\Mailer\Message\Middleware;

use Mailery\Campaign\Entity\Campaign;
use Mailery\Channel\Smtp\Mailer\Message\EmailMessage;

class TrackingPixel
{

    /**
     * @param Campaign $campaign
     */
    public function __construct(
        private Campaign $campaign
    ) {}

    /**
     * @param EmailMessage $message
     * @return EmailMessage
     */
    public function __invoke(EmailMessage $message): EmailMessage
    {
        if (!$this->campaign->getTrackOpens()) {
            return $message;
        }

        $new = clone $message;
        $new->html(str_replace(
            '</body>',
            '{{ trackingPixel(' . $this->campaign->getId() . ') }}</body>',
            $message->getHtmlBody()
        ));

        return $new;
    }

}
