<?php
/*-----------------------------------------------------------------\
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
\------------------------------------------------------------------*/

$_language->readModule('visitor_statistic', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='visitor_statistic'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

$time = time();
$date = getformatdate($time);
$dateyesterday = getformatdate($time - (24 * 3600));
$datemonth = date(".m.Y", time());

$ergebnis = safe_query("SELECT hits FROM " . PREFIX . "counter");
$ds = mysqli_fetch_array($ergebnis);
$us = mysqli_num_rows(safe_query("SELECT userID FROM " . PREFIX . "user"));

$total = $ds[ 'hits' ];
$dt = mysqli_fetch_array(safe_query("SELECT count FROM " . PREFIX . "counter_stats WHERE dates='$date'"));
if (isset($dt[ 'count' ])) {
    $today = $dt[ 'count' ];
} else {
    $today = 0;
}

$dy = safe_query("SELECT count FROM " . PREFIX . "counter_stats WHERE dates='$dateyesterday'");
$yesterday = 0;
if(mysqli_num_rows($dy) > 0 ){
  $dy = mysqli_fetch_array($dy);
  if ($dy[ 'count' ]) {
      $yesterday = $dy[ 'count' ];
  }
}
$month = 0;
$monthquery = safe_query("SELECT count FROM " . PREFIX . "counter_stats WHERE dates LIKE '%$datemonth'");
while ($dm = mysqli_fetch_array($monthquery)) {
    $month = $month + $dm[ 'count' ];
}
if ($month == 0) {
    $month = 1;
}
$monatsstat = '';

$tmp = mysqli_fetch_array(safe_query("SELECT online FROM " . PREFIX . "counter"));
$days_online = round((time() - $tmp[ 'online' ]) / (3600 * 24));

if (!$days_online) {
    $days_online = 1;
}

$perday = round($total / $days_online, 2);
$perhour = round($total / $days_online / 24, 2);
$permonth = round($total / $days_online * 24, 2);

$tmp = mysqli_fetch_array(safe_query("SELECT max(count) as MAXIMUM FROM " . PREFIX . "counter_stats"));
$maxvisits = $tmp[ 'MAXIMUM' ];
$tmp2 = mysqli_fetch_array(safe_query("SELECT dates FROM " . PREFIX . "counter_stats WHERE count='$maxvisits'"));
$maxvisits_date = $tmp2[ 'dates' ];

$online = mysqli_num_rows(safe_query("SELECT time FROM " . PREFIX . "whoisonline"));
$dm = mysqli_fetch_array(safe_query("SELECT maxonline FROM " . PREFIX . "counter"));
$maxonline = $dm[ 'maxonline' ];

$guests = mysqli_num_rows(safe_query("SELECT ip FROM " . PREFIX . "whoisonline WHERE userID=''"));
$user = mysqli_num_rows(safe_query("SELECT userID FROM " . PREFIX . "whoisonline WHERE ip=''"));
$useronline = $guests + $user;

if ($user == 1) {
    $user_on = '1 ' . $_language->module[ 'user' ];
} else {
    $user_on = $user . ' ' . $_language->module[ 'users' ];
}

if ($guests == 1) {
    $guests_on = '1 ' . $_language->module[ 'guest' ];
} else {
    $guests_on = $guests . ' ' . $_language->module[ 'guests' ];
}

echo '

<div class="row">
<div class="col-md-6">
<div class="card">
        <div class="card-header">
            <i class="fas fa-users"></i> '.$_language->module['visitor'].'
        </div>
            
            <div class="card-body">

    <div class="row bt"><div class="col-md-6">'.$_language->module['today'].':</div><div class="col-md-6"><span class="pull-right text-muted small"><em>'.$today.'</em></span></div></div>
    <div class="row bt"><div class="col-md-6">'.$_language->module['yesterday'].':</div><div class="col-md-6"><span class="pull-right text-muted small"><em>'.$yesterday.'</em></span></div></div>
    <div class="row bt"><div class="col-md-6">'.$_language->module['this_month'].':</div><div class="col-md-6"><span class="pull-right text-muted small"><em>'.$month.'</em></span></div></div>
    <div class="row bt"><div class="col-md-6">'.$_language->module['total'].':</div><div class="col-md-6"><span class="pull-right text-muted small"><em>'.$total.'</em></span></div></div>
    <div class="row bt"><div class="col-md-6">'.$_language->module['now_online'].':</div><div class="col-md-6"><span class="pull-right text-muted small"><em>'.$online.' ('.$user_on.', '.$guests_on.')</em></span></div></div>
</div>

</div>
</div>

<div class="col-md-6">
<div class="card">
        <div class="card-header">
            <i class="fas fa-chart-bar"></i> '.$_language->module['stats'].'
        </div>
            
            <div class="card-body">

    <div class="row bt"><div class="col-md-6">'.$_language->module['days_online'].':</div><div class="col-md-6"><span class="pull-right text-muted small"><em>'.$days_online.'</em></span></div></div>
    <div class="row bt"><div class="col-md-6">'.$_language->module['visits_month'].':</div><div class="col-md-6"><span class="pull-right text-muted small"><em>'.$permonth.'</em></span></div></div>
    <div class="row bt"><div class="col-md-6">'.$_language->module['visits_day'].':</div><div class="col-md-6"><span class="pull-right text-muted small"><em>'.$perday.'</em></span></div></div>
    <div class="row bt"><div class="col-md-6">'.$_language->module['visits_hour'].':</div><div class="col-md-6"><span class="pull-right text-muted small"><em>'.$perhour.'</em></span></div></div>
    <div class="row bt"><div class="col-md-6">'.$_language->module['max_day'].':</div><div class="col-md-6"><span class="pull-right text-muted small"><em>'.$maxvisits.' ('.$maxvisits_date.')</em></span></div></div>
</div>

</div>
</div>
</div>

';

echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-sync"></i> '.$_language->module['visitor_stats_graphics'].'
        </div>
            
            <div class="card-body">';

if (isset($_SESSION[ 'size_x' ])) {
    $size_x = $_SESSION[ 'size_x' ];
} else {
    $size_x = 650;
}
if (isset($_SESSION[ 'size_y' ])) {
    $size_y = $_SESSION[ 'size_y' ];
} else {
    $size_y = 200;
}

if (isset($_SESSION[ 'count_days' ])) {
    $count_days = $_SESSION[ 'count_days' ];
} else {
    $count_days = 30;
}
if (isset($_SESSION[ 'count_months' ])) {
    $count_months = $_SESSION[ 'count_months' ];
} else {
    $count_months = 12;
}

?>
<script>
    <!--

    size_x = <?php echo $size_x; ?>;
    size_y = <?php echo $size_y; ?>;
    year = 0;
    month = 0;
    count_days = <?php echo $count_days; ?>;
    count_months = <?php echo $count_months; ?>;

    function display_stat(new_year, new_month) {
        year = new_year;
        month = new_month;
        if (month) {
            document.getElementById('img').src =
                'visitor_statistic_image.php?year=' + year + '&month=' + month + '&size_x=' + size_x + '&size_y=' +
                size_y;
        }
        else {
            document.getElementById('img').src =
                'visitor_statistic_image.php?year=' + year + '&size_x=' + size_x + '&size_y=' + size_y;
        }
        document.getElementById('img').style.display = '';
        if (month) {
            document.getElementById('h2').innerHTML = year + '.' + month;
        }
        else {
            document.getElementById('h2').innerHTML = year;
        }
        document.getElementById('h2').style.display = '';
    }

    function update_size(new_x, new_y) {
        size_x = new_x;
        size_y = new_y;

        if (size_x <= 0) {
            size_x = 1;
            document.getElementById('new_x').value = 1;
        }
        if (size_y <= 0) {
            size_y = 1;
            document.getElementById('new_y').value = 1;
        }

        if (year) {
            display_stat(year, month);
        }

        document.getElementById('last_days').src =
            'visitor_statistic_image.php?last=days&count=' + count_days + '&size_x=' + size_x + '&size_y=' + size_y;
        document.getElementById('last_months').src =
            'visitor_statistic_image.php?last=months&count=' + count_months + '&size_x=' + size_x + '&size_y=' + size_y;
    }
    function update_count(new_days, new_months) {
        count_days = new_days;
        count_months = new_months;

        if (count_days <= 1) {
            count_days = 2;
            document.getElementById('count_days').value = 2;
        }
        if (count_months <= 1) {
            count_months = 2;
            document.getElementById('count_months').value = 2;
        }

        document.getElementById('last_days_h2').innerHTML = '&curren; <?php
            echo $_language->module['last']; ?> ' + count_days + ' <?php
            echo $_language->module['days']; ?>';
        document.getElementById('last_months_h2').innerHTML = '&curren; <?php
            echo $_language->module['last']; ?> ' + count_months + ' <?php
            echo $_language->module['months']; ?>';

        document.getElementById('last_days').src =
            'visitor_statistic_image.php?last=days&count=' + count_days + '&size_x=' + size_x + '&size_y=' + size_y;
        document.getElementById('last_months').src =
            'visitor_statistic_image.php?last=months&count=' + count_months + '&size_x=' + size_x + '&size_y=' + size_y;
    }
    -->

</script>

<div class="row">

<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-body">
<p><?php echo $_language->module['settings']; ?>:</p>
<?php echo $_language->module['last']; ?> <input type="text" id="count_days" value="<?php echo $count_days; ?>" style="width:30px;" /> <?php echo $_language->module['days']; ?><br /><br />
<?php echo $_language->module['last']; ?> <input type="text" id="count_months" value="<?php echo $count_months; ?>" style="width:30px;" /> <?php echo $_language->module['months']; ?> <input class="btn btn-primary" type="button" onclick="update_count(document.getElementById('count_days').value, document.getElementById('count_months').value);" value="<?php echo $_language->module['show']; ?>" />
</div></div></div>


<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-body">
<p><?php echo $_language->module['change_size']; ?>:</p>
<input type="text" id="new_x" value="<?php echo $size_x; ?>" style="width:40px;" /> x <input type="text" id="new_y" value="<?php echo $size_y; ?>" style="width:40px;" /> <input class="btn btn-primary" type="button" onclick="update_size(document.getElementById('new_x').value, document.getElementById('new_y').value);" value="<?php echo $_language->module['show']; ?>" /> <?php echo $_language->module['width_height']; ?><br /><br /><br />
</div></div></div>


<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-body">

<p><?php echo $_language->module['show_year_month']; ?>:</p>
<input type="text" id="year" style="width:40px;" /> <input class="btn btn-primary" type="button" onclick="display_stat(document.getElementById('year').value, 0);" value="<?php echo $_language->module['show']; ?>" /> <?php echo $_language->module['yyyy']; ?><br /><br />
<input type="text" id="year2" style="width:40px;" />.<input type="text" id="month" style="width:30px;" /> <input class="btn btn-primary" type="button" onclick="display_stat(document.getElementById('year2').value, document.getElementById('month').value);" value="<?php echo $_language->module['show']; ?>" /> <?php echo $_language->module['yyyy_mm']; ?>
<h1 id="h2" style="display:none;"></h1>
<img id="img" style="display:none;" src="" alt="" />
</div></div></div>

</div></div></div>

<div class="row">

<div class="col-md-6">
    <div class="card">
        <div class="card-header" id="last_days_h2">
            <i class="fa fa-line-chart"></i> <?php echo $_language->module[ 'last' ]; ?> <?php echo $count_days; ?> <?php echo $_language->module[ 'days' ]; ?>
        </div>
            
            <div class="card-body">

<img width="100%" id="last_days" src="visitor_statistic_image.php?last=days&amp;count=<?php echo $count_days; ?>" alt="" />
</div></div></div>

<div class="col-md-6">
<div class="card">
        <div class="card-header" id="last_months_h2">
            <i class="fa fa-line-chart"></i> <?php echo $_language->module['last']; ?> <?php echo $count_months; ?> <?php echo $_language->module['months']; ?>
        </div>
            
            <div class="card-body">

<img width="100%" id="last_months" src="visitor_statistic_image.php?last=months&amp;count=<?php echo $count_months; ?>" alt="" /></div>
</div></div>

</div>
</div>