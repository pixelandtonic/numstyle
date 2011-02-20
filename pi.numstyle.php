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

	/**
	 * Upper Alpha
	 */
	function upper_alpha()
	{
		$num = $this->num - 1;
		$alpha = '';

		while ($num >= 0)
		{
			$ascii = ($num % 26) + 65;
			$alpha = chr($ascii) . $alpha;

			$num = intval($num / 26) - 1;
		}

		return $alpha;
	}

	/**
	 * Lower Alpha
	 */
	function lower_alpha()
	{
		return strtolower($this->upper_alpha());
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
			'M'  => 1000000,
			'CM' => 900000,
			'D'  => 500000,
			'CD' => 400000,
			'C'  => 100000,
			'XC' => 90000,
			'L'  => 50000,
			'XL' => 40000,
			'X'  => 10000,
			'IX' => 9000,
			'V'  => 5000,
			'IV' => 4000,
			'M'  => 1000,
			'CM' => 900,
			'D'  => 500,
			'CD' => 400,
			'C'  => 100,
			'XC' => 90,
			'L'  => 50,
			'XL' => 40,
			'X'  => 10,
			'IX' => 9,
			'V'  => 5,
			'IV' => 4,
			'I'  => 1
		);

		foreach ($map as $k => $v)
		{
			while ($num >= $v) {
				$roman .= $k;
				$num -= $v;
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
