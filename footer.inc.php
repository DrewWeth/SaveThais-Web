<noscript class="exception">This website requires javascript to run correctly.</noscript><br/>
<div id="footer" class="clearer">&nbsp;<span><a href="http://nicaw.net/">Nicaw AAC</a> &copy; <a href="documents/LICENCE.TXT">GPL</a>. Redesigned by <a href="http://github.com/drewweth">Drew</a></span></div>
</div>
</div> <!-- 70% div -->
</div> <!-- 100% div -->
</div>

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

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script>
	var menu = document.getElementById("menu-toggle");
	menu.onclick = function(e){
        e.preventDefault();
		document.getElementById("wrapper").classList.toggle("toggled"); 
        return false;
    };
	
</script>
</body>
</html>