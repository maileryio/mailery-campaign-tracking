<?php

declare(strict_types=1);

/**
 * Campaign tracking module for Mailery Platform
 * @link      https://github.com/maileryio/mailery-campaign-tracking
 * @package   Mailery\Campaign\Tracking
 * @license   BSD-3-Clause
 * @copyright Copyright (c) {$date}, Mailery (https://mailery.io/)
 */

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Php80\Rector\FunctionLike\MixedTypeRector;
use Rector\Php80\Rector\FunctionLike\UnionTypesRector;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    // skip rules
    $rectorConfig->skip([
        UnionTypesRector::class,
        MixedTypeRector::class,
    ]);

    // define sets of rules
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81,
    ]);
};
