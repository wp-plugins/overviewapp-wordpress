<?php
/* 
Plugin Name: OverviewApp Wordpress
Plugin URI: http://www.overviewapp.com
Version: v1.00
Author: <a href='http://bubblecode.com'>BubbleCode</a>
Description: A simple plugin that will add OverviewApp to your wordpress!

Copyright 2011 BubbleCode

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

function ova_trackerActivate() {
	add_option("tracker_id", "", "", "");

}

function ova_trackerDeactivate() {
	delete_option("tracker_id");
}

function ova_tracker_adminMenu() {
	add_options_page("OverviewApp", "OverviewApp", "administrator", "overviewapp", "ova_tracker_opt");
}

function ova_tracker_opt() {
?>
<div class="wrap">
<div id="icon-options-general" class="icon32"><br /></div> 
<h2>OverviewApp Options</h2>

<form method="post" action="options.php">
<?php wp_nonce_field("update-options"); ?>

<table class="form-table"> 
<tr valign="top"> 
<th scope="row"><label for="tracker_id">API Key</label></th> 
<td><input name="tracker_id" type="text" id="tracker_id" value="<?php echo get_option("tracker_id"); ?>" class="regular-text" /> <span class="description">(ex. Yhbk6Vs3ETO0r24LFgC7 ... )</span></td>
</td> 
</tr> 
</table>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="tracker_id" />

<p>
<input type="submit" value="<?php _e("Save Changes") ?>" />
</p>

</form>
</div>
<?php
}

function ova_tracker() {
?>
	<script type="text/javascript" src="//overviewapp.com/track.js"></script>
	<script type="text/javascript">
		Overview.track('<?php echo get_option("tracker_id"); ?>');
	</script>
<?php
}

add_action("wp_footer", "ova_tracker");

register_activation_hook(__FILE__, "ova_trackerActivate"); 
register_deactivation_hook( __FILE__, "ova_trackerDeactivate");

if(is_admin()) {
	add_action("admin_menu", "ova_tracker_adminMenu");
}
?>