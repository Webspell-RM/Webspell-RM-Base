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

$_language->readModule('styles', false, true);

$ergebnis = safe_query("SELECT * FROM ".PREFIX."navigation_dashboard_links WHERE modulname='buttons'");
    while ($db=mysqli_fetch_array($ergebnis)) {
      $accesslevel = 'is'.$db['accesslevel'].'admin';

if (!$accesslevel($userID) || mb_substr(basename($_SERVER[ 'REQUEST_URI' ]), 0, 15) != "admincenter.php") {
    die($_language->module[ 'access_denied' ]);
}
}

echo '<div class="card">
        <div class="card-header">
            <i class="fas fa-tasks"></i> Button
        </div>
            <div class="card-body">
            <div class="row">';

if (isset($_POST[ 'submit' ])) {
    $CAPCLASS = new \webspell\Captcha;
    if ($CAPCLASS->checkCaptcha(0, $_POST[ 'captcha_hash' ])) {
        $error = array();
        $sem = '/^#[a-fA-F0-9]{6}/';
        
        if (count($error)) {
            echo '<b>' . $_language->module[ 'errors' ] . ':</b><br /><ul>';

            foreach ($error as $err) {
                echo '<li>' . $err . '</li>';
            }
            echo '</ul><br /><input type="button" onclick="javascript:history.back()" value="' .
                $_language->module[ 'back' ] . '" />';
        } else {
            safe_query(
                "UPDATE " . PREFIX . "settings_buttons
                SET button1='" . $_POST[ 'button1' ] . "',
                button2='" . $_POST[ 'button2' ] . "',
                button3='" . $_POST[ 'button3' ] . "',
                button4='" . $_POST[ 'button4' ] . "',
                button5='" . $_POST[ 'button5' ] . "',
                button6='" . $_POST[ 'button6' ] . "',
                button7='" . $_POST[ 'button7' ] . "',
                button8='" . $_POST[ 'button8' ] . "',
                button9='" . $_POST[ 'button9' ] . "',
                button10='" . $_POST[ 'button10' ] . "',
                button11='" . $_POST[ 'button11' ] . "',
                button12='" . $_POST[ 'button12' ] . "',
                button13='" . $_POST[ 'button13' ] . "',
                button14='" . $_POST[ 'button14' ] . "',
                button15='" . $_POST[ 'button15' ] . "',
                button16='" . $_POST[ 'button16' ] . "',
                button17='" . $_POST[ 'button17' ] . "',
                button18='" . $_POST[ 'button18' ] . "',
                button19='" . $_POST[ 'button19' ] . "',
                button20='" . $_POST[ 'button20' ] . "',
                button21='" . $_POST[ 'button21' ] . "',
                button22='" . $_POST[ 'button22' ] . "',
                button23='" . $_POST[ 'button23' ] . "',
                button24='" . $_POST[ 'button24' ] . "',
                button25='" . $_POST[ 'button25' ] . "',
                button26='" . $_POST[ 'button26' ] . "',
                button27='" . $_POST[ 'button27' ] . "',
                button28='" . $_POST[ 'button28' ] . "',
                button29='" . $_POST[ 'button29' ] . "',
                button30='" . $_POST[ 'button30' ] . "',
                button31='" . $_POST[ 'button31' ] . "',
                button32='" . $_POST[ 'button32' ] . "',
                button33='" . $_POST[ 'button33' ] . "',
                button34='" . $_POST[ 'button34' ] . "',
                button35='" . $_POST[ 'button35' ] . "',
                button36='" . $_POST[ 'button36' ] . "',
                button37='" . $_POST[ 'button37' ] . "',
                button38='" . $_POST[ 'button38' ] . "',
                button39='" . $_POST[ 'button39' ] . "',
                button40='" . $_POST[ 'button40' ] . "',
                button41='" . $_POST[ 'button41' ] . "',
                button42='" . $_POST[ 'button42' ] . "' "
            );
           
            redirect("admincenter.php?site=settings_buttons", "", 0);
        }
    } else {
        echo $_language->module[ 'transaction_invalid' ];
    }
} else {
    $ergebnis = safe_query("SELECT * FROM " . PREFIX . "settings_buttons");
    $ds = mysqli_fetch_array($ergebnis);

    

    $CAPCLASS = new \webspell\Captcha;
    $CAPCLASS->createTransaction();
    $hash = $CAPCLASS->getHash();


    echo '<form class="form-horizontal" method="post" action="admincenter.php?site=settings_buttons" enctype="multipart/form-data">
<div class="col-md-12">

<div class="col-md-1 p-3 mb-2 bg-secondary text-white" align="center"><b>Button:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>background-color:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>hover background-color:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>font color:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>border color:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>hover border color:</b></div>
<div class="col-md-1 p-3 mb-2 bg-secondary text-white" align="center"><b>&nbsp;</b></div>
<div class="col-md-12 p-2" align="center"><b>&nbsp;</b></div>






<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-primary custom" />Primary</button></label>

</div>
</div>


<div class="col-md-2">
  <div class="form-group">
    <label class="col-md-12">#007bff</label>
    <div id="cp1" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button1' ] . '" class="form-control" name="button1" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">
  <div class="form-group">
  <label class="col-md-12">#0069d9</label>
    <div id="cp2" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button2' ] . '" class="form-control" name="button2" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffffff</label>
     <div id="cp3" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button3' ] . '" class="form-control" name="button3" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#007bff</label>
     <div id="cp4" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button4' ] . '" class="form-control" name="button4" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>


<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#0062cc</label>
     <div id="cp5" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button5' ] . '" class="form-control" name="button5" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-primary&quot;&gt;Primary&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-secondary custom" />Secondary</button></label>

</div>
</div>


<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#6c757d</label>
    <div id="cp6" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button6' ] . '" class="form-control" name="button6" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#5a6268</label>
    <div id="cp7" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button7' ] . '" class="form-control" name="button7" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffffff</label>
     <div id="cp8" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button8' ] . '" class="form-control" name="button8" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#6c757d</label>
     <div id="cp9" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button9' ] . '" class="form-control" name="button9" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#545b62</label>
     <div id="cp10" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button10' ] . '" class="form-control" name="button10" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-secondary&quot;&gt;Secondary&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-success custom" />Success</button></label>

</div>
</div>

<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#28a745</label>
    <div id="cp11" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button11' ] . '" class="form-control" name="button11" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#218838</label>
    <div id="cp12" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button12' ] . '" class="form-control" name="button12" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffffff</label>
     <div id="cp13" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button13' ] . '" class="form-control" name="button13" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#28a745</label>
     <div id="cp14" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button14' ] . '" class="form-control" name="button14" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#1e7e34</label>
     <div id="cp15" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button15' ] . '" class="form-control" name="button15" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-success&quot;&gt;Success&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-danger custom" />Danger</button></label>

</div>
</div>

<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#dc3545</label>
    <div id="cp16" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button16' ] . '" class="form-control" name="button16" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#c82333</label>
    <div id="cp17" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button17' ] . '" class="form-control" name="button17" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffffff</label>
     <div id="cp18" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button18' ] . '" class="form-control" name="button18" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#dc3545</label>
     <div id="cp19" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button19' ] . '" class="form-control" name="button19" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#bd2130</label>
     <div id="cp20" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button20' ] . '" class="form-control" name="button20" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-danger&quot;&gt;Danger&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-warning custom" />Warning</button></label>

</div>
</div>

<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#ffc107</label>
    <div id="cp21" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button21' ] . '" class="form-control" name="button21" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#e0a800</label>
    <div id="cp22" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button22' ] . '" class="form-control" name="button22" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#212529</label>
     <div id="cp23" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button23' ] . '" class="form-control" name="button23" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffc107</label>
     <div id="cp24" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button24' ] . '" class="form-control" name="button24" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#d39e00</label>
     <div id="cp25" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button25' ] . '" class="form-control" name="button25" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-warning&quot;&gt;Warning&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-info custom" />Info</button></label>

</div>
</div>


<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#17a2b8</label>
    <div id="cp26" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button26' ] . '" class="form-control" name="button26" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#138496</label>
    <div id="cp27" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button27' ] . '" class="form-control" name="button27" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffffff</label>
     <div id="cp28" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button28' ] . '" class="form-control" name="button28" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#17a2b8</label>
     <div id="cp29" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button29' ] . '" class="form-control" name="button29" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#117a8b</label>
     <div id="cp30" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button30' ] . '" class="form-control" name="button30" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-info&quot;&gt;Info&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-light custom" />Light</button></label>

</div>
</div>


<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#f8f9fa</label>
    <div id="cp31" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button31' ] . '" class="form-control" name="button31" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#e2e6ea</label>
    <div id="cp32" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button32' ] . '" class="form-control" name="button32" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#212529</label>
     <div id="cp33" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button33' ] . '" class="form-control" name="button33" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#f8f9fa</label>
     <div id="cp34" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button34' ] . '" class="form-control" name="button34" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#dae0e5</label>
     <div id="cp35" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button35' ] . '" class="form-control" name="button35" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-light&quot;&gt;Light&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-dark custom" />Dark</button></label>

</div>
</div>


<div class="col-md-2">

<div class="form-group">
    <label class="col-md-12">#343a40</label>
    <div id="cp36" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button36' ] . '" class="form-control" name="button36" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">

  <div class="form-group">
  <label class="col-md-12">#23272b</label>
    <div id="cp37" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button37' ] . '" class="form-control" name="button37" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>

  </div>
  <div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#ffffff</label>
     <div id="cp38" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button38' ] . '" class="form-control" name="button38" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#343a40</label>
     <div id="cp39" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button39' ] . '" class="form-control" name="button39" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-2">
 <div class="form-group">
 <label class="col-md-12">#1d2124</label>
     <div id="cp40" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button40' ] . '" class="form-control" name="button40" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-dark&quot;&gt;Dark&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>


<div class="col-md-1 p-3 mb-2 bg-secondary text-white" align="center"><b>Link:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>font color:</b></div>
<div class="col-md-2 p-3 mb-2 bg-secondary text-white" align="center"><b>color hover:</b></div>
<div class="col-md-7 p-3 mb-2 bg-secondary text-white" align="center"><b>&nbsp;</b></div>


<div class="col-md-1">
<div class="form-group">
<label class="control-label">
<button class="btn btn-link" />Link</button></label>

</div>
</div>



<div class="col-md-2">
<div class="form-group">
    <label class="col-md-12">#007bff</label>
    <div id="cp41" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button41' ] . '" class="form-control" name="button41" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
  </div>
  <div class="col-md-2">
<div class="form-group">
  <label class="col-md-12">#0056b3</label>
    <div id="cp42" class="input-group colorpicker-component col-md-12">
    <input type="text" value="' . $ds[ 'button42' ] . '" class="form-control" name="button42" /><span class="input-group-addon"><i></i></span> 
    </div>
  </div>
</div>

<div class="col-md-12">
<div class="form-group row">
<label class="col-md-1">Code:</label>
<div class="col-md-10">
<pre><code class="language-html">&lt;button type=&quot;button&quot; class=&quot;btn btn-link&quot;&gt;Link&lt;/button&gt;</code></pre>
</div>
</div>
<hr>
</div>



<div class="form-group">
    <div class="col-md-12">
      <input type="hidden" name="captcha_hash" value="'.$hash.'" />
  <button class="btn btn-primary" type="submit" name="submit" />'.$_language->module['update'].'</button>
    </div>
  </div>
</form>
';
}
echo '</div></div></div>';
?>
