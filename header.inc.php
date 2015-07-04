<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Author" content="nicaw" />
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<title><?php echo $ptitle?></title>
<!--Import materialize.css-->
<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
<link rel="stylesheet" href="css/custom.css" type="text/css" />

<!--Let browser know website is optimized for mobile-->
<!-- <link rel="stylesheet" href="default.css" type="text/css" media="screen" /> -->
<!-- <link rel="stylesheet" href="print.css" type="text/css" media="print" /> -->

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
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

<div id="form"></div>
<div id="container">
<div id="navigation">
  <nav>
  <div class="nav-wrapper">
    <a href="/" class="brand-logo left"><?php echo $cfg['server_name']?></a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
<?php
if (file_exists('navigation.xml')){
	$XML = simplexml_load_file('navigation.xml');
	if ($XML === false) throw new aacException('Malformed XML');
}else{die('Unable to load navigation.xml');}
foreach ($XML->category as $cat){

	foreach ($cat->item as $item)

		echo '<li><a href="'.$item['href'].'">'.$item.'</a></li>'."\n";
}
?>

</ul>
<ul id="slide-out" class="side-nav">
  <?php
  if (file_exists('navigation.xml')){
    $XML = simplexml_load_file('navigation.xml');
    if ($XML === false) throw new aacException('Malformed XML');
  }else{die('Unable to load navigation.xml');}
  foreach ($XML->category as $cat){

    foreach ($cat->item as $item)

      echo '<li><a href="'.$item['href'].'">'.$item.'</a></li>'."\n";
  }
  ?>

  </ul>
  <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
</div>
</nav>

</div>
<script>
  $(".button-collapse").sideNav();
</script>
<div class="container">
