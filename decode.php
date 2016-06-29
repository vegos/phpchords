<?php

include("chordgenerator.php");

echo "<!DOCTYPE html>\n";
echo "<HTML>\n";
echo "<meta charset=\"utf-8\">\n";
echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">\n";

echo "<STYLE>\n"; // type=\"text/css\">";
include("./main.css");
echo "\n</STYLE>\n";

echo "<BODY>\n";

$file = fopen("song.txt","r");

while(! feof($file))
{
  $line = fgets($file);
  $line=str_replace(PHP_EOL,"",$line);
  // check gia akornto
  $pos=strpos($line,"<chrd>");
  if ($pos !== false) // contains chords
  {
     $line = str_replace("<chrd>","",$line);
     $line = str_replace("<br>","",$line);
     $line = str_replace("<BR>","",$line);
     $line = str_replace(PHP_EOL,"",$line);
     $chords = explode(" ",$line);
     foreach ($chords as $tmp)
     {
       if ($tmp != null)
       {
         if ($tmp == " ")
         {
           echo "&nbsp;";
         }
         else
         {
           $output = chordgenerator($tmp);
           if ($output != NULL)
           {
             echo "<div class=\"hoverinfo\"><span><b>".
                  $tmp."</b></span><p>";
             echo $output;
             echo "</div>";
           }
           else
           {
             echo "&nbsp;";
           }
         }
       }
       echo "&nbsp;";
     }     
     echo "<BR>";
  }
  else // contains lyrics
  {
    echo $line;
  }
}

fclose($file);

echo "</BODY>";
echo "</HTML>";
?> 
