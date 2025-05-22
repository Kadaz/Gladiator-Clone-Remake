<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

        <title>GladClone</title>

                                <link rel="stylesheet" type="text/css" media="screen" href="game_05.css" />

                        <style type="text/css">

        </style>

</head>



<body>

<script type="text/javascript" src="js/mootools-core.js"></script>

<script type="text/javascript" src="s/mootools-more.js"></script>



<div id="container">

    <div id="header">

        <span class="topmenuitem"><a href="konto.php">Perfil</a></span>

        <span class="topmenuitem"><a href="mensajes.php">Posts</a></span>

        <span class="topmenuitem"><a href="Forum/" target="_blank">Forum</a></span>

        <span class="topmenuitem"><a href="screenshot.php">Screenshots</a></span>

        <a id="header_link" href=""></a>

    </div>

    <div id="charvalues">
	
	<img src='' alt='' style='float:left;margin-right:90px' width='1px' height='1px'/>
	
<?php 
if($uzytkownik['reportes'] < 1){
 $reportsi = '1';
 }else{
 $reportsi = '2'; }
if($uzytkownik['mensajes'] < 1){
 $messagesi = '1';
 }else{
 $messagesi = '2'; } 
if($uzytkownik['noticias'] < 1){
 $newsi = '1';
 }else{
 $newsi = '2'; } 
?>

        <a id="menue_news" class="menue_news" href="news.php" title="News"><img src='img/news<?php echo $newsi; ?>.gif' alt='' style='float:left;margin-right:0px' width='42px' height='39px'></img></a>
		
		<a id="menue_reports" class="menue_reports" href="reportes.php" title="Reports"><img src='img/reports<?php echo $reportsi; ?>.gif' alt='' value='1' style='float:left;margin-right:30px' width='42px' height='39px'></img></a>

        <a id="menue_messages" class="menue_messages" href="mensajes.php" title="Messages"><img src='img/messages<?php echo $messagesi; ?>.gif' alt='' style='float:left;margin-right:0px' width='42px' height='39px'></img></a>

        <div class="headerDiv1">

            <div class="headerHighscore">

                <div><span class="charvaluesPre">Victories:</span><span class="charvaluesSub"><?php echo $uzytkownik['victorias']; ?></span></div>

                <div style="margin-top:4px;"><div><span class="charvaluesPre">Missed:</span><span class="charvaluesSub"><?php

				echo $uzytkownik['perdidas']; ?></span></div></div>

            </div>

            <div class="headerHonor">

                <div><span class="charvaluesPre">Honor:</span><span class="charvaluesSub"><?php echo $uzytkownik['honor']; ?></span></div>

                <div><span class="charvaluesPre">Fame:</span><span class="charvaluesSub"><?php echo $uzytkownik['fama']; ?></span></div>

                <div><span class="charvaluesPre">Level:</span><span class="charvaluesSub"><?php echo $uzytkownik['nivel']; ?></span></div>

            </div>

            <div class="headerRes">

				<div><span class="charvaluesPre">Gold:</span><span class="charvaluesSub" id="sstat_gold_val"><?php echo $uzytkownik['zloto']; ?></span></div>

				<div style="margin-top:4px">

                    <span class="charvaluesPre">

                                                    <a style="color:black;text-decoration:none;" href="">Rubies</a>:

                                            </span>

                    <span class="charvaluesSub" id="sstat_ruby_val"><?php echo $uzytkownik['rubies']; ?></span></div>

			</div>

			<a id="rubies" href=""></a>



                    </div>

    </div>

	<div id="main">
		<table cellspacing="0" cellpadding="0" height="100%" border="0">
			<tr height="100%">
				<td height="100%" valign="top" id="leftblock_middle">

					<div id="leftblock_top"></div>
				</td>