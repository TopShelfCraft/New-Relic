<?php
/**
 * New Relic
 *
 * @author     Michael Rog <michael@michaelrog.com>
 * @link       https://topshelfcraft.com
 * @copyright  Copyright 2018, Top Shelf Craft (Michael Rog)
 * @see        https://github.com/TopShelfCraft/New-Relic
 */

namespace topshelfcraft\newrelic\models;

use craft\base\Model;

/**
 * @author    Top Shelf Craft (Michael Rog) <support@topshelfcraft.com>
 * @package   NewRelic
 * @since     3.0.0
 */
class Settings extends Model
{

	/*
	 * Public Properties
	 * =========================================================================
	 */

    /**
     * Some field model attribute
     *
     * @var string
     */
    public $appName = '';

    /**
     * Some field model attribute
     *
     * @var boolean
     */
    public $includeSegment2 = '1';

    /*
     * Public Methods
     * =========================================================================
     */

    /**
     * Returns the validation rules for attributes.
	 *
     * @see http://www.yiiframework.com/doc-2.0/guide-input-validation.html
     *
     * @return array
     */
    public function rules()
    {
        return [
            ['appName', 'string'],
            ['appName', 'default', 'value' => ''],
            ['includeSegment2', 'string'],
            ['includeSegment2', 'default', 'value' => '1'],
        ];
    }

}
