<?php

function chordgenerator($iChord)
{ 
  $output = [[]];
  $db = mysqli_connect("127.0.0.1","username","password","chords");
  if (!$db)
  {
    echo "Unable to connect to MySQL: ".mysqli_connect_error()."\n";
    exit;
  }
  $sql = "SELECT * FROM chords WHERE name=\"".$iChord."\"";
  $result = mysqli_query($db,$sql);  
  if (mysqli_num_rows($result) > 0) // found chord
  {
     $row = mysqli_fetch_assoc($result);
     $chord = $row['name'];
     $string6 = $row['string6'];
     $string5 = $row['string5'];
     $string4 = $row['string4'];
     $string3 = $row['string3'];
     $string2 = $row['string2'];
     $string1 = $row['string1'];
     
     $max = max(intval($string6),intval($string5),intval($string4),intval($string3),intval($string2),intval($string1));     
     $tab = array($string6,$string5,$string4,$string3,$string2,$string1);
     for ($x=0; $x<=$max; $x++)
     {
       for ($y=0; $y<6; $y++)
       {
         if ($x==0)
         {
           switch ($tab[$y])
           {
             case "-1":
               $output[$x][$y] = "X";
             case "x":
               $output[$x][$y] = "X";
               break;
             case "0":
               $output[$x][$y] = "○";
               break;
             default:
               $output[$x][$y] = "&nbsp;";
            }
         }
         else
         {
           switch($tab[$y])
           {
            case "1":
              if ($x == 1)
                $output[$x][$y]="●";
              else
                $output[$x][$y]="─";
              break;
            case "2":
              if ($x == 2)
                $output[$x][$y]="●";
              else
                $output[$x][$y]="─";
              break;
            case "3":
              if ($x == 3)
                $output[$x][$y]="●";
              else
                $output[$x][$y]="─";
              break;
            case "4":
              if ($x == 4)
                $output[$x][$y]="●";
              else
                $output[$x][$y]="─";
              break;
            case "5":
              if ($x == 5)
                $output[$x][$y]="●";
              else
                $output[$x][$y]="─";
              break;
            case "6":
              if ($x == 6)
                $output[$x][$y]="●";
              else
                $output[$x][$y]="─";
              break;
            case "7":
              if ($x == 7)
                $output[$x][$y]="●";
              else
                $output[$x][$y]="─";
              break;
            case "8":
              if ($x == 8)
               $output[$x][$y]="●";
              else
                $output[$x][$y]="─";
              break;
            case "9":
              if ($x == 9)
                $output[$x][$y]="●";
              else
                $output[$x][$y]="─";
              break;
            case "10":
              if ($x == 10)
                $output[$x][$y]="●";
              else
                $output[$x][$y]="─";
              break;
            case "11":
              if ($x == 11)
                $output[$x][$y]="●";
              else
                $output[$x][$y]="─";
              break;
            case "12":
              if ($x == 12)
                $output[$x][$y]="●";
              else
                $output[$x][$y]="─";
              break;
            case "-1":
              $output[$x][$y]="─";
              break;
            case "x":
              $output[$x][$y]="─";
              break;
            default:
              $output[$x][$y]="─";
          }
        }
       }
     }
     $tmparr = array(0,0,0,0,0,0);
     $tmpout = "";
     $tmpout .= "&nbsp;E&nbsp;A&nbsp;D&nbsp;G&nbsp;B&nbsp;e<BR>";
     for ($x=0; $x<6; $x++)
     {
       $tmpout .= "&nbsp;".$output[0][$x];
     }
     $tmpout .= "<BR>";
     $tmpout .= "╒═╤═╤═╤═╤═╤═╕<BR>";     
     for ($x=1; $x<=$max; $x++)
     {
       $tmpout .= "├";
       for ($y=0; $y<6; $y++)
       {
         if ($y<5)
         {
           $tmpout .= $output[$x][$y]."┼";
         }
         else
         {
           $tmpout .= $output[$x][$y]."┤";
         }
       }
       $tmpout .= "<BR>";
     }
     $tmpout .= "└─┴─┴─┴─┴─┴─┘<BR>";
     mysqli_close($db);   
     return $tmpout;
  }
  else
  {
    mysqli_close($db);
    return;      
  }  
// }
// else
// { return; };
}

?>