<?php
/**
 * Youtube Channel Feed plugin for Craft CMS 3.x
 *
 * @link      https://github.com/remcoov
 * @copyright Copyright (c) 2020 remcoov
 */

namespace remcoov\youtubechannelfeed\services;

use remcoov\youtubechannelfeed\YoutubeChannelFeed;

use Craft;
use craft\base\Component;

/**
 * @author    remcoov
 * @package   YoutubeChannelFeed
 * @since     1.0.0
 */
class YoutubeChannelFeedService extends Component
{
    // Public Methods
    // =========================================================================

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
        $simplexml_load_string = simplexml_load_string($xml_data);
        $youtube_feed = json_decode(json_encode($simplexml_load_string), TRUE);
        $youtube_feed_entries = array_slice($youtube_feed['entry'], 0, $limit);

        $feed = array();
        foreach($youtube_feed_entries as $video) {
            $video_id = str_replace("yt:video:", "", $video['id']);

            $feed[] = array(
                'channel_name' => $youtube_feed['author']['name'],
                'channel_url' => $youtube_feed['author']['uri'],
                'title' => $video['title'],
                'url' => $video['link']['@attributes']['href'],
                'id' => str_replace("yt:video:", "", $video['id']),
                'published' => $video['published'],
                'updated' => $video['updated'],
                'embed' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.str_replace("yt:video:", "", $video['id']).'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                'thumb' => array(
                    'default' => 'https://img.youtube.com/vi/'.$video_id.'/default.jpg',
                    'hqdefault' => 'https://img.youtube.com/vi/'.$video_id.'/hqdefault.jpg',
                    'mqdefault' => 'https://img.youtube.com/vi/'.$video_id.'/mqdefault.jpg',
                    'sddefault' => 'https://img.youtube.com/vi/'.$video_id.'/sddefault.jpg',
                    'maxresdefault' => 'https://img.youtube.com/vi/'.$video_id.'/maxresdefault.jpg'
                ),
                'preview' => array(
                    '0' => 'https://img.youtube.com/vi/'.$video_id.'/0.jpg',
                    '1' => 'https://img.youtube.com/vi/'.$video_id.'/1.jpg',
                    '2' =>'https://img.youtube.com/vi/'.$video_id.'/2.jpg',
                    '3' =>'https://img.youtube.com/vi/'.$video_id.'/3.jpg'
                )
            );
        }

        return $feed;
    }

}