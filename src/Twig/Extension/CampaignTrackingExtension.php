<?php

namespace Mailery\Campaign\Tracking\Twig\Extension;

use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class CampaignTrackingExtension extends AbstractExtension
{

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new TwigFilter(
                'shortUrl',
                function (string $url, int $campaignId) {
                    return $url;
                }
            )
        ];
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new TwigFunction(
                'trackingPixel',
                function (int $campaignId) {
                    return '';
                }
            )
        ];
    }

}
