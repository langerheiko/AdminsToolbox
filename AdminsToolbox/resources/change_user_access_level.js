$(document).ready(function() {
	/*
	console.log('Hello World');
	var access_levels_string = $('select[name=access_level]').html();
	console.log(access_levels_string);
	*/
	// mögliche Access-Level auslesen und in Array speichern
	var access_levels = new Array();
	access_levels[0] = new Object();
	$('select[name=access_level]>option').each(function() {
		//console.log('value='+$(this).attr('value')+', text='+$(this).text());
		access_levels[0][$(this).attr('value')] = $(this).text();
	});
	//console.log(access_levels[0]);

	// Access-Level Dropdowns in Benutzerverwaltung einhängen
	var user_remove_access = $("tr[class^='row-'] form[action^='manage_proj_user_remove.php']");
	user_remove_access.each(function() {
		var suche = /project_id=(\d+)&user_id=(\d+)/gi;
		var res = suche.exec($(this).attr('action'));
		var token = $(this).children('[name=manage_proj_user_remove_token]').val();
		//console.log(res);
		var access_level_str = $(this).parent('td').prev('td').text();
		access_level_str = $.trim(access_level_str);
		//console.log(access_level_str);
		//$(this).parent('td').prev('td').html(printFormAccessLevel);
		var out = "";		
		for(var access_level in access_levels[0]){
			if(access_levels[0][access_level]==access_level_str){
				out += '<option value="'+access_level+'" selected="selected">'+access_levels[0][access_level]+'</option>';
			} else {
				out += '<option value="'+access_level+'">'+access_levels[0][access_level]+'</option>';
			}
		}
		out = '<form><input type="hidden" name="manage_proj_user_remove_token" value="'+token+'" /><input type="hidden" name="project_id" value="'+res[1]+'" /><input type="hidden" name="user_id" value="'+res[2]+'" /><select class="access_level2">'+out+'</select></form>';
		//console.log(out);
		$(this).parent('td').prev('td').html(out);
	});

	// bei Änderung des Dropdown-Wertes Ajax.Call auslösen
	$('.access_level2').on('change', function() {
		var newVal = $(this).val();
		var user = $(this).siblings('[name=user_id]').val();
		var project = $(this).siblings('[name=project_id]').val();
		var token = $(this).siblings('[name=manage_proj_user_remove_token]').val();
		//alert(user);

		$.post(
			"plugins/AdminsToolbox/pages/access_level.php", 
			{user_id: user,
			 project_id: project,
			 access_level: newVal,
			 manage_proj_user_remove_token: token
			}
		).done(function(data) {
			console.log("Data Loaded: " + data);
		});
	});
});
