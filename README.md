# Youtube Channel Feed plugin for Craft CMS 3.x

This is a Craft CMS plugin for outputting a Youtube channel feed as a widget, or in your templates via a variable.

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

### 1. Widget

At this point there are two simple settings in the widget:

#### Youtube Channel ID

This is a 24 character **channel id** found in the url of a Youtube channel. For example: the Joe Rogan Podcast (PowerfulJRE) channel url is:
> https://www.youtube.com/channel/UCzQUP1qoWDoEbmsQxvdjxgQ

where the **channel id** would be:

> UCzQUP1qoWDoEbmsQxvdjxgQ

#### Limit

Most of the times the sky is the limit, but unfortunately the public feed Youtube provides of a channel does have a max limit of 15. So, the number you'd provide here should be 15 or less.

### 2. Variable (in templates)

You can use a variable to output a Youtube channels' feed in your twig template(s).

```{% set youtube_feed = craft.youtubeChannelFeed.getFeed() %}```

The variable has two parameters: the channel id (required) and a limit (optional).

Take a look at the code below, for an example of how to use the variable and all the optional data to output:

```
{% set youtube_feed = craft.youtubeChannelFeed.getFeed('UCzQUP1qoWDoEbmsQxvdjxgQ', 5) %}

{% for video in youtube_feed %}
    {{ video['title'] }} <br>
    {{ video['url'] }} <br>
    {{ video['id'] }} <br>
    {{ video['published'] }} <br>
    {{ video['embed']|raw }} <br>
{% endfor %}
```