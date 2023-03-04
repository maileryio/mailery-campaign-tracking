<?php

namespace Mailery\Campaign\Tracking\Mailer\Message\Middleware;

use Mailery\Campaign\Entity\Campaign;
use Mailery\Channel\Smtp\Mailer\Message\EmailMessage;
use Mailery\Template\Helper\LinkReplaceCallback;

class ShortUrlLinker
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
        if (!$this->campaign->getTrackClicks()) {
            return $message;
        }

        $replacer = new LinkReplaceCallback(function (string $link) {
            return '{% apply shortUrl(' . $this->campaign->getId() . ') %}' . $link . '{% endapply %}';
        });

        $new = clone $message;
        $new->subject($replacer($message->getSubject()));
        $new->html($replacer($message->getHtmlBody()), $message->getHtmlCharset());
        $new->text($replacer($message->getTextBody()), $message->getTextCharset());

        return $new;
    }

}
