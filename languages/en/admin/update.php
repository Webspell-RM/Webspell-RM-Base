<?php
/**
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*  
 *                                    Webspell-RM      /                        /   /                                                 *
 *                                    -----------__---/__---__------__----__---/---/-----__---- _  _ -                                *
 *                                     | /| /  /___) /   ) (_ `   /   ) /___) /   / __  /     /  /  /                                 *
 *                                    _|/_|/__(___ _(___/_(__)___/___/_(___ _/___/_____/_____/__/__/_                                 *
 *                                                 Free Content / Management System                                                   *
 *                                                             /                                                                      *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @version         Webspell-RM                                                                                                       *
 *                                                                                                                                    *
 * @copyright       2018-2022 by webspell-rm.de <https://www.webspell-rm.de>                                                          *
 * @support         For Support, Plugins, Templates and the Full Script visit webspell-rm.de <https://www.webspell-rm.de/forum.html>  *
 * @WIKI            webspell-rm.de <https://www.webspell-rm.de/wiki.html>                                                             *
 *                                                                                                                                    *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 * @license         Script runs under the GNU GENERAL PUBLIC LICENCE                                                                  *
 *                  It's NOT allowed to remove this copyright-tag <http://www.fsf.org/licensing/licenses/gpl.html>                    *
 *                                                                                                                                    *
 * @author          Code based on WebSPELL Clanpackage (Michael Gruber - webspell.at)                                                 *
 * @copyright       2005-2018 by webspell.org / webspell.info                                                                         *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 *                                                                                                                                    *
 *¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯*
 */

$language_array = Array(

/* do not edit above this line */

  'access_denied' => 'Access denied',
  'error' => 'Server is not update compatible or the update file is not available!',
  'step1' => 'Step 1: Update server online',
  'step2' => 'Step 2: Remote installation file available',
  'error_step2_1' => 'Installation file not found! <br />Update aborted.',
  'error_step2_2' => 'Installation file found! <br />Update will now proceed with file upload and table installation.',
  'file_loaded' => 'File loaded',
  'file_not_loaded' => 'File not loaded',
  'file_deleted' => 'File deleted',
  'file_not_deleted' => 'File not deleted',
  'all_files_have_been_edited' => 'All files have been edited!<br />Result',
  'of' => 'of',
  'installcomplete_1' => 'Webspell update was successful to version',
  'installcomplete_2' => 'Installed successfully!',
  'back_to_overview' => 'Back to overview',
  'step4' => 'Step 4: Table Installation',
  'syq_error' => 'MYSQL error: Please contact support!',
  'not_all_files_edited' => 'Not all files were edited!',
  'step3' => 'Step 3: Loading files...',
  'webspell_update' => 'update webSPELL',
  'webspellupdater' => 'webspellupdater',
  'check_version' => 'Check version',
  'update' => 'update',
  'data saved' => 'Data saved!',
  'update_now' => 'Update now',
  'fill_in_ftp_settings' => 'Please fill in FTP settings!',
  'new_version_available' => 'A new webspell version is available!',
  'update_info1' => 'Please note the following before updating!',
  'update_info2' => '- Mysqlbackup done ?<br />- Webspell files saved via FTP ?<br />- Your installed plugins are up to date! (Check under Plugin-Installer)<br /><br />Webspell-RM assumes no liability for damage and the update is at your own risk!',
  'update_info3' => 'Your version is up to date!',
  'update_info4' => 'If you notice that an update has been released within this version, you can then also RE-update your version!<br />Remember that the mysql install runs again and settings that you post made after the update must be reset !<br /><br /><p class="text-danger"><b>Important:</b></p> Make sure before the update that your installed plugins are up to date! (under Plugin Installer)<br /><br />',
  're_update' => 'RE update now',
  'update_info5' => 'Your version is higher than Webspell-RM. Contact the webspell team!',
  'your_version' => 'Your webspell version',
  'latest_version' => 'Latest webspell version',
  'result' => 'Result',
  'ftp_settings' => 'FTP Settings',
  'server_ip' => 'FTP server ip',
  'ftp_ip' => 'What is your server IP (e.g.: 123.345.654.899)',
  'server_port' => 'FTP server port',
  'ftp_port' => 'What is your server port (e.g.: 21 )',
  'server_pfad' => 'Path to directory',
  'ftp_pfad' => 'Path to your webspell directory (e.g.: / or /webspell/)',
  'server_username' => 'FTP username',
  'ftp_username' => 'Username from FTP server',
  'server_password' => 'FTP Password',
  'ftp_password' => 'Password from FTP server',
  'save' => 'Save',
  'ftp_path_check' => 'Path check',
  'ftp_path_error' => 'Path error - please check !',
  'ftp_login_error' => 'Error logging in - please check !',
  'ftp_login_check' => 'Check login !',


  'updateserversuccess'=>'Update server is online.',
  'filename'=>'filename',
  'get_new_version'=>'Get the latest webSPELL version here!',
  'information'=>'information',
  'new_functions'=>'New functions available for webSPELL',
  'new_updates'=>'New updates available for webSPELL',
  'new_version'=>'New webSPELL version available',
  'no_updates'=>'No updates available!',
  'version'=>'version',
  
  'install_complete'=>'Installation was successful!',
  'install_running'=>'Installation is running!',
  'finish_install'=>'Finish installation',
  'view_site'=>'View your site',
  'transaction_invalid'=>'Invalid transaction ID'
);

