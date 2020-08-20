<?php
/**
 * Youtube Channel Feed plugin for Craft CMS 3.x
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

    public function getFeed(string $channel_id, int $limit = 15) : array
    {
        $feed = YoutubeChannelFeed::getInstance()->youtubeChannelFeedService->getFeed($channel_id, $limit);
        return $feed;
    }
}