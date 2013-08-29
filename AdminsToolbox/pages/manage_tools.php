<?php
auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

html_page_top( plugin_lang_get( 'plugin_title' ) );
print_manage_menu();

if( plugin_config_get( 'show_menu_item', 0 ) == 1 ):
?>

<br/>
<table align="center" class="width50" cellspacing="1">

<tr <?php echo helper_alternate_class( )?>>
	<td class="form-title">
		<?=plugin_lang_get( 'plugin_title' ) ?>
	</td>
	<td class="center">&nbsp;</td>
</tr>

<?php if( plugin_config_get( 'show_db_adminer', 0 ) == 1 ): ?>
<tr <?php echo helper_alternate_class( )?>>
	<td class="category">
		Adminer DB management
	</td>
	<td class="center">
		<a href="plugins/AdminsToolbox/pages/db_adminer.php" target="_blank">Open</a>
	</td>
</tr>
<?php endif; ?>

<?php if( plugin_config_get( 'show_db_editor', 0 ) == 1 ): ?>
<tr <?php echo helper_alternate_class( )?>>
	<td class="category">
		Adminer DB editor
	</td>
	<td class="center">
		<a href="plugins/AdminsToolbox/pages/db_adminer_editor.php" target="_blank">Open</a>
	</td>
</tr>
<?php endif; ?>

</table>

<?php
endif;
html_page_bottom();
