<?php

namespace Mailery\Campaign\Tracking\Helper;

use Yiisoft\Validator\Rule\Url;

class LinkReplaceCallback
{

    /**
     * @param callable $callback
     */
    public function __construct(
        private \Closure $callback
    ) {}

    /**
     * @param string $content
     * @return string
     */
    public function __invoke(string $content): string
    {
        $replaces = [];
        $validator = Url::rule();

        preg_match_all('/<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>/siU', $content, $matches, PREG_PATTERN_ORDER);
        $matches = array_unique($matches[2]);

        foreach ($matches as $match) {
            $match = trim($match, '\'');

            if (!$validator->validate($match)->isValid()) {
                continue;
            }

            $replaced = (string) call_user_func($this->callback, html_entity_decode($match));

            $replaces['href="' . $match . '"'] = 'href="' . $replaced . '"';
            $replaces['href=\'' . $match . '\''] = 'href="' . $replaced . '"';
        }

        return str_replace(array_keys($replaces), array_values($replaces), $content);
    }

}
