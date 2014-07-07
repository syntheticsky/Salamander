	<div id='salamander-sortables' class='meta-box-sortables'>
		<div id="salamander_box" class="postbox " >
			<div class="handlediv" title="Click to toggle"><br /></div><h3 class='hndle'><span>Sidebar</span></h3>
			<div class="inside">
				<div class="salamander_container">
					<input name="salamander_edit" type="hidden" value="salamander_edit" />

					<p>
						Please select the sidebar you would like to display on this page. <strong>Note:</strong> You must first create the sidebar under Appearance > Sidebars.
					</p>
					<ul>
					<?php
						global $wp_registered_sidebars;
						//var_dump($wp_registered_sidebars);
						for($i = 0; $i < 1; $i++) :
					?>
							<li>
							<select name="sidebar_generator[<?php echo $i?>]" style="display: none;">
								<option value="0"<?php if($selected_sidebar[$i] == ''){ echo " selected";} ?>>WP Default Sidebar</option>
							<?php
								$sidebars = $wp_registered_sidebars;// sidebar_generator::get_sidebars();
								if(is_array($sidebars) && !empty($sidebars)){
									foreach($sidebars as $sidebar){
										if($selected_sidebar[$i] == $sidebar['name']){
											echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
										}else{
											echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
										}
									}
								}
							?>
							</select>
							<select name="sidebar_generator_replacement[<?php echo $i?>]">
								<option value="0"<?php if($selected_sidebar_replacement[$i] == ''){ echo " selected";} ?>>None</option>
							<?php
								$sidebar_replacements = $wp_registered_sidebars;//sidebar_generator::get_sidebars();
								if(is_array($sidebar_replacements) && !empty($sidebar_replacements)){
									foreach($sidebar_replacements as $sidebar){
										if($selected_sidebar_replacement[$i] == $sidebar['name']){
											echo "<option value='{$sidebar['name']}' selected>{$sidebar['name']}</option>\n";
										}else{
											echo "<option value='{$sidebar['name']}'>{$sidebar['name']}</option>\n";
										}
									}
								}
							?>
							</select>

							</li>
					<?php
						endfor;
					?>
					</ul>
				</div>
			</div>
		</div>
	</div>
