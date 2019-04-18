<style type="text/css">
	.bs-callout {   padding: 20px;margin: 20px 0; border: 1px solid #fff;border-left-width: 2px;border-radius: 1px;}
	.bs-callout h4 {margin-top: 0;margin-bottom: 5px;}
	.bs-callout p:last-child {margin-bottom: 0;}
	.bs-callout code {border-radius: 3px;}
	.bs-callout+.bs-callout {margin-top: -5px;}
	.bs-callout-default {border-left-color: #777;}
	.bs-callout-default h4 {color: #777;}
	.bs-callout-primary {border-left-color: #428bca;}
	.bs-callout-primary h4 {color: #428bca;}
	.bs-callout-success {border-left-color: #5cb85c;}
	.bs-callout-success h4 {color: #5cb85c;}
	.bs-callout-danger {border-left-color: #d9534f;}
	.bs-callout-danger h4 {color: #d9534f;}
</style>
<center><button type="button" class="btn btn-info" data-toggle="modal" data-target="#changelog">Open Changelog</button></center>
<div id="changelog" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">webSPELL | RM | Changelog</h4>
      </div>
      <div class="modal-body">


        <!-- -->
		<?php
		$datei = "https://webspell-rm.de/_RM/changelog.xml";

      $Response = @simplexml_load_file($datei) or
    die ("Fehler beim Laden der Datei: ".$datei."\n");

$laufebis = count($Response->Request->description->note); 

echo "\t<ul>\n";

for ($laufe = 0; $laufe < $laufebis; $laufe++) {

    echo "\t<li>";

    foreach ($Response->Request->description->note[$laufe]->
    attributes() as $alpha) {

    echo $alpha." ";
    }
  echo "</li>\n";
}
echo "\t</ul>\n";


		try {
			$myXMLData = file_get_contents("https://webspell-rm.de/_RM/changelog.xml");
			$xml = simplexml_load_string($myXMLData) or die("Error: Cannot create object");

			#$myXMLData = file_get_contents("https://webspell-rm.de/_RM/changelog.xml");
			#$Xml = simplexml_load_string($myXMLData) or die("Error: Cannot create encode data to xml object");
#$in = $simpleXml->items->item;


			#Title
			echo '<div class="bs-callout bs-callout-primary">';
				echo "<strong>webspell-rm ".$xml->version  .".".$xml->minor->version;
				if($xml->patch->character!=""){
					echo "#".$xml->patch->character;
				}
			echo '</strong></div>';

			for($d = 0; $d<=(count($xml->patch->description)-1); $d++) {
				echo $xml->patch->description[$d]  ."<br />";
				echo $xml->patch->description[$d]->name  ."<br />";
				for($i = 0; $i<=(count($xml->patch->description->note)-1); $i++) {
					echo $xml->patch->description->note[$i]  ."<br />";	
				}
			}
		} CATCH(Exception $e) {
			echo '> Changlog can\'t found.';
		}

?> 
		<!-- -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



</body></html>