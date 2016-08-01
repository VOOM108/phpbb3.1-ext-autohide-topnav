<?php
/**
*
* @package phpBB Extension - Autohide Topnav
* Derived by kilaya from maxwidth by crizz0
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace kilaya\autohidetopnav\migrations;

class kilaya_autohidetopnav_migrations extends \phpbb\db\migration\migration
{
	public function update_schema()
	{
		return array(
			'add_columns'		=> array(
				$this->table_prefix . 'users'	=> array(
					'user_ahtn'		=> array('BOOL', 0, 'after' => 'user_options'),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns'		=> array(
				$this->table_prefix . 'users'	=> array(
					'user_ahtn',
				),
			),
		);
	}
}
