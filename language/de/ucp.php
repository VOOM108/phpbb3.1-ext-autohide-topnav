<?php
/**
*
* @package phpBB Extension - Autohide Topnav
* Derived by kilaya from maxwidth by crizz0
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'AHTN'			=> 'Navigationsleiste automatisch verstecken beim Scrollen',
	'AHTN_EXPLAIN'	=> 'Ja = Navileiste wird ausgeblendet - Nein = Navileiste bleibt immer sichtbar',
));
