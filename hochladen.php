<?php
session_start();
include ("logincheck.php");
if(!logincheck())exit;

echo "<script type=\"text/javascript\">";
$dateityp = GetImageSize($_FILES['datei']['tmp_name']);
if($dateityp[2] != 0)
{
  if($_FILES['datei']['size'] <  10240000)
	{
    move_uploaded_file($_FILES['datei']['tmp_name'], "nutzerbilder/".$_SESSION['id'].".jpg");
		echo "window.parent.inhalt.innerHTML=\"Das Bild wurde Erfolgreich hochgeladen, du musst die Seite aktualesieren um die &Auml;nderung zu sehen\"";
  }
  else
	{
		echo "window.parent.inhalt.innerHTML=\"Das Bild darf nicht größer als 1MB sein\"";
  }
}
else
{
  echo "window.parent.inhalt.innerHTML=\"Bitte nur Bilder im Gif bzw. jpg Format hochladen\"";
}
echo "</script>";
?>