# Youtube Channel Feed plugin for Craft CMS 3.x

This is a Craft CMS widget for getting a feed from a specific Youtube channel.

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require remcoov/youtube-channel-feed

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Youtube Channel Feed.

## Using Youtube Channel Feed

At this point there are two simple settings:

#### Youtube Channel ID

This is a 24 character **channel id** found in the url of a Youtube channel. For example: the Joe Rogan Podcast (PowerfulJRE) channel url is:
> https://www.youtube.com/channel/UCzQUP1qoWDoEbmsQxvdjxgQ

where the **channel id** would be:

> UCzQUP1qoWDoEbmsQxvdjxgQ

#### Limit

Most of the times the sky is the limit, but unfortunately the public feed Youtube provides of a channel does have a max limit of 15. So, the number you'd provide here should be 15 or less.