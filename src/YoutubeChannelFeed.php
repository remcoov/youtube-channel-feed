<?php
/**
 * Youtube Channel Feed plugin for Craft CMS 3.x
 *
 * @link      https://github.com/remcoov
 * @copyright Copyright (c) 2020 remcoov
 */

namespace remcoov\youtubechannelfeed;

use remcoov\youtubechannelfeed\services\YoutubeChannelFeedService as YoutubeChannelFeedServiceService;
use remcoov\youtubechannelfeed\variables\YoutubeChannelFeedVariable;
use remcoov\youtubechannelfeed\widgets\YoutubeChannelFeedWidget as YoutubeChannelFeedWidgetWidget;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\console\Application as ConsoleApplication;
use craft\web\UrlManager;
use craft\services\Elements;
use craft\services\Fields;
use craft\services\Utilities;
use craft\web\twig\variables\CraftVariable;
use craft\services\Dashboard;
use craft\events\RegisterComponentTypesEvent;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * @author    remcoov
 * @package   YoutubeChannelFeed
 * @since     1.0.0
 *
 * @property  YoutubeChannelFeedServiceService $youtubeChannelFeedService
 * @property  Settings $settings
 * @method    Settings getSettings()
 */
class YoutubeChannelFeed extends Plugin
{
    // Static Properties
    // =========================================================================

    public static $plugin;

    // Public Properties
    // =========================================================================

    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        // Register our widgets
        Event::on(
            Dashboard::class,
            Dashboard::EVENT_REGISTER_WIDGET_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = YoutubeChannelFeedWidgetWidget::class;
            }
        );

        // Register our variables
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('youtubeChannelFeed', YoutubeChannelFeedVariable::class);
            }
        );

        Craft::info(
            Craft::t(
                'youtube-channel-feed',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    protected function createSettingsModel()
    {
        return new Settings();
    }

    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'youtube-channel-feed/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }
}
