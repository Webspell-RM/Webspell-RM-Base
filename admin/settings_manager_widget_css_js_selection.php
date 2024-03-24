<?php
#Bei diesen Plugins die nur Widgets besitzen, werden die css und js bei der Widget-Zuweisung extra geladen!
#Zeile 579-602 im Pluginmanager
#DB settings_module activate

/*$widget_akti = @$modulname == 'footer'
                || @$modulname == 'navigation_default'
                || @$modulname == 'navigation_default_two'
                || @$modulname == 'navigation_agency'
                || @$modulname == 'navigation_nor_navbar'
                || @$modulname == 'navigation_sticky'
                || @$modulname == 'navigation_verdux_navbar'
                || @$modulname == 'navigation_skewed'
                || @$modulname == 'navigation_2one'
                || @$modulname == 'nor_box'
                || @$modulname == 'socialmedia'
                || @$modulname == 'messenger'
                || @$modulname == 'carousel'
                || @$modulname == 'tags'
                || @$modulname == 'ts3viewer'
                || @$modulname == 'tsviewer'
                || @$modulname == 'facts'
                || @$modulname == 'bannerrotation'
                || @$modulname == 'breaking_news'
                || @$modulname == 'cashbox'
                || @$modulname == 'media'
                || @$modulname == 'projectslider'
                || @$modulname == 'summary'
                || @$modulname == 'textslider'
                || @$modulname == 'pic_update'
                || @$modulname == 'games_pic'
                || @$modulname == 'user_award'
                || @$modulname == 'lastlogin'
                || @$modulname == 'about_box'
                || @$modulname == 'features'
                || @$modulname == 'features_box';*/

# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung extra geladen!
#settings_module activate
$widget_css = @$modulname == 'footer'
                || @$modulname == 'navigation_default'
                || @$modulname == 'navigation_default_two'
                || @$modulname == 'navigation_agency'
                || @$modulname == 'navigation_nor_navbar'
                || @$modulname == 'navigation_sticky'
                || @$modulname == 'navigation_verdux_navbar'
                || @$modulname == 'navigation_skewed'
                || @$modulname == 'navigation_2one'
                || @$modulname == 'nor_box'
                || @$modulname == 'socialmedia'
                || @$modulname == 'messenger' /*prüfen*/
                || @$modulname == 'carousel'
                || @$modulname == 'facebook'
                || @$modulname == 'tags'
                || @$modulname == 'ts3viewer'
                || @$modulname == 'tsviewer'
                || @$modulname == 'facts'
                || @$modulname == 'bannerrotation'
                || @$modulname == 'breaking_news'
                || @$modulname == 'cashbox'
                || @$modulname == 'media'
                || @$modulname == 'projectslider'
                || @$modulname == 'summary'
                || @$modulname == 'textslider'
                || @$modulname == 'pic_update'
                || @$modulname == 'games_pic'
                || @$modulname == 'user_award'
                || @$modulname == 'lastlogin'
                || @$modulname == 'about_box'
                || @$modulname == 'features'
                || @$modulname == 'features_box';
# Bei diesen Plugins werden die css und js bei der Widget-Zuweisung geladen ja / nein! END


                
#Plugins die zwei Navigationseinträge benötigen
#Zeile 610-650 Plugin-Manager

/*$widget_nav = @$modulname == 'news_manager'
                || @$modulname == 'clanwars';
*/
$widget_nav = @$modulname == 'footer'
                || @$modulname == 'navigation_default'
                || @$modulname == 'navigation_default_two'
                || @$modulname == 'navigation_agency'
                || @$modulname == 'navigation_nor_navbar'
                || @$modulname == 'navigation_sticky'
                || @$modulname == 'navigation_skewed'
                || @$modulname == 'navigation_2one'
                || @$modulname == 'nor_box'
                || @$modulname == 'socialmedia'
                || @$modulname == 'messenger'
                || @$modulname == 'carousel'
                || @$modulname == 'tags'
                || @$modulname == 'ts3viewer'
                || @$modulname == 'facts'
                || @$modulname == 'bannerrotation'
                || @$modulname == 'breaking_news'
                || @$modulname == 'cashbox'
                || @$modulname == 'media'
                || @$modulname == 'projectslider'
                || @$modulname == 'summary'
                || @$modulname == 'textslider'
                || @$modulname == 'pic_update'
                || @$modulname == 'games_pic'
                || @$modulname == 'user_award'
                || @$modulname == 'lastlogin'
                || @$modulname == 'about_box'
                || @$modulname == 'news_manager'
                || @$modulname == 'clanwars'
                || @$modulname == 'features'
                || @$modulname == 'features_box'
                || @$modulname == 'useraward';

?>        