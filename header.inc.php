<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Author" content="nicaw" />
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $ptitle?></title>
<link rel="stylesheet" href="<?php echo $cfg['skin_url'].$cfg['skin']?>.css" type="text/css" media="screen" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/simple-sidebar.css" rel="stylesheet">

<link rel="stylesheet" href="default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="print.css" type="text/css" media="print" />
<link rel="alternate" type="application/rss+xml" title="News" href="news.php?RSS2" />


<script type="text/javascript" src="javascript/prototype.js"></script>
<script type="text/javascript" src="javascript/main.js"></script>
<link rel="shortcut icon" href="resource/favicon.ico" />
<?php if (!empty($_SESSION['account']) && empty($_COOKIE['remember'])){?>
<script type="text/javascript">
//<![CDATA[
function tick()
    {
        ticker++;
        if (ticker > <?php echo $cfg['timeout_session'];?>){
            self.window.location.href = 'login.php?logout&redirect=account.php';
        }else{
            setTimeout ("tick()",1000);
        }
    }
    ticker = 0;
    tick();
//]]>
</script>
<?php }?>
</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64835719-1', 'auto');
  ga('send', 'pageview');

</script>

<div id="form"></div>

 <div id="wrapper">
<div id="sidebar-wrapper"> <!-- Custom -->
	<ul class="sidebar-nav">
	<li class="sidebar-brand">
		<a href="/"><?php echo $cfg['server_name']?></a>
	</li>
<div id="navigation">
<?php 
if (file_exists('navigation.xml')){
	$XML = simplexml_load_file('navigation.xml');
	if ($XML === false) throw new aacException('Malformed XML');
}else{die('Unable to load navigation.xml');}
foreach ($XML->category as $cat){
	echo '<li class="top" onclick="menu_toggle(this)" style="cursor: pointer;">'.$cat['name'].'</li>'."\n";
	foreach ($cat->item as $item)
		echo '<li><a href="'.$item['href'].'">'.$item.'</a></li>'."\n";
}
?>
</div>
<li class="top">
Status
</li>
<div style="padding-left:20px">
<?php
if(!empty($_SESSION['account'])) {
    $account = new Account();
    $account->load($_SESSION['account']);
    echo 'Logged in as: <b>'.$account->attrs['accno'].'</b><br/>';
    echo '<a onclick="window.location.href=\'login.php?logout&amp;redirect=account.php\'">Logout</a><hr/>';
}
?>
<div id="server_state">
<span class="offline">Server Offline</span>
<script type="text/javascript">
//<![CDATA[
    new Ajax.PeriodicalUpdater('server_state', 'status.php', {
      method: 'get', frequency: 60, decay: 1
    });
//]]>
</script>
</div>
</div>
</div>
<div class="page-content-wrapper" style="padding-top:15px">
<a id="menu-toggle" style="top:0;right:0;position:absolute" href="#menu-toggle">Menu</a>
	<div class="container-fluid">
        <div class="row">
			<div class="col-sm-12">
				
