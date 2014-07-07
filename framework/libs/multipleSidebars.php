<?php

/**
 * Class to implement multiple sidebars functionality.
 */

class multipleSidebars
{
	private $helper;
	private $sidebars;
	private static $instance;

	private function __construct()
	{
		$this->helper = Helper::getInstance();
		$this->init();
		$this->sidebars = $this->getSidebars();
		$this->registerMultipleSidebars();
	}

	public static function getInstance()
	{
	  if (self::$instance == null)
	  {
	    self::$instance = new self();
	  }

	  return self::$instance;
	}

	public function init()
	{
		//Add sidebars link to admin menu
		add_action('admin_menu', array($this, 'sidebarsAdminMenu'));
		add_action('wp_ajax_addSidebar', array($this, 'addSidebar'));
		add_action('wp_ajax_removeSidebar', array($this, 'removeSidebar'));

		//edit posts/pages
		add_action('edit_form_advanced', array($this, 'editForm'));
		add_action('edit_page_form', array($this, 'editForm'));

		//save posts/pages
		add_action('edit_post', array($this, 'saveForm'));
		add_action('publish_post', array($this, 'saveForm'));
		add_action('save_post', array($this, 'saveForm'));
		add_action('edit_page_form', array($this, 'saveForm'));
	}

	public function registerMultipleSidebars()
	{
    if($this->sidebars){
			foreach($this->sidebars as $sidebar){
				$sidebarClass = self::sidebarsNameToClass($sidebar);
				register_sidebar(array(
					'name'=>$sidebar,
					'id' => 'salamander-custom-sidebar-' . strtolower($sidebarClass),
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<div class="heading"><h3>',
					'after_title' => '</h3></div>',
	    	));
			}
		}
	}

	public function sidebarsAdminMenu()
	{
		add_theme_page('Sidebars', 'Sidebars', 'manage_options', 'multiple_sidebars', array($this, 'adminPage'));
	}

	public function adminPage()
	{
		$vars = array();
		if ($this->sidebars)
		{
			foreach ($this->sidebars as $key => $sidebar)
			{
				$vars[$key]['name'] = $sidebar;
				$vars[$key]['class'] = multipleSidebars::sidebarsNameToClass($sidebar);
			}
		}
		$params = array(
			'sidebars' => $vars,
		);
		print $this->helper->render(VIEWS_PATH . 'admin' . DS . 'sidebarsAdmin.php', $params);
		wp_print_scripts(array('sack'));
	}

	public function getSidebars()
	{
		return get_option('salamander_sidebars', array());
	}

	public function addSidebar()
	{
		$name = str_replace(array("\n","\r","\t"), '', $_POST['sidebarName']);
		$id = multipleSidebars::sidebarsNameToClass($name);
		if(isset($this->sidebars[$id])){
			die("alert('Sidebar already exists, please use a different name.')");
		}

		$this->sidebars[$id] = $name;
		$this->updateSidebars($this->sidebars);

		$js = "
			var tbl = document.getElementById('salamander_table').getElementsByTagName('tbody')[0];
			var lastRow = tbl.rows.length;
			//delete empty table row
			if (element = document.getElementById('sidebars-empty-row'))
			{
				element.parentNode.removeChild(element);
				var iteration = lastRow - 1;
			}
			else
			{
				var iteration = lastRow;
			}
			// if there's no header row in the table, then iteration = lastRow + 1
			var row = tbl.insertRow(iteration);

			// left cell
			var cellLeft = row.insertCell(0);
			var textNode = document.createTextNode('$name');
			cellLeft.appendChild(textNode);

			//middle cell
			var cellLeft = row.insertCell(1);
			var textNode = document.createTextNode('$id');
			cellLeft.appendChild(textNode);

			var cellLeft = row.insertCell(2);
			removeLink = document.createElement('a');
  		linkText = document.createTextNode('remove');
			removeLink.setAttribute('onclick', 'removeSidebarLink(\'$name\', ' + iteration + ')');
			removeLink.setAttribute('href', 'javascript:void(0)');
  		removeLink.appendChild(linkText);
  		cellLeft.appendChild(removeLink);
		";

		die("$js");
	}

	public function removeSidebar()
	{
		$name = str_replace(array("\n","\r","\t"),'',$_POST['sidebarName']);
		$id = multipleSidebars::sidebarsNameToClass($name);
		if(!isset($this->sidebars[$id])){
			die("alert('Sidebar does not exist.')");
		}
		$rowNumber = $_POST['rowNumber'];
		unset($this->sidebars[$id]);
		$this->updateSidebars($this->sidebars);
		$js = "
			var tbl = document.getElementById('salamander_table').getElementsByTagName('tbody')[0];
			tbl.deleteRow($rowNumber);
			var length = tbl.rows.length;
			console.log(length)
			if (length == 0)
			{
				var row = tbl.insertRow(length);
				row.id = 'sidebars-empty-row';
				var cell = row.insertCell(0);
				cell.colSpan = 3;
				var textNode = document.createTextNode('No Sidebars defined');
				cell.appendChild(textNode);
			}
		";
		die($js);
	}

	public function updateSidebars($sidebar_array)
	{
		$sidebars = update_option('salamander_sidebars', $sidebar_array);
	}

	/**
	 * for saving the pages/post
	*/
	public function saveForm($post_id)
	{
		if(isset($_POST['salamander_edit']))
		{
			$is_saving = $_POST['salamander_edit'];
			if(!empty($is_saving))
			{
				delete_post_meta($post_id, 'salamander_selected_sidebar');
				delete_post_meta($post_id, 'salamander_selected_sidebar_replacement');
				add_post_meta($post_id, 'salamander_selected_sidebar', $_POST['sidebar_generator']);
				add_post_meta($post_id, 'salamander_selected_sidebar_replacement', $_POST['sidebar_generator_replacement']);
			}
		}
	}

	public function editForm()
	{
    global $post;
    $post_id = $post;
    $vars = array();
    if (is_object($post_id))
    {
    	$post_id = $post_id->ID;
    }
    $selected_sidebar = get_post_meta($post_id, 'salamander_selected_sidebar', true);
    if(!is_array($selected_sidebar))
    {
    	$tmp = $selected_sidebar;
    	$selected_sidebar = array();
    	$selected_sidebar[0] = $tmp;
    }
    $selected_sidebar_replacement = get_post_meta($post_id, 'salamander_selected_sidebar_replacement', true);
		if(!is_array($selected_sidebar_replacement))
		{
    	$tmp = $selected_sidebar_replacement;
    	$selected_sidebar_replacement = array();
    	$selected_sidebar_replacement[0] = $tmp;
	  }
		foreach ($this->sidebars as $key => $sidebar)
		{
			$vars[$key]['name'] = $sidebar;
			$vars[$key]['class'] = multipleSidebars::sidebarsNameToClass($sidebar);
		}
		$args = array(
			'sidebars' => $vars,
			'selected_sidebar' => $selected_sidebar,
			'sidebar_replacements' => $vars,
			'selected_sidebar_replacement' => $selected_sidebar_replacement,
		);
		print $this->helper->render(VIEWS_PATH . 'admin' . DS . 'sidebarsEditForm.php', $args);
	}

	/**
	 * called by the action get_sidebar. this is what places this into the theme
	*/
	static public function getSidebar($name = '0')
	{
		global $wp_query;
		if(!is_singular())
		{
			if($name != '0')
			{
				dynamic_sidebar($name);
			}
			else
			{
				dynamic_sidebar('right-blog-sidebar');
			}
			return;
		}
		wp_reset_query();
		$post = $wp_query->get_queried_object();
		$selected_sidebar = get_post_meta($post->ID, 'salamander_selected_sidebar', true);
		$selected_sidebar_replacement = get_post_meta($post->ID, 'salamander_selected_sidebar_replacement', true);
		$did_sidebar = false;
		//this page uses a generated sidebar
		if($selected_sidebar != '' && $selected_sidebar != '0'){
			if(is_array($selected_sidebar) && !empty($selected_sidebar)){
				for($i=0;$i<sizeof($selected_sidebar);$i++){
					if($name == '0' && $selected_sidebar[$i] == '0' &&  $selected_sidebar_replacement[$i] == '0'){
						dynamic_sidebar('right-blog-sidebar');//default behavior
						$did_sidebar = true;
						break;
					}elseif($name == '0' && $selected_sidebar[$i] == '0'){
						//we are replacing the default sidebar with something
						dynamic_sidebar($selected_sidebar_replacement[$i]);//default behavior
						$did_sidebar = true;
						break;
					}elseif($selected_sidebar[$i] == $name){
						//we are replacing this $name
						$did_sidebar = true;
						dynamic_sidebar($selected_sidebar_replacement[$i]);//default behavior
						break;
					}
				}
			}
			if($did_sidebar == true){
				echo '';
				return;
			}
			//go through without finding any replacements, just send them what they asked for
			if($name != '0'){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar('right-blog-sidebar');
			}
			echo '';
			return;
		}else{
			if($name != '0'){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar('right-blog-sidebar');
			}
		}
	}

	public static function sidebarsNameToClass($name)
	{
		$replacement = array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',);
		$class = str_replace($replacement, '', $name);
		return $class;
	}
}
