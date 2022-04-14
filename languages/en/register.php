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

$language_array = array(

/* do not edit above this line */

    'title' => 'Registration',
    'info' => 'Please enter the basic login details in the fields shown and then press "Register now!".',
    'activation_successful' => '<blockquote> Your registration has been successfully completed. <br> You can now register. </blockquote>',
    'back' => 'back',
    'enter_nickname' => 'Please enter a nickname.',
    'enter_password' => 'Please enter a password.',
    'errors_there' => 'The following errors occurred',
    'for_login' => 'is required for login',
    'invalid_mail' => 'The specified email address is incorrect.',
    'mail' => 'E-Mail',
    'mail_activation_successful' => 'The activation of your email address was successful.',
    'mail_failed' => 'The activation mail could not be sent, please inform the webmaster about it.',
    'mail_inuse' => 'There is already a registration for this mail address.',
    'mail_subject' => 'Confirmation of registration for %homepage_url%',
    'mail_text' => 'Hello %nickname%!
<p> Your registration on %pagetitle% (%homepage_url%) was successful. Here again your login data: </p>
<p> Your username: %nickname% </p>
<p> To complete your registration now, activate your account by visiting the following link: <br>
%activationlink% </p>
<p> Thank you for your registration </p>
%pagetitle% - %homepage_url% ',
    'nickname' => 'Nickname',
    'nickname_inuse' => 'The nickname is already taken.',
    'no_register_when_loggedin' => 'You already have an account on %pagename%.',
    'password' => 'Password',
    'profile_info' => 'Login information',
    'privacy_policy' => 'Privacy Policy',
    'register_now' => 'Register now!',
    'register_successful' => '<blockquote> Your registration has been successfully completed. In a few minutes you will receive an email with the activation code so that you can activate your account. The registration is then complete. </blockquote> ',
    'registration' => 'Registration',
    'repeat' => 'repeat password',
    'repeat_invalid' => 'The password repeat is wrong.',
    'security_code' => 'Security Code',
    'wrong_activationkey' => '<blockquote> Your activation code is wrong! </blockquote>',
    'wrong_securitycode' => 'The security code is wrong!',
    'enter_password2' => 'The password must meet the following criteria: <br /> Length: min. 6 characters, a number, a lower case & amp; Capital letters, a special character ',
    'GDPRinfo' => 'I agree that my personal information will be stored permanently.',
    'GDPRaccept' => 'You have to accept the storage of your personal data.',
    'GDPRterm' => '<b> Note </b>: If you consent to the storage of your personal data, you also accept this for registration as well as leaving comments and / or replies in the forum - provided that your registration is required . ',
    'pw1' => 'The password must have',
    'pw2' => 'At least',
    'pw3' => 'Character',
    'pw4' => 'At least one number',
    'pw5' => 'At least one capital letter',
    'pw6' => 'At least one special character',
    'pass_ver' => 'Your password must contain',
    'pass_text' => '8 or more characters / upper and lower case letters / 1 or more special characters / at least one number',
    'no_cookie_accept' => 'You have not accepted cookies! No registration possible! ',
    'full-name' => '',
    'email_address' => 'Email address',
    'enter_your_email' => 'Enter your email address',
    'enter_your_name' => 'Enter your nickname',
    'enter_password' => 'Enter password',
    'already_have_an_account' => 'You already have an account?',
    'login' => 'Login',
    'info1' => 'Looks like you`re new here!',
    'info2' => 'Join our community in a few minutes! Sign in with your details to get started ',

    'homepage1' => 'Website',
    'homepage2' => 'Enter your website.',
    'sexuality' => 'Gender',
    'female' => 'female',
    'diverse' => 'diverse',
    'male' => 'male',
    'unknown' => 'not specified',
    'date_of_birth' => 'Date of birth',
    'fields_star_required' => 'Required fields',
    'enter_homepage' => 'You did not enter your website address.' 

);

