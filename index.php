<?php
include("chordgenerator.php");

echo "<!DOCTYPE html>\n";
echo "<HTML>\n";
echo "<HEAD>\n";
echo "<script src=\"./jquery-1.12.4.min.js\"></script>\n";
?>

<script>
function closePopup(ttt) { 
  $('#'+ttt).hide(500);
}

$(document).ready(function() {
    var $dragging = null;
    $(document.body).on("mousemove", function(e) {
        if ($dragging) {
            $dragging.offset({
                top: e.pageY,
                left: e.pageX
            });
        }
    });
    
    $(document.body).on("mousedown", "div", function (e) {
        $(this).stop(true,false).animate();
        $dragging = $(e.target);
    });
    
    $(document.body).on("mouseup", function (e) {
        $dragging = null;
    });    
});    


$(function() {

  var moveLeft = 0;
  var moveDown = 0;

  $('a.popper').hover(function (e) {
    var target = '#' + ($(this).attr('data-popbox'));
    $(target).show();
    moveLeft = $(this).outerWidth();
    moveDown = ($(target).outerHeight() / 2);
  }, function () {
    var target = '#' + ($(this).attr('data-popbox'));
    if (!($("a.popper").hasClass("show"))) {
       $(target).delay(3000).hide(500);
  }
  });

  $('a.popper').mousemove(function (e) {
    var target = '#' + ($(this).attr('data-popbox'));
    leftD = e.pageX + parseInt(moveLeft);
    maxRight = leftD + $(target).outerWidth();
    windowLeft = $(window).width() - 40;
    windowRight = 0;
    maxLeft = e.pageX - (parseInt(moveLeft) + $(target).outerWidth() + 20);
    if (maxRight > windowLeft && maxLeft > windowRight) {
        leftD = maxLeft;
    }
    topD = e.pageY - parseInt(moveDown);
    maxBottom = parseInt(e.pageY + parseInt(moveDown) + 20);
    windowBottom = parseInt(parseInt($(document).scrollTop()) + parseInt($(window).height()));
    maxTop = topD;
    windowTop = parseInt($(document).scrollTop());
    if (maxBottom > windowBottom) {
        topD = windowBottom - $(target).outerHeight() - 20;
    } else if (maxTop < windowTop) {
        topD = windowTop + 20;
    }
    $(target).css('top', topD).css('left', leftD);
  });
});
</script>

<?php
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"main.css\">";
echo "</HEAD>\n";
echo "<meta charset=\"utf-8\">\n";
echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\">\n";


echo "<BODY>\n";


$file = fopen("song.txt","r");

$pop = 0;

while(! feof($file))
{
  $line = fgets($file);
  $line=str_replace(PHP_EOL,"",$line);
  // check gia akornto
  $pos=strpos($line,"<chrd>");
  if ($pos !== false) 		// contains chords, do some processing here
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
           $pop += 1;
           $output = chordgenerator($tmp);
           if ($output != NULL)
           {
             $popper = "pop";
             $popper .= strval($pop);
             echo "<div id=\"".$popper."\" class=\"popbox\">".
                  $output."".
                  "<div class=\"cancel\" onclick=\"closePopup('".$popper."');\">✕</div></div>".
                  "<a href=\"#\" class=\"popper\" data-popbox=\"".$popper."\">".
                  $tmp."</a>\n";
           }
           else
           {
             echo "&nbsp;";
           }
         }
       }
       echo "&nbsp;";
     }     
     echo "<BR>\n";
  }
  else 				// contains lyrics, just display line
  {
    echo $line;
  }
}

fclose($file);

echo "</BODY>\n";
echo "</HTML>\n";
?> 
