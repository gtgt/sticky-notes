<?php

/**
 * Sticky Notes
 *
 * An open source lightweight pastebin application
 *
 * @package     StickyNotes
 * @author      Sayak Banerjee
 * @copyright   (c) 2013 Sayak Banerjee <mail@sayakbanerjee.com>
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @link        http://sayakbanerjee.com/sticky-notes
 * @since       Version 1.0
 * @filesource
 */

/**
 * Paste class
 *
 * Manages and fetches pastes
 *
 * @package     StickyNotes
 * @subpackage  Models
 * @author      Sayak Banerjee
 */
class Paste extends Eloquent {

	/**
	 * Table name for the model
	 *
	 * @var string
	 */
	protected $table = 'main';

	/**
	 * Disable timestamps for the model
	 *
	 * @var bool
	 */
	public $timestamps = FALSE;

	/**
	 * Define fillable properties
	 *
	 * @var array
	 */
	protected $fillable = array(
		'id',
		'author',
		'project',
		'timestamp',
		'expire',
		'title',
		'data',
		'language',
		'password',
		'salt',
		'private',
		'hash',
		'ip',
		'urlkey',
		'hits'
	);

	/**
	 * Generates a unique URL key for the paste
	 *
	 * @static
	 * @return string
	 */
	public static function getUrlKey()
	{
		while (TRUE)
		{
			$key = strtolower(str_random(8));
			$count = Paste::where('urlkey', $key)->count();

			if ($count == 0)
			{
				return $key;
			}
		}
	}

	/**
	 * Returns the first five lines of a pasted code
	 *
	 * @static
	 * @return string
	 */
	public static function getAbstract($data)
	{
		$count = substr_count($data, "\n");

		if ($count > 5)
		{
			$lines = explode("\n", $data);
			$data = '';

			for ($idx = 0; $idx < 5; $idx++)
			{
				$data .= ($lines[$idx] . "\n");
			}
		}

		return trim($data);
	}

}