<div class="col-xs-8">
                <div class="sc_lang-login">
                    <?php 
                    if(isset($_SESSION[ 'language' ])) {
                            $lng = $_SESSION[ 'language' ];
                        } else {
                            $res = safe_query("SELECT `default_language` FROM `".PREFIX."settings` WHERE 1");
                            $row = mysqli_fetch_array($res);
                            $lng=$row['default_language'];
                        }
                        if($lng=="en") {
                            $en = ""; $fr=""; $de=""; $pl=""; $es="";
                        }elseif($lng=="fr"){
                            $en = ""; $fr="selected"; $de=""; $pl=""; $es="";
                        }elseif($lng=="de"){
                            $en = ""; $fr=""; $de="selected"; $pl=""; $es="";
                        }elseif($lng=="pl"){
                            $en = ""; $fr=""; $de=""; $pl="selected"; $es="";
                        } else {
                            $en = ""; $fr=""; $de=""; $pl=""; $es="selected";
                        }
                    $options = '
                        <option id="en" value="en" '.$en.'>English</option>
                        <option id="de" value="de" '.$de.'>Deutsch</option>
                        <option id="pl" value="pl" '.$pl.'>Polski</option>
                        ';
                    /*$options = '
                        <option id="en" value="en" '.$en.'>English</option>
                        <option id="fr" value="fr" '.$fr.'>Fran&ccedil;ais</option>
                        <option id="de" value="de" '.$de.'>Deutsch</option>
                        <option id="pl" value="pl" '.$pl.'>Polski</option>
                        '; */   
                    include(MODULE."sc_languageswitch.php");
					                        
                    ?>
                </div>
			</div>