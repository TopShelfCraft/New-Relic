<?php
/**
 * New Relic
 *
 * @author     Michael Rog <michael@michaelrog.com>
 * @link       https://topshelfcraft.com
 * @copyright  Copyright 2018, Top Shelf Craft (Michael Rog)
 * @see        https://github.com/TopShelfCraft/New-Relic
 */

namespace topshelfcraft\newrelic;

use topshelfcraft\newrelic\models\Settings;

use Craft;
use craft\base\Plugin;

/**
 * @author    Top Shelf Craft (Michael Rog)
 * @package   NewRelic
 * @since     3.0.0
 *
 * @property  Settings $settings
 * @method    Settings getSettings()
 */
class NewRelic extends Plugin
{

    /*
     * Static Properties
     * =========================================================================
     */

    /**
     * @var NewRelic
     */
    public static $plugin;


    /*
     * Public Methods
     * =========================================================================
     */

    public function init()
    {

        parent::init();
        self::$plugin = $this;

        if (extension_loaded('newrelic'))
		{

			if (!empty($this->getSettings()->appName))
			{
				newrelic_set_appname($this->getSettings()->appName);
			}

			$name = Craft::$app->getRequest()->getSegment(1);

			if (Craft::$app->getRequest()->getSegment(2))
			{
				$name .= "/" . Craft::$app->getRequest()->getSegment(2);
			}

			if (Craft::$app->getRequest()->getIsLivePreview())
			{
				$name = "/LivePreview/{$name}";
			}
			elseif (Craft::$app->getRequest()->getIsCpRequest())
			{
				$name = Craft::$app->getConfig()->getGeneral()->cpTrigger . "/{$name}";
			}

			newrelic_name_transaction($name);

//			Craft::info(
//				Craft::t(
//					'new-relic',
//					'New Relic transaction named: {name}',
//					['name' => $name]
//				),
//				'new-relic'
//			);

		}

    }


    /*
     * Protected Methods
     * =========================================================================
     */

    /**
     * Creates and returns the model used to store the plugin’s settings.
     *
     * @return \craft\base\Model|null
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    /**
     * Returns the rendered settings HTML, which will be inserted into the content
     * block on the settings page.
     *
     * @return string The rendered settings HTML
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'new-relic/settings',
            [
                'settings' => $this->getSettings()
            ]
        );
    }

}
