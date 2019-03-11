<?php
if(isset($_GET['action'])) $action = $_GET['action'];
else $action='';

$file_1 = 'install';
$addonname = '<b>Support Ticket Addon</b>';
$success = '<br/><table width="100%">
				<tr><td colspan="2" align="center"><a href="http://addons-webspell.org/" target="_blank"><img width="468" height="60" border="0" alt="ADDONS WEBSPELL" src="http://addons-webspell.org/images/linkus/3.jpg"></a></td></tr>
				<tr><td colspan="2">&nbsp;</td></tr>
				<tr>
					<td valign="top" width="20"><img width="18" height="12" border="0" alt="Germany" src="images/flags/de.gif"></td>
					<td>Herzlichen Gl&uuml;ckwunsch, die Installation war erfolgreich! Viel Spa&szlig; mit dem '.$addonname.'!</td>
				</tr>
				<tr><td colspan="2">Nun musst du noch deine admincenter.php bearbeiten, n&auml;here Informationen dazu findest du in der readme.txt!<br/><br/></td></tr>
				<tr><td colspan="2">Hilfe f&uuml;r dieses und viele andere Addons bekommst du auf <a href="http://addons-webspell.org/" target="_blank"><b>www.addons-webspell.org</b></a></td></tr>
				<tr><td colspan="2">&nbsp;<hr class="grey" /><br/></td></tr>
				<tr>
					<td valign="top"><img width="18" height="12" border="0" alt="UK" src="images/flags/uk.gif"></td>
					<td>Congratulations, the installation was successful! Enjoy the '.$addonname.'!</td>
				</tr>
				<tr><td colspan="2">Now you have to edit your admincenter.php, for more information take a look in the readme.txt!<br/><br/></td></tr>
				<tr><td colspan="2">Support for this and many other addons you get on <a href="http://addons-webspell.org/" target="_blank"><b>www.addons-webspell.org</b></a></td></tr>
			</table>';
	
if ($action=="install") {
	mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."tickets_categorys` (
		`ticketcatID` 	int(11) NOT NULL AUTO_INCREMENT,
		`name` 			varchar(255) NOT NULL,
		`subcatID` 		int(11) NOT NULL,
		 PRIMARY KEY (`ticketcatID`)
	) AUTO_INCREMENT=1");

	mysql_query("CREATE TABLE IF NOT EXISTS `".PREFIX."tickets` (	
		`ticketID` int(11) NOT NULL AUTO_INCREMENT,
		`masterticketID` int(11) NOT NULL,
		`ticketcatID` int(11) NOT NULL,
		`admin` int(11) NOT NULL,
		`ticketstatus` int(1) NOT NULL,
		`date` int(14) NOT NULL,
		`poster` int(11) NOT NULL,
		`ticketname` varchar(255) CHARACTER SET latin1 NOT NULL,
		`ticketinfo` text CHARACTER SET latin1 NOT NULL,
		`priority` int(1) NOT NULL,
		`notify` int(1) NOT NULL,
		`userarchiv` int(1) NOT NULL,
		`adminarchiv` int(11) NOT NULL,
		PRIMARY KEY (`ticketID`)
	 ) AUTO_INCREMENT=1");																 

	$del_1 = unlink($file_1.'.php');

	echo $success;
}
	
else {
	echo '<br/><table width="100%">
			<tr><td colspan="2" align="center"><a href="http://addons-webspell.org/" target="_blank"><img width="468" height="60" border="0" alt="ADDONS WEBSPELL" src="http://addons-webspell.org/images/linkus/3.jpg"></a></td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			<tr>
				<td width="20"><img width="18" height="12" border="0" alt="Germany" src="images/flags/de.gif"></td>
				<td>Willkommen zum '.$addonname.'!</td>
			</tr>
			<tr><td colspan="2" align="left" style="color:#ff0000;">Bevor du das '.$addonname.' installierst, erstelle bitte eine Sicherheitskopie deiner MySQL Datenbank!</td></tr>
			<tr><td colspan="2" align="center" ><input type=button onClick="location.href=\'index.php?site='.$file_1.'&amp;action=install\'" value="OK, jetzt installieren!"></td></tr>
			<tr><td colspan="2">&nbsp;<hr class="grey" /><br/></td></tr>
			<tr>
				<td><img width="18" height="12" border="0" alt="UK" src="images/flags/uk.gif"></td>
				<td>Welcome to the '.$addonname.'!</td>
			</tr>
			<tr><td colspan="2" align="left" style="color:#ff0000;">Before you install the '.$addonname.', please create a backup of your MySQL database!</td></tr>
			<tr><td colspan="2" align="center" ><input type=button onClick="location.href=\'index.php?site='.$file_1.'&amp;action=install\'" value="I understood! Install Now!"></td></tr>
			<tr><td colspan="2">&nbsp;</td></tr>			
			</table>';
}
?>