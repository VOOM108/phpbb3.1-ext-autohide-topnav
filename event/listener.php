<?php
/**
*
* @package phpBB Extension - Autohide Topnav
* Derived by kilaya from maxwidth by crizz0
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace kilaya\autohidetopnav\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\request\request		$request	Request object
	* @param \phpbb\template\template	$template	Template object
	* @param \phpbb\user				$user		User object
	* @return \crizzo\maxwidthswitch\event\listener
	* @access public
	*/
	public function __construct(\phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header'					=> 'include_autohide_in_template',
			'core.ucp_prefs_view_data'			=> 'ucp_prefs_add',
			'core.ucp_prefs_view_update_data'	=> 'ucp_prefs_update',
		);
	}

	/**
	* Includes CSS in template if the radiobox in UCP was selected
	*
	* @param object	$event The event object
	* @return null
	* @access public
	*/
	public function include_autohide_in_template($event)
	{
		$this->template->assign_vars(array(
			'S_INCLUDE_AHTN'	=> $this->user->data['user_ahtn'],
		));
	}

	/**
	* Add configuration to UCP
	*
	* @param object	$event The event object
	* @return null
	* @access public
	*/
	public function ucp_prefs_add($event)
	{
		$this->user->add_lang_ext('kilaya/autohidetopnav', 'ucp');

		// I'm so happy that this is just a radiobox! Just a boolean! <3
		$ahtn = $this->request->variable('ahtn', (bool) $this->user->data['user_ahtn']);
		$event['data'] = array_merge($event['data'], array(
			'ahtn'	=> $ahtn,
		));

		$this->template->assign_vars(array(
			'S_AHTN'	=> $ahtn,
		));
	}

	/**
	* Updates configuration in UCP
	*
	* @param object	$event The event object
	* @return null
	* @access public
	*/
	public function ucp_prefs_update($event)
	{
		// I'm so excited!
		$event['sql_ary'] = array_merge($event['sql_ary'], array(
			'user_ahtn'		=> $event['data']['ahtn'],
		));
	}
}
