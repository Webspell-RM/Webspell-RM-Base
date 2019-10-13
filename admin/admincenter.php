<?php
/*¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯¯\
| _    _  ___  ___  ___  ___  ___  __    __      ___   __  __       |
|( \/\/ )(  _)(  ,)/ __)(  ,\(  _)(  )  (  )    (  ,) (  \/  )      |
| \    /  ) _) ) ,\\__ \ ) _/ ) _) )(__  )(__    )  \  )    (       |
|  \/\/  (___)(___/(___/(_)  (___)(____)(____)  (_)\_)(_/\/\_)      |
|                       ___          ___                            |
|                      |__ \        / _ \                           |
|                         ) |      | | | |                          |
|                        / /       | | | |                          |
|                       / /_   _   | |_| |                          |
|                      |____| (_)   \___/                           |
\___________________________________________________________________/
/                                                                   \
|        Copyright 2005-2018 by webspell.org / webspell.info        |
|        Copyright 2018-2019 by webspell-rm.de                      |
|                                                                   |
|        - Script runs under the GNU GENERAL PUBLIC LICENCE         |
|        - It's NOT allowed to remove this copyright-tag            |
|        - http://www.fsf.org/licensing/licenses/gpl.html           |
|                                                                   |
|               Code based on WebSPELL Clanpackage                  |
|                 (Michael Gruber - webspell.at)                    |
\___________________________________________________________________/
/                                                                   \
|                     WEBSPELL RM Version 2.0                       |
|           For Support, Mods and the Full Script visit             |
|                       webspell-rm.de                              |
\__________________________________________________________________*/
chdir('../');
include('system/sql.php');
include('system/settings.php');
include('system/functions.php');
include('system/plugin.php');
include('system/widget.php');
include('system/version.php');
include('system/multi_language.php');
chdir('admin');
$load = new plugin_manager();
$_language->readModule('admincenter', false, true);
if (isset($_GET['site'])) {
  $site = $_GET['site'];
} elseif (isset($site)) {
  unset($site);
}

// extra login
$admin=isanyadmin($userID);
if (!$loggedin) {// START
    // include theme / content
    include("login.php"); 
}
if (!$admin) {
    die($_language->module['access_denied']);
}



if (!isset($_SERVER['REQUEST_URI'])) {
  $arr = explode('/', $_SERVER['PHP_SELF']);
  $_SERVER['REQUEST_URI'] = '/' . $arr[count($arr)-1];
  if ($_SERVER['argv'][0]!='') {
    $_SERVER['REQUEST_URI'] .= '?' . $_SERVER['argv'][0];
  }
}

function dashnavi() {
  global $userID;
  $links = '';
  $ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_categories ORDER BY sort");
  while ($ds=mysqli_fetch_array($ergebnis)) {
    $accesslevel = 'is'.$ds['accesslevel'].'admin';

  $name = $ds['name'];
  $fa_name = $ds['fa_name'];
    $translate = new multiLanguage(detectCurrentLanguage());
    $translate->detectLanguages($name);
    $name = $translate->getTextByLanguage($name);
    
    $data_array = array();
    $data_array['$name'] = $ds['name'];
    $data_array['$fa_name'] = $ds['fa_name'];

    
        if ($accesslevel($userID)) {
    $links .= '<li><a class=\'has-arrow\' aria-expanded=\'false\' href=\'#\'><i class=\''.$fa_name.'\'></i>  '.$name.'</a><ul class=\'nav nav-second-level\'>';
    
    $catlinks = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE catID='".$ds['catID']."' ORDER BY sort");
    while ($db=mysqli_fetch_array($catlinks)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

      $name = $db['name'];
    $translate = new multiLanguage(detectCurrentLanguage());
    $translate->detectLanguages($name);
    $name = $translate->getTextByLanguage($name);
    
    $data_array = array();
    $data_array['$name'] = $db['name'];

      if ($accesslevel($userID)) {
        $links .= '<li><a href=\''.$db['url'].'\'>'.$name.'</a></li>';
      }
    }
    $links .= '</ul></li>';
  }
}
 $links .= '</ul></li>';

  return $links;
}


if ($userID && !isset($_GET[ 'userID' ]) && !isset($_POST[ 'userID' ])) {
  $ds = mysqli_fetch_array(
    safe_query(
      "SELECT
        `registerdate`,
        `nickname`
      FROM `" . PREFIX . "user`
      WHERE `userID` = " . $userID
    )
  );
  $username = '<a href=\'../index.php?site=profile&amp;id='. $userID .'\'>'. $ds[ 'nickname' ] .'</a>';
  $userurl = '../index.php?site=profile&amp;id='. $userID .'';
  $data_array = array();
  $data_array['$username'] = $username;
  $data_array['$lastlogin'] = getformatdatetime($_SESSION[ 'ws_lastlogin' ]);
  $data_array['$registerdate'] = getformatdatetime($ds[ 'registerdate' ]);
}
if ($getavatar = getavatar($userID)) {
  $l_avatar = '<img src=\'../images/avatars/'. $getavatar .'\' alt=\'Avatar\' class=\'img-circle profile_img\'>';
} else {
  $l_avatar = $_language->module[ 'n_a' ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>webSPELL | RM - Bootstrap Admin Theme</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Bootstrap Core CSS -->
    <link href='css/bootstrap.min.css' rel='stylesheet'>
    
    <!-- Custom CSS -->
     <link rel="stylesheet" href="css/bsadmin.css">
    
    <!-- Custom Fonts -->
    <link href='../components/fontawesome/css/all.css' rel='stylesheet' type='text/css'>
    <!-- Style CSS -->
    <link href='../components/admin/css/bootstrap-colorpicker.min.css' rel='stylesheet'>
    <link href='../components/css/button.css.php' rel='styleSheet' type='text/css'>
    <link href='../components/admin/css/bootstrap-switch.css' rel='stylesheet'>

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="../components/datatables/css/jquery.dataTables.min.css"/>
    <?php include('../system/ckeditor.php'); ?>
    <script src='../components/jquery/jquery.min.js'></script>
    <script src='../components/popper.js/popper.min.js'></script>
    <script src='../components/tooltip.js/tooltip.min.js'></script> 
 


<link href='../components/admin/css/pa1ge.css' rel='stylesheet'>

<!-- Custom CSS -->
    <link href='../components/admin/css/page.css' rel='stylesheet'>
    <style type="text/css">/*!
* metismenujs - v1.1.0
* A menu plugin
* https://github.com/onokumus/metismenujs#readme
*
* Made by Osman Nuri Okumus <onokumus@gmail.com> (https://github.com/onokumus)
* Under MIT License
*/
.metismenu .arrow {
  float: right;
  line-height: 1.42857; }

*[dir="rtl"] .metismenu .arrow {
  float: left; }

/*
 * Require Bootstrap 3.x
 * https://github.com/twbs/bootstrap
*/
.metismenu .glyphicon.arrow:before {
  content: "\e079"; }

.metismenu .mm-active > a > .glyphicon.arrow:before {
  content: "\e114"; }

/*
 * Require Font-Awesome
 * http://fortawesome.github.io/Font-Awesome/
*/
.metismenu .fa.arrow:before {
  content: "\f104"; }

.metismenu .mm-active > a > .fa.arrow:before {
  content: "\f107"; }

/*
 * Require Ionicons
 * http://ionicons.com/
*/
.metismenu .ion.arrow:before {
  content: "\f3d2"; }

.metismenu .mm-active > a > .ion.arrow:before {
  content: "\f3d0"; }

.metismenu .plus-times {
  float: right; }

*[dir="rtl"] .metismenu .plus-times {
  float: left; }

.metismenu .fa.plus-times:before {
  content: "\f067"; }

.metismenu .mm-active > a > .fa.plus-times {
  transform: rotate(45deg); }

.metismenu .plus-minus {
  float: right; }

*[dir="rtl"] .metismenu .plus-minus {
  float: left; }

.metismenu .fa.plus-minus:before {
  content: "\f067"; }

.metismenu .mm-active > a > .fa.plus-minus:before {
  content: "\f068"; }

.metismenu .mm-collapse:not(.mm-show) {
  display: none; }

.metismenu .mm-collapsing {
  position: relative;
  height: 0;
  overflow: hidden;
  transition-timing-function: ease;
  transition-duration: 0.35s;
  transition-property: height, visibility; }

.metismenu .has-arrow {
  position: relative; }

.metismenu .has-arrow::after {
  position: absolute;
  content: "";
  width: 0.5em;
  height: 0.5em;
  border-width: 1px 0 0 1px;
  border-style: solid;
  border-color: currentColor;
  border-color: initial;
  right: 1em;
  transform: rotate(-45deg) translate(0, -50%);
  transform-origin: top;
  top: 50%;
  transition: all 0.3s ease-out; }

*[dir="rtl"] .metismenu .has-arrow::after {
  right: auto;
  left: 1em;
  transform: rotate(135deg) translate(0, -50%); }

.metismenu .mm-active > .has-arrow::after,
.metismenu .has-arrow[aria-expanded="true"]::after {
  transform: rotate(-135deg) translate(0, -50%); }

*[dir="rtl"] .metismenu .mm-active > .has-arrow::after,
*[dir="rtl"] .metismenu .has-arrow[aria-expanded="true"]::after {
  transform: rotate(225deg) translate(0, -50%); }

/*# sourceMappingURL=metismenujs.css.map */</style>
    
   <style type="text/css">.sidebar-nav {
    background: #212529;
}
.sidebar-nav ul {
    padding: 0;
    margin: 0;
    list-style: none;
    background: #343a40;
}

.sidebar-nav .metismenu {
    background: #212529;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
}

.sidebar-nav .metismenu li + li {
  margin-top: 5px;
}

.sidebar-nav .metismenu li:first-child {
  margin-top: 5px;
}
.sidebar-nav .metismenu li:last-child {
  margin-bottom: 5px;
}


.sidebar-nav .metismenu > li {
    /*-webkit-box-flex: 1;
    -ms-flex: 1 1 0%;
    flex: 1 1 0%;*/
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    position: relative;
}
.sidebar-nav .metismenu a {
    position: relative;
    display: block;
    padding: 13px 15px;
    color: #adb5bd;
    outline-width: 0;
    transition: all .3s ease-out;
}

.sidebar-nav .metismenu ul a {
    padding: 10px 15px 10px 30px;
}

.sidebar-nav .metismenu ul ul a {
    padding: 10px 15px 10px 45px;
}

.sidebar-nav .metismenu a:hover,
.sidebar-nav .metismenu a:focus,
.sidebar-nav .metismenu a:active {
    color: #f8f9fa;
    text-decoration: none;
    background: #0b7285;
}
</style>
  
 
 
</head>
<body>
 <div id='wrapper'>
<nav class="navbar navbar-expand navbar-dark navbar-head">
    <div class='navbar-header'>
          
          <img src='../components/admin/images/setting.png'>
        </div>
        
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
          <li>Welcome</li>
          <li><?php echo $username ?></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown">
                    <i class="fas fa-times"></i> Logout
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="../index.php">Back to Website</a>
                    <a class="dropdown-item" href="/includes/modules/logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>


<!--<div class='navbar-default sidebar' role='navigation'>
          <div class='sidebar-nav navbar-collapse'>
            <ul class='nav' id='side-menu'>-->

<div class="d-flex">
  <nav class="sidebar-nav sidebar">
          <ul class="metismenu" id="menu1">
            <li><a class="active-head" href="admincenter.php"><i class="fas fa-home"></i> Dashboard</a></li>
            
             <?php 
             
                echo dashnavi();
                
               ?>
            
            
          </ul>


      
<!-- Copy -->
         <div class='copy'>
            <em>&nbsp;&copy; 2019 webspell | RM&nbsp;Admin Template by <a href='http://www.webspell-rm.de' target='_blank'>T-Seven</a></em>
          </div>
           </nav>







    <div class="content p-4">
        <?php
            if (isset($site) && $site!='news') {
              $invalide = array('\\','/','//',':','.');
              $site = str_replace($invalide, ' ', $site);
              if (file_exists($site.'.php')) {
                include($site.'.php');
              } else {
                // Load Plugins-Admin-File (if exists)
                chdir('../');
                $plugin = $load->plugin_data($site,0,true);
                $plugin_path = $plugin['path'];
                if(file_exists($plugin_path.'admin/'.$plugin['admin_file'].'.php')) {
                  include($plugin_path.'admin/'.$plugin['admin_file'].'.php');
                } else {
                  chdir('admin');
                  echo '<b>Modul [or] Plugin Not found</b><br /><br />';
                  include('info.php');
                }
              }
            } else {
              include('info.php');
            }
            ?>
    </div>
</div>
</div>
 <!-- jQuery -->
    <script src='../components/admin/js/jquery.min.js'></script>

<script src="js/bootstrap.min.js"></script>








<!--<script src='js/jquery.min.js'></script>-->
<script src="js/bsadmin.js"></script>
<!-- Bootstrap -->
    <!--<script src='../components/admin/js/bootstrap.min.js'></script>-->
    <script src='../components/admin/js/bootstrap-switch.js'></script>
    <!-- DataTables -->
     <script type="text/javascript" src="../components/datatables/js/jquery.dataTables.min.js"></script>
   <!--<script src='../components/datatables/js/jquery.dataTables.min.js'></script> -->

 <script src='../components/admin/js/bootstrap-colorpicker.js'></script>




<!-- Menu Plugin JavaScript -->
    <script src='../components/admin/js/men1u.min.js'></script>
    <!-- Custom Theme JavaScript -->
    <script src='../components/admin/js/page.js'></script>


    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jqu1ery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/metismenujs.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/prismjs/prism.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/noty/lib/noty.min.js"></script>

    <script type="text/javascript">/*!
* metismenujs - v1.1.0
* MetisMenu with Vanilla-JS
* https://github.com/onokumus/metismenujs#readme
*
* Made by Osman Nuri Okumus <onokumus@gmail.com> (https://github.com/onokumus)
* Under MIT License
*/
(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
    typeof define === 'function' && define.amd ? define(factory) :
    (global = global || self, global.MetisMenu = factory());
}(this, function () { 'use strict';

    /*! *****************************************************************************
    Copyright (c) Microsoft Corporation. All rights reserved.
    Licensed under the Apache License, Version 2.0 (the "License"); you may not use
    this file except in compliance with the License. You may obtain a copy of the
    License at http://www.apache.org/licenses/LICENSE-2.0

    THIS CODE IS PROVIDED ON AN *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
    KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
    WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
    MERCHANTABLITY OR NON-INFRINGEMENT.

    See the Apache Version 2.0 License for specific language governing permissions
    and limitations under the License.
    ***************************************************************************** */

    var __assign = function() {
        __assign = Object.assign || function __assign(t) {
            for (var s, i = 1, n = arguments.length; i < n; i++) {
                s = arguments[i];
                for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p)) t[p] = s[p];
            }
            return t;
        };
        return __assign.apply(this, arguments);
    };

    var Default = {
        parentTrigger: "li",
        subMenu: "ul",
        toggle: true,
        triggerElement: "a"
    };
    var ClassName = {
        ACTIVE: "mm-active",
        COLLAPSE: "mm-collapse",
        COLLAPSED: "mm-collapsed",
        COLLAPSING: "mm-collapsing",
        METIS: "metismenu",
        SHOW: "mm-show"
    };

    var MetisMenu = /** @class */ (function () {
        /**
         * Creates an instance of MetisMenu.
         *
         * @constructor
         * @param {HTMLElement | string} element
         * @param {IMMOptions} [options]
         * @memberof MetisMenu
         */
        function MetisMenu(element, options) {
            this.element =
                typeof element === "string" ? document.querySelector(element) : element;
            this.cacheEl = this.element;
            this.config = __assign(__assign({}, Default), options);
            this.cacheConfig = this.config;
            this.disposed = false;
            this.ulArr = [];
            this.listenerOb = [];
            this.init();
        }
        MetisMenu.prototype.update = function () {
            this.disposed = false;
            this.element = this.cacheEl;
            this.config = this.cacheConfig;
            this.init();
        };
        MetisMenu.prototype.dispose = function () {
            for (var _i = 0, _a = this.listenerOb; _i < _a.length; _i++) {
                var lo = _a[_i];
                for (var key in lo) {
                    if (lo.hasOwnProperty(key)) {
                        var el = lo[key];
                        el[1].removeEventListener(el[0], el[2]);
                    }
                }
            }
            this.ulArr = [];
            this.listenerOb = [];
            this.config = null;
            this.element = null;
            this.disposed = true;
        };
        MetisMenu.prototype.on = function (event, fn) {
            this.element.addEventListener(event, fn, false);
            return this;
        };
        MetisMenu.prototype.off = function (event, fn) {
            this.element.removeEventListener(event, fn);
            return this;
        };
        MetisMenu.prototype.emit = function (event, eventDetail, shouldBubble) {
            if (shouldBubble === void 0) { shouldBubble = false; }
            var evt;
            if (typeof CustomEvent === "function") {
                evt = new CustomEvent(event, {
                    bubbles: shouldBubble,
                    detail: eventDetail
                });
            }
            else {
                evt = document.createEvent("CustomEvent");
                evt.initCustomEvent(event, shouldBubble, false, eventDetail);
            }
            this.element.dispatchEvent(evt);
            return this;
        };
        MetisMenu.prototype.init = function () {
            this.element.classList.add(ClassName.METIS);
            this.ulArr = [].slice.call(this.element.querySelectorAll(this.config.subMenu));
            for (var _i = 0, _a = this.ulArr; _i < _a.length; _i++) {
                var ul = _a[_i];
                var li = ul.parentNode;
                ul.classList.add(ClassName.COLLAPSE);
                if (li.classList.contains(ClassName.ACTIVE)) {
                    this.show(ul);
                }
                else {
                    this.hide(ul);
                }
                var a = li.querySelector(this.config.triggerElement);
                if (a.getAttribute("aria-disabled") === "true") {
                    return;
                }
                a.setAttribute("aria-expanded", "false");
                var listenerOb = {
                    aClick: ["click", a, this.clickEvent.bind(this)]
                };
                for (var key in listenerOb) {
                    if (listenerOb.hasOwnProperty(key)) {
                        var listener = listenerOb[key];
                        listener[1].addEventListener(listener[0], listener[2]);
                    }
                }
                this.listenerOb.push(listenerOb);
            }
        };
        MetisMenu.prototype.clickEvent = function (ev) {
            if (!this.disposed) {
                if (ev.currentTarget.tagName === "A") {
                    ev.preventDefault();
                }
                var li = ev.currentTarget.parentNode;
                var ul = li.querySelector(this.config.subMenu);
                this.toggle(ul);
            }
        };
        MetisMenu.prototype.toggle = function (ul) {
            if (ul.parentNode.classList.contains(ClassName.ACTIVE)) {
                this.hide(ul);
            }
            else {
                this.show(ul);
            }
        };
        MetisMenu.prototype.show = function (ul) {
            var _this = this;
            if (this.isTransitioning || ul.classList.contains(ClassName.COLLAPSING)) {
                return;
            }
            var complete = function () {
                ul.classList.remove(ClassName.COLLAPSING);
                ul.style.height = "";
                ul.removeEventListener("transitionend", complete);
                _this.setTransitioning(false);
                _this.emit("shown.metisMenu", {
                    shownElement: ul
                });
            };
            var li = ul.parentNode;
            li.classList.add(ClassName.ACTIVE);
            var a = li.querySelector(this.config.triggerElement);
            a.setAttribute("aria-expanded", "true");
            a.classList.remove(ClassName.COLLAPSED);
            ul.style.height = "0px";
            ul.classList.remove(ClassName.COLLAPSE);
            ul.classList.remove(ClassName.SHOW);
            ul.classList.add(ClassName.COLLAPSING);
            var eleParentSiblins = [].slice
                .call(li.parentNode.children)
                .filter(function (c) { return c !== li; });
            if (this.config.toggle && eleParentSiblins.length > 0) {
                for (var _i = 0, eleParentSiblins_1 = eleParentSiblins; _i < eleParentSiblins_1.length; _i++) {
                    var sibli = eleParentSiblins_1[_i];
                    var sibUl = sibli.querySelector(this.config.subMenu);
                    if (sibUl !== null) {
                        this.hide(sibUl);
                    }
                }
            }
            this.setTransitioning(true);
            ul.classList.add(ClassName.COLLAPSE);
            ul.classList.add(ClassName.SHOW);
            ul.style.height = ul.scrollHeight + "px";
            this.emit("show.metisMenu", {
                showElement: ul
            });
            ul.addEventListener("transitionend", complete);
        };
        MetisMenu.prototype.hide = function (ul) {
            var _this = this;
            if (this.isTransitioning || !ul.classList.contains(ClassName.SHOW)) {
                return;
            }
            this.emit("hide.metisMenu", {
                hideElement: ul
            });
            var li = ul.parentNode;
            li.classList.remove(ClassName.ACTIVE);
            var complete = function () {
                ul.classList.remove(ClassName.COLLAPSING);
                ul.classList.add(ClassName.COLLAPSE);
                ul.style.height = "";
                ul.removeEventListener("transitionend", complete);
                _this.setTransitioning(false);
                _this.emit("hidden.metisMenu", {
                    hiddenElement: ul
                });
            };
            ul.style.height = ul.getBoundingClientRect().height + "px";
            ul.style.height = ul.offsetHeight + "px";
            ul.classList.add(ClassName.COLLAPSING);
            ul.classList.remove(ClassName.COLLAPSE);
            ul.classList.remove(ClassName.SHOW);
            this.setTransitioning(true);
            ul.addEventListener("transitionend", complete);
            ul.style.height = "0px";
            var a = li.querySelector(this.config.triggerElement);
            a.setAttribute("aria-expanded", "false");
            a.classList.add(ClassName.COLLAPSED);
        };
        MetisMenu.prototype.setTransitioning = function (isTransitioning) {
            this.isTransitioning = isTransitioning;
        };
        return MetisMenu;
    }());

    return MetisMenu;

}));
//# sourceMappingURL=metismenujs.js.map
</script>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function(event) {
  new MetisMenu('#menu1');
  new MetisMenu('#menu2', {
    toggle: false
  });
  new MetisMenu('#menu3');
});</script>


   
  </body>
</html>
