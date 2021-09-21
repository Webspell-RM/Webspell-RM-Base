$transaction->addQuery("INSERT INTO `".PREFIX."plugins_widgets` (`id`, `position`, `description`, `name`, `modulname`, `plugin_folder`, `widget_file`, `sort`, `widgetname`) VALUES
(1, 'page_navigation_widget', 'Navigation', '', '', NULL, NULL, 1, 0),
(2, 'page_head_widget', 'Page Head', '', '', NULL, NULL, 2, 0),
(3, 'head_section_widget', 'Head Section', '', '', NULL, NULL, 3, 0),
(4, 'center_head_widget', 'Content Head', '', '', NULL, NULL, 4, 0),
(5, 'left_side_widget', 'Page Left', '', '', NULL, NULL, 5, 0),
(6, 'right_side_widget', 'Page Right', '', '', NULL, NULL, 6, 0),
(7, 'center_footer_widget', 'Content Foot', '', '', NULL, NULL, 7, 0),
(8, 'foot_section_widget', 'Foot Section', '', '', NULL, NULL, 8, 0),
(9, 'page_footer_widget', 'Page Footer', '', '', NULL, NULL, 9, 0),
(10, 'page_navigation_widget', 'page_navigation_widget', 'Navigation Default', 'navigation_default', 'navigation_default', 'widget_navigation_default.php', 1, 'navigation_default')");