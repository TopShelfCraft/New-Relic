# New Relic

_a plugin for Craft CMS_

**A [Top Shelf Craft](https://topshelfcraft.com) creation**  
[Michael Rog](https://michaelrog.com), Proprietor

_Instrument your Craft app with [New Relic APM](https://newrelic.com/products/application-monitoring)._


* * *


## tl:dr

This plugin helps connect your Craft app with New Relic APM by setting transaction names and (optionally) an app name on each request.


## Installation

1. From your project directory, use Composer to require the plugin package:

   ```
   composer require topshelfcraft/new-relic
   ```

2. In the Control Panel, go to Settings → Plugins and click the “Install” button for _New Relic_.

3. Add a `new-relic.php` config file, edit the plugin Settings as needed.

_The New Relic plugin is also available for installation via the Craft CMS Plugin Store._


## Configuration

You can use the Control Panel settings screen to configure the plugin, or add a `new-relic.php` file to your Craft config directory:

```php
<?php
return [

    /*
     * Specify a different app name than
     * the one provided in your .ini files,
     * e.g. If you want to change the app name
     * on a per-environment basis...
     */
    'appName' => '',
    
    /*
     * Specify a string to override Segment 2
     * from the request path, e.g. If you want to
     * consolidate your reported routes...
     */
    'groupSegment2As' => '',

];
```

## Enabling/Disabling for Testing

Leaving New Relic enabled when running test suites may cause [problems](https://github.com/TopShelfCraft/New-Relic/issues/7) — particularly when using CLI tools like Codeception — because Craft's `isConsoleRequest()` method may return erroneously when bootstrapped in a testing context.

To disable New Relic during testing, add the plugin handle to `disabledPlugins`, in the `general.php` config file _in your Testing setup_:

```php
<?php
return [
    // ...
    
    'disabledPlugins' => [
        'new-relic',
    ],
    
    // ...
];
```

If you specifically _need_ to use New Relic while running tests, you'll need to explicitly tweak the request in your test bootstrap:

```php
Yii:$app->request->setIsConsoleRequest(Yii:$app->request instanceof yii/console/Request);
```


## What is New Relic?

New Relic provides tools for real-time monitoring and performance insight. When every aspect of your software and infrastructure is observable, you can can find and fix problems faster.
[New Relic APM](https://newrelic.com/products/application-monitoring) (Application Performance Monitoring) helps you build, deploy, and maintain great software by providing
detailed performance metrics for every aspect of your environment. 

This plugin assumes you already have an account set up at [newrelic.com](https://newrelic.com) and that you have
[installed the APM tool](https://docs.newrelic.com/docs/agents/php-agent/installation/php-agent-installation-overview) in your environment.
  
_(This plugin is an *unofficial* companion to your New Relic setup for Craft. New Relic APM is a trademark of New Relic, Inc.)_


## Support


### What are the system requirements?

Craft 4.0+ and PHP 8.0+


### I found a bug.

Suuuuure you did.


### I triple-checked. It's a bug.

Well then, thanks for looking out for me. Please open a GitHub [Issue](https://github.com/TopShelfCraft/New-Relic/issues) or submit a PR to the `4.x.dev` branch.


* * *


#### Contributors:

 - Plugin development: [Michael Rog](https://michaelrog.com) / @michaelrog
 - Craft 2 plugin: [Josh Angel](https://github.com/supercool) / @josh_angell
 - Icon: [New Relic](https://newrelic.com/about/media-assets)
