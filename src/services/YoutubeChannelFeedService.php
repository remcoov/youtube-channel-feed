<?php
/**
 * Youtube Channel Feed plugin for Craft CMS 3.x
 *
 * This plugin contains both a widget and field type for getting a feed from a specific Youtube channel.
 *
 * @link      https://obaia.nl
 * @copyright Copyright (c) 2020 remcoov
 */

namespace remcoov\youtubechannelfeed\services;

use remcoov\youtubechannelfeed\YoutubeChannelFeed;

use Craft;
use craft\base\Component;

/**
 * YoutubeChannelFeedService Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    remcoov
 * @package   YoutubeChannelFeed
 * @since     1.0.0
 */
class YoutubeChannelFeedService extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     YoutubeChannelFeed::$plugin->youtubeChannelFeedService->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (YoutubeChannelFeed::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }

    public function getWidgetFeed(string $channel_id, int $limit) : array
    {
        $xml_data = @file_get_contents('https://www.youtube.com/feeds/videos.xml?channel_id='.$channel_id);
        $simplexml_load_string = simplexml_load_string($xml_data);
        $youtube_feed = json_decode(json_encode($simplexml_load_string), TRUE);

        $latestVideoId = str_replace("yt:video:", "", $youtube_feed['entry'][0]['id']);
        $latestVideoTitle = $youtube_feed['entry'][0]['title'];
        $channelTitle = $youtube_feed['entry'][0]['author']['name'];
        $channelUrl = $youtube_feed['entry'][0]['author']['uri'];

        $widgetFeed = [
            "latestVideoId" => $latestVideoId,
            "latestVideoTitle" => $latestVideoTitle,
            "channelTitle" => $channelTitle,
            "channelUrl" => $channelUrl,
            "youtube_feed" => $youtube_feed['entry'],
            "limit" => $limit
        ];

        return $widgetFeed;
    }

    public function getFeed(string $channel_id, int $limit = 15) : array
    {
        $xml_data = @file_get_contents('https://www.youtube.com/feeds/videos.xml?channel_id='.$channel_id);
        $xml = simplexml_load_string($xml_data);
        $youtube_feed = json_decode(json_encode($xml), TRUE);
        $youtube_feed = $youtube_feed['entry'];
        $youtube_feed = array_slice($youtube_feed, 0, $limit);

        return $youtube_feed;
    }

}