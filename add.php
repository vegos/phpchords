<?php

function addtosql($vName,$vString6,$vString5,$vString4,$vString3,$vString2,$vString1)
{
  $servername = "localhost";
  $username = "username";
  $password = "password";
  $dbname = "chords";
  $conn = new mysqli($servername,$username,$password,$dbname);
  if ($conn->connect_error)
  {
    die("Connection failed: ".$conn->connect_error);
  }
  $sql = "INSERT INTO chords (name,string6,string5,string4,string3,string2,string1) VALUES ('".$vName."','".$vString6."','".$vString5."','".$vString4."','".$vString3."','".$vString2."','".$vString1."')";
  if ($conn->query($sql) === TRUE) 
  {
    echo ".";
  } 
  else 
  {  
    echo "Error: " . $sql . "\n" . $conn->error;
    echo "Total entries: ".$added;
    $conn->close();
    die();
  }
  $conn->close();
}


echo "Opening file...";
$handle = fopen("chords.list","r");
if ($handle)
{
  echo "Ok\n";
  echo "Processing";
  while (($line = fgets($handle)) !== false)
  {
    if ($line!=NULL)
    {
       $newline = explode("=",$line);
       $newchord=explode(",",$newline[1]);
       if (count($newchord)!=6)
       {
         echo "\nError processing line: \n";
         echo $line;
         die();
       }
       // Define Strings
       $string6=$newchord[0];
       $string5=$newchord[1];
       $string4=$newchord[2];
       $string3=$newchord[3];
       $string2=$newchord[4];
       $string1=str_replace(PHP_EOL,"",$newchord[5]);
       // Check if we have more than 1 chord names
       if (strpos($newline[0],"|")!=0)
       { // We have many chords with the same name, break them to individual chords
         foreach(explode("|",$newline[0]) as $tmpchord)
         {  // Add a record for every chord
           if ($tmpchord!=NULL)
           {
             addtosql($tmpchord,$string6,$string5,$string4,$string3,$string2,$string1);             
           }
         }
       }
       else
       // Only one chord found, add record
       {
         $chordname=$newline[0];
         addtosql($chordname,$string6,$string5,$string4,$string3,$string2,$string1);
       }
    }
  }
  echo "Ok\n";
}
else
{
  echo "Error opening file";
}
echo "Closing file...";
fclose($handle);
echo "Ok\n";
?>
