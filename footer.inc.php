</div> <!-- close of container -->
<noscript class="exception">This website requires javascript to run correctly.</noscript><br/>
<div id="footer" class="clearer">

  <div>Original by <a href="http://nicaw.net/">Nicaw AAC</a></div>
  <div>Redesigned by <a href="http://github.com/drewweth">Drew</a></div>



</div>
</div>
<?php
//Get current time as we did at start
    $mtime = microtime();
    $mtime = explode(" ",$mtime);
    $mtime = $mtime[1] + $mtime[0];
//Store end time in a variable
    $tend = $mtime;
//Calculate the difference
    $totaltime = ($tend - $tstart);
//Output result
    printf ("<!--Page was generated in %f seconds !-->\n", $totaltime);
?>
</body>
</html>
