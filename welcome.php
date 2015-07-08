<?php 
include ("include.inc.php");
$ptitle= "Registration - $cfg[server_name]";
include ("header.inc.php");
?>
<div id="content">
<style>
.banner{
	height:240px;
	background:#eee;
	position:relative;
}
.banner-content{
	font-size:48px;
    position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}

</style>
<!--
<div class="banner">
<div class="banner-content">Tibia Classic 7.6</div>
</div>
-->

<div class="jumbotron">
<h1>Tibia Classic 7.6</h1>
<p>Join in the excitement of playing Tibia 7.6, an authentic old-school version of Tibia, restored back to its official December 2005 release.</p>
<p><a class="btn btn-primary btn-lg" href="register.php#download">Download Tibia Classic 7.6</a></p>
</div>

<div class="mid" style="height:40px;"></div>
<div class="row" style="text-align:center;">
      <div class="col-sm-4">
        <i class="large-text glyphicon glyphicon-user"></i>
        <h3>Make an account</h3>
        <p>Start by registering and creating a character <a href="register.php">here</a>. Then proceed to downloading the game client.</p>
      </div>
      <div class="col-sm-4">
        <i class="large-text glyphicon glyphicon-download"></i>
        <h3>Download client</h3>
        <p>Click here to <a href="register.php#download">download</a> the game client for Windows, Linux, or Mac!</p>
      </div>
      <div class="col-sm-4">
        <i class="large-text glyphicon glyphicon-fire"></i>
        <h3>Log on!</h3>
        <p>Open the game client, log on, and start slaying creatures now.</p>
      </div>
    </div>

<div class="bot"></div>
</div>
<?php include ("footer.inc.php");?>