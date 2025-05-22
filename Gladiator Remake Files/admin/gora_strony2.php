<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

        <title>GladClone Admin Panel</title>

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

        <span class="topmenuitem"><a href="mensajes.php">Mensajes</a></span>

        <span class="topmenuitem"><a href="Forum/" target="_blank">Foro</a></span>

        <span class="topmenuitem"><a href="screenshot.php">Fotos del servidor</a></span>

        <a id="header_link" href=""></a>

    </div>

    <div id="charvalues">
	
	<img src='' alt='' style='float:left;margin-right:90px' width='1px' height='1px'/>

        <a id="menue_news" class="menue_news" href="news.php" title="News"><img src='img/news.gif' alt='' style='float:left;margin-right:70px' width='42px' height='39px'/></a>

        <a id="menue_messages" class="menue_messages" href="mensajes.php" title="Messages"><img src='img/messages.gif' alt='' style='float:left;margin-right:0px' width='42px' height='39px'/></a>

        <div class="headerDiv1">

            <div class="headerHighscore">

                <div><span class="charvaluesPre">Victorias:</span><span class="charvaluesSub"><?php echo $uzytkownik['victorias']; ?></span></div>

                <div style="margin-top:4px;"><div><span class="charvaluesPre">Perdidas:</span><span class="charvaluesSub"><?php echo $uzytkownik['perdidas']; ?></span></div></div>

            </div>

            <div class="headerHonor">

                <div><span class="charvaluesPre">Honor:</span><span class="charvaluesSub"><?php echo $uzytkownik['honor']; ?></span></div>

                <div><span class="charvaluesPre">Fama:</span><span class="charvaluesSub"><?php echo $uzytkownik['fama']; ?></span></div>

                <div><span class="charvaluesPre">Nivel:</span><span class="charvaluesSub"><?php echo $uzytkownik['nivel']; ?></span></div>

            </div>

            <div class="headerRes">

				<div><span class="charvaluesPre">Oro:</span><span class="charvaluesSub" id="sstat_gold_val"><?php echo $uzytkownik['zloto']; ?></span></div>

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