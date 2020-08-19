<?php
/**
 * Youtube Channel Feed plugin for Craft CMS 3.x
 *
 * This plugin contains both a widget and field type for getting a feed from a specific Youtube channel.
 *
 * @link      https://obaia.nl
 * @copyright Copyright (c) 2020 remcoov
 */

namespace remcoov\youtubechannelfeed\variables;

use remcoov\youtubechannelfeed\YoutubeChannelFeed;

use Craft;

/**
 * Youtube Channel Feed Variable
 *
 * Craft allows plugins to provide their own template variables, accessible from
 * the {{ craft }} global variable (e.g. {{ craft.youtubeChannelFeed }}).
 *
 * https://craftcms.com/docs/plugins/variables
 *
 * @author    remcoov
 * @package   YoutubeChannelFeed
 * @since     1.0.0
 */
class YoutubeChannelFeedVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Whatever you want to output to a Twig template can go into a Variable method.
     * You can have as many variable functions as you want.  From any Twig template,
     * call it like this:
     *
     *     {{ craft.youtubeChannelFeed.exampleVariable }}
     *
     * Or, if your variable requires parameters from Twig:
     *
     *     {{ craft.youtubeChannelFeed.exampleVariable(twigValue) }}
     *
     * @param null $optional
     * @return string
     */

    public function getFeed(string $channel_id, int $limit)
    {
        // $feed = YoutubeChannelFeed::getInstance()->youtubeChannelFeedService->getFeed($channel_id, $limit);
        // return $feed;
    }

}
