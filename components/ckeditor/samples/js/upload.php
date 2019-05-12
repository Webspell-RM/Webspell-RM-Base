<?php
if (file_exists("../../../../images/other/" . $_FILES["upload"]["name"]))
{
 echo $_FILES["upload"]["name"] . " already exists. ";
}
else
{
 move_uploaded_file($_FILES["upload"]["tmp_name"],
 "images/" . $_FILES["upload"]["name"]);
 echo "Stored in: " . "images/other/" . $_FILES["upload"]["name"];
}


?>