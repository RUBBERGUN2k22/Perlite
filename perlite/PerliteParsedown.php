<?php

include('Parsedown.php');

class PerliteParsedown extends Parsedown
{

    #
    # Callout (based on blockQuotes)
    # See: https://help.obsidian.md/How+to/Use+callouts

    protected function blockQuote($Line)
    {
        $quote = parent::blockQuote($Line);

        if ( ! isset($quote))
        {
            return null;
        }

        if (preg_match('/^>\s?\[\!(.*?)\](.*?)$/m', $Line['text'], $matches))
        {
            $type = strtolower($matches[1]);
            $title = $matches[2];

            $quote['element']['attributes']['class'] = "callout";
            $quote['element']['attributes']['data-callout'] = $type;
            $quote['element']['text'][0] = $title ? : ucfirst($type);
        }

        return $quote;
    }
}