# Youtube Channel Feed plugin for Craft CMS 3.x

This is a Craft CMS plugin for outputting a Youtube channel feed as a widget, or in your templates via a variable.

_Note:_ the feed that is being fetched is a public .xml feed that Youtube provides, which has its limits. I'm aware of the fact that when using the Youtube API there is no limit to the feed and that there are more options available, but that was not my intent when making this plugin. So, beware ;-)

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

Most of the times the sky is the limit, but the public feed Youtube provides of a channel does have a maximum limit of 15. So, the number you'd provide here should be 15 or less.

### 2. Variable (in templates)

You can also use a variable to output a Youtube channel feed in your twig template(s). The variable has two parameters, much like the settings in the widget: **channel id** (required) and **limit** (optional).

Take a look at the code below, for an example of how to use the variable with its parameters and all the optional data to output.

_Note:_ not every video has all the thumbnails available.

```
{% set youtube_feed = craft.youtubeChannelFeed.getFeed('UCzQUP1qoWDoEbmsQxvdjxgQ', 5) %}

{% for video in youtube_feed %}
    {{ video['title'] }} <br>
    {{ video['url'] }} <br>
    {{ video['published']|date('Y-m-d H:i:s') }} <br>
    {{ video['embed']|raw }} <br>
    {{ video['id'] }} <br>
    {{ video['thumb']['default'] }} <br>
    {{ video['thumb']['hqdefault'] }} <br>
    {{ video['thumb']['mqdefault'] }} <br>
    {{ video['thumb']['sddefault'] }} <br>
    {{ video['thumb']['maxresdefault'] }} <br>
    {{ video['preview']['0'] }} <br>
    {{ video['preview']['1'] }} <br>
    {{ video['preview']['2'] }} <br>
    {{ video['preview']['3'] }}
{% endfor %}
```