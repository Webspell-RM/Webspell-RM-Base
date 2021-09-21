<?php
//Output ist eine svg-Grafik
header('Content-Type: image/svg+xml');

//Erhalte als GET-Parameter den Namen des Users.
//Extrahiere die Initialen, sprich, den ersten Buchstaben vom 1. und vom letzten Wort des Namens
$name = strtoupper($_GET['name']);
$words = explode(" ", $name);
$initials = $words[0][0];
if(count($words) > 1) {
    $initials .= $words[count($words)-1][0];
}


//Mögliche Hintergrundfarben für unsere Icons 
$bg_colors = ['#F0F8FF', '#FAEBD7', '#00FFFF', '#7FFFD4', '#F0FFFF', '#F5F5DC', '#FFE4C4', '#FFEBCD', '#0000FF', '#8A2BE2', '#A52A2A', '#DEB887', '#5F9EA0', '#7FFF00', '#D2691E', '#FF7F50', '#6495ED', '#DC143C', '#696969'];

//Mappe $name auf eine zufällige Zahl zwischen 0 und 65.535. Der gleiche $name 
//wird stests auf die gleiche Zahl gemappt
$userID = hexdec(substr(md5($name),0,4));

//Wähle basierend auf der $user_id eine Hintergrundfarbe aus
$bg_color = $bg_colors[$userID % count($bg_colors)];
?>
<svg width="90" height="90" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <rect x="0" y="0" width="90" height="90" style="fill: <?php echo $bg_color; ?>"></rect>
    <text x="50%" y="50%" dy=".1em" fill="#000000" font-size="50px" text-anchor="middle" dominant-baseline="middle" font-family="Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif"><?php echo htmlentities($initials); ?></text>
</svg>