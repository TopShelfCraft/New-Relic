<?php
namespace TopShelfCraft\NewRelic;

use Craft;
use TopShelfCraft\base\Plugin;

/**
 * @author Michael Rog <michael@michaelrog.com>
 * @link https://topshelfcraft.com
 * @copyright Copyright 2022, Top Shelf Craft (Michael Rog)
 *
 * @method Settings getSettings()
 */
class NewRelic extends Plugin
{

	public bool $hasCpSection = false;
	public bool $hasCpSettings = true;
	public string $schemaVersion = '0.0.0.0';
	public ?string $changelogUrl = "https://raw.githubusercontent.com/TopShelfCraft/New-Relic/master/CHANGELOG.md";

	public function init()
	{

		parent::init();

		if (extension_loaded('newrelic'))
		{

			if (!empty($this->getSettings()->appName))
			{
				newrelic_set_appname($this->getSettings()->appName);
			}

			$request = Craft::$app->getRequest();

			if ($request->getIsConsoleRequest())
			{

				/*
				 * Console requests have no concept of a URI or segments,
				 * so we'll name the transaction based on the resolved route.
				 */

				$route = ($request->resolve())[0];
				$name = "Console/{$route}";

			}
			else
			{

				/*
				 * We're in a web request, so we can name the transaction based on segments/context.
				 */

				$name = '/' . $request->getSegment(1);

				$segment2 = $request->getSegment(2);

				/*
				 * Careful... We can't just check emptiness because `null` means no segment found,
				 * and '0' could be a valid segment.
				 */
				if (is_string($segment2) && $segment2 !== '')
				{

					$segment2 = ($this->getSettings()->groupSegment2As !== '')
						? $this->getSettings()->groupSegment2As
						: $segment2;

					$name .= "/" . $segment2;

				}

				if ($request->getIsLivePreview())
				{
					$name = "LivePreview" . $name;
				}
				elseif ($request->getIsCpRequest())
				{
					$name = Craft::$app->getConfig()->getGeneral()->cpTrigger . $name;
				}

			}

			newrelic_name_transaction($name);

		}

	}

	/**
	 * Creates and returns the model used to store the plugin’s settings.
	 */
	protected function createSettingsModel(): Settings
	{
		return new Settings();
	}

	/**
	 * Returns the rendered settings HTML, which will be inserted into the content
	 * block on the settings page.
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
