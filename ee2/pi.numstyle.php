<?php if ( ! defined('APP_VER')) exit('No direct script access allowed');


$plugin_info = array(
	'pi_name'        => 'Numstyle',
	'pi_version'     => '1.0a',
	'pi_author'      => 'Brandon Kelly',
	'pi_author_url'  => 'http://brandon-kelly.com',
	'pi_description' => 'Converts numbers to letters',
	'pi_usage'       => '{exp:numstyle:upper_alpha num="1"} → A' . NL
	                  . '{exp:numstyle:lower_alpha num="1"} → a'
);


/**
 * Numstyle
 * 
 * @author    Brandon Kelly <brandon@pixelandtonic.com>
 * @copyright Copyright (c) 2011 Pixel & Tonic, Inc
 */
class Numstyle {

	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->EE =& get_instance();

		$this->num = $this->EE->TMPL->fetch_param('num');
	}

	// -----------------------------------------------------------------------

	private function _alpha($ascii_offset)
	{
		$num = $this->num - 1;
		$alpha = '';

		while ($num >= 0)
		{
			$ascii = ($num % 26) + $ascii_offset;
			$alpha = chr($ascii) . $alpha;

			$num = intval($num / 26) - 1;
		}

		return $alpha;
	}

	/**
	 * Upper Alpha
	 */
	function upper_alpha()
	{
		return $this->_alpha(65);
	}

	/**
	 * Lower Alpha
	 */
	function lower_alpha()
	{
		return $this->_alpha(97);
	}

}
