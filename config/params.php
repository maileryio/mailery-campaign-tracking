<?php

declare(strict_types=1);

use Yiisoft\Definitions\Reference;
use Mailery\Campaign\Twig\Extension\CampaignTrackingExtension;

return [
    'maileryio/mailery-template' => [
        'twig' => [
            'extensions' => [
                Reference::to(CampaignTrackingExtension::class),
            ],
        ],
    ],
];
