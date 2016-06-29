<?php



$file = fopen("song2.txt","r");

while(! feof($file))
{
  $line = fgets($file);
  $line=str_replace(PHP_EOL,"",$line);
  // check gia akornto
  $pos=strpos($line,"<chrd>");
  if ($pos === false) // einai grammh me akornta
  {
    
  }
  else // einai grammh me stoixoys
  {
  }
}

fclose($file);
?> 