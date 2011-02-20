<?php if ( ! defined('APP_VER')) exit('No direct script access allowed');


$plugin_info = array(
	'pi_name'        => 'Numstyle',
	'pi_version'     => '1.0a',
	'pi_author'      => 'Brandon Kelly',
	'pi_author_url'  => 'http://brandon-kelly.com',
	'pi_description' => 'Converts numbers to letters',
	'pi_usage'       => '{exp:numstyle:lower_alpha num="1"} → a' . NL
	                  . '{exp:numstyle:upper_alpha num="1"} → B' . NL
	                  . '{exp:numstyle:lower_roman num="3"} → iii' . NL
	                  . '{exp:numstyle:upper_roman num="4"} → IV'
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

	// -----------------------------------------------------------------------

	/**
	 * Upper Roman
	 */
	function upper_roman()
	{
		$num = $this->num;
		$roman = '';

		$map = array(
			array(1000000, 'M'),
			array(900000, 'CM'),
			array(500000, 'D'),
			array(400000, 'CD'),
			array(100000, 'C'),
			array(90000, 'XC'),
			array(50000, 'L'),
			array(40000, 'XL'),
			array(10000, 'X'),
			array(9000, 'IX'),
			array(5000, 'V'),
			array(4000, 'IV'),
			array(1000, 'M'),
			array(900, 'CM'),
			array(500, 'D'),
			array(400, 'CD'),
			array(100, 'C'),
			array(90, 'XC'),
			array(50, 'L'),
			array(40, 'XL'),
			array(10, 'X'),
			array(9, 'IX'),
			array(5, 'V'),
			array(4, 'IV'),
			array(1, 'I')
		);

		foreach ($map as $pair)
		{
			while ($num >= $pair[0]) {
				$roman .= $pair[1];
				$num -= $pair[0];
			}
		}

		return $roman;
	}

	/**
	 * Lower Roman
	 */
	function lower_roman()
	{
		return strtolower($this->upper_roman());
	}

}
