AdminsToolbox
=============

Works with MantisBT 1.2.14 & 1.2.19.

This plugin for Mantis Bugtracker brings some additions for administrators:
- Allows administrators to set a new password directly (you get a password input field on manage_user_edit_page.php and a button to set the new password)
- Allows administrators to see all assigned issues of a user (you get the list of assigned issues on manage_user_edit_page.php)
- Speed up managing access level of users in projects (you get a access level dropdown on manage_proj_edit_page.php to set the access level directly for each user)
- Allows administrators to manage database entries through Adminer gui. You may show a new manage menu item (set config options in AdminsToolbox.php). Adminer access is secured by seperate passwords (in /pages/db_adminer.php and /pages/db_adminer_editor.php)

This plugin integrates my plugin AdminSetPassword.

Nothing to patch in your mantis installation.
