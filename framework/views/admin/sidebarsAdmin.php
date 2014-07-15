<script type="text/javascript">
	function removeSidebarLink(name, num){
		var ans = confirm("Are you sure you want to remove " + name + "?\nThis will remove any widgets you have assigned to this sidebar.");
		if(ans){
			//alert('AJAX REMOVE');
			removeSidebar(name, num);
		}else{
			return false;
		}
	}

	function addSidebarLink(){
		var sidebarName = prompt('Sidebar Name:', '');
		if(sidebarName)
		{
			addSidebar(sidebarName);
		}
	}

	function addSidebar(sidebarName)
	{
		var request = '<?php echo site_url(); ?>/wp-admin/admin-ajax.php';
		var ajax = new sack(request);
	  	ajax.execute = 1;
	  	ajax.method = 'POST';
	  	ajax.setVar('action', 'addSidebar');
	  	ajax.setVar('sidebarName', sidebarName);
	  	ajax.encVar('cookie', document.cookie, false);
	  	ajax.onError = function() { alert('Ajax error. Cannot add sidebar' )};
	  	ajax.runAJAX();
		return true;
	}

	function removeSidebar(sidebarName, num)
	{
		var request = "<?php echo site_url(); ?>/wp-admin/admin-ajax.php";
		var ajax = new sack(request);
	  	ajax.execute = 1;
	  	ajax.method = 'POST';
	  	ajax.setVar('action', 'removeSidebar');
	  	ajax.setVar('sidebarName', sidebarName);
	  	ajax.setVar('rowNumber', num);
	  	ajax.encVar('cookie', document.cookie, false);
	  	ajax.onError = function() { alert('Ajax error. Can\'t add sidebar.' )};
	  	ajax.runAJAX();
		return true;
	}
</script>
<div class="wrap">
	<h2>Sidebars</h2>
	<br />
	<table class="" id="salamander_table">
		<thead>
			<tr>
				<th>Sidebar Name</th>
				<th>CSS class</th>
				<th>Remove</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!empty($sidebars)) :
				$cnt = 0;
				foreach($sidebars as $sidebar) :
					$alt = ($cnt % 2 == 0 ? 'alternate' : '');
			?>
			<tr class="<?php echo $alt?>">
				<td>
					<?php echo $sidebar['name']; ?>
				</td>
				<td>
					<?php echo $sidebar['class']; ?>
				</td>
				<td>
					<a href="javascript:void(0);" onclick="return removeSidebarLink('<?php echo $sidebar["name"]; ?>', <?php echo $cnt; ?>);" title="Remove this sidebar">remove</a>
				</td>
			</tr>
			<?php
					$cnt++;
				endforeach;
			else :
				?>
				<tr id="sidebars-empty-row">
					<td colspan="3">No Sidebars defined</td>
				</tr>
				<?php
			endif;
			?>
		</tbody>
	</table>
	<br /><br />
    <div class="addSidebar">
		<a href="javascript:void(0);" onclick="return addSidebarLink()" title="Add a sidebar" class="button-primary">+ Add New Sidebar</a>
	</div>
</div>
