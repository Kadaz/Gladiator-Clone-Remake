// ==UserScript==
// @name           Gladiatus Crazy AddOn New Server
// @namespace      http://www.epiratiko.webs.com/ 
// @description    The craziest add-on for gladiatus ever!
// @include        *.gladiatus.*
// @exclude        *board.gladiatus.*
// ==/UserScript==
//Copyright (C) 2010 - 2011, Apo59m, DarkThanos and djor

//################################################################################################################################
//## GENERAL SCRIPT'S VALUES / G?????S ?????????S ??? SCRIPT
//################################################################################################################################
var version = "240";
if(document.location.href.match(/^(.*\?)mod=(\w+).*sh=([0-9a-fA-F]+)/)){
	var GCAO_result = document.location.href.match(/^(.*\?)mod=(\w+).*sh=([0-9a-fA-F]+)/);
	var GCAO_allresult = GCAO_result[0]; //ex.: http://s3.gladiatus.gr/game/index.php?mod=overview&sh=3311f55ccc62c53c42170cdf78b1cf59
	var GCAO_siteurl = GCAO_result[1]; //ex.: http://s3.gladiatus.gr/game/index.php?
	var GCAO_mod = GCAO_result[2];
	var GCAO_secureCode = GCAO_result[3];
	var UrlOverview = GCAO_siteurl + 'mod=overview&sh=' + GCAO_secureCode;
	var UrlUpdate = "http://epiratiko.webs.com/GCAO/UpdateGCAO.htm";
	if(document.location.href.match(/http\:\/\/s(\d+)/i)){var GCAO_server = document.location.href.match(/http\:\/\/s(\d+)/i)[1];}
	else{var GCAO_server = "1";}
}
if(document.location.href.match(/submod=(\w+)/)){var GCAO_submod = document.location.href.match(/submod=(\w+)/)[1];}
else{var GCAO_submod = 'noSubmod';}
var day=new Date();

//################################################################################################################################
//## COUNTRY / LANGUAGE - ?O?? / G?OSS?
//################################################################################################################################
if(document.location.href.match(/gladiatus\.(\w+)/)){
	var GCAO_lang = document.location.href.match(/(\w*)\.gladiatus\.(\w+)\.*(\w*)/);
	if(GCAO_lang[1].match("s") || GCAO_lang[1].match("www")){
		if(GCAO_lang[3]){GCAO_lang = GCAO_lang[2] + '.' + GCAO_lang[3];}
		else{GCAO_lang = GCAO_lang[2];}
	}
	else{GCAO_lang = GCAO_lang[1];}
	
	if(GCAO_lang=='gr'){
		//Shurtcut Buttons
		var L_guildMailTitle='G???e µ???µa t??µat??';
		var L_guildMedicTitle='???a??e st? ?at???? ???t??';
		var L_guildMarketTitle='???a??e st?? a???? t??µat??';
		var L_guildStorageTitle='???a??e st?? ap????? t??µat??';
		var L_staticsTitle='?a stat?st??? µ??';
		//Alerts
		var L_sure='??sa? s???????;';
		var L_weaponAlert='<font color="red">?e?</font> f???? ?p??<font color="red">!</font>';
		var L_newMail='??e?? ??a <font color="yellow">???</font> µ???µa st? f????µ<font color="yellow">!</font>';
		var L_Full='Geµ?t?';
		var L_New='???';
		var L_newsAlert='?p???e? ??a <font color="yellow">???</font> µ???µa sta ??a t?? GCA<font color="yellow">!</font>';
		var L_PackagesWillExpire='?a pa??ta ?????? s??t?µa';
		var L_hours='??e?';
		//Change Image
		var L_changePlayerImage='???a?e t?? e????a t?? pa??t?';
		var L_Overfloated='Geµ?t?';
		var L_plImageWillBeLost='? e????a t?? pa??t? de? ?a ap????e?te?';
		var L_plDecriptionWillBeCut='? pe????af? t?? pa??t? ?a ??pe? ??a ?a ????e?';
		var L_defImages='???ep??e?µ??e? e????e?';
		var L_imgMadeFrom='?? e????e? d?µ?????????a? ap? t??';
		var L_changeGuildImage='???a?e t?? e????a t??µat??';
		var L_gImageWillBeLost='? e????a t?? t??µat?? de? ?a ap????e?te?';
		var L_gDescrtipionWillBeCut='? pe????af? t?? t??µat?? ?a ??pe? ??a ?a ????e?';
		//Training
		var L_spent='??de?t??a?';
		var L_SimOfTraining = '?et??t?? ??st??? ??pa?de?se??';
		var L_Stat = 'Stat?st???';
		var L_From = '?p?';
		var L_To = '?????';
		var L_Cost = '??st??';
		var L_TrainingCampLevel = '?p?ped? ????? e?pa?de?s?? t??µat??';
		var L_Reduction ='?e??s?:';
		var L_TotalCost = 'S??????? ??st??:';
		var L_Calculate = '?p?????sµ??';
		var L_TotalCostTitle = '?a stat?st??? µ?? st?? a??ste?? st???';
		var L_CalculateTitle = '?p?????sµ?? t?? ??st??? ???? t?? stat?st????';
		//Simulator
		var L_Simulator='???s?µ???t??';
		var L_arena='?????';
		var L_Battles='???e?';
		var L_Won='???e?';
		var L_Lost='?tte?';
		var L_Draws='?ss?pa??e?';
		var L_Damage='??µ??';
		var L_myAvDamage='??s? ??µ?? µ??';
		var L_hisAvDamage='??s? ??µ?? a?t?p????';
		var L_Life='???t?? ????';
		var L_myRemLife='?p????p?µe??? p??t?? ???? µ??';
		var L_hisRemLife='?p????p?µe??? p??t?? ???? a?t?p????';
		var L_trainingSim='???s?µ???t?? e?pa?de?s??';
		var L_playerA='?a??t?? ?';
		var L_playerB='?a??t?? ?';
		var L_selectMethod='?p????? µe??d??';
		var L_selectEnemy='?p????? e?????';
		var L_byName='?a??t?? µe ???µa';
		var L_byID='?a??t?? µe ID';
		var L_go='???s?µ???s?';
		var L_winnigChance='???a??t?ta ?a ????se??';
		var L_PlayerAAvDamage='??s? ??µ?? t?? pa??t? ?';
		var L_PlayerBAvDamage='??s? ??µ?? t?? pa??t? ?';
		var L_Results='?p?te??sµata';
		var L_ClearAll='??a????s?';
		var L_playerNotFound='? pa??t?? de? ß?????e';
		var L_searchData='????t?s? ded?µ????...';
		var L_noStats='?e? ?p?????? stat?st???';
		var L_thisIsLocation='??t? e??a? pe?????';
		//Guild
		var L_StorageInfo='?????f???e? ap??????';
		var L_itemNum='????µ?? a?t??e?µ????';
		var L_TotalValue='S??????? a??a';
		var L_currentLife='???t?? ????';
		var L_lostLife='?aµ???? p??t?? ????';
		var L_healLife='???t?? ap? ?e?ape?a';
		var L_afterLife='???t?? µet? t?? ?e?ape?a';
		//Auction
		var L_bidNum='????µ?? p?e??d?t?se??';
		var L_Items='??t??e?µe?a';
		var L_selectItem='?p????? a?t??e?µ????';
		var L_Type='??p??';
		var L_selectType='?p????? t?p??';
		var L_Clear='??a????s?';
		var L_veryShort='???? ?????';
		var L_anunGuild='??a????s? st? t??µa';
		var L_MessageWasSent='?? µ???µa est??e?!';
		var L_minDamage='?????st? max-??µ??';
		var L_wearponsFound='?p?a p?? ß?????a?';
		var L_select='?p????te';
		//Online Players
		var L_OnlinePlayers='??e???? pa??te?';
		var L_guildPlayers='??e???? pa??te? t??µat??';
		var L_familyPlayers='??e???? ?????e??a??? pa??te?';
		var L_noOnlinePlayer='?e? ?p?????? e?e???? pa??te?';
		var L_sentMessage='G???e µ???µa';
		//Packages
		var L_gold='???s??';
		var L_Packages='?a??ta';
		var L_invItems='?p????e?µ??a a?t??e?µe?a';
		var L_packedValue='???a pa?eta??sµ???? a?t??e?µ????';
		var L_invValue='???a ap????e?µ???? a?t??eµ????';
		var L_total='S?????';
		var L_PackedGold='?a?eta??sµ???? ???s??';
		var L_totalGold='S???????? ?e?d?sµ???? ???s??';
		var L_totalItemValue='S??????? a??a a?t??e?µ????';
		//Chat
		var L_checkAll='????';
		var L_Username='???µa ???st?';
		var L_Country='???a';
		var L_GuildChat='Chat ???µat??';
		var L_CountryChat='Chat ???a?';
		var L_GlobalChat='?a???sµ?? Chat';
		//Other
		var L_ID='ID pa??t?';
		var L_ratioTitle='Ratio ??a??s?µ?? | Ratio ??µ??';
		var L_addAll='+ ??a';
		var L_noGuildText='?e? e?sa? se t??µa.<br>?? e?sa? p??pe? ?a pa? <a href='+GCAO_siteurl+'mod=guild&sh='+GCAO_secureCode+' >ed?</a> ??a ?a a?a?e?se?? ta st???e?a s??';
		//Settings
		var L_GCASettings='???µ?se?? t?? Gladiatus Crazy Add On';
		var L_HeaderSettings='???µ?se?? t?? Header';
		var L_DisplayLife='?µf???s? t?? µp??a? ????';
		var L_DisplayLifePercent='?µf???s? ?a? t?? p??t?? ???? ?a? t?? p?s?sto? ???? (????? mouseover)';
		var L_DisplayLinkButtons='?µf???s? t?? ???µp??? st? header';
		var L_DisplayAuctionStatus='?µf???s? t?? ?at?stas?? d?µ?p?at????? st? header';
		var L_DisplayMerchantStatus='?µf???s? t?? ?at?stas?? d?µ?p?at????? µ?s??f???? st? header';
		var L_DisplayOnlinePlayersButton='?µf???s? t?? "??e???? ?a??te?" ???µp??? st? header';
		var L_DisplayLinkBox='?µf???s? t?? ???t??? t?? ?pe?s??d?sµ?? sta de??? t?? se??da?';
		var L_TimersSettings='???µ?se?? ?et??t??';
		var L_DisplayLastBeingAttacked='?µf???s? t?? ?????? p?? ??e? pe??se? ap? t?? te?e?ta?a ep??es? p?? d??t??e? ap? ????a';
		var L_DisplayLastBeingAttacked2='?µf???s? t?? ?????? p?? ??e? pe??se? ap? t?? te?e?ta?a ep??es? p?? d??t??e? ap? ??.??sµ?s??????';
		var L_AuctionSettings='???µ?se?? ??µ?p?at?????';
		var L_FillAuctionPrices='??t?µat? s?µp????s? t?? t?µ?? st? d?µ?p?at????';
		var L_ChangeItemsBgColor='??a?? t?? ???µ?t?? t?? pa?as?????? t?? a?t??e?µ???? (ß?s? t?? p???t?ta?)';
		var L_AuctionMoreItemsLavels='?e??ss?te?e? ep?????? ep?p?d?? a?t??e?µ???? st?? a?a??t?s? t?? d?µ?p?at?????';
		var L_DisplayItemNumAndBids='?µf???s? t?? a???µ?? t?? a?t??e?µ???? ?a? t?? a???µ?? t?? p??sf????';
		var L_DisplayItemList='?µf???s? t?? ??sta? a?t??e?µ???? st?? a?a??t?s? t?? a????? ?a? t?? d?µ?p?at?????';
		var L_ExpandAuctionTable3='?p??tas? t?? p??a?a t?? d?µ?p?at????? (3 a?t??e?µe?a a?a ??aµµ?)';
		var L_SimulatorSettings='???µ?se?? p??s?µ???t?';
		var L_enSimulator='??e???p???s? t?? PvP p??s?µ???t? st? p??f?? t?? ???e pa??t?';
		var L_setFightNum='????µ?? p??s?µ???se??';
		var L_maximum='µ???st?';
		var L_guildSettings='???µ?se?? ???µat?? & ??????';
		var L_guildStoreInfo='?µf???s? t?? ???t??? p????f????? st?? ap????? t??µat??';
		var L_moreGuildStats='?p?p???? stat?st??? st?? a????sa t?? ?????ta t?? p???µ?? ??a ta p??ta 15 t??µata';
		var L_monsterSimulator='?µf???s? t?? p??s?µ???t? e?pa?de?s?? st?? ????? e?pa?de?s?? st? t??µa';
		var L_gmailChanges='??e???p???s? t?? a??a??? ?ta? st???e?? µ???µa t??µat??';
		var L_ratioOpt='?µf???s? t?? a???µ?? "Ratio" (a?a??s?µ?? ?a? t?µ??) ??a ???e a?t??e?µe?? st?? a????';
		var L_enPriceRatio='??e??p???s? t?? a???µ?? "Ratio" t?µ?? (de? e??a? p??? a???ß??)';
		var L_alertSettings='???µ?se?? e?d?p???se??';
		var L_immedBuy='????µa epa???e?s?? ?at? t?? e?a???? a?t??e?µ???? st? d?µ?p?at????';
		var L_reduceTimeEx='????µa epa???e?s?? ?at? t?? p????µ? ???µp????? ??a ep??es? st?? ap?st????';
		var L_questOpt='?µf???s? e?d?p???s?? ea? µp??? ?a p??? ??a ap?st??? ? eµf???s? t? ?????';
		var L_forumMessageOpt='??d?p???s? ea? ??? ??? µ???µa st? f????µ (µe ??a [ ! ] d?p?a st? f????µ)';
		var L_weaponAlertOpt='??d?p???s? ea? de? f???? ?p?? (µe ??a [ ! ] d?p?a st?? p??ep?s??p?s?)';
		var L_otherSettings='???e? ???µ?se??';
		var L_msgchangesOpt='??e???p???s? t?? a??a??? sta µ???µata';
		var L_enBBCODE='??e???p???s? t?? BBCODE sta µ???µata';
		var L_enChat='??e???p???s? t?? Chat (???µat??, ???a? ?a? ?a???sµ??)';
		var L_enRememberTabs='?p?µ??µ??e?s? t?? ?a?t??a? ts??ta? ?a? p???t?';
		var L_enImages='??e???p???s? t?? s?st?µat?? t?? a??a?µ???? e?????? pa??t?? ?a? ta?µ?t??';
		var L_disPackageCounters='?µf???s? t?? µet??t?? sta pa??ta';
		var L_disID='?µf???s? t?? ID ???e pa??t? ??t? ap? ta stat?st??? t??';
		var L_disHeal='?µf???s? t?? Ta?ape?a? ???e pa??t? ??t? ap? ta stat?st??? t??';
		var L_disTrainingChages='?µf???s? t?? ßas???? e?pa?de?se?? ?a? t?? a??a??? t?? µe??st?? st?? e?pa?de?s?';
		var L_enHighlight='?p?f?t?s? t?? a?t??e?µ???? p?? de? µp????? ?a a???ast???';
		var L_enStyleFixes='??e???p???s? t?? d?????se?? t?? style';
		var L_speedSettings='???µ?se?? ta??t?ta?';
		var L_stopPulling='?a?s? ??t??s?? p????f????? ?at? t?? f??t?s? (???µ?s? ??a a???? s??d?se??)';
		var L_willStop='??t? ? ep????? ?a <font color="red"><b>staµat?se?</b></font> ta';
		var L_customCursor='???a?? t?? ???s??a';
		var L_Save='S?se';
		var L_AboutUs='S?et??? µe µa?';
		var L_Settings='???µ?se??';
		var L_donateTitle='????ste st? Gladiatus Crazy Add On';
		var L_donateText='???a??st?ste µa? ?a? ta?t?????a ß????ste µa? d??????ta? µa? µe???? ???µata st?? ???a??asµ? µa? st?? PayPal. ?e t?? d??e? sa? a?t? ?a µa? ß????sete ?a s??e??s??µe ?a d???e???µe p??? st? p??s?et? a?t? p?? s?µa??e? pe??ss?te?e? a?aßa?µ?se??, ?a??????a ?a?a?t???st??? ?a? ?a????? bugs (p??ß??µata)! ?at?ste t? ???µp? ??a ?a µa? ?p?st????ete';
		var L_description='?? Gladiatus Crazy Add On e??a? ??a d??e?? p??s?et? p?? ß????e? t?? ???st? st? pa????d? Gladiatus µ?sa ap? ta p???? ?a?a?t???st??? p?? p??sf??e?. St?? ??s?a ???s?µ?p??e? ?a??te?a t?? p????f???e? p?? ? server t?? pa????d??? d??e? st?? browser t?? ???st?. ?p??a?ste t?, ?a?? d?as??das? ?a? ?a??? µ??e?!';
		var L_aboutTitle='S?et??? µe t? Gladiatus Crazy Add On';
		var L_descriptionTitle='?e????af?';
		var L_Programmers='?????aµµat?st??';
		var L_Translators='?etaf?ast??';
		var L_Hostpage='?st?se??da';
		var L_ContactUs='?p????????ste µa?? µa?';
		var L_Contact1='µe e-mail st? Apo59m@gmail.com ? GreatApo@gmail.com';
		var L_Contact2='µe ????µa st?? pa??te? µa? st??? ?????????? server (GreatApo st?? s1 ?a? DarkThanos st?? s2) ? st?? Ga????? server (djor st?? s?)';
		var L_Contact3='? ap? ta 3 a????t? topic st? <a href="http://board.gladiatus.gr/index.php?page=Thread&threadID=12835" target="_blank">????????</a>, <a target="_blank" href="http://board.gladiatus.fr/index.php?page=Thread&amp;threadID=37368">Ga?????</a> ?a? <a target="_blank" href="http://board.gladiatus.us/index.php?page=Thread&amp;threadID=15543">?µe????????</a> f????µ';
		var L_thanksTo='????? e??a??st? st???';
		var L_MonsterHunters='??????? stat?st????/???µ?t?? te??t??';
		var L_ItemHunters='??????? a?t??e?µ????';
		var L_HideGoldInAuction='???µa st? input e?? µp??e?? ?a p????se?? t? a?t??e?µe?? st??? p???t?? st?? ?d?a t?µ?';
		var L_guildSafeChanges='??e???p???s? t?? a??a??? st?? t??pe?a t??µat??';
		var L_guildMedicChanges='?µf???s? pe??ss?te??? p????f????? st? ?at???? ???t??';
		var L_foodBackColor='??????? ???µa p?s? ap? ta fa??t? p?? d????? pe??ss?te???? p??t??? ???? ap? ?t? ??e???eta? (st?? p??ep?s??p?s?)';
		var L_packageAlertOpt='??d?p???s? ??a t?? ???? t?? pa??t?? (12 ??e? p???)';
	}else if(GCAO_lang=='fr'){
		//Shurtcut Buttons
		var L_guildMailTitle='Ecrire un message à la guilde';
		var L_guildMedicTitle='Aller à la Villa Medici';
		var L_guildMarketTitle='Aller au marché de guilde';
		var L_guildStorageTitle='Aller à l\'entrepôt de guilde';
		var L_staticsTitle='Mes stats';
		//Alerts
		var L_sure='Êtes vous sûr ?';
		var L_weaponAlert='Vous <font color="red">ne </font>portez <font color="red">pas</font> d\'arme <font color="red">!</font>';
		var L_newMail='<font color="yellow">Nouveau</font> message sur le forum <font color="yellow">!</font>';
		var L_Full='Plein';
		var L_New='NEW';
		var L_newsAlert='Il y a une <font color="yellow">nouveauté</font> à propos de GCA <font color="yellow">!</font>';
		var L_PackagesWillExpire='Les paquets vont bientôt expirer'; 
		var L_hours='heures';
		//Change Image
		var L_changePlayerImage='Changer l\'image du joueur';
		var L_Overfloated='Overfloated';
		var L_plImageWillBeLost='L\image du joueur sera perdue et ne sera pas sauvegardée';
		var L_plDecriptionWillBeCut='La description du joueur va être tronquée';
		var L_defImages='Afficher les images par défaut';
		var L_imgMadeFrom='Les images proviennent de';
		var L_changeGuildImage='Modifier l\image de guilde';
		var L_gImageWillBeLost='L\'image de guilde va être perdue et ne sera pas sauvegardée';
		var L_gDescrtipionWillBeCut='La description de guilde va être tronquée';
		//Training
		var L_spent='dépensé';
		var L_SimOfTraining = 'Simulateur d\'entrainements';
		var L_Stat = 'Statistique';
		var L_From = 'De';
		var L_To = 'A';
		var L_Cost = 'Coût';
		var L_TrainingCampLevel = 'Niveau du terrain';
		var L_Reduction ='R&eacute;duction :';
		var L_TotalCost = 'Coût total :';
		var L_Calculate = 'Calculer';
		var L_TotalCostTitle = 'Mettre mes stats dans la colonne de gauche';
		var L_CalculateTitle = 'Calculer le coût des différentes statistiques';
		var L_ClearAllTitle = 'Réinitialiser les stats';
		//Simulator
		var L_Simulator='Simulateur';
		var L_arena='ARÈNE';
		var L_Battles='Combats';
		var L_Won='Victoires';
		var L_Lost='Défaites';
		var L_Draws='Matchs nuls';
		var L_Damage='Dégâts';
		var L_myAvDamage='Vos dégâts moyens';
		var L_hisAvDamage='Dégâts moyen de l\'adversaire';
		var L_Life='Vie';
		var L_myRemLife='Votre vie restante';
		var L_hisRemLife='Vie restante de votre adversaire';
		var L_trainingSim='Simulateur';
		var L_playerA='Joueur A';
		var L_playerB='Joueur B';
		var L_selectMethod='Choisissez la méthode';
		var L_selectEnemy='Choisissez l\'adversaire';
		var L_byName='Joueur, par son pseudo';
		var L_byID='Joueur, par son ID';
		var L_go='GO!';
		var L_winnigChance='Chance de gagner';
		var L_PlayerAAvDamage='Dégâts moyens du joueur A';
		var L_PlayerBAvDamage='Dégâts moyens du joueur B';
		var L_Results='Résultats';
		var L_ClearAll='Reset';
		var L_playerNotFound='Joueur introuvable';
		var L_searchData='Recherche d\'informations...';
		var L_noStats='Pas de stats disponibles';
		var L_thisIsLocation='C\'est un lieu...';
		//Guild
		var L_StorageInfo='Infos sur l\'entrepôt';
		var L_itemNum='Nombre d\'objets';
		var L_TotalValue='Valeur totale';
		var L_currentLife='Points de vie actuels';
		var L_lostLife= 'Points de vie manquants';
		var L_healLife= 'Points de vie restaurés';
		var L_afterLife= 'Points de vie après un soin';
		//Auction
		var L_bidNum='Nombre d\'enchérissement';
		var L_Items='Objets';
		var L_selectItem='Choisissez l\'objet';
		var L_Type='Type';
		var L_selectType='Choisissez le type';
		var L_Clear='Reset';
		var L_veryShort='Très court'; 
		var L_anunGuild='Annoncer à la guilde'; 
		var L_MessageWasSent='Message envoyé !'; 
		var L_minDamage='Minimum des dégâts max ';
		var L_wearponsFound='Armes trouvées';
		var L_select='Choisissez';
		//Online Players
		var L_OnlinePlayers='Joueurs en ligne';
		var L_guildPlayers='Membres de la guilde en ligne';
		var L_familyPlayers='Membre de la famille en ligne';
		var L_noOnlinePlayer='Personne n\'est en ligne';
		var L_sentMessage='Envoyer un message';
		//Packages
		var L_gold='Or';
		var L_Packages='Paquets';
		var L_invItems='Objets de l\'inventaire';
		var L_packedValue='Valeur des objets en paquet';
		var L_invValue='Valeur des objets de l\'inventaire';
		var L_total='Total';
		var L_PackedGold='Or en paquet';
		var L_totalGold='Total d\'or gagné';
		var L_totalItemValue='Valeur totale des objets';
		//Chat
		var L_checkAll='Cocher tout le monde';
		var L_Username='Pseudo';
		var L_Country='Pays';
		var L_GuildChat='Chat de guilde';
		var L_CountryChat='Chat du pays';
		var L_GlobalChat='Chat mondial';
		//Other
		var L_ID='ID du joueur';
		var L_ratioTitle='Ratio des aliments | Ratio des objets';
		var L_addAll='+ Tous';
		var L_noGuildText=	'Vous n\'avez pas de guilde.<br>Si vous en avez une, allez <a href='+GCAO_siteurl+'mod=guild&sh='+GCAO_secureCode+' >ici</a> pour mettre vos informations à jour';
		//Settings
		var L_GCASettings='Paramètres de Gladiatus Crazy Add On';
		var L_HeaderSettings='Paramètres du haut de page';
		var L_DisplayLife='Afficher la barre de vie';
		var L_DisplayLifePercent='Afficher les points de vie et le pourcentage de vie restante (rien lorsque la souris est au dessus)';
		var L_DisplayLinkButtons='Afficher les raccourcis';
		var L_DisplayAuctionStatus='Afficher le statut des enchères gladiateurs';
		var L_DisplayMerchantStatus='Afficher le statut des enchères mercenaires';
		var L_DisplayOnlinePlayersButton='Afficher le bouton "Joueurs en ligne"';
		var L_DisplayLinkBox='Afficher la boite à lien sur la droite de la page';
		var L_TimersSettings='Paramètres des chronos';
		var L_DisplayLastBeingAttacked='Afficher le temps passé depuis la dernière attaque reçue en Arène';
		var L_DisplayLastBeingAttacked2='Afficher le temps passé depuis la dernière attaque reçue en Circus Turma';
		var L_AuctionSettings='Paramètres des enchères';
		var L_FillAuctionPrices='Remplissage automatique des prix';
		var L_ChangeItemsBgColor='Modifier le fond des objets (basé sur leur qualité/couleur)';
		var L_AuctionMoreItemsLavels='Plus de choix de niveau';
		var L_DisplayItemNumAndBids='Afficher le nombre d\'objets et le nombre d\'enchérissement';
		var L_DisplayItemList='Afficher la liste d\'objet aux enchères et aux marchés';
		var L_ExpandAuctionTable3='Étendre l\'affichage des objets (3 objets par ligne)';
		var L_SimulatorSettings='Paramètres du simulateurs';
		var L_enSimulator='Lancer de simulateur sur chaque profil de joueurs';
		var L_setFightNum='Nombre de combats simulés';
		var L_maximum='maximum';
		var L_guildSettings='Paramètres de guilde et du marché';
		var L_guildStoreInfo='Afficher la boite d\information à l\'entrepôt de guilde';
		var L_moreGuildStats='Afficher plus de statistiques au hall de guerre pour les 15 premiers opposants';
		var L_monsterSimulator='Afficher le simulateur au bâtiment d\'entrainement';
		var L_gmailChanges='Modifier l\'affichage des mails de guilde';
		var L_ratioOpt='Afficher le ratio (nourriture et prix) pour chaque objet du marché';
		var L_enPriceRatio='Afficher le ratio (Ce n\'est qu\'un indicateur global, pas nécessairement fiable)';
		var L_alertSettings='Paramètres des alertes';
		var L_immedBuy='M\'alerter lorsque je fais un achat immédiat aux enchères';
		var L_reduceTimeEx='M\'alerter lorsque je veux raccourcir une expédition';
		var L_questOpt='M\'informer si une nouvelle mission est disponible ou afficher le temps restant';
		var L_forumMessageOpt='M\'informer si j\'ai un nouveau message sur le forum (avec un [ ! ] à côté du lien forum)';
		var L_weaponAlertOpt='M\'infomer si je ne porte pas d\'arme (avec un [ ! ] à côté de la vue générale)';
		var L_otherSettings='Autres paramètres';
		var L_msgchangesOpt='Autoriser les modifications des messages';
		var L_enBBCODE='Autoriser le BBCODE dans les messages';
		var L_enChat='Autoriser le Chat (Guilde, pays, mondial)';
		var L_enRememberTabs='Se rappeler des onglets d\inventaire et des marchands';
		var L_enImages='Autoriser les images personnalisées des joueurs et des guildes';
		var L_disPackageCounters='Afficher les compteurs pour paquets';
		var L_disID='Afficher l\'ID de chaque joueur sous ses stats';
		var L_disHeal='Afficher la valeur de soin de chaque joueur sous ses stats';
		var L_disTrainingChages='Afficher les stats de base et la modification du maximum lorsqu\'on s\'entraine';
		var L_enHighlight='Mettre en valeur les objets que vous pouvez acheter aux marchands';
		var L_enStyleFixes='Appliquer les correctifs de style';
		var L_speedSettings='Paramètres rapides';
		var L_stopPulling='Arrêter la récupération d\'informations au chargement de la page (pour les connexions lentes)';
		var L_willStop='Cette option va<font color="red"><b> arrêter</b></font>';
		var L_customCursor='Choisissez un curseur personnalisé';
		var L_Save='Sauvegarder';
		var L_AboutUs='A propos de nous';
		var L_Settings='Paramètres';
		var L_donateTitle='Faire un don à Gladiatus Crazy Add-On';
		var L_donateText='Remerciez nous and aidez nous par un don sur nos comptes PayPal. Par vos dons sur notre compte nous pourrons continuer à travailler sur cette extension, ce qui signifie de nouvelles mises à jour, de nouvelles fonctionnalités et moins de bugs ! Cliquez sur le bouton pour nous soutenir.';
		var L_description='Gladiatus Crazy Add On est une extension qui vous aide à jouer à Gladiatus à travers de toutes les fonctionnalités qu\'il vous propose. Il utilise au mieux les informations que le serveur de jeu délivre à votre navigateur. Amusez-vous avec et profitez de vos combats !';
		var L_aboutTitle='A propos de Gladiatus Crazy Add On';
		var L_descriptionTitle='Description';
		var L_Programmers='Developpeurs';
		var L_Translators='Traducteur';
		var L_Hostpage='Page d\'accueil';
		var L_ContactUs='Contactez-nous';
		var L_Contact1='par e-mail à Apo59m@gmail.com ou GreatApo@gmail.com';
		var L_Contact2='par message à nos joueurs sur les serveurs grecs (GreatApo sur le s1 and DarkThanos sur le s2) ou français (djor sur le s5)';
		var L_Contact3='ou sur les 3 topics ouverts sur les forums <a href="http://board.gladiatus.gr/index.php?page=Thread&threadID=12835" target="_blank">grecs</a>, <a target="_blank" href="http://board.gladiatus.fr/index.php?page=Thread&amp;threadID=37368">français</a> et <a target="_blank" href="http://board.gladiatus.us/index.php?page=Thread&amp;threadID=15543">américain</a>';
		var L_thanksTo='Remerciments à';
		var L_MonsterHunters='Chassurus des stats et noms des monstres';
		var L_ItemHunters='Chasseurs d\'objets';
		var L_HideGoldInAuction='Mettre en valeur si l\'objet peut être vendu aux marchands au prix de l\'enchère';
		var L_guildSafeChanges='Autoriser les modifications sur la page des dons de guilde';
		var L_guildMedicChanges='Afficher plus d\'information à la Villa Medici';
		var L_foodBackColor= 'Mettre un fond rouge pour les consommables qui restaurent plus de points de vie que nécessaire (dans la vue générale)';
		var L_packageAlertOpt='M\'informer si mes paquets vont expirer (12 heures à l\'avance environ)';
	}else{
		//Shurtcut Buttons
		var L_guildMailTitle='Write guild message';
		var L_guildMedicTitle='Go to guild\'s medic center';
		var L_guildMarketTitle='Go to guild\'s market';
		var L_guildStorageTitle='Go to guild\'s storage';
		var L_staticsTitle='My stats';
		//Alerts
		var L_sure='Are you sure ?';
		var L_weaponAlert='You are <font color="red">not</font> wearing a weapon<font color="red">!</font>';
		var L_newMail='You have a <font color="yellow">new</font> message at forum<font color="yellow">!</font>';
		var L_Full='Full';
		var L_New='NEW';
		var L_newsAlert='These is a <font color="yellow">new</font> message at GCA News<font color="yellow">!</font>';
		var L_PackagesWillExpire='Packages will soonly expire';
		var L_hours='hours';
		//Change Image
		var L_changePlayerImage='Change player\'s image';
		var L_Overfloated='Overfloated';
		var L_plImageWillBeLost='Player\'s image will be lost and will not be saved';
		var L_plDecriptionWillBeCut='Player\'s description will be cut to fit';
		var L_defImages='Show Default Images';
		var L_imgMadeFrom='Images were made from';
		var L_changeGuildImage='Change Guild image';
		var L_gImageWillBeLost='Guild\'s image will be lost and will not be saved';
		var L_gDescrtipionWillBeCut='Guild\'s description will be cut to fit';
		//Training
		var L_spent='spent';
		var L_SimOfTraining = 'Training simulator';
		var L_Stat = 'Statistic';
		var L_From = 'From';
		var L_To = 'To';
		var L_Cost = 'Cost';
		var L_TrainingCampLevel = 'Training camp level';
		var L_Reduction ='Reduction:';
		var L_TotalCost = 'Total cost:';
		var L_Calculate = 'Calculate';
		var L_TotalCostTitle = 'Put my stats in the left column';
		var L_CalculateTitle = 'Calculate the cost of all the statistics';
		//Simulator
		var L_Simulator='Simulator';
		var L_arena='ARENA';
		var L_Battles='Battles';
		var L_Won='Won';
		var L_Lost='Lost';
		var L_Draws='Draws';
		var L_Damage='Damage';
		var L_myAvDamage='Your Average Damage';
		var L_hisAvDamage='Opponent\'s Average Damage';
		var L_Life='Life';
		var L_myRemLife='Your Remaining Life';
		var L_hisRemLife='Opponent\'s Remaining Life';
		var L_trainingSim='Training Simulator';
		var L_playerA='Player A';
		var L_playerB='Player B';
		var L_selectMethod='Selecy method';
		var L_selectEnemy='Select enemy';
		var L_byName='Player by name';
		var L_byID='Player by ID';
		var L_go='GO!';
		var L_winnigChance='Chance of winning';
		var L_PlayerAAvDamage='Player\'s A average damage';
		var L_PlayerBAvDamage='Player\'s B average damage';
		var L_Results='Results';
		var L_ClearAll='Clear All';
		var L_playerNotFound='Player not found';
		var L_searchData='Searching data...';
		var L_noStats='No stats for this';
		var L_thisIsLocation='This is a location';
		//Guild
		var L_StorageInfo='Storage Info';
		var L_itemNum='Number of Items';
		var L_TotalValue='Total value';
		var L_currentLife='Current life points';
		var L_lostLife='Lost life points';
		var L_healLife='Heal life points';
		var L_afterLife='Life after heal';
		//Auction
		var L_bidNum='Number of bids';
		var L_Items='Items';
		var L_selectItem='Select Item';
		var L_Type='Type';
		var L_selectType='Select Type';
		var L_Clear='Clear Input';
		var L_veryShort='Very Short';
		var L_anunGuild='Announce to guild';
		var L_MessageWasSent='Message was sent!';
		var L_minDamage='Minimum max-damage';
		var L_wearponsFound='Weapons found';
		var L_select='Select';
		//Online Players
		var L_OnlinePlayers='Online Players';
		var L_guildPlayers='Online Guild Players';
		var L_familyPlayers='Online Family Players';
		var L_noOnlinePlayer='No player online';
		var L_sentMessage='Send message';
		//Packages
		var L_gold='Gold';
		var L_Packages='Packages';
		var L_invItems='Inventory  items';
		var L_packedValue='Packed items\' value';
		var L_invValue='Inventory items\' value';
		var L_total='Total';
		var L_PackedGold='Packed gold';
		var L_totalGold='Total gained gold';
		var L_totalItemValue='Total item value';
		//Chat
		var L_checkAll='Check All';
		var L_Username='Username';
		var L_Country='Country';
		var L_GuildChat='Guild Chat';
		var L_CountryChat='Country Chat';
		var L_GlobalChat='Global Chat';
		//Other
		var L_ID='Player\'s ID';
		var L_ratioTitle='Food Ratio | Price Ratio';
		var L_addAll='+ All';
		var L_noGuildText='You dont have a Guild.<br>If you have one please go <a href='+GCAO_siteurl+'mod=guild&sh='+GCAO_secureCode+' >here</a> in order your stats be updated';
		//Settings
		var L_GCASettings='Gladiatus Crazy Add On Settings';
		var L_HeaderSettings='Header Settings';
		var L_DisplayLife='Display life bar on header';
		var L_DisplayLifePercent='Display both life points and life percent (no mouseover)';
		var L_DisplayLinkButtons='Display link buttons on the header';
		var L_DisplayAuctionStatus='Display auction status on the header';
		var L_DisplayMerchantStatus='Add the merchant\'s auction status on the header';
		var L_DisplayOnlinePlayersButton='Display the "Online Players" button on the header';
		var L_DisplayLinkBox='Display the Link Box at the right of the page';
		var L_TimersSettings='Timers Settings';
		var L_DisplayLastBeingAttacked='Display the time passed from the last attack you took in Arena';
		var L_DisplayLastBeingAttacked2='Display the time passed from the last attack you took in Circus Turma';
		var L_AuctionSettings='Auction Settings';
		var L_FillAuctionPrices='Auto fill prices at auction';
		var L_ChangeItemsBgColor='Change the items\' background (based on quality) at auction';
		var L_AuctionMoreItemsLavels='More item levels at auction search box';
		var L_DisplayItemNumAndBids='Display the number of items and number of bids at auction';
		var L_DisplayItemList='Display an item list at auction\'s and market\'s search box';
		var L_ExpandAuctionTable3='Expand the auction table (3 items in every row)';
		var L_SimulatorSettings='Simulator Settings';
		var L_enSimulator='Enable PvP simulator on every player\'s profil';
		var L_setFightNum='Set number of simulated fights';
		var L_maximum='maximum';
		var L_guildSettings='Guild & Market Settings';
		var L_guildStoreInfo='Display info box at guild\'s storage';
		var L_moreGuildStats='Display more stats at guild\'s war camp for the first 15 opponent guilds';
		var L_monsterSimulator='Display the training simulator at guild\'s training building';
		var L_gmailChanges='Enable guild mail changes';
		var L_ratioOpt='Display the "Ratio" value (food and price) of every item in the market';
		var L_enPriceRatio='Enable the price "Ratio" value (it is not very accurate)';
		var L_alertSettings='Alert Settings';
		var L_immedBuy='Display a confirmation box when you immediately buy an item from auction';
		var L_reduceTimeEx='Display a confirmation box when you pay a ruby to make an expedition';
		var L_questOpt='Inform me if i have a new quest available or display the remaining time';
		var L_forumMessageOpt='Inform me if i have a new forum message (with a [ ! ] next to forum link)';
		var L_weaponAlertOpt='Inform me if i do not wear a weapon (with a [ ! ] next to overview link)';
		var L_otherSettings='Other Settings';
		var L_msgchangesOpt='Enable message changes';
		var L_enBBCODE='Enable the BBCODE at messages';
		var L_enChat='Enable Chat (Guild, Country and Global)';
		var L_enRememberTabs='Remember your inventory\'s and merchant\'s tabs';
		var L_enImages='Enable custom player/guild image system';
		var L_disPackageCounters='Display the package counters';
		var L_disID='Display the ID of every player under his stats';
		var L_disHeal='Display the HEAL stat of every player under his stats';
		var L_disTrainingChages='Display basics and stat\'s maximum change when training';
		var L_enHighlight='Highlight items you can buy at merchants';
		var L_enStyleFixes='Apply style fixes';
		var L_speedSettings='Speed Settings';
		var L_stopPulling='Stop pulling info when the page loads (option for slow connections)';
		var L_willStop='This option will <font color="red"><b>stop</b></font>';
		var L_customCursor='Choose a custom cursor';
		var L_Save='Save';
		var L_AboutUs='About Us';
		var L_Settings='Settings';
		var L_donateTitle='Donate to Gladiatus Crazy Add On';
		var L_donateText='Thank us and also help us by donating some money in our PayPal account. By donating to our account you help us continue working on this add on which means more updates, new features and no bugs! Click the button to support us ';
		var L_description='Gladiatus Crazy Add On is a free add on that helps you with Gladiatus through the many features it gives. It actually uses better the info that the game server gives to your browser. Have fun with it and enjoy your fights!';
		var L_aboutTitle='About Gladiatus Crazy Add On';
		var L_descriptionTitle='Description';
		var L_Programmers='Programmers';
		var L_Translators='Translators';
		var L_Hostpage='Hostpage';
		var L_ContactUs='ContactUs';
		var L_Contact1='by e-mail at Apo59m@gmail.com or GreatApo@gmail.com';
		var L_Contact2='with message at our players in the greek servers (GreatApo at s1 and DarkThanos at s2) or french server (djor at s?)';
		var L_Contact3='or from the 3 open topics at the <a href="http://board.gladiatus.gr/index.php?page=Thread&threadID=12835" target="_blank">Greek</a>, <a target="_blank" href="http://board.gladiatus.fr/index.php?page=Thread&amp;threadID=37368">French</a> and <a target="_blank" href="http://board.gladiatus.us/index.php?page=Thread&amp;threadID=15543">USA</a> forum';
		var L_thanksTo='Many thanks to';
		var L_MonsterHunters='Monster stats/name hunters';
		var L_ItemHunters='Item hunters';
		var L_HideGoldInAuction='Color/Highlight the input if I can sell the item to the merchant at the same price than the bid';
		var L_guildSafeChanges='Enable guild safe changes';
		var L_guildMedicChanges='Show more info at the Medic center';
		var L_foodBackColor='Red background for the food items that gives more life points that needed (at overview)';
		var L_packageAlertOpt='Inform me if my packages are going to expire (12 hours before)';
	}
}
//################################################################################################################################
//## START (everything runs from here) / ???? (ap? ed? t?????? ??a)
//################################################################################################################################
if(document.getElementById('icon_rubies')){
	try{Main();}catch(e){DE(e);}
}
else if(document.getElementById('p8_1_1') && document.getElementById('char_leben')){otherPlayerImage();}

function Main(){
	if(GCAO_mod=='settings'){
		if(document.location.href.match(/GCAO=SaveMePlease/i)){c(saveSettings());}
		c(PlayerImageSave());
		c(settings());
		document.getElementById("saveGCAOstats").addEventListener("click", saveMePlease, false);
	}
	if(document.getElementById('banner_top') && document.getElementById('banner_event') && (document.getElementById('banner_top').style.display=='' || document.getElementById('banner_top').style.display=='block')){c(moveAdd());}
	if(GM_getValue('lb', true) == true && GM_getValue('sp', false) == false){c(HealthBar());}
	if(GM_getValue('bu', true) == true){c(Buttons());}
	if(GM_getValue('au', true) == true){c(AuctionStatus());}
	if(GM_getValue('sp', true) == true){c(GetOverviewStats());}
	if(GM_getValue('ch', true) == true){c(Chat());}
	if(GM_getValue('pi', true) == true){c(RedirectPlayerImage());}
	if(GM_getValue('op', true) == true){
		c(onlineGuildmates());
		document.getElementById("wio").addEventListener("click", ShowOnlineBox, false);
	}
	if(GM_getValue('pa', false) == true){c(expiredPackages(12));}
	if(GM_getValue('fm', false) == true && GM_getValue('sp', false) == false){c(newForumMessage());}
	if(GM_getValue('nq', false) == true && GM_getValue('sp', false) == false && GCAO_mod!='quests'){c(newQuest());}
	
	if(GCAO_mod=='training'){
		if(GM_getValue('ba', true) == true){
			c(basikes());
			c(addTrainingCostSimulator());
		}
	}
	else if(GCAO_mod=='overview'){
		if(GCAO_submod=='stats'){c(morePlayerStats());}
		if(GCAO_submod=='noSubmod'){
			if(GM_getValue('dh', false) == true && document.getElementById('char_healing_tt')){document.getElementById('char_healing_tt').style.display="block";}
			if(GM_getValue('lp', true) == true){c(canIeatThis());}
		}
	}
	else if(GCAO_mod=='player'){
		if(GCAO_submod=='stats'){c(morePlayerStats());}
		else if(GCAO_submod=='noSubmod' && !document.location.href.match(/&doll=[2-6]/i)){
			if(GM_getValue('si', true) == true && GM_getValue('sp', false) == false){c(simulator());}
			if(GM_getValue('id', false) == true){c(showId());}
			if(GM_getValue('dh', false) == true){if(document.getElementById('char_healing_tt')){document.getElementById('char_healing_tt').style.display="block";}}
		}
	}
	else if(GCAO_mod=='messages'){
		if(GCAO_submod=='messageShow' || GCAO_submod=='messageMoveDelete'){
			if(GM_getValue('ms', true) == true){
				c(messages());
				c(msgButtons());
			}
		}else if(GCAO_submod=='messageNew'){
			if(document.getElementById('message')){location.href="javascript:document.getElementById('message').setCaretPosition(0);void(0);"}
		}
	}
	else if(GCAO_mod=='auction'){
		if(GM_getValue('cb', true) == true){c(auctionbgcolor());}
		if(GM_getValue('an', true) == true){c(auctionnumbers());}
		if(GM_getValue('ml', true) == true){c(auctionitemlevel());}
		if(GM_getValue('af', true) == true){c(autoFillAuctionFields());}
		if(GM_getValue('ca', true) == true){c(confirmRubies());}
		if(GM_getValue('ea', false) == true){c(auctionExtendTable());}
		if(GM_getValue('dv', true) == true){c(detailView());}
		if(GM_getValue('hg', true) == true){c(howToHideGoldInAuctions());}
		if(GM_getValue('il', true) == true){c(itemList());}
	}
	else if(GCAO_mod=='market'){
		if(GM_getValue('il', true) == true){c(itemList());}
		if(GM_getValue('pr', true) == true){c(priceRatio());}
	}
	else if(GCAO_mod=='inventory'){
		if(GM_getValue('hi', true) == true){c(afford());c(reAfford());}
	}
	else if(GCAO_mod=='packages'){
		if(GM_getValue('dc', true) == true){c(packetCounters());}
	}
	else if(GCAO_mod=='guild_main'){
		if(GCAO_submod=='admin_mail' && GM_getValue('mc', true) == true){c(guildMailChanges());}
		else if(GCAO_submod=='memberlist'){c(saveGuildmatesIDs());}
		else if(GCAO_submod=='noSubmod' && GM_getValue('pi', true) == true){c(guildImage());}
	}
	else if(GCAO_mod=='guild_storage'){
		if(GM_getValue('st', true) == true){c(storageInfo());c(resetStorageInfo());}
	}
	else if(GCAO_mod=='guild'){
		if(GCAO_submod=='adminDescription' || GCAO_submod=='adminDescriptionEdit'){c(GuildImageSave());}
		else if(GCAO_submod=='noSubmod'){c(guildNameTake());}
	}
	else if(GCAO_mod=='guild_warcamp'){
		if(GCAO_submod=='guild_member_reports') c(warCampMemberGold());
		else if(GCAO_submod=='guild_combatreports' && GCAO_allresult.match(/gcid=\d+/i) && GM_getValue('pi', true) == true){c(reportGuildImage());}
		else if(GCAO_submod=='noSubmod' && GM_getValue('gg', true) == true){c(guildWarMoreStats());}
	}
	else if(GCAO_mod=='guild_training'){
		if(GM_getValue('gs', true) == true){c(training());}
	}
	else if(GCAO_mod=='guild_market'){
		if(GM_getValue('pr', true) == true){c(priceRatio());}
	}
	else if(GCAO_mod=='guild_safe' && GM_getValue('sc', true) == true){
		if(GCAO_submod=='noSubmod'){c(guildSafeEdit());}
		if(GCAO_submod=='guild_safe_log'){c(guildSafeLog());}
	}
	else if(GCAO_mod=='guild_bath'){
		c(GCAnews());
	}
	else if(GCAO_mod=='guild_medic' && GM_getValue('gm', true) == true){
		c(guildMedicBox());
	}
	else if(GCAO_mod=='location' && GM_getValue('ce', true) == true){c(expeditionConfirmRubies());}
	else if(GCAO_mod=='reports' && (GCAO_submod=='showDungeons' || GCAO_allresult.match('t=-1') || GCAO_allresult.match('showExpeditions'))){c(searchObjects());}
	if(GM_getValue('at', false) == true || GM_getValue('kt', false) == true){c(lastTimeAttackedCounter());}
	if(GM_getValue('fi', true) == true){c(styleFixes());}
	if(GM_getValue('li', true) == true){c(links());}
	if(GM_getValue('rt', true) == true){window.addEventListener('click', rememberTabs, true);}
	if(GM_getValue('cu', 0)!=0){c(changeTheCursor());}
	if(GM_getValue('dayChecked', 0)!=day.getDate()){c(checkForNews());}
	if(GM_getValue('ShowNewsAlert', false)==true){c(showNewsAlert());}
}

//################################################################################################################################
//## LIFE BAR / ????? ?O?S
//################################################################################################################################
function HealthBar(){
	var img_backbar = 'data:image/jpeg;base64,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';
	var loadingImage="data:image/gif;base64,R0lGODlhKQAGAPEBAAAAAP///////////yH+EUNyZWF0ZWQgd2l0aCBHSU1QACH5BAkPAAIAIf8LTkVUU0NBUEUyLjADAQAAACwAAAAAKQAGAAACK4Qvh2rJriCLINgA0sX65up11vRtZQiOIpdi03qqbcya7wzn+Hw/PeVjFAAAIfkECQ8AAwAsAAAAACkABgAAAiyEP4dqya6gCjQA2UC1aV9dfR5IfQ/JoWLYhSq2lq38qvXpzWlun37EMAEZBQAh+QQJDwADACwAAAAAKQAGAAACK4Q/h2rJrqAKNIBUrWwg3159HkiJ4WaW2Elabaox8LyWbx0/9z7qfiRDoQoAIfkECQ8AAwAsAAAAACkABgAAAi2EP4dqya6gCjSAVC2ul/X8cQC4UaEpNSNXWiv6anH3zK1B2nqdg15Ki/yGjAIAIfkECQ8AAwAsAAAAACkABgAAAiyEP4dqya6gCjSAVC2uF+T+eJxIdd9Wohpjjie5vm/4wW1qq2Bks1LjC4YYBQAh+QQJDwADACwAAAAAKQAGAAACKoQ/h2rJrqAKNIBULa4X5P5JR+hxGwWaJSoa5KvCLOPG9ixrNN32/M8oAAAh+QQJDwADACwAAAAAKQAGAAACLIQ/h2rJrqAKNIBULa4X5P54nEh131aiGmOOJ7m+b/jBbWqrYGSzUuMLhhgFACH5BAkPAAMALAAAAAApAAYAAAIthD+HasmuoAo0gFQtrpf1/HEAuFGhKTUjV1or+mpx98ytQdp6nYNeSov8howCACH5BAkPAAMALAAAAAApAAYAAAIrhD+HasmuoAo0gFStbCDfXn0eSInhZpbYSVptqjHwvJZvHT/3Pup+JEOhCgAh+QQJDwADACwAAAAAKQAGAAACLIQ/h2rJrqAKNADZQLVpX119Hkh9D8mhYtiFKraWrfyq9enNaW6ffsQwARkFADs%3D";
	
	var BgImageFix = document.createElement('img');
	BgImageFix.setAttribute('id', 'BgImageFix');
	BgImageFix.setAttribute('src', img_backbar);
	BgImageFix.setAttribute('style', 'position:absolute;z-index:1;top:84px;left:335px;');
	document.getElementById('header_values_ressources').setAttribute('style', 'z-index:10;');
	document.getElementById('header_values_general').setAttribute('style', 'z-index:10;');
	document.getElementById('header_game').appendChild(BgImageFix);
	var HealthBarDiv = document.createElement('div');
	HealthBarDiv.setAttribute('id', 'HealthBarDiv');
	HealthBarDiv.innerHTML='<div style="left:0px;top:58px;cursor:pointer;" class="cooldown_bar"><div id="cooldown_bar_fill_life" class="cooldown_bar_fill cooldown_bar_fill_progress" style="width: 100%;"></div><div id="cooldown_bar_text_life" class="cooldown_bar_text"><img style="margin-top:6px;margin-left:2px;opacity:0.5;" src="'+loadingImage+'"/></div></div>'
	document.getElementById('header_values_ressources').appendChild(HealthBarDiv);
}

//################################################################################################################################
//## BUTTONS / ???????
//################################################################################################################################
function Buttons(){
	var ph1a='data:image/jpeg;base64,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%3D';
	var ph1b='data:image/jpeg;base64,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';
	var ph1c='index.php?mod=guild_main&submod=admin_mail&sh='+GCAO_secureCode;
	var ph2a='data:image/jpeg;base64,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%3D%3D';
	var ph2b='data:image/jpeg;base64,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%3D%3D';
	var ph2c='index.php?mod=guild_medic&sh='+GCAO_secureCode;
	var ph3a='data:image/jpeg;base64,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';
	var ph3b='data:image/jpeg;base64,/9j/4AAQSkZJRgABAgEASABIAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCAAZABkDAREAAhEBAxEB/8QAGgAAAgIDAAAAAAAAAAAAAAAABQkHCAQGCv/EADYQAAEEAgEBAwQTAAAAAAAAAAUCAwQGAQcIABITFBEVJHYWIzEzNkJUVmJzkpSWsrO209Tj/8QAHQEAAQQCAwAAAAAAAAAAAAAABgIEBQcACAEDCf/EADoRAAICAQMCAgQIDwAAAAAAAAECAwQFBhESABMUIRU1UWEIIjFUorHR8BYjJTNDU3JzgZGSk6HS4f/aAAwDAQACEQMRAD8AbBr+Lq0VRtJhWtK8eSUwzpXVhw+Ws2oKZYbVKLmamxIITSMqXAyqVN8RIaK4W52Er7eMIyrPueYestZamo6kapQKCNCA78hxUkKVBO42PxgwJ2OxHtG+ydLE+Kx6M24WT82xB4sPIgqSx5Dl8nED2A+ZHWbHvvGB9rvV0jih4OMlS3jyuMFRTSmk4T7c+7ffNuKUlpvyJacfWf7rD3o+V+Jx3fQ1Nr/PJbFBrdNcgSqLjzcq+kDI45Igod3xZkZSGVBCWKncDY79d8uBikU2krWfChDytiKVqw4u6MfEce2AjDblz2B2UEk9SUHD6QnWalhCGo+LkwNen1w6+Trmktaw3SbC66SOwlhy0RqXH7RDyQCQUlFdcbdcHuZRnKcoyuRx2sdTz5KnWcGMpZ2YSDgRKT21iZW2IlZ0KhDs/IcQp2I6RLhYpaxaE7xhi7EEsFU7cW3G4CEBSGJAB328wAOd/wAPX/m1WvwdRP6PVj/hTqf3fR6aejYP18P90f7dMTdOAhV+49kbxEhktT13XnCknuAQXEzDoaPrRIUZKtM4kBgiy75mMOHD45soOgjZSSkAMqDPiujJM9t0Ny9atY1jmYLk8lRLdh0htQuyzQNfxtUbxnf9D3JBEq7OOXFHMxidSPw9yfSddceivJ2R2eXEGQqd+MkpeOOMciu0jvGsIJkl/F79Opt7tNMAZmw63yN14qlpjrkR5wzYeuhVYeGxlsp87YsLVshxxqMocU/Ljvy8ORHGcw3csuLU31oKvwYtR6byEd/L4bTOs8vTyNvIW9Ux6W0NjJsy7XZbtXLQ1cfatlLjwzxOj1ZrFyS1Cs7O1uXiDuhrTFRUU0/c0paq5OWMIlp4M8+Rq2TufBCo2PYWBA8S11dI0jkjlL7Mo36oTdFU+sct9OVqgS35Gv7RI1VuGpOKEPgR+Dl9GbZp9j9jQmVDHODqlYTGtSV9hR8xXY84reSZoJOfrBiuJjbl6Fibtae8THKj1LmKxTmZp5LMslLGYieeSeS28k0kkd65dqI/LsGtUrJApiRHcDh70cGfiaKKOWBpWkgjeOaCqbFqw8dNHrsYDJWrrXE0YPcglkeCysdqN4kSV2sfS+yn+Pq590938v8AnQxu3sT6X29W9uFM3aUL1whUtObMt9UMcfeO4aOQE0ombAEo47UFaiFB6ZaBrkMkuPLnyoM2LGdnpdWvLeceRS0rDdT0LN/PmatWtxOTExJK+bQxRwpt8QMrKIUbkGBDqx8l3XqwcDLUj07VrG3XkjhDRjmu7FWAB7p34svkeQVVBJIG68h1o9XG8z9d5gMUbTu5hDYfMZNaklOONEvhyptQk5TDi1O5bN1TbrzXxsPOFZgixljjioLSvBQYscc21Bbg9RacGrNO5bSmo8bZyGDztM4/M16+Ry2Ds38fJL3JaMmR07dw9+KnbTnVvV69iGPI0JrNDILZp2rMEz9bmM5wMcrU4QENHD6YRYi/FF5ywLCYJ32ijdZLEc88ciqyz8o4ykiaiqnJElvrUdqvGpN+Pzl7koxy+X65VC1LeehwWsAllLFZyQ99uOKBge4HQWHn4gmuiY44aMiRBMeKPac4XASY63h6WOxKY7GY40oMVisfBDUxmMqUE7dWjQpQRpDWpwxLHGkMaqFjRFUhUJHF+fFzY++8VqigdD3TWlSUSSszSSuzRpGqu7O0roioqvIzgKJDvTb0/wCSkPuf+nVkejcj80m/qH2dAX5O+fJ/joD8eP6r0v8Aa9P6dZr119/d0jC+pfv7+jjPvGPrFflT1HH5f4L9Q6V0XrnwhqPrSO/VY6c4/wBY0v3h+odZZ9V3v2R9Q6Wl0fdA/X//2Q%3D%3D';
	var ph3c='index.php?mod=guild_market&sh='+GCAO_secureCode;
	var ph4a='data:image/jpeg;base64,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%3D';
	var ph4b='data:image/jpeg;base64,/9j/4AAQSkZJRgABAgEASABIAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCAAZABkDAREAAhEBAxEB/8QAGQABAAMBAQAAAAAAAAAAAAAACQUHCAYK/8QANRAAAQUBAAEBAwURAAAAAAAABAECAwUGBwgAEhMUERUWInYkMzZCVFZic5KUlrKzttPU4//EABwBAAICAgMAAAAAAAAAAAAAAAYIBAkCBwADBf/EADoRAAICAQIEAgUGDwAAAAAAAAIDAQQFBhIABxETFCEVMTVhsSIjVKLR8AgWJCVRU3JzgZGSk6HS4f/aAAwDAQACEQMRAD8AVbEDc+rcTwXK0HBvHfT6nZ8o457Ump5TirTS2+v1+dEjWW4tzq2ZGyvPNgtpjJo1YyJXOY2V6NYtfOOHV+suaGO0dibaqFd5OsZHJGMuDH46lXm3ds9oSEnNVWAjSrcEsYSwIwEpON2akyFfTWj7WetKJ8LlKaVfd2ht3LbgRUTDS3wAMewdzICe2G6YiZjbN+dE4/z7BW9bRV2O8WNvryw4ny0I/ivy+uyhFk2NHTVFHZJ7V2McW9UDBs7qYwGwMQVk1ZQxETkCOhH4PWCzGlbr6FzU2DyldbvA5TJ5Snclrts9h2VxasQhUUd0bnIx7V2qqTIotZA1gtyy2Oc+bpahSt44bLVGyqLdKhRs1RSvrO9dC43IOcVqILaD7QmhzBCPD1AMjDms0BxG6u8HW2XGfGhtT0F3w9HNXcH55SWszJM3ZXg4wxCDzKEfNK0MuvIb9dhlYRG5qK1EdX1czGs8Lqy1pnKACchg81cxd4IKCAb1OwdNihKem6SeghXHkReW0Z9XDbUa1HOYShl8YcsoZCrXyCGTE9fD2lLckyjzgIlZBMzMxEF1j1xER56fh8/+bWa/g7Cf6Poy/GnU/u+rx2ejUfr0/wB2P9uE4zpOqn6PxETDtmn1w3FfExMnVqkiD/SUzHjLVxTsa1IfYKaHGp88axowUZJXI1WqryjlM/K0+fdaxjqqbITctnlReRAtenrmFTOaYTPPtjUqm068wJT3JBXzpGPQa5sV8fY5OW1XHsRJRSjDGqNzn5obiixySiJiDA37e4PyZBMsYcwMboQHZ4a+5rs22emPAKJdYjywHi2cdj7gxrkfFNFDLGx88VWX8soMDnRtIfBChLmxSSK20rH3B1Jj+lMCRXhJlK2pJREE9Y7U7SIYlw9BaXXqAEe2N3TpXo9Q4ezENIH2JZEAamQYAe6Jk43Du7a56yoPUUxHWZiekZsrp5s517x4wxhEBI9FtqFmWtxWrHHoKqXPaeuqzpY3veopkSgWdbc16vm9xZDtmic0Q6ve+sfnrywyWiuaU6ksvO/iNdamtZdFsgWDa2XbdG7k8W8VxAfk5XlPpvABVZpvXER361oVvtyS1nR1FoRuIQkKuT0risfjbNbcbFPoCua+PyCN07/nYqsRZWUzKXpLz2OrEQ1e0n6X7Lf8foL6h7v5f84NepfoD6328IFkT+6867Jy3rOF4d0nf0VVwzx8DrCarI3J9MdENxfP1NtHW24ldJA+4qiLYyKGQOSxSCwSN3u1+s1xNoTWi9EcyTzNvB2r+LylKMTlgCFzcRTPwozZoQcLAnr8IqWJYwAsq7yZYnfBhG1tooNc8uKuFo5pFLI4qzGQxTXborOtLUxQoyJLgy7DBYcd1S5JDtjhWyAkJ0dsN70noV2Da3PN+81AMDHG/M5XEujk27yEY5YxI5waMikc9r1crZSLQONysYsiQucjUsexPObk/XwU2aer8Ws3IkzRZC9UtJHZJkDKD6Q3Zd8mQFKEWe4UbUsdvEjQC7yq5nemYqW9M2HClwjD6uQxVqm4imBWQXFXvDQueu6WOakVD5uhciYjSMZHbNt5B+PssPBe1Z3B8/6tny3397gdJWRw11wYOzS3+ktZqtQa4OMUcNvwssvwVHHCjmFnvONKOSLn3zbDmNmMNpzTOPY/TeJzNTMxmHVWV7ORylRN+ukayrAjYr4tKMg6JF6kWbrihzlpXXrqS5HJPlPOiMTltRahydZefyePZjpxVO6i3Vx1JrqdhgWW1TbXfkWMo1yIkPaiqqJBLTmxYaw3fu/8lsP3P/p6036NyP0R39UfZxtL83fTg/xxA/jj/ZfF/wBr4/1KzXtr7+7jDC+xfv7+JyH7wn6x38rfXnT6/wCA/COMuJfOfhDkftTXf1YPUnH+0aX7yfhHHLPsu9+zHwjg0vR9wD8f/9k%3D';
	var ph6a='data:image/jpeg;base64,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%3D%3D';
	var ph6b='data:image/jpeg;base64,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';
	var ph6c='index.php?mod=guild_storage&sh='+GCAO_secureCode;
	
	var ph5a='http://i617.photobucket.com/albums/tt260/goldisever/Apo/button.jpg';
	var ph5b='http://i617.photobucket.com/albums/tt260/goldisever/Apo/button_hover.jpg';
	var ph5c='index.php?mod=guild_main&submod=admin_mail&sh='+GCAO_secureCode;
	
	var ButtonsDiv = document.createElement('div');
	ButtonsDiv.setAttribute('id', 'ButtonsDiv');
	ButtonsDiv.setAttribute('style', 'position:absolute;z-index:501;top:117px;left:520px;');
	ButtonsDiv.innerHTML="<div style=\"display:none;\"><img src=\""+ph1b+"\"><img src=\""+ph2b+"\"><img src=\""+ph3b+"\"><img src=\""+ph4b+"\"><img src=\""+ph5b+"\"></div>";
	ButtonsDiv.innerHTML+="<table cellspacing=\"0\" cellpadding=\"0\" style=\"border-spacing:0px;border:0px;\"><tr>" +
	"<td><a href=\""+ph1c+"\"><img style=\"cursor:pointer;\" title=\""+L_guildMailTitle+"\" src=\""+ph1a+"\" onmouseover=\"this.src='"+ph1b+"'\" onmouseout=\"this.src='"+ph1a+"'\"/></a></td><td><div style=\"width:2px;\"></div></td>" +
	"<td><a href=\""+ph2c+"\"><img style=\"cursor:pointer;\" title=\""+L_guildMedicTitle+"\" src=\""+ph2a+"\" onmouseover=\"this.src='"+ph2b+"'\" onmouseout=\"this.src='"+ph2a+"'\"/></a></td><td><div style=\"width:2px;\"></div></td>" +
	"<td><a href=\""+ph3c+"\"><img style=\"cursor:pointer;\" title=\""+L_guildMarketTitle+"\" src=\""+ph3a+"\" onmouseover=\"this.src='"+ph3b+"'\" onmouseout=\"this.src='"+ph3a+"'\"/></a></td><td><div style=\"width:2px;\"></div></td>" +
	"<td><a href=\""+ph6c+"\"><img style=\"cursor:pointer;\" title=\""+L_guildStorageTitle+"\" src=\""+ph6a+"\" onmouseover=\"this.src='"+ph6b+"'\" onmouseout=\"this.src='"+ph6a+"'\"/></a></td><td><div style=\"width:2px;\"></div></td>" +
	"<td id='CaracterStats' title='"+L_staticsTitle+"'><a title=\"\" onclick=\"if(document.getElementById('StatsDiv').style.display=='block'){document.getElementById('StatsDiv').style.display='none'}else{document.getElementById('StatsDiv').style.display='block'}\"><img style=\"cursor:pointer;\" src=\""+ph4a+"\" onmouseover=\"this.src='"+ph4b+"'\" onmouseout=\"this.src='"+ph4a+"'\"/></a></td><td><div style=\"width:2px;\"></div></td>" +
	"<td></td>" +
	"</tr></table>";
	document.getElementById('header_game').appendChild(ButtonsDiv);
	if(GM_getValue('sp', true) == false){document.getElementById('CaracterStats').style.display='none';}
	
	var text='';
	for (x=1;x<=7;x++){
		text += "<tr><td id=\"Tran"+x+"\" class=\"Stats_Tran\"></td><td><div style=\"width:10px;\"></div></td><td> : </td><td><div style=\"width:10px;\"></div></td><td id=\"st_"+x+"\" class=\"Stats_Stat\"></td></tr>";
	}
	
	var StatsDiv = document.createElement('div');
	StatsDiv.setAttribute('id', 'StatsDiv');
	StatsDiv.setAttribute('style', 'display:none;opacity:0.8;position:absolute;z-index:501;top:148px;left:622px;border:1px solid #c0c0c0;background-color:#000000;color:#ffffff;padding:5px;');
	StatsDiv.innerHTML="<style>.Stats_Tran{text-align:left;font-weight:bold;}.Stats_Stat{text-align:right;}</style>" +
	"<div style=\"float:right;border:1px solid grey;background-color:#ffffff;color:#000000;width:15px;height:15px;line-height:13px;margin-top:-12px;margin-right:-12px;cursor:pointer;\" onclick=\"document.getElementById('StatsDiv').style.display='none'\"><center><b>x</b></center></div>" +
	"<table cellspacing=\"0\" cellpadding=\"0\" style=\"width:100%;border-spacing:0px;border:0px;\">" +
	"<tr><td id=\"TranLIFE\" class=\"Stats_Tran\"></td><td><div style=\"width:10px;\"></div></td><td> : </td><td><div style=\"width:10px;\"></div></td><td id=\"st_LIFE\" class=\"Stats_Stat\"></td></tr>" +
	"<tr><td id=\"TranLEVEL\" class=\"Stats_Tran\"></td><td><div style=\"width:10px;\"></div></td><td> : </td><td><div style=\"width:10px;\"></div></td><td id=\"st_LEVEL\" class=\"Stats_Stat\"></td></tr>" +
	text+
	"<tr><td id=\"TranARMOR\" class=\"Stats_Tran\"></td><td><div style=\"width:10px;\"></div></td><td> : </td><td><div style=\"width:10px;\"></div></td><td id=\"st_ARMOR\" class=\"Stats_Stat\"></td></tr>" +
	"<tr><td id=\"TranDAMAGE\" class=\"Stats_Tran\"></td><td><div style=\"width:10px;\"></div></td><td> : </td><td><div style=\"width:10px;\"></div></td><td id=\"st_DAMAGE\" class=\"Stats_Stat\"></td></tr>" +
	"</table>";
	document.getElementById('header_game').appendChild(StatsDiv);
}

//################################################################################################################################
//## AUCTION STATUS / ????S??S? ?????????????
//################################################################################################################################
function AuctionStatus(){
	var loadingImage="data:image/gif;base64,R0lGODlhKQAGAPEBAAAAAP///////////yH+EUNyZWF0ZWQgd2l0aCBHSU1QACH5BAkPAAIAIf8LTkVUU0NBUEUyLjADAQAAACwAAAAAKQAGAAACK4Qvh2rJriCLINgA0sX65up11vRtZQiOIpdi03qqbcya7wzn+Hw/PeVjFAAAIfkECQ8AAwAsAAAAACkABgAAAiyEP4dqya6gCjQA2UC1aV9dfR5IfQ/JoWLYhSq2lq38qvXpzWlun37EMAEZBQAh+QQJDwADACwAAAAAKQAGAAACK4Q/h2rJrqAKNIBUrWwg3159HkiJ4WaW2Elabaox8LyWbx0/9z7qfiRDoQoAIfkECQ8AAwAsAAAAACkABgAAAi2EP4dqya6gCjSAVC2ul/X8cQC4UaEpNSNXWiv6anH3zK1B2nqdg15Ki/yGjAIAIfkECQ8AAwAsAAAAACkABgAAAiyEP4dqya6gCjSAVC2uF+T+eJxIdd9Wohpjjie5vm/4wW1qq2Bks1LjC4YYBQAh+QQJDwADACwAAAAAKQAGAAACKoQ/h2rJrqAKNIBULa4X5P5JR+hxGwWaJSoa5KvCLOPG9ixrNN32/M8oAAAh+QQJDwADACwAAAAAKQAGAAACLIQ/h2rJrqAKNIBULa4X5P54nEh131aiGmOOJ7m+b/jBbWqrYGSzUuMLhhgFACH5BAkPAAMALAAAAAApAAYAAAIthD+HasmuoAo0gFQtrpf1/HEAuFGhKTUjV1or+mpx98ytQdp6nYNeSov8howCACH5BAkPAAMALAAAAAApAAYAAAIrhD+HasmuoAo0gFStbCDfXn0eSInhZpbYSVptqjHwvJZvHT/3Pup+JEOhCgAh+QQJDwADACwAAAAAKQAGAAACLIQ/h2rJrqAKNADZQLVpX119Hkh9D8mhYtiFKraWrfyq9enNaW6ffsQwARkFADs%3D";
	var img_left = 'data:image/png;base64,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%3D';
	var img_center = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAgEASABIAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCAAeAGwDASIAAhEBAxEB/8QAGwABAAMBAQEBAAAAAAAAAAAACAMEBQIGAQr/xAAyEAACAgECBgAFAgYCAwAAAAABAgMRBBIhAAUGBxMxFCJBQlEjMhUlYWJxgRYzkaGx/8QAGQEAAwEBAQAAAAAAAAAAAAAAAAECAwYH/8QAPREAAQIEAwIJBw0BAAAAAAAAAQIRAAMEIQUSMRRBExUkUWFxgZHTIjIzUlOCgwYWI0Nyc4Shs8HC0uHw/9oADAMBAAIRAxEAPwD8js8Hdp4yy9y+47yx0rLP1t1ITr3YSb8w3qMxqNgQo/1xRlwO7GQipk9wevJi3ynydYdSSQjzAKSCOYbMNINVQBG9kDhi5nLeSNGy4METykBKZtB2WiSrAAMADQ90CTsCOPGZHIxiZAjXO0llUjHWOOVYgSLLMAGUXQskqLBB3oeKysfWpLiRSIbThKKjzHnfk6SSOfKH1vHerw1Ob0k92uy3/jB6XlvdZESu5ncErVGM9ZdSRBY0pAqKOYboNNgn6k3xxLB3XhUqncTuIq3qjaPrfqQAMQN6/iF3Q/8AFeq4VuL0/DkLEJ8hVOkESY6My+xZerBP5UfTYKSDxN/xHFlmZcVviZhWpmimhlX7WoSqiCMKP3Xpsmidhwjj6wVFcmjKA78howN182zLt2dog4tcAZ5/Xmvv3NrBLjyO6615u5XcWZjSuh656khlB/In/iGwr0n0N+9XGkg7nfDu2P3J7lmcyKNM/WvVRhQGtdvFzmEu1bAkH0PQFBWL03j4Dy+eBWiVaWSMLkaLF6XWMuGIOoki9iAR9OM2TC5LJEYoo9cmtqjXHGOWI3JXWdRN3soGw2FcL5wBaTlpaIjnFJSEW/AwcWBLEzJz+qZjG/RleDIV7rWZH7odxEN6dcvW/VPqgdMfl5tOfHZJFOF1FqQEknh4u6oNr3N7hBmGq0636l1NZNMP5htdV/6PCXh5DyrKYI4YlPtmmWWJCbOnQSHDgAnSqkACxfzcac/LORY1Y82UquFAaJY5mCJ/cERtAsn91ewSd+IVjwCX4CWTYFMukpGHVyQ2H2Rruixh7nz5w+J/kE2VO7Ogl+5XcuRl3YSdb9SWEf8A6mF8w/ajo4Ao2XP+68c/dlADN3L7iSEbeN+tupFYqdl0TfxD9L8E/dsbGnhiZPIeQzYsK40SPKqhoZ4wWOsCwwZVIABJ3Yg7kGvfFfC6cgbJCJAZwF1SBkZZEkO0jsJQitGTop70gj2NQto+UPkEmlpgATeZR0gLW85Wwt2lntCVhbqH0k643LfT3YLgye7DwO0HcXuBG5CqIm6r5+wCWSScsZ3kkYA/LIzl69ODxDp7rn5n7ndxFKKPmbrfqvxR3diLy84nG9AOVCek1aqGlXZ3I8LFimE+MKvdooIQrneyZYpHBKhdmoe7F7cedg5XyfLIiqY2xqIyM6WPoYioZifYWIOSAxIAAoGOhXlCmpEpOq0UlKVH3tkvexumxOsLi8JOThJpP3l730aDg0fdQ0w7ndwCWunXrfqXU1ULH8w+l+x+b9cR+Pu/9vc7ujX9nXHUun8bfzAfjhYYvJuSPGYYMqEtGfGYY9S6Xb2hVgpEm1+OtZAJC0pPFsYPSuCBj5LRCZfmcMaYFifYIsHb0d/9cZqx/KSBTBTNcUtIxtu5ErTTUxYw1w/CTR8T/I8yMkNK8AeBxHEzRhmQSsCoYAazRehQ9t9R9ahiycYwxZiRPi5QV0rI1sJgrVoBI0aX3J0m/VAi+Dnkdy5W8ay4Zf4lQgOoWhC7MPn9gCrBB3O+/FdO4GXGHxZWyZlH6iAv8iCwtAea7Aav8Xv6rPi9IN5ssD1cyS/S7ftujTax7Cf3I/vCXj5tBjvqY/DOwGoaWfGZvppC7h/x9oANizxsYnUfMkZpI5YVijRijpjxoxugASKlr62+wIuqJ4MGN1lNOjzBZB8OoZY2+ZSTQskyk3ufp+d+IG7g5gU+OJo/Js5V33Is/s8tAEjej/QDc8I4fLIIC5JO4FSSD12vC2xQIKZU8AbsqPEhXjLzJMqWTI5gHV2MojswkkxKSFeM6gf8tuQSQT6w5eYiYK+QkkyxSsGkEkrzRblQHWRd0BNlwxJNCjqPB0g7gZLpqEcxeQUbkCgBasgkzb2B9oO5+YDYxydw8xVNwOQAIxqlD/XVdKkR+33qNegN7CGGJd80kNuSpIHc2v5RRrCq6pM8nqR4kI74nySPja4JFSJiiu0YkdSA4UCQ0z0NqtqsjbVUEOVjGCHMSF8TJAkULkiQiYRsF0AlfGFa9VK17bbXwc8juVK3jEuGX+IXQDqFoQuzfv8AwCNipN++K8fcHMiV8SZ8qZB+oilzoRbChQPNdgPQ/pf9OKOHpBvNlgermSX6Xb/mhbWPYT+5HiQlBzTGx5PKUGLJJs4VHfGLk3qCxuH1mv7lrVak0V2cPqHmMbvNHLEI0jOl1hVbBIAFE+QDeyXA9DUD9C3i9cZGRkrGqOqwwPkDXbj5SinSvmHzHyEA2Ni1neuOpO4OYmoRI6CRiHYO41EEm/H52Ubj2GutvqeA4fLIIC5RJ0BUlj12g2wggplTw27KjxIWAy8t8lnmz1IkBKxanhJLJqOgoQFYi9tzsT7JrBl5iJlQ5Mcs4gmP6xnnlmhU6kCESEr47IJI3sKB7I4OcHcDKePUscxeUUbkCABfZsmYXdfaD7+YCweJO4mWgJbHZgKQa5Q496twqw3ene2NVQG9iRhiXfNKF9ErQB3NBtj3VJnk87I8SEb8SJJXxi2NKscL+NZPEZSh0yaU8u2s1sV+f2Rtqr5itg5mPFNJy+ZHooRIJSx0Ow1ArBIuk/Smoeq/JuyO5cjeIS4JbzgKrLIwaNgppt5SDQsVQ2JFgHaovcbmWJcPnzCoYsgWQhVVtwgHnGy+v/m23FHDwPrpaejMk9r2gNUkj0NR2BD/AKkf/9k%3D';
	var img_right = 'data:image/png;base64,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';
	var AuctionStatusDiv = document.createElement('div');
	AuctionStatusDiv.setAttribute('id', 'AuctionStatusDiv');
	AuctionStatusDiv.setAttribute('style', 'position:absolute;z-index:10;top:114px;right:110px;');
	AuctionStatusDiv.innerHTML="<table cellspacing=\"0\" cellpadding=\"0\" style=\"border-spacing:0px;border:0px;\"><tr><td style=\"width:20px;height:30px;background: transparent url('"+img_left+"') no-repeat;\"></td><td style=\"height:30px;background: transparent url('"+img_center+"') repeat-x;\"><span id=\"AuctionStatus\" style=\"line-height:13px;\"><table style='font-size:11px;line-height:9px;'><tr><td id='A1'><img style=\"margin-top:6px;margin-left:2px;opacity:0.5;\" src=\""+loadingImage+"\"/></td></tr><tr><td id='A2'></td></tr></table></td><td style=\"width:20px;height:30px;background: transparent url('"+img_right+"') no-repeat;\"></td></tr></table>";
	document.getElementById('header_game').appendChild(AuctionStatusDiv);
	GM_xmlhttpRequest({
		method: "GET",
		url: GCAO_siteurl + 'mod=auction&sh=' + GCAO_secureCode + '&fl=160',
		onload: function(response){
			if(!response.responseText.match('bx0')){
				var AuctionTranslation = response.responseText.match('class="submenuitem_aktive" target="_self">([^<]+)</a>')[1];
				var Status = response.responseText.match('<span class="description_span_right"><b>(\.+)</b></span>')[1];
				document.getElementById('A1').innerHTML = AuctionTranslation + " : <b>" + Status + "</b>";
			}
		}
	});
	if(GM_getValue('sa', true) == true){
		GM_xmlhttpRequest({
			method: "GET",
			url: GCAO_siteurl + 'mod=auction&ttype=3&sh=' + GCAO_secureCode + '&fl=160',
			onload: function(response){
				if(!response.responseText.match('bx0')){
					var AuctionTranslation = response.responseText.match('class="pngfix  current" style="cursor:pointer;">([^<]+)</a></li></ul>')[1];
					var Status = response.responseText.match('<span class="description_span_right"><b>(\.+)</b></span>')[1];
					document.getElementById('A2').innerHTML=AuctionTranslation+" : <b>"+Status+"</b>";
				}
			}
		});
	}
}

//################################################################################################################################
//## ALL STATS FROM OVERVIEW / ??? ?? S????S???? ??? ??????S????S?
//################################################################################################################################
function GetOverviewStats(){
	GM_xmlhttpRequest({
		method: "GET",
		url: UrlOverview,
		onload: function(response){
			if(response.responseText.match(/playername.achievement.>([^<]+)<\/div>/i)){
				var playername=response.responseText.match(/playername.achievement.>([^<]+)<\/div>/i)[1];
				Set_Cookie('playerName',playername,1);
			}
			
			var life = response.responseText.match(/id\="char_leben" class\="charstats_value">(\d+) %<\/span>/i)[1]*1;
			var exactLife = response.responseText.match(/onmouseover="return escape\((.+)nowrap.'>(\d+) \/ (\d+)/i);
			var exactLifeA = exactLife[2];
			var exactLifeB = exactLife[3];
			var TranLife = response.responseText.match(/nowrap.'>([^:.<>]+):<\/td>/i)[1];
			
			if(document.getElementById('HealthBarDiv')){
				document.getElementById('cooldown_bar_fill_life').style.width=life+'%';
				if(GM_getValue('rb', false) == false){
					document.getElementById('cooldown_bar_text_life').innerHTML=TranLife+' : '+life+'%';
					document.getElementById('HealthBarDiv').setAttribute('onmouseout', "document.getElementById('cooldown_bar_text_life').innerHTML='"+TranLife+' : '+life+'%'+"';");
					document.getElementById('HealthBarDiv').setAttribute('onmouseover', "document.getElementById('cooldown_bar_text_life').innerHTML='"+exactLifeA+" / "+exactLifeB+"';");
				}else{
					document.getElementById('cooldown_bar_text_life').innerHTML=exactLifeA+' / '+exactLifeB+' ('+life+'%)';
				}
				document.getElementById('HealthBarDiv').setAttribute('title', TranLife);
			}
			
			var TranLevel = response.responseText.match('charstats_value21">([^<]+)</span>')[1];
			var Level = response.responseText.match('charstats_value22">([^<]+)</span>')[1];

			var TranStats = response.responseText.match(/charstats_text">([^<]+)<\/span>/gi);
			var Stats = response.responseText.match(/charstats_value">([^<]+)<\/span>/gi);
			var allstat = new Array();
			var allstat2 = new Array();
			
			if(document.getElementById('ButtonsDiv')){
				for (x=1;x<=7;x++){
					allstat2[x] = TranStats[x].match(/charstats_text">([^<]+)<\/span>/i)[1];
					allstat[x] = Stats[x].match(/charstats_value">([^<]+)<\/span>/i)[1];
					document.getElementById('Tran'+x).innerHTML=allstat2[x];document.getElementById('st_'+x).innerHTML=allstat[x];
				}
			}
			else{
				for (x=1;x<=7;x++){
					allstat2[x] = TranStats[x].match(/charstats_text">([^<]+)<\/span>/i)[1];
					allstat[x] = Stats[x].match(/charstats_value">([^<]+)<\/span>/i)[1];
				}
			}
			
			var TranStats2 = response.responseText.match(/charstats_value21">([^<]+)<\/span>/gi);
			var TranARMOR = TranStats2[1].match(/charstats_value21">([^<]+)<\/span>/i)[1];
			var TranDAMAGE = TranStats2[2].match(/charstats_value21">([^<]+)<\/span>/i)[1];
			
			var Stats2 = response.responseText.match(/charstats_value22">([^<]+)<\/span>/gi);
			var ARMOR = Stats2[1].match(/charstats_value22">([^<]+)<\/span>/i)[1];
			var DAMAGE = Stats2[2].match(/charstats_value22">([^<]+)<\/span>/i)[1];
			
			if(document.getElementById('ButtonsDiv')){
				document.getElementById('TranLIFE').innerHTML=TranLife;document.getElementById('st_LIFE').innerHTML=life+' %';
				document.getElementById('TranLEVEL').innerHTML=TranLevel;document.getElementById('st_LEVEL').innerHTML=Level;
				document.getElementById('TranARMOR').innerHTML=TranARMOR;document.getElementById('st_ARMOR').innerHTML=ARMOR;
				document.getElementById('TranDAMAGE').innerHTML=TranDAMAGE;document.getElementById('st_DAMAGE').innerHTML=DAMAGE;
			}
			
			var DamageMin=DAMAGE.match(/(\d+)...(\d+)/i)[1];
			var DamageMax=DAMAGE.match(/(\d+)...(\d+)/i)[2];
			
			var resistance=response.responseText.match(/\d+ %/gi)[2].match(/(\d+)/i)[1];
			var block=response.responseText.match(/\d+ %/gi)[3].match(/(\d+)/i)[1];
			var critDamage=response.responseText.match(/\d+ %/gi)[4].match(/(\d+)/i)[1];
			
			var ChanceOfAvoidCriticalHits=response.responseText.match(/>\d+ %/gi)[1].match(/(\d+)/i)[1];
			var ChanceToBlockAHit=response.responseText.match(/>\d+ %/gi)[2].match(/(\d+)/i)[1];
			var ChanceForCriticalDamage=response.responseText.match(/>\d+ %/gi)[3].match(/(\d+)/i)[1];
			
			var LifePointsLeft=exactLifeA;var Strength=allstat[2];var Skill=allstat[3];var Agility=allstat[4];var Constitution=allstat[5];var Charisma=allstat[6];var Armour=ARMOR;
			var code=''+
			"##"+Level+
			"##"+LifePointsLeft+
			"##"+Strength+
			"##"+Skill+
			"##"+Agility+
			"##"+Constitution+
			"##"+Charisma+
			"##"+Armour+
			"##"+DamageMin+
			"##"+DamageMax+
			"##"+ChanceOfAvoidCriticalHits+
			"##"+ChanceToBlockAHit+
			"##"+ChanceForCriticalDamage;
			
			//alert(code);
			Set_Cookie('simstats',code);
			
			if(response.responseText.match(/AddCharDiv..p3_1_1.[^"]+""/i) && GM_getValue('wd', false) == true){
				document.getElementById('mainmenu').getElementsByTagName('a')[0].innerHTML+=' <img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/exclamation.png" style="position:absolute;margin-left:10px;margin-top:1px;opacity: 0.65;" onmouseout="this.style.opacity=\'0.65\';document.getElementById(\'warningWeapon\').style.display=\'none\';" onmouseover="this.style.opacity=\'1\';document.getElementById(\'warningWeapon\').style.display=\'block\';">';
				var warningTip = document.createElement('div');
				warningTip.setAttribute('id', 'warningWeapon');
				warningTip.setAttribute('style', 'opacity: 0.75;display:none;width:180px;z-index:502;position:absolute;top:179px;left:345px;border:1px solid grey;background-color:black;color:#c0c0c0;font-weight:bold;height:24px;line-height:24px;padding-left:5px;padding-right:5px;')
				warningTip.innerHTML = L_weaponAlert;
				document.getElementById('header_game').appendChild(warningTip);
			}
		}
	});
}


//################################################################################################################################
//## PLAYER'S IMAGE / ????? ??????
//################################################################################################################################
function RedirectPlayerImage(){
	if(GCAO_mod=='overview' && GCAO_submod=='noSubmod' && (GCAO_allresult.match(/doll=[1-2]/i) || !GCAO_allresult.match(/doll/i))){
		myPlayerImage();}
	else if(GCAO_mod=='player' && GCAO_submod=='noSubmod' && GCAO_allresult.match(/p=/i) && (GCAO_allresult.match(/doll=2/i) || !GCAO_allresult.match(/doll/i))){
		otherPlayerImage();}
	else if(GCAO_mod=='reports' && GCAO_submod=='showArenaReport'){
		reportPlayerImage();}
	else if(GCAO_mod=='reports' && GCAO_submod=='showCombatReport' && GCAO_allresult.match(/t=[014]/i)){
		report0PlayerImage();}
	else if(GCAO_mod=='reports' && GCAO_submod=='showCombatReport' && GCAO_allresult.match(/t=3/i)){
		report3PlayerImage();}
}

function myPlayerImage(){
	if(GM_getValue('PlayerImage' + window.location.host, '')!=''){
		var img_Player=GM_getValue('PlayerImage' + window.location.host, '');
		document.getElementById('p8_1_1').parentNode.setAttribute('id','PlayerImage');
		document.getElementById('PlayerImage').setAttribute('style','width: 168px; height: 194px; margin-left: auto; margin-right: auto;background-image:url(\''+img_Player+'\');background-repeat:no-repeat;-moz-background-size: 100% 100%;-o-background-size: 100% 100%;-webkit-background-size: 100% 100%;background-size: 100% 100%;');
	}
}

function otherPlayerImage(){
	if(document.getElementById('content').innerHTML.match(/##GTI=/i)){
		var img_Player=document.getElementById('content').innerHTML.match(/##GTI=([^#]+)##/i)[1];
		document.getElementById('p8_1_1').parentNode.setAttribute('id','PlayerImage');
		document.getElementById('PlayerImage').setAttribute('style','width: 168px; height: 194px; margin-left: auto; margin-right: auto;background-image:url(\''+img_Player+'\');background-repeat:no-repeat;-moz-background-size: 100% 100%;-o-background-size: 100% 100%;-webkit-background-size: 100% 100%;background-size: 100% 100%;');
	}
}

function report0PlayerImage(){
	if(GM_getValue('PlayerImage' + window.location.host, '')!=''){
		var img_Player=GM_getValue('PlayerImage' + window.location.host, '');
		document.getElementById('attackerAvatar1').getElementsByTagName('div')[3].setAttribute('id','PlayerImage');
		document.getElementById('PlayerImage').setAttribute('style','background-image: url(\''+img_Player+'\'); width: 168px; height: 194px; margin-left: auto; margin-right: auto;background-repeat:no-repeat;-moz-background-size: 100% 100%;-o-background-size: 100% 100%;-webkit-background-size: 100% 100%;background-size: 100% 100%;');
	}
}

function report3PlayerImage(){
	if(document.getElementById('attackerAvatar1').innerHTML.match(/p=(\d+)/i)){
		var p1=document.getElementById('attackerAvatar1').innerHTML.match(/p=(\d+)/i)[1];
		var link1=GCAO_siteurl+'mod=player&p='+p1+'&sh='+GCAO_secureCode;
		GM_xmlhttpRequest({
			method: "GET",
			url: link1,
			onload: function(response){
				if(response.responseText.match(/##GTI=/i)){
					var img_Player1=response.responseText.match(/##GTI=([^#]+)##/i)[1];
					document.getElementById('attackerAvatar1').getElementsByTagName('div')[3].setAttribute('id','PlayerImage1');
					document.getElementById('PlayerImage1').setAttribute('style','background-image: url(\''+img_Player1+'\'); width: 168px; height: 194px; margin-left: auto; margin-right: auto;background-repeat:no-repeat;-moz-background-size: 100% 100%;-o-background-size: 100% 100%;-webkit-background-size: 100% 100%;background-size: 100% 100%;');
				}
			}
		});
	}
	if(document.getElementById('defenderAvatar11').innerHTML.match(/p=(\d+)/i)[1]){
		var p11=document.getElementById('defenderAvatar11').innerHTML.match(/p=(\d+)/i)[1];
		var link11=GCAO_siteurl+'mod=player&p='+p11+'&sh='+GCAO_secureCode;
		GM_xmlhttpRequest({
			method: "GET",
			url: link11,
			onload: function(response){
				if(response.responseText.match(/##GTI=/i)){
					var img_Player11=response.responseText.match(/##GTI=([^#]+)##/i)[1];
					document.getElementById('defenderAvatar11').getElementsByTagName('div')[1].setAttribute('id','PlayerImage11');
					document.getElementById('PlayerImage11').setAttribute('style','background-image: url(\''+img_Player11+'\'); width: 168px; height: 194px; margin-left: auto; margin-right: auto;background-repeat:no-repeat;-moz-background-size: 100% 100%;-o-background-size: 100% 100%;-webkit-background-size: 100% 100%;background-size: 100% 100%;');
				}
			}
		});
	}
}

function reportPlayerImage(){
	document.getElementById('content').getElementsByTagName('table')[2].getElementsByTagName('td')[0].setAttribute('id','attackerAvatar1');
	document.getElementById('content').getElementsByTagName('table')[2].getElementsByTagName('td')[2].setAttribute('id','defenderAvatar11');
	
	if(document.getElementById('attackerAvatar1').innerHTML.match(/p=(\d+)/i)){
		var p1=document.getElementById('attackerAvatar1').innerHTML.match(/p=(\d+)/i)[1];
		var link1=GCAO_siteurl+'mod=player&p='+p1+'&sh='+GCAO_secureCode;
		GM_xmlhttpRequest({
			method: "GET",
			url: link1,
			onload: function(response){
				if(response.responseText.match(/##GTI=/i)){
					var img_Player1=response.responseText.match(/##GTI=([^#]+)##/i)[1];
					document.getElementById('attackerAvatar1').getElementsByTagName('div')[3].setAttribute('id','PlayerImage1');
					document.getElementById('PlayerImage1').setAttribute('style','background-image: url(\''+img_Player1+'\'); width: 168px; height: 194px; margin-left: auto; margin-right: auto;background-repeat:no-repeat;-moz-background-size: 100% 100%;-o-background-size: 100% 100%;-webkit-background-size: 100% 100%;background-size: 100% 100%;');
				}
			}
		});
	}
	if(document.getElementById('defenderAvatar11').innerHTML.match(/p=(\d+)/i)){
		var p11=document.getElementById('defenderAvatar11').innerHTML.match(/p=(\d+)/i)[1];
		var link11=GCAO_siteurl+'mod=player&p='+p11+'&sh='+GCAO_secureCode;
		GM_xmlhttpRequest({
			method: "GET",
			url: link11,
			onload: function(response){
				if(response.responseText.match(/##GTI=/i)){
					var img_Player11=response.responseText.match(/##GTI=([^#]+)##/i)[1];
					document.getElementById('defenderAvatar11').getElementsByTagName('div')[3].setAttribute('id','PlayerImage11');
					document.getElementById('PlayerImage11').setAttribute('style','background-image: url(\''+img_Player11+'\'); width: 168px; height: 194px; margin-left: auto; margin-right: auto;background-repeat:no-repeat;-moz-background-size: 100% 100%;-o-background-size: 100% 100%;-webkit-background-size: 100% 100%;background-size: 100% 100%;');
				}
			}
		});
	}
}
//################################################################################################################################
//## SAVE PLAYER'S IMAGE / ???T????S? ??????S ??????
//################################################################################################################################
function PlayerImageSave(){
	//document.getElementById('content').getElementsByTagName('div')[1].innerHTML = document.getElementById('content').getElementsByTagName('div')[1].innerHTML.replace(/submod\=edit/i, 'submod=edit&img=save').replace(/name\="save"/i, 'name="save" id="save"');
	document.getElementById('content').getElementsByTagName('form')[0].setAttribute('action','index.php?mod=settings&submod=edit&img=save&sh='+GCAO_secureCode);
	
	var perigrafi = document.getElementById('rpg').innerHTML;
	if (perigrafi.match(/\[f c\=#DED2AD\]\[f s\=10\]##GTI\=(.*)##\[\/f\]\[\/f\]/i)){
		var link = perigrafi.match(/\[f c\=#DED2AD\]\[f s\=10\]##GTI\=(.*)##\[\/f\]\[\/f\]/i);
		document.getElementById('rpg').innerHTML = perigrafi.replace(link[0], '');
		link = link[1];
	}
	else if(perigrafi.match(/\[f c\=#E5D9BD\]\[f s\=10\]##GTI\=(.*)##\[\/f\]\[\/f\]/i)){
		var link = perigrafi.match(/\[f c\=#E5D9BD\]\[f s\=10\]##GTI\=(.*)##\[\/f\]\[\/f\]/i);
		document.getElementById('rpg').innerHTML = perigrafi.replace(link[0], '');
		link = link[1];
	}
	else{var link = '';}
	
	if(document.location.href.match(/img\=save/)){
		GM_setValue('PlayerImage' + window.location.host, link);
	}
	
	var newPlImg = document.createElement('span');
	newPlImg.setAttribute('id', 'ChangePlImg')
	newPlImg.innerHTML = '<br><b>'+L_changePlayerImage+':</b><p><input id="ImageUrl" size="73" value="' + link + '"></p>';
	document.getElementById('content').getElementsByTagName('div')[10].appendChild(newPlImg);
	
	document.getElementsByTagName('form')[0].setAttribute('onsubmit',"if(document.getElementById('ImageUrl').value!=''){document.getElementById('rpg').value = document.getElementById('rpg').value + '[f c=#DED2AD][f s=10]##GTI=' + document.getElementById('ImageUrl').value + '##[/f][/f]';document.getElementById('rpg').innerHTML = document.getElementById('rpg').value + '[f c=#DED2AD][f s=10]##GTI=' + document.getElementById('ImageUrl').value + '##[/f][/f]';}");
	
	document.getElementById('toggleLinkColor').removeAttribute('class');
	document.getElementById('toggleLinkColor').removeAttribute('href');
	document.getElementById('toggleLinkColor').setAttribute('onclick',"if(document.getElementById('togglePanelColor').style.display=='block'){document.getElementById('togglePanelColor').style.display='none'}else{document.getElementById('togglePanelColor').style.display='block'}");
	document.getElementById('togglePanelColor').setAttribute('onclick','document.getElementById(\'togglePanelColor\').style.display=\'none\';');
	document.getElementById('rpg').setAttribute('onclick','document.getElementById(\'togglePanelColor\').style.display=\'none\';');
	
	var tran_Char=document.getElementById('content').innerHTML.match(/\(\d+ ([^)]+)\)/i)[1];
	var charNum=document.getElementById('rpg').innerHTML.length+document.getElementById('ImageUrl').value.length;
	var charCounter = document.createElement('div');
	charCounter.setAttribute('id', 'charCounterDiv')
	charCounter.innerHTML='<span id="charCounter">'+charNum+'</span>/4000 '+tran_Char+' <span id="ImageProblem" style="display:none;color:red;">'+L_Overfloated+':<br> - '+L_plImageWillBeLost+'.<br> - '+L_plDecriptionWillBeCut+'.</span>';
	var location = document.getElementById('rpg');
	location.parentNode.insertBefore(charCounter, location);
	
	document.getElementById('rpg').setAttribute('onkeyup','if(document.getElementById(\'ImageUrl\').value.length>0){var addin=37;}else{var addin=0;}var x=document.getElementById(\'rpg\').value.length+document.getElementById(\'ImageUrl\').value.length+addin;document.getElementById(\'charCounter\').innerHTML=\'\'+x;if(x>4000){document.getElementById(\'ImageProblem\').style.display=\'block\'}else{document.getElementById(\'ImageProblem\').style.display=\'none\'}');
	document.getElementById('ImageUrl').setAttribute('onkeyup','if(document.getElementById(\'ImageUrl\').value.length>0){var addin=37;}else{var addin=0;}var x=document.getElementById(\'rpg\').value.length+document.getElementById(\'ImageUrl\').value.length+addin;document.getElementById(\'charCounter\').innerHTML=\'\'+x;if(x>4000){document.getElementById(\'ImageProblem\').style.display=\'block\'}else{document.getElementById(\'ImageProblem\').style.display=\'none\'}');

	var defaultImagesBox = document.createElement('span');
	defaultImagesBox.innerHTML = '<input type="button" id="DisplayDefaultImages" class="button1" value="'+L_defImages+'" onclick="this.style.display=\'none\'">';
	document.getElementById('ChangePlImg').appendChild(defaultImagesBox);
	
	document.getElementById("DisplayDefaultImages").addEventListener("click", ShowImages, false);
}

function ShowImages(){
	var defaultImagesBox = document.createElement('span');
	defaultImagesBox.setAttribute('id', 'Box');
	defaultImagesBox.innerHTML = '<input type="button" class="button1" value="'+L_defImages+'" onclick="if(document.getElementById(\'DefaultImages\').style.display==\'none\'){document.getElementById(\'DefaultImages\').style.display=\'block\';}else{document.getElementById(\'DefaultImages\').style.display=\'none\';}">'+
	'<br><span id="DefaultImages""><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/gigantas.jpg" style="margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/forestelf.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/satiros.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/rusalka.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/pigasos.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<br><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/minotauros.jpg" style="margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/medousa.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/magicboy.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/leonidas.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/kuklopas.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<br><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/kleopatra.jpg" style="margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/kesaras.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/kentauros.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/gorgona.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/aladin.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<br><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/farao.jpg" style="margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/dragoni.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/copgirl.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/basilias.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/amazona.jpg" style="margin-left:3px;margin-top:8px;width:90px;cursor:pointer;" onclick="document.getElementById(\'ImageUrl\').value=this.getAttribute(\'src\');">'+
	'<br><i>'+L_imgMadeFrom+' <b>Miguel Coimbra</b> (<a href="http://www.miguelcoimbra.com/" target="_blank">Homepage</a>)</i></span>';
	document.getElementById('ChangePlImg').appendChild(defaultImagesBox);
}

//################################################################################################################################
//## GUILD'S IMAGE / ?????? ??G????S
//################################################################################################################################
function guildImage(){
	if(document.getElementById('content').innerHTML.match(/##GTGI=([^#]+)##/i)){
		var img_Guild=document.getElementById('content').innerHTML.match(/##GTGI=([^#]+)##/i)[1];
		if(document.getElementById('blackoutDialogLeave')){
			document.getElementById('content').getElementsByTagName('img')[1].setAttribute('id','GuildImage');
		}
		else{
			document.getElementById('content').getElementsByTagName('img')[0].setAttribute('id','GuildImage');
		}
		document.getElementById('GuildImage').setAttribute('height','232px');
		document.getElementById('GuildImage').setAttribute('width','209px');
		document.getElementById('GuildImage').setAttribute('src',img_Guild);
	}
}

function reportGuildImage(){
	if(document.getElementById('content').innerHTML.match(/i=\d+/g)[0]){
		var g1=document.getElementById('content').innerHTML.match(/i=\d+/g)[0];
		var link1=GCAO_siteurl+'mod=guild_main&'+g1+'&sh='+GCAO_secureCode;
		GM_xmlhttpRequest({
			method: "GET",
			url: link1,
			onload: function(response){
				if(response.responseText.match(/##GTGI=/i)){
					var img_Guild1=response.responseText.match(/##GTGI=([^#]+)##/i)[1];
					document.getElementById('content').getElementsByTagName('img')[0].setAttribute('id','GuildImage1');
					document.getElementById('GuildImage1').setAttribute('height','232px');
					document.getElementById('GuildImage1').setAttribute('width','209px');
					document.getElementById('GuildImage1').setAttribute('src',img_Guild1);
				}
			}
		});
	}
	if(document.getElementById('content').innerHTML.match(/i=\d+/g)[1]){
		var g11=document.getElementById('content').innerHTML.match(/i=\d+/g)[1];
		var link11=GCAO_siteurl+'mod=guild_main&'+g11+'&sh='+GCAO_secureCode;
		GM_xmlhttpRequest({
			method: "GET",
			url: link11,
			onload: function(response){
				if(response.responseText.match(/##GTGI=/i)){
					var img_Guild11=response.responseText.match(/##GTGI=([^#]+)##/i)[1];
					document.getElementById('content').getElementsByTagName('img')[1].setAttribute('id','GuildImage11');
					document.getElementById('GuildImage11').setAttribute('height','232px');
					document.getElementById('GuildImage11').setAttribute('width','209px');
					document.getElementById('GuildImage11').setAttribute('src',img_Guild11);
				}
			}
		});
	}
}
//################################################################################################################################
//## SAVE GUILD'S IMAGE / ???T????S? ??????S ??G????S
//################################################################################################################################
function GuildImageSave(){
	document.getElementById('content').getElementsByTagName('input')[0].id='save';
	var perigrafi = document.getElementById('description').innerHTML;
	if (perigrafi.match(/\[f c=#DED2AD\]\[f s=10\]##GTGI=([^#]+)##\[\/f\]\[\/f\]/i)){
		var link = perigrafi.match(/\[f c=#DED2AD\]\[f s=10\]##GTGI=([^#]+)##\[\/f\]\[\/f\]/i);
		document.getElementById('description').innerHTML = perigrafi.replace(link[0], '');
		link = link[1];
	}
	else if(perigrafi.match(/\[f c=#E5D9BD\]\[f s=10\]##GTGI=([^#]+)##\[\/f\]\[\/f\]/i)){
		var link = perigrafi.match(/\[f c=#E5D9BD\]\[f s=10\]##GTGI=([^#]+)##\[\/f\]\[\/f\]/i);
		document.getElementById('description').innerHTML = perigrafi.replace(link[0], '');
		link = link[1];
	}
	else{var link = '';}
	var newGImg = document.createElement('span');
	newGImg.setAttribute('id', 'ChangeGImg')
	newGImg.innerHTML = '<br><br><b>'+L_changeGuildImage+':</b><p><input id="ImageUrl" size="73" value="' + link + '"></p>';
	insertAfter(newGImg,document.getElementById('description'));
	document.getElementsByTagName('form')[0].setAttribute('onsubmit',"if(document.getElementById('ImageUrl').value!=''){document.getElementById('description').value = document.getElementById('description').value + '[f c=#DED2AD][f s=10]##GTGI=' + document.getElementById('ImageUrl').value + '##[/f][/f]';document.getElementById('description').innerHTML = document.getElementById('description').value + '[f c=#DED2AD][f s=10]##GTGI=' + document.getElementById('ImageUrl').value + '##[/f][/f]';}");	

	document.getElementById('descCounter').style.display='none';
	
	var charNum=document.getElementById('description').innerHTML.length+document.getElementById('ImageUrl').value.length+38;
	var charCounter = document.createElement('span');
	charCounter.setAttribute('id', 'charCounter');
	charCounter.innerHTML=charNum;
	var location = document.getElementById('descCounter');
	location.parentNode.insertBefore(charCounter, location);
	
	var warningSpan=document.createElement('tr');
	warningSpan.innerHTML='<td><span id="ImageProblem" style="display:none;color:red;margin-left:5px;">'+L_Overfloated+':<br> - '+L_gImageWillBeLost+'.<br> - '+L_gDescrtipionWillBeCut+'.</span></td>';
	var location=document.getElementById('descCounter').parentNode.parentNode;
	insertAfter(warningSpan, location);
	
	document.getElementById('description').setAttribute('onkeyup','if(document.getElementById(\'ImageUrl\').value.length>0){var addin=38;}else{var addin=0;}var x=document.getElementById(\'description\').value.length+document.getElementById(\'ImageUrl\').value.length+addin;document.getElementById(\'charCounter\').innerHTML=x;if(x>10000){document.getElementById(\'ImageProblem\').style.display=\'block\'}else{document.getElementById(\'ImageProblem\').style.display=\'none\'}');
	document.getElementById('ImageUrl').setAttribute('onkeyup','if(document.getElementById(\'ImageUrl\').value.length>0){var addin=38;}else{var addin=0;}var x=document.getElementById(\'description\').value.length+document.getElementById(\'ImageUrl\').value.length+addin;document.getElementById(\'charCounter\').innerHTML=x;if(x>10000){document.getElementById(\'ImageProblem\').style.display=\'block\'}else{document.getElementById(\'ImageProblem\').style.display=\'none\'}');
}
//################################################################################################################################
//## TAKE GUILD'S NAME IF IT EXIST
//################################################################################################################################
function guildNameTake(){
	if(!document.getElementById('content').getElementsByTagName('input')[0]){
		var guildName=document.getElementById('content').getElementsByTagName('b')[0].innerHTML;
		Set_Cookie('guildName',guildName);
	}
}

//################################################################################################################################
//## BASICS WHILE TRAINING / ??S???S S??? ????????S?
//################################################################################################################################
function basikes(){
    var tot = 0;
    if(document.getElementById('char_f0_tt')){
    var stats = new Array(2);
    for (x=0;x<=5;x++){
    stats[x,0] = document.getElementById('char_f'+x+'_tt').getAttribute('onmouseover');
    stats[x,1] = stats[x,0].match(/\\'>(\d+)/g)[2].match(/(\d+)/g)[0];
    stats[x,0] = stats[x,0].match(/\\'>(\d+)/g)[1].match(/(\d+)/g)[0];
    stats[x,2] = nextPoints(stats[x,0]);
    document.getElementById('char_f'+x).setAttribute('style','color: #540400;display: block;float: right;font-weight: bold;position: relative;right: 5px;text-align: right;top: -15px;width: 130px;');
    document.getElementById('char_f'+x).innerHTML += ' | <font color="#505050">' + stats[x,0] + '</font> | <font color="green">+' + stats[x,2] + '</font>';
     
    if(x==0){tot += statCost(5, stats[x,0], 2.6, 0);}
    else if((x==1)||(x==4)){tot += statCost(5, stats[x,0], 2.5, 0);}
    else if((x==2)||(x==3)){tot += statCost(5, stats[x,0], 2.3, 0);}
    else if(x==5){tot += statCost(5, stats[x,0], 2.4, 0);}
     
    }
    var divs = document.evaluate(".//div[@class='title_inner']",document.getElementById('content'),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
    divs.snapshotItem(0).innerHTML += ' : <font style="font-weight:normal;">'+dottedNumber(tot)+' <img border="0" align="absmiddle" src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/res2.gif"> '+L_spent+'</font>';
    }
}
     
// return the cost of a stat from begin to end.
/**
coeff : 26 <-> Strength
2.5 <-> skill/charisma
2.4 <-> intelligence
2.3 <-> agility/constitution
**/
function statCost(begin, end, coeff, reduc){
    var count = 0;
    begin = parseInt(begin);
    end = parseInt(end);
     
    for(var i = begin; i < end; i++)
    count += parseInt(Math.pow(i-4,coeff)*(1-reduc));
     
    return count;
}
     
//How much the max will increase / ??s? ?a a????e? t? µ???st?
function nextPoints(stat){
    stat = stat*1;
    if(stat%2==1){var nextPoints=2;}
    else{var nextPoints=1;}
    return nextPoints;
}
     
function resetStats(){
    var reset = 5;
    document.getElementById("inputStat1").value = reset;
    document.getElementById('inputStat2').value = document.getElementById('char_f0_tt').getAttribute('onmouseover').match(/\\'>(\d+)/g)[1].match(/(\d+)/g)[0];
    document.getElementById("inputStat3").value = reset;
    document.getElementById('inputStat4').value = document.getElementById('char_f1_tt').getAttribute('onmouseover').match(/\\'>(\d+)/g)[1].match(/(\d+)/g)[0];
    document.getElementById("inputStat5").value = reset;
    document.getElementById('inputStat6').value = document.getElementById('char_f2_tt').getAttribute('onmouseover').match(/\\'>(\d+)/g)[1].match(/(\d+)/g)[0];
    document.getElementById("inputStat7").value = reset;
    document.getElementById('inputStat8').value = document.getElementById('char_f3_tt').getAttribute('onmouseover').match(/\\'>(\d+)/g)[1].match(/(\d+)/g)[0];
    document.getElementById("inputStat9").value = reset;
    document.getElementById('inputStat10').value = document.getElementById('char_f4_tt').getAttribute('onmouseover').match(/\\'>(\d+)/g)[1].match(/(\d+)/g)[0];
    document.getElementById("inputStat11").value = reset;
    document.getElementById('inputStat12').value = document.getElementById('char_f5_tt').getAttribute('onmouseover').match(/\\'>(\d+)/g)[1].match(/(\d+)/g)[0];
    document.getElementById("inputStat13").innerHTML = "";
    document.getElementById("inputStat14").innerHTML = "";
    document.getElementById("inputStat15").innerHTML = "";
    document.getElementById("inputStat16").innerHTML = "";
    document.getElementById("inputStat17").innerHTML = "";
    document.getElementById("inputStat18").innerHTML = "";
    document.getElementById("inputStat19").innerHTML = "";
    document.getElementById("inputStat20").innerHTML = "";
}
     
function addTrainingCostSimulator(){
	var div = document.createElement('div');
	
	var L_Strength = document.getElementById('char_f0_tt').getElementsByTagName('span')[0].innerHTML;
	var L_Skill = document.getElementById('char_f1_tt').getElementsByTagName('span')[0].innerHTML;
	var L_Agility = document.getElementById('char_f2_tt').getElementsByTagName('span')[0].innerHTML;
	var L_Constitution = document.getElementById('char_f3_tt').getElementsByTagName('span')[0].innerHTML;
	var L_Charisma = document.getElementById('char_f4_tt').getElementsByTagName('span')[0].innerHTML;
	var L_Intelligence = document.getElementById('char_f5_tt').getElementsByTagName('span')[0].innerHTML;

    document.getElementById('content').appendChild(div);
	div.innerHTML +='<div class="contentItem" style="margin-top: 0px;">'
    +'<h3>'+L_SimOfTraining+'</h3>'
    +'<div class="contentItem_content">'
	+'<style>'
	+'input.button4 {background-image: url("http://i617.photobucket.com/albums/tt260/goldisever/GCAO/button4.jpg");border:0 none;color:#453011;font-size:11px;font-weight:bold;height:26px;width:37px;}'
	+'</style>'
    +'<table align="center" style="border:1px solid #af8e50;background-color:#ded8c6;padding:5px;">'
    +'<tr>'
    +'<th align="center" width="50"> '+L_Stat+' </th>'
    +'<th align="center" width="40"> '+L_From+' </th>'
    +'<th align="center" width="50"> '+L_To+' </th>'
    +'<th align="center">  </th>'
    +'<th align="center" width="150" > '+L_Cost+' <img align="absmiddle" src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/res2.gif"></th>'
    +''
    +'</tr>'
    +'<tr>'
    +'<th align="center">'+L_Strength+'</th>'
    +'<th><input type="text" id="inputStat1" size="7"></th>'
    +'<th><input type="text" id="inputStat2" size="7"></th>'
	+'<th align="center"><input type="button" id="addOne1" class="button4" onclick="document.getElementById(\'inputStat2\').value++;" value="+1">'
	+'<input type="button" id="removeOne1" class="button4" onclick="document.getElementById(\'inputStat2\').value=document.getElementById(\'inputStat2\').value-1;" value="-1" style="margin-left:4px;"></th>'
    +'<th align="center"><span id="inputStat14"></span></th>'
    +'</tr>'
    +'<tr>'
    +'<th align="center">'+L_Skill+' </th>'
    +'<th><input type="text" id="inputStat3" size="7"></th>'
    +'<th><input type="text" id="inputStat4" size="7"></th>'
	+'<th align="center"><input type="button" id="addOne2" class="button4" onclick="document.getElementById(\'inputStat4\').value++;" value="+1">'
	+'<input type="button" id="removeOne2" class="button4" onclick="document.getElementById(\'inputStat4\').value=document.getElementById(\'inputStat4\').value-1;" value="-1" style="margin-left:4px;"></th>'
    +'<th align="center"><span id="inputStat15"></span></th>'
    +'</tr>'
    +'<tr>'
    +'<th align="center">'+L_Agility+' </th>'
    +''
    +'<th><input type="text" id="inputStat5" size="7"></th>'
    +'<th><input type="text" id="inputStat6" size="7"></th>'    
	+'<th align="center"><input type="button" id="addOne3" class="button4" onclick="document.getElementById(\'inputStat6\').value++;" value="+1">'
	+'<input type="button" id="removeOne3" class="button4" onclick="document.getElementById(\'inputStat6\').value=document.getElementById(\'inputStat6\').value-1;" value="-1" style="margin-left:4px;"></th>'

    +'<th align="center"><span id="inputStat16"></span></th>'
    +'</tr>'
    +'<tr>'
    +'<th align="center">'+L_Constitution+' </th>'
    +'<th><input type="text" id="inputStat7" size="7"></th>'
    +'<th><input type="text" id="inputStat8" size="7"></th>'
	+'<th align="center"><input type="button" id="addOne4" class="button4" onclick="document.getElementById(\'inputStat8\').value++;" value="+1">'
	+'<input type="button" id="removeOne4" class="button4" onclick="document.getElementById(\'inputStat8\').value=document.getElementById(\'inputStat8\').value-1;" value="-1" style="margin-left:4px;"></th>'
    +'<th align="center"><span id="inputStat17"></span></th>'
    +'</tr>'
    +'<tr>'
    +'<th align="center">'+L_Charisma+' </th>'
    +'<th><input type="text" id="inputStat9" size="7"></th>'
    +'<th><input type="text" id="inputStat10" size="7"></th>'
	+'<th align="center"><input type="button" id="addOne5" class="button4" onclick="document.getElementById(\'inputStat10\').value++;" value="+1">'
	+'<input type="button" id="removeOne5" class="button4" onclick="document.getElementById(\'inputStat10\').value=document.getElementById(\'inputStat10\').value-1;" value="-1" style="margin-left:4px;"></th>'
    +'<th align="center"><span id="inputStat18"></span></th>'
    +''
    +'</tr>'
    +'<tr>'
    +'<th align="center">'+L_Intelligence+' </th>'
    +'<th><input type="text" id="inputStat11" size="7"></th>'
    +'<th><input type="text" id="inputStat12" size="7"></th>'
	+'<th align="center"><input type="button" id="addOne6" class="button4" onclick="document.getElementById(\'inputStat12\').value++;" value="+1">'
	+'<input type="button" id="removeOne6" class="button4" onclick="document.getElementById(\'inputStat12\').value=document.getElementById(\'inputStat12\').value-1;" value="-1" style="margin-left:4px;"></th>'
    +'<th align="center"><span id="inputStat19"></span></th>'
    +'</tr>'
    +'<tr>'
    +'<th align="center" colspan="2">'+L_TrainingCampLevel+'</th>'
    +'<th align="center">'
    +'<select id="inputStat0" onChange="calculStats()" name="selection" >'
    +'<option value="0">0</option>'
    +'<option value="1">1</option>'
    +''
    +'<option value="2">2</option>'
    +'<option value="3">3</option>'
    +'<option value="4">4</option>'
    +'<option value="5">5</option>'
    +'<option value="6">6</option>'
    +'<option value="7">7</option>'
    +'<option value="8">8</option>'
    +'<option value="9">9</option>'
    +'<option value="10">10</option>'
    +''
    +'<option value="11">11</option>'
    +'<option value="12">12</option>'
    +'<option value="13">13</option>'
    +'<option value="14">14</option>'
    +'<option value="15">15</option>'
    +'</select>'
    +'</th>'
    +'<th align="right">'+L_Reduction+' </th>'
    +'<th align="center"><span id="inputStat20"></span></th>'
    +'</tr>'
    +''
    +'<tr>'
    +'<th colspan="2" align="center"></th>'
    +'<th align="right" colspan="2"><b>'+L_TotalCost+'</b></th>'
    +'<th align="center"><span id="inputStat13"></span></th>'
    +'</tr>'
    +'<tr>'
    +'<th colspan="5" align="center">'
    +'<input class="button2" type="button" value="'+L_staticsTitle+'" id="myStats" title="'+L_TotalCostTitle+'">'
    +'<input class="button2" type="button" value="'+L_Calculate+'" id="calculate" title="'+L_CalculateTitle+'" style="margin-left:20px;">'
    +'<input class="button3" type="button" onClick="resetStats()" value="'+L_ClearAll+'" id="reset" title="'+L_ClearAllTitle+'" style="margin-left:20px;">'
    +'</th>'
    +'</tr>'
    +'</table></div>';

    document.getElementById('myStats').addEventListener('click',function(){putMyStats2();},true);
    document.getElementById('calculate').addEventListener('click',function(){calculStats();},true);
    document.getElementById('reset').addEventListener('click',function(){resetStats();},true);

    resetStats();
	for (x=1;x<=6;x++){
		document.getElementById('addOne'+x).addEventListener('click',function(){calculStats();},true);
		document.getElementById('removeOne'+x).addEventListener('click',function(){calculStats();},true);
		var y=x*2;
		var z=x-1;
		document.getElementById('inputStat'+y).value = document.getElementById('char_f'+z+'_tt').getAttribute('onmouseover').match(/\\'>(\d+)/g)[1].match(/(\d+)/g)[0];
	}
}

function putMyStats2(){
	for (x=1;x<=6;x++){
		var y=2*x-1;
		var z=x-1;
		document.getElementById('inputStat'+y).value = document.getElementById('char_f'+z+'_tt').getAttribute('onmouseover').match(/\\'>(\d+)/g)[1].match(/(\d+)/g)[0];
	}
}
 
function calculStats(){
    var reduc = 2*document.getElementById("inputStat0").value/100;
    var cout_force = statCost(document.getElementById("inputStat1").value, document.getElementById("inputStat2").value, 2.6, reduc);
    var cout_adresse = statCost(document.getElementById("inputStat3").value, document.getElementById("inputStat4").value, 2.5, reduc);
    var cout_agilite = statCost(document.getElementById("inputStat5").value, document.getElementById("inputStat6").value, 2.3, reduc);
    var cout_constitution = statCost(document.getElementById("inputStat7").value, document.getElementById("inputStat8").value, 2.3, reduc);
    var cout_charisme = statCost(document.getElementById("inputStat9").value, document.getElementById("inputStat10").value, 2.5, reduc);
    var cout_intelligence = statCost(document.getElementById("inputStat11").value, document.getElementById("inputStat12").value, 2.4, reduc);
    var cout_total = cout_force + cout_adresse + cout_agilite + cout_constitution + cout_charisme + cout_intelligence;
    document.getElementById("inputStat13").innerHTML = dottedNumber(cout_total);
    document.getElementById("inputStat14").innerHTML = displayProp(cout_force,cout_total);
    document.getElementById("inputStat15").innerHTML = displayProp(cout_adresse ,cout_total);
    document.getElementById("inputStat16").innerHTML = displayProp(cout_agilite ,cout_total);
    document.getElementById("inputStat17").innerHTML = displayProp(cout_constitution ,cout_total);
    document.getElementById("inputStat18").innerHTML = displayProp(cout_charisme ,cout_total);
    document.getElementById("inputStat19").innerHTML = displayProp(cout_intelligence ,cout_total);
    document.getElementById("inputStat20").innerHTML = dottedNumber(parseInt(cout_total*reduc/(1-reduc)));
}
     
function displayProp(nbr1,nbr2){
	if(nbr2!=0){return dottedNumber(nbr1)+" ("+parseInt(nbr1*100/nbr2)+"%)";}
	else{return dottedNumber(nbr1)+" (0%)";}
}

//################################################################################################################################
//## SIMULATOR / ???S???O??S
//################################################################################################################################
function simulator(){
	if(!document.getElementById('ticker1')){
		if(Get_Cookie('simstats')){
			var code=Get_Cookie('simstats');
		}else{
			var code='##0##0##0##0##0##0##0##0##0##0##0##0##0##0';
		}
		
		var Level = code.match(/##([^#]+)/g)[0].replace(/#/g,'')*1;
		var LifePointsLeft = code.match(/##([^#]+)/g)[1].replace(/#/g,'')*1;
		var Strength = code.match(/##([^#]+)/g)[2].replace(/#/g,'')*1;
		var Skill = code.match(/##([^#]+)/g)[3].replace(/#/g,'')*1;
		var Agility = code.match(/##([^#]+)/g)[4].replace(/#/g,'')*1;
		var Constitution = code.match(/##([^#]+)/g)[5].replace(/#/g,'')*1;
		var Charisma = code.match(/##([^#]+)/g)[6].replace(/#/g,'')*1;
		var Armour = code.match(/##([^#]+)/g)[7].replace(/#/g,'')*1;
		var DamageMin = code.match(/##([^#]+)/g)[8].replace(/#/g,'')*1;
		var DamageMax = code.match(/##([^#]+)/g)[9].replace(/#/g,'')*1;
		var ChanceOfAvoidCriticalHits = code.match(/##([^#]+)/g)[10].replace(/#/g,'')*1;
		var ChanceToBlockAHit = code.match(/##([^#]+)/g)[11].replace(/#/g,'')*1;
		var ChanceForCriticalDamage = code.match(/##([^#]+)/g)[12].replace(/#/g,'')*1;
		
		var img_winpercent = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAZMAAAAUCAYAAABI3tC1AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAANzSURBVHhe7Z3LaxNRFMZP0kWagm9BrXOT/AmCKx9FpUhx4V9QarvQYlArVQKC0l1xI4gItihUrRbFStClW1Es3VQL4sZF2sQX+EoCIe9xToamVCxtx5m5czvfQOlm5n7n/A7l49xzZxrQNE0PBALEl67rjd+4QAAEQAAEQGA1BNg/Gj9sJvGH71fzDO4BAV8SeDF0nNLptLTcg8Eg1et1KfrQloLdcVG76srr1Go1qlarFBBC6P3js5TO5B1PAAIgoBoBoW2gifg+amlpUS10xAsCrhBgIykUCmZncur+O8NMcq4IQwQEVCIgtI306MwBam1tVSlsxAoCrhGoVCqUz+dNMzl5d8Zo47OuiUMIBFQhIMQmenyug8LhsLSQeYuLtxNkXNCWQd15Tbvqyus0zSQajeq9t6cNM/ntfAZQAAHFCAixmZ6cPyTVTBRDhnB9RoDNJJfLmTOTvoaZ/PIZAqQLAisTEGILTQ4ewTbXyqhwh08JlMtlc5uLzaRndIoy6Z8+RYG0QWB5AprYSsmLnRQKhYAJBEDgHwR4AJ/NZs2ZyYmRN4aZ/AAoEACBvwhoYhslE0eldiZ8hl/WO2DQXp9/EnbVldcpFouLnUn3zVeGmXxfn9SQFQj8BwFNbKdnl7qkzkzsGpZawQBtK9S8/4xddeV1uDNpzkyOXUnSp1TG+wQQIQi4TGB3TKOX13ukmgl3JQtfqXA5/UZHBG23qTuvZ1ddeZ0l21xdl5/SZ5iJ8xWEgnIE2g0zeX2jT+o2l3LQELCvCCw5zdWZmDDMRN7nInxFHskqRaA9JmjqVr9UM7Hr0xdWwEPbCjXvP2NXXXmdUqlkbnNFIhH98IVx+pKa9z4BRAgCLhPYFYvQ9Ohpamtrc1l5Uc6uLQkrCUDbCjXvP2NXXXkdPhrcPM3VMTBGX+fmvE8AEYKAywR2RqM0MzYgdWbicsqQA4E1EWAzaXQmfDT44Nk7MJM14cPNfiHAZvL23qDUzsQvrJGnmgR4m6v5ba798RGYiZp1RNQOE2AzmX2QQGfiMGcsry6B5hvwPDPZ23uNvs2n1M0GkYOAQwR2RGL0YXIInYlDfLGs+gS4M2nOTPZ0X1U/I2QAAg4R+Ph8WKqZ2DUstYIH2laoef8Zu+q65D0T7kwWFpb139y8jx4RggAIgAAILEeAjwj/AeCmf+KijFlGAAAAAElFTkSuQmCC';
		var SimulatorBox = document.createElement('div');
		SimulatorBox.setAttribute('id', 'SimulatorBox');
		SimulatorBox.setAttribute('style', 'cursor:progress;margin-top:10px;width:290px;padding:5px;border: 2px solid rgb(178, 139, 96);text-align:justify;');
		document.getElementById('content').getElementsByTagName('td')[3].appendChild(SimulatorBox);
		
		document.getElementById('SimulatorBox').innerHTML = '<b>'+L_Simulator+':</b>'+
		'<span id="percent" style="position:absolute;color:white;margin-left:150px;margin-top:18px;"></span>'+
		'<span id="ProsTitle" style="position:absolute;color:white;margin-left:-40px;margin-top:19px;"><b>'+L_arena+':</b></span>'+
		'<table cellpadding="0px" cellspacing="0px"><tr>'+
		'<td style="background-image: url(' + img_winpercent + '); background-position: 0px 0px;width:1px;height:20px;"></td>'+
		'<td id="SetWidth" style="background-image: url(' + img_winpercent + '); background-position: 0px 0px;width:200px;height:20px;cursor:pointer;"></td>'+
		'<td style="background-image: url(' + img_winpercent + '); background-position: -402px 0px;width:1px;height:20px;"></td>'+
		'</tr></table>' +
		'<table width="242px"><tr><td>' +
		'<span id="more" style="position:absolute;z-index: 20;margin-left:-3px;margin-top:-18px;display:none;cursor:pointer;"><br>' +
		'<table width="242px" id="morein" style="color:#ffffff;background: black; opacity: 0.85; border: 1px solid rgb(153, 153, 153); padding:3px;cursor:default;"></table></span>'+
		'</td></tr></table>';
		
		var fights=GM_getValue('sf', 1000);
		var results = simulate(Skill, Agility, Charisma, ChanceToBlockAHit, ChanceOfAvoidCriticalHits, Armour, DamageMin, DamageMax, ChanceForCriticalDamage, LifePointsLeft, fights);
		var won = results[0];
		var wonP = Math.round(won/fights*10000)/100;
		var lost = results[1];
		var lostP = Math.round(lost/fights*10000)/100;
		var draw = results[2];
		var drawP = Math.round(draw/fights*10000)/100;
		var myAvDamage = results[3];
		var hisAvDamage = results[4];
		var myRemainingLife = results[5];
		var hisRemainingLife = results[6];
		
		if(wonP>80){var color="green"}
		else if(wonP>=70){var color="black"}
		else{var color="red"}	
		var imgposition = -(101-wonP)*2;
		if(won==lost){var FightResulte='Draw';}
		else{var FightResulte=wonP+'%';}

		document.getElementById('SetWidth').setAttribute('style','background-image: url(http://i617.photobucket.com/albums/tt260/goldisever/Apo/winbar.png); background-position:'+imgposition+'px 0px;width:200px;height:20px;cursor:pointer;');
		document.getElementById('percent').innerHTML = '<b><font color="'+color+'">'+FightResulte+'</font></b>';
		document.getElementById('morein').innerHTML += '<tr><td>' +
		'<b style="color: rgb(186, 151, 0);">'+L_Battles+': </b><font color="#c0c0c0">'+dottedNumber(fights)+'</font>'+
		'<table width="100%">'+
		'<tr><td>&nbsp;&nbsp;</td><td><font color="white">'+L_Won+'</font></td><td><font color="white">:</font></td><td><font color="green">'+dottedNumber(won)+'</font></td><td><font color="grey">('+wonP+'%)</font></td></tr>'+
		'<tr><td>&nbsp;&nbsp;</td><td><font color="white">'+L_Lost+'</font></td><td><font color="white">:</font></td><td><font color="red">'+dottedNumber(lost)+'</font></td><td><font color="grey">('+lostP+'%)</font></td></tr>'+
		'<tr><td>&nbsp;&nbsp;</td><td><font color="white">'+L_Draws+'</font></td><td><font color="white">:</font></td><td><font color="#B8B8B8">'+dottedNumber(draw)+'</font></td><td><font color="grey">('+drawP+'%)</font></td></tr>'+
		'</table>'+
		'<b style="color: rgb(186, 151, 0);">'+L_Damage+':'+
		'<table width="100%">'+
		'<tr><td>&nbsp;&nbsp;</td><td><font color="white">'+L_myAvDamage+'</font></td><td><font color="white">:</font></td><td><font color="grey">'+dottedNumber(myAvDamage)+'</font></td></tr>'+
		'<tr><td>&nbsp;&nbsp;</td><td><font color="white">'+L_hisAvDamage+'</font></td><td><font color="white">:</font></td><td><font color="grey">'+dottedNumber(hisAvDamage)+'</font></td></tr>'+
		'</table>'+
		'</table>'+
		'<b style="color: rgb(186, 151, 0);">'+L_Life+':'+
		'<table width="100%">'+
		'<tr><td>&nbsp;&nbsp;</td><td><font color="white">'+L_myRemLife+'</font></td><td><font color="white">:</font></td><td><font color="grey">'+dottedNumber(myRemainingLife)+'</font></td></tr>'+
		'<tr><td>&nbsp;&nbsp;</td><td><font color="white">'+L_hisRemLife+'</font></td><td><font color="white">:</font></td><td><font color="grey">'+dottedNumber(hisRemainingLife)+'</font></td></tr>'+
		'</table></td></tr>';
		document.getElementById('SetWidth').setAttribute('onmouseover',"document.getElementById('more').style.display='block';");
		document.getElementById('SetWidth').setAttribute('onmouseout',"document.getElementById('more').style.display='none';");
		document.getElementById('more').setAttribute('onmouseover',"document.getElementById('more').style.display='block';");
		document.getElementById('more').setAttribute('onmouseout',"document.getElementById('more').style.display='none';");
		document.getElementById('ProsTitle').setAttribute('onmouseover',"document.getElementById('more').style.display='block';");
		document.getElementById('ProsTitle').setAttribute('onmouseout',"document.getElementById('more').style.display='none';");
		document.getElementById('SimulatorBox').style.cursor='default';
	}
}

/**################################################################################################################################
## Djor's Simulator / ???s?µ???t?? t?? Djor
################################################################################################################################**/
/**
	Arguments : my stats
**/
function simulate(skill, agility, charisma, block, resistance, ARMOR, damageMin, damageMax, critDamage, life, fights){
/* Results */
	var win = 0 ;
	var lose = 0 ;
	var draw = 0 ;

	/* number of simulated battles */
	//var fights = 1000;
	
	/* We search Opponent stats */
	if(document.getElementById('skillB')){
		var opponentSkill = document.getElementById('skillB').value;
		var opponentAgility = document.getElementById('agilityB').value;
		var opponentCharisma = document.getElementById('charismaB').value;
		var opponentArmor = document.getElementById('armorB').value;
		var opponentDamageMin = document.getElementById('damageMinB').value;
		var opponentDamageMax = document.getElementById('damageMaxB').value;
		var opponentResistance = document.getElementById('resistanceB').value;
		var opponentCrit = document.getElementById('criticB').value;
		var opponentBlock = document.getElementById('blockB').value;
		var opponentLife = 100000;
	}
	else{
		var opponentSkill = document.getElementById('char_f1').innerHTML;
		var opponentAgility = document.getElementById('char_f2').innerHTML;
		var opponentCharisma = document.getElementById('char_f4').innerHTML;
		var opponentArmor = document.getElementById('char_panzer').innerHTML;
		var damages = document.getElementById('char_schaden').innerHTML.split(' - ');
		
		var opponentDamageMin = damages[0];
		var opponentDamageMax = damages[1];
		
		var searchCrit = document.getElementById('char_schaden_tt').getAttribute('onmouseover');
		searchCrit = searchCrit.split(' %')[0].split('>');
		var opponentCrit = searchCrit[searchCrit.length-1];
		
		var searchBlock = document.getElementById("char_panzer").parentNode.getAttribute('onmouseover');
			
		searchBlock = searchBlock.split(" %");
		var opponentResistance = searchBlock[0].substring(searchBlock[0].length-2,searchBlock[0].length);
		if(opponentResistance[0]==">") opponentResistance = opponentResistance[1];
		var opponentBlock = searchBlock[1].substring(searchBlock[1].length-2,searchBlock[1].length);
		if(opponentBlock[0]==">") opponentBlock = opponentBlock[1];
		
		var opponentLife = document.getElementById('char_leben_tt').getAttribute('onmouseover');
		opponentLife = opponentLife.split("</td><td style=\\'padding-left:20px;text-align:right; color:#BA9700; font-weight: bold; font-size:9pt\\' nowrap=\\'nowrap\\'>")
		opponentLife = opponentLife[1].split("<");
		opponentLife = opponentLife[0].split(" / ");
		opponentLife = opponentLife[0];
	}
	
	/* we transform everything in integer */
	skill = parseInt(skill);
	agility = parseInt(agility);
	charisma = parseInt(charisma);
	block = parseInt(block);
	resistance = parseInt(resistance);
	ARMOR = parseInt(ARMOR);
	damageMin = parseInt(damageMin);
	damageMax = parseInt(damageMax);
	critDamage = parseInt(critDamage);
	opponentSkill = parseInt(opponentSkill);
	opponentAgility = parseInt(opponentAgility);
	opponentCharisma = parseInt(opponentCharisma);
	opponentBlock = parseInt(opponentBlock);
	opponentResistance = parseInt(opponentResistance);
	opponentDamageMin = parseInt(opponentDamageMin);
	opponentDamageMax = parseInt(opponentDamageMax);
	opponentCrit = parseInt(opponentCrit);
	opponentLife = parseInt(opponentLife);

	/* Simulator */
	var chanceOfHittingTheOpponent = 100*skill/(skill+opponentAgility);
	var chanceOfBeingHitten = 100*opponentSkill/(opponentSkill+agility);
	
	/* Double hits*/
	if(charisma>opponentCharisma){
		var myDoubleHit = charisma-opponentCharisma;
		if(myDoubleHit>100) myDoubleHit=100;
		var hisDoubleHit = 0;
	}else{
		var myDoubleHit = 0;
		var hisDoubleHit = opponentCharisma-charisma;
		if(hisDoubleHit>100) hisDoubleHit=100;
	}

	/* critics */
	if(critDamage>opponentResistance)
		var myCritChance = critDamage - opponentResistance;
	else 
		var myCritChance = 0 ;
		
	if(opponentCrit>resistance)
		var hisCritChance = opponentCrit - resistance;
	else 
		var hisCritChance = 0 ;
		
	var myArmorMin = Math.floor(ARMOR/66 - ARMOR/660-1);
	var myArmorMax = Math.floor(ARMOR/66 + ARMOR/660);
	
	var hisArmorMin = Math.floor(opponentArmor/66 - opponentArmor/660-1);
	var hisArmorMax = Math.floor(opponentArmor/66 + opponentArmor/660);
	
	var myAverageDamages = 0;
	var hisAverageDamages = 0;
	
	/* simulate for "fights" battles */
	for(j=0;j<fights;j++){
		var rounds = 10;
		var myTotalDamages = 0;
		var hisTotalDamages = 0;
		var winByLackOfLife = false;
		var loseByLackOfLife = false;
		
		var i = 0;
			
		while((i<rounds)&&(!winByLackOfLife)&&(!loseByLackOfLife)){
			var arrayTemp = aRound(myDoubleHit,hisDoubleHit,chanceOfHittingTheOpponent,damageMin,damageMax,myCritChance,opponentBlock,hisArmorMin,hisArmorMax,chanceOfBeingHitten,opponentDamageMin,opponentDamageMax,hisCritChance,block,myArmorMin,myArmorMax);
			myTotalDamages = myTotalDamages + arrayTemp[0];
			hisTotalDamages = hisTotalDamages + arrayTemp[1];
			if(myTotalDamages>opponentLife-1) {
				winByLackOfLife = true;
				myTotalDamages = opponentLife-1;
			}
			if(hisTotalDamages>life-1){
				loseByLackOfLife = true;
				hisTotalDamages = life-1;
			}
			i++;
		}
		
		if(winByLackOfLife==true){win++;}
		else{
			if(loseByLackOfLife==true){lose++;}
			else{
				if(myTotalDamages>hisTotalDamages){win++;}
				else if(myTotalDamages<hisTotalDamages){lose++;}	
				else if(myTotalDamages==hisTotalDamages){draw++;}
			}
		}
		myAverageDamages += myTotalDamages;
		hisAverageDamages += hisTotalDamages;
	}

	myAverageDamages = Math.floor(myAverageDamages/fights);
	hisAverageDamages = Math.floor(hisAverageDamages/fights);
	myRemainingLife = life - hisAverageDamages;
	if(myRemainingLife<=0){myRemainingLife=1}
	hisRemainingLife = opponentLife -myAverageDamages;
	if(hisRemainingLife<=0){hisRemainingLife=1}

	return new Array(win,lose,draw,myAverageDamages,hisAverageDamages, myRemainingLife, hisRemainingLife);
}


/*
	Simulate a round : each player does one attack, two if it is a double hit.
*/	
function aRound(myDoubleHit,hisDoubleHit,chanceOfHittingTheOpponent,damageMin,damageMax,myCritChance,opponentBlock,hisArmorMin,hisArmorMax,chanceOfBeingHitten,opponentDamageMin,opponentDamageMax,hisCritChance,block,myArmorMin,myArmorMax){
	var randomnumber100 = Math.floor(Math.random()*100);

	var myNumberOfHit = 1;
	var hisNumberOfHit = 1;
	
	if(randomnumber100<myDoubleHit)
		myNumberOfHit = 2;
	if(randomnumber100<hisDoubleHit)
		hisNumberOfHit = 2;
	
	var myDamages = 0 ;
	var hisDamages = 0 ;
	
	myDamages = myDamages + aHit(chanceOfHittingTheOpponent,damageMin,damageMax,myCritChance,opponentBlock,hisArmorMin,hisArmorMax);
	if(myNumberOfHit == 2)
		myDamages = myDamages + aHit(chanceOfHittingTheOpponent,damageMin,damageMax,myCritChance,opponentBlock,hisArmorMin,hisArmorMax);
	
	var hisDamages = hisDamages + aHit(chanceOfBeingHitten,opponentDamageMin,opponentDamageMax,hisCritChance,block,myArmorMin,myArmorMax);
	if(hisNumberOfHit == 2)
		hisDamages = hisDamages + aHit(chanceOfBeingHitten,opponentDamageMin,opponentDamageMax,hisCritChance,block,myArmorMin,myArmorMax);
	
	var array = new Array(myDamages,hisDamages,myNumberOfHit,hisNumberOfHit);
	
	// alert(chanceOfHittingTheOpponent+' '+damageMin+' '+damageMax+' '+myCritChance+' '+opponentBlock+' '+hisArmorMin+' '+hisArmorMax);
	// alert(chanceOfBeingHitten+' '+opponentDamageMin+' '+opponentDamageMax+' '+hisCritChance+' '+block+' '+myArmorMin+' '+myArmorMax);
	return array;
}

/*
	Return a random hit, it depends on your damages, his armor, his block, his resistance, etc... 
*/
function aHit(chanceOfHittingTheOpponent,damageMin,damageMax,myCritChance,opponentBlock,hisArmorMin,hisArmorMax){
	var myHit = 0;
	
	// if my hit touch my opponent
	var randomnumber1002 = Math.floor(Math.random()*101);
	if(randomnumber1002<chanceOfHittingTheOpponent){
		myHit = damageMin + Math.floor(Math.random()*(damageMax-damageMin+1));

		// critic ? 
		var randomnumber1003 = Math.floor(Math.random()*101);
		if(randomnumber1003<myCritChance)
			myHit = myHit*2;
		
		// block ? 
		var randomnumber1004 = Math.floor(Math.random()*101);
		if(randomnumber1004<opponentBlock)
			myHit = myHit/2;

		// armor
		var randomnumber1005 = hisArmorMin + Math.floor(Math.random()*(hisArmorMax-hisArmorMin+1));
		if(randomnumber1005<myHit)
			myHit = myHit-randomnumber1005;
		else
			myHit = 0;
	}
	
	return myHit;
}

//################################################################################################################################
//## MESSAGES / ????????
//################################################################################################################################
function messages(){
	/*var date=new Date();
	var hours=date.getHours();
	var serverHours = document.getElementById('header_game').getElementsByTagName('span')[6].innerHTML.match(/\d\d.\d\d.\d\d\d\d (\d+):\d\d/i)[1];
	var lostHours=hours*1-serverHours*1;*/
	document.getElementById('content').getElementsByTagName('div')[0].style.padding='0px';
	if(document.getElementsByTagName('input')[0]){document.getElementsByTagName('input')[0].parentNode.style.marginLeft='-6px';}
	
	var inputs = document.getElementsByTagName('input').length;
	var numberMSG = (inputs-3)/2;
	if(inputs==2){numberMSG=0;}
	
	if(document.getElementById('content').getElementsByTagName('div')[1].getAttribute('class')=='title2_box'){
		document.getElementsByTagName('form')[0].getElementsByTagName('div')[4].innerHTML += '('+numberMSG+')';
	}
	else{
		document.getElementsByTagName('form')[0].getElementsByTagName('div')[2].innerHTML += '('+numberMSG+')';
	}
	
	if(document.getElementById('content').getElementsByTagName('table')[0]){
		//START guildmates link from Tomas
		var guildMates = new Array();
		if(Get_Cookie("GCAOguildMates")){
			var temp = Get_Cookie("GCAOguildMates").split("#");
			var mate;
			for(var i=0; i < temp.length; i++){
				mate = temp[i].split("<");
				guildMates[mate[0]] = mate[1];
			}
		}
		//END guildmates link from Tomas
		
		var messagesHTML = document.getElementById('content').getElementsByTagName('table')[0].innerHTML;
		if(!navigator.userAgent.toLowerCase().match(/chrome/i)){messagesHTML = messagesHTML.replace(/class="tdn" valign="top" width="30/g, "class=\"tdn\" valign=\"top\" style=\"border:1px solid #af8e50;background-color:#ded8c6;padding:5px;\" width=\"16");}
		else{messagesHTML = messagesHTML.replace(/width="30%" class="tdn" valign="top"/g, "class=\"tdn\" valign=\"top\" style=\"border:1px solid #af8e50;background-color:#ded8c6;padding:5px;\" width=\"16%\"");}
		while(messagesHTML.match(/<td class="tdn">([^:]+): ([^>]+)<br>/i)){
			var nameline = messagesHTML.match(/<td class="tdn">([^:]+): ([^>]+)<br>/i);
			var firstsentence = nameline[1];
			var AuthorName = nameline[2];
			var name = nameline[2];
			//START guildmates link from Tomas
			if(guildMates[AuthorName] != null) { // if mate was found make a link
				AuthorName = "<a href=\""+GCAO_siteurl+"mod=player&p="+guildMates[AuthorName]+"&sh="+GCAO_secureCode+"\">"+AuthorName+'</a>';
			}
			messagesHTML = messagesHTML.replace(/<td class="tdn">([^:]+): ([^>]+)<br>/i, "<td class=\"tdn\"><u>"+firstsentence+":</u> <font color='black'><b>"+AuthorName+"</b></font><br>");
			//END guildmates link from Tomas
		}
		while(messagesHTML.match(/(\w+), (\d+.\d+.\d+) - (\d+:\d+:\d+)<.td>/i)){
			var day = messagesHTML.match(/(\w+), (\d+.\d+.\d+) - (\d+:\d+:\d+)<.td>/i)[1];
			var nday = messagesHTML.match(/(\w+), (\d+.\d+.\d+) - (\d+:\d+:\d+)<.td>/i)[2];
			var time = messagesHTML.match(/(\w+), (\d+.\d+.\d+) - (\d+:\d+:\d+)<.td>/i)[3];
			messagesHTML = messagesHTML.replace(/(\w+), (\d+.\d+.\d+) - (\d+:\d+:\d+)<.td>/i, day+"<br>"+time+"<br>["+nday+"]");
		}
		messagesHTML = messagesHTML.replace(/<td class="tdn">/gi, "<td class=\"tdn\" style=\"border:1px solid #af8e50;background-color:#ded8c6;padding:5px;width:449px;\">");
		if(navigator.userAgent.toLowerCase().match(/chrome/i)){var pre='span';}else{var pre='pre';}
		messagesHTML = messagesHTML.replace(/<textarea.cols..\d+..rows..\d+..class..input.>/gi, '<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/msg.png" style="position:absolute;margin-left:-29px;margin-top:-17px;"><div style="background:#DBCBA5;border-top:1px solid #AF8E50;border-bottom:1px solid #AF8E50;padding:5px;margin:5px -5px 5px -5px;"><'+pre+' width="60" style="margin:0px;line-height:15px;">').replace(/<\/textarea>/gi,'</'+pre+'></div>');
	
		
		
		
		
		//Message tags
		if(GM_getValue('bb', false) == true){
			while(messagesHTML.match(/\[img\](.+)\[#img\]/i)){
				var imagecode = messagesHTML.match(/\[img\](.+)\[#img\]/i);
				var img = imagecode[1].replace(/ /i, '');
				if(!img.match(/http:\/\//i)){img = 'http://' + img}
				messagesHTML = messagesHTML.replace(/\[img\](.+)\[#img\]/i, '<img src="' + img + '" />');
			}
			while(messagesHTML.match(/\[l\](.+)\[#l\]/i)){
				var linkcode = messagesHTML.match(/\[l\](.+)\[#l\]/i);
				var link = linkcode[1].replace(/ /g, '');
				var linkb = link;
				if(!link.match(/http:\/\//i)){link = 'http://' + link}
				if(!link.match(/</i)){
					messagesHTML = messagesHTML.replace(/\[l\](.+)\[#l\]/i, '<a href="' + link + '" trget="_blank"/>' + linkb + '</a>');
				}else if(!link.match(/\[l\]/i)){
					messagesHTML = messagesHTML.replace(/\[l\](.+)\[#l\]/i, '[link:<font color="red">Invalid Link</font>]' + linkcode[1] + '[#link:<font color="red">Invalid Link</font>]');
				}else{
					messagesHTML = messagesHTML.replace(/\[l\]/i, '[link:<font color="red">Invalid Format</font>]');
				}
			}
			while(messagesHTML.match(/\[v\](.+)\[#v\]/i)){
				var videocode = messagesHTML.match(/\[v\](.+)\[#v\]/i);
				if (videocode[1].length>80 , !videocode[1].match(/www\.youtube\.com\/watch/i)){
					messagesHTML = messagesHTML.replace(/\[v\](.+)\[#v\]/i, '[v:<font color="red">Invalid Link</font>]' + videocode[1] + '[#v:<font color="red">Invalid Link</font>]');
				}else{
					var video = videocode[1].replace(/ /g, '');
					var video = video.replace(/watch\?/i, '');
					var video = video.replace(/\=/i, '/');
					messagesHTML = messagesHTML.replace(/\[v\](.+)\[#v\]/i, '<center><object><embed src="' + video + '" type="application/x-shockwave-flash" width="400" height="250"></embed></object></center>');
				}
			}
			messagesHTML = messagesHTML.replace(/\[i\]/gi, "<i>").replace(/\[#i\]/gi, "</i>").replace(/\[b\]/gi, "<b>").replace(/\[#b\]/gi, "</b>").replace(/\[c\]/gi, "<center>").replace(/\[#c\]/gi, "</center>").replace(/\:\)/gi,'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/smile.png" align="absmiddle" style="position:relative;top:-2px;"/>').replace(/\:\(/gi,'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/sad.png" align="absmiddle" style="position:relative;top:-2px;"/>').replace(/\:D/gi,'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/biggrin.png" align="absmiddle" style="position:relative;top:-2px;"/>').replace(/;\)/gi,'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/wink.png" align="absmiddle" style="position:relative;top:-2px;"/>').replace(/8o/gi,'<img scr="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/w00t.png" align="absmiddle" style="position:relative;top:-2px;"/>').replace(/\:S/gi,'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/unsure.png" align="absmiddle" style="position:relative;top:-2px;"/>').replace(/\:P/gi,'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/tongue.png" align="absmiddle" style="position:relative;top:-2px;"/>').replace(/\^\^/gi,'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/squint.png" align="absmiddle" style="position:relative;top:-2px;"/>').replace(/\:\|/gi,'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/mellow.png" align="absmiddle" style="position:relative;top:-2px;"/>').replace(/\;\(/gi,'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/crying.png" align="absmiddle" style="position:relative;top:-2px;"/>').replace(/8\)/gi,'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/cool.png" align="absmiddle" style="position:relative;top:-2px;"/>').replace(/\?\(/gi,'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/confused.png" align="absmiddle" style="position:relative;top:-6px;"/>').replace(/8\|/gi,'<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/blink.png" align="absmiddle" style="position:relative;top:-2px;"/>');
		}
		document.getElementById('content').getElementsByTagName('table')[0].innerHTML = messagesHTML;
	}
	
	
		
		var arrayName = new Array();
		var arrayId = new Array();
		if(Get_Cookie("GCAOguildMates")){
			var temp = Get_Cookie("GCAOguildMates").split("#");
			var mate;
			for(var i=1; i < temp.length; i++){
				mate = temp[i].split("<");
				// arrayName[arrayName.length] = mate[0];
				// arrayId[arrayId.length] = mate[1];
				// var regexp = new RegExp(mate[0],"gi");
				// document.getElementById('content').innerHTML = document.getElementById('content').innerHTML.replace(regexp,"<a href=\""+GCAO_siteurl+"mod=player&p="+mate[1]+"&sh="+GCAO_secureCode+"\">"+mate[0]+'</a>');//"<a href=\""+GCAO_siteurl+"mod=player&p="+mate[1]+"&sh="+GCAO_secureCode+"\">"+mate[0]+'</a>');
			}
		}
}

function msgButtons(){
	var photoUpa='data:image/jpeg;base64,/9j/4AAQSkZJRgABAgEASABIAAD/4QCaRXhpZgAATU0AKgAAAAgABwESAAMAAAABAAEAAAEaAAUAAAABAAAAYgEbAAUAAAABAAAAagEoAAMAAAABAAIAAAExAAIAAAAMAAAAcgEyAAIAAAAUAAAAfgITAAMAAAABAAEAAAAAAAAAAABIAAAAAQAAAEgAAAABR0lNUCAyLjYuMTAAMjAxMTowMzoyMCAxNjo1ODowOAD/4QsxaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49J++7vycgaWQ9J1c1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCc/Pgo8eDp4bXBtZXRhIHhtbG5zOng9J2Fkb2JlOm5zOm1ldGEvJyB4OnhtcHRrPSdJbWFnZTo6RXhpZlRvb2wgOC4zNSc+CjxyZGY6UkRGIHhtbG5zOnJkZj0naHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyc+CgogPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9JycKICB4bWxuczp4bXA9J2h0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8nPgogIDx4bXA6Q3JlYXRvclRvb2w+TWljcm9zb2Z0IFdpbmRvd3MgUGhvdG8gVmlld2VyIDYuMS43NjAwLjE2Mzg1PC94bXA6Q3JlYXRvclRvb2w+CiA8L3JkZjpEZXNjcmlwdGlvbj4KPC9yZGY6UkRGPgo8L3g6eG1wbWV0YT4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKPD94cGFja2V0IGVuZD0ndyc/Pv/bAEMAAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAf/bAEMBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAf/AABEIABQAEwMBIgACEQEDEQH/xAAaAAEAAgMBAAAAAAAAAAAAAAAABgcEBQgJ/8QAJBAAAQUBAAEFAAMBAAAAAAAAAwECBAUGBwAIERITFBYXISL/xAAWAQEBAQAAAAAAAAAAAAAAAAAFBAj/xAArEQACAQEEBwkAAAAAAAAAAAABAgMABBESIQUTIjJBUcEjMVJhcXKBsdH/2gAMAwEAAhEDEQA/AN2C8sv5UfPxEoIcCDQY0UWMDnvMJX2fpxOSPIdJl3OEtXlKY06ZJlEkl+80lFKYqEVjXdT4ardcRZZYP9e3rIs2VVzSG5TxeYGDZwSgbZV04sPn73Bl17mossJQNLFexXKNDMRG+fnQKrol3e6Co5reUWW1NhQ4CIHT3YJZQ5+Kbn2TbKNXAijkK23H7oCCQiFGIRvk9xVGirLPQ/6VfUZ6c9pIvk7NgtLz7XSHF3uQuH6wcueZ4hfff01hMjyRwtPHKgivmS1JGuYSMgWzinDDso2DzEklnnnOkZIpI9mKDEGLteAwvF4GFbzeSAedaKldleNEgjkURBGdRgIYZkDHh68qtP1BUNK7qVkaJXUdYOZluZ2JIlXm6OpgJLsuY4+fPkxq+DTCix2Tp0mROd9Qh/aSS87xsIV7UeZPqEYZenynIIio7Fcmf7oEJEVX8lxDlVHjmqxUVVVURi/FqezW/wCIiePK45rRq07WU7C540z2R51MXTjZxf7h+1BqTRVNi2uvZ2IoDW0vOZ1ZcuPfdMqv0EhY/LwxmfHpugV0Rj3iiicRoQCC1/yUAgo74pa9N2J1PLGsPAZRVZYCG39Om7PJRP8AsbUcrS9Xcxzk+DV9nNVjlT4vY5iuarx4XakUISFAOufMC7hSD73z0Ncv9q7VotB0e5sy0eWr/esyMAUKBDtyRY0WnxtBTwxiJa3dnYEVIkACkJKnySkKr3/NGuaxrx48VjA1ceQ3E4DwrR57z6n7r//Z';
	var photoUpb='data:image/jpeg;base64,/9j/4AAQSkZJRgABAgEASABIAAD/4QCaRXhpZgAATU0AKgAAAAgABwESAAMAAAABAAEAAAEaAAUAAAABAAAAYgEbAAUAAAABAAAAagEoAAMAAAABAAIAAAExAAIAAAAMAAAAcgEyAAIAAAAUAAAAfgITAAMAAAABAAEAAAAAAAAAAABIAAAAAQAAAEgAAAABR0lNUCAyLjYuMTAAMjAxMTowMzoyMCAxNjo1OTozNwD/4QsxaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49J++7vycgaWQ9J1c1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCc/Pgo8eDp4bXBtZXRhIHhtbG5zOng9J2Fkb2JlOm5zOm1ldGEvJyB4OnhtcHRrPSdJbWFnZTo6RXhpZlRvb2wgOC4zNSc+CjxyZGY6UkRGIHhtbG5zOnJkZj0naHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyc+CgogPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9JycKICB4bWxuczp4bXA9J2h0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8nPgogIDx4bXA6Q3JlYXRvclRvb2w+TWljcm9zb2Z0IFdpbmRvd3MgUGhvdG8gVmlld2VyIDYuMS43NjAwLjE2Mzg1PC94bXA6Q3JlYXRvclRvb2w+CiA8L3JkZjpEZXNjcmlwdGlvbj4KPC9yZGY6UkRGPgo8L3g6eG1wbWV0YT4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKPD94cGFja2V0IGVuZD0ndyc/Pv/bAEMAAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAf/bAEMBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAf/AABEIABQAEwMBIgACEQEDEQH/xAAYAAEAAwEAAAAAAAAAAAAAAAAABgcIBP/EACIQAAIDAQEAAgIDAQAAAAAAAAMEAQIFBgcAExESCBQiFv/EABcBAQADAAAAAAAAAAAAAAAAAAQFCAn/xAAsEQACAQIDBAoDAAAAAAAAAAABAgMAERIhMQQTMlEiI0FCU2FicXKSwtHS/9oADAMBAAIRAxEAPwC5gbOhHTHw1a4aiKWHyQlgB4TzhmSf2OO5Y55Ya1+J07lKUrjbLN2C/cZiJKUsXmlbaW4vNtrKtFS/4Pbos4zmtkL5h5C2FPRSKCuhnulV4W1gto2rEtCIGpVr0m31/bSsVwr3WZ32ztbuV55s4vNdK9icMqLo9gLRRYSxuF5erJc9dYZ5rqj/AGgKd7/ZQQzRN7FmkT8lH8Nf4y+/+A9efbj13iOh4TqT2J2/Ka1+nG06W4x/duZDzYGKJ9EAkCLdtqbr6ycUS1JKcKmgvmEY1kgmmO3yRSR9GKHEGLtcBhcXAwjEbmwPOrGSOyvGiQo6rEEZ1BUhhmQMeH2Outsqsv3bEx59K0CrI4+cNvmvOnyK5vPZGWjDWh5xybzzC6KWQNUFHHWGHJ+oY/tuxY1x0IS9YfOj3cZp9HZmorzFuP8ALr/mAiJEzfy7jbTMXo7NJiZmZiKf5rH+a/iIiPj4hJdowJ183Cvej5Dzo918AfZf6qG4+9l6FM/bd43DLqN8/g/2mgbfomZ95E+T5xUZbr5Hc56tL3GsKSVCAYa3/aQiDE/iLPyfWbZDVJU4fmLTR8Q6/wBjovXGIiItSItNSenzW1o/SszFqzS34/F62pM1l8fAbSihbhQDv5BcDOwA/Zp0mo+X41mv2D2Hf3fQNbRJi8yj+c7lUhKJKapFl1srksLKUGMmns6L5JhVIP2EadYJcs3t+8VmKVfHx8kIwN3HkOBOz0iikC5yGvIV/9k%3D';
	var photoDowna='data:image/jpeg;base64,/9j/4AAQSkZJRgABAgEASABIAAD/4QCaRXhpZgAATU0AKgAAAAgABwESAAMAAAABAAEAAAEaAAUAAAABAAAAYgEbAAUAAAABAAAAagEoAAMAAAABAAIAAAExAAIAAAAMAAAAcgEyAAIAAAAUAAAAfgITAAMAAAABAAEAAAAAAAAAAABIAAAAAQAAAEgAAAABR0lNUCAyLjYuMTAAMjAxMTowMzoyMCAxNjo1ODoyNgD/4QsxaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49J++7vycgaWQ9J1c1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCc/Pgo8eDp4bXBtZXRhIHhtbG5zOng9J2Fkb2JlOm5zOm1ldGEvJyB4OnhtcHRrPSdJbWFnZTo6RXhpZlRvb2wgOC4zNSc+CjxyZGY6UkRGIHhtbG5zOnJkZj0naHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyc+CgogPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9JycKICB4bWxuczp4bXA9J2h0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8nPgogIDx4bXA6Q3JlYXRvclRvb2w+TWljcm9zb2Z0IFdpbmRvd3MgUGhvdG8gVmlld2VyIDYuMS43NjAwLjE2Mzg1PC94bXA6Q3JlYXRvclRvb2w+CiA8L3JkZjpEZXNjcmlwdGlvbj4KPC9yZGY6UkRGPgo8L3g6eG1wbWV0YT4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKPD94cGFja2V0IGVuZD0ndyc/Pv/bAEMAAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAf/bAEMBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAf/AABEIABQAEwMBIgACEQEDEQH/xAAaAAEAAgMBAAAAAAAAAAAAAAAABQcDBggJ/8QAIxAAAgMBAQACAgIDAAAAAAAAAgMBBAUGBwASCBEhIgkUM//EABgBAAIDAAAAAAAAAAAAAAAAAAQIAwUG/8QAKBEAAgECBQMDBQAAAAAAAAAAAQIDACEEESIxQRITcTOBsSNCUWLS/9oADAMBAAIRAxEAPwCapbenY6l3PZq8JFKlg8amnSqed+Z3TbNjh+RtPNztjg9Z7zad+1btOsMJrrEw6w6GmqC685Pj9x9aTnJ47ShgAX2veOeQPWMMfWWQtKr52TJgWyoYKUf9pXChJ8qj55yeieZc17Bs9FxfZVmznXsHgW1b6GLr6ONop8+5EqV/Pe43Ai3TsnLQF5trGLHLcBiazRN/gx/j7yPLOz0fUvXtnL7Xcwdi2rzHKYxp4WfVrsYip2Onn2ylTehu0njOdl2EuqYxlZusVZs2qsZyIGKKTBzYlsbNBIjsyxXYsG0jIqCOfyMtzTFzGRGiCwRSIYQpdclYMLkDqIPvcbjPiro/IHAxT9R0n083EzlXOX800GVcnmcTKz4uaPmXH3tB9ehQxV1K8XL9izcZClqljbDGsUtrDAXzN+QkMj0+19f2QzxXkxQQJL6TBeS8QX7GStyUj/P8EckZR/YyI5IpfJ48TiO2n1JjoW/Ut9Iv770IXXO+HGflf6rSMbocjTjO3tDh+ffr2+a5wbdxO96ZmTYOhx3NUlPKvj+gZ1RbWKSMtmuhK5YREtaomBG18f2Esi2qavAcqUrvioP9jqPaHxAsOIKSBnrEgyZmZP6sE1yczJBP7mJfHyqn+4cZG3G44o0+p4J+DXL/ALT7X0W/6NsaJ4fLZgxmcjnIoZtTXmlVp4vG8/jUVJLS29G8cxToIlrbV2w1rpYwj/vAi+Pj5oIkXtR6R6acfotBnc+T81//2Q%3D%3D';
	var photoDownb='data:image/jpeg;base64,/9j/4AAQSkZJRgABAgEASABIAAD/4QCaRXhpZgAATU0AKgAAAAgABwESAAMAAAABAAEAAAEaAAUAAAABAAAAYgEbAAUAAAABAAAAagEoAAMAAAABAAIAAAExAAIAAAAMAAAAcgEyAAIAAAAUAAAAfgITAAMAAAABAAEAAAAAAAAAAABIAAAAAQAAAEgAAAABR0lNUCAyLjYuMTAAMjAxMTowMzoyMCAxNzowMDowNQD/4QsxaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49J++7vycgaWQ9J1c1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCc/Pgo8eDp4bXBtZXRhIHhtbG5zOng9J2Fkb2JlOm5zOm1ldGEvJyB4OnhtcHRrPSdJbWFnZTo6RXhpZlRvb2wgOC4zNSc+CjxyZGY6UkRGIHhtbG5zOnJkZj0naHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyc+CgogPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9JycKICB4bWxuczp4bXA9J2h0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8nPgogIDx4bXA6Q3JlYXRvclRvb2w+TWljcm9zb2Z0IFdpbmRvd3MgUGhvdG8gVmlld2VyIDYuMS43NjAwLjE2Mzg1PC94bXA6Q3JlYXRvclRvb2w+CiA8L3JkZjpEZXNjcmlwdGlvbj4KPC9yZGY6UkRGPgo8L3g6eG1wbWV0YT4KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKPD94cGFja2V0IGVuZD0ndyc/Pv/bAEMAAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAf/bAEMBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAf/AABEIABQAEwMBIgACEQEDEQH/xAAZAAEAAgMAAAAAAAAAAAAAAAAABwgDBQb/xAAiEAACAwEBAAICAwEAAAAAAAACAwEEBQYHABIhIggRFBP/xAAYAQACAwAAAAAAAAAAAAAAAAAEBQMICf/EACkRAAIBAwIFAgcAAAAAAAAAAAECAwARISJBBBITMTNRgVRicZHC0dL/2gAMAwEAAhEDEQA/AJlp7Oi/pXYWevFRSp4nIqqVKvBed2zbL+M5Wy82u1uJ1HPJhXbNqy17Ja18w57oaaxK1PMcpsvrSc5fJaEMAC+13yXylyxhj6y5hpV+CJn9C2VD9pR+WyuFCT5V8oD3vnPPer6+/wAh1tZk593E4d1a8k1ov5N9XCctNO7Rc02im1UsHLRhxNrmLHLcJCazTt/4X/wUyvNOu0PSvVNbN7DZw9a0rznMYbTxaFZDDTV6zSoWSlTN65TcP+DNeptXIMrNw1WLFqtGfmH0opOEl4luMmhdHLLFluYNpFioIvn1Fu5qx0pdGiCwxyJ0QpcWUhhkgXIPvkXuL7VL3uuJlF6ToOp52PQVa5vzu8dbM53HzKMW7/nPKXbzq9GljrrIi3esWLZwta5Y15tYtbGGAvmX3eDj0ez9YIonkPLyggVMBMF5dxpfr9rMlI/n8EckZR+xkRzJS+SJxM3ImqVtK55hnAz2370Nc/Dp90/quMx9/K0oo7l7jMJ+ra57nxs207foudLzpcpztNb5Rld1QqraalCTZQhS/wDoREta4mBGUsn1ecuysq3D8yUrvCsP9HR+vPiIYYwUkJ+nyLJmZkvqwSCSmZIJ+0xL4+L58Hl29Nuw2opvJ7n8qrb7B7Dv7foGtfLG5rPEc7ls9FLPqas1K1TH5PDyKa1FobN+6cxUoplrbNyw1rpYwj/b6w+Pj46iRelFpHjTb5VoJjqb6nYfqv/Z';
	var buttonsElement = document.createElement('div');
	buttonsElement.setAttribute('id', 'buttonsElementUP');
	buttonsElement.setAttribute('style', 'position:absolute;z-index:150;top:312px;left:378px;');
	buttonsElement.innerHTML="<div id=\"buttonsElement\" style=\"position:fixed;\"><table cellpadding=\"0px\" cellspacing=\"0px\"><tr><td><a onclick=\"window.scrollTo(0,0);\"><img style=\"cursor:pointer;\" src=\""+photoUpa+"\" onmouseover=\"this.src='"+photoUpb+"'\" onmouseout=\"this.src='"+photoUpa+"'\"/></a></td></tr><tr><td><a onclick=\"window.scrollBy(0,document.body.scrollHeight)\"><img style=\"cursor:pointer;\" src=\""+photoDowna+"\" onmouseover=\"this.src='"+photoDownb+"'\" onmouseout=\"this.src='"+photoDowna+"'\"/></a></td></tr></table></div>";
	document.getElementById('header_game').appendChild(buttonsElement);
}

//################################################################################################################################
//## ITEMS THAT YOU CAN BUY / ??????????? ??? ??????S ?? ?G???S??S
//################################################################################################################################
function afford(){
	if(document.getElementById('shop')){
		var item=document.getElementById('shop').getElementsByTagName('div')[1].id.match(/.\d+/i);
		
		var gold=document.getElementById('sstat_gold_val').innerHTML.replace(/\./g,'').match(/\d+/i)*1;
		var rubi=document.getElementById('sstat_ruby_val').innerHTML.replace(/\./g,'').match(/\d+/i)*1;
		for (i = 0; i <=6; i++){
			for (j = 0; j <=8; j++){
				if(document.getElementById('tOoLtIp_'+item+'_'+i+'_'+j)){
					if(document.getElementById('tOoLtIp_'+item+'_'+i+'_'+j).innerHTML.replace(/\./gi,'').match(/(\d+) <img[^\/]+\/img\/res3/i)){
						document.getElementById(item+'_'+i+'_'+j).style.background='rgba(255, 0, 0, 0.2)';
						if(document.getElementById('tOoLtIp_'+item+'_'+i+'_'+j).innerHTML.replace(/\./gi,'').match(/(\d+) <img[^\/]+\/img\/res3/i)[1]*1>rubi*1){
							document.getElementById(item+'_'+i+'_'+j).style.opacity='0.25';
						}
					}
					else{
						document.getElementById(item+'_'+i+'_'+j).style.opacity='1.00';
					}
					
					if(document.getElementById('tOoLtIp_'+item+'_'+i+'_'+j).innerHTML.replace(/\./gi,'').match(/(\d+) <img[^\/]+\/img\/res2/i)){
						if(document.getElementById('tOoLtIp_'+item+'_'+i+'_'+j).innerHTML.replace(/\./gi,'').match(/(\d+) <img[^\/]+\/img\/res2/i)[1]*1>gold*1){
							document.getElementById(item+'_'+i+'_'+j).style.opacity='0.25';
						}
					}
					else{
						document.getElementById(item+'_'+i+'_'+j).style.opacity='1.00';
					}
				}
			}
		}
	}
}
function reAfford(){
	var oldSetToolTip = unsafeWindow.SetToolTip;
	unsafeWindow.SetToolTip = function (updateTooltip){
		if(updateTooltip){setTimeout(afford, 900);}
		return oldSetToolTip(updateTooltip);
	}
}

//################################################################################################################################
//## GUILD STORAGE INFO / ?????F????S S??? ???T??? ??G????S
//################################################################################################################################
function storageInfo(){
	if(document.getElementById('shop')){
		var storage = document.getElementById('shop').parentNode.parentNode;
		var storageValue = document.createElement('div');
		storageValue.setAttribute('class','contentItem');
		storageValue.setAttribute('style','width:212px;margin-top:8px;');
		storageValue.innerHTML = '<h3 style="width:188px;height:20px;">'+L_StorageInfo+'</h3><div class="contentItem_content" style="width:180px;"><p> '+L_itemNum+' : <b id="itemNumber"></b><br/>'+L_TotalValue+' : <b id="storageValue"></b> <img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/res2.gif"/></p></div>';
		storage.appendChild(storageValue);
		getStorageInfo();
	}
}

function getStorageInfo(){
	if(document.getElementById('shop')){
		var value = 0;
		var number = 0;
		var totalNumber = 0;
		var c=2;
		var stop=false;
		while(stop==false && c<10){
			if(document.getElementById('p35'+c+'_1_1')){
				stop = true;
				var x = c;
			}
			c++;
		}
		for (i = 0; i <=6; i++){
			for (j = 0; j <=8; j++){
				if(document.getElementById('tOoLtIp_p35'+x+'_'+i+'_'+j) && document.getElementById('p35'+x+'_'+i+'_'+j)){
					totalNumber++;
					if(document.getElementById('p35'+x+'_'+i+'_'+j).getAttribute('style').match(/visible/i)){
						value += document.getElementById('tOoLtIp_p35'+x+'_'+i+'_'+j).innerHTML.replace(/\./gi,'').match(/(\d+) <img[^\/]+\/img\/res2/i)[1]*1;
						number++;
					}
				}
			}
		}
		document.getElementById('itemNumber').innerHTML = number+' / '+totalNumber;
		document.getElementById('storageValue').innerHTML = dottedNumber(value);
	}
}

function resetStorageInfo(){
	var oldSetToolTip = unsafeWindow.SetToolTip;
	unsafeWindow.SetToolTip = function (updateTooltip){
		if(updateTooltip){setTimeout(getStorageInfo, 900);}
		return oldSetToolTip(updateTooltip);
	}
}

//################################################################################################################################
//## STYLE FIXES / ??O?TOS??S ??? STYLE
//################################################################################################################################
function styleFixes(){
	var StyleFixesElement = document.createElement('div');
	StyleFixesElement.innerHTML="<style>.paging_button{height:26px;} ul#mainnav li a {line-height: 10px;padding-top:14px;} .selection {width:130px;}</style>";
	document.getElementById('header_game').appendChild(StyleFixesElement);
	
	if(document.getElementById('ticker1')){//Buttom while traveling fix
		document.getElementsByTagName('input')[0].setAttribute('class','button1');
	}
	else if(GCAO_mod=='guild_library' && GCAO_submod=='noSubmod'){
		if(document.getElementsByTagName('b')[3].innerHTML=='?p???a??sµ???(?)'){
			document.getElementsByTagName('b')[3].innerHTML = '?p???.';
		}
	}
	else if(GCAO_mod=='guild_main' && GCAO_submod=='noSubmod'){
		if(document.getElementById('mainbox').getElementsByTagName('td')[1]){
			document.getElementById('mainbox').setAttribute('style','max-width: 600px; overflow: hidden; width: 530px;margin-left:-16px;');
		}
	}
	
}

//################################################################################################################################
//## AUCTION / ????????????
//################################################################################################################################

//Number of items and bids / ????µ?? a?t??e?µ???? ?a? p??sf????
function auctionnumbers() {
	if(document.getElementById('auction_table')){
		var rows = document.forms.length - 1;
		var links = document.getElementById('auction_table').getElementsByTagName('a').length - rows;
	
		var numbersDiv = document.createElement('div');
		numbersDiv.setAttribute('id', 'mystylecolor');
		numbersDiv.setAttribute('class', 'title2_box');
		numbersDiv.setAttribute('style', 'margin-left:-17px;margin-right:-17px;margin-top:20px;');
		numbersDiv.innerHTML = '<div class=\"title_inner\"><center>'+L_itemNum+': ' + rows + '<br>'+L_bidNum+': ' + links + '</center></div>';
		document.getElementById('auction_filter').appendChild(numbersDiv);
	}
}

//Background color / ???µa pa?as??????
function auctionbgcolor() {
	var rows = document.forms.length - 1;
	
	if(document.getElementById('auction_table')){
		var colorcss = '';
		if (rows<=180){
			var x=0;
			while(!document.body.getElementsByTagName('script')[x].innerHTML.match('AddCharDiv') && (x<100)){x++;}
			var contentHTML = document.getElementsByTagName('script')[x].innerHTML;
			
			var itemboxa = contentHTML.match(/"auction_\d+"/gi);
			var srccol = /\d.........................................................................................................................................................................................................Tahoma;\\'><tr><td style\=\\'color:(....)/gi;
			var colorbox = contentHTML.match(srccol);
			var itemcode,color,RGBcolor;
			
			for (i = 0; i <rows; i++){
				itemcode = itemboxa[i].match(/auction_\d+/gi);
				color = colorbox[i].match(/color:..../gi);
				if (color=='color:lime'){RGBcolor = '0, 255, 0, 0.1'}
				else if (color=='color:#515'){RGBcolor = '0, 70, 255, 0.2'}
				else if (color=='color:#E30'){RGBcolor = '227, 3, 224, 0.2'}
				else if (color=='color:#FF6'){RGBcolor = '255, 106, 0, 0.2'}
				else if (color=='color:whit'){RGBcolor = '255, 255, 255, 0.2'}
				else{RGBcolor = '90, 156, 255, 0.2'}
		
				colorcss = colorcss + '#' + itemcode + '{background: rgba(' + RGBcolor + ');}';
			}
		var colorStyleDiv = document.createElement('div');
		colorStyleDiv.setAttribute('id', 'mystylecolor');
		colorStyleDiv.innerHTML = '<style type="text/css">' + colorcss + '</style>';
		document.getElementById('auction_filter').appendChild(colorStyleDiv);
		}
	}
}

//More levels at search / ??a??t???te?a ep?peda st?? a?a??t?s?
function auctionitemlevel() {
		var minlevel = document.getElementById('auction_filter').innerHTML.match(/option value\="(\d+)/i)[1];
		var OL2result = document.getElementsByName('fl')[0].innerHTML.match(/option value\="(\d+)/g);
		var found = false;
		
		var lvl = document.getElementById('icon_level').parentNode.getElementsByTagName('div')[1].innerHTML*1;
		var addedLevel = lvl * 0.25;
		var plusToInteger = addedLevel;
		var addFix = 0;
		while (plusToInteger > 1){plusToInteger = plusToInteger-1;}
		if (plusToInteger > 0.24){addFix = 1;}
		addedLevel = addedLevel-plusToInteger;
		if (lvl>36){var maxlevel = lvl+14;}
		else{var maxlevel = lvl+addedLevel+5+addFix;}
		
		var is = maxlevel-minlevel+1;
		var option = "";
		for (i = 0; i <is; i=i+2){
			var fnumber = -(is-maxlevel-i-1);
			if(document.getElementsByName('fl')[1]){
				var selectedlevel = document.getElementsByName('fl')[1].value;
			}
			if(selectedlevel == null){selectedlevel = minlevel}
			if(fnumber==selectedlevel){var OptSelect = 'selected="selected"'}
			else{var OptSelect = ""}
			option = option + '<option value="' + fnumber + '" ' + OptSelect + '>' + fnumber + '+</option>' ;
		}
		document.getElementsByName('fl')[0].innerHTML = option ;
}

//Autofill inputs / ?????te?? p??sf??? µ?sa st? input
function autoFillAuctionFields(){
	var divs = document.evaluate(".//div[@class='auction_bid_div']",document.getElementById('content'),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
	if(divs.snapshotLength) {
		for(var i = 0; i < divs.snapshotLength; i++) {
			if(!divs.snapshotItem(i).innerHTML.match(/: ([0-9]*\.*[0-9]*) <"/i)){
				var price = divs.snapshotItem(i).innerHTML.match(new RegExp(": ([0-9]*\.*[0-9]*) <"));
				if(!price) continue;
				price = price[1].replace(/\./g, "");
				var input = document.evaluate(".//input[@name='bid_amount']", divs.snapshotItem(i), null, XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE, null);
				if(input.snapshotLength){input.snapshotItem(0).value = price;}
			}
		}
	}
}

//Items where you can hide gold
function howToHideGoldInAuctions(){
	var rows = document.forms.length - 1;
	var divs = document.evaluate(".//div[@class='auction_bid_div']",document.getElementById('content'),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
	
	if(document.getElementById('auction_table')){
		var colorcss = '';
		if (rows<=180){
			if(document.getElementsByTagName('script')[10].innerHTML.match('auction_')){var contentHTML = document.getElementsByTagName('script')[10].innerHTML;}
			else if(document.getElementsByTagName('script')[11].innerHTML.match('auction_')){var contentHTML = document.getElementsByTagName('script')[11].innerHTML;}
			else if(document.getElementsByTagName('script')[12].innerHTML.match('auction_')){var contentHTML = document.getElementsByTagName('script')[12].innerHTML;}
			else if(document.getElementsByTagName('script')[13].innerHTML.match('auction_')){var contentHTML = document.getElementsByTagName('script')[13].innerHTML;}
			
			var itemboxa = contentHTML.match(/"auction_\d+"/gi);
			var srccol = /\d.........................................................................................................................................................................................................Tahoma;\\'><tr><td style\=\\'color:(....)/gi;
			var colorbox = contentHTML.match(srccol);
			var itemcode,color;
			
			for (var i = 0; i <rows; i++){
				itemcode = itemboxa[i].match(/auction_\d+/gi);
				color = colorbox[i].match(/color:..../gi);
				var rubis = divs.snapshotItem(i).innerHTML.split('&nbsp;')[1].split('<a')[0];
				
				//No bid
				if(divs.snapshotItem(i).getElementsByTagName('a').length==1){
					var rubis = divs.snapshotItem(i).innerHTML.split('&nbsp;')[1].split('<a')[0];
					if (color=='color:#515'){var rubisMin = 46;}
					else if (color=='color:lime'){var rubisMin = 40;}
					else if (color=='color:#E30'){var rubisMin = 52;}//purple
					else if (color=='color:whit'){var rubisMin = 40;}

					if(parseInt(rubis)>=rubisMin)
						divs.snapshotItem(i).getElementsByTagName('input')[0].style.backgroundColor="#FFCC66";
				}
				// alert(color+'   '+rubisMin);
			}
		}
	}
}

//################################################################################################################################
//## ITEM LIST / ??S?? ??????????O?
//################################################################################################################################
function itemList(){
	//Param string with options "n[name]v[value]c[color]|n[name1]v[value1]c[color1]..." v[value] and c[color] are optional
	//USE THE COLORS: 
	//Items names: [for green items: #0D960D] [for pink items: #E303E0] [for blue items: #0046FF]
	//Upgrades: blue, yellow, green, purple, red, orange (yellow and orange will auto change by script so you can read the letters in game)
	if(GCAO_lang=='fr'){
		var prefixList = 'n[Adendathiels]|n[Amelias]|n[Amoviels]|n[Anchorons]|n[Appius]|n[Asayseths]|n[Asendacs]|n[Ashitills]|n[Bacias]|n[Barbekuus]|n[Beasthammers]|n[Berrys]|n[Bilgs]|n[Calodiens]c[#0D960D]|n[Chabdyns]|n[Chalinis]|n[Chealoths]|n[Cheggovs]|n[Chucks]|n[Ciallans]|n[Cisiens]|n[Dairus]|n[Decimus]|n[Denovs]|n[Dexterus]|n[Doitrems]|n[Doomeniks]|n[Elrarangs]|n[Elvilmandels]|n[Elywens]|n[Evotavs]|n[Fernabasts]|n[Fitschis]|n[Frabos]|n[Frickoys]|n[Frientas]|n[Fustriels]|n[Gadriewens]|n[Gaius]c[#E303E0]|n[Galarands]|n[Gidras]|n[Gonaks]|n[Granks]|n[Grasscrawlers]|n[Heudois]|n[Heuhois]|n[Ibiwans]|n[Ichorus]c[#E303E0]|n[Ismaels]|n[Isundels]|n[Jennifers]|n[Kedyssis]|n[Kerrannas]|n[Korks]|n[Kosmonas]|n[Leandronimus]|n[Liloels]|n[Lothays]|n[Lucius]c[#E303E0]|n[Lulus]|n[Lurtscharas]|n[Mandalus]|n[Manius]|n[Marcus]|n[Matéus]c[#E303E0]|n[Medonis]|n[Melanchaetas]|n[Melaneos]|n[Mermereus]|n[Mimas]|n[Monychustas]|n[Mooncruchers]|n[Nariths]|n[Opiehnzas]c[#E303E0]|n[Orlelds]|n[Peragos]|n[Phalangens]|n[Poirins]|n[Purmanns]|n[Rakrests]|n[Rayols]|n[Redos]|n[Reinkes]|n[Ronaldas]|n[Rynightes]|n[Sentarions]|n[Servius]|n[Sextus]|n[Shivas]|n[Skiterus]|n[Solitanis]|n[Sphingens]|n[Spurius]|n[Stoybaers]|n[Sugos]|n[Taliths]c[#0046FF]|n[Tanias]|n[Tantus]c[#E303E0]|n[Thorstens]|n[Tinothiels]|n[Titus]|n[Trafans]c[#0046FF]|n[Tuneses]|n[Umbros]|n[Umfetas]|n[Umilawens]|n[Uridos]|n[Urothiens]|n[Vuthiels]|n[Watzmanns]|n[Xenphlames]|n[Xus]|n[Yas]|n[Zeindras]c[#0D960D]|n[Zickezackes]|n[Zimbris]|n[Zombers]';
		var suffixList = 'n[Agression]|n[Assassinat]|n[Delicatesse]|n[Dragon]|n[Elimination]|n[Enfer]|n[Paradis]';
		var foodList = '';
		var tempImpList = '';
		var impList = '';
	}else if(GCAO_lang=='gr'){
		var prefixList='n[Adendathiels]|n[Amelias]|n[Amoviels]|n[Anchorons]|n[Appius]|n[Asayseths]|n[Asendacs]|n[Ashitills]|n[Bacias]|n[Barbekuus]|n[Beasthammers]|n[Berrys]|n[Bilgs]|n[Calodiens]c[#0D960D]|n[Chabdyns]|n[Chalinis]|n[Chealoths]|n[Cheggovs]|n[Chucks]|n[Ciallans]|n[Cisiens]|n[Dairus]|n[Decimus]|n[Denovs]|n[Dexterus]|n[Doitrems]|n[Doomeniks]|n[Elrarangs]|n[Elvilmandels]|n[Elywens]|n[Evotavs]|n[Fernabasts]|n[Fitschis]|n[Frabos]|n[Frickoys]|n[Frientas]|n[Fustriels]|n[Gadriewens]|n[Gaius]c[#E303E0]|n[Galarands]|n[Gidras]|n[Gonaks]|n[Granks]|n[Grasscrawlers]|n[Heudois]|n[Heuhois]|n[Ibiwans]|n[Ichorus]c[#E303E0]|n[Ismaels]|n[Isundels]|n[Jennifers]|n[Kedyssis]|n[Kerrannas]|n[Korks]|n[Kosmonas]|n[Leandronimus]|n[Liloels]|n[Lothays]|n[Lucius]c[#E303E0]|n[Lulus]|n[Lurtscharas]|n[Mandalus]|n[Manius]|n[Marcus]|n[Mateus]c[#E303E0]|n[Medonis]|n[Melanchaetas]|n[Melaneos]|n[Mermereus]|n[Mimas]|n[Monychustas]|n[Mooncruchers]|n[Nariths]|n[Opiehnzas]c[#E303E0]|n[Orlelds]|n[Peragos]|n[Phalangens]|n[Poirins]|n[Purmanns]|n[Rakrests]|n[Rayols]|n[Redos]|n[Reinkes]|n[Ronaldas]|n[Rynightes]|n[Sentarions]|n[Servius]|n[Sextus]|n[Shivas]|n[Skiterus]|n[Solitanis]|n[Sphingens]|n[Spurius]|n[Stoybaers]|n[Sugos]|n[Taliths]c[#0046FF]|n[Tanias]|n[Tantus]c[#E303E0]|n[Thorstens]|n[Tinothiels]|n[Titus]|n[Trafans]c[#0046FF]|n[Tuneses]|n[Umbros]|n[Umfetas]|n[Umilawens]|n[Uridos]|n[Urothiens]|n[Vuthiels]|n[Watzmanns]|n[Xenphlames]|n[Xus]|n[Yas]|n[Zeindras]c[#0D960D]|n[Zickezackes]|n[Zimbris]|n[Zombers]|n[?a?µ???f????de?]';
		var suffixList='n[? ?ata?e?µat?sµ?? t??]|n[??T???????S]|n[?ated?f?s? t??]|n[???eµ???? te????]|n[??? a?t?d?????s??]|n[??? p??se????]|n[??? d?at??µat??]|n[t?? a?a???e?a?]|n[t?? a???e?a?]|n[t?? a???aµ???]|n[t?? a??p?as??]|n[t?? a?ap?d?as??]|n[t?? a?d????? ta?t?t?ta?]|n[t?? a?e?a?t?s?a?]|n[t?? ap???????]|n[t?? a?µ???a?]|n[t?? ß?a??t?ta?]|n[t?? ?e??a??d???a?]|n[t?? ???]|n[t?? d?aµ????]|n[t?? d???f???a?]|n[t?? d??aµ??]|n[t?? e?e??e??a?]|n[t?? ?p??es??]|n[t?? ep?t???a?]|n[t?? ep??e???µat???t?ta?]|n[t?? et??µ?t?ta?]|n[t?? e????e?a?]c[rgb(0, 70, 255)]|n[t?? ??a??p???s??]|n[t?? ????se??]c[rgb(0, 70, 255)]|n[t?? ?atast??f??]|n[t?? µa??te?a?]|n[t?? µ????]|n[t?? µe?a??p??pe?a?]|n[t?? µ??????a?]|n[t?? ??e?ßas?a?]|n[t?? p?st??]|n[t?? p???t?t??]|n[t?? p???????]|n[t?? p??sß????]|n[t?? p??stas?a?]|n[t?? s??p??]|n[t?? s????s??]|n[t?? ta?a???]|n[t?? ?e?et??]|n[t?? t???a?]|n[t?? ?????]|n[t?? ?p?s?es??]|n[t?? ?p?????s??]|n[t?? ???]|n[t?? ßapt?sµat??]|n[t?? eµp?d???]|n[t?? e?d?af????t??]|n[t?? e??????sµ??]|n[t?? ?????]|n[t?? ??µat??]|n[t?? µp???a??sµat??]|n[t?? pa?ade?s??]c[rgb(0, 70, 255)]|n[t?? fe??a????]|n[t?? ?ata?aµ????]|n[t?? t?a?µ?t??  ]|n[of Chakra]';
		var foodList='n[??t?p????]|n[???a?]|n[????]|n[?pa???e?]|n[?p?????a]|n[????]|n[F??t?? ????]|n[????]|n[??µ???]|n[??µ?]';
		var tempImpList='n[?e?????a?a]|n[???????a d??aµ??]v[d??aµ??]c[blue]|n[???????a ??a??t?ta?]v[??a??t?ta?]c[yellow]|n[???????a ep?de???t?ta?]v[ep?de???t?ta?]c[green]|n[???????a f?s???? ?at?stas??]v[f?s???? ?at?stas??]c[#FF7F00]|n[???????a ?a??sµat??]v[?a??sµat??]c[purple]|n[???????a e??p??da?]v[e??p??da?]c[red]n[???a ap? t????a]';
		var impList='n[???p??sµ??]|n[??t???? p??d?a]c[yellow]|n[??????? p??d?a]c[red]|n[?p?? p??d?a]c[blue]|n[????pet?a]|n[??ß p??d?a]c[purple]|n[???t??a?? p??d?a]c[#FF7F00]|n[???s??? p??d?a]c[green]|n[Sf??????? ?a?a??sµat??]';
	}else if(GCAO_lang=='cr'){
		var prefixList = 'n[Ichoruovo]|n[Opiehnzovo]|n[Talethovo]|n[Trafanovo]|n[Luciusovo]|n[Tantusovo]|n[Gaiovo]|n[Mateovo]|n[Marcusovo]|n[Adendathielovo]|n[Ameliovo]|n[Amovielovo]|n[Anchoronsovo]|n[*Appius]|n[Asaysethovo]|n[Asendakovo]|n[Ashitillovo]|n[Baciasovo]|n[Barbekuusovo]|n[*Beasthammers]|n[Berryho]|n[Bilgovo]|n[*Calodiens]|n[Chabdynovo]|n[Chaliniovo]|n[*Chealoths]|n[Cheggovsovo]|n[Chuckovo]|n[Ciallanovo]|n[Cisienovo]|n[*Decimus]|n[*Denovs]|n[Dexterovo]|n[Doitremovo]|n[*Doomeniks]|n[Elrarangovo]|n[Elvilmandelovo]|n[Elywenovo]|n[Evotavovo]|n[Fernabastovo]|n[Fitschisovo]|n[Fraboovo]|n[Frickoysovo]|n[Fustrielsovo]|n[Galarandovo]|n[Gidrasovo]|n[Gonakovo]|n[Grankovo]|n[*Grasscrawlers]|n[Heudoisovo]|n[Heuhoisovo]|n[Ibiwanovo]|n[Isundelovo]|n[Jenniferino]|n[Kedyssiovo]|n[Kerrannasovo]|n[Korksovo]|n[Kosmonasovo]|n[Leandronimusovo]|n[Liloelsovo]|n[Lothayovo]|n[Lulusovo]|n[Lurtscharasovo]|n[*Manius]|n[Medonisovo]|n[Melaneosovo]|n[*Mermereus]|n[Mimasovo]|n[*Monychustas]|n[*Mooncruchers]|n[Narithovo]|n[Orleldovo]|n[Peragovo]|n[Phalangensovo]|n[*Poirins]|n[Purmannsovo]|n[Rakrestovo]|n[Rayolovo]|n[Redosovo]|n[Reinkesovo]|n[Ronaldasovo]|n[Rynightovo]|n[Sentarionsovo]|n[*Servius]|n[Sextovo]|n[Shivasovo]|n[*Skiterus]|n[Sphingensovo]|n[Spuriovo]|n[Stoybaersovo]|n[Sugovo]|n[Thorstenovo]|n[*Tinothiels]|n[Tûnêsésovo]|n[Umbrosovo]|n[Umfetasovo]|n[Umilawenovo]|n[Uridovo]|n[Uróthienovo]|n[Vuthielovo]|n[Xenphlamesovo]|n[Xusovo]|n[Yasovo]|n[Zickezackesovo]|n[Zimbrisovo]|n[Lulusovo]|n[Zeindrovo]';
        var suffixList = 'n[nebes]|n[pekla]|n[výhody]|n[rozkoše]|n[harmonie]|n[zeme]|n[draka]|n[kritického zásahu]|n[smrti]|n[lásky]';
        var foodList = 'n[Pecivo]v[chleb]|n[Jablko]|n[Banány]|n[Kure]';
        var tempImpList = 'n[Lahve charismatu]v[charisma]c[purple]|n[Lahve dovednosti]v[bystrost]c[yellow]|n[Lahve obratnosti]v[obratnost]c[green]|n[Lahve síly]v[síly]c[blue]|n[Lahve inteligence]v[inteligence]c[red]|n[Lahve odolnosti]v[odolnosti]c[orange]';
        var impList = 'n[Brousek]|n[Ochranné vybavení]c[#4C3430]|n[Houba]c[grey]|n[Fialový prach]c[purple]|n[Žlutý prach]c[yellow]|n[Modrý prášek]c[blue]|n[Rudý prášek]c[red]|n[Oranžový prach]c[orange]';
	}else if(GCAO_lang=='us' || GCAO_lang=='com'){
		var prefixList = 'n[Adendathiels]|n[Amelias]|n[Amoviels]|n[Anchorons]|n[Appius]|n[Asayseths]|n[Asendacs]|n[Ashitills]|n[Bacias]|n[Barbekuus]|n[Beasthammers]|n[Berrys]|n[Bilgs]|n[Calodiens]c[#0D960D]|n[Chabdyns]|n[Chalinis]|n[Chealoths]|n[Cheggovs]|n[Chucks]|n[Ciallans]|n[Cisiens]|n[Dairus]|n[Decimus]|n[Denovs]|n[Dexterus]|n[Doitrems]|n[Doomeniks]|n[Elrarangs]|n[Elvilmandels]|n[Elywens]|n[Evotavs]|n[Fernabasts]|n[Fitschis]|n[Frabos]|n[Frickoys]|n[Frientas]|n[Fustriels]|n[Gadriewens]|n[Gaius]c[#E303E0]|n[Galarands]|n[Gidras]|n[Gonaks]|n[Granks]|n[Grasscrawlers]|n[Heudois]|n[Heuhois]|n[Ibiwans]|n[Ichorus]c[#E303E0]|n[Ismaels]|n[Isundels]|n[Jennifers]|n[Kedyssis]|n[Kerrannas]|n[Korks]|n[Kosmonas]|n[Leandronimus]|n[Liloels]|n[Lothays]|n[Lucius]c[#E303E0]|n[Lulus]|n[Lurtscharas]|n[Mandalus]|n[Manius]|n[Marcus]|n[Mateus]c[#E303E0]|n[Medonis]|n[Melanchaetas]|n[Melaneos]|n[Mermereus]|n[Mimas]|n[Monychustas]|n[Mooncruchers]|n[Nariths]|n[Opiehnzas]c[#E303E0]|n[Orlelds]|n[Peragos]|n[Phalangens]|n[Poirins]|n[Purmanns]|n[Rakrests]|n[Rayols]|n[Redos]|n[Reinkes]|n[Ronaldas]|n[Rynightes]|n[Sentarions]|n[Servius]|n[Sextus]|n[Shivas]|n[Skiterus]|n[Solitanis]|n[Sphingens]|n[Spurius]|n[Stoybaers]|n[Sugos]|n[Taliths]c[#0046FF]|n[Tanias]|n[Tantus]c[#E303E0]|n[Thorstens]|n[Tinothiels]|n[Titus]|n[Trafans]c[#0046FF5)]|n[Tuneses]|n[Umbros]|n[Umfetas]|n[Umilawens]|n[Uridos]|n[Urothiens]|n[Vuthiels]|n[Watzmanns]|n[Xenphlames]|n[Xus]|n[Yas]|n[Zeindras]c[#0D960D]|n[Zickezackes]|n[Zimbris]|n[Zombers]';
		var suffixList = 'n[No translation available]v[ ]';
		var foodList = 'n[Apple]|n[Bananas]|n[Bread]|n[Bread rolls]|n[Cheese]|n[Chicken]|n[Fish]|n[Healing potion]|n[Meat haunch]|n[Steak]';
		var tempImpList = 'n[Bottles of strength]c[blue]|n[Bottles of aptness]c[yellow]|n[Bottles of agility]c[green]|n[Bottles of constitution]c[orange]|n[Bottles of charisma]c[purple]|n[Bottles of Inteligence]c[red]|n[Howthorn]|n[Taigaroot]';
		var impList = 'n[Blue powder]c[blue]|n[Detergent sponge]|n[Green powder]c[green]|n[Grindstone]|n[Orange powder]c[orange]|n[Protective gear]|n[Red powder]c[red]|n[Violet powder]c[purple]|n[Yellow powder]c[yellow]';
	}else{
		var prefixList = 'n[Adendathiels]|n[Amelias]|n[Amoviels]|n[Anchorons]|n[Appius]|n[Asayseths]|n[Asendacs]|n[Ashitills]|n[Bacias]|n[Barbekuus]|n[Beasthammers]|n[Berrys]|n[Bilgs]|n[Calodiens]c[#0D960D]|n[Chabdyns]|n[Chalinis]|n[Chealoths]|n[Cheggovs]|n[Chucks]|n[Ciallans]|n[Cisiens]|n[Dairus]|n[Decimus]|n[Denovs]|n[Dexterus]|n[Doitrems]|n[Doomeniks]|n[Elrarangs]|n[Elvilmandels]|n[Elywens]|n[Evotavs]|n[Fernabasts]|n[Fitschis]|n[Frabos]|n[Frickoys]|n[Frientas]|n[Fustriels]|n[Gadriewens]|n[Gaius]c[#E303E0]|n[Galarands]|n[Gidras]|n[Gonaks]|n[Granks]|n[Grasscrawlers]|n[Heudois]|n[Heuhois]|n[Ibiwans]|n[Ichorus]c[#E303E0]|n[Ismaels]|n[Isundels]|n[Jennifers]|n[Kedyssis]|n[Kerrannas]|n[Korks]|n[Kosmonas]|n[Leandronimus]|n[Liloels]|n[Lothays]|n[Lucius]c[#E303E0]|n[Lulus]|n[Lurtscharas]|n[Mandalus]|n[Manius]|n[Marcus]|n[Mateus]c[#E303E0]|n[Medonis]|n[Melanchaetas]|n[Melaneos]|n[Mermereus]|n[Mimas]|n[Monychustas]|n[Mooncruchers]|n[Nariths]|n[Opiehnzas]c[#E303E0]|n[Orlelds]|n[Peragos]|n[Phalangens]|n[Poirins]|n[Purmanns]|n[Rakrests]|n[Rayols]|n[Redos]|n[Reinkes]|n[Ronaldas]|n[Rynightes]|n[Sentarions]|n[Servius]|n[Sextus]|n[Shivas]|n[Skiterus]|n[Solitanis]|n[Sphingens]|n[Spurius]|n[Stoybaers]|n[Sugos]|n[Taliths]c[#0046FF]|n[Tanias]|n[Tantus]c[#E303E0]|n[Thorstens]|n[Tinothiels]|n[Titus]|n[Trafans]c[#0046FF5)]|n[Tuneses]|n[Umbros]|n[Umfetas]|n[Umilawens]|n[Uridos]|n[Urothiens]|n[Vuthiels]|n[Watzmanns]|n[Xenphlames]|n[Xus]|n[Yas]|n[Zeindras]c[#0D960D]|n[Zickezackes]|n[Zimbris]|n[Zombers]';
		var suffixList = 'n[No translation available]v[ ]';
		var foodList = 'n[No translation available]v[ ]';
		var tempImpList = 'n[No translation available]v[ ]';
		var impList = 'n[No translation available]v[ ]';
	}
	
	if(document.getElementById('auction_filter')){
		var L_food=document.getElementById('auction_filter').getElementsByTagName('tr')[2].getElementsByTagName('option')[9].innerHTML;
		var L_upgrades=document.getElementById('auction_filter').getElementsByTagName('tr')[2].getElementsByTagName('option')[10].innerHTML;
		var L_enisxisis=document.getElementById('auction_filter').getElementsByTagName('tr')[2].getElementsByTagName('option')[11].innerHTML;
		var L_search=document.getElementById('auction_filter').getElementsByTagName('input')[1].value;
	}
	var L_selectEnixsiseis=L_select+' '+L_enisxisis;
	var L_selectUpgrades=L_select+' '+L_upgrades;
	var L_selectFood=L_select+' '+L_food;
	
	if(document.getElementById('auction_filter') || document.getElementById('market_item_table')){
		var img_clear = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAWCAYAAAC7ZX7KAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsIAAA7CARUoSoAAAAI0SURBVFhH1ZdPSxtBGMZfU1Hrn2yWVugfUS+BkGM/gIJ4K+1H8WLOPfTiJd+h50JBsPTqd0gIwVKRlJ5KiFktTQ12dzvP1meyziqziePBFx5m9p1nXn++jpPs1N7ORiyO44k3J72zC8dVRVC34LrqcumxLPvzrssK606xwz8Lr5z8kM3VTlLnqHOajF/8XSd1d70PSZ1rwPV6/U7Fa7Wa3AR8+O7Nnepuvf8sBM4cicFgIJPIRhQMY5lEZl3nZ/g28EgtTCIrcBzHAhWLxUR8Nkdz3dbhSN1F0LP5R4n4bI7mem5gGj3Py0Ajx+AvYgeOFeToBn2xAOj/OQo5BnO5gfv9vvaWSiUNjTkDnrzAoWKFvv/6q/evLE4nOQhzBjzMW4GjKBKq1+tpv+/7AjGwlvbaOkwAjCfnI+i1pWmBGFhLe8cCBlC3282wIJeGxdwWl8qS1tdgBM29yJk+K3AQBGLK3JTHY+758VvE1CSezLUWhqGkVS6XM81DzvTZOjwMI0lr++XoGHAvcqbP2uH0n7pSqWh/u90WiIG1sc6wur/CK71endF1DjpDgRhYow9jbuBqtaq9rVZLw2HOgIfQtg4T4u36rLbun1xoOMwZ8NCfG5jGZrOZ+QdDjjEuMPd9Ov5zrZMARI6RG5j3aqPREOi2Tzpz3dph9QERKn38NkiE+U0y13N32Ly2bM82YKxHqovjyqz74L5ePswv8HhXcv1agzeO+6hbeP50wTkszt191f0Hfd8fmwxC+yAAAAAASUVORK5CYII%3D';

		if(GCAO_mod=='auction'){ //auction
            var itemType = Number(document.getElementById('auction_filter').getElementsByTagName('select')[1].innerHTML.match(/option value="(\d+)" selected="selected"/i)[1]);
            document.getElementById('auction_filter').getElementsByTagName('input')[1].setAttribute('id', "submitButton");
            var submitButton = document.getElementById('submitButton');
            var clearButton = '<div id="Clear" style="background-image: url(' + img_clear + ');background-position: 0px 0px;position:absolute;margin-top:-24px;margin-left:208px;width:22px;height:22px;" onmouseover="document.getElementById(\'Clear\').setAttribute(\'style\',\'background-image: url(' + img_clear + ');background-position: 22px 0px;position:absolute;margin-top:-24px;margin-left:208px;width:22px;height:22px;\')" onmouseout="document.getElementById(\'Clear\').setAttribute(\'style\',\'background-image: url(' + img_clear + ');background-position: 0px 0px;position:absolute;margin-top:-24px;margin-left:208px;width:22px;height:22px;\')" onclick="document.getElementById(\'auction_filter\').getElementsByTagName(\'input\')[0].value=\'\'" title="Clear"></div>';
            document.getElementById('auction_filter').getElementsByTagName('tr')[0].getElementsByTagName('td')[1].innerHTML += clearButton;

            displayWarnGuildShorAuctionButton();

            if(itemType <= 6 || itemType == 8 || itemType == 9){ //all, weapons, shields, armors, helmets, gloves, boots, rings, amulets
                //prefixes
                createElemenWithID("tr","prefix_search",document.getElementById('auction_filter').getElementsByTagName('tr')[1]);
                document.getElementById('prefix_search').innerHTML = '<td style="width: 50%; text-align: center;">'+L_Items+':</td><td style="width: 50%;"><select id="SelectPrefix" name="SelectPrefix"><option value="SP">- '+L_selectItem+' -</option>\n' + makeOpitonsFromItemList(prefixList) + '</select></td>';
                //suffixes
                createElemenWithID("tr","suffix_search",document.getElementById('auction_filter').getElementsByTagName('tr')[2]);
                document.getElementById('suffix_search').innerHTML = '<td style="width: 50%; text-align: center;">'+L_Type+':</td><td style="width: 50%;"><select id="SelectSuffix" name="SelectSuffix">\n<option value="SS">- '+L_selectType+' -</option>\n' + makeOpitonsFromItemList(suffixList) + '</select></td>';

                if (itemType == 1){ //weapons
                    // minimal damage filter script
                    createElemenWithID("script","damageFunction",document.getElementById('auction_filter'));
                    document.getElementById('damageFunction').setAttribute('type', 'text/javascript');
                    document.getElementById('damageFunction').innerHTML = "\n"+'function filterItemsByDamage(requiredDamage){'+"\n"+
                    '   var items = document.getElementsByTagName(\'script\')[11].innerHTML;'+"\n"+
                    '   var i=0;'+"\n"+
                    '   var auctionItemCell;'+"\n"+
                    '   //get items IDs'+"\n"+
                    '   var itemsIDRegExp = /"auction_(\\d+)"/gi;'+"\n"+
                    '   var itemsID=new Array();'+"\n"+
                    '   var temp;'+"\n"+
                    '   temp = itemsIDRegExp.exec(items);'+"\n"+
                    '   while(temp != null){'+"\n"+
                    '       itemsID[i]=temp[1];'+"\n"+
                    '       //reset visibility'+"\n"+
                    '       auctionItemCell = document.getElementById(\'auction_\'+itemsID[i]).parentNode.parentNode.parentNode.parentNode.parentNode;'+"\n"+
                    '       auctionItemCell.setAttribute(\'style\',\'visibility:visible\');'+"\n"+
                    '       if((i+2)%2!=0){'+"\n"+
                    '           auctionItemCell.parentNode.setAttribute(\'style\',\'display:table-row\');'+"\n"+
                    '       }'+"\n"+
                    '       i++;'+"\n"+
                    '       temp = itemsIDRegExp.exec(items);'+"\n"+
                    '   }'+"\n"+
                    ''+"\n"+
                    '   //get items damage'+"\n"+
                    '   var itemsDamageRegExp = /\.+? \\d+ - (\\d+)/gi;'+"\n"+
                    '   var itemsDamage;'+"\n"+
                    '   var itemsCount=0;'+"\n"+
                    '   var hidden=false;'+"\n"+
                    '   var y=0;'+"\n"+
                    '   i=0;'+"\n"+
                    '   itemsDamage = itemsDamageRegExp.exec(items);'+"\n"+
                    '   while(itemsDamage != null){'+"\n"+
                    '       if((i+2)%2==0){ //if we are on auction item, not owned'+"\n"+
                    '          auctionItemCell = document.getElementById(\'auction_\'+itemsID[y]).parentNode.parentNode.parentNode.parentNode.parentNode;'+"\n"+
                    '          if(Number(itemsDamage[1])<Number(requiredDamage)){ // did not match'+"\n"+
                    '               auctionItemCell.setAttribute(\'style\',\'visibility:hidden\');'+"\n"+
                    '               if((y+2)%2!=0 && hidden){ //2nd cell in row and 1st is hidden - hide whole row'+"\n"+
                    '                   if(!document.getElementById("td1")){'+"\n"+
                    '                      auctionItemCell.parentNode.setAttribute(\'style\',\'display:none\');'+"\n"+
                    '                   }'+"\n"+
                    '               }'+"\n"+
                    '               hidden=true;'+"\n"+
                    '          } else{ //match'+"\n"+
                    '               itemsCount++;'+"\n"+
                    '               hidden=false;'+"\n"+
                    '          }'+"\n"+
                    '       }'+"\n"+
                    '       i++'+"\n"+
                    '       if(((i+2)%2)==0){ //move to next itemID'+"\n"+
                    '           y++;'+"\n"+
                    '       }'+"\n"+
                    '       itemsDamage = itemsDamageRegExp.exec(items);'+"\n"+
                    '   }'+"\n"+
                    '   //view result'+"\n"+
                    '   document.getElementById(\'damageFilterResult\').innerHTML = \''+L_wearponsFound+': <b>\'+itemsCount+\'</b>\';'+"\n"+
                    '   document.getElementById(\'damageFilterResult\').style.display = \'block\';'+"\n"+
                    '}'+"\n";
                    // minimal damage filter
                    createElemenWithID("tr","Item_Damage_Search",document.getElementById('auction_filter').getElementsByTagName('tr')[3]);
                    document.getElementById('Item_Damage_Search').innerHTML = '<td style="width: 50%; text-align: center;">'+L_minDamage+':</td><td style="width: 50%;"><input type="int" name="SelectDamage" id="SelectDamage" value="0" maxlength="5" size="3"><input style="margin-left:5px;" onclick="filterItemsByDamage(document.getElementById(\'SelectDamage\').value)" value="'+L_search+'" class="button3" type="button"><div id="damageFilterResult" class="title_box" style="display:none"></div></td>';
                }
                submitButton.setAttribute('onclick',"if(document.getElementById('SelectPrefix').value!='SP'){document.getElementById('auction_filter').getElementsByTagName('input')[0].value=document.getElementById('SelectPrefix').value;}if(document.getElementById('SelectSuffix').value!='SS' && document.getElementById('SelectPrefix').value!='SP'){document.getElementById('auction_filter').getElementsByTagName('input')[0].value+= ' '+document.getElementById('SelectSuffix').value;}else if(document.getElementById('SelectSuffix').value!='SS'){document.getElementById('auction_filter').getElementsByTagName('input')[0].value=document.getElementById('SelectSuffix').value;}");
            } else if(itemType == 7){ //food
                createElemenWithID("tr","Food_Search",document.getElementById('auction_filter').getElementsByTagName('tr')[1]);
                document.getElementById('Food_Search').innerHTML = '<td style="width: 50%; text-align: center;">'+L_food+':</td><td style="width: 50%;"><select id="SelectFood" name="SelectFood">\n<option value="SF">- '+L_selectFood+' -</option>\n' + makeOpitonsFromItemList(foodList) + '</select></td>';
                submitButton.setAttribute('onclick',"if(document.getElementById('SelectFood').value!='SF'){document.getElementById('auction_filter').getElementsByTagName('input')[0].value=document.getElementById('SelectFood').value;}");
            } else if(itemType == 11){ //temporary improvements
                createElemenWithID("tr","TempImp_Search",document.getElementById('auction_filter').getElementsByTagName('tr')[1]);
                document.getElementById('TempImp_Search').innerHTML = '<td style="width: 50%; text-align: center;">'+L_upgrades+':</td><td style="width: 50%;"><select id="SelectTempImp" name="SelectTempImp">\n<option value="STI">- '+L_selectUpgrades+' -</option>\n' + makeOpitonsFromItemList(tempImpList) + '</select></td>';
                submitButton.setAttribute('onclick',"if(document.getElementById('SelectTempImp').value!='STI'){document.getElementById('auction_filter').getElementsByTagName('input')[0].value=document.getElementById('SelectTempImp').value;}");
            } else if(itemType == 12){ //improvements
                createElemenWithID("tr","Imp_Search",document.getElementById('auction_filter').getElementsByTagName('tr')[1]);
                document.getElementById('Imp_Search').innerHTML = '<td style="width: 50%; text-align: center;">'+L_enisxisis+':</td><td style="width: 50%;"><select id="SelectImp" name="SelectImp">\n<option value="SI">- '+L_selectEnixsiseis+' -</option>\n' + makeOpitonsFromItemList(impList) + '</select></td>';
                submitButton.setAttribute('onclick',"if(document.getElementById('SelectImp').value!='SI'){document.getElementById('auction_filter').getElementsByTagName('input')[0].value=document.getElementById('SelectImp').value;}");
            } else if(itemType == 15){ //mercenaries
            //todo filter by values
            }
		}else if(GCAO_mod=='market'){ //market
            var clearButton = '<div id="Clear" style="background-image: url(' + img_clear + ');background-position: 0px 0px;position:absolute;margin-top:-24px;margin-left:208px;width:22px;height:22px;" onmouseover="document.getElementById(\'Clear\').setAttribute(\'style\',\'background-image: url(' + img_clear + ');background-position: 22px 0px;position:absolute;margin-top:-24px;margin-left:208px;width:22px;height:22px;\')" onmouseout="document.getElementById(\'Clear\').setAttribute(\'style\',\'background-image: url(' + img_clear + ');background-position: 0px 0px;position:absolute;margin-top:-24px;margin-left:208px;width:22px;height:22px;\')" onclick="document.getElementById(\'content\').getElementsByTagName(\'input\')[5].value=\'\'" title="Clear"></div>';
            document.getElementById('content').getElementsByTagName('tr')[8].getElementsByTagName('td')[1].innerHTML += clearButton;
            createElemenWithID("tr","Item_Name_Search",document.getElementById('content').getElementsByTagName('tr')[9]);
			document.getElementById('Item_Name_Search').innerHTML = '<td style="width: 50%; text-align: center;">'+L_Items+':</td><td style="width: 50%;">\n<select id="SelectItem" name="SelectItem"><option value="SI">- '+L_selectItem+' -</option>\n' + makeOpitonsFromItemList(prefixList) + '</select></td>';
			document.getElementById('content').getElementsByTagName('input')[6].setAttribute('onclick',"if(document.getElementById('SelectItem').value!='SI'){document.getElementById('content').getElementsByTagName('input')[5].value=document.getElementById('SelectItem').value;}")
		}
	}
}

// name: makeOpitonsFromItemList(OptionList)
// @param string with options "n[name]v[value]c[color]|n[name1]v[value1]c[color1]..." v[value] and c[color] are optional
// @return string with option html tags
function makeOpitonsFromItemList(OptionList){
    var options = OptionList.split("|");
    var nameRegExp = /n\[(.+?)\]/i;
    var valueRegExp = /v\[(.+?)\]/i;
    var colorRegExp = /c\[(.+?)\]/i;
    var name = ""; var value = ""; var color = ""; var htmlOptionList = "";
    for (i in options){
        name  = (nameRegExp.test(options[i]))  ? options[i].match(nameRegExp)[1]  : "Option not found";
        value = (valueRegExp.test(options[i])) ? options[i].match(valueRegExp)[1] : name;
        color = (colorRegExp.test(options[i])) ? options[i].match(colorRegExp)[1] : "";
        shadow = (colorRegExp.test(options[i])) ? 'text-shadow: 0pt 0pt 2px '+options[i].match(colorRegExp)[1]+';' : "";
		if(color=='yellow'){color='#BFAF00';}else if(color=='orange'){color='#FF7F00';}
        htmlOptionList += '<option value="' + value + '" style="color: ' + color + '; ' + shadow + '">' + name + '</option>\n';
    }
    return htmlOptionList;
}

function createElemenWithID(element,id,location){
    var option = document.createElement(element);
    option.setAttribute('id', id);
    if(location){location.parentNode.insertBefore(option, location);}
}

function displayWarnGuildShorAuctionButton(){
	var time= document.getElementById('header_game').getElementsByTagName('span')[6].innerHTML.match(/(\d+:\d+)/i)[1];
	var L_Auction = document.getElementById('sidebar_inner').innerHTML.match('class="submenuitem_aktive" target="_self">([^<]+)</a>')[1];
	var L_AuctionType = document.getElementById('mainnav').innerHTML.match('current" style="cursor:pointer;">([^<]+)</a>')[1];
    var message='['+time+'] '+L_Auction+' ('+L_AuctionType+') : '+L_veryShort;
	var auctionStatus = document.getElementById('content').getElementsByTagName('p')[1].innerHTML;

	if ((auctionStatus.match(/<span class="description_span_right"><b>(.+?)<\/b><\/span>/i)[1])==L_veryShort){
		createElemenWithID("div","warn_guild_div",document.getElementById('content').getElementsByTagName('p')[2]);
		document.getElementById('warn_guild_div').style.margin = "0px 45%";
		document.getElementById('warn_guild_div').innerHTML = '<input id="announButton" value="'+L_anunGuild+'" class="button1" type="submit" name="sendmails" /><span id="messageText" style="display:none;">'+message+'</span>';
		document.getElementById("announButton").addEventListener("click", sentAuctionGuildMessage, false);
	}
}

function sentAuctionGuildMessage(){
	var message=document.getElementById('messageText').innerHTML;
	if(Get_Cookie("GCAOguildMates")){
        var temp = Get_Cookie("GCAOguildMates").split("#");
        var mate = new Array();
        var code = "";
        for(var i=0; i < temp.length; i++){
            mate = temp[i].split("<");
            code += '&qq'+mate[1]+'=0O0O00';
        }
		code+= '&message='+message;
		GM_xmlhttpRequest({
			method: "POST",
			url: GCAO_siteurl+'mod=guild_main&submod=admin_mail&sh='+GCAO_secureCode,
			headers: {
			'Host': GCAO_siteurl.replace('http://','').replace('/game/index.php?',''),
			'User-Agent': 'Mozilla/5.0 (Windows; U; Windows NT 6.1; el; rv:1.9.2.12) Gecko/20101026 Firefox/3.6.12',
			'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
			'Accept-Language': 'el-gr,el;q=0.8,en-us;q=0.5,en;q=0.3',
			'Accept-Encoding': 'gzip,deflate',
			'Accept-Charset': 'ISO-8859-7,utf-8;q=0.7,*;q=0.7',
			'Keep-Alive': '115',
			'Connection': 'keep-alive',
			'Referer': GCAO_siteurl.replace('game/index.php?',''),
			'Content-Type': 'application/x-www-form-urlencoded',
			},
			data : code,
			onload: function(response){
				document.getElementById('announButton').value=L_MessageWasSent;
			}
		});
	}
}

//################################################################################################################################
//## CONNECTED GUILDMATES / S??????????? ??????S ??G????S
//################################################################################################################################
function  onlineGuildmates(){
	var img_online = 'data:image/jpeg;base64,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';
	var onlinePlayersDiv = document.createElement('div');
	onlinePlayersDiv.setAttribute('id', 'OnlinePlayers');
	onlinePlayersDiv.innerHTML = '<style type="text/css">a#wio{ cursor:pointer;display: block;width: 25px;height: 25px;background-repeat: no-repeat;}a.wio{background-image: url(' + img_online + '); background-position: -25px 0px; }a.wio:hover { background-image: url(' + img_online + '); background-position: 0px 0px; }</style>';
	onlinePlayersDiv.innerHTML += '<a id="wio" class="wio" title="'+L_OnlinePlayers+'" style="position:absolute;margin-top:99px;margin-left:552px;;width:25px;height:25px;z-index:501;"></a>'
	document.getElementById('header_game').appendChild(onlinePlayersDiv);
}

function ShowOnlineBox(){
	if(!document.getElementById('content2')){
		var content2 = document.createElement('div');
		content2.setAttribute('id', 'content2');
		if(!navigator.userAgent.toLowerCase().match(/chrome/i)){content2.setAttribute('style','margin-top:20px;');}
		else{content2.setAttribute('style','position:absolute;margin-left:265px;');}
		content2.innerHTML = '<table><tr><td id="first_OnlineBox"></td></tr><tr><td id="second_OnlineBox"></td></tr></table>';
		document.getElementById('main_inner').appendChild(content2);
		GM_xmlhttpRequest({
			method: "GET",
			url: GCAO_siteurl + 'mod=guild_main&submod=memberlist&i=0&r=o&sh=' + GCAO_secureCode,
			onload: function(response) {
				document.getElementById('content').style.display="none";
				var offlineP=response.responseText.match(/color:red;.font-weight:bold;/g).length;
				var numberP=response.responseText.match(/<a.href="index.php.mod=player/g).length-1;
				if(offlineP!=numberP){
					OnlineBox(response.responseText);
				}else{
					var noOne=document.createElement('div');
					noOne.setAttribute('id', 'OnlineList');
					noOne.setAttribute('style', "display:block;float:right;padding:5px 87px 0pt 23px;width:540px;");
					noOne.innerHTML="<div class=\"title_box\"><div class=\"title_inner\">"+L_guildPlayers+"<span onclick=\"document.getElementById('content2').style.display='none';document.getElementById('content').style.display = 'block';\" onmouseout=\"this.style.color='black';\" onmouseover=\"this.style.color='red';\" style=\"float:right;color:black;cursor:pointer;margin-right:5px;\" id=\"closeBox2\"><b>X</b></span></div></div><div class=\"title2_box\"><div class=\"title2_inner\">"+L_noOnlinePlayer+"</div></div>";
					document.getElementById('first_OnlineBox').appendChild(noOne);
				}
			}
		});
		GM_xmlhttpRequest({
		method: "GET",
		url: GCAO_siteurl + 'mod=overview&submod=buddylist&sh=' + GCAO_secureCode,
		onload: function(response) {
			document.getElementById('content').style.display="none";
			var offlineP=response.responseText.match(/color:red;.font-weight:bold;/g).length;
			var numberP=response.responseText.match(/<a.href="index.php.mod=player/g).length;
			if(offlineP!=numberP){
				OnlineFamilyBox(response.responseText);
			}else{
				var noOne=document.createElement('div');
				noOne.setAttribute('id', 'OnlineList2');
				noOne.setAttribute('style', "display: block; float: right; padding: 5px 87px 0pt 23px; width: 540px;");
				noOne.innerHTML="<div class=\"title_box\"><div class=\"title_inner\">"+L_familyPlayers+"<span onclick=\"document.getElementById('content2').style.display='none';document.getElementById('content').style.display = 'block';\" onmouseout=\"this.style.color='black';\" onmouseover=\"this.style.color='red';\" style=\"float:right;color:black;cursor:pointer;margin-right:5px;\" id=\"closeBox2\"><b>X</b></span></div></div><div class=\"title2_box\"><div class=\"title2_inner\">"+L_noOnlinePlayer+"</div></div>";
				document.getElementById('second_OnlineBox').appendChild(noOne);
			}
		}
		});
	}
	else if(document.getElementById('content2').style.display=='none'){document.getElementById('content2').style.display='block';document.getElementById('content').style.display='none';}
	else{document.getElementById('content2').style.display='none';document.getElementById('content').style.display='block';}
}

function OnlineBox(text){
	var img_skull = 'data:image/gif;base64,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';
	var img_message = 'data:image/jpeg;base64,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%3D';
	var img_overview = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAgEASABIAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCAAZABkDAREAAhEBAxEB/8QAGAAAAwEBAAAAAAAAAAAAAAAABQgJBwP/xAAzEAABBQEAAAQDAREAAAAAAAAEAQIDBQYHAAgTFBESFVYXMTZCUXJ1dpGUl7S1wtPU1f/EABsBAAICAwEAAAAAAAAAAAAAAAcIAgkAAwQF/8QAMhEAAgIBAwMBBQUJAAAAAAAAAgMBBAUABhIHERMUCCEiMVE0cZGh0SMkQmKBscHC0v/aAAwDAQACEQMRAD8Af3PxZWIfiOEx/G+E6HUbDlHB3omi5rirS7stRuctVugKuLY2tmT1JrOZlq8yWF0ccKq9jZPixqp5svbuU3/vjGbbq21Uwtw2xdvFHmGjjaiGW7lvxCQk2VVkmSV8h8pcAghEpIS9ujP19pbdu55yfVenlCataDhY2rtxo1qdfzSJiqHOYMEyRORGTKBKYiNM/wBQ8veG57YV2bphfLvu92aDFJJSQ+WrnNdjzLZkavlpaSxSSS6DMKlVQa62uHlgnmoIyasoISZyBHhV7KuzsztO9Zos3RgsnWW/0OVyuWp3Ze3j+7vyuKThkJGjyjm1GNeFqokzOLeTNa1uV5/XvcmO3HXS8sJmaTCVFyjj8fYqwlfL9onH3G5FzjtRy4i62B17DRGPTUgMjXjWEn5ff7PnVPZ8t8vz6rbXFaDXuG4rgK0udh1fPZDQwSSDSPHK9wONPCrV+ZZh/TaxFRPjXvmamc29mcvgMmrxZLCZK7isgoZ5Cq3Redd4QUREFEMUcDPaJKI+UT7tOBi7lTNYzHZeicMpZOjWv1GT8MnXtqF6S4947clmMzHeffM+/wCkV/YUn2bzX8PsN/zvHm+tu/Qvz13eCPrH4x/1qhNTY6VOxcWr+eQOP3xXJvKM3HAsX4wSaRnPs/MFEQjZZWRhyyTRvKcjmpELHJIiojFRxu6C2MjU61YW5jairAKXZoZNTZhdcdsLo2Qy9txzByty6TGHDQiRJgqEU9y0KOsSaTuneZrW7DK/eKYYgl/E5+aG2k8WqQjtBwVoBhnaBgUSwymBGZ1SDcYDQ8t3DbTVWNcWUtkNKPYiWcdm0c5rmviniHnijlniqS1WYAdVjaS8eBClbFJIqW2426O58b2ogderCTIkuSaSMPl454kYDLxmBaf8KyZwiC7RFf8AYVGDtRDpGxZ8o8WKbBgJyUd2RyHvK1zEyoImYOYGSntGkaztBYYLzFcBxxlnHZVY/RMYRlrqFjmx3lFPHdACGLC9z/ZWAxQZtZcAK6T2xg6zRKoRYTpKu/aR6cZLZW+shuKw2b2M3xlMtl0WzBYNr5Q3hcymMsCuIX3SWQTYqPARXap2A4RDq9oFvn0Q3rQ3LtSphVqCpkdq0cfjX1hMjB1BaSrUL6ZP4+LYqtTYWUkabKT7zKW1yOZP1Ij8sX7u7/L4XbyB9B/GP00adPrQz925v2/knbcJwzpXRKyh4lwIGvJqcVp7WrPE+4Llqi/mrbUCpIgdbVJEqBQzALYKPbMSRIvTcsKE/pV1CpdN99Rl8ljJyWJyFRmKywJgPXJpvalrLWPkyWsnrlIQaGmtdpPkrk1XOGCPeomyX742fGPo3oo5OjZjI41jZKarbalOUKL3ASPwsFhRDAgyS2AdC2cICWH2+76t0nQAW11zDzA09cOjjfoxPDukGW0hCRu9IOImvpCc+r2vcrmzF24MbvlY6ZIFejG2jYfr/wBCa+35tUt+YRRurywq9ob9O2iIDmwGUH0Ruy+OMgKa6LMGccUtfyA2IRe6R9WSzEVrmzsm0EuGBdVdSsVXlMwCpXaCz4IXPflJuYmFD2l0BPIRxoZnc9n5gvL+anBe0ZfBc86fnS/r1/z7TVyCBXNxWJpNDqLSep9jXBQwBgyPHWZ1fnxAJ/RNsZbAw8lCvaS654zqY6ttna64dtnF31ZOcw+q2vbyWRTXv1VTUXYELNXGJRkbEQD0ps3XyD7KVBXqoS3vRHpRe2Uqzns+yVZ3I1jpxjEWFuq0KTGVHnDzTJosXmMppkjUxiKwCa0sYT7DWz2+nW/2W1f7AP8AV8Knx/mL8dMDwj6z+X6aHz/fj/UrG/0TH+Nt77Z/Wf7zqKPsM/dP+2uT/wAT85f7PENQ0ezH4SZ39MJ/JT+M1tD5T9/+I0gfjNT1/9k%3D';
	if(text.match('mainbox')){
		text = text.replace(/<script/ig,'<span').replace('mainbox', 'Omainbox');
		var onlineBox = document.createElement('div');
		onlineBox.setAttribute('style','display:none;float:right;padding:5px 87px 0pt 23px;width:540px;');
		onlineBox.setAttribute('id', 'OnlineList');
		onlineBox.innerHTML = text;
		document.getElementById('first_OnlineBox').appendChild(onlineBox);
		
		document.getElementById('OnlineList').innerHTML = document.getElementById('Omainbox').innerHTML;
		document.getElementById('OnlineList').getElementsByTagName('div')[1].innerHTML = L_guildPlayers+'<span id="closeBox" style="float:right;color:black;cursor:pointer;margin-right:5px;" onmouseover="this.style.color=\'red\';" onmouseout="this.style.color=\'black\';" onclick="document.getElementById(\'content2\').style.display=\'none\';document.getElementById(\'content\').style.display = \'block\';"><b>X</b></span>';
		document.getElementById('OnlineList').getElementsByTagName('tr')[0].setAttribute('style','display:none');
		document.getElementById('content').style.display = 'none';
		document.getElementById('OnlineList').style.display = 'block';
		
		var stop = false;
		var c = 1;
		var link='Error';
		var playersid='0';
		var messagelink='Error';
		while (stop==false){
			if(document.getElementById('OnlineList').getElementsByTagName('td')[(c-1)*5+1]){
				link = document.getElementById('OnlineList').getElementsByTagName('a')[c+1].getAttribute('href');
				if(link.match(/p\=(\d+)/i)){playersid = link.match(/p\=(\d+)/i)[1];}
				name = document.getElementById('OnlineList').getElementsByTagName('a')[c+1].innerHTML;
				messagelink = GCAO_siteurl + 'mod=messages&submod=messageNew&&profileName=' + name + '&sh=' + GCAO_secureCode;
				document.getElementById('OnlineList').getElementsByTagName('a')[c+1].removeAttribute('href');
				document.getElementById('OnlineList').getElementsByTagName('td')[(c-1)*5+1].setAttribute('width','25px');
				document.getElementById('OnlineList').getElementsByTagName('td')[(c-1)*5+1].innerHTML = '<center><img src="'+img_overview+'" onclick="window.location = \''+link+'\'" style="border:0px;width:20px;cursor:pointer;" title="Direct link"></center>';
				document.getElementById('OnlineList').getElementsByTagName('td')[(c-1)*5+2].setAttribute('width','25px');
				document.getElementById('OnlineList').getElementsByTagName('td')[(c-1)*5+2].innerHTML = '<center><img src="'+img_message+'" onclick="window.location = \''+messagelink+'\'" style="border:0px;width:20px;cursor:pointer;" title="'+L_sentMessage+'"></center>';
				document.getElementById('OnlineList').getElementsByTagName('td')[(c-1)*5+3].style.display = 'none';
				document.getElementById('OnlineList').getElementsByTagName('td')[(c-1)*5+4].setAttribute('width','80px');
			}
			if(document.getElementById('OnlineList').getElementsByTagName('tr')[c]){
				if(c==1||document.getElementById('OnlineList').getElementsByTagName('tr')[c].innerHTML.match('color:red;') || document.getElementById('OnlineList').getElementsByTagName('tr')[c].innerHTML.match('color: red;')){
					document.getElementById('OnlineList').getElementsByTagName('tr')[c].setAttribute('style','display:none');
				}
			}
			else{
				stop = true
				document.getElementById('OnlineList').getElementsByTagName('tr')[c-1].style.display = 'none';
				document.getElementById('OnlineList').getElementsByTagName('tr')[c-2].style.display = 'none';
			}
			c=c+1;
		}
	}
}

function OnlineFamilyBox(text){
	var img_skull = 'data:image/gif;base64,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';
	var img_message = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAgEASABIAAD/2wBDAAEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/2wBDAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQH/wAARCAAZABkDAREAAhEBAxEB/8QAGgABAAIDAQAAAAAAAAAAAAAACAYHAwQFCf/EADUQAAEEAgECAQQTAAAAAAAAAAQCAwUGAQcIABMSCRV1lhEUFxgjNDVCUVVWcZKytLbT1Nb/xAAcAQEAAQQDAAAAAAAAAAAAAAAFBgACAwQBBwj/xAA1EQACAQMDAgQBCQkAAAAAAAABAgMEERIABSETIgYUMTJRFSQ0QWFxgeHwUlOCkZKhssHR/9oADAMBAAIRAxEAPwCZb1v29de33izWNC8etK7jqNt1lS13LV0FrTVsdvS7zYWg29k2aQrezNj0ax68jnQ4OHlpTCbIhFishrxUXER0iNiRPhPIfhqi2vca3c6ffJ6qCpgWOSOZZFSkjhMqQNHLHErVhlaVwGeGOaKJATJg7RRyd27jJW0sMclGsUqlmieO2UpkAyIQuVg7EHckjxu5ICmwYrWM3yO5FCFljHeTU5KU5Y73hyKFongVsDttqwnwtOGIp9UQ+rK/FlTzTCU+xhCvDnOc9SQeEtiLFTvlA6qfRpd2gYW+IelkHFxxzzYgi9gW+67gVU+QqLYglsaV7uBzbCosB8PU8j1N7oXjDtnaey9x62rV24l03XmskTQVa2Sne2kePNL21mwTpEY7TpGo1vWw1ljS6zKodko+XOk24AkZ0XDkYw/lh/K4h4o27a9kiC0m6y1FdUdOamjgEktCKcPJFOslRUQU0qzIUDoiLN7gGcBhpnapqutGUtMIYY3eN2lKxzFgkboURJJQylWAYsym4GIsOSZ5thPspW/VSqf5XqC+eqv3w/qP/dM+VT4p+vx0tCbEUHyH4ShYlio9t3avFmJOIBY9uvOVyb4gWmCsIr47aCMYGlIqaOjj38Yw2KyUQYtxtLWV4l3hxWXd99ybqRw7TIoZzi3mIZ9uMzkk4lOuqtGb99rFQTYG1rfNIYCO4VcLMw5vI8MqSBbhgwx+sC/LcADXqnLjulkkkstOOQ+HFxTYeHkrUopp1GXnld5b+XUvPEJQn4VLGEpw4l5eUrxh6Kd5HLNY3NjIE9VAPawQAi3HJBJtkQT6680YQBLE3T2ngZkgEDLtIx4NmC8mx5NwBFy+Q+V1mhx8yDa8coNNkONkPuqZYc9z3SoTyAnnnnEuClKHy++kdDIzEk8WIM1lphLzoHiONJqmhdyoUbcoQL7jetq3JcY8EZMBcklMWPuI0ht4Kwyr3W67NYgCxMUKkAX44RQQfQiw4F9BHvjfQV+Nr+ToDy9P9v6/h1v6mNyi+QMbyW49XSC0Psq26gqUBpG0z9vp9Sl56wJx71zNCfxWq8eBH12fwO9a0vrdcuEXlBYpAbKsLGILYke0y7LS1O5vuFbUU81VC1OsUdG80LJ5ijqDK00chkVyYHQR9FlsGLyC6BzauOselpjS08Mqo/UZ3n6btJaWMLgUYY3dSXyJFrBW9VXMtyf3S22GRWeH/LOT7Tq8IjrfLA69GHQPnA7JJUfTdFbTSSt7s4OyM1ZHEN93GFry54x2VPlzZYWkijaV4bLaSKidi5IDWBqKqB1xPYbxgEqWBxPJ4oNxkCvJ0Vc3yTqsVFzawxj+AUg5G4yuqm2jTUqrv6z8yoDdBWud202sWW+6lXI62dqV1sNPj5SFnaxGymypmyzNIrZIUgfDRQA8gEw2JAxiI4qZUt9+XkMgCbzvVJuVNTQ023pTzQsS9c7XqHi7ilKqRsIRCjO0nUZWlcsE7UjXJKgoZoHkaSpZ1YC0IW0QYkkygsS+bAKpUnAY5AXdtVb5tL+qp71YL/u9R3v/AGz/AC/PSnT+3+3560WfiYnoeiftJPWSr+nSfdrhPoUP3j/Iayq+d9+Pzp6s1Zrq175bhfS0X+o6rWSP6/w/3oE9VrJr/9k%3D';
	var img_overview = 'data:image/jpeg;base64,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%3D';
	
	text = text.replace(/<script/ig,'<span').replace('<div style="padding:20px">', '<div style="padding:20px" id="Omainbox2">');
	var onlineBox = document.createElement('div');
	onlineBox.setAttribute('style','display:;float:right;padding:5px 87px 0pt 23px;width:540px;');
	onlineBox.setAttribute('id', 'OnlineList2');
	onlineBox.innerHTML = text;
	document.getElementById('second_OnlineBox').appendChild(onlineBox);
	
	document.getElementById('OnlineList2').innerHTML="<div class=\"title_box\"><div class=\"title_inner\">"+L_familyPlayers+"<span onclick=\"document.getElementById('content2').style.display='none';document.getElementById('content').style.display = 'block';\" onmouseout=\"this.style.color='black';\" onmouseover=\"this.style.color='red';\" style=\"float:right;color:black;cursor:pointer;margin-right:5px;\" id=\"closeBox2\"><b>X</b></span></div></div><div class=\"title2_box\"><div class=\"title2_inner\">"+
	"<table width=\"100%\" id=\"familyOnlinePlayersList\">"+document.getElementById('Omainbox2').getElementsByTagName('td')[0].getElementsByTagName('table')[0].innerHTML+"</table></div></div>";
	var d = document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr')[0];
	d.parentNode.removeChild(d);
	
	var playersNum=document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr').length;
	var i=0;
	while(i<playersNum){
		if(document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr')[i].getElementsByTagName('td')[3].innerHTML.match(/off/i)){
			d = document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr')[i];
			d.parentNode.removeChild(d);
			playersNum=playersNum-1;
		}else{i++;}
	}
	
	for(i=0;i<playersNum;i++){
		var d = document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr')[i].getElementsByTagName('td')[2];
		d.parentNode.removeChild(d);
		d = document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr')[i].getElementsByTagName('td')[3];
		d.parentNode.removeChild(d);
		
		var link=document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr')[i].getElementsByTagName('td')[0].getElementsByTagName('a')[0].href;
		var status=document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr')[i].getElementsByTagName('td')[2].innerHTML;
		document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr')[i].getElementsByTagName('td')[2].setAttribute('width','25px');
		document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr')[i].getElementsByTagName('td')[2].innerHTML='<center><img src="'+img_overview+'" onclick="window.location = \''+link+'\'" style="border:0px;width:20px;cursor:pointer;" title="Direct link"></center>';
		
		var name=document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr')[i].getElementsByTagName('td')[0].getElementsByTagName('a')[0].innerHTML;
		var messagelink=GCAO_siteurl+'mod=messages&submod=messageNew&&profileName='+name+'&sh='+GCAO_secureCode;
		var newtd=document.createElement('td');
		newtd.setAttribute('width','25px');
		newtd.innerHTML='<center><img src="'+img_message+'" onclick="window.location = \''+messagelink+'\'" style="border:0px;width:20px;cursor:pointer;" title="'+L_sentMessage+'"></center>';
		document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr')[i].appendChild(newtd);
		var newtd=document.createElement('td');
		newtd.setAttribute('width','80px');
		newtd.setAttribute('align','right');
		newtd.innerHTML=status;
		document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr')[i].appendChild(newtd);
		document.getElementById('familyOnlinePlayersList').getElementsByTagName('tr')[i].getElementsByTagName('td')[0].getElementsByTagName('a')[0].removeAttribute('href');
	}
}

//################################################################################################################################
//## LINK TAB
//################################################################################################################################
function links(){
	var img_menutab1 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAcCAYAAABh2p9gAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oLCxA4BNN0+GsAAAAdaVRYdENvbW1lbnQAAAAAAENyZWF0ZWQgd2l0aCBHSU1QZC5lBwAAAjlJREFUSMe1lt9PE0EQxz8zt1faE2xBWyIqMb74YHzWZ/8I/2CffDckJoJExVqKkdKGtnC9HR/2+uPagoB1kslu2r3vfme+s7Mr7948NQBVQUSJVNCJK6pClI8Tl/CfCIgIs+bGE8tHDxSX3NzMwO0dnTHyYScRQTXMNXdRQYUwF8kjydcT5gCvXzSmDB8/SO7KCYBLL8WQzViZKSu2wJB/pXhNyN4bIx9+iHJB5kvjryHbjA9HGc8f3ceA3iBlOPKMvOEtuM2tt6Uh5xTNjMs0Y2ujzNZGmXZnwJdWl/4wpRQrThURW2Qs84B+Cji7ZaNWoVGrcHI24LDVpdtPKceKi7SYiugKhuO8zVu9WqFerXDc6XPQPON8mLIWR8SR5AW+oPLUYqd8+NSiXk3Yra8Tu2llbdcStmsJx6d9vrZ7pJkndksA/VxmfWYcnfT4dtxjPYl5tr1BvVqZAm8mbG8mvP/YRNXQGYEWQg5KWr5rGK86SYJNvpVCtzEmomSZIarsPEzYbdyj5KIFoJ+/+3xv93CqC3XjxqzGgBdZxttXO0sZtU77HDS7pOmI2AWlDbm+Dr23pUD7zQ7DixGlSIldOEHz6VoQxVtRoHZnwP6PDufDFBcpay5CJOTUX9scbJJEVALQ52aHwSDFOaUch9KZPSB2hVKF5mAGTpW9w1+ICCWnhWN2k75ZLGwZ50aYv2tu1w9X2LJXDvh/roBhFhSMJG9LevtrdAL48kkVm3k5hJfC3V8OKw/5D4mB/RBDCptzAAAAAElFTkSuQmCC';
	var img_menutab2 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAcCAYAAABh2p9gAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oLCxA2NGsu5UkAAAAdaVRYdENvbW1lbnQAAAAAAENyZWF0ZWQgd2l0aCBHSU1QZC5lBwAAAj5JREFUSMe1lk1PFEEQhp+q6RGWRNg1cVcwq4nBgHrxpvHgz/AX68WbHyR6EMweCLBEwocLzEx3eehhmHVnMcDaSWU66Z636616u6rl3eu+AagKIkqiglamqApJ+a1M4poIiAj1odtH5wBYaaH83mSYgQP4NDhERBARVOOpWpqooEKci5RM4h4hzgFerXWBEtAp9Dqtm/gEQBYuabu6u7MYyozHpYfcxsUbUDYzgoEPcaMrJTSVsjVYMCOYUQTjrAgcn+YY8GR5kbPCV/uaKf/loplhBkUIZHnAuYT1foduO6ohyz1zTqOwpQmwpHJBrfCBszywMO9Y63e4v9SaUIwFi2DJFA/NjNwb57knTROePe7Qay80xjQp42dmdQfrWYbcG5oo68tL9DqTQHkRGAxPGB6OSJ1W8WsE9MHIvPH2eW8CaHh4ys/dY05GOaqQJoomQhkltJbIMcoyRYtmF14YgmDEOGuDEl09yE6Vj9926XfvsnzvknK33aLbbpEVnsHeb/YORvgiIElD+Rq/5kZeeL4PfvFhY4edg9HY5jsuYXVlkTcvHnDufaXTZsByQQVSJ/ii4OvWPu83tieAAUKwShmNwg42HjNVYU4S8jzwZXOfzfmU1YftStjBwNtkdZl6UwBEYq10qmSF5/OPIa1WytOVNirx5Cuu3tWVJBFQp+SZZ2NrH6fa+I8bT8q/qlRsB3Up23Uo367Azgjw/7SALMSMJqKoULbO67XRMcCXj5aql0N8Kdzi5TBryn8AyJAF5LPaS9kAAAAASUVORK5CYII%3D';
	var img_menuinner = 'data:image/gif;base64,R0lGODlhIAAgAMQfAEAsFT4rFiYZDSwcDjwnEj4oFD0nFEIuGUArGEAsGD8qFT4sFjomET4pEj0qFEAuGEIvGkItGjkoEyscDSwdDkEsF0EtFz8sFj8sFUAsF0EuGEEtGEAsFj8rFU41Fv///yH5BAEAAB8ALAAAAAAgACAAAAX/4CeOZGmepaeubOu+qugJFDXdeD4NvI7XAo+MIlEUCgaCksBoMggFoyG5JDQkFOHHQ6lYAoqwopPhdDqITWSTAIvHFUV2aAhcLhxOZrOpcABeGhoWGAEODnYWG3JaHhMEYxgcFhYVlpZpGwgXAQEdF3saCAYTjRQFGRUAZx2SeXesHRwVfBmcDgylMo9jrJODGGeTlH4AGBcWGhsFc1sDdYWessQAABwXZ4d2GYoJBgONjwEWxqwYGNbJgpW0fAgVCMymqBt4gYMckhoH/MobGan4MKJDBlusDtYyZPoH0NIGZfLoIJhoSZ0Fg7MeKtt0J0OAiFtObei3L0KEA33u/Qni0xEeSC4KTvKb2Y+PIH98+GD6Nk8NhJ8QZt7MmXMiAoABeA5RMBIohAj+yuSZRSnfMY8GmnFBRckoQIsGD35CkODlqQQ6LU1dm+fSKll8zBpIoGxmn1WH8p45N+nhMq3PjtrCkyeYXg77NHjs1CmrKQNkBgeLde7OhQWMPRUioMtZgQBWg82qIPkcX0VsOBEAt4tAgHqWFdpC90vDgwvRPH3UenbTmQteKl0bq+HnIIO7w9VBcMbTnanqNt45t6cs7w4V3DhQII1V5u+HChDgLaFBFQNHkCyZwp6KkitaadjAwWOAjgE1ati/gZ9CEBkwBChgDCgUaGAJIQAAOw%3D%3D';
	var img_blackbox = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oLCxMoGmH/aQAAAAAdaVRYdENvbW1lbnQAAAAAAENyZWF0ZWQgd2l0aCBHSU1QZC5lBwAAAC1JREFUWMPtzkEBADAIAKHT/hmWdTH8QAKmeh3ajgkICAgICAgICAgICAgICHwGHADetlFODwAAAABJRU5ErkJggg%3D%3D';

	var img_guild = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAFUklEQVR42s2UC1BUVRzGv7sv2Aewy74EWR6GOtMYDuKkIKZmSmpAPARf2eSUDloak6WpI4OjpY2OjSaOOtVkPlEhJDU1UxNBMyXJaSYhARcW2QessA8e++jcM+3OOmoobtqZObNnz3f3fL//d/57GfRvMMtWrE5zOBxbXS6nhsPhNvH5vCXr160pJZr7sQ7qhznno49XFRPzrMmTJmISmadPn8EpMnk8Xulnn67NJs+4/gsAZnH+0kRicmhkwojwhIR4VFZdQk3NDcTFDUNS4mhcq/4NV65c1RG46Vs2b6x6lDQeCSAxKVmQlDz2W5fLlZOaOg1WixUXKi4iJkoDlUoJvd6A+kYtxiaPgVgiRnn5MXA4nOLKigtvVFVW9DwJADM/b1G8WCz5YcyYROVzgwbRqs1tbRg6dAg1FwqFsNvtFOLPm7WQymQ0jb9u3cLFi1UGq9Xy6s7t26oflsZDAabnzpQMjNDsYhgmNzMznTEZTbh0+RdEayIQFRUJkUgEbXMLGkjl0SSJyIhwWK1WNN7WooHM0aNehFwhR0lJmZuM4uYm7duHDu63PAoAk7do8cRAofDAuJeS5UqlEkdKSqGUyxEdHQmFQgGpVIpb9Y2Qk72E+OG4Wn0dJpMJg2KiYDabYTQa0dBwGwayl5WZAYPBgPM/V5i67PYZ27dtOeObxj0AM2fPlStVqi+GDI6dkZg0GvX1Dbj66zVEhIchPHwAMZZBIpGAz+fj1JlzyMlKZzsfpOlQfKQMkyeOR29vLywWCwFph053B026FiSMHIGYmGhUVV7Czdq6Awa9/t39e3ebfAE4C997PzsgIGDHyxPGS4OCJDhKGkmpCEX4ADVkslCEhIQgMDCQbS76g5Y7elrG0CGx5O7r6EFhA1RUI82Krq4u3L17F+3tbdDdaYXB2IY00sCdnRb8dPacubu7e0HR1s8PewAC85cus89/Zx5qfr+B69drEKZWkbjl1FgsFtNKST940yKwqK2rJ1fRQKKPxuDYGJBDvTq5d5oM2xcsiJH0UEurHsOHxyHuhWHYuesrbN64QUhPXJL/4TwOl/MlW51aqUAkabTQ0FAEBwdTI0/VvoPL5VIwthltNhs1cjqd9z3HpsGCdXR0oI38e25rm9BqMNJ9l8s931OSfNHi/Gqnw6ERkUPFIjEE/xj7Vt3fwabBGvYQEKvNChuB5fJ42m1bNsd7TpeQqVm+suCP1KkpEAgED6z6SQeF6OlB+fGTWL+u8HmypfUA8MgMWrW68LJQJB7sj6r/LQ27zVq7dk3BKPK109eJv7pwXc/rqVPonbINxI6Ssu9h7OFCIXAiM/21ew57XI1tZLZnvis/gTUFKwVkq9cXgFO4dn2RTte8YGrKKzSu4ydPQ6bWoNPFRRDHifZWLaamTKIP90djr/X4yR/JO2XgjoJVyxeyt3Jf1p9s2OR+a+4suv569z6Y3EKvJmfs8Ie2YtkHXt8HArw5ZwZdf7PnAMycIK8mdXXCH1qfAHNm5dD1nn3F6ORLvVpQrxn+0PoEmJWbRdf7Dh6BLVDu1URdJvhD6xMgd3oGXR88VIpuscqrBVj18IfWJ0B2RhpdHy49CkdwmFfjdbTAH1qfABlp0+i69OgxuGUDvRrT3gx/aH0CpJOXETvKyAuDkWu8mtukhT+0hwIQ8yK9vjVvwrix9PvZ8xegjooFRxIKl6UNrY118IemUqm3E4iFDwJwT5sy+Z5Ejp04BZ4qBg59PfypeVJgfMyLyEcent6gKfgCuLMz05+a++GSMpoC84yq96bgAXDPnpnz1N337i/G/yIB9TMw9o6/AVb69z6hYsGFAAAAAElFTkSuQmCC';
	var img_medic = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAFdElEQVR42t3WfWwTdRgH8O+t167tOjZGu65lLzD2Kk7ezAQ1yAYxGAkYgRAlyEuMWIWIIUGS/aFUAhGDL7xVTYwYjYkx0cQ4IDFGYzQGGGRbF7dmDNzG2rE3trVre+8+17FBu3Z0A2LiJZdr7tL7fJ/nfr/fHYP/eGP+dwFqz9cXSbJUKYvyMlmWdJIk1dPxh02rlnc/0ABnLjZuI8hh0GorM9MMmJFmhCLLGBj2o+tGL4Lh8MeyJDm3rl09cF8DnLvkNsiSfGSGUb9rfsFsZJrSIEoSBNp5gXZRBCeIaOvoQlt7u4s64npl4zr3fQlwts5toaoPzLWaHWV5djAMcwuXIRCsBghxPIK8QOdF9PT1w9N6xeV4Yf1r9xzgbF2jhSo/UGTPdpTk2iLnYnFOEBDiRQQ5jnYesgJcbWtFf//Amj3bXqyddgB63pHKi21WR0nebVwknI/BwzyPEQoQCPEUToQQCqPV01y79+WX1kwrwJkLDYSPVl5KbU8WD9Fvjs5pUxi0uOt733p1R/aUA9ReqI/gxXZrcniY8PAoHuKEyDWDTgdPQx1qdu1kphTgUrXd0r9p37f5qzdWleaP4tKtZ54MHqaBqI4NA5uC1qb6rrf3vJ6bdAAVVxQcELa+6TCv3IwiGnSJcBUMxsHV66CbsLJAARpqD+3fm9wYGMOtS4odpjIbWixVyF36PMwzMwkWJuBq5SNxcLV6HavFoPcf+Do7Nh99p+abuwa4E88u0EAZGcSgrRJ187ZjQXEhjHrDKHQXnKeFiGYg9IyM5kvnwXFh9sThd6VJA1wmXI7BGZMFMsPCZypHY946VJQUARpNBJ0Ml+hGaaladHqa0Ovz7jz53sHPxhwmKTw4RLgZMljIVK1Ee0fmQjTlP4P5pSUI0WMYDobj4iK9D/RaLYao9ddaPSdcRw7tvtNi4uAmwo9E41Q5NOO4qC6tHK3v5kr8nVuNktJS+Kn6QIiLg7MI9vrgaWp0CTy3+/NjH0iTBqirsp+yLCx05BTqRtuebomqPIKHaVBRxfzNATTPeRodZauRP68EN/3ByLJ7Jz7S4yW8wcXzvPOL4x9OeCUzMXhNeoH14NxKQv29YIx0TNHGwUPgB/rpN50XFbjL1qK7bCWy8wspxAg4GvEqHrjRpa56VLngPH3yo8m/BwjPAqvpL1+7AJqgD4x+BmTWOBEfCUYqV3GRlyAJMmRqqvvhdeh5qBozZ8+hKSdhqLsDLY0qzju/PHUsLh4V4OIKWw0994PWPAWKwEFRq4/FAyPgB29G4ZKgUAAFjCYFdeVrMFSxKjLlmhsuU9sF51efHE+IRwU4v8LWUv7c4lId54PCmqj1hhg8QJUPRgZfLB65EauBxpqHP7UFuBqQf/dm5G76+tOTk+LjAQg3Ufv9izZUQOzthKzNoPmuv437/VS5iksJcf1MM/okHa60XHXRLHLucPvvio8H+OupnNmsUX+94tkSCDcoAHSQdBm38GHChx4IPh7gj+U5GrqduHj9IgrQTjAPKcUIgdotDA0njdOy7dw+BTxqDPz2pPW74qpHNhjk3kjFAi+PwgnwFMJTsyzoE8dwZcp4VIBfn8iuZtMNv5QvK0S4+zpNt1BinJZWgzkb3oCM9rZOavv08KgA6vbz45bDWXNs+212A4I+X2S1i5pq9DnFGtKgI/yadxDdXT0qvodwfjr4hADqdmbprFPWwjyHeZYeHK12aghaVanlWmhN6QjR7PA0tyEU4t/f2ji8b7pwwgA/PTZLQyP5qM6Y+obZnoNUPc0I9aODVjdvpxcBf/BHuu4i/Ny94nEDjG3fP5pVJCnKFmrxEgKH6NhB++ktDcOe+wEnCmC+h3v1TedP/wKRTqRd6B4B3wAAAABJRU5ErkJggg%3D%3D';
	var img_storage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADP0lEQVR42s3UV09TYRgH8D8ChQtllGCIiYwyxdKCbMrqAlRcEUwcMQZj9AN4oVfGK73wA2iMxBhHohgXKtAFlLKRKZsyTAyRUIZe0LJ8+55DolE4p7YNPjfnuTh5/r/3OW+OB7a5PP47wJNru0vI44UbskrP3v5WsSXg9Y1QIXkMCoNFwZ4u3M3qOmCZMc+QNu74zSnLpgDdrVj7yUvccPqNqlBeHyrdFFB+NXDdjeG0yu7M/Zb5B6Do6BW3hVe9vcsNKCy+DNvilMvDBX6hqK68xwNw+BIFGIzVLguX5xQygPf3uQEFBy9SQK1Jg+jYbAi8d8CyaIXQz4e+40hvW17DyFAD8mVqCqj5+IAPoAy2hUkYTDqIxTkE4InZBSuC/JnhjvS25VX09Rkhlykh8A8jgHJugLroAgNoNEAcL6Mb+HfAGvr6TZBnySlAU/WQG6AqOE8AEzA01SNhXyYDICsNYtfrSG8H9A40QZ6ZSwDh0NY84gYo1edYQAMBpDl9B3oHWgkgmwJ0msc8AKozsM1PQN9sgiQuhQXYyEABO5x/bwf0DLZDkUE+ZQABaJ/yAChOwzo/Dn1LEySxSc4DhjqhSM+ET0AEdPpn3ACF/BQF6FpaIYmROg8Y7oYyPY0C9Ibn3AB5PgHMmaFrbYMkWuw8YKQPyrRU+ASKYKjlAcjPO8kA2j5BEhXPApbJQG92OP+eAkb7oUw9QAG1dS95AHJOUIC2vQvSyFgG8J0M3MUOd6C3A7rHhqBKSWQAxlc8ALJjBDAGTUcvpKIo5wHmUaiTEwggkvze33AD8mRHYLWMoabjMxIjRE4DusbNKEjeDx9hJOpM73gAsoqxZBklG+gngHAIvOyAFTLQix3Ov7et2AETZAPx8BVGoa6xkhuQm3GIAXQOIjE8jAA8nACso2tiEuqkOAqob/7AA5BehKVZAugehjRsr9OA7skvUEtj4BtEAC1V3ICctEICGIG2ZxRxISH0Dsz9WEHgTma4I739DgxOT0MliSKAaBhbq7kB2alqCtD1muGqUiaIKKChTcMNkKWoCGDYZeEb5RsUA1O7lgcgWeHy8I0ydei5AW5LZ2srwB53h/9SX/+6ge2onzcLnD9PaXbxAAAAAElFTkSuQmCC';
	var img_bank = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAFH0lEQVR42rWVe0xTVxzHv7S3vSVWxTcUcHUO3KBOBTYXwcdAwFfi3FBc1DlnImMscf/s32VLzJZs/2zJ5jKzTB1uI5Ns2YYTRbY40U2nCEp5lYcMtFigpfRB6X3t3NtyawMpF0xPcnr6+91zz/dzzvmee2Iwg2I5k1FEmiOkZgZTt0g9kbK/vnK6Y8XMQPxT/ROFR/XJOdDoVFCpAMbHYaTnKtw9Fz4jEO9EDYCIF+uNWytmJz8H1lkHTcwgNDQHlSYO0OdgsN0MV3fVPgLxfbQArsRnH8sZtf2BGLYXsXoetI4BBD+gjgejewn3L79fRwDWRwtgLPHFY1rPve/A+jnMns+Bpj3g/F7wAgVqSQl6Ln3kJwB01ACS8z7Q+h+chiCMkYn3hgZSx4JOOorePz9+PIDyVKPo7JuTdU4/NAdP7/8Q6tFKqNhOeB0P4XG4oaa0oGanQmt4C5aK92A+OTLZ61kH2u/dUgJwfHWmqTRpTix43xhZXpbYnAXHcGASfdDuy8OilFRwjt/gG+6Ez+UBWXvEJu6Bx9YP76mLQIdaHk+lpTBI2pbunhMEoCQiABHXk8a6ZUOGnuvvB+v1QRDFCcQVh3c6u4U1MYGhVRQFOj4e13p73SRMIBDuSACHjcakr1emGuEfssszFyF4VgDH8/D03Z9SXJdgCIu1cXNgGRhEn22ghACciAQgTGuaMygEIExzAkDek4ujJl7bZZsaYB1NRQ3g2hg7NUDU1IMlIoBYlr9bIezYV4gOFzEfwRHIj9TyAvnaiS3A84KU58VnJBY4IZQTnwdjsb/4f0WcGjcv16Hzk70T9CYF2LaXALjZiMI9Z0JmNhQdnlRYepcXASjcvnpVOcDW4gJYRtgw4VFrH6w1VRGXV7PIgFlZBbKwVDngmfkUGv+5phygoCifAHCysG9oAI7663KfvW+XoeLzL+S4qKQUlV99GQJ5KhNUUlpgxcjSpM2jcPfWdeUAm3dtRru0AgKc5kYM3w6JF5eVSfmzx4/LuV2HS3HpPw9cNd/KuRXbD6LLTq5plgAsoNB056ZygNyduWhzcpK5nK2NGGm8IT/f/WYpavt8sFedlHM7D5XgYrdXmvHmpbHSFoC8W2NxSf/TFlIwN9crB9i0PRetw4xkuJHWu3A33QjrM7fwIJwXTsvxjgNHCIBbAhZnjKABBU4yENIWadHc3qAcYP3WTWh1sLKrk2dRmOV6iLpzv2KqQq3eLQsLHAIeWKxFa9cd5QDr8jeixc5MOE7ztCqsWkhLcVV56Bhu2/0Gfj/7TWjQxSYgbnlgRQhM+hIC0GtWDrA2dwOah5gJx2nc1eLAzN8/yO9sefl11LQ5wZl/lnPLMl9Bl80n9TUlaNFmbVEOkLUxB82DjCTIDFnhb7gU1keTsQdM/Y8hgJ2v4UKLE0L7L3KuIP9VVDcNS9uRbqBhsbUpB1iTnQ3zQACAt1vBNNWG9RFnXP3TqZDY9gO4eK5cjlNSVsO4dAXONzokQ6Yn0uiwW5QDrHphHZpsY7KrF9AqJKsc+Pev6ilNmJ9XLH092x940dk/CtFI6Uk6dDo7lAOszFwLc//YhOM0X6dGhiFWEnh0xuJyS94geZB6vmFIEpa+B+Qom0QAd5dyANOzWQTAP+E4jbtabMW6JX2uLFzdYA8IPiIcaAFTsg5d3u5p3IbZz6NnyB+4ascH5EMfGARvxTBBPnBtIygulnGQZUto1N6bhgmn3OgZFiUABoVjPU558GjwPyJEa07WkiO/AAAAAElFTkSuQmCC';
	var img_jail = 'data:image/png;base64,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%3D';
	var img_guildfight = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAENElEQVR42sXXbVBUVRgH8P82y/KWKCwgiyKDy4vL7gpoKiIjImYSCZgOZVGappKZZVmpCCqIWvlSZoaapkVZjOaCEWYi4iCipoB3VxRYmRXdRdgFxXjbmm6HSzgMOuPpUNPz5dzzzL33/zvP/XRF+J9LxPrgoiUr+d77XTs2Mr2rX4BXEuOE6y+zcv57QN8TP6poQQ+9KX+9soAsk3v3NPWxSE9dRhWekrYN8R65fdsno1frougA6Uo+JH4hrG3NAN998IwsK3pG/qjq+iTJiZK/E0SQODijTLMb0Sm6B/IeCvgpLZBXPjkL1t8s93ubc5zg7+NKBaiqNWN5XMv9veRxKXS/HMLTqVfoAHldgKgZsLY2wSVsp9BLXrGKKrynMjZtENamksWQOLpAV3AEMbSAH9d1AeKFCUjDM1FS0yn0TXV6qnCZl1xYw3xtYSlO6p5AgQbPrKEE5K4N5FWR0wWAa8QelOo7/9HpeypUbgtz0QIBoC08iti1lICcNQpeHRmDznsWuEXuw4VaKxNgjI8EjYXzYDtACq4wD3HrKukAmlQFr5oUTQBmDI46gIsGNsBobwluF8whAFdoT+UjPo0ScCRFwSsnThUAsqlZKLvBBggZJoHpeKIA0J0+jhnplIDDq0fwqolT0Nlihue0g6ioYwMEeUlgPDYbtk5kAqdPYOb6q3SAQ8kEED4ZHS2NGBqTDe4WG0A9RIKbeQmwc3KDtvgkZmVQArJXBfDqCRECwGv6D9AZf2cCKD1tUHf0WQHAnSlCwoZrdIDvVwbwqrBwdNxtgHd8LipNbACFzAYGTSzsBrpDW1KM5zZSAg6uIBMIHY92AvCZmYdr9WyAAA8b1B6OgT0BcKVnMXsTJeDb9/159bhxaL9zG8MTfkZ1AxvAz90G17Ofgv2gweDOncMLH1TRAbLeI4CxTwgA3+dPQN/IBpC72aDmuyndgPO/IvFDSsDX7/rzqjEhaG+uh/+Lp1Br/oMJ4OMqRtU3k2Dv7AHthTK89BEl4MByP149eiTaCGDEy8UwWNgA3lIxrn4VDgcC4C5expzN1XSA/e90AZRoa6qHYu5Z3GhmAwxzFqNy/3g4uHQBdJi7hRKw721fXh0SSAAmKOefx807bIChg8TQ7R1LADJwZVcwb2sNHWDvMgII9kebxQTVwksw3mUDeA4UQ7t7FBykBFBehfnbKAFfvEUAQX5otRgxMqkcJkaAjAAuZwbDUeoJrqIar35MCdjzppxXqbsBwa9XoL6FDeDhJEb5Z0ECQMtVY8EnejrArqUEoJKj1WzEqKUcU3hPXdquhqMrAWj1WLSdEpD5hpxXq+W413ALhoaOfgG83e0wwH0IOE6PpE8pAZ8TQGjEBDIBE/kt+LNfAJHoMTIBGUqLzuA1WsDOJcPzyTKtX8kP1rHFO65H0wC8/+XgvmXovfkLfpSsMEFeJ+cAAAAASUVORK5CYII%3D';
	var img_library = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAE5UlEQVR42s2XDUxVZRjH/+dcudxzgYRoGiYRfYxW8hXEMMCtdGU013Jt6aZzzYSYKQgoCiQXKft2sw8/2LCZJloN4V7u5VNsCUQISJirLVtzmIhp07nJvch9T+/7nvd+wWJ61tfdzn3P2XPO8/7+z/Oc932OhP/4J/3vAEoSky3vSA9UxC4vg9vlBFSVH3ltWxB7+UfvfbszSvHLrHioknAh7lPFSP+0a2Eb+SBbuiUAJL3Inzl3eCMIcWu+6fHHQD9Gt1lw/8QErskyLj4yD7Gl5TCbzTAYZN/zfHL2jDYaZAPm11y9TYDwcH4aQy5ByraAjLsA9wS+GKtFjKQ5PqdKeGF8IWRTGCR5hk+5Jwrwu54mCtMCYHgItS0dOHv1Jgh1ELciDqkmAzf1Od3oebcdSsRdCApWqF3MKbSrRIz0iAsPQtm+Ln0AVUdacOrKOBfzUv48pM00cVPvNSeqN9lhnBkJKdgMRkBEBgiPAngk2Jgyy4TPG3r1AVRSgMHLLu5oWUE8nogK46bukevYSwGCwiIh0wgwpYRoExIWBQIRCSB1djAOWU/qBDjcjIHfx/nl8g3xWBAbyc+/+fUK9hQ3YsYdDMA8RTVRfdFIm21CrU0ngKWWAtAIMIcrChPw5KPR3HT8zDB2FVGAsDs1gEmqiSg+FpW0KBOO2Pr0AVRQgP5LLu5sZVECnkp5kJs6+s/io0KbLwWTVPsiAh6BLx06AV4/JACoo1UbE7AoM56b2jtP48MNVhoBLQUe1cSTBq5eg0qPCsZXjn59AOUHGYCTV/jLmxLx9KJUbmpt78POfCsMtAakIFGEfqoJ0V5JNqbTFNQ16wQoO9iEvlEXd756cxKeeS6Tm1rsndixngKwGjCap6hm10SsBQygvmVAH0DpAQd6L7q4mjVbkrF46UJuaq47hvfXMYAIDsAVqz7Vql860ucosLbqBNj8GQNwcue5Zcl4dtlibmqir+d7axt4BCQGMEm1Z2S1Mf8eBbY2nQAl+x34TgDklScje+USbnIcsOHtvAb+GkpGxQcQMGp1kUEBGttP6QMo/lSLAHP02tbHkL3qeQ1gfwO2v1rPARCkTFHt9i5KKjIpgL1jUB9A0T47jwBzvt6SEgDwZm49DKERgChC4lf9nlWRvT4ZcxU4jusEKKyxo2dkjDsvqAwEqMo5Cjkkgm9G/tWvbc1aJHgEohU0ff29PoCCmkZ8+5tWA4VVKXgo6WFu+nnwJ1S+Ugc5lKXAPEU1ByEiBXPNaD4xpA8gv7qR7nxj3HnxG6kBt1asPgqJRcCoBE4sFiSI3TEz2oyWTp0A66pt6OIRUFGy/XFsy7PTcBNY9i7B1pxGyArdng3BYiPSVPMuSKwLDCIrhgJ0ndYHsHaPDd0XxngRumk/SG7S5gSytuC43bQdMwK075us2gtCh6yYELR26wTI222lEdBSQNzMoZsesjahm/CuWGsBA1VDrIhszLo3BG09P+gDyN1FAc6PBVb4X+TaX7WvIFXaxDCAM/oAcj6xovP8De8rNV2uVdGUwDMKyAX3haK9VyfAmo8bcGL4xm2r5hhiZWQAx07qBNhJN52hUae3t/eqZtcetapHtZjY04+L3THxbgU7bLfYD3g+zdh5jPE6pKVvaR8mkz+9KMWUj5G/4cNkDv7534XpU/Av//4EPTwEXWE0nq8AAAAASUVORK5CYII%3D';
	var img_info = 'data:image/png;base64,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';
	var img_homepage = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAACZ0lEQVR42t3X24sScRQH8O84uhfHdHS8bLWW+5Cp+AfEQtBDD8E+9JAgBFtZFFFULF3pQheoiKWHCIKIkIpAQXoIgqg/IYJAQwlkQWTTdGd1bN1189JMzVbrDORCP5UOHGb4zTDnw8z5wRkKPQ6qLwDBYLDVi+LRaJRaBWi1uuOgfpb9DQgEAi3GbMP4sbsQqk2ixVmGxttb+38gFADfvmnwXxtEAVYjjXf3DvYhQM/a4Jm8QxxgM2rx/v4hdcCWvbcxV6kTBdhNWnx4cEQNYMVY8CaKAmEAq8PHh0eVgGERMLrnBorlb0QBDvMAPj0+rgIwWeHYfQ2F8jJRwIhlEDNPTigBQyKAm7iML6UaUcB6bgjZ51MqACMH466LyM8vEQVssA4jHz2jBAyKAP3Oc8jxZAEbrXrwL86rA7Q7TiM3t0gUMGrTo/LykhIwsI4DtX0Kn4tVsgAHg6VXV9QAFjTGT2GWMMDpMKD++qo6YHnbScwWFogCNo0Y0HxzvU8BlokLKJbINqHdokcu0rYLej4RSQCv19uV4pNnH+HZ9GEkk0nlG+h2/AJ0GmKvmDKZTEmn06HZXD07ajQa1Go1uFwuNhaLlTt95poB4qH0l9v+c4Db7S4xDKPYMVJnV6tVpNNpeyQSKfxTQDgcdvA8vzUejz9lWXazVEwNIK0JgpD1+XwHOI5LhEKhfKcArZg6MTVi0vI67fF4jH6/f8bpdMJgMICmaTQaDUUDroTUiCv3VCoVZLNZJBKJsVQqJYiXpXFbUjflc2n2q1N/QLRy0jKEEgFmCbCWz9QeMmC+rXhdzlbP/46/A+iCNDD7N5RfAAAAAElFTkSuQmCC';
	var img_photos = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAFaklEQVR42u2XyW8TZxjGnxmP7RnbseMlsYuTONAACTSkTakoVemh6orUS1u6sAU49Fg4AAHaC1IJISCE+APYoT310t5aUdpegFRiVRtBISFumsVO4m3Gs3wz09dDQKoqq7kQkNpPGn32vBo9v+95l7E5PObF/Q/wRAAcPXLEfhzin27bxj0E2LRly5yKnzh27AkD6Nq82Qns3L79kQr3HTrk7CePH68OEFmehOgTMT0xBBe/CI1L3kW4PglNBSxmw7JsmJZFu3V/Z5XdhGFaYKZJ9+kzM8EsBpO+6waDZhjg+4/ODsCIpjGVG4Ra5tC+/AO0rtiKTCaDUKQZPO+FadiOOGMzguZ9AMYqEKYjajAGvQJhVnYGm+7x/YerA2zctMkJdO/YAT7+O+DPoZQD8hkRicbXoFkeRBqWo7XjVXhdHsC2oenWQyFDtxwA3bwvWrmsGTcs2wRnW5B/PogDBw86OqdOnKgOIIuDEGoUiN4ESllACtpQ5QDGswyr3utGsrkDHAN4epqRG7quQdFJXDdnHCEXyH5UxCspIhiV7sk/9c0OYFi7hxIdv62jBTBUaKaCaDCFsbFp+OpfxMo3PsTdgW+gKDVoXfoO3C4JBVkjJyzHfjdXuQjMMAnMgEbOUA4web63OsCGri4nsGvnTox7h8BRKBBwQ3AxKJM6dFWgsVWG7atDeF49yqVRTKWzeOalrVjSuQZFueykQOQt+AQqUqqLfNlAWaf8k/2V2sh814Pevj5H5/TJk9UB0vZtQODIZhd0RcbEUBHBeh+CNRKmpiYhRix43UlIQhLhppex6s0uqgcDft6Ei06uaHRyjTl5L9FeNCpFaaHw/b7qAOs3bnQCu7u7kbZuQdfKKEwbiEUDuHtlAk+/EIPX76HPGQhujoBEePgwXN4U3urai3g4CpganZSnU1sEoKNsmE6bVi5m2hj7di/2Hzjg6Jw5dao6wM2Ra5RPDTZ4RGMBKCUNdY0SlCJZmtMxOaqgptYLl+1Hsq0Db7//CZKJNiiqimzuFvW8AElqpJQYTu4Ng4PJ8rj59eHZAVwZvIrmjjBuXx9H0OXDilUpXL54B8ODOSxsTcDvk6CVBBpWASzujMJHLoTCDZDJuUz+B0zngcbgGkQiMorqn9QFIRpKRYz/olQHWLdhgxPYs2sXfrzRTz3G0LEkBJvsMwwXmlMRjOdKGBqQEY34qL3IARePQI1B5RLFimUr0d4ewoSSxqScg8clwONmyMvjUO0C7RrGLjWhp7fX0Tl7+nR1gHtTA1B1FXLOwHPPxuD3cHCLEpa2NWHkjyJGMlmIIoeW5gUQBD+CNC8kitdTXeTUEShsAoYtU/XTQNLdlAYRQ1PDSF+MVQdYu369E/hs927kxTRS9RLkjIEbAxk6LY+6qBcNdSI621vg9yfph0QtakM1NLKL0C2Dpl0evFSEIClwCQzD+XGA3h0NoQX0vAeylkP/BYZ9+/c7OufOnKkO8OvwLeqAIpJ1QcSp/WLhAAm6kKWuiNfFsWb164jHYpRXlaydoKJjVPl5GsPUaloG0/okOEtEvbcJoVAIWXmUijqP899Ozw7g4vVr0KiNeE6gy8KC+TGsfqUTLalFyBVUlGnAjE7lEAtJ9CacRDweIMgEtacXqkq5LtwBL5QRlRaDeUWMFa8iWx7Eb+cT1QE+XrfOCXy+Zw8u3bjizHIOIpJPJSmfHBK1EhbNT+H5ZW00Hd106jIuX7vtDJsQFeK8eITenkU0Ny2kCXgPJldCqm4pyqyAsewgSqyISxd4fNHT4+h8efZsdYBHuf4VYK7WPwA+Wrt2TgG+Onfu7wBzqj6zHgDMexziD9aT8c/oPw3wF5kNaWi365KtAAAAAElFTkSuQmCC';
	var img_counters = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADIElEQVR42s2V6zOUYRTAj/oXqi+FZTeLtLTU1OiyclmZyqBIyKVVyiXRbiQ+EGpluiAlXSlDYXxjMHbaD2Zadu2NXS3W2k+VJTOZkWqzz9aLpuZ97Lw7db4853femXN+855n5nGAfxwO/50Am80223OgVCpdNfOPApyAILsMF/X14At067ooHR7M4K5dgJZOp2S4vmbMNoE9gn2UCPQLxbYJRBXHUiLQWtRkmwCVsWYBewS2gF2m/wxSAS431FxdUw0f3n+kdPDGTRsgIz0Duro6yQUKC4vAMDVFqYCToyOUlBTjCRQUXIVJgwGxqK8XnRKJBPiCPFKOV7UtNzOMQmNYHkqdnZygtPQankB+/hXQ6ycRt7Q0odNoNEJODp+UEzuvLzdbtx6ehfBRSqM5Q3l5GZ4AXyCAiQk94lReCjpZLBZkZmWTMrMyZbnZZjpoTxSg1MWFBhVCIZ5Abu4lGBsfp/QO0F1dobLyJp7AheyLoNONIZYPDRI75qWmkbJWoyZ6icViVLMEg0GHO7dv4QlkZmbB6Dsd4p7uTmLHSck8Upa87Sd6qdVqVLOE21YGVFXdxRM4dz4dtNpRxJcFucSO4+ITsXllzRJMphvU3qvBEzhzNg1GRjSU3gEPD3eoe3AfT+A0LxWGh0cQTxkmiB1HRkWT8peFeaKXSCSCEG4Yyj09PeBR/UM8gaTkFFCprJdJJpUQOz5yNIKUv31dAKVSiWrT09MQGMRFuZfXNnj65DGeQELCKVAoVYiFN8qIfYYeOkzK5u+LoFAoUM1kMkHAwWDr9+1e0NDwHE/gZFw8yOUKm3ZtEZDL5SifmZkhBLy9WfDyRSOeQExMLMiGrE3mP38idnyAE0TKYF4EmUyGarOzs0sCISjf4eMNzc1NeALHjkcvvdtDiCf1OmLH/ns5pGwRWHrzUW1ubg44AdY/wGb7wOtXLXgCEZFRMDBobVJfV0vseNduf1J+I+pd1W8/JxCdfr5saG9rxRMID48AycCgTXfgb7HTzxc6OtoxX0O+ADQaLaUC7u5MqKjAfA0pnfxbkAlssefwFWH8lfwAIrYWPxGyPMwAAAAASUVORK5CYII%3D';
	var img_comments = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAE6ElEQVR42sXWX0xbVRwH8G9vb2//XNoCZUALHZvjPwEZc9OxTI1Z9rL4spjsYYkhMTGZic5/xMQlGhP0ZS6bL/qkJmoMxviyaKKTGN0iKjplEKTjX8YKdIX+obS0pfefv14KUtrSjiCe5uSce+/pOZ9z7r2/ezT4n5Nm40HbhRtnqHiGcivlym32eY/yMOUPh94+/kXBABr8Y4eN73LuKYLZpINep93W6CuChHBUgHshgjn/8qeEeDovIDlzeynfe7C2DLKiIB4XIcnKtgBaRgODgQWj0WBw0k+IyFlCfJ4P0H+kseKoyJpglGPbXPn0FGOM0ElR/Dbq/YUAnfkA0ROHnMb5ZQ14TWJHAMsKh3JeQd9Nd4wApnwA5eRDTswtyShixB0BRGQWDguDa3+4QQBNrnbrgBMd1fCERPBaOa2Ba2ZRLRuri3PWs66AxMBuZdH350xhgCcOEiAYB69j0hqMz4Zw5WwDTHoWz340krV+8buZTIAgw15iwA9/FQh47MEqeALL4DldRqNXTlar5aVrMznrGYCEAHqz8NOt2cIAx9scuOdfohkZtn/jN6ToShyVNgtuDM0VBjjW6oDXtwij3pi384TsRlj4EVHxFkQlUIjnLuVvKH/Q/9Kvw1kBR1vsKsCQBxAWv0dY+hJtjU04YLeDZVkoSu6gpaGAJIoiJj0eDLlGIUrSi4R4LwPwcHMl5n1B6PU5X1kI8gwCUg+OHT5EMxeQEATIsgwFWwDoxzAMOJ0OrEaHn3+/CUEU29ZWYg2w2FFfbg0EguD0fM7OQuJnOFDrhamIQzyxsuXA2SAGTo9oJIGh267krXhuI+DrvRWWU6wSpSWSoePMWTuZF86j83AzQssumnlFwYOvJYbxwso3JlchRIDijYB2KvprSjVGhj4mkpR9ZgHtqzjS3obAkouOVgGzngW1rLLvyVn/N3lRamnEwOAQCKBZB6QQT1Hxid1WZNQjQiuximB1BlgsFrU+FepCe0sTAcboaLXj+YUg3n3yMjiOxQtfPZ+13nP9jdQoCwSox+DIaCYghdjPscyU3SKpt4JhWFhKSuHxRRFcioEv60ZrUwMCoXFqXbb+v9cffVMt37n+Vs76avKh1FqH4dHb2QEphLK3WEZyAcxWG+YX4zTj2FW6dLqorFtsqa/LABSeVgEjY+NbA5xWCQZzMQJhEf5QbIBOP07RLNZ5+RGlua4WvsUkwLYNgB9lxXX4e3xia8D+SgPCKwx8wegEneqkwdUnigCLBLD6g+O0Y5LvE+Gn3RIDW4kKSH8LNgPKS0yYD0YXUoNPrF0jwPv7nM5zojiLaDwB5T52bRQQYTJwFDmrcMftTo8DmwFUxFLLPrDxGgFatVrtUG0Nh/BynIKRQK+sXBCA07EothgxdZf2m5KUHgk3AZJbotM0+NVsHRHiPIXWK06HA6yWUb8D6d8CQT1OCHHEVgL0HZDUs1ZzDea8XgpgSua3YBOgmwa/uNVsCJEMXOcon6Jcla2NxWymJ55HKOKBICTo3j+A6ZnZ9YcvJ2CnEiF79Bx3wV5ehqWIF2a+EtOzuwhIIV6mZ+ZSdUUljEYDXJOTuwtIIc7QIL0V5VYsCerWzdzXNRLZNUAK0WwqCY9QNUi5hQCe3QLoKbPJsrSJN3e8tu/O9Le+hvFe79h/DXDkuT63VvkHqZVVPwHuA9sAAAAASUVORK5CYII%3D';
	var img_simulator = 'data:image/png;base64,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%3D';
	var img_dungeons = 'data:image/png;base64,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%3D';
	var img_market = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAADWElEQVR42sWU70tTYRTHz91vr+mWy+lyNn8n/oh6kdiPUVSEBLkkxCQU6kXhi9AXvk3Rv0DpVURFipRY2AxCKiNYGL4xak6spTmdzqZb++Gc23W7PdPuXfPOdM27vnA45577PM/53Oc5z8XgPwuLlFSpVEXILWu12pm4A+TmFpRNTn4d+Q3SiiDa4w0Q/Hp9Q8MN0Gg0wRSrEBGPAEG0IdcSDwhsqxfxgsD+9jIeENh2A9iG2BaAbYgwgFapKBW5O8hqNg/8JBKDDhkFkb04h2z+X2r2IrvVZl1dDANAxauQuyvj81NlAn7Ema+5OAxxcBqi3G6BMsdiVNUtPgIsBBGcdBNB9NMA2kNKUn6lftsFukbHoOejnoa4lJ8F6rysqLfB/KQLVJ+NGA3wtjiTLE237mjyPXsy3EdGQdzmGeAIxxkVgG5BCmf0syGAwYNysiTZvuMFHnjE8MizAdHc3AymowlRAYw5JVDxxRwC0OTIyBKeI6pFRkkRVBs25kwWCKMDWBODesoSAug7kEJGtcIuqHrGhoVdw3elB7TZKY6TOJ9gregKwYPvNsmH07qZ48HnMADUiBql2FWZJPDRuecGAmxuEq4fFsQUU3L5BGB0JA2gBlQzAN4UKboUie46idBL53TOAFhcATibwYsppmT3CsHkTuw+N26qZwC8KszokCesNEqFq3RuWYTB0nIAsnhYTDElq1cEZg/eeX5irokBgK5ii0yw2ib7A0B8qhydGwnE8EhMMSWLTwQWr6gdXcFWBsDL/PRGKd/bIRd4WGtCsy8BrISw6YJhoZMB8CIvrU7CJboyeSusAcyu4WD38+svfvvRzQDQ5KRWJnHWNEpuCGAInWGwk6vTuDHFlIx+HFwBnlo9tTjAAOjP2ncMB/9wDicEML0HW+/kMvTLiCWmNBXAYQW4qqrppfcMgGdKaZEQAvp8MgSA5XDXO1lqIWOKKRkwHLzAKb5stI4zAPoyU9J5QJoL/W46p6g9sd7JtqfDMcWUJriJsAaYvHrWtsAA6FXsTeCgv2Ux4Qa2pOcnQgAArzH99DAAgnqcITEpfasZyQH/rhd3crhgFIjmaufsCvqINw/q2S+uQO4hsnQWNiC47deuzjsGtwJQslB0Kxkj7kC89QuxLzI/VwpQpgAAAABJRU5ErkJggg%3D%3D';
	var img_options = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAACqElEQVR42sXVT4gSURgA8M8WM/y7GR5MITVJ1EjBg5BiYVAU2KFDQbc9FG2nTp6WDrEnT53aqMPegjp0SCgKkk008CDokiuGqYHmQbL1L2uybc7UDE7v+XyCTh/IvPF93/t+b8ZxJPCfQ0KbuOZbfjQ6rFKmb6wnd+/OG3Bw/44Vfg324ZBsCZvDzT14XIQRgGrtmQBrK2ZY3yyT8/7mLATAXAHS7mhyJgJCodABLWYeEY1GJQggHA6L0jwSiQgBgUBA1N1zEY/HJTzA7/eL2jyRSAgBLpdLVEA2mxUCzGYzP3m0sQ3KFvq4dTVm+KE7Q1yYtrZcLgsBWq2Wnzzd2GKf55/f9/jvDh87wj7fn3TniQDa2mazKQSMLxLY34bwVT0M6j3+O5leAZFXdYgvka/ALLU8gEMEg0Ho9Xog+/h04i4GZ28RAdNqFQoFxGIxtjkzJwCMPiwAPm+BYhe9j73l0e/kFPkWTKtlAKPmeIDP54NutwvD4RD6/T575EIqlYJcLmePpJhWq1QqIZlM4gFer5cFLDIYQCqVwgM8Hg8WsLOzwx4dDgdVE1I+A0in03iA2+2GTqcjKMjn83D7xjl2/OT5B7Db7cTm0/JVKhVkMhk8wOl0IoCgxyA433gWIwJWbwYF57F0DQHkcjk8wGazIYDxuOg9QXUL3qW+TpxjAIVCAQ+wWq3QbrcnFl/xnaQCvE5+mTinVquhWCziASaTCQGUSiV+fG/lMhXg4eYbfmyxWBBApVLBA4xGIwK4dsEpOH/5PkdsPi2fAVSrVTxAr9dDq9VCFr1+6c+r+sXbLNUVIOVrNBqo1+t4gE6nwwLmGQyg0WjgAcwrWQwA9ypGAAaDQZS/4lqthgcstPM/gQCmIbgC2qBdixscF3P3Y/Ftpl0tIn4D01uKMCUEL7UAAAAASUVORK5CYII%3D';
	var img_optionsB = 'data:image/png;base64,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%3D';
	var img_Lp = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAAZiS0dEAGwAKgCWiTfUdAAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oLCxQ3ET44qJMAAAYkSURBVFjDzZdbbBxnFYC/2av30jj1ZXYTHKeJb3EgFxPRuKSkchWlFGhVIdIiREJ4CbQSPPCCBKoUqSKlFUhIlBRRReSBpo3aEFIVVAmBeAFaajchIXFEHJz4ujuObzt78+7MOTzsem0njrFjqeJIs7szGul8/3fOf1n4mKLj+FY6jm+947mHjy+0fC0I3+yP7/zhmwIYWn5VSx+oKlq519l7VdX4a19+3VotlTEPQJ/Y2cWEmyLkCRLxhQDIODnSThZHXDyGQUD9DCUS9A7/R1U1fuLAG9ZS2m8zsCDn+eeuzBlQhSnXZrpgk85n6LZGQZXG+nUUqlzGZiZwxCHoCVJfs5Y22WRcGb6eOHz6mfjJZ05bS2hf6pnhmQNQwt4QTsrhQv9VZzIzfXEyO33xfH+vI9MOUV8IV4Wcm8cqTBCtCbNl3SZDRROHTh0wV12C5979hj794Od5p+fPzLjO27/40q8PADx77tBbfo//K+1bmriZGSn3gkGVJ4AZuJ+Uleby4HVV1fjrB88sVQ4tazcWnQUqpTKUbfgAOturL4788WpLbswmZ2fLDaiIClknT6IwTrQuTHvDJkNFEl89+dSKTSwoge2k2RzbgIp88dvnDr3VfGRPYvKjwe2RKWX81jiFzAwiJQBXXTKFPKOFcaJ1EdobNhsqmnj6xJPmPZXgW787qJ/buYtUMY0z5XBtdABVpTrl5eLZv7H1+4+QGbcJmlEUrdgACHoDxP21pJI2l25cU1WNnznye2vlBiZTjOZukQ3kad+ymfYtm4l+up6CFJm4biEoTr6AqCCqiCquCNlinpGZMaL1EbY2Nhkimnjq+OPmigFC1WGKrsOE2PSnR+jPjHArP8najvWM9wxhVPkoZouVMswHyZQh7quP8MmNTYaIJJ74+X5z+QCiBDRAwOOfW/Gk9B1uWEN2cArDZ+AWiqWkUko8G664pAs5hmfGiJoRPvVAsyGiiS/8bJ+5LABRZXB0lFighoDHX+l2UaVq/RqyIynwGrgFF1VBVRARXuk8wSudJyqNmS7kGM6PEY1H2bap2RCRxGM/6TKXYUBi73z3NeyxDMEkZQgQETxhH066gBqK67oV7TrPQKUn1CVdzDKYSxKNR9i2uQSx76W95pIAvUffs91cMX95sI/seJp4oIagx19aOANeZMZBoKReSqMXlTmAec9cmYO4Lx5le3OLIaKJrmMPm0ttx1HAVtHYtcQQKStDPFBLwOtDiy6Gz4OIoMxrPrnTQAmwBGkXcwyUIXY0tRgiktj7wkPm3QDSQPQ3B89Y/ppw7PLNPlKWzTp/HUZW8EUDuI6LYpST3WagMivKl5RM2MUsN3MJouuj7GhpM0Q0sefobvMOgPd7p3PAcGd7dfMbh89auaGphn/dKEEEhhyiD9SgBRf8RkX13UpQ6RFRxJ0zUbdhLR2trYaIJu52IjoJHAY49/xfhkU0dqm/j773LtH26A48OfCG/QtUL1qC22zoPFgRRUWM3T/c5VkM4FXg2c726p0AZ468a429+c8nx64MEY7Xsml9I6FQCOXOEswmeXP/bzm9/+ycBaDKE6Chqp5k/y26e3sR1dgHP+qRBXvBbHS2Vx8BXgZOAQHga941we+tebz11Z27thGJhbmZTZJ1ZhAVTu17e9H5/fU/HSBbyBPyBmgMxUkNpOjpvYqqxv5xrMe666H0/d7pXwEbgUvA34Hav35g/dJYWxW70PdvUiNpNlSZBMuL1VIR8gRoDMXKyXtRlQXJFzWwVDz20y5TRZPbm1qIxMPczCbIlE2oztshDQh5gzSGYtiDNt1XelHV2IcvfmTddTtebux7+RFTRZM7mksQN3IJMsV8BQIMQr4gG0Mm9oBNd1n7YsnvCQCg69jDpqomd7S0EllXNlHMo2hp5OEY9oBd1q6xD188b/3PA8lKY+8LnzVVNbmzpZXIJ8IMZCwUZUOoHnswXdHe/ePz1rJORPcSe47uNlU12dHaRt3G+1GFsRu36L5ydVnJVw0A8NDznylBtLWhKN2XSyPveemCtaIz4WriwR/sMlU1WZ4Fy06+GoBawF/+b+kFDG/Q6wHEnXEdwAGKwDj/7/FfiwI9tXEi/zYAAAAASUVORK5CYII%3D';
	var img_Lm = 'data:image/png;base64,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';
	var img_Gp = 'data:image/png;base64,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%3D';
	var img_Gm = 'data:image/png;base64,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';
	var img_auction = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAD6UlEQVR42u2XX0xTVxzHv/1HK730LyC0CEWtTKodnbNWYDLYwDL3LybbYraH/XnYlu11yRI3zZxLTHzdsuxhGW/7l5ht0Ukgw3SCNLitTrwgovyptJa2gEChLVC609NYLNwmjW2jD/smN6fn/O6538859/T8zuXhIYv3SAC89dGpN0nxPrnMOfLpI9fX353+uG0DADE/VlxU+JmhugpSKYNoNMsjJENcWAiAHRiC1+c/TiBOrAe4Y21pKgmFl7ASieQEQCgQQCLOQ3tHl4cAlK4HiJLG7LqmEPEC8Upad/8DUACz+UncnZ3PqblCXoC+vr+4AUymx9G4tzojgzOddhxutiTV75dSIYPD8S83gGFXNZotuzMC+PF8N15rrU+q3y+VUg722gA3gL5KD2tdTaKxdyyEiyNBjE2vZGHyOUU3JvunljYKoKvU4dCBPTTy+2AQ12YE2G/UQJwnRmQ1uxuDgM9DeCmM3qtuOCfnj1MATVkZfP5pesOAqAZvvGCCyx9BMLyKLPuD+GOTmA9toQBtZ1kPBSgq3gyvf4recJ2pxxGrAaPuMHbN2yBbmUp0nhOq0V/QkJaRbrIHdeyXiPBFYHe/CmNBL1RRN2zC19EveBaVGjG+b2fja0ChVGPS56cdR1SNeKW5GqN3Qjgw+wtMxrXF6bjajz/lL6cF8F67FUzIS3+L9pVgkzo+lavg41TeTygtVePnzoE4ACOTw+P10TwwsbkFh5t2EoAgGgO/bQC4wLyYFsCHHQchDcdnT2QmAIVrAF8IfiAAhTjTNUgBJuRqldbtnsTS8jI8mufwUkMVRtyLaA6d2wDQKTmUFsB2Xzda2dOI8ISwG99GraoLCvjRET1C/gJWbNXk41fbEAU4KpFITookEgRDYfTn7cPzT+lxy7WI2pVLkEdnEw+d5clxSVib8UKMaZs2H2cvDicOJMcQP5CUDMqeRmvddtycCGTFKOUMlTE433Nz45HM8rk92mLZiuHbuc0N+i0F6LCPcAM07dXhhnOO1t+pK0qKf9vjy6jtnnaUy9B1eYwboGFPOYbG4+9+bvSfpLis8omM2u6pqkIO299OboB60xZcH7ubcvrebSih5Tc2zwO/gsd0CnQ7bnMD7DdqMTg6k7JzYNxBS6bC9MAAOyuVJB+4UgFowN6aphvTB89oE7Gv/nAl1dcrFk9HsYOqYZuKJiQugIlGc7mWHZ7CQmiZjPZKIiYtr8GC80rKB8fi6ZhLJSIY9Gpc6HO6uACOaoqZkzsqlAgsLmM1y+mQT9Ihky/CjfEZuL2BTzg/zQhEYmPKqvuaYqs3diA5wQWgypEppx6Nj9OHqf8Awy2kKvD4QZQAAAAASUVORK5CYII%3D';
	var img_gloves = 'data:image/png;base64,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%3D%3D';
	var img_shield = 'data:image/png;base64,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%3D%3D';
	var img_wearpon = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oLDBIoFBpSFokAAAAdaVRYdENvbW1lbnQAAAAAAENyZWF0ZWQgd2l0aCBHSU1QZC5lBwAABNJJREFUWMO9lt1PU2ccx7/P6enp+ymlhVJACgV8QZCKohhGAqHEgS9s7mLJNDHxatvtNpfsYll2s2Uvf8Aul7jLZZu6OEUnUZwLSDWogPLmirT0vfa0PaftOefZxTJjlo250fq9/eV58sn3+/x+zw/YQIOdtdxITwsd7WujAHDylX6UWsxGRUpVVFQ6cfT42xjuaXnn6+/HXzAAAFUporO7D8eOv/mFz1t/GAAGvbUvBkDDaMBoOKythdDdN0q3ew+c691mPXHlTvDFABjNFujNFjwOhhCKhklH36vUs63zKwA4cehASQDYjYqKrKCYF1HrclGHvYpkBYn0j5w0KkXx8zM/3nyv7A5khKQcCix8t776kNhsNtS5qkC1Bmxp3vU6AAx0uEh5IzDx6uXba8du3xgLCkIaJr4C1ko7XE0764e63PTq3RAd6HBtCkCzUXFxLQkAcJrxbmub17K9bStMJhOKlCXpRBA0+Wjyl4XkYtkceBpFOm6+e+sahVJEVaUJHk8LdnYP0UpH1emyRgAA/e3V5NpsnJ+d8ZN4IgGWZcBb9Gho7SBNbV1WNwt92SIAgEeR7B8xWPCRp72H1tS6STSSQDKRQD4vuTgu+0Ozyxp8EIiVL4L+9mqIkrT7yvlvycPFJURiUeTELBx1HsrpTFNnJ+Yw3N1YHgf+dKHRrmvOiOKpKlcrGABmiwVGI09AZaix+fjYneBk2RwAgOvz8RtFURibm7uPfKEAgMBht6Orx0cdNXUfl7ULnk7GfObXaGgZKlUhpFPIigIykkz2D76maeZgLyuAb08Txu+ufxgL3Ec0ElF5qxUGvQFiLgONqYrvHT10qqwAl6dXMLSvFYNf3mNWl2cZh8MBrU4Pg4WHSllKioXPfJ011Oeto4e63S/7vHUVz3Pvf57lvr0t5oqaJmH0jbegRhagxleghO5BhYw80YMyHE08yZLFlCSc+WmaH97nwYXJ5c11wbNqsLOchuU+0D6eROG3WzATAaJMMLUUw/WZFazHYyQQisNotOicFVz04q1HU//7O35WQ11bMOZfhZblhp36AtSsgBDMGL+5gkhKRFoUQRgGKVGGWFSR06TR2OTh4A+gJABj/lUM7HJ96rTb3s89SdCLoRyRlDAopbAYDPDwFViN5SDJeaiKDGsFj0R03VDSNjTztvboegiza0+IIMkoFGUADFyVevBGE1iNioykxa5OLzLJkP/cjflPjr60o3QABoOOz8FCY6kspGIBQk5CJichnFGQJiocNQ6MHOydzSTWTv88s77Ht7seZyfmStsFB/d66ONwijIMeXpWo9OjvtYGligwmeznvzk/caS/vRrj9yKb2wn/quF9zeTC5BIZ8DZcIJRmFFUGqJqntHicUkrdDQ4SDguHh7rce4oFcbosc+Dv1Lujut9gsVzt278VoqTA758PX5oO1Gx6K37uL5WoM5IoIpMVaUuDkwRD1U6fV3bIssKrqrJ8bTZWmkf4T5JlRdBpuXMFGaRSz2Jkt5t2tDZEed66pOX0urI7wGg0FkLlI3aaRy6aRCKeIwUhBbPVDhWElj8ChiEsy2HqfoDeWYiRfL4IldODYeKLUi6jbnoj+jdtsTESYXUuiWr3prMSDFYbGKJEL9180LgYFpSNzv4OMY4SsBTkR0YAAAAASUVORK5CYII%3D';
	var img_armor = 'data:image/png;base64,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';
	var img_helmet = 'data:image/png;base64,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%3D%3D';
	var img_boots = 'data:image/png;base64,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%3D%3D';
	var img_loc = 'data:image/png;base64,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%3D%3D';

	var spanMenuTab = document.createElement('span');
	spanMenuTab.setAttribute('id', 'RightTab');
	spanMenuTab.setAttribute('onclick', 'if(document.getElementById(\'RightTab\')){document.getElementById(\'RightTab\').setAttribute(\'style\', \'z-index:501;width:20px;height:28px;position:absolute;left:912px;top:230px;background-image: url(' + img_menutab2 + ');background-repeat: no-repeat;cursor:pointer;\');document.getElementById(\'RightTab\').setAttribute(\'id\', \'RightTabOpened\');document.getElementById(\'RightMenu\').style.display=\'block\';}else if(document.getElementById(\'RightTabOpened\')){document.getElementById(\'RightTabOpened\').setAttribute(\'style\', \'z-index:501;width:20px;height:28px;position:absolute;left:848px;top:230px;background-image: url(' + img_menutab1 + ');background-repeat: no-repeat;cursor:pointer;\');document.getElementById(\'RightTabOpened\').setAttribute(\'id\', \'RightTab\');document.getElementById(\'RightMenu\').style.display=\'none\';}');
	spanMenuTab.setAttribute('style', 'z-index:501;width:20px;height:28px;position:absolute;left:848px;top:230px;background-image: url(' + img_menutab1 + ');background-repeat: no-repeat;cursor:pointer;');
	document.body.insertBefore(spanMenuTab, document.body.firstChild);
	document.getElementById('content').appendChild(spanMenuTab);

	var spanMenu = document.createElement('span');
	spanMenu.setAttribute('id', 'RightMenu');
	spanMenu.setAttribute('style', 'border:solid 1px #56381d;display:none;z-index:501;width:64px;height:192px;position:absolute;left:848px;top:230px;background-image: url(' + img_menuinner + ');background-color:#3c2a16;');
	document.body.insertBefore(spanMenu, document.body.firstChild);
	document.getElementById('content').appendChild(spanMenu);

	spanMenu.innerHTML = '<style type="text/css">.colorfull a:link {text-decoration: none;COLOR: #ffffff;}.colorfull a:visited {text-decoration: none;COLOR: #ffffff;}.colorfull a:hover {text-decoration: none;COLOR: #ffffff;}.colorfull a:active {text-decoration: none;COLOR: #ffffff;}</style>' +
	'<table class="colorfull" border="0px" cellpadding="0px" cellspacing="0px"><tr><td valign="top">' +
	'<a href="index.php?mod=guild_main&sh=' + GCAO_secureCode + '" title="Guild"><img src="' + img_guild + '" style="margin:3px;width:26px;" border="0px"></a><img id="guild" src="' + img_blackbox + '" style="position:absolute;margin-left:-32px;display:none;" onmouseover="document.getElementById(\'AuctionLinks\').style.display=\'none\';document.getElementById(\'OptionsLinks\').style.display=\'none\';document.getElementById(\'MarketLinks\').style.display=\'none\';document.getElementById(\'InfoLinks\').style.display=\'none\';document.getElementById(\'GuildLinks\').style.display=\'block\';document.getElementById(\'info\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'guild\').setAttribute(\'style\', \'display:none;position:absolute;margin-top:-32px;\');document.getElementById(\'market\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'options\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'auction\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');">' +
	'<a href="index.php?mod=market&sh=' + GCAO_secureCode + '" title="Market"><img src="' + img_market + '" style="margin:3px;width:26px;" border="0px"></a><img id="market" src="' + img_blackbox + '" style="position:absolute;margin-left:-32px;" onmouseover="document.getElementById(\'AuctionLinks\').style.display=\'none\';document.getElementById(\'OptionsLinks\').style.display=\'none\';document.getElementById(\'MarketLinks\').style.display=\'block\';document.getElementById(\'InfoLinks\').style.display=\'none\';document.getElementById(\'GuildLinks\').style.display=\'none\';document.getElementById(\'info\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'guild\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'market\').setAttribute(\'style\', \'display:none;position:absolute;margin-top:-32px;\');document.getElementById(\'options\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'auction\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');">' +
	'<a href="index.php?mod=auction&sh=' + GCAO_secureCode + '&f=0" title="Auction"><img src="' + img_auction + '" style="margin:3px;width:26px;" border="0px"></a><img id="auction" src="' + img_blackbox + '" style="position:absolute;margin-left:-32px;" onmouseover="document.getElementById(\'AuctionLinks\').style.display=\'block\';document.getElementById(\'OptionsLinks\').style.display=\'none\';document.getElementById(\'MarketLinks\').style.display=\'none\';document.getElementById(\'InfoLinks\').style.display=\'none\';document.getElementById(\'GuildLinks\').style.display=\'none\';document.getElementById(\'info\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'guild\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'market\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'options\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'auction\').setAttribute(\'style\', \'display:none;position:absolute;margin-top:-32px;\');">' +
	'<a style="cursor:pointer;" title="Info"><img src="' + img_info + '" style="margin:3px;width:26px;" border="0px"></a><img id="info" src="' + img_blackbox + '" style="position:absolute;margin-left:-32px;" onmouseover="document.getElementById(\'AuctionLinks\').style.display=\'none\';document.getElementById(\'OptionsLinks\').style.display=\'none\';document.getElementById(\'MarketLinks\').style.display=\'none\';document.getElementById(\'InfoLinks\').style.display=\'block\';document.getElementById(\'GuildLinks\').style.display=\'none\';document.getElementById(\'info\').setAttribute(\'style\', \'display:none;position:absolute;margin-top:-32px;\');document.getElementById(\'guild\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'market\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px\');document.getElementById(\'options\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'auction\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');">' +
	'<a style="cursor:pointer;" title="Options"><img src="' + img_options + '" style="margin:3px;width:26px;" border="0px"></a><img id="options" src="' + img_blackbox + '" style="position:absolute;margin-left:-32px;" onmouseover="document.getElementById(\'AuctionLinks\').style.display=\'none\';document.getElementById(\'OptionsLinks\').style.display=\'block\';document.getElementById(\'MarketLinks\').style.display=\'none\';document.getElementById(\'InfoLinks\').style.display=\'none\';document.getElementById(\'GuildLinks\').style.display=\'none\';document.getElementById(\'info\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'guild\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');document.getElementById(\'market\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px\');document.getElementById(\'options\').setAttribute(\'style\', \'display:none;position:absolute;margin-top:-32px;\');document.getElementById(\'auction\').setAttribute(\'style\', \'display:block;position:absolute;margin-top:-32px;\');">' +
	'<img id="info" src="' + img_blackbox + '">'+
	'</td>' +
	'<td id="GuildLinks" valign="top">' +
	'<a href="index.php?mod=guild_medic&sh=' + GCAO_secureCode + '" title="Medic"><img src="' + img_medic + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'<a href="index.php?mod=guild_storage&sh=' + GCAO_secureCode + '" title="Storage"><img src="' + img_storage + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'<a href="index.php?mod=guild_safe&sh=' + GCAO_secureCode + '" title="Bank"><img src="' + img_bank + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'<a href="index.php?mod=guild_jail&sh=' + GCAO_secureCode + '" title="Jail"><img src="' + img_jail + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'<a href="index.php?mod=guild_warcamp&sh=' + GCAO_secureCode + '" title="War Camp"><img src="' + img_guildfight + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'<a href="index.php?mod=guild_library&sh=' + GCAO_secureCode + '" title="Library"><img src="' + img_library + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'</td>' +
	'<td id="MarketLinks" style="display:none;">' +
	'<a href="index.php?mod=market&f=0&fl=0&fq=-1&s=ld&qry=&p=1&sh=' + GCAO_secureCode + '" title="Level Plus"><img src="' + img_Lp + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'<a href="index.php?mod=market&f=0&fl=0&fq=-1&s=l&qry=&p=1&sh=' + GCAO_secureCode + '" title="Level Minus"><img src="' + img_Lm + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'<a href="index.php?mod=market&f=0&fl=0&fq=-1&s=pd&qry=&p=1&sh=' + GCAO_secureCode + '" title="Gold Plus"><img src="' + img_Gp + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'<a href="index.php?mod=market&f=0&fl=0&fq=-1&s=p&qry=&p=1&sh=' + GCAO_secureCode + '" title="Gold Minus"><img src="' + img_Gm + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'</td>' +
	'<td id="AuctionLinks" style="display:none;">' +
	'<a href="index.php?mod=auction&sh=' + GCAO_secureCode + '&f=1" title="Wearpon"><img src="' + img_wearpon + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'<a href="index.php?mod=auction&sh=' + GCAO_secureCode + '&f=3" title="Armor"><img src="' + img_armor + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'<a href="index.php?mod=auction&sh=' + GCAO_secureCode + '&f=2" title="Shield"><img src="' + img_shield + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'<a href="index.php?mod=auction&sh=' + GCAO_secureCode + '&f=4" title="Hhelmet"><img src="' + img_helmet + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'<a href="index.php?mod=auction&sh=' + GCAO_secureCode + '&f=5" title="Gloves"><img src="' + img_gloves + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'<a href="index.php?mod=auction&sh=' + GCAO_secureCode + '&f=8" title="Boots"><img src="' + img_boots + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'</td>' +
	'<td id="OptionsLinks" style="display:none;">' +
	'<a href="index.php?mod=settings&sh=' + GCAO_secureCode + '" title="Options"><img src="' + img_optionsB + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'</td>' +
	'<td id="InfoLinks" style="display:none;">' +
	'<a href="http://s1.gladiatus.gr/game/index.php?mod=guild_main&submod=link&id=4344" target="_blank" title="Homepage"><img src="' + img_homepage + '" style="margin:3px;width:26px;" border="0px">' +
	'<a href="http://www.epiratiko.webs.com/simulator.htm" target="_blank" title="Simulator"><img src="' + img_simulator + '" style="margin:3px;width:26px;" border="0px">' +
	'<a href="http://www.epiratiko.webs.com/counters.htm" target="_blank" title="Counters"><img src="' + img_counters + '" style="margin:3px;width:26px;" border="0px">' +
	'<a href="http://www.epiratiko.webs.com/persons.htm" target="_blank" title="Photos"><img src="' + img_photos + '" style="margin:3px;width:26px;" border="0px">' +
	'<a href="http://www.epiratiko.webs.com/dungeons.htm" target="_blank" title="Dungeons"><img src="' + img_dungeons + '" style="margin:3px;width:26px;" border="0px">' +
	'<a href="http://www.epiratiko.webs.com/comments.htm" target="_blank" title="Comments"><img src="' + img_comments + '" style="margin:3px;width:26px;" border="0px"></a>' +
	'</td>' +
	'</tr></table>';
}

//################################################################################################################################
//## GUILD WAR MORE STATS
//################################################################################################################################
function guildWarMoreStats(){
	var img_gold = 'data:image/gif;base64,R0lGODlhDQANAOZtAM68js27jceyhuKvRsq1hpZBGe22Rcy3ipNGHMmzhMq1iJRWO9urRc22f8Wwg+rDVb6xhvnzou/FVP/1oKtgOv/8v7GZb7Kha8GUcrObY4pcOZhePPe2Ov/acbWfdv6dIf3zka6aZcujfZlpO+rYzsKpdPfESv/93v/vyeO3S6RlT7l9XuS2R8ClY//vqMCsfap5S31ON//ld//kY9GlUdm6jaGGZMqmTMe1iJVUOMu2h6SBYe/XX7SKUZBaOf/wfv/xecGvg8SAWP+3OP/8l//ITf/ARKSCX/+UG//aT66caLabVcd8LMS4UP6sLq1uN+zVa//MV8ayhptmR5dcRfvccrKObP//48u6g6KKZvm6Q+m6Tcyacv/ba//dbejBk+6wO/+wMf/6kO63R9PBWffult2uR8qxh6yddP/bWKGQav/4vf/kAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAG0ALAAAAAANAA0AAAeLgG2Cg4SECiVLAwZjNyFBAYICLTxslZVJTWiQaiAyXVFGWmYMaWQ4AFgTlWFIH2ApW2sZABAVlUVDThwsD2tQLzYnax1ePzMmEkBrVRceGyRXa9JrYjRMREoERwUqIjUNPQhPEWUWbQkjXBgUC1aVLjBngg45K18olUI+UoQ6WVMaYlDZcaCQQUKBAAA7';
	
	if(document.getElementById('bx0')){var i=3;}
	else{var i=1;}
	
	var tableHTML = document.getElementById('content').getElementsByTagName('div')[i].innerHTML;

	if(tableHTML.match(/gid=(\d+)/i)){var guilds = document.getElementById('content').getElementsByTagName('div')[i].getElementsByTagName('a').length/2}
	else{var guilds = document.getElementById('content').getElementsByTagName('div')[i].getElementsByTagName('a').length}
	
	document.getElementById('content').getElementsByTagName('div')[i].innerHTML = tableHTML.replace(/<\/th>/i, ' (' + guilds + ')<span style="float:right;margin-right:7px;"><b>LvL &#216;</b></span><span style="float:right;margin-right:13px;"><b>'+L_gold+'</b></span></th>');

	var c=0;
	while(tableHTML.match(/guild&amp;i=(\d+)/i) && c<=15){
		var guildid = tableHTML.match(/guild&amp;i=(\d+)/i)[1];
		tableHTML = tableHTML.replace(/guild&amp;i=/i, 'guild&i=[DONE]');
		getGuildGold(guildid, i);
		c++;
	}
}

function getGuildGold(id,i){
	var xmlhttp=false;
	if (!xmlhttp && typeof XMLHttpRequest!='undefined'){
		try {xmlhttp = new XMLHttpRequest();}
		catch (e) {xmlhttp = false;}
	}
	var url=GCAO_siteurl + "mod=guild_main&i=" + id + "&sh=" + GCAO_secureCode;
	if (xmlhttp){
		xmlhttp.open("GET", url,true);
		xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4) {
			if(xmlhttp.responseText.match(/mainbox/i)){
				var gold = xmlhttp.responseText.match(/<th>(.+) <img src\="\d+\/img\/res2\.gif"/i)[1];
				var mesoLevel = xmlhttp.responseText.match(/0216.<\/td[^<]+<th>([^<]+)/i)[1];
			}
			else{
				var gold = 'Error 1';
				var mesoLevel = 'Error 3';
			}
			showGuildGold(gold,id,i,mesoLevel);
		}
	}
	xmlhttp.send(null)
	}
}

function showGuildGold(PulledGold,GuildId,i,mesoLevel){
	var img_gold = 'data:image/gif;base64,R0lGODlhDQANAOZtAM68js27jceyhuKvRsq1hpZBGe22Rcy3ipNGHMmzhMq1iJRWO9urRc22f8Wwg+rDVb6xhvnzou/FVP/1oKtgOv/8v7GZb7Kha8GUcrObY4pcOZhePPe2Ov/acbWfdv6dIf3zka6aZcujfZlpO+rYzsKpdPfESv/93v/vyeO3S6RlT7l9XuS2R8ClY//vqMCsfap5S31ON//ld//kY9GlUdm6jaGGZMqmTMe1iJVUOMu2h6SBYe/XX7SKUZBaOf/wfv/xecGvg8SAWP+3OP/8l//ITf/ARKSCX/+UG//aT66caLabVcd8LMS4UP6sLq1uN+zVa//MV8ayhptmR5dcRfvccrKObP//48u6g6KKZvm6Q+m6Tcyacv/ba//dbejBk+6wO/+wMf/6kO63R9PBWffult2uR8qxh6yddP/bWKGQav/4vf/kAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAG0ALAAAAAANAA0AAAeLgG2Cg4SECiVLAwZjNyFBAYICLTxslZVJTWiQaiAyXVFGWmYMaWQ4AFgTlWFIH2ApW2sZABAVlUVDThwsD2tQLzYnax1ePzMmEkBrVRceGyRXa9JrYjRMREoERwUqIjUNPQhPEWUWbQkjXBgUC1aVLjBngg45K18olUI+UoQ6WVMaYlDZcaCQQUKBAAA7';
	document.getElementById('content').getElementsByTagName('div')[i].innerHTML = document.getElementById('content').getElementsByTagName('div')[i].innerHTML.replace('<a href="index.php?mod=guild&amp;i=' + GuildId + '&amp;', '<span style="float:right;margin-right:15px;">' + mesoLevel + '</span><span style="float:right;margin-right:25px;"><b>' + PulledGold + '</b> <img border="0" src="' + img_gold + '"></span><a title="" href="index.php?mod=guild&amp;i=' + GuildId + '&amp;');
}

//################################################################################################################################
//## ADVERTISEMENT TOP UP MOVE
//################################################################################################################################
function moveAdd(){
	var image="data:image/png;base64,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%3D";
	document.getElementById('mainnav').setAttribute('style','bottom:-25px;');
	document.getElementById('content').setAttribute('style','margin-top:25px;');
	document.getElementById('banner_top').setAttribute('style','top:152px;background-image:url('+image+');');
	document.getElementById('banner_event').style.top='155px';
	if(document.getElementById('cooldown_bar_event')){document.getElementById('cooldown_bar_event').setAttribute('style','margin-top:30px;');}
}

//################################################################################################################################
//## GUILD SAFE
//################################################################################################################################
function guildSafeEdit(){
	var allbutton=document.createElement("input");
	allbutton.id="allin";
	allbutton.setAttribute("type","button");
	allbutton.setAttribute("class","button3");
	allbutton.setAttribute("value",L_addAll);
	allbutton.setAttribute("style","margin-right:17px;");
	allbutton.setAttribute("onclick","document.getElementById('content').getElementsByTagName('input')[0].value=document.getElementById('content').getElementsByTagName('form')[0].parentNode.innerHTML.match(/>([^<]+)<img/i)[1].replace(/ /g,'').replace(/\\\./g,'');");
	document.getElementById('content').getElementsByTagName('input')[0].parentNode.parentNode.setAttribute("valign","top");
	document.getElementById('content').getElementsByTagName('input')[0].parentNode.appendChild(allbutton);
}

function guildSafeLog(){
	if(document.getElementById('content').getElementsByTagName('table')[0]){
		var style = document.createElement("style");
		style.setAttribute('id', 'NoGuildPlayersStyle');
		style.innerHTML = '.notInGuild {display:none;}';
		document.getElementById('content').appendChild(style);
		
		var num=document.getElementById('content').getElementsByTagName('table')[0].getElementsByTagName('tr').length;
		var sum=0;
		var temp='';
		for(i=1;i<num;i++){
			temp=document.getElementById('content').getElementsByTagName('table')[0].getElementsByTagName('tr')[i].getElementsByTagName('td')[2].innerHTML;
			temp=temp.replace(/\./g,'');
			sum=sum+parseInt(temp);
			if(document.getElementById('content').getElementsByTagName('table')[0].getElementsByTagName('tr')[i].getElementsByTagName('td')[1].innerHTML=='-'){
				document.getElementById('content').getElementsByTagName('table')[0].getElementsByTagName('tr')[i].setAttribute('class','notInGuild');
				if(!document.getElementById('ShowNoGuildPlayersButton')){
					var value=document.getElementById('content').getElementsByTagName('table')[0].getElementsByTagName('tr')[i].getElementsByTagName('td')[0].innerHTML;
					var button = document.createElement("tr");
					button.setAttribute('id', 'ShowNoGuildPlayersButton');
					button.setAttribute('colspan', '4');
					button.innerHTML = '<td><input type="button" class="button2" value="'+value+'" onclick="this.style.display=\'none\';document.getElementById(\'NoGuildPlayersStyle\').innerHTML=\'.notInGuild {display:inherited;}\'"></td>';
					document.getElementById('content').getElementsByTagName('tbody')[0].appendChild(button);
				}
			}
		}
		document.getElementById('content').getElementsByTagName('div')[2].innerHTML+= ' <font style="float:right;padding-right:10px;">('+L_total+': '+dottedNumber(sum)+' <img border="0" align="absmiddle" src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/res2.gif">)</font>'
	}
	if(document.getElementById('content').getElementsByTagName('table')[1]){
		var num2=document.getElementById('content').getElementsByTagName('table')[1].getElementsByTagName('tr').length;
		for(i=1;i<num2;i++){
			temp=document.getElementById('content').getElementsByTagName('table')[1].getElementsByTagName('tr')[i].getElementsByTagName('td')[3].innerHTML;
			temp=temp.replace('Sun','<font color="red"><b>Sun</b></font>').replace('Mon','<font color="#660000"><b>Mon</b></font>').replace('Tue','<font color="#006600"><b>Tue</b></font>').replace('Wed','<font color="orange"><b>Wed</b></font>').replace('Thu','<font color="#666666"><b>Thu</b></font>').replace('Fri','<font color="purple"><b>Fri</b></font>').replace('Sat','<font color="#003399"><b>Sat</b></font>');
			document.getElementById('content').getElementsByTagName('table')[1].getElementsByTagName('tr')[i].getElementsByTagName('td')[3].innerHTML=temp;
		}
	}
}

//################################################################################################################################
//## PACKAGE COUNTERS
//################################################################################################################################
function packetCounters(){
	var counterBar=document.createElement("tr");
	counterBar.innerHTML='<td><div class="title2_box"><div class="title2_inner"><table><tr><td valign="top">'+
	'&bull; <b>'+L_Packages+': <span id="paket_number">0</span></b>'+
	'<table id="paket_counter_table1" style="display:none;padding-left:4px;"><tr><td>'+L_packedValue+'</td><td>:</td><td id="paket_value_1"></td></tr><tr><td>'+L_PackedGold+'</td><td>:</td><td id="paket_value_2"></td></tr></table>'+
	'</td><td style="width:10px;"></td><td valign="top">'+
	'&bull; <b>'+L_invItems+': <span id="inv_number">0</span></b>'+
	'<table id="paket_counter_table2" style="display:none;padding-left:4px;"><tr><td>'+L_invValue+'</td><td>:</td><td id="inventory_value_1"></td></tr></table>'+
	'</td></tr></table></div></div></td>';
	
	var counterBar2=document.createElement("tr");
	counterBar2.setAttribute('id','searchTotPakBox');
	counterBar2.innerHTML='<td><div class="title2_box"><div class="title2_inner"><table><tr><td valign="top" width="150px">'+
	'<input id="searchTotPakValue" type="button" class="button3" value="'+L_total+'"><input id="hasBeenLaunched" type="hidden" value="0"></td> <td width="150"><span align="center" id="total_pak_value" value="0"></span>  <img id="totalImage" style="display:none;" src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/res2.gif"/></td> <td text-align="right"> <span align="right" style="display:none;" id="total_page"><input type="hidden" id="currentPage" value="0"><input type="hidden" id="maxPage" value="0"></div></span> ' +
	'</td></tr></table></div></div></td>';
	
	document.getElementById('content').getElementsByTagName('table')[1].appendChild(counterBar);
	document.getElementById('content').getElementsByTagName('table')[1].appendChild(counterBar2);
	
	if(document.body.getElementsByTagName('script')[10].innerHTML.match('AddCharDiv')){var x=10;}
	else if(document.body.getElementsByTagName('script')[11].innerHTML.match('AddCharDiv')){var x=11;}
	else if(document.body.getElementsByTagName('script')[12].innerHTML.match('AddCharDiv')){var x=12;}
	else if(document.body.getElementsByTagName('script')[13].innerHTML.match('AddCharDiv')){var x=13;}
	else if(document.body.getElementsByTagName('script')[14].innerHTML.match('AddCharDiv')){var x=14;}
	
	if(document.body.getElementsByTagName('script')[x].innerHTML.match(/AddCharDiv\("paket_\w+.*?\/table/i)){
		if(document.body.getElementsByTagName('script')[x].innerHTML.match(/AddCharDiv\("paket_\w+.*?\/table/g).length>0){
			var pakets=document.body.getElementsByTagName('script')[x].innerHTML.match(/AddCharDiv\("paket_\w+.*?\/table/g).length;
			document.getElementById('paket_number').innerHTML=pakets;
			var sumValues=0;
			var sumValues2=0;
			for(i=0;i<pakets;i++){
				if(document.body.getElementsByTagName('script')[x].innerHTML.match(/AddCharDiv\("paket_\w+.*?\/table/g)[i]){
					var txt=document.body.getElementsByTagName('script')[x].innerHTML.match(/AddCharDiv\("paket_\w+.*?\/table/g)[i];
					if(txt.match(/<img/g)){
						var value=document.body.getElementsByTagName('script')[x].innerHTML.match(/AddCharDiv\("paket_\w+.*?\/table/g)[i].match(/>([^<]+)<img/i)[1].replace(/\./g,'').match(/(\d+)/i)[1];
						sumValues=parseInt(sumValues)+parseInt(value);
					}
					else if(txt.match(/>\d+[^<]+</i)){
						var value=txt.match(/>(\d+[^<]+)</i)[1].replace(/\./g,'').match(/(\d+)/i)[1];
						sumValues2=parseInt(sumValues2)+parseInt(value);
					}else{
						var value = 0 ;
					}
				}
			}
			document.getElementById('paket_counter_table1').style.display='block';
			document.getElementById('paket_value_1').innerHTML=dottedNumber(sumValues)+' <img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/res2.gif"/>';
			document.getElementById('paket_value_2').innerHTML=dottedNumber(sumValues2)+' <img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/res2.gif"/>';
		}
	}
	if(document.body.getElementsByTagName('script')[x].innerHTML.match(/AddCharDiv\("p\w+_\w+_\w+".*?\/table/g)){
		if(document.body.getElementsByTagName('script')[x].innerHTML.match(/AddCharDiv\("p\w+_\w+_\w+".*?\/table/g).length>0){
			var inv=document.body.getElementsByTagName('script')[x].innerHTML.match(/AddCharDiv\("p\w+_\w+_\w+".*?\/table/g).length;
			document.getElementById('inv_number').innerHTML=inv;
			var sumValues=0;
			for(i=0;i<inv;i++){
				try{var value=document.body.getElementsByTagName('script')[x].innerHTML.match(/AddCharDiv\("p\w+_\w+_\w+".*?\/table/g)[i].match(/>([^<]+)<img/i)[1].replace(/\./g,'').match(/(\d+)/i)[1];}
				catch(err){var value=0;}
				sumValues=parseInt(sumValues)+parseInt(value);
			}
			document.getElementById('paket_counter_table2').style.display='block';
			document.getElementById('inventory_value_1').innerHTML=dottedNumber(sumValues)+' <img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/res2.gif"/>';
		}
	}
	
	document.getElementById('searchTotPakValue').addEventListener('click', function(){searchTotPakValue();}, true);
	if(!document.getElementById('content').innerHTML.match(/page=\d+">\d+</g)){
		document.getElementById('searchTotPakBox').style.display='none';
	}
	var bar = document.createElement('div');
	if(document.getElementById('banner_top') && document.getElementById('banner_event'))
		var top = 847;
	else
		var top = 847-25;
	bar.innerHTML = '<div class="cooldown_bar" style="left:580px;top:'+top+'px;cursor:pointer;"><div id="pageBar" style="width: 0%;" class="cooldown_bar_fill cooldown_bar_fill_progress"></div><div class="cooldown_bar_text" id="cooldown_bar_fill_page">0</div></div>';
	document.getElementById('total_page').appendChild(bar);
}

function searchTotPakValue(){
	if(document.getElementById('hasBeenLaunched').value == 0){

		var last = false;
		document.getElementById('hasBeenLaunched').value = 1;
		var divs = document.evaluate(".//div[@class='paging_numbers']",document.getElementById('content'),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
		divs = document.evaluate("(.//a)|(.//span)",divs.snapshotItem(0),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
		var pageMax = parseInt(divs.snapshotItem(divs.snapshotLength-1).innerHTML);
		document.getElementById('maxPage').value=pageMax;
		
		document.getElementById('currentPage').value=0;
		document.getElementById('total_pak_value').innerHTML = 0;
		document.getElementById('totalImage').setAttribute('style','');
		document.getElementById('total_page').setAttribute('style','');
		document.getElementById('cooldown_bar_fill_page').innerHTML='0 / '+pageMax+' (0%)';
		document.getElementById('pageBar').style.width='0%';
		for(var j=1;j<pageMax+1;j++){
			totalPackValue(j);
		}
	}
}

function totalPackValue(page){
	GM_xmlhttpRequest({
		method: "GET",
		url: GCAO_siteurl + 'mod=packages&sh='+GCAO_secureCode+'&page='+page,
		onload: function(response){
			for(var i = 0; i<response.responseText.match(/AddCharDiv\("paket_\w+.*?\/table/g).length;i++) {
				try{
					var txt=response.responseText.match(/AddCharDiv\("paket_\w+.*?\/table/g)[i];
					if(txt.match(/<img/g)){
						var value=response.responseText.match(/AddCharDiv\("paket_\w+.*?\/table/g)[i].match(/>([^<]+)<img/i)[1].replace(/\./g,'').match(/(\d+)/i)[1];
					}
					else if(txt.match(/>\d+[^<]+</i)){
						var value=txt.match(/>(\d+[^<]+)</i)[1].replace(/\./g,'').match(/(\d+)/i)[1];
					}
					else{var value=0;}
					document.getElementById('total_pak_value').innerHTML = dottedNumber(parseInt(document.getElementById('total_pak_value').innerHTML.replace(/\./g,'')) + parseInt(value));
				}
				catch(err){var value=0;}
			}
			document.getElementById('currentPage').value=parseInt(document.getElementById('currentPage').value)+1;
			var test = Math.floor(100*parseInt(document.getElementById('currentPage').value)/parseInt(document.getElementById('maxPage').value))+'%';
			document.getElementById('pageBar').style.width = test;
			document.getElementById('cooldown_bar_fill_page').innerHTML = document.getElementById('currentPage').value+' / '+document.getElementById('maxPage').value+' ('+test+')';
			
			if(document.getElementById('currentPage').value==document.getElementById('maxPage').value)
				document.getElementById('pageBar').className = "cooldown_bar_fill cooldown_bar_fill_ready";
				
		}
	});
}

//################################################################################################################################
//## SHOW PLAYER'S ID
//################################################################################################################################
function showId(){
	var playerid = document.location.href.match(/p=(\d+)/i)[1];
	var table = document.createElement("div");
	table.setAttribute('class', 'charstats_bg');
	table.setAttribute('style', 'margin-top:-4px;');
	table.innerHTML = '<span class="charstats_value21">'+L_ID+'</span><span class="charstats_value22" id="char_schaden">' + playerid + '</span></div>';
	document.getElementById('charstats').appendChild(table);
	
	var table2 = document.createElement("div");
	table2.setAttribute('style', 'background-image: url(\'img/char_status_abschluss.jpg\'); width: 173px; height: 5px; overflow: hidden;');
	document.getElementById('charstats').appendChild(table2);
}

//################################################################################################################################
//## RUBIES CONFIRMATION BOXES
//################################################################################################################################

//For expedition
function expeditionConfirmRubies(){
	var expeditions = document.evaluate(".//input[@class='expedition_button']",document.getElementById('content'),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
	// If there is a timer 
	if(document.getElementById('ticker1'))
		for(var i = 0;i<expeditions.snapshotLength;i++)
			expeditions.snapshotItem(i).setAttribute('onclick','if(confirm("'+L_sure+'")) '+expeditions.snapshotItem(i).getAttribute('onclick'));
}

//For auction
function confirmRubies(){
	var buyouts = document.getElementsByName('buyout');
	for(var i = 0;i<buyouts.length;i++)
		buyouts[i].addEventListener('click', grabClick, true);
}

function grabClick(event){
	if(event.button == 0) {
		if(!confirm(L_sure)){
			event.stopPropagation();
			event.preventDefault();
		}
		return;
	}
}

//################################################################################################################################
//## PRICE RATIO
//################################################################################################################################
function priceRatio(){
	if(document.getElementById('market_item_table')){
		var style = document.createElement('style');
		style.innerHTML='input.button2 {background-image: url("http://i617.photobucket.com/albums/tt260/goldisever/GCAO/button3.jpg");border: 0 none;color: #453011;font-size: 11px;font-weight: bold;height: 26px;width: 79px;}';
		document.getElementById('content').appendChild(style);
		
		if(document.getElementById('market_item_table').getElementsByTagName('th')[0].innerHTML.length>9){
			document.getElementById('market_item_table').getElementsByTagName('th')[0].innerHTML = 'Items';
		}
		var items = document.getElementById('market_item_table').getElementsByTagName('tr').length-1;
		
		document.getElementById('market_item_table').parentNode.parentNode.style.margin=' 0px -30px 0px -10px';
		document.getElementById('market_item_table').parentNode.parentNode.parentNode.childNodes[3].style.margin=' 0px -30px 0px -10px';
		
		var ratioHead=document.createElement('th');
		ratioHead.innerHTML='<u title="'+L_ratioTitle+'">Ratio</u>';
		ratioHead.setAttribute('style','text-align:right;color:#612D04;');
		document.getElementById('market_item_table').getElementsByTagName('tr')[0].insertBefore(ratioHead , document.getElementById('market_item_table').getElementsByTagName('tr')[0].getElementsByTagName('th')[5]);
		
		var ratioTd;var sellPrice;var value;var price;var data;var ratio;var color;var life;var foodratio;var kathetos;
		
		var x=0;
		while(!document.body.getElementsByTagName('script')[x].innerHTML.match('AddCharDiv') && (x<100)){x++;}
		var dataScript = document.getElementsByTagName('script')[x].innerHTML;
			
		for(i=1;i<=items;i++){
			ratioTd=document.createElement('td');
			ratioTd.setAttribute('style','text-align:right;padding-right:5px;padding-left:0px;');
			sellPrice=document.getElementById('market_item_table').getElementsByTagName('tr')[i].getElementsByTagName('td')[2].innerHTML.replace(/\./g,'').match(/(\d+)/i)[1];
			data=dataScript.match(/AddCharDiv..buy.[^"]+.([^"]+)./i)[1].replace(/\./g,'');
			foodratio='';
			kathetos='';
			if(data.match(/\d+ [^<]+<\/td>[^\+]+\+\d+ /i)){
				life=data.match(/(\d+) [^<]+<\/td>[^\+]+\+\d+ /i)[1]*1;
				intel=data.match(/\d+ [^<]+<\/td>[^\+]+\+(\d+) /i)[1]*1;
				foodratio=life/sellPrice;
				foodratio=roundNumber(foodratio);
				foodratio='<b color="black">'+foodratio+'</b>';
				kathetos=' | ';
			}
			price=data.match(/\d+ <img/g)[0].match(/\d+/i);
			value=data.match(/\d+ <img/g)[1].match(/\d+/i);
			dataScript=dataScript.replace("AddCharDiv('buy",'[DONE]');
			ratio=sellPrice/((parseInt(price)+parseInt(value))/2);
			ratio=roundNumber(ratio);
			if(ratio<0.3){color='green';}
			else if(ratio<5.99){color='gray';}
			else if(ratio<9.99){color='#FF9000';}
			else{color='red';}
			if(GM_getValue('rr', false) == false){if(kathetos==''){ratio='<center>-</center>';color='black';}else{ratio='';kathetos='';}}
			ratioTd.innerHTML=foodratio+kathetos+'<font color="'+color+'"><b>'+ratio+'</b></font>';
			document.getElementById('market_item_table').getElementsByTagName('tr')[i].insertBefore(ratioTd , document.getElementById('market_item_table').getElementsByTagName('tr')[i].getElementsByTagName('td')[5]);
		}
	}
}

//################################################################################################################################
//## AUCTION EXTEND ITEM'S TABLE
//################################################################################################################################
function auctionExtendTable(){
	var itemNum=document.forms.length - 1;
	if(document.getElementById('auction_table') && itemNum>5){
		if(GM_getValue('an', true) == true){var top=27;}
		else{var top=62;}
		document.getElementById('auction_table').setAttribute('style',"margin: "+top+"px -1px 0px -280px;padding-left:279px;padding-top:10px;background:url('http://i617.photobucket.com/albums/tt260/goldisever/GCAO/aemidle.png') repeat-y left top;z-index:35;");
		document.getElementById('auction_table').getElementsByTagName('table')[0].style.margin=' 0px 0px 0px -269px';
		
		var bgDown=document.createElement('img');
		bgDown.src='http://i617.photobucket.com/albums/tt260/goldisever/GCAO/aedown.png';
		bgDown.setAttribute('style',"position:absolute;margin-left:-279px;z-index:50;");
		document.getElementById('auction_table').appendChild(bgDown);
		
		var bgTop=document.createElement('img');
		bgTop.src='http://i617.photobucket.com/albums/tt260/goldisever/GCAO/aetop.png';
		bgTop.setAttribute('style',"position:absolute;margin-left:-279px;margin-top:-20px;z-index:35;");
		document.getElementById('auction_table').insertBefore(bgTop,document.getElementById('auction_table').getElementsByTagName('table')[0]);
		
		for(i=5;i<=itemNum;i=i+6){
			document.getElementById('auction_table').getElementsByTagName('td')[i-1].id='td1';
			document.getElementById('auction_table').getElementsByTagName('td')[i].id='td2';
		}
		
		var style=document.createElement('style');
		style.innerHTML='.auction_bid_div {height:115px;} #td1{position:absolute;width:265px;margin-top:-252px;margin-left:538px;}#td2{position:absolute;width:265px;margin-top:-126px;margin-left:538px;}';
		document.getElementById('content').appendChild(style);
	}
}

//################################################################################################################################
//## AUCTION DETAIL VIEW
//################################################################################################################################
function detailView(){/*
	var itemNum=document.forms.length - 1;
	var itemId=document.getElementById('auction_table').getElementsByTagName('input')[0].value;
	var statsTableInnerHTML=document.getElementById('tOoLtIp_auction_'+itemId).innerHTML;
	var statsBox=document.createElement('span');
	statsBox.innerHTML=statsTableInnerHTML;
	document.getElementById('auction_table').getElementsByTagName('input')[0].parentNode.appendChild(statsBox);*/
}

//################################################################################################################################
//## MORE PLAYER STATS
//################################################################################################################################
function morePlayerStats(){
	var battles = document.getElementById('content').getElementsByTagName('td')[0].innerHTML.replace(/\./g, '');
	var bwin = document.getElementById('content').getElementsByTagName('td')[1].innerHTML.replace(/\./g, '');
	var L_win = document.getElementById('content').getElementsByTagName('th')[1].innerHTML.replace(/:/g, '');
	var blost = document.getElementById('content').getElementsByTagName('td')[2].innerHTML.replace(/\./g, '');
	var L_lost = document.getElementById('content').getElementsByTagName('th')[2].innerHTML.replace(/:/g, '');
	var wgold = document.getElementById('content').getElementsByTagName('td')[4].innerHTML.replace(/\./g, '').replace(/ <(.+)>/g, '');
	var lgold = document.getElementById('content').getElementsByTagName('td')[5].innerHTML.replace(/\./g, '').replace(/ <(.+)>/g, '');
	if(blost==0){var ratio = 0;}
	else{var ratio = Math.round(((bwin*1)/(blost*1))*100)/100;}
	if(battles==0){var posostonikon = 0;}
	else{var posostonikon = Math.round(((bwin*1)/(battles*1))*10000)/100;}
	var sWGold = (wgold*1)-(lgold*1);

	var color1 = "";
	if (ratio>1){color1 = "green";}
	else if (ratio<1){color1 = "red";}
	var color2 = "";
	if (posostonikon>=50){color2 = "green";}
	else if (posostonikon<50){color2 = "red";}
	var color3 = "";
	if (sWGold>0){color3 = "green";}
	else if (sWGold<0){color3 = "red";}
	
	sWGold = dottedNumber(sWGold);
		
	var LocationLink = document.getElementById('content').getElementsByTagName('tr')[3];
	var statsNewElement = document.createElement('tr');
	statsNewElement.setAttribute('Id','Ratio');
	LocationLink.parentNode.insertBefore(statsNewElement, LocationLink);
	document.getElementById('Ratio').innerHTML = '<th>'+L_win+'/'+L_lost+' ratio:</th><td style="white-space: nowrap; color: ' + color1 + ';">' + ratio + '</td>';

	LocationLink = document.getElementById('content').getElementsByTagName('tr')[5];
	statsNewElement = document.createElement('tr');
	statsNewElement.setAttribute('Id','PosostoNikon');
	LocationLink.parentNode.insertBefore(statsNewElement, LocationLink);
	document.getElementById('PosostoNikon').innerHTML = '<th>'+L_win+' %:</th><td style="white-space: nowrap; color: ' + color2 + ';">' + posostonikon + '%</td>';

	
	LocationLink = document.getElementById('content').getElementsByTagName('tr')[6];
	statsNewElement = document.createElement('tr');
	statsNewElement.setAttribute('Id','empty');
	statsNewElement.innerHTML = '&nbsp';
	LocationLink.parentNode.insertBefore(statsNewElement, LocationLink);
	
	LocationLink = document.getElementById('content').getElementsByTagName('tr')[9];
	statsNewElement = document.createElement('tr');
	statsNewElement.setAttribute('Id','WinGold');
	LocationLink.parentNode.insertBefore(statsNewElement, LocationLink);
	document.getElementById('WinGold').innerHTML = '<th>'+L_totalGold+':</th><td style="white-space: nowrap; color: ' + color3 + ';">' + sWGold + ' <img border="0" align="absmiddle" src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/res2.gif"></td>';
	
	LocationLink = document.getElementById('content').getElementsByTagName('tr')[10];
	statsNewElement = document.createElement('tr');
	statsNewElement.setAttribute('Id','empty');
	statsNewElement.innerHTML = '&nbsp';
	LocationLink.parentNode.insertBefore(statsNewElement, LocationLink);
	
	if (document.getElementById('stats_wealth')){
		var aksia1 = document.getElementById('stats_wealth').getElementsByTagName('td')[0].innerHTML.replace(/\./g, '').replace(/ <(.+)>/g, '');
		var aksia2 = document.getElementById('stats_wealth').getElementsByTagName('td')[1].innerHTML.replace(/\./g, '').replace(/ <(.+)>/g, '');
		var totalValue = (aksia1*1) + (aksia2*1);
		totalValue = dottedNumber(totalValue);
		
		LocationLink = document.getElementById('stats_wealth').getElementsByTagName('tr')[0];
		statsNewElement = document.createElement('tr');
		statsNewElement.setAttribute('Id','TotalValue');
		LocationLink.parentNode.insertBefore(statsNewElement, LocationLink);
		document.getElementById('TotalValue').innerHTML = '<th>'+L_totalItemValue+':</th><td style="white-space: nowrap;">' + totalValue + ' <img border="0" align="absmiddle" src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/res2.gif"></td>';
	}
}

//################################################################################################################################
//## NEW FORUM MESSAGE
//################################################################################################################################
var mouseoutForumMessage =true;
function newForumMessage(){
	GM_xmlhttpRequest({
		method: "GET",
		url: 'http://board.gladiatus.'+GCAO_lang+'/index.php?page=Index',
		onload: function(response){
			if(response.responseText.match('<div class="info deletable" id="pmOutstandingNotifications">')){
				var newMessage = response.responseText.split('<div class="info deletable" id="pmOutstandingNotifications">')[1].split('</div>')[0];
			}else if(response.responseText.match('<div class="info" id="pmOutstandingNotifications">')){
				var newMessage = response.responseText.split('<div class="info" id="pmOutstandingNotifications">')[1].split('</div>')[0];
			}else{var newMessage = '<p>Error</p>'}
			var line = newMessage.split('<p>')[1].split('</p>')[0].replace(/[^0-9]/g,'');
			newMessage = newMessage.split('<p>')[1].split('</p>')[0] + newMessage.split('<p>')[1].split('</p>')[1];
			
			if(response.responseText.match('pmOutstandingNotifications')){
				var heigth = 40+line*24;
				document.getElementById('header_game').getElementsByTagName('a')[3].parentNode.innerHTML+=' <img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/exclamation.png" style="position:absolute;margin-left:4px;margin-top:1px;opacity: 0.65;" onmouseover="this.style.opacity=\'1\';document.getElementById(\'NewForumMessage\').style.display=\'block\';" onClick="if(this.style.opacity==\'0.65\'){this.style.opacity=\'1\';document.getElementById(\'NewForumMessage\').style.display=\'block\';} else {this.style.opacity=\'0.65\';document.getElementById(\'NewForumMessage\').style.display=\'none\';}">';
				var forumNewMessageTip = document.createElement('div');
				forumNewMessageTip.setAttribute('id', 'NewForumMessage');
				forumNewMessageTip.setAttribute('style', 'opacity: 0.75; display: none; width: 300px; z-index: 502; position: absolute; top: 30px; left: 550px; border: 1px solid grey; background-color: black; color: rgb(192, 192, 192); font-weight: bold; height: '+heigth+'px; line-height: 24px; padding-left: 5px; padding-right: 5px;text-align:left;')
				forumNewMessageTip.innerHTML = newMessage;//L_newMail;
				for(var i =0;i<forumNewMessageTip.getElementsByTagName('a').length;i++){
					forumNewMessageTip.getElementsByTagName('a')[i].setAttribute('target','_blank');
				}
				document.getElementById('header_game').appendChild(forumNewMessageTip);
			}
		}
	});
}

//################################################################################################################################
//## NEW QUEST AVAILABLE
//################################################################################################################################
function newQuest(){
	if(!document.getElementById('bx0')){
		GM_xmlhttpRequest({
			method: "GET",
			url: GCAO_siteurl + 'mod=quests&sh=' + GCAO_secureCode,
			onload: function(response){
				if(response.responseText.match(/quest_slot_button quest_slot_button_finish/gi)){
					var doneMissions=response.responseText.match(/quest_slot_button quest_slot_button_finish/gi).length;
					var object=document.getElementById('mainmenu').getElementsByTagName('a')[1].innerHTML;
					if(object.match(/\(\d+\)/i)){
						var num=object.match(/(\(\d+\))/i)[1];
						document.getElementById('mainmenu').getElementsByTagName('a')[1].innerHTML=object.replace(num,'');
					}
					document.getElementById('mainmenu').getElementsByTagName('a')[1].innerHTML+=' (<font color="green">'+doneMissions+'</font>)';
				}
				if(response.responseText.match('quest_header_cooldown')){
					var timeleft=response.responseText.match(/\d+:(\d+:\d+)/i)[1];
					var minute = timeleft.split(':')[0];
					var seconde = timeleft.split(':')[1];
					document.getElementById('mainmenu').getElementsByTagName('a')[1].innerHTML+= '<font style="margin-left:5px;" weight="bold"><span id="quest">(<span id="minute">'+minute+'</span>:<span id="seconde">'+seconde+'</span>)</span></font>';
					var timer = setInterval(function(){
						var secondTemp = document.getElementById('seconde').innerHTML;
						if(secondTemp[0]=="0"){secondTemp=secondTemp[1];}
						if(secondTemp=="0"){
							var minuteTemp = document.getElementById('minute').innerHTML;
							if(minuteTemp[0]=="0") minuteTemp=minuteTemp[1];
							if(minuteTemp=="0"){
								clearInterval(timer);
								document.getElementById('quest').innerHTML = '<font style="margin-left:5px;" weight="bold">(<font color="#FAF311">'+L_New+'</font>)</font>';
							}else{
								document.getElementById('seconde').innerHTML = 59;
								if(parseInt(minuteTemp)<11){document.getElementById('minute').innerHTML = "0" + ""+ (minuteTemp-1);}
								else{document.getElementById('minute').innerHTML--;}
							}
						}else if(parseInt(document.getElementById('seconde').innerHTML)<11){document.getElementById('seconde').innerHTML = "0" + ""+ (secondTemp-1);}
						else{document.getElementById('seconde').innerHTML--;}
					},1000);
				}else{
					var quests=response.responseText.match(/: (\d+) \/ (\d+)/i);
					if(quests[1]==quests[2]){var status='<font color="red">'+L_Full+'</font>';}
					else{var status='<font color="#FAF311">'+L_New+'</font>';}
					document.getElementById('mainmenu').getElementsByTagName('a')[1].innerHTML+= '<font style="margin-left:5px;" weight="bold">('+status+')</font>';
				}
			}
		});
	}
}

//################################################################################################################################
//## GUILD MAIL CHANGES
//################################################################################################################################
function guildMailChanges(){
	var toolbar = document.createElement('span');
	toolbar.setAttribute('id', 'ToolBar');
	toolbar.setAttribute('style', '');
	var p2 = document.getElementById('message');
	p2.parentNode.insertBefore(toolbar,p2);

	if(GM_getValue('bb', false) == true){
		var bbCode = '<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/bbcode_bold.gif" title="Bold selected text" class="bbcode_button" onclick="var textArea = $(\'message\');var startTag = \'[b]\';var closeTag = \'[#b]\';var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');var selectedText = textArea.getSelectedText();textArea.set(\'value\', text.substring(0, pos.start) + startTag + selectedText + closeTag + text.substring(pos.end, text.length));"></li>' +
		'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/bbcode_italic.gif" title="Italic selected text" class="bbcode_button" onclick="var textArea = $(\'message\');var startTag = \'[i]\';var closeTag = \'[#i]\';var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');var selectedText = textArea.getSelectedText();textArea.set(\'value\', text.substring(0, pos.start) + startTag + selectedText + closeTag + text.substring(pos.end, text.length));"></li>' +
		'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/bbcode_center.png" title="Put selected text at the center" class="bbcode_button" onclick="var textArea = $(\'message\');var startTag = \'[c]\';var closeTag = \'[#c]\';var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');var selectedText = textArea.getSelectedText();textArea.set(\'value\', text.substring(0, pos.start) + startTag + selectedText + closeTag + text.substring(pos.end, text.length));"></li>' +
		'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/bbcode_link.png" title="Selected text is a link" class="bbcode_button" onclick="var textArea = $(\'message\');var startTag = \'[l]\';var closeTag = \'[#l]\';var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');var selectedText = textArea.getSelectedText();textArea.set(\'value\', text.substring(0, pos.start) + startTag + selectedText + closeTag + text.substring(pos.end, text.length));"></li>' +
		'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/bbcode_img.png" title="Selected text is an image" class="bbcode_button" onclick="var textArea = $(\'message\');var startTag = \'[img]\';var closeTag = \'[#img]\';var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');var selectedText = textArea.getSelectedText();textArea.set(\'value\', text.substring(0, pos.start) + startTag + selectedText + closeTag + text.substring(pos.end, text.length));"></li>' +
		'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/bbcode_video.png" title="Selected text is a video" class="bbcode_button" onclick="var textArea = $(\'message\');var startTag = \'[v]\';var closeTag = \'[#v]\';var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');var selectedText = textArea.getSelectedText();textArea.set(\'value\', text.substring(0, pos.start) + startTag + selectedText + closeTag + text.substring(pos.end, text.length));"></li>';
	}else{var bbCode='<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/bbcodedisabledimage.png"/></li>';}
	
	document.getElementById('ToolBar').innerHTML = '<style type="text/css">textarea, .inputText {border-width: 1px;width: 98.5%;}textarea {padding-left: 3px;}.subTabMenu {border: 1px;margin-bottom: -1px;margin-top: -2px;padding: 1px;position: relative;z-index: 0;}.subTabMenu:after {content: "";clear: both;display: block;height: 0;}.subTabMenu .containerHead {margin: 0;padding: 2px;min-height: 5px;}.subTabMenu .containerHead h2, .subTabMenu .containerHead h3 {padding: 2px 5px;}.subTabMenu .containerHead:after {content: "";clear: both;display: block;height: 0;}.subTabMenu ul {list-style: none;margin: 0;padding: 0;}.subTabMenu li {float: left;}.subTabMenu li a {text-decoration: none;white-space: nowrap;margin: 1px;padding: 2px 6px;display: block;}.subTabMenu li.activeSubTabMenu a, .subTabMenu li a:hover {border-width: 1px;padding: 1px 5px;}.subTabMenu .containerHead div {font-size: 5px;height: 5px;}.mceToolbar {height: auto !important; display: block;}.mceToolbar ul {margin: 0 3px;padding: 0;width: 99.5%; display: block;float: left;}.mceToolbar li {display: block;position: relative;}.mceToolbar li a {margin: 1px;padding: 1px;}.mceToolbar li a:hover {margin: 1px;padding: 0;}.mceToolbar li.activeSubTabMenu a {margin: 1px;padding: 0;}.subTabMenu{background-color:#C6B08B}.subTabMenu div.containerHead{border-color:#C6B08B}.subTabMenu{border-style:solid}.containerHead{background-color:#8B7355}textarea{background-color:#fff;border-color:#8da4b7;border-style:solid;font-family:\'Trebuchet MS\', Arial, sans-serif;color:#333;font-size:.85em}textarea:focus{background-color:#fff9f4;border-color:#fa2;border-width:1px;color:#000}</style>' +
	'<div class="subTabMenu" width="400px"><div class="containerHead"><div class="mceToolbar" id="mce_editor_0_toolBar"><ul>' +
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/bbcode_smiles.png" title="Open smileys bar" class="bbcode_button" onclick="if(document.getElementById(\'smiles\').style.display==\'none\'){document.getElementById(\'smiles\').style.display=\'block\';}else{document.getElementById(\'smiles\').style.display=\'none\';}"></li>' +
	bbCode+'</ul>'+
	'<br><ul style="display:none;margin-top:3px;" id="smiles">'+
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/smile.png" style="cursor:pointer;margin:3px;" onclick="var textArea = $(\'message\');var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');textArea.set(\'value\', text.substring(0, pos.start) + \' :) \' + text.substring(pos.end, text.length));"></li>' +
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/sad.png" style="cursor:pointer;margin:3px;" onclick="var textArea = $(\'message\');var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');textArea.set(\'value\', text.substring(0, pos.start) + \' :( \' + text.substring(pos.end, text.length));"></li>' +
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/biggrin.png" style="cursor:pointer;margin:3px;" onclick="var textArea = $(\'message\');var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');textArea.set(\'value\', text.substring(0, pos.start) + \' :D \' + text.substring(pos.end, text.length));"></li>' +
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/wink.png" style="cursor:pointer;margin:3px;" onclick="var textArea = $(\'message\');var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');textArea.set(\'value\', text.substring(0, pos.start) + \' ;) \' + text.substring(pos.end, text.length));"></li>' +
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/w00t.png" style="cursor:pointer;margin:3px;" onclick="var textArea = $(\'message\');var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');textArea.set(\'value\', text.substring(0, pos.start) + \' 8o \' + text.substring(pos.end, text.length));"></li>' +
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/unsure.png" style="cursor:pointer;margin:3px;" onclick="var textArea = $(\'message\');var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');textArea.set(\'value\', text.substring(0, pos.start) + \' :S \' + text.substring(pos.end, text.length));"></li>' +
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/tongue.png" style="cursor:pointer;margin:3px;" onclick="var textArea = $(\'message\');var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');textArea.set(\'value\', text.substring(0, pos.start) + \' :P \' + text.substring(pos.end, text.length));"></li>' +
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/squint.png" style="cursor:pointer;margin:3px;" onclick="var textArea = $(\'message\');var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');textArea.set(\'value\', text.substring(0, pos.start) + \' ^^ \' + text.substring(pos.end, text.length));"></li>' +
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/mellow.png" style="cursor:pointer;margin:3px;" onclick="var textArea = $(\'message\');var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');textArea.set(\'value\', text.substring(0, pos.start) + \' :| \' + text.substring(pos.end, text.length));"></li>' +
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/crying.png" style="cursor:pointer;margin:3px;" onclick="var textArea = $(\'message\');var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');textArea.set(\'value\', text.substring(0, pos.start) + \' ;( \' + text.substring(pos.end, text.length));"></li>' +
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/cool.png" style="cursor:pointer;margin:3px;" onclick="var textArea = $(\'message\');var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');textArea.set(\'value\', text.substring(0, pos.start) + \' 8) \' + text.substring(pos.end, text.length));"></li>' +
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/confused.png" style="cursor:pointer;margin:3px;margin-top:-4px;" onclick="var textArea = $(\'message\');var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');textArea.set(\'value\', text.substring(0, pos.start) + \' ?( \' + text.substring(pos.end, text.length));"></li>' +
	'<li><img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/blink.png" style="cursor:pointer;margin:3px;" onclick="var textArea = $(\'message\');var pos = textArea.getSelectedRange();var text = textArea.get(\'value\');textArea.set(\'value\', text.substring(0, pos.start) + \' 8| \' + text.substring(pos.end, text.length));"></li>' +
	'</ul>'+
	'</div></div></div>';
	
	document.getElementsByTagName('textarea')[0].style.width='474px';
	
	var buttons = document.createElement('tr');
	buttons.innerHTML='<td colspan="4"><div id="buttons" style="background:#DBCBA5;border-top:1px solid #AF8E50;border-bottom:1px solid #AF8E50;padding:5px;margin:10px -5px 0px -10px;">'+
	'<input type="checkbox" id="Check All" checked="checked" > <label for="Check All">'+L_checkAll+'</label></div></td>';
	var p2 = document.getElementById('ToolBar').parentNode.parentNode;
	p2.parentNode.insertBefore(buttons,p2);
	
	if(document.getElementById('mainbox').getElementsByTagName('tr')[0]){
		var num=document.getElementById('mainbox').getElementsByTagName('tr').length-4;
		var changeThemToo='';
		for(i=2;i<num;i++){
			var prevTd=document.getElementById('mainbox').getElementsByTagName('tr')[i-1].getElementsByTagName('td')[2].innerHTML;
			var thisTd=document.getElementById('mainbox').getElementsByTagName('tr')[i].getElementsByTagName('td')[2].innerHTML;
			if(thisTd!=prevTd){
				document.getElementById('buttons').innerHTML+=' | <input type="checkbox" id="'+thisTd+'" checked="checked"><label for="'+thisTd+'">'+thisTd+'</label>';
				document.getElementById(thisTd).setAttribute('onclick',"var countTheChecked=0;for(i=2;i<"+num+";i++){if(document.getElementById('mainbox').getElementsByTagName('tr')[i].getElementsByTagName('td')[2].innerHTML==this.getAttribute('id')){document.getElementById('mainbox').getElementsByTagName('tr')[i].getElementsByTagName('td')[0].getElementsByTagName('input')[0].checked=this.checked;}if(document.getElementById('mainbox').getElementsByTagName('tr')[i].getElementsByTagName('td')[0].getElementsByTagName('input')[0].checked){countTheChecked=countTheChecked+1;}}countTheChecked=countTheChecked+2;if(countTheChecked!="+num+"){document.getElementById('Check All').checked=false;}else{document.getElementById('Check All').checked=true;}");
				changeThemToo+="document.getElementById('"+thisTd+"').checked=this.checked;"
			}
		}
		document.getElementById("Check All").setAttribute('onclick',"for(i=2;i<"+num+";i++){document.getElementById('mainbox').getElementsByTagName('tr')[i].getElementsByTagName('td')[0].getElementsByTagName('input')[0].checked=this.checked;}"+changeThemToo);
		
	}
}

//################################################################################################################################
//## CHAT
//################################################################################################################################
function Chat(){
	if(document.getElementById('mainmenu')){
		var chatlink = document.createElement('a');
		chatlink.setAttribute('id', 'ChatLink');
		chatlink.setAttribute('class', 'menuitem');
		chatlink.setAttribute('title', 'Chat');
		chatlink.setAttribute('href', '#');
		chatlink.innerHTML='Chat';
		var targetElement=document.getElementById('mainmenu').getElementsByTagName('a')[2];
		insertAfter(chatlink,targetElement);
		
		document.getElementById("ChatLink").addEventListener("click", makeChatSelection, false);
	}
}

function makeChatSelection(){
	if(document.getElementById('mainmenu').getElementsByTagName('a')[0]){
		var j=document.getElementById('mainmenu').getElementsByTagName('a').length;
		var t=false;var i=0;
		while(!t && i<j){
			if(document.getElementById('mainmenu').getElementsByTagName('a')[i].getAttribute('class')=='menuitem_aktive' && !document.getElementById('mainmenu').getElementsByTagName('a')[i].innerHTML.match(/\(/i)){
				document.getElementById('mainmenu').getElementsByTagName('a')[i].setAttribute('class','menuitem');
				t=true;
			}else if(document.getElementById('mainmenu').getElementsByTagName('a')[i].getAttribute('class')=='submenuitem_aktive'){
				document.getElementById('mainmenu').getElementsByTagName('a')[i].setAttribute('class','submenuitem');
				t=true;
			}
			i++;
		}
	}
	document.getElementById('ChatLink').setAttribute('class','menuitem_aktive');
	if(document.getElementById('content')){
		if(Get_Cookie('playerName')){
			var username=Get_Cookie('playerName');
		}else{
			var username='Anonymous_'+Math.floor(Math.random()*1001);
		}
		if(Get_Cookie('guildName')){
			var guildbutton='';
		}else{
			var guildbutton=' style="opacity:0.55;" onclick="document.getElementById(\'errorlog\').innerHTML=\''+L_noGuildText+'.\';"';
		}
		document.getElementById('content').innerHTML='<div style="margin-top:0px;" class="contentItem">'+
		'<h3>Select a chat room</h3><div class="contentItem_content">'+
		'<div style="background: url(http://epiratiko.webs.com/images/chat_icon.png) top left; background-repeat: no-repeat;position:absolute;margin:-10px;width:120px;height:120px;"></div>'+
		'<div style="margin-left:120px;margin-top:16px;">'+
		'<div id="Username"><b><font size="4">'+L_Username+': </font></b><font size="4"><i>'+username+'</i></font></div>'+
		'<div id="Username"><b><font size="4">Server: </font></b><font size="4"><i>'+GCAO_server+'</i></font></div>'+
		'<div id="Username"><b><font size="4">'+L_Country+': </font></b><font size="4"><i>'+GCAO_lang+'</i></font></div>'+
		'<br><input type="button"'+guildbutton+'id="guildChat" value="'+L_GuildChat+'" class="button2"> '+
		'<input type="button" id="countryChat" value="'+L_CountryChat+'" class="button2"> '+
		'<input type="button" id="globalChat" value="'+L_GlobalChat+'" class="button2"><br>'+
		'<span id="errorlog"></span><br><br></div></div></div>';
		
		if(document.getElementById('mainnav')){
			var numberOfTabs=document.getElementById('mainnav').getElementsByTagName('li').length;
			document.getElementById('mainnav').getElementsByTagName('li')[0].getElementsByTagName('a')[0].innerHTML='Chat';
			document.getElementById('mainnav').getElementsByTagName('li')[0].setAttribute('style','pngfix  current');
			var i=1;
			while(i<numberOfTabs){
				document.getElementById('mainnav').getElementsByTagName('li')[i].style.display='none';
				i++;
			}
		}
		
		if(Get_Cookie('guildName')){document.getElementById("guildChat").addEventListener("click", guildChat, false);}
		document.getElementById("countryChat").addEventListener("click", countryChat, false);
		document.getElementById("globalChat").addEventListener("click", globalChat, false);
	}
}

function guildChat(){
	if(Get_Cookie('playerName')){
		var username=Get_Cookie('playerName');
	}else{
		var username='Anonymous_'+Math.floor(Math.random()*1001);
	}
	var guildname=Get_Cookie('guildName');
	var guildRoom='GCA_'+guildname+'_Chat';
	makechat(username,guildRoom,guildname+' Chat');
}

function countryChat(){
	if(Get_Cookie('playerName')){
		var username=Get_Cookie('playerName')+'_s'+GCAO_server;
	}else{
		var username='Anonymous_'+Math.floor(Math.random()*1001)+'_s'+GCAO_server;
	}
	var countryRoom='GCA_'+GCAO_lang+'_Chat';
	makechat(username,countryRoom,L_CountryChat);
}

function globalChat(){
	if(Get_Cookie('playerName')){
		var username=Get_Cookie('playerName')+'_'+GCAO_lang+'_s'+GCAO_server;
	}else{
		var username='Anonymous_'+Math.floor(Math.random()*1001)+'_'+GCAO_lang+'_s'+GCAO_server;
	}
	var globalRoom='GCA_Global_Chat';
	makechat(username,globalRoom,L_GlobalChat);
}

function makechat(username,room,text){
	username=username.replace(/[;:{}+=()*&^%$#@]/g,'_').replace(/\[/g,'_').replace(/\]/g,'_');
	document.getElementById('content').innerHTML='<div class="contentItem">'+
	'<h3>'+text+'</h3><div class="contentItem_content">'+
	'<applet width="506" height="500" archive="papplet.jar" code="pclient.main.ChatClient.class" codebase="http://64.13.158.25/pchat/bc">'+
	'<param value="papplet.cab" name="cabbase">'+
	'<param value="free_no_roam" name="Net.Site">'+
	'<param value="'+room+'" name="Net.Room">'+
	'<param value="TRUE" name="Ctrl.AutoLogin">'+
	'<param value="false" name="Ad.BrandOn">'+
	'<param value="E7DEB8" name="Col.MainBg">'+
	'<param value="000000" name="Col.MainFg">'+
	'<param value="false" name="Ctrl.Roam">'+
	'<param value="'+username+'" name="Net.User">'+
	'</applet></div></div>'+
	'<span style="margin-top:-10px;">Powerad By <a href="http://www.parachat.com/" target="blank">Parachat</a>!<br>'+
	'<font style="font-size:8px;">If you can\'t access chat be sure that you are using the latest version of Sun Java, which is available for free in <a href="http://www.java.com/" target="_blank">http://www.java.com</a></span></font>';
}

//################################################################################################################################
//## REMEMBER TABS
//################################################################################################################################
function rememberTabs(event){
	var pageTarget=event.target+'';
	if (!pageTarget.match(/http/i)){pageTarget=event.target.parentNode+'';}
	if(pageTarget.match(/http/i)){
		if(pageTarget.match(/mod=(\w+)/i)){
			RTmod=pageTarget.match(/mod=(\w+)/i)[1];
			if(pageTarget.match(/submod=(\w+)/i)){var RTsubmod=pageTarget.match(/submod=(\w+)/i)[1];}
			else{var RTsubmod = 'noSubmod';}
			//&& RTmod!=GCAO_mod
			if(!pageTarget.match(/inv=\d+/i)){
				if(RTmod=='overview' || RTmod=='inventory' || RTmod=='packages' || RTmod=='guild_storage' || RTmod=='auction' || RTmod=='market' || RTmod=='guild_market' || RTmod=='guild_library'){
					if(Get_Cookie('PlayerInv')){
						if(event.target.href){
							event.target.href+='&inv='+Get_Cookie('PlayerInv');
						}else{
							event.target.parentNode.href+='&inv='+Get_Cookie('PlayerInv');
						}
					}
					if(RTmod=='inventory'){
						var sub=pageTarget.match(/sub=(\d+)/i)[1];
						if(Get_Cookie('Merchandsub'+sub)){
							event.target.href+='&subsub='+Get_Cookie('Merchandsub'+sub);
						}
					}
				}
			}else{
				Set_Cookie('PlayerInv',pageTarget.match(/inv=(\d+)/i)[1]);
				if(RTmod=='inventory'){
					if(pageTarget.match(/&subsub=(\d+)/i)[1]){
						var sub=pageTarget.match(/&sub=(\d+)/i)[1];
						Set_Cookie('Merchandsub'+sub,pageTarget.match(/&subsub=(\d+)/i)[1]);
					}
				}
			}
		}
	}
}

//################################################################################################################################
//## NEWS
//################################################################################################################################
function GCAnews(){
	var mainnav = document.getElementById('mainnav');
	var newTab = document.createElement('li');
	newTab.className='pngfix';
	newTab.innerHTML = '<a style="cursor:pointer;" class="pngfix">GCA News ! </a>';
	mainnav.appendChild(newTab);
	newTab.addEventListener('click', function(){seeGCANews();}, true); 
}

function seeGCANews(){
	GM_setValue('ShowNewsAlert',false);
	for(var i =0;i<document.getElementById('mainnav').childNodes.length-1;i++)
		document.getElementById('mainnav').childNodes[i].firstChild.className='pngfix ';
	document.getElementById('mainnav').childNodes[document.getElementById('mainnav').childNodes.length-1].firstChild.className='pngfix  current';
	document.getElementById('content').innerHTML = '<div class="title_box"><div class="title_inner">Gladiatus Crazy Add-on News</div></div>';
	document.getElementById('content').innerHTML += '<div class="title2_box"><div class="title2_inner" style="margin-left: -6px;">'
	+'<table width="100%"><tbody id="GCAO_CommentBox"></tbody></table></div></div>';
	document.getElementById('GCAO_CommentBox').innerHTML='<center>Downloading the latest news.</center>';
	GM_xmlhttpRequest({
		method: "GET",
		url: 'http://epiratiko.webs.com/apps/util/Comments/listPagedCommentsJS.jsp?userID=57974758&limit=20&pageNumber=1&commentSettingID=16841277&callBack=fw.Instances.get("fwRb16841277-comments").populateCommentDiv&loadRatings=false&ratingCallback=fw.Instances.get("fwRb16841277-comments").instance.parent.getRatingCallback&rand=0.23108505620818276&repeatLimit=40',
		onload: function(response){
			document.getElementById('GCAO_CommentBox').innerHTML='';
			//.replace(/class=..blogCommentProfileImage../g,'style="display:none;"')
			var comments = response.responseText.replace(/"/g, '').split('[');
			// For each comment
			for(var i = 1;i<comments.length;i++){
				var comment = comments[i].split(',');
				var name = comment[2];
				var message = '';
				// if there are colons in the message... 
				for(var j = 3;j<comment.length-4;j++){
					message += comment[j];
					if((comment.length-5)!=j) message +=',';
				}
				var time = comment[comment.length-4];
				document.getElementById('GCAO_CommentBox').innerHTML += newComment(name,message,time);
			}
		}
	});
}

function newComment(name,message,time){
	var checkname=name.toLowerCase();
	if(checkname.match(/gif.>(\w+)/i)){checkname=checkname.match(/gif.>(\w+)/i)[1];}
	else if(checkname.match(/>(\w+)<.a/i)){checkname=checkname.match(/>(\w+)<.a/i)[1];}
	if(checkname=="greatapo"){var image="http://board.gladiatus.fr/wcf/images/avatars/avatar-2288.jpg"}
	else if(checkname=="djor"){var image="http://board.gladiatus.fr/wcf/images/avatars/avatar-2336.jpg"}
	else if(checkname=="darkthanos"){var image="http://board.gladiatus.fr/wcf/images/avatars/avatar-2287.jpg"}
	else{var image="http://images.webs.com/static/global/profile_images/noProfilePic_male_100x100.gif"}
	name=name.replace(/<img[^>]+>/g,'');
	return '<table class="commentTable fw-even" title="posted '+time+'"><tbody><tr>'
	+'<td style="border:1px solid #af8e50;background-color:#ded8c6;padding:5px;width:449px;"><b><img border="0" align="left" src="'+image+'" class="blogCommentProfileImage" valign="top" style="margin-right:10px; width:40px;">'
	+name+':</b> <br>'+message+'</td></tr></tbody></table>';
}

//################################################################################################################################
//## CHECK FOR NEWS
//################################################################################################################################
function checkForNews(){
	GM_xmlhttpRequest({
		method: "GET",
		url: 'http://epiratiko.webs.com/apps/util/Comments/listPagedCommentsJS.jsp?userID=57974758&limit=20&pageNumber=1&commentSettingID=16841277&callBack=fw.Instances.get("fwRb16841277-comments").populateCommentDiv&loadRatings=false&ratingCallback=fw.Instances.get("fwRb16841277-comments").instance.parent.getRatingCallback&rand=0.23108505620818276&repeatLimit=40',
		onload: function(response){
			var comments = response.responseText.replace(/"/g, '').split('[');
			if(comments[1].match(/(\d+),/gi)){
				var commentNumber = comments[1].match(/(\d+),/gi)[1].replace(',','');
				if(commentNumber!=GM_getValue('LastCommentNumber',0)){
					GM_setValue('dayChecked',day.getDate());
					GM_setValue('LastCommentNumber',commentNumber);
					GM_setValue('ShowNewsAlert',true);
				}
			}
		}
	});
}

function showNewsAlert(){
	document.getElementById('mainmenu').getElementsByTagName('a')[2].innerHTML+=' <img id="NewsAlertImage" src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/exclamation.png" style="position:absolute;margin-left:10px;margin-top:1px;opacity: 0.65;" onmouseout="document.getElementById(\'mainmenu\').getElementsByTagName(\'a\')[2].setAttribute(\'href\',\''+GCAO_result[1]+'mod=guild&sh='+GCAO_secureCode+'\');this.style.opacity=\'0.65\';document.getElementById(\'newsAlert\').style.display=\'none\';" onmouseover="document.getElementById(\'mainmenu\').getElementsByTagName(\'a\')[2].removeAttribute(\'href\');this.style.opacity=\'1\';document.getElementById(\'newsAlert\').style.display=\'block\';">';
	var alertTip = document.createElement('div');
	alertTip.setAttribute('id', 'newsAlert');
	alertTip.setAttribute('style', 'opacity: 0.75;display:none;width:300px;z-index:502;position:absolute;top:237px;left:345px;border:1px solid grey;background-color:black;color:#c0c0c0;font-weight:bold;height:24px;line-height:24px;padding-left:5px;padding-right:5px;')
	alertTip.innerHTML = L_newsAlert;
	document.getElementById('header_game').appendChild(alertTip);
	document.getElementById('NewsAlertImage').addEventListener('click', function(){seeGCANews();}, true); 
}

//################################################################################################################################
//## CHANGE CURSOR
//################################################################################################################################
function changeTheCursor(){
	var choosedCur=GM_getValue('cu', 0);
	
	if(choosedCur==1){
	//WoW
		var normalCur='http://epiratiko.webs.com/GCAO/cursors/hand.cur';
		var pointerCur='http://epiratiko.webs.com/GCAO/cursors/greyhand.cur';
		var moveCur='http://epiratiko.webs.com/GCAO/cursors/bluehand.cur';
		var textCur='http://epiratiko.webs.com/GCAO/cursors/blacktext.cur';
		var attackCur='http://epiratiko.webs.com/GCAO/cursors/sword.cur';
	}else if(choosedCur==2){
	//Oxygen Black
		var normalCur='http://epiratiko.webs.com/GCAO/cursors/blackcur.cur';
		var pointerCur='http://epiratiko.webs.com/GCAO/cursors/backhand.cur';
		var moveCur='http://epiratiko.webs.com/GCAO/cursors/blackmove.cur';
		var textCur='http://epiratiko.webs.com/GCAO/cursors/blacktext.cur';
		var attackCur='http://epiratiko.webs.com/GCAO/cursors/backhand.cur';
	}else if(choosedCur==3){
	//Oxygen White
		var normalCur='http://epiratiko.webs.com/GCAO/cursors/whitecur.cur';
		var pointerCur='http://epiratiko.webs.com/GCAO/cursors/whitehand.cur';
		var moveCur='http://epiratiko.webs.com/GCAO/cursors/whiremove.cur';
		var textCur='http://epiratiko.webs.com/GCAO/cursors/whitetext.cur';
		var attackCur='http://epiratiko.webs.com/GCAO/cursors/whitehand.cur';
	}else if(choosedCur==4){
	//Sword
		var normalCur='http://epiratiko.webs.com/GCAO/cursors/Sword_main.cur';
		var pointerCur='http://epiratiko.webs.com/GCAO/cursors/Sword_link.cur';
		var moveCur='http://epiratiko.webs.com/GCAO/cursors/Sword_move.cur';
		var textCur='http://epiratiko.webs.com/GCAO/cursors/Sword_text.cur';
		var attackCur='http://epiratiko.webs.com/GCAO/cursors/Sword_backgroundactivity.cur';
	}
	
	var cursorStyle=document.createElement('style');
	cursorStyle.innerHTML="body , select {cursor:url("+normalCur+"),default}";
	cursorStyle.innerHTML+="body a , .charmercsel , .bbcode_button , input[type=\"checkbox\"] , input[type=\"radio\"] , input[type=\"submit\"] , input[type=\"button\"] , input[type=\"image\"] , .achievement_last_ten , .header , #select tr.hover td , #select tr.hover th , #select tr th.selection , #select tr.select td , #select tr , .achievement_header {cursor:url("+pointerCur+"),pointer}";
	cursorStyle.innerHTML+="input , textarea {cursor:url("+textCur+"),text}";
	cursorStyle.innerHTML+="#inv img , #char img , #shop img {cursor:url("+moveCur+"),move}";
	if(GCAO_mod=='packages'){cursorStyle.innerHTML+=" #content div div table div img {cursor:url("+moveCur+"),move}";}
	if(GCAO_mod=='player'){cursorStyle.innerHTML+=" #content input[type=\"button\"] {cursor:url("+attackCur+"),move}";}
	if(document.getElementById('p8_1_1')){document.getElementById('p8_1_1').style.cursor="url("+pointerCur+"),pointer";}
	document.body.appendChild(cursorStyle);
	
	if(document.getElementById('mainnav').getElementsByTagName('a')[0]){
		for(i=0;i<document.getElementById('mainnav').getElementsByTagName('a').length;i++){
			document.getElementById('mainnav').getElementsByTagName('a')[i].style.cursor="url("+pointerCur+"),pointer";
		}
	}
	if(document.getElementById('ButtonsDiv')){
		if(document.getElementById('ButtonsDiv').getElementsByTagName('img')[0]){
			for(i=0;i<document.getElementById('ButtonsDiv').getElementsByTagName('img').length;i++){
				document.getElementById('ButtonsDiv').getElementsByTagName('img')[i].style.cursor="url("+pointerCur+"),pointer";
			}
		}
	}
	if(GCAO_mod=='arena' && document.getElementById('content').getElementsByTagName('img')[0]){
		for(i=0;i<document.getElementById('content').getElementsByTagName('img').length;i++){
			if(document.getElementById('content').getElementsByTagName('img')[i].src.match(/fordern/i)){
				document.getElementById('content').getElementsByTagName('img')[i].style.cursor="url("+attackCur+"),pointer";
			}
		}
	}else if(GCAO_mod=='overview' && GCAO_submod=='achievements'){
		for(i=0;i<document.getElementById('content').getElementsByTagName('div').length;i++){
			if(document.getElementById('content').getElementsByTagName('div')[i].getAttribute('class')){
				if(document.getElementById('content').getElementsByTagName('div')[i].getAttribute('class').match('title_inner')){
					document.getElementById('content').getElementsByTagName('div')[i].setAttribute('style',"cursor: url("+pointerCur+"),pointer");
				}
			}
		}
	}else if(GCAO_mod=='dungeon'){
		if(document.getElementById('content').getElementsByTagName('area')){
			for(i=0;i<document.getElementById('content').getElementsByTagName('area').length;i++){
				document.getElementById('content').getElementsByTagName('area')[i].setAttribute('style',"cursor: url("+attackCur+"),pointer");
			}
		}
	}
	if(document.getElementById('wio')){document.getElementById('wio').style.cursor="url("+pointerCur+"),pointer";}
	if(document.getElementById('cooldown_bar_fill_life')){document.getElementById('cooldown_bar_fill_life').parentNode.style.cursor="url("+pointerCur+"),pointer";}
}

//################################################################################################################################
//## CAN I EAT THIS?
//################################################################################################################################
function canIeatThis(){
	if(document.getElementById('inv')){
		var healpoints=document.getElementById('char_leben_tt').getAttribute('onmouseover').match(/(\d+) \/ (\d+)/i);
		var lostPoints=healpoints[2]*1-healpoints[1]*1;
		if(lostPoints>0){
			document.getElementById('char_leben').setAttribute('style','font-size:0.9em;margin-top:3px;');
			document.getElementById('char_leben_tt').innerHTML+='<font style="font-size:0.8em;text-align:right;position:absolute;margin-top:-20px;margin-right:0px;width:169px;">(<font color="red">-'+lostPoints+'</font>)</font>';
		}
		
		var x=0;
		while(!document.body.getElementsByTagName('script')[x].innerHTML.match('AddCharDiv') && (x<100)){x++;}
		
		var divs = document.evaluate(".//img",document.getElementById('inv'),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
		for(var i = 0; i< divs.snapshotLength;i++){
			var type = divs.snapshotItem(i).getAttribute('src').split('_')[0];
			type = type[type.length-1];
			if(type==7){
				var AddCharDiv =document.body.getElementsByTagName('script')[x].innerHTML.split('AddCharDiv("'+divs.snapshotItem(i).parentNode.id)[1].split('AddCharDiv("')[0];
				if(AddCharDiv.split("<td ")[2].indexOf('(')!=-1){var lifeCure = AddCharDiv.split("<td ")[3].split(':')[4].split('<')[0].replace(/[^0-9]/g,'');}
				else{var lifeCure = AddCharDiv.split("<td ")[2].split(':')[4].split('<')[0].replace(/[^0-9]/g,'');}
				
				var foo = document.getElementById('char_leben_tt').getAttribute('onmouseover').split('</td>')[1].split('>')[1];
				var lifeToCure = parseInt(foo.split(' / ')[1]) - parseInt(foo.split(' / ')[0]);
				if(lifeToCure<lifeCure){divs.snapshotItem(i).style.backgroundColor='rgba(255, 0, 0, 0.2)';}
			}
		}
	}
}

//################################################################################################################################
//## GUILD MEDIC BOX
//################################################################################################################################
function guildMedicBox(){
	if(document.getElementById('content').getElementsByTagName('p')[0]){
		var healPercent=document.getElementById('content').getElementsByTagName('p')[0].innerHTML.match(/(\d+)%/i)[1];
		var healpoints=document.getElementById('char_leben_tt').getAttribute('onmouseover').match(/(\d+) \/ (\d+)/i);
		var currentPoints=healpoints[1]*1;
		var maxPoints=healpoints[2]*1;
		var lifePercent=Math.round(currentPoints/maxPoints*100);
		var medicPoints=Math.round(maxPoints*(healPercent/100));
		var afterHealPoints=currentPoints+medicPoints;
		if(afterHealPoints>maxPoints){afterHealPoints=maxPoints;}
		var afterPersent=Math.round(afterHealPoints/maxPoints*100);
		
		var newDiv = document.createElement('div');
		newDiv.setAttribute('class','title2_box');
		newDiv.setAttribute('style','width:298px;margin-left:220px;margin-top:90px;');
		newDiv.innerHTML = '<div class="title2_inner"><table>'+
		'<tr><td>'+L_currentLife+'</td><td>:</td><td>'+currentPoints+' / '+maxPoints+'</td><td>('+lifePercent+'%)</td></tr>'+
		'<tr><td>'+L_lostLife+'</td><td>:</td><td><font color="red">-'+(maxPoints-currentPoints)+'</font></td><td>('+(100-lifePercent)+'%)</td></tr>'+
		'<tr><td>'+L_healLife+'</td><td>:</td><td><font color="green">+'+medicPoints+'</font></td><td>('+healPercent+'%)</td></tr>'+
		'<tr><td>'+L_afterLife+'</td><td>:</td><td>'+afterHealPoints+'</td><td>('+afterPersent+'%)</td></tr>'+
		'</table></div>';
		document.getElementById('content').appendChild(newDiv);
	}
}

//################################################################################################################################
//## DROPPED ITEMS
//################################################################################################################################
// Function which allow to search dropped objects in the reports list (expedition or donjon)
function searchObjects(){
	if(!document.getElementById('bx0')){
		var divs = document.evaluate(".//div[@class='report_statistic']",document.getElementById('content'),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
		var divsIMG = document.evaluate(".//img[substring(@src,5)='/img/interface/package.gif']",divs.snapshotItem(0),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
		var divsTR = document.evaluate(".//tr",divs.snapshotItem(0),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);

		var array = new Array();

		//Allow to know in which row the package is (array[5]= 8 means the 5th object is at the 8th row)
		for(var i =0; i<divsTR.snapshotLength;i++)
			if(divsTR.snapshotItem(i).innerHTML.match('package.gif'))
				array[array.length] = i-1;

		for(var i =0; i<divsIMG.snapshotLength;i++){
			var divsTD = document.evaluate(".//td",divsIMG.snapshotItem(i).parentNode.parentNode,null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
			var uurl = GCAO_siteurl + divsTD.snapshotItem(4).firstChild.getAttribute('href').substring(10); //Begin with "index.php?" and we don't want (already in GCAO_siteurl var)
			getObject(divsIMG,array,uurl,i);
		}
	}
}
// Get the html table of the object i in the reports list at the url uurl
function getObject(divsIMG,array,uurl,i){
	// alert(uurl+'   '+i);
	GM_xmlhttpRequest({
		method: "GET",
		url: uurl,
		onload: function(response){
			divsIMG.snapshotItem(i).removeAttribute('title');
			divsIMG.snapshotItem(i).setAttribute('onmouseover','document.getElementById(\'object'+i+'\').style.display=\'block\'');
			divsIMG.snapshotItem(i).setAttribute('onmouseout','document.getElementById(\'object'+i+'\').style.display=\'none\'');
			var warningTip = document.createElement('div');
			warningTip.setAttribute('id', 'object'+i);
			// HTML table of the object (with good ' and " ...) 
			var text = response.responseText.split('return escape(\'')[11].split('\')"><img')[0].replace(/\\'/g,'"');
			warningTip.setAttribute('style', 'opacity: 0.90; display: none; z-index: 502; position: absolute; top: '+(320+array[i]*22)+'px; left: 890px; background-color: black; color: rgb(192, 192, 192); font-weight: bold; text-align: left;');
			warningTip.innerHTML = text;
			document.getElementById('header_game').appendChild(warningTip);
		}
	});
}

//################################################################################################################################
//## SAVE GUILDMATES IDS
//################################################################################################################################
function saveGuildmatesIDs(){
    var mates = new Array();
	var c=1;
	if(document.getElementById('mainbox').getElementsByTagName('tr')[c].getElementsByTagName('td').length==5){
		while(document.getElementById('mainbox').getElementsByTagName('tr')[c].getElementsByTagName('td')[0]){
			// alert(document.getElementById('mainbox').getElementsByTagName('tr')[c].getElementsByTagName('td')[0].innerHTML);
			if(document.getElementById('mainbox').getElementsByTagName('tr')[c]){
				var mateID=document.getElementById('mainbox').getElementsByTagName('tr')[c].getElementsByTagName('td')[0].innerHTML.match(/&amp;p=(\d+)/i)[1];
				var mateNAME=document.getElementById('mainbox').getElementsByTagName('tr')[c].getElementsByTagName('td')[0].innerHTML.match(/>([^<]+)</i)[1];
				mates[c]=mateNAME+"<"+mateID;
				c++;
			}
		}
		Set_Cookie("GCAOguildMates",mates.join("#"),365);
	}
}


//################################################################################################################################
//## EXPIRED PACKAGES
//################################################################################################################################
function expiredPackages(diffHourMin){
	GM_xmlhttpRequest({
		method: "GET",
		url: GCAO_siteurl + 'mod=packages&sh='+GCAO_secureCode+'&page=9999',
		onload: function(response){
			var packets = response.responseText.split('<span style="float:left;margin-right:5px">');
			if(packets.length!=1){
				var lastPacket = packets[packets.length-1];
				var lastTime = lastPacket.split('<br />')[4];
				
				var day = lastTime.split(', ')[1].split('.')[0];
				var month = lastTime.split(', ')[1].split('.')[1];
				var hour = lastTime.split(' - ')[1].split(':')[0];
				var minute = lastTime.split(' - ')[1].split(':')[1];
				var seconde = lastTime.split(' - ')[1].split(':')[2];
				
				var d = new Date();
				var currenthay = d.getDate();
				var currentMonth = d.getMonth()+1; //+1 because getMonth gives [0-11], not [1-12] for month
				var currentHour = d.getHours()+1; // +1 because it's better to have the next hour... 
				var currentMinute = d.getMinutes();
				var currentSecond = d.getSeconds();
				
				// Ecart à déterminer : ~12h
				var diffHour;
				// In the same month
				if(month==currentMonth){
					// in the same day
					if(day==currenthay){
						diffHour = hour-currentHour;
					}else{
						diffHour= hour-currentHour+24*(day-currenthay);
					}
				}
				// Not in the same month
				else{
					// Number of days in the month
					if((currentMonth==1)||(currentMonth==3)||(currentMonth==5)||(currentMonth==7)||(currentMonth==8)||(currentMonth==10)||(currentMonth==12))
						var numberDays = 31;
					else if(currentMonth==2)
						var numberDays = 28;
					else
						var numberDays = 30;
					
					diffHour= hour-currentHour+24*(day+numberDays-currenthay);
				}
				
				if(diffHour<diffHourMin)
					document.getElementById('menue_packages').innerHTML += '<img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/exclamation.png" style="position:absolute;margin-left:5px;opacity: 0.90;" onmouseout="this.style.opacity=\'0.90\';" onmouseover="this.style.opacity=\'1\';" onClick="'+GCAO_siteurl + 'mod=packages&sh='+GCAO_secureCode+'&page=9999" title="'+L_PackagesWillExpire+' ! '+diffHour+' '+L_hours+'">';
				
			}
		}
	});
		
}

//################################################################################################################################
//## OPTIONS / ??T??S??S
//################################################################################################################################
function settings(){
	var settingsDiv = document.createElement('div');
	settingsDiv.setAttribute('id', 'AddOnSettingsBox');
	settingsDiv.setAttribute('style', 'margin-left:20px;margin-right:20px;');
	settingsDiv.innerHTML = '<div class="title_box"><div class="title_inner" id="title">'+L_GCASettings+'</div> </div>'+
	'<div class="title2_box"><div class="title2_inner"><span id="Settings">'+
	'<b>- '+L_HeaderSettings+':</b><br>'+
	'<input type="checkbox" name="lb" id="GCAO_s1">'+L_DisplayLife+'<br>'+
	'<input type="checkbox" name="rb" id="GCAO_s32" style="margin-left:20px;">'+L_DisplayLifePercent+'<br>'+
	'<input type="checkbox" name="bu" id="GCAO_s2">'+L_DisplayLinkButtons+'<br>'+
	'<input type="checkbox" name="au" id="GCAO_s3">'+L_DisplayAuctionStatus+'<br>'+
	'<input type="checkbox" name="sa" id="GCAO_s19" style="margin-left:20px;">'+L_DisplayMerchantStatus+'<br>'+
	'<input type="checkbox" name="op" id="GCAO_s16">'+L_DisplayOnlinePlayersButton+'<br>'+
	'<input type="checkbox" name="li" id="GCAO_s17">'+L_DisplayLinkBox+'<br>'+
	'<br><b>- '+L_TimersSettings+':</b><br>'+
	'<input type="checkbox" name="at" id="GCAO_s35">'+L_DisplayLastBeingAttacked+'<br>'+
	'<input type="checkbox" name="kt" id="GCAO_s43">'+L_DisplayLastBeingAttacked2+'<br>'+
	'<br><b>- '+L_AuctionSettings+':</b><br>'+
	'<input type="checkbox" name="af" id="GCAO_s4">'+L_FillAuctionPrices+'<br>'+
	'<input type="checkbox" name="cb" id="GCAO_s5">'+L_ChangeItemsBgColor+'<br>'+
	'<input type="checkbox" name="ml" id="GCAO_s6">'+L_AuctionMoreItemsLavels+'<br>'+
	'<input type="checkbox" name="an" id="GCAO_s7">'+L_DisplayItemNumAndBids+'<br>'+
	'<input type="checkbox" name="il" id="GCAO_s8">'+L_DisplayItemList+'<br>'+
	'<input type="checkbox" name="ea" id="GCAO_s28">'+L_ExpandAuctionTable3+'<br>'+
	'<input type="checkbox" name="hg" id="GCAO_s39">'+L_HideGoldInAuction+'<br>'+
	'<br><b>- '+L_SimulatorSettings+':</b><br>'+
	'<input type="checkbox" name="si" id="GCAO_s11">'+L_enSimulator+'<br>'+
	'<font style="margin-left:20px;">'+L_setFightNum+'</font>: <input type="int" name="sf" id="GCAO_sf" value="1000" maxlength="5" size="3"> ('+L_maximum+' 20.000)<br>'+
	'<br><b>- '+L_guildSettings+':</b><br>'+
	'<input type="checkbox" name="st" id="GCAO_s18">'+L_guildStoreInfo+'<br>'+
	'<input type="checkbox" name="gg" id="GCAO_s20">'+L_moreGuildStats+'<br>'+
	'<input type="checkbox" name="sc" id="GCAO_s40">'+L_guildSafeChanges+'<br>'+
	'<input type="checkbox" name="gm" id="GCAO_s41">'+L_guildMedicChanges+'<br>'+
	'<input type="checkbox" name="gs" id="GCAO_s22">'+L_monsterSimulator+'<br>'+
	'<input type="checkbox" name="mc" id="GCAO_s38">'+L_gmailChanges+' (messagebar, checkboxes)<br>'+
	'<input type="checkbox" name="pr" id="GCAO_s27">'+L_ratioOpt+'<br>'+
	'<input type="checkbox" name="rr" id="GCAO_s33" style="margin-left:20px;">'+L_enPriceRatio+'<br>'+
	'<b style="margin-left:20px;">[Formula]</b>: Food ratio = life/price , Price ratio = sell price/{(price+value)/2}<br>'+
	'<br><b>- '+L_alertSettings+':</b><br>'+
	'<input type="checkbox" name="ca" id="GCAO_s25">'+L_immedBuy+'<br>'+
	'<input type="checkbox" name="ce" id="GCAO_s26">'+L_reduceTimeEx+'<br>'+
	'<input type="checkbox" name="nq" id="GCAO_s30">'+L_questOpt+'<br>'+
	'<input type="checkbox" name="fm" id="GCAO_s29">'+L_forumMessageOpt+'<br>'+
	'<input type="checkbox" name="wd" id="GCAO_s31">'+L_weaponAlertOpt+'<br>'+
	'<input type="checkbox" name="pa" id="GCAO_s44">'+L_packageAlertOpt+'<br>'+
	'<br><b>- '+L_otherSettings+':</b><br>'+
	'<input type="checkbox" name="ms" id="GCAO_s9">'+L_msgchangesOpt+'<br>'+
	'<input style="margin-left:20px;" type="checkbox" name="bb" id="GCAO_s34">'+L_enBBCODE+'<br>'+
	'<input type="checkbox" name="ch" id="GCAO_s36">'+L_enChat+'<br>'+
	'<input type="checkbox" name="rt" id="GCAO_s37">'+L_enRememberTabs+'<br>'+
	'<input type="checkbox" name="pi" id="GCAO_s10">'+L_enImages+'<br>'+
	'<input type="checkbox" name="dc" id="GCAO_s24">'+L_disPackageCounters+'<br>'+
	'<input type="checkbox" name="id" id="GCAO_s21">'+L_disID+'<br>'+
	'<input type="checkbox" name="dh" id="GCAO_s23">'+L_disHeal+'<br>'+
	'<input type="checkbox" name="ba" id="GCAO_s12">'+L_disTrainingChages+'<br>'+
	'<input type="checkbox" name="hi" id="GCAO_s13">'+L_enHighlight+'<br>'+
	'<input type="checkbox" name="lp" id="GCAO_s42">'+L_foodBackColor+'<br>'+
	'<input type="checkbox" name="fi" id="GCAO_s14">'+L_enStyleFixes+'<br>'+
	'<font style="margin-left:5px;">'+L_customCursor+': <select name="cu" id="GCAO_cu"><option value="0" id="cu_0">Default</option><option value="1" id="cu_1">WoW</option><option value="2" id="cu_2">Oxygen Black</option><option value="3" id="cu_3">Oxygen White</option><option value="4" id="cu_4">Sword</option></select></font><br>'+
	'<br><b>- '+L_speedSettings+':</b><br>'+
	'<input type="checkbox" name="sp" id="GCAO_s15">'+L_stopPulling+'<br><b style="margin-left:20px;">'+L_willStop+'</b>:<br><font style="margin-left:20px;">Life Bar, Simulator, new quest alert, new forum message alert, weapon down alert</font>'+
	''+
	'<br><br><input class="button2" value="'+L_Save+'" type="button" id="saveGCAOstats"/>' +
	'<input style="margin-left:44px;" type="button" class="button1" onclick="document.getElementById(\'title\').innerHTML=\''+L_aboutTitle+'\';document.getElementById(\'Settings\').style.display=\'none\';document.getElementById(\'AboutUs\').style.display=\'block\';" value="'+L_AboutUs+'"/>'+
	'<input style="margin-left:44px;display:none;" type="button" class="button2" onclick="document.getElementById(\'title\').innerHTML=\'Gladiatus Crazy Add On News\';document.getElementById(\'Settings\').style.display=\'none\';document.getElementById(\'News\').style.display=\'block\';" value="News"/>'+
	'</span><span id="AboutUs" style="display:none;">'+
	'<b>- '+L_descriptionTitle+':</b>'+
	'<br>'+L_description+
	'<br><br><b>- '+L_Programmers+':</b><br> &bull; GreatApo<br> &bull; DarkThanos<br> &bull; djor'+
	'<br><br><b>- '+L_Translators+':</b><br> &bull; [English] GreatApo<br> &bull; [Greek] GreatApo & DarkThanos<br> &bull; [French] djor'+
	'<br><br><b>- '+L_Hostpage+':</b> <a href="http://www.epiratiko.webs.com/crazyaddons.htm" target="_blank">www.epiratiko.webs.com</a>'+
	'<br><br><b>- '+L_ContactUs+':</b>'+
	'<br> '+L_Contact1+
	'<br> '+L_Contact2+
	'<br> '+L_Contact3+
	'<br><br><b>- '+L_thanksTo+':</b><br><div style="padding-left:20px;"><b>'+L_MonsterHunters+':</b><br>maximus48[FR], snow[FR], Zafistus[FR], pendu[FR], Nls_01[FR], The-Achille[FR], Jinsu[FR], Rincevent[FR], @roi-guerrier@[FR], Neox[FR], naruto12121998[FR], chupadu84[FR], tituslegrand[FR], Spli[FR], stxr[GR], imbri[US], brich21[US], cody6052[US], Baleful[US]'+
	'<br><b>'+L_ItemHunters+':</b><br>gstefan[GR], Despistado[S]</div>'+
	'<br><input class="button2" value="'+L_Settings+'" type="button" onclick="document.getElementById(\'title\').innerHTML=\''+L_GCASettings+'\';document.getElementById(\'AboutUs\').style.display=\'none\';document.getElementById(\'Settings\').style.display=\'block\';"/>' +
	'<input style="margin-left:44px;" type="button" class="button1 disabled" disabled="disabled" value="'+L_AboutUs+'"/>'+
	'<input style="margin-left:44px;display:none;" type="button" class="button2" onclick="document.getElementById(\'title\').innerHTML=\'Gladiatus Crazy Add On News\';document.getElementById(\'AboutUs\').style.display=\'none\';document.getElementById(\'News\').style.display=\'block\';" value="News"/>'+
	'</span>'+
	'<span id="News" style="display:none;">'+
	'<span id="NewsContent"></span>'+
	'<br><br><input class="button2" value="'+L_Settings+'" type="button" onclick="document.getElementById(\'title\').innerHTML=\''+L_GCASettings+'\';document.getElementById(\'News\').style.display=\'none\';document.getElementById(\'Settings\').style.display=\'block\';"/>' +
	'<input style="margin-left:44px;" type="button" class="button1" onclick="document.getElementById(\'title\').innerHTML=\''+L_aboutTitle+'\';document.getElementById(\'News\').style.display=\'none\';document.getElementById(\'AboutUs\').style.display=\'block\';" value="'+L_AboutUs+'"/>'+
	'<input style="margin-left:44px;" type="button" class="button2 disabled" disabled="disabled" value="News"/>'+
	'</span>'+
	'</div></div>'+
	'<br><div class="title_box"><div class="title_inner" id="title">'+L_donateTitle+'</div></div>'+
	'<div class="title2_box"><div class="title2_inner">'+
	'<p>'+L_donateText+' :)'+
	'<br><center><form border="0" action="https://www.paypal.com/cgi-bin/webscr" method="post">'+
	'<input type="hidden" name="cmd" value="_s-xclick">'+
	'<input type="hidden" name="hosted_button_id" value="NLTXXPMHCVLYC">'+
	'<input type="image" style="border:0px solid black;width:150px;" src="http://i617.photobucket.com/albums/tt260/goldisever/Apo/donate-button.png" name="submit" alt="PayPal - The safer, easier way to pay online!">'+
	'<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/scr/pixel.gif" width="1" height="1">'+
	'</form></center></p>'+
	'</div></div>';
	document.getElementById('content').appendChild(settingsDiv);
	
	if(GM_getValue('lb', true) == true){document.getElementById('GCAO_s1').checked=true;}
	if(GM_getValue('bu', true) == true){document.getElementById('GCAO_s2').checked=true;}
	if(GM_getValue('au', true) == true){document.getElementById('GCAO_s3').checked=true;}
	if(GM_getValue('af', true) == true){document.getElementById('GCAO_s4').checked=true;}
	if(GM_getValue('cb', true) == true){document.getElementById('GCAO_s5').checked=true;}
	if(GM_getValue('ml', true) == true){document.getElementById('GCAO_s6').checked=true;}
	if(GM_getValue('an', true) == true){document.getElementById('GCAO_s7').checked=true;}
	if(GM_getValue('il', true) == true){document.getElementById('GCAO_s8').checked=true;}
	if(GM_getValue('ms', true) == true){document.getElementById('GCAO_s9').checked=true;}
	if(GM_getValue('pi', true) == true){document.getElementById('GCAO_s10').checked=true;}
	if(GM_getValue('si', true) == true){document.getElementById('GCAO_s11').checked=true;}
	if(GM_getValue('ba', true) == true){document.getElementById('GCAO_s12').checked=true;}
	if(GM_getValue('hi', true) == true){document.getElementById('GCAO_s13').checked=true;}
	if(GM_getValue('fi', true) == true){document.getElementById('GCAO_s14').checked=true;}
	if(GM_getValue('sp', false) == true){document.getElementById('GCAO_s15').checked=true;}
	if(GM_getValue('op', true) == true){document.getElementById('GCAO_s16').checked=true;}
	if(GM_getValue('li', true) == true){document.getElementById('GCAO_s17').checked=true;}
	if(GM_getValue('sf', 1000) != 1000){document.getElementById('GCAO_sf').value = GM_getValue('sf', 1000);}
	if(GM_getValue('st', true) == true){document.getElementById('GCAO_s18').checked=true;}
	if(GM_getValue('sa', true) == true){document.getElementById('GCAO_s19').checked=true;}
	if(GM_getValue('gg', true) == true){document.getElementById('GCAO_s20').checked=true;}
	if(GM_getValue('id', false) == true){document.getElementById('GCAO_s21').checked=true;}
	if(GM_getValue('gs', true) == true){document.getElementById('GCAO_s22').checked=true;}
	if(GM_getValue('dh', true) == true){document.getElementById('GCAO_s23').checked=true;}
	if(GM_getValue('dc', true) == true){document.getElementById('GCAO_s24').checked=true;}
	if(GM_getValue('ca', true) == true){document.getElementById('GCAO_s25').checked=true;}
	if(GM_getValue('ce', true) == true){document.getElementById('GCAO_s26').checked=true;}
	if(GM_getValue('pr', true) == true){document.getElementById('GCAO_s27').checked=true;}
	if(GM_getValue('ea', false) == true){document.getElementById('GCAO_s28').checked=true;}
	if(GM_getValue('fm', false) == true){document.getElementById('GCAO_s29').checked=true;}
	if(GM_getValue('nq', false) == true){document.getElementById('GCAO_s30').checked=true;}
	if(GM_getValue('wd', true) == true){document.getElementById('GCAO_s31').checked=true;}
	if(GM_getValue('rb', false) == true){document.getElementById('GCAO_s32').checked=true;}
	if(GM_getValue('rr', false) == true){document.getElementById('GCAO_s33').checked=true;}
	if(GM_getValue('bb', false) == true){document.getElementById('GCAO_s34').checked=true;}
	if(GM_getValue('at', false) == true){document.getElementById('GCAO_s35').checked=true;}
	if(GM_getValue('ch', true) == true){document.getElementById('GCAO_s36').checked=true;}
	if(GM_getValue('rt', true) == true){document.getElementById('GCAO_s37').checked=true;}
	if(GM_getValue('mc', true) == true){document.getElementById('GCAO_s38').checked=true;}
	if(GM_getValue('hg', true) == true){document.getElementById('GCAO_s39').checked=true;}
	if(GM_getValue('sc', true) == true){document.getElementById('GCAO_s40').checked=true;}
	if(GM_getValue('gm', true) == true){document.getElementById('GCAO_s41').checked=true;}
	if(GM_getValue('lp', true) == true){document.getElementById('GCAO_s42').checked=true;}
	if(GM_getValue('kt', false) == true){document.getElementById('GCAO_s43').checked=true;}
	if(GM_getValue('pa', false) == true){document.getElementById('GCAO_s44').checked=true;}
	
	document.getElementById('cu_'+GM_getValue('cu', 0)).setAttribute('selected','selected');
}

function saveSettings(){
	var link = document.location.href;
	while(link.match(/\w\w=true/i)){
		var set = link.match(/(\w\w)=true/i)[1];
		GM_setValue(set, true);
		link = link.replace(/\w\w=true/i, '');
	}
	while(link.match(/\w\w=false/i)){
		var set = link.match(/(\w\w)=false/i)[1];
		GM_setValue(set, false);
		link = link.replace(/\w\w=false/i, '');
	}
	if(link.match(/sf=(\d+)/i)){
		var number = link.match(/sf=(\d+)/i)[1]*1;
		GM_setValue('sf', number);
		link = link.replace(/sf=(\d+)/i, '');
	}
	if(link.match(/cu=(\d+)/i)){
		var number = link.match(/cu=(\d+)/i)[1]*1;
		GM_setValue('cu', number);
		link = link.replace(/cu=(\d+)/i, '');
	}
}

function saveMePlease(){
	var checkNumberOfFights = document.getElementById('GCAO_sf').value+'';
	checkNumberOfFights = checkNumberOfFights.replace(/\d+/gi, "");
	if(checkNumberOfFights==''){
		if(document.getElementById('GCAO_sf').value==0){var numberOfFights = 1000;}
		else if(document.getElementById('GCAO_sf').value<=20000){var numberOfFights = document.getElementById('GCAO_sf').value;}
		else{var numberOfFights = 20000;}
	}
	else{var numberOfFights = 1000;}
	
	var s="&sf="+numberOfFights;
	s+="&cu="+document.getElementById('GCAO_cu').value;
	for(i=1;i<45;i++){
		var x=document.getElementById('GCAO_s'+i);
		s+="&"+x.name+"="+x.checked;
	}
	window.location=GCAO_siteurl+'mod=settings&sh='+GCAO_secureCode+'&GCAO=SaveMePlease'+s;
}
//################################################################################################################################
//## LAST TIME ATTACKED COUNTER
//################################################################################################################################
function lastTimeAttackedCounter(){
		document.getElementById('header_menue').setAttribute('style','z-index:3;');
		document.getElementById('menue_news').setAttribute('style','height:39px;');
		document.getElementById('menue_messages').setAttribute('style','height:39px;');
		document.getElementById('menue_packages').setAttribute('style','height:39px;');
		document.getElementById('menue_reports').setAttribute('style','height:39px;');
		var bgTimerImg=document.createElement('span');
		bgTimerImg.setAttribute('style', 'margin:0px;position:absolute;top:41px;left:149px;width:192px;height:108px;z-index:2;background:url(\'http://i617.photobucket.com/albums/tt260/goldisever/GCAO/timerback.png\');');
		document.getElementById('header_game').appendChild(bgTimerImg);
		if(GM_getValue('at', false) == true){mouEperikseTaArxidia('Arena',175);}
		if(GM_getValue('kt', false) == true){mouEperikseTaArxidia('CircusTurma',260);}
}

function mouEperikseTaArxidia(loc,pos){
	if(loc=='Arena'){var t_img='<img align=\'absmiddle\' src=\'http://i617.photobucket.com/albums/tt260/goldisever/GCAO/icon_arena.gif\' height=18px/>';}
	else{var t_img='<img align=\'absmiddle\' src=\'http://i617.photobucket.com/albums/tt260/goldisever/GCAO/icon_grouparena.gif\' height=18px/>';}
	var loadingImage="data:image/gif;base64,R0lGODlhKQAGAPEBAAAAAP///////////yH+EUNyZWF0ZWQgd2l0aCBHSU1QACH5BAkPAAIAIf8LTkVUU0NBUEUyLjADAQAAACwAAAAAKQAGAAACK4Qvh2rJriCLINgA0sX65up11vRtZQiOIpdi03qqbcya7wzn+Hw/PeVjFAAAIfkECQ8AAwAsAAAAACkABgAAAiyEP4dqya6gCjQA2UC1aV9dfR5IfQ/JoWLYhSq2lq38qvXpzWlun37EMAEZBQAh+QQJDwADACwAAAAAKQAGAAACK4Q/h2rJrqAKNIBUrWwg3159HkiJ4WaW2Elabaox8LyWbx0/9z7qfiRDoQoAIfkECQ8AAwAsAAAAACkABgAAAi2EP4dqya6gCjSAVC2ul/X8cQC4UaEpNSNXWiv6anH3zK1B2nqdg15Ki/yGjAIAIfkECQ8AAwAsAAAAACkABgAAAiyEP4dqya6gCjSAVC2uF+T+eJxIdd9Wohpjjie5vm/4wW1qq2Bks1LjC4YYBQAh+QQJDwADACwAAAAAKQAGAAACKoQ/h2rJrqAKNIBULa4X5P5JR+hxGwWaJSoa5KvCLOPG9ixrNN32/M8oAAAh+QQJDwADACwAAAAAKQAGAAACLIQ/h2rJrqAKNIBULa4X5P54nEh131aiGmOOJ7m+b/jBbWqrYGSzUuMLhhgFACH5BAkPAAMALAAAAAApAAYAAAIthD+HasmuoAo0gFQtrpf1/HEAuFGhKTUjV1or+mpx98ytQdp6nYNeSov8howCACH5BAkPAAMALAAAAAApAAYAAAIrhD+HasmuoAo0gFStbCDfXn0eSInhZpbYSVptqjHwvJZvHT/3Pup+JEOhCgAh+QQJDwADACwAAAAAKQAGAAACLIQ/h2rJrqAKNADZQLVpX119Hkh9D8mhYtiFKraWrfyq9enNaW6ffsQwARkFADs%3D";
	var beAttackedSpan=document.createElement('span');
	beAttackedSpan.setAttribute('id', 'beAttackedSpanMain'+loc);
	beAttackedSpan.setAttribute('style', 'margin:0px;position:absolute;top:83px;left:'+pos+'px;font-weight:bold;z-index:3;');
	beAttackedSpan.innerHTML=t_img+'<span style="color:red;margin-left:0px;margin-top:2px;" id="beAttackedSpan'+loc+'"><img style="margin-top:6px;opacity:0.5;" src="'+loadingImage+'"/></span>';
	document.getElementById('header_game').appendChild(beAttackedSpan);
	
	var url=GCAO_siteurl+"mod=reports&submod=show"+loc+"&sh="+GCAO_secureCode;
	var xmlhttp=false;
	if (!xmlhttp && typeof XMLHttpRequest!='undefined'){try {xmlhttp = new XMLHttpRequest();}catch (e) {xmlhttp = false;}}
	if (xmlhttp){
		xmlhttp.open("GET", url,true);
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4){
				if(!xmlhttp.responseText.match('bx0')){
					if(xmlhttp.responseText.match(/current[^>]+>([^<]+)<.a>/i)){
						var L_title=xmlhttp.responseText.match(/current[^>]+>([^<]+)<.a>/i)[1];
					}else{var L_title=loc;}
					document.getElementById('beAttackedSpanMain'+loc).setAttribute('title',L_title);
					if(xmlhttp.responseText.match(/shield.passive.gif/i)){
						/**Time of attack**/
						var time=xmlhttp.responseText.match(/<td style="min-width:90px">[^.]+\d+.\d+.\d+ (\d+:\d+:\d+)[^<]+<\/td>[^<]+<td>[^<]+<img src="[^s]+shield-passive.gif"/i)[1];
						/**Date of attack**/
						var sdate=xmlhttp.responseText.match(/<td style="min-width:90px">[^.]+\d+.\d+.\d+ \d+:\d+:\d+[^<]+<\/td>[^<]+<td>[^<]+<img src="[^s]+shield-passive.gif"/i)[0].match(/(\d+)\./i)[1]
						/**Time of attack in Seconds**/
						var time=time.match(/\d+/g)[0]*60*60+time.match(/\d+/g)[1]*60+time.match(/\d+/g)[2]*1;
						
						var mytime=new Date();
						/**Current Day**/
						var mydate=mytime.getDate();
						/**Current Time in Second**/
						var myPCtime=mytime.getHours()*60*60+mytime.getMinutes()*60+mytime.getSeconds();
						
						/**Server Day**/
						var serverDate=document.getElementById('header_game').getElementsByTagName('span')[6].innerHTML.match(/(\d+).\d+/i)[1];
						if(serverDate.match(/0\d/i)){serverDate.replace('0','')}
						/**Server Time in Second**/
						var serverTime=document.getElementById('header_game').getElementsByTagName('span')[6].innerHTML.match(/(\d+):(\d+)/i);
						serverTime=serverTime[1]*60*60+serverTime[2]*60;
						
						/**Server Time Difference**/
						if(mydate==serverDate){var dif=myPCtime-serverTime;}
						else if(mydate<serverDate){
							if(mydate==1 && serverDate!=2){var dif=myPCtime-serverTime+24*60*60;}
							else{var dif=myPCtime-serverTime-24*60*60;}
						}
						else if(mydate>serverDate){
							if(mydate!=2 && serverDate==1){var dif=myPCtime-serverTime-24*60*60;}
							else{var dif=myPCtime-serverTime+24*60*60;}
						}
						
						var check=true;
						/**Time from Attack in Seconds**/
						if(mydate==sdate){
							var x=myPCtime-dif-time;
						}else if(mydate<sdate){
							if(dif<0){var x=myPCtime-dif-time;}
							else{var x='NaN';check=false;}
						}else{
							if(dif>0){var x=myPCtime-dif-time+(mydate-sdate)*24*60*60;}
							else{var x='NaN';check=false;}
						}
						
						if(check){
							var y=''+(x-(x%3600))/3600+':'+((x%3600)-(x%60))/60+':'+x%60+'';
							document.getElementById('beAttackedSpan'+loc).innerHTML=y;
							document.getElementById('header_game').appendChild(beAttackedSpan);
							var beAttackScript=document.createElement('script');
							beAttackScript.innerHTML='var clockReseterAttacked'+loc+'='+x+';beAttackClock'+loc+'();function beAttackClock'+loc+'(){if((clockReseterAttacked'+loc+'-(clockReseterAttacked'+loc+'%3600))/3600<1){document.getElementById("beAttackedSpan'+loc+'").style.color="green";}else{document.getElementById("beAttackedSpan'+loc+'").style.color="red";}if((clockReseterAttacked'+loc+'-(clockReseterAttacked'+loc+'%3600))/3600<10){var h="0";}else{var h="";}if(((clockReseterAttacked'+loc+'%3600)-(clockReseterAttacked'+loc+'%60))/60<10){var m="0";}else{var m="";}if(clockReseterAttacked'+loc+'%60<10){var s="0";}else{var s="";}document.getElementById("beAttackedSpan'+loc+'").innerHTML=""+h+(clockReseterAttacked'+loc+'-(clockReseterAttacked'+loc+'%3600))/3600+":"+m+((clockReseterAttacked'+loc+'%3600)-(clockReseterAttacked'+loc+'%60))/60+":"+s+clockReseterAttacked'+loc+'%60;clockReseterAttacked'+loc+'=clockReseterAttacked'+loc+'+1;setTimeout("beAttackClock'+loc+'()",1000);}';
							document.body.appendChild(beAttackScript);
						}else{
							document.getElementById('beAttackedSpan'+loc).innerHTML=' NaN';
						}
					}
					else{
						document.getElementById('beAttackedSpan'+loc).innerHTML=' NaN';
					}
				}
			}
		}
		xmlhttp.send(null);
	}
}

//################################################################################################################################
//## USEFULL FUNCTIONS / ???S??? FUNCTION
//################################################################################################################################
//MAKE COOKIE / F????? COOKIE
function Set_Cookie( name, value, expires, path, domain, secure ){
	var today = new Date();
	today.setTime( today.getTime() );
	if ( expires ){expires = expires * 1000 * 60 * 60 * 24;}
	var expires_date = new Date( today.getTime() + (expires) );
	document.cookie = name+"="+escape( value )+( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" )+( ( path ) ? ";path=" + path : "" )+( ( domain ) ? ";domain=" + domain : "" )+( ( secure ) ? ";secure" : "" );
}

//GET COOKIE / ???? COOKIE
function Get_Cookie(check_name){
	var a_all_cookies = document.cookie.split( ';' );
	var a_temp_cookie = '';
	var cookie_name = '';
	var cookie_value = '';
	var b_cookie_found = false;

	for ( i = 0; i < a_all_cookies.length; i++ )
	{
		a_temp_cookie = a_all_cookies[i].split( '=' );
		cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');
		if ( cookie_name == check_name )
		{
			b_cookie_found = true;
			if ( a_temp_cookie.length > 1 ){cookie_value = unescape( a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );}
			return cookie_value;
			break;
		}
		a_temp_cookie = null;
		cookie_name = '';
	}
	if ( !b_cookie_found ){return null;}
}

//PLAYER'S LEVEL / ??????? ??? ??????
//Command / ??t???: var myLevel = getMyLevel();
function getMyLevel(){
	var myLevel = document.getElementById('header_values_general').getElementsByTagName('div')[8].innerHTML*1;
	return myLevel;
}

//INSERT AFTER / ???? ???? ???
//Command / ??t???: insertAfter('newElement','targetElement');
function insertAfter(newElement,targetElement) {
	var parent = targetElement.parentNode;
	if(parent.lastchild == targetElement) {
		parent.appendChild(newElement);
	}
	else {
		parent.insertBefore(newElement, targetElement.nextSibling);
	}
}

//Add A DOT "." FOR THOUSAND, MILLION, BILLION, etc...
function dottedNumber(nbr){
	x=false;
	if(nbr<0){var x=true;nbr=0-nbr;}
	var number = ''+nbr;
	var returned = '';
	while(number.length>3){
	returned= "."+number.substring(number.length-3,number.length)+returned;
	number = number.substring(0,number.length-3);
	}
	if(number.length>0)
	returned = number+returned;
	if(x){var returned='-'+returned}
	return returned;
}

//Round a number (ex.: 1,3899 -> 1,38)
function roundNumber(x){
	x = x*(100);
	x = (x-x%1)/(100);
	return x;
}


//################################################################################################################################
// Training Camp !
//################################################################################################################################

function training(){
	var mainnav = document.getElementById('mainnav');
	var newTab = document.createElement('li');
	newTab.className='pngfix';
	newTab.innerHTML = '<a style="cursor:pointer;" class="pngfix">'+L_Simulator+'</a>';
	// On ajoute un evenement on click. 
	mainnav.appendChild(newTab);
	newTab.addEventListener('click', function(){seeSimulator();}, true); 
	//alert('test');
}

function seeSimulator(){
	if(GCAO_lang=='fr'){
		var text='When you enter in the room, you see djor, one of the ancient French programmers, working over a new type of virtual fighting and training.<br>Near to him, there is a big super computer ready to create a hologram of any monster or any other player you want, in order to simulate a fight with you and display the results... <br><br>Are you ready to fight?';
		var Skill='Adresse';
		var Agility='Agilité';
		var Charisma='Charisme';
		var Armour='Armure';
		var Damage='Dégâts';
		var ChanceForCriticalDamage='Chance d`infliger un coup critique';
		var ChanceToBlockAHit='Chance de parer une attaque';
		var ChanceForCriticalDamage='Chance d`éviter un coup critique';
		
		var Italy='Italie';
		var Italy_1='Forêt noire';var Italy_1_1='Rat';var Italy_1_2='Lynx';var Italy_1_3='Loup';var Italy_1_4='Ours';
		var Italy_2='Port de pirates';var Italy_2_1='Esclave en fuite';var Italy_2_2='Soldat corrompu';var Italy_2_3='Assassin';var Italy_2_4='Capitaine ';
		var Italy_3='Monts Brumeux';var Italy_3_1='Recrue errante';var Italy_3_2='Harpie';var Italy_3_3='Cerbère';var Italy_3_4='Méduse';
		var Italy_4='L’antre des loups';var Italy_4_1='Sanglier';var Italy_4_2='Meute de loups';var Italy_4_3='Le loup Alpha';var Italy_4_4='Loup-garou';
		var Italy_5='Ancien temple';var Italy_5_1='Garde sectaire';var Italy_5_2='Rat-garou';var Italy_5_3='Minautore';var Italy_5_4='Seigneur minautore';
		var Italy_6='Village barbare';var Italy_6_1='Barbare';var Italy_6_2='Guerrier barbare';var Italy_6_3='Berserk';var Italy_6_4='Cador barbare';
		var Italy_7='Camp de bandits';var Italy_7_1='Soldat renégat';var Italy_7_2='Mercenaire renégat';var Italy_7_3='Assassin perfide';var Italy_7_4='Chef de bandits';

		var Germany='Germanie';
		var Germany_1='Temple souterrain';var Germany_1_1='Légionnaire';var Germany_1_2='Myrmidon';var Germany_1_3='Centurion';var Germany_1_4='Sansâme';
		var Germany_2='La forêt verte';var Germany_2_1='Sanglier géant';var Germany_2_2='Créature des marais';var Germany_2_3='Esprit des marais';var Germany_2_4='Ours-garou';
		var Germany_3='Village Maudit';var Germany_3_1='Hun';var Germany_3_2='Ancien';var Germany_3_3='Affamé';var Germany_3_4='L&#8217; Abomination';
		var Germany_4='Colline des morts';var Germany_4_1='Guerrier squelette';var Germany_4_2='Berserk squelette';var Germany_4_3='Liche';var Germany_4_4='Prince nécromant ';
		var Germany_5='Village vandale';var Germany_5_1='Guerrier vandale';var Germany_5_2='Jarl';var Germany_5_3='Batailleur ténébreux';var Germany_5_4='Chevalier de la mort';
		var Germany_6='Mine';var Germany_6_1='Garde';var Germany_6_2='Draugr';var Germany_6_3='Golem de pierre';var Germany_6_4='Guivre vorace';
		var Germany_7='Camp teutons';var Germany_7_1='Barbare';var Germany_7_2='Héros teuton';var Germany_7_3='Teuton';var Germany_7_4='Seidr';
		var Germany_8='Montagne Koman';var Germany_8_1='Infernal springbok';var Germany_8_2='Dent de Sabre';var Germany_8_3='Dragonnet';var Germany_8_4='Dragon';

		var Africa='Afrique';
		var Africa_1='Temple Vaudou';var Africa_1_1='Cobra';var Africa_1_2='Scorpion géant';var Africa_1_3='Momie réveillée';var Africa_1_4='Prêtre Seth';
		var Africa_2='Pont';var Africa_2_1='Percepteur';var Africa_2_2='Anthropophage';var Africa_2_3='Guerrier tribal ';var Africa_2_4='Chaman ostéomancien';
		var Africa_3='Caverne sanglante';var Africa_3_1='Loup sanguinaire';var Africa_3_2='Scarabée géant';var Africa_3_3='Danseur de feu';var Africa_3_4='Démon de feu';
		var Africa_4='Port perdu';var Africa_4_1='Crocodile';var Africa_4_2='Porteur mort-vivant';var Africa_4_3='Serpent aquatique géant';var Africa_4_4='Mokélé-Mbembé';
		var Africa_5='Tribu Umpokta';var Africa_5_1='Guerrier tribal';var Africa_5_2='Sorcier tribal';var Africa_5_3='Guerrier des esprits';var Africa_5_4='Grand prêtre Seth';
		var Africa_6='Caravane';var Africa_6_1='L&#8217; Espion';var Africa_6_2='Garde de caravane';var Africa_6_3='Garde d&#8217; élite ';var Africa_6_4='Marchand d&#8217; esclave';
		var Africa_7='Oasis Mesoai';var Africa_7_1='Éléphant';var Africa_7_2='Guépard';var Africa_7_3='Lion démoniaque';var Africa_7_4='Éléphant démoniaque ';
		var Africa_8='Falaise des sacrifices';var Africa_8_1='Antilope maudite';var Africa_8_2='Araignée géante';var Africa_8_3='Chaman';var Africa_8_4='Grand Chaman';
	}
	else if(GCAO_lang=='gr'){
		var text='????? µpe?? st? d?µ?t??, ß??pe?? t?? djor, ??a? ap? t??? a??a???? G?????? p????aµµat?st??, p?? d???e?e? p??? se ??a ??? e?d?? e???????? µa??? ?a? e?pa?de?se??.<br>???t? t?? ß??s?eta? ??a? super ?p?????st?? ?t??µ?? ?a d?µ??????se? ??????µµa ?p????de?p?te t??at?? ? µ???µ????  es? ???, ets? ?ste ?a p??s?µ???se? µ?a µ??? µe es??a ?a? ?a p??ß??e? ta ap?te??sµata... <br><br>??sa? ?t??µ?? ??a µ???;';
		var Skill='??a??t?ta';
		var Agility='?p?de???t?ta';
		var Charisma='????sµa';
		var Armour='?a??p??a';
		var Damage='??µ??';
		var ChanceForCriticalDamage='???a??t?ta ???s?µ?? ??µ???';
		var ChanceToBlockAHit='???a??t?ta ?a µp?????e?? t? ?t?p?µa';
		var ChanceForCriticalDamage='???a??t?ta ap?f???? ???s?µ?? ?t?p?µ?t??';
		
		var Italy='?ta??a';
		var Italy_1='S??te??? ??s??';var Italy_1_1='?????a???';var Italy_1_2='????a?';var Italy_1_3='?????';var Italy_1_4='?????da';
		var Italy_2='?e??at??? ??µ???';var Italy_2_1='F???? s???ß??';var Italy_2_2='??ef?a?µ???? st...';var Italy_2_3='????f????';var Italy_2_4='???????';
		var Italy_3='?µ????d? ß????';var Italy_3_1='??p?t??t??';var Italy_3_2='??p??a';var Italy_3_3='???ße???';var Italy_3_4='??d??sa';
		var Italy_4='????f????';var Italy_4_1='???????????';var Italy_4_2='????? ?????';var Italy_4_3='??fa ?????';var Italy_4_4='????????p??';
		var Italy_5='???a??? ?a??';var Italy_5_1='F?????? ??t??';var Italy_5_2='??????????p??';var Italy_5_3='????ta????';var Italy_5_4='????µ???ta????';
		var Italy_6='?a?ßa???? ?????';var Italy_6_1='???ßa???';var Italy_6_2='???eµ?st?? ?a?ß...';var Italy_6_3='?a???µe???';var Italy_6_4='??????? ?a?ß???...';
		var Italy_7='??????a ??st??';var Italy_7_1='?p?st?t??';var Italy_7_2='?p?st?t?? µ?s??...';var Italy_7_3='F?????';var Italy_7_4='??????st??';
		var Germany='Ge?µa??a';
		var Germany_1='?a?? t?? Sp?????';var Germany_1_1='?e?e???????';var Germany_1_2='???µ?d??a?';var Germany_1_3='??at??ta????';var Germany_1_4='??????';
		var Germany_2='?? p??s??? d?s??';var Germany_2_1='G????t??? a????...';var Germany_2_2='???a? t?? ß??t?...';var Germany_2_3='??e?µa t?? ß??t...';var Germany_2_4='?????d?????p??';
		var Germany_3='?ata?aµ??? ?????';var Germany_3_1='??????';var Germany_3_2='?p???????';var Germany_3_3='?p??a?t??';var Germany_3_4='St??e??t?ta';
		var Germany_4='??f?? t?? Ta??t??';var Germany_4_1='S?e?et?? - p??e...';var Germany_4_2='?a???µe??? s?e?...';var Germany_4_3='??????a?a? ';var Germany_4_4='??eµ??a? ?e???µ...';
		var Germany_5='????? ßa?d????';var Germany_5_1='???eµ?st?? ?a?d...';var Germany_5_2='??µ??';var Germany_5_3='S??te???? ?p??µ...';var Germany_5_4='?pp?t?? Ta??t??';
		var Germany_6='????e??';var Germany_6_1='F??a?a?';var Germany_6_2='Draug';var Germany_6_3='??t???? ????eµ';var Germany_6_4='????s???????';
		var Germany_7='St?at?ped? ?e?t????';var Germany_7_1='??????';var Germany_7_2='?e?t??a? ???a?';var Germany_7_3='??????? ?e?t???...';var Germany_7_4='Seidr';
		var Germany_8='????? Koman';var Germany_8_1='??t???p? ????se...';var Germany_8_2='????? µe µ?te??...';var Germany_8_3='???? ??????';var Germany_8_4='??????';
		var Africa='?f????';
		var Africa_1='?a?? ????t??';var Africa_1_1='??µp?a';var Africa_1_2='G????t??? S???p...';var Africa_1_3='??ast?µ??? µ??µ...';var Africa_1_4='?e??a? Seth';
		var Africa_2='G?f??a';var Africa_2_1='S?????t?? f????';var Africa_2_2='?????p?f????';var Africa_2_3='???eµ?st?? f???...';var Africa_2_4='Saµ???? ???????';
		var Africa_3='Sp???? a?µat??';var Africa_3_1='??µ??????';var Africa_3_2='G????t?? S?a???...';var Africa_3_3='???e?t?? f?t???';var Africa_3_4='?a?µ??a? f?t???';
		var Africa_4='?aµ??? ??µ???';var Africa_4_1='?????de????';var Africa_4_2='?p??a?t?? ??µ?s...';var Africa_4_3='G????t?a ?d?a';var Africa_4_4='Sa???p?d?';
		var Africa_5='F??? Umpokta';var Africa_5_1='???eµ?st?? f???... ';var Africa_5_2='????? f????';var Africa_5_3='???eµ?st?? p?e?...';var Africa_5_4='????e??a? Seth';
		var Africa_6='?a?aß???';var Africa_6_1='?at?s??p??';var Africa_6_2='F??a?a? ?a?aßa?...';var Africa_6_3='?p??e?t?? f??a?... ';var Africa_6_4='?????µp????';
		var Africa_7='?as? Mesoai';var Africa_7_1='???fa?ta?';var Africa_7_2='?s?t??';var Africa_7_3='?a?µ????? ????t???';var Africa_7_4='?a?µ?????? e??f...';
		var Africa_8='??t?? ??f??';var Africa_8_1='?ata?aµ??? a?t?...';var Africa_8_2='G????t?a a?????';var Africa_8_3='Saµ????';var Africa_8_4='????saµ????';
	}
	else{
		var text='When you enter in the room, you see djor, one of the ancient French programmers, working over a new type of virtual fighting and training.<br>Near to him, there is a big super computer ready to create a hologram of any monster or any other player you want, in order to simulate a fight with you and display the results... <br><br>Are you ready to fight?';
		var Skill='Skill';
		var Agility='Agility';
		var Charisma='Charisma';
		var Armour='Armour';
		var Damage='Damage';
		var ChanceForCriticalDamage='Chance for critical damage';
		var ChanceToBlockAHit='Chance to block a hit';
		var ChanceForCriticalDamage='Chance of avoiding critical hits';
		
		var Italy='Italy';
		var Italy_1='Grimwood';var Italy_1_1='Rat';var Italy_1_2='Lynx';var Italy_1_3='Wolf';var Italy_1_4='Bear';
		var Italy_2='Pirate Harbour';var Italy_2_1='Fled Slave';var Italy_2_2='Corrupt Soldier';var Italy_2_3='Assassin ';var Italy_2_4='Captain ';
		var Italy_3='Misty Mountains';var Italy_3_1='Elusive Recruit';var Italy_3_2='Harpy';var Italy_3_3='Cerberus';var Italy_3_4='Medusa';
		var Italy_4='Wolf Cave';var Italy_4_1='Wild Boar';var Italy_4_2='Wolf Pack';var Italy_4_3='Alphawolf';var Italy_4_4='Werewolf';
		var Italy_5='Ancient Temple';var Italy_5_1='Cultist Guard';var Italy_5_2='Wererat';var Italy_5_3='Minotaur';var Italy_5_4='Minotaur Chief';
		var Italy_6='Barbarian Village';var Italy_6_1='Barbarian';var Italy_6_2='Barbarian Warrior';var Italy_6_3='Berserker';var Italy_6_4='Barbarian Chief';
		var Italy_7='Bandit Camp';var Italy_7_1='Renegade Soldier';var Italy_7_2='Renegade Mercenary';var Italy_7_3='Assassinator';var Italy_7_4='Bandit Chief';
		var Germany='Germany';
		var Germany_1='Cave Temple';var Germany_1_1='Legionnaire';var Germany_1_2='Myrmidon';var Germany_1_3='Centurion';var Germany_1_4='Soulless';
		var Germany_2='The Green Forest';var Germany_2_1='Giant Wild Boar';var Germany_2_2='Swamp Lord';var Germany_2_3='Swamp Spirit';var Germany_2_4='Werebear';
		var Germany_3='Cursed Village';var Germany_3_1='Hun';var Germany_3_2='Ancient';var Germany_3_3='Nachzehrer';var Germany_3_4='Abomination';
		var Germany_4='Death Hill';var Germany_4_1='Skeleton Warrior';var Germany_4_2='Skeleton Berserker';var Germany_4_3='Lich';var Germany_4_4='Necromancer Prince';
		var Germany_5='Vandal Village';var Germany_5_1='Vandal Warrior';var Germany_5_2='Jarl';var Germany_5_3='Dark Fighter';var Germany_5_4='Death Knight';
		var Germany_6='Mine';var Germany_6_1='Guard';var Germany_6_2='Draug';var Germany_6_3='Stone Golem';var Germany_6_4='Tatzelwurm';
		var Germany_7='Teuton Camp';var Germany_7_1='Barbarian';var Germany_7_2='Teuton Hero';var Germany_7_3='Teuton Lord';var Germany_7_4='Seidr';
		var Germany_8='Koman Mountain';var Germany_8_1='Infernal Springbok';var Germany_8_2='Sabre-Tooth Tiger';var Germany_8_3='Dragon Whelp';var Germany_8_4='Dragon';
		var Africa='Africa';
		var Africa_1='Voodoo Temple';var Africa_1_1='Cobra';var Africa_1_2='Giant Scorpion';var Africa_1_3='Awakened Mummy';var Africa_1_4='Seth Priest';
		var Africa_2='Bridge';var Africa_2_1='Tax Collector';var Africa_2_2='Man Eater';var Africa_2_3='Tribal Warrior';var Africa_2_4='Bone Shaman';
		var Africa_3='Blood Cave';var Africa_3_1='Blood Wolf';var Africa_3_2='Giant Beetle';var Africa_3_3='Fire Dancer';var Africa_3_4='Fire Demon';
		var Africa_4='Lost Harbour';var Africa_4_1='Crocodile';var Africa_4_2='Undead Holder';var Africa_4_3='Giant Water Snake';var Africa_4_4='Mokele Mbembe';
		var Africa_5='Umpokta Tribe';var Africa_5_1='Tribal Warrior';var Africa_5_2='Tribal Magician';var Africa_5_3='Spirit Warrior';var Africa_5_4='Seth High Priest';
		var Africa_6='Caravan';var Africa_6_1='Spy';var Africa_6_2='Caravan Guard';var Africa_6_3='Elite Guard';var Africa_6_4='Slave Merchant';
		var Africa_7='Mesoai-Oasis';var Africa_7_1='Elephant';var Africa_7_2='Cheetah';var Africa_7_3='Demon Lion';var Africa_7_4='Demon Elephant';
		var Africa_8='Cliff Jumper';var Africa_8_1='Cursed Antelope';var Africa_8_2='Giant Spider';var Africa_8_3='Shaman';var Africa_8_4='High Shaman';
	}
	
	//document.getElementById('content').style.display='none';
	document.getElementById('mainnav').childNodes[0].firstChild.className='pngfix ';
	document.getElementById('mainnav').childNodes[1].firstChild.className='pngfix  current';
	
	document.getElementById('content').innerHTML = '<p class="buildingDesc"><img align="left" src="http://i617.photobucket.com/albums/tt260/goldisever/Apo/gladiator_vs_lion_by_miguelcoimbra-d3470mr.jpg">'+text+'<br><br><br><br></p>'+
	'<div style="margin-top: 0px;" class="contentItem"><h3>'+L_trainingSim+'</h3><div class="contentItem_content">'+
	'<table align="center" style="border:1px solid #af8e50;background-color:#ded8c6;padding:5px;"><tr><th></th><th>'+L_playerA+'</th><th>'+L_playerB+'</th></tr><tr><th>'+Skill+'</th><th><input type="text" id="skillA"></th><th><input type="text" id="skillB"></th></tr><tr><th>'+Agility+'</th><th><input type="text" id="agilityA"></th><th><input type="text" id="agilityB"></th></tr><tr><th>'+Charisma+'</th><th><input type="text" id="charismaA"></th><th><input type="text" id="charismaB"></th></tr><tr><th>'+Armour+'</th><th><input type="text" id="armorA"></th><th><input type="text" id="armorB"></th></tr><tr><th>'+Damage+' Min</th><th><input type="text" id="damageMinA"></th><th><input type="text" id="damageMinB"></th></tr><tr><th>'+Damage+' Max</th><th><input type="text" id="damageMaxA"></th><th><input type="text" id="damageMaxB"></th></tr><tr><th>Resistance</th><th><input type="text" id="resistanceA"></th><th><input type="text" id="resistanceB"></th></tr><tr><th>Block</th><th><input type="text" id="blockA"></th><th><input type="text" id="blockB"></th></tr><tr><th>Critic</th><th><input type="text" id="criticA"></th><th><input type="text" id="criticB"></th></tr><tr><th><input id="clearButton" class="button3" type="button" value="'+L_ClearAll+'"></th><th><input id="myStatButton" class="button2" type="button" value="'+L_staticsTitle+'"></th><th id="minion"></th></tr><tr><th></th><th id="player_sim_results"></th><th>'+
	''+
	'<span id="searchById" style="display:none;"><input type="text" id="player" value="Player&#39;s id" maxlength="9" size="8" style="margin-right:10px;color:grey;" onclick="if(this.value==\'Player\\\'s id\'){this.removeAttribute(\'value\');this.style.color=\'#513F2C\'}"><input class="button3" type="button" id="findStatById" value="find"></span>'+
	'<span id="searchByName" style="display:none;"><input type="text" id="playerName" value="Player" maxlength="20" size="8" style="margin-right:10px;color:grey;" onclick="if(this.value==\'Player\'){this.removeAttribute(\'value\');this.style.color=\'#513F2C\'}"><input class="button3" type="button" id="findStatByName" value="find"></span>'+
	'<span id="searchByItaly" style="display:none;"><select id="selectEnemyItaly" style="width:164px;"><option>'+L_selectEnemy+'</option></select></span>'+
	'<span id="searchByAfrica" style="display:none;"><select id="selectEnemyAfrica" style="width:164px;"><option>'+L_selectEnemy+'</option></select></span>'+
	'<span id="searchByGermany" style="display:none;"><select id="selectEnemyGermany" style="width:164px;"><option>'+L_selectEnemy+'</option></select></span>'+
	'</th></tr></table>'+
	''+
	'<br/><br/><div align="center"><input class="button2" type="button" value="'+L_go+'" id="simul"></div>'+
	'</div></div>'+
	'<br/><br/><div style="margin-top: 0px;display:none;" class="contentItem" id="resultBox"><h3>'+L_Results+'</h3><div class="contentItem_content">'+
	'<div align="center" ><b>'+L_winnigChance+' :</b> <span id="result"></span></div>'+
	'<br/><div align="center" ><b>'+L_PlayerAAvDamage+' :</b> <span id="myAvDam"></span></div>'+
	'<div align="center" ><b>'+L_PlayerBAvDamage+' :</b> <span id="hisAvDam"></span></div></div>';
	
	document.getElementById('simul').addEventListener('click', function(){launchSimulator();}, true); 
	document.getElementById('myStatButton').addEventListener('click', function(){putMyStats();}, true);
	document.getElementById('clearButton').addEventListener('click', function(){clearAllStats();}, true);
	document.getElementById('findStatById').addEventListener('click', function(){findPlayerStats();}, true);
	document.getElementById('findStatByName').addEventListener('click', function(){getPlayersIdFromPlayersName();}, true);
	document.getElementById('minion').innerHTML = '<select id="selectEnemyMethod" style="width:164px;"><option id="emptyOption">'+L_selectMethod+'</option></select>';
	document.getElementById('selectEnemyMethod').setAttribute('onchange',"var value=document.getElementById('selectEnemyMethod').value;document.getElementById('searchById').style.display='none';document.getElementById('searchByName').style.display='none';document.getElementById('searchByItaly').style.display='none';document.getElementById('searchByAfrica').style.display='none';document.getElementById('searchByGermany').style.display='none';if(value!='select' && document.getElementById('search'+value)){document.getElementById('search'+value).style.display='block'}");
	
	addMonstersElements(Italy,'ByItaly','Method');
	addMonstersElements(Africa,'ByAfrica','Method');
	addMonstersElements(Germany,'ByGermany','Method');
	addMonstersElements(L_byName,'ByName','Method');
	addMonstersElements(L_byID,'ById','Method');
	
	addMonstersElements('-='+Italy_1,'loc','Italy');
	addMonstersElements(Italy_1_1,'ita_1_1','Italy');
	addMonstersElements(Italy_1_2,'ita_1_2','Italy');
	addMonstersElements(Italy_1_3,'ita_1_3','Italy');
	addMonstersElements('[BOSS]'+Italy_1_4,'ita_1_4','Italy');
	addMonstersElements('-='+Italy_2,'loc','Italy');
	addMonstersElements(Italy_2_1,'ita_2_1','Italy');
	addMonstersElements(Italy_2_2,'ita_2_2','Italy');
	addMonstersElements(Italy_2_3,'ita_2_3','Italy');
	addMonstersElements('[BOSS]'+Italy_2_4,'ita_2_4','Italy');
	addMonstersElements('-='+Italy_3,'loc','Italy');
	addMonstersElements(Italy_3_1,'ita_3_1','Italy');
	addMonstersElements(Italy_3_2,'ita_3_2','Italy');
	addMonstersElements(Italy_3_3,'ita_3_3','Italy');
	addMonstersElements('[BOSS]'+Italy_3_4,'ita_3_4','Italy');
	addMonstersElements('-='+Italy_4,'loc','Italy');
	addMonstersElements(Italy_4_1,'ita_4_1','Italy');
	addMonstersElements(Italy_4_2,'ita_4_2','Italy');
	addMonstersElements(Italy_4_3,'ita_4_3','Italy');
	addMonstersElements('[BOSS]'+Italy_4_4,'ita_4_4','Italy');
	addMonstersElements('-='+Italy_5,'loc','Italy');
	addMonstersElements(Italy_5_1,'ita_5_1','Italy');
	addMonstersElements(Italy_5_2,'ita_5_2','Italy');
	addMonstersElements(Italy_5_3,'ita_5_3','Italy');
	addMonstersElements('[BOSS]'+Italy_5_4,'ita_5_4','Italy');
	addMonstersElements('-='+Italy_6,'loc','Italy');
	addMonstersElements(Italy_6_1,'ita_6_1','Italy');
	addMonstersElements(Italy_6_2,'ita_6_2','Italy');
	addMonstersElements(Italy_6_3,'ita_6_3','Italy');
	addMonstersElements('[BOSS]'+Italy_6_4,'ita_6_4','Italy');
	addMonstersElements('-='+Italy_7,'loc','Italy');
	addMonstersElements(Italy_7_1,'ita_7_1','Italy');
	addMonstersElements(Italy_7_2,'ita_7_2','Italy');
	addMonstersElements(Italy_7_3,'ita_7_3','Italy');
	addMonstersElements('[BOSS]'+Italy_7_4,'ita_7_4','Italy');
	addMonstersElements('-='+Africa_1,'loc','Africa');
	addMonstersElements(Africa_1_1,'afr_1_1','Africa');
	addMonstersElements(Africa_1_2,'afr_1_2','Africa');
	addMonstersElements(Africa_1_3,'afr_1_3','Africa');
	addMonstersElements('[BOSS]'+Africa_1_4,'afr_1_4','Africa');
	addMonstersElements('-='+Africa_2,'loc','Africa');
	addMonstersElements(Africa_2_1,'afr_2_1','Africa');
	addMonstersElements(Africa_2_2,'afr_2_2','Africa');
	addMonstersElements(Africa_2_3,'afr_2_3','Africa');
	addMonstersElements('[BOSS]'+Africa_2_4,'afr_2_4','Africa');
	addMonstersElements('-='+Africa_3,'loc','Africa');
	addMonstersElements(Africa_3_1,'afr_3_1','Africa');
	addMonstersElements(Africa_3_2,'afr_3_2','Africa');
	addMonstersElements(Africa_3_3,'afr_3_3','Africa');
	addMonstersElements('[BOSS]'+Africa_3_4,'afr_3_4','Africa');
	addMonstersElements('-='+Africa_4,'loc','Africa');
	addMonstersElements(Africa_4_1,'afr_4_1','Africa');
	addMonstersElements(Africa_4_2,'afr_4_2','Africa');
	addMonstersElements(Africa_4_3,'afr_4_3','Africa');
	addMonstersElements('[BOSS]'+Africa_4_4,'afr_4_4','Africa');
	addMonstersElements('-='+Africa_5,'loc','Africa');
	addMonstersElements(Africa_5_1,'afr_5_1','Africa');
	addMonstersElements(Africa_5_2,'afr_5_2','Africa');
	addMonstersElements(Africa_5_3,'afr_5_3','Africa');
	addMonstersElements('[BOSS]'+Africa_5_4,'afr_5_4','Africa');
	addMonstersElements('-='+Africa_6,'loc','Africa');
	addMonstersElements(Africa_6_1,'afr_6_1','Africa');
	addMonstersElements(Africa_6_2,'afr_6_2','Africa');
	addMonstersElements(Africa_6_3,'afr_6_3','Africa');
	addMonstersElements('[BOSS]'+Africa_6_4,'afr_6_4','Africa');
	addMonstersElements('-='+Africa_7,'loc','Africa');
	addMonstersElements(Africa_7_1,'afr_7_1','Africa');
	addMonstersElements(Africa_7_2,'afr_7_2','Africa');
	addMonstersElements(Africa_7_3,'afr_7_3','Africa');
	addMonstersElements('[BOSS]'+Africa_7_4,'afr_7_4','Africa');
	addMonstersElements('-='+Africa_8,'loc','Africa');
	addMonstersElements(Africa_8_1,'afr_8_1','Africa');
	addMonstersElements(Africa_8_2,'afr_8_2','Africa');
	addMonstersElements(Africa_8_3,'afr_8_3','Africa');
	addMonstersElements('[BOSS]'+Africa_8_4,'afr_8_4','Africa');
	addMonstersElements('-='+Germany_1,'loc','Germany');
	addMonstersElements(Germany_1_1,'ger_1_1','Germany');
	addMonstersElements(Germany_1_2,'ger_1_2','Germany');
	addMonstersElements(Germany_1_3,'ger_1_3','Germany');
	addMonstersElements('[BOSS]'+Germany_1_4,'ger_1_4','Germany');
	addMonstersElements('-='+Germany_2,'loc','Germany');
	addMonstersElements(Germany_2_1,'ger_2_1','Germany');
	addMonstersElements(Germany_2_2,'ger_2_2','Germany');
	addMonstersElements(Germany_2_3,'ger_2_3','Germany');
	addMonstersElements('[BOSS]'+Germany_2_4,'ger_2_4','Germany');
	addMonstersElements('-='+Germany_3,'loc','Germany');
	addMonstersElements(Germany_3_1,'ger_3_1','Germany');
	addMonstersElements(Germany_3_2,'ger_3_2','Germany');
	addMonstersElements(Germany_3_3,'ger_3_3','Germany');
	addMonstersElements('[BOSS]'+Germany_3_4,'ger_3_4','Germany');
	addMonstersElements('-='+Germany_4,'loc','Germany');
	addMonstersElements(Germany_4_1,'ger_4_1','Germany');
	addMonstersElements(Germany_4_2,'ger_4_2','Germany');
	addMonstersElements(Germany_4_3,'ger_4_3','Germany');
	addMonstersElements('[BOSS]'+Germany_4_4,'ger_4_4','Germany');
	addMonstersElements('-='+Germany_5,'loc','Germany');
	addMonstersElements(Germany_5_1,'ger_5_1','Germany');
	addMonstersElements(Germany_5_2,'ger_5_2','Germany');
	addMonstersElements(Germany_5_3,'ger_5_3','Germany');
	addMonstersElements('[BOSS]'+Germany_5_4,'ger_5_4','Germany');
	addMonstersElements('-='+Germany_6,'loc','Germany');
	addMonstersElements(Germany_6_1,'ger_6_1','Germany');
	addMonstersElements(Germany_6_2,'ger_6_2','Germany');
	addMonstersElements(Germany_6_3,'ger_6_3','Germany');
	addMonstersElements('[BOSS]'+Germany_6_4,'ger_6_4','Germany');
	addMonstersElements('-='+Germany_7,'loc','Germany');
	addMonstersElements(Germany_7_1,'ger_7_1','Germany');
	addMonstersElements(Germany_7_2,'ger_7_2','Germany');
	addMonstersElements(Germany_7_3,'ger_7_3','Germany');
	addMonstersElements('[BOSS]'+Germany_7_4,'ger_7_4','Germany');
	addMonstersElements('-='+Germany_8,'loc','Germany');
	addMonstersElements(Germany_8_1,'ger_8_1','Germany');
	addMonstersElements(Germany_8_2,'ger_8_2','Germany');
	addMonstersElements(Germany_8_3,'ger_8_3','Germany');
	addMonstersElements('[BOSS]'+Germany_8_4,'ger_8_4','Germany');
	
	document.getElementById('selectEnemyItaly').addEventListener('change', function(){statMinion(this.value);}, true);
	document.getElementById('selectEnemyAfrica').addEventListener('change', function(){statMinion(this.value);}, true);
	document.getElementById('selectEnemyGermany').addEventListener('change', function(){statMinion(this.value);}, true);
}

function addMonstersElements(name,id,where){
	var option = document.createElement('option');
	option.value= id;
	option.innerHTML = name;
	document.getElementById('selectEnemy'+where).appendChild(option);
}

function findPlayerStats(id){
	if(!id || id=='' || id==null){id=document.getElementById('player').value}
	document.getElementById('player_sim_results').innerHTML=L_searchData;
	GM_xmlhttpRequest({
		method: "GET",
		url: GCAO_siteurl + 'mod=player&p='+id,
		onload: function(response){
			if(response.responseText.match('playername_achievement')){
				var skill = response.responseText.match('<span id="char_f1" class="charstats_value">(\.+)</span>')[1];
				var agility = response.responseText.match('<span id="char_f2" class="charstats_value">(\.+)</span>')[1];
				var charisma = response.responseText.match('<span id="char_f4" class="charstats_value">(\.+)</span>')[1];
				var armor = response.responseText.match('<span id="char_panzer" class="charstats_value22">(\.+)</span>')[1];
				var degatMin = response.responseText.match('<span id="char_schaden" class="charstats_value22">(\.+)</span>')[1].split(' - ')[0];
				var degatMax = response.responseText.match('<span id="char_schaden" class="charstats_value22">(\.+)</span>')[1].split(' - ')[1];
				var str = response.responseText.split('<div class="charstats_bg" id="char_panzer_tt" ');
				str = str[1].split('%');
				str2 = str[0].split('>');
				str2 = str2[str2.length-1];
				var resistance = str2;
				str2 = str[1].split('>');
				str2 = str2[str2.length-1];
				var block = str2;
				str2 = str[2].split('>');
				str2 = str2[str2.length-1];
				var critic = str2;
				document.getElementById('player_sim_results').innerHTML='';
				setPlayerBStats(skill, agility, charisma, armor, degatMin, degatMax, resistance, critic, block);
			}
			else{document.getElementById('player_sim_results').innerHTML=L_playerNotFound;}	
		}
	});
}

function putMyStats(){
		if(Get_Cookie('simstats')){
			var code=Get_Cookie('simstats');
		}else{
			var code='##0##0##0##0##0##0##0##0##0##0##0##0##0##0';
		}
		
		document.getElementById('skillA').value = code.match(/##([^#]+)/g)[3].replace(/#/g,'')*1;
		document.getElementById('agilityA').value = code.match(/##([^#]+)/g)[4].replace(/#/g,'')*1;
		document.getElementById('charismaA').value = code.match(/##([^#]+)/g)[6].replace(/#/g,'')*1;
		document.getElementById('armorA').value = code.match(/##([^#]+)/g)[7].replace(/#/g,'')*1;
		document.getElementById('damageMinA').value = code.match(/##([^#]+)/g)[8].replace(/#/g,'')*1;
		document.getElementById('damageMaxA').value = code.match(/##([^#]+)/g)[9].replace(/#/g,'')*1;
		document.getElementById('resistanceA').value = code.match(/##([^#]+)/g)[10].replace(/#/g,'')*1;
		document.getElementById('criticA').value = code.match(/##([^#]+)/g)[12].replace(/#/g,'')*1;
		document.getElementById('blockA').value= code.match(/##([^#]+)/g)[11].replace(/#/g,'')*1;
		
}

function clearAllStats(){
	document.getElementById('skillA').value = '';
	document.getElementById('agilityA').value = '';
	document.getElementById('charismaA').value = '';
	document.getElementById('armorA').value = '';
	document.getElementById('damageMinA').value = '';
	document.getElementById('damageMaxA').value = '';
	document.getElementById('resistanceA').value ='';
	document.getElementById('criticA').value = '';
	document.getElementById('blockA').value= '';
	setPlayerBStats('', '', '', '', '', '', '', '', '');
	document.getElementById('emptyOption').selected=true;
	document.getElementById('resultBox').style.display='none';
}
	
function statMinion(minion){
	if(minion!='loc'){
		if(minion=='ita_1_1'){setPlayerBStats(6,8,6,45,2,2,15,0,0);}
		else if(minion=='ita_1_2'){setPlayerBStats(13,16,12,100,4,5,0,13,0);}
		else if(minion=='ita_1_3'){setPlayerBStats(19,24,22,223,6,7,0,13,0);}
		else if(minion=='ita_1_4'){setPlayerBStats(15,25,25,488,13,17,0,9,0);}
		else if(minion=='ita_2_1'){setPlayerBStats(24,34,18,289,8,10,0,8,0);}
		else if(minion=='ita_2_2'){setPlayerBStats(24,42,37,416,12,15,0,6,8);}
		else if(minion=='ita_2_3'){setPlayerBStats(42,68,24,438,15,18,0,12,6);}
		else if(minion=='ita_2_4'){setPlayerBStats(46,71,53,808,26,32,0,10,8);}
		else if(minion=='ita_3_1'){setPlayerBStats(30,42,26,508,16,19,0,5,5);}
		else if(minion=='ita_3_2'){setPlayerBStats(42,79,66,703,23,28,0,9,0);}
		else if(minion=='ita_3_3'){setPlayerBStats(68,51,110,1399,25,31,0,18,0);}
		else if(minion=='ita_3_4'){setPlayerBStats(86,104,120,1608,35,43,0,15,5);}
		else if(minion=='ita_4_1'){setPlayerBStats(33,46,46,2282,40,49,0,12,0);}
		else if(minion=='ita_4_2'){setPlayerBStats(91,109,72,1793,48,58,0,20,0);}
		else if(minion=='ita_4_3'){setPlayerBStats(93,113,105,1528,50,61,0,20,0);}
		else if(minion=='ita_4_4'){setPlayerBStats(94,121,142,2516,66,82,0,18,0);}
		else if(minion=='ita_5_1'){setPlayerBStats(140,196,122,6204,118,145,0,8,7);}
		else if(minion=='ita_5_2'){setPlayerBStats(270,352,151,3605,133,163,0,17,0);}
		else if(minion=='ita_5_3'){setPlayerBStats(148,129,336,3481,182,223,0,12,8);}
		else if(minion=='ita_5_4'){setPlayerBStats(234,436,382,5261,192,235,0,18,12);}
		else if(minion=='ita_6_1'){setPlayerBStats(168,236,157,4040,150,184,0,6,9);}
		else if(minion=='ita_6_2'){setPlayerBStats(171,239,266,3741,140,172,0,8,9);}
		else if(minion=='ita_6_3'){setPlayerBStats(303,226,226,2771,237,290,0,15,7);}
		else if(minion=='ita_6_4'){setPlayerBStats(364,453,425,5792,162,199,0,15,10);}
		else if(minion=='ita_7_1'){setPlayerBStats(180,252,140,7372,135,166,0,10,5);}
		else if(minion=='ita_7_2'){setPlayerBStats(168,264,235,9547,142,174,0,8,5);}
		else if(minion=='ita_7_3'){setPlayerBStats(415,493,145,3854,242,298,0,13,0);}
		else if(minion=='ita_7_4'){setPlayerBStats(440,616,492,5100,230,282,0,12,9);}
		else if(minion=='afr_1_1'){setPlayerBStats(97,115,73,1852,50,62,0,15,0);}
		else if(minion=='afr_1_2'){setPlayerBStats(96,156,56,3601,54,66,0,15,0);}
		else if(minion=='afr_1_3'){setPlayerBStats(59,59,95,3563,73,89,0,9,0);}
		else if(minion=='afr_1_4'){setPlayerBStats(171,252,319,1225,105,129,0,13,7);}
		else if(minion=='afr_2_1'){setPlayerBStats(72,100,189,1306,38,47,0,8,2);}
		else if(minion=='afr_2_2'){setPlayerBStats(57,79,133,3546,87,107,0,12,0);}
		else if(minion=='afr_2_3'){setPlayerBStats(178,264,102,2113,58,71,0,11,9);}
		else if(minion=='afr_2_4'){setPlayerBStats(225,344,258,2053,113,139,0,11,9);}
		else if(minion=='afr_3_1'){setPlayerBStats(110,126,112,1614,67,83,0,13,0);}
		else if(minion=='afr_3_2'){setPlayerBStats(51,43,114,5325,88,108,0,8,0);}
		else if(minion=='afr_3_3'){setPlayerBStats(202,189,204,1460,97,119,0,20,0);}
		else if(minion=='afr_3_4'){setPlayerBStats(192,302,369,1694,73,90,0,17,0);}
		else if(minion=='afr_4_1'){setPlayerBStats(90,110,78,4180,90,110,0,11,0);}
		else if(minion=='afr_4_2'){setPlayerBStats(49,51,68,5658,98,120,0,8,9);}
		else if(minion=='afr_4_3'){setPlayerBStats(147,102,85,5369,90,111,0,13,0);}
		else if(minion=='afr_4_4'){setPlayerBStats(178,196,232,7588,125,154,0,14,0);}
		else if(minion=='afr_5_1'){setPlayerBStats(193,270,180,5152,158,195,0,7,8);}
		else if(minion=='afr_5_2'){setPlayerBStats(258,421,421,2006,92,113,0,15,5);}
		else if(minion=='afr_5_3'){setPlayerBStats(155,124,249,22874,109,134,0,17,8);}
		else if(minion=='afr_5_4'){setPlayerBStats(322,515,869,5236,283,347,0,14,9);}
		else if(minion=='afr_6_1'){setPlayerBStats(295,350,222,2188,154,189,0,10,5);}
		else if(minion=='afr_6_2'){setPlayerBStats(250,382,286,5018,112,137,0,8,12);}
		else if(minion=='afr_6_3'){setPlayerBStats(418,651,195,2779,171,210,0,10,15);}
		else if(minion=='afr_6_4'){setPlayerBStats(408,604,672,6250,162,199,0,12,8);}
		else if(minion=='afr_7_1'){setPlayerBStats(142,166,232,8514,175,215,0,9,0);}
		else if(minion=='afr_7_2'){setPlayerBStats(408,537,268,4832,133,163,0,14,0);}
		else if(minion=='afr_7_3'){setPlayerBStats(378,565,459,10084,217,267,0,16,0);}
		else if(minion=='afr_7_4'){setPlayerBStats(225,489,489,15005,292,359,0,11,0);}
		else if(minion=='afr_8_1'){setPlayerBStats(350,489,315,6939,184,226,0,7,0);}
		else if(minion=='afr_8_2'){setPlayerBStats(390,473,364,9143,192,235,0,12,0);}
		else if(minion=='afr_8_3'){setPlayerBStats(364,509,509,7148,240,294,0,13,0);}
		else if(minion=='afr_8_4'){setPlayerBStats(577,882,698,4488,339,416,0,14,8);}
		else if(minion=='ger_1_1'){setPlayerBStats(100,140,140,5593,69,85,0,7,13);}
		else if(minion=='ger_1_2'){setPlayerBStats(148,245,94,6486,74,91,0,5,15);}
		else if(minion=='ger_1_3'){setPlayerBStats(165,269,154,7918,76,93,0,7,13);}
		else if(minion=='ger_1_4'){setPlayerBStats(171,299,279,9464,140,172,0,13,0);}
		else if(minion=='ger_2_1'){setPlayerBStats(96,134,115,4797,101,124,0,8,7);}
		else if(minion=='ger_2_2'){setPlayerBStats(116,101,182,7128,89,109,0,5,15);}
		else if(minion=='ger_2_3'){setPlayerBStats(195,378,252,1950,138,170,0,13,0);}
		else if(minion=='ger_2_4'){setPlayerBStats(141,286,110,5987,271,333,0,16,0);}
		else if(minion=='ger_3_1'){setPlayerBStats(165,231,168,3657,64,79,0,16,0);}
		else if(minion=='ger_3_2'){setPlayerBStats(167,128,192,6174,112,138,0,9,0);}
		else if(minion=='ger_3_3'){setPlayerBStats(117,140,304,6514,185,227,0,15,0);}
		else if(minion=='ger_3_4'){setPlayerBStats(230,415,369,7641,142,174,0,12,0);}
		else if(minion=='ger_4_1'){setPlayerBStats(81,227,182,4288,100,122,0,10,8);}
		else if(minion=='ger_4_2'){setPlayerBStats(204,309,166,6386,125,154,0,5,15);}
		else if(minion=='ger_4_3'){setPlayerBStats(227,196,392,2629,107,132,0,15,10);}
		else if(minion=='ger_4_4'){setPlayerBStats(306,504,504,6714,144,176,0,10,15);}
		else if(minion=='ger_5_1'){setPlayerBStats(236,477,294,8429,194,238,0,5,10);}
		else if(minion=='ger_5_2'){setPlayerBStats(270,264,529,6207,249,306,0,10,5);}
		else if(minion=='ger_5_3'){setPlayerBStats(401,374,636,15695,214,260,0,12,0);}
		else if(minion=='ger_5_4'){setPlayerBStats(463,534,648,16464,285,350,0,16,0);}
		else if(minion=='ger_6_1'){setPlayerBStats(327,457,343,9453,251,309,0,5,15);}		
		else if(minion=='ger_6_2'){setPlayerBStats(476,548,548,8049,258,317,0,11,9);}			
		else if(minion=='ger_6_3'){setPlayerBStats(166,310,310,22661,222,272,0,8,8);}			
		else if(minion=='ger_6_4'){setPlayerBStats(282,514,632,19903,330,405,0,7,8);}	
		else if(minion=='ger_7_1'){setPlayerBStats(395,553,355,8647,261,320,0,12,0);}				
		else if(minion=='ger_7_2'){setPlayerBStats(342,478,598,7530,228,280,0,13,7);}					
		else if(minion=='ger_7_3'){setPlayerBStats(456,798,758,8369,263,323,0,13,12);}
		else if(minion=='ger_7_4'){setPlayerBStats(678,1156,867,10054,399,490,0,15,20);}
		else if(minion=='ger_8_1'){setPlayerBStats(526,737,327,12177,270,331,0,9,0);}
		else if(minion=='ger_8_2'){setPlayerBStats(624,666,541,11076,329,404,0,18,0);}
		else if(minion=='ger_8_3'){setPlayerBStats(590,1032,619,15060,327,401,0,17,0);}
		else if(minion=='ger_8_4'){setPlayerBStats(480,504,1092,21676,480,589,0,12,0);}
		else{
			setPlayerBStats('','','','','','','','','');
			document.getElementById('player_sim_results').innerHTML=L_noStats+' <img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/crying.png" style="position:absolute;">';
		}
	}else{
		setPlayerBStats('','','','','','','','','');
		document.getElementById('player_sim_results').innerHTML=L_thisIsLocation+' <img src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/tongue.png" style="position:absolute;">';
	}
}

function setPlayerBStats(skill, agility, charisma, armor, damageMin, damageMax, resistance, critic, block){
	document.getElementById('player_sim_results').innerHTML='';
	document.getElementById('skillB').value = skill;
	document.getElementById('agilityB').value = agility;
	document.getElementById('charismaB').value = charisma;
	document.getElementById('armorB').value = armor;
	document.getElementById('damageMinB').value = damageMin;
	document.getElementById('damageMaxB').value = damageMax;
	document.getElementById('resistanceB').value = resistance;
	document.getElementById('criticB').value = critic;
	document.getElementById('blockB').value= block;
}

function simulateBegin(fights){
	var skill = document.getElementById('skillA').value;
	var agility = document.getElementById('agilityA').value;
	var charisma = document.getElementById('charismaA').value;
	var block = document.getElementById('blockA').value;
	var resistance = document.getElementById('resistanceA').value;
	var ARMOR = document.getElementById('armorA').value;
	var damageMin = document.getElementById('damageMinA').value;
	var damageMax = document.getElementById('damageMaxA').value;
	var critDamage = document.getElementById('criticA').value;
	
	return simulate(skill, agility, charisma, block, resistance, ARMOR, damageMin, damageMax, critDamage, 100000, fights);
}

function launchSimulator(){
	var array = simulateBegin(1000);
	document.getElementById('result').innerHTML = parseInt(100*array[0]/(array[0]+array[1]))+'%';
	document.getElementById('myAvDam').innerHTML = array[3];
	document.getElementById('hisAvDam').innerHTML = array[4];
	document.getElementById('resultBox').style.display='block';
}

//################################################################################################################################
//## GET PLAYER'S ID FROM PLAYER'S NAME
//################################################################################################################################
function getPlayersIdFromPlayersName(){
	var PlayerName = document.getElementById('playerName').value;
	document.getElementById('player_sim_results').innerHTML='Searching id...';
	var code = '&s=s&xs='+PlayerName;
	var postUrl = GCAO_siteurl+'mod=highscore&submod=suche&sh='+GCAO_secureCode;
	var host = GCAO_siteurl.replace('//','').replace('http:','').replace('/game/index.php?','');
	
	var xhr = new XMLHttpRequest();
	var url=postUrl;
	xhr.open('POST', url, false);
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	xhr.send(code);
	var found=false;
	if(xhr.responseText.match(/mod.player.p/i)){
		if(xhr.responseText.match(/mod.player.p.\d+[^>]+>([^<]+)<\/a>/i)[1].toLowerCase()==PlayerName.toLowerCase()){
			var playersID = xhr.responseText.match(/mod.player.p.(\d+)/i)[1];
			found = true;
		}
	}
	if(found==true){
		document.getElementById('player_sim_results').innerHTML='Id found...';
		findPlayerStats(playersID);
	}
	else{document.getElementById('player_sim_results').innerHTML='Player not found...';}
}

//################################################################################################################################
//## Add raided gold in the war camp member reports list
//################################################################################################################################

function warCampMemberGold(){
	var p = document.evaluate(".//p[@class='buildingDesc']",document.getElementById('content'),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
	p.snapshotItem(0).innerHTML += '<br/><br/><input id="launchRaidedGold" type="button" class="button2" value="Trouver l\'or" style="position:absolute;left:500px;top:399px;"><input id="hasBeenLaunched" type="hidden" value="0">   ';
	
	
	// the bar
	var bar = document.createElement('div');
	if(document.getElementById('banner_top') && document.getElementById('banner_event'))
		var top = 401-25;
	else
		var top = 401;
	bar.innerHTML = '<div class="cooldown_bar" style="left:630px;top:'+top+'px;cursor:pointer;"><div id="pageBar" style="width: 0%;" class="cooldown_bar_fill cooldown_bar_fill_progress"></div><div class="cooldown_bar_text" id="cooldown_bar_fill_page">0</div></div>';
	p.snapshotItem(0).innerHTML += bar.innerHTML;
	
	document.getElementById('launchRaidedGold').addEventListener('click', function() { seeRaidedGold();	}, true); 
}
	
function seeRaidedGold(){

	if(document.getElementById('hasBeenLaunched').value == 0){
		document.getElementById('hasBeenLaunched').value = 1;

		// Compact the dates column
		var dates = document.evaluate("(.//th[@class='warcamp_member_report_date'])|(.//td[@class='warcamp_member_report_date'])",document.getElementById('content'),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);

		for(var i =0;i<dates.snapshotLength;i++){
			dates.snapshotItem(i).style.width="100px";
			dates.snapshotItem(i).style.minWidth="100px";
		}	
		
		var trs = document.evaluate(".//div[@class='report_statistic']/table/tbody/tr",document.getElementById('content'),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
		var divs = document.evaluate(".//div[@class='report_statistic']",document.getElementById('content'),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
		divs.snapshotItem(0).innerHTML = divs.snapshotItem(0).innerHTML.replace(/<th class=\"warcamp_member_report_details\">/i, '<th><img border="0" align="absmiddle" src="http://i617.photobucket.com/albums/tt260/goldisever/GCAO/res2.gif"></th><th class="warcamp_member_report_details">');
		var row = 1;
		var goldArray = new Array();
		var counter = 0;
		
		var inp = document.createElement('input');
		inp.setAttribute('type','hidden');
		inp.setAttribute('value',0);
		inp.setAttribute('id','counterReports');
		document.getElementById('content').appendChild(inp);
		searchRaidedGold(divs,trs,row,goldArray,counter);
	}
}
	
	
function isInTheGuild(str){
	if(str.match(/color:(green|blue)/i))
		return true;
	else
		return false;
}


	
function searchRaidedGold(divs,trs,row,goldArray,counter){
	if(row<trs.snapshotLength){
		var tds = document.evaluate(".//td",trs.snapshotItem(row),null,XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,null);
		
		GM_xmlhttpRequest({
			method: "GET",
			url: GCAO_siteurl + tds.snapshotItem(4).innerHTML.split('index.php?')[1].split('"')[0].replace(/amp;/g,''),
			onload: function(response){
				if(response.responseText.split("absmiddle").length>1){
					var gold = response.responseText.split("absmiddle")[0];
					goldArray[row] = gold.split(':')[gold.split(':').length-1].split('<')[0].replace(/[^(.|0-9)]/g,'');
					
					if(goldArray[row].length>5)
						goldArray[row] = '<b>'+goldArray[row]+'</b>';
					if(isInTheGuild(tds.snapshotItem(1).innerHTML))
						goldArray[row] = '<span style="color:green">'+goldArray[row]+'</span>';
					else if(isInTheGuild(tds.snapshotItem(2).innerHTML))
						goldArray[row] = '<span style="color:red">'+goldArray[row]+'</span>';
				}
				else
					goldArray[row]='';
					
				document.getElementById('counterReports').value++;
				
				
				var test = Math.floor(100*parseInt(document.getElementById('counterReports').value)/parseInt(trs.snapshotLength-1))+'%';
				document.getElementById('pageBar').style.width = test;
				document.getElementById('cooldown_bar_fill_page').innerHTML = document.getElementById('counterReports').value+' / '+(trs.snapshotLength-1) +' ('+test+')';
				
				if(document.getElementById('counterReports').value==trs.snapshotLength-1)
					document.getElementById('pageBar').className = "cooldown_bar_fill cooldown_bar_fill_ready";
									
				if(document.getElementById('counterReports').value==trs.snapshotLength-1){
				
					for(var i =0; i<goldArray.length;i++)
						divs.snapshotItem(0).innerHTML = divs.snapshotItem(0).innerHTML.replace(/<td class=\"warcamp_member_report_details\">/i, '<td>'+goldArray[i+2]+'</td><td title="done" class="warcamp_member_report_details">');
				}
				
				
			}
		});
		row++;
		searchRaidedGold(divs,trs,row,goldArray,counter)
	}
}


//################################################################################################################################
//## DEBUGER
//################################################################################################################################
function c(callback){
	try{
		callback;
	}catch(e){
		DE(e);
	}
}

function DE(e){
	var line=(e.lineNumber)-402;
	if(!document.getElementById('ErrorBox')){
		var img_error = 'data:image/gif;base64,R0lGODlhFAAZAPUAAPxSVPyqrPx+fPzW1PxqbPyWlPzu7PzCxPxeXPyKjPzi5Py6vPx2dPyipPz6/PzOzPxaXPyytPyGhPze3PxydPyenPz29PzKzPxmZPySlPzq7PxWVPyurPyChPza3PxubPyanPzy9PzGxPxiZPyOjPzm5Py+vPx6fPympPz+/PzS1AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAkDACkAIf8LTkVUU0NBUEUyLjADAQAAACwAAAAAFAAZAAAG/sCUcGjwaIbI5NAR6EgoGYNymlk4DBYT4zgdmioTCSGTUgks3ZRDIPqMRhRH6tBIDxIdDAYxCqlJJV0cEQx6IxAeQh4VXSQqBhRvCCZDJGhKHYEakQh1QhEXUydSKZsUoSkPIwWiXCklDw8KDwgbBFMCgUMlEBQfGwAbl0gSA0gaEAgCG8ATShWUQxoZAhXAACpKC4xCmw0hIRIAACJKEydyFh0jnSkWGeRKDhQlDhkY7BJDCdlKDRwcCOBDwGAICgVTFHxYMGIgBj8pEgxLkiBCAkkIAlnQ16UEBg/rECAwdoBDmhQLTpRoQGBSiFEnUzQ4oaBIiQTRYpqgQKLCC4kFMZFYmOABopIgACH5BAkDACoALAAAAAAUABkAhfxWVPyurPyChPza3PxubPzGxPyanPzu7PxiZPy6vPyOjPzm5Px6fPzS1PympPz6/PxeXPy2tPyKjPzi5Px2dPzOzPyipPz29PxqbPzCxPyWlPxaXPyytPyGhPze3PxydPzKzPyenPzy9PxmZPy+vPySlPzq7Px+fPzW1PyqrAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAb6QJVwOEmFQI+hcimMCDIkgeLCZBZOIlOSI6kqL4RCZ0QSWhJeIYlCQCBCwouA6hUgRu7TMIGuitwYeCMiQiIKXgMnIXcIEANDGgdVGSUqARCNfSIdBVURFmoQHw0qcgBwTAEpQyAZIB4GAAAdVapKCxsfGLIfnqhCJhAQJ7IjVQWHQw8lJymyEFUDDEolFgcPHBsbSUsiGHQZwpUqDQDcSx+PCxiNBNzJTA4ODxJ4mCYqBwZeHhgojMJQqCjQpwoDZG6ERVChYUGaCh9MMMAEIYQJWmlUSLAgwkCjDiVAZFQhgkKKByZQaBg3UkQJBhoYGKAzEpgHh16CAAAh+QQJAwAoACwAAAAAFAAZAIX8UlT8qqz8fnz81tT8lpT87uz8amz8wsT8Xlz8ioz84uT8trT8oqT8+vz8zsz8enz8Wlz8srT8hoT83tz8npz89vT8cnT8ysz8ZmT8kpT86uz8VlT8rqz8goT82tz8mpz88vT8bmz8xsT8YmT8joz85uT8vrz8pqQAAAD80tQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG9kCUcFg4CR6moXIpLFg4mknnxKw+IgVhQ3KpKg8IA0DTFDS8QstohHAMT26vYoPBjKjCEgEdgRjWHUoJZ1USYXYYIFoECl4hJiFrCClCASEiVRUYFQWGFhMoAxAbHFUaBmcNDAsXExYbABRVJSGEKCUQIQYbGx+mtUMaEAgCvAKmqEoEAiYQABhVIJtDJgyKCiEbtkoYZCggIcRCKSReAnEMbCNkCx5eJwwoCnYIbSgfilUDFigJ9BAcKmRAgwKDFEkIEohYQDACiQLh6hnokAVNBQMOQBAYAQFCAIJCBhgYcCvDgwoghXgQ0MFCgnwpUTTQ4M1LEAAh+QQJAwAqACwAAAAAFAAZAIX8Skz8pqT81tT8enz8YmT8vrz87uz8kpT8VlT84uT8bmz8ysz8trT8hoT8+vz8oqT8UlT8rqz83tz8goT8amz8xsT89vT8mpz8Xlz86uz8dnT80tT8Tkz8qqz82tz8fnz8ZmT8wsT88vT8lpT8Wlz85uT8cnT8zsz8urz8jowAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG6ECVcKjafDSmBXG5XIAWFolpw2SWCFRhaeCoElOcFPGh9Ko8EABCNCwdzCoTiYAlNrpVAYROCHwzXh0cFCAEXEILF1lMKBAghQQlKiIgJhWBDxF0JpIPCBAoXikFKhIfEQsbGJ+hVQNZDhIkChSfD14mHkMZJBgfCAgfXgoSRCMfGyZ7w8VCEh0GKg4HJl4aiwcYGmwPbFUpIUIJBBgYGxa3mEIX5CQRAqReGwMqJYXlEw+SXiIYFh10ymF4AycFAwMf2pG4BCcBCBEiHoDAQCAenAgfDIgIoGAfHCEhPig44O0jEQsfgwAAIfkECQMAKgAsAAAAABQAGQCF/EpM/Kak/NbU/Hp8/L68/GJk/O7s/JKU/LK0/OLk/MrM/G5s/FZU/IaE/Pr8/J6c/K6s/N7c/IKE/MbE/Gps/Pb0/Jqc/Lq8/Ors/NLU/HZ0/F5c/FJU/Kqs/Nrc/H58/MLE/GZk/PL0/JaU/La0/Obk/M7M/HJ0/Fpc/IqMAAAA/KKkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABuRAlXAoBC1OnxJxuSQVMhXQoMJkCgqJYeBSJUYoHSIm1RV6NoDG8kOtOjQcTkFEHGWrAgonVFAMHQEmXR0hDHwjQhUnHSBdFigbfBRUIAwajVUVKCcFBScGbwwcE10JFAYdBRAKlaJ+VRNqKhgCmxSiK10IFkMYkB+iH10PEHUfCSsoBV0jJEMiJAYqFR2vTCNcQgQbCyUJpI4IQwMbGyQEGGUduSoRBRsoDWFlsUIP75CYXRjLFQvv8ASVUbHAQwUJAFHwGkiggYMKD8oVeDBQSIMHGR5o8KCkogoHDSG08UhySBAAIfkECQMAKwAsAAAAABQAGQCF/EpM/Kqs/Hp8/NbU/GJk/MLE/JKU/O7s/La0/IaE/OLk/G5s/FZU/M7M/J6c/Pr8/LK0/IKE/N7c/Gps/MrM/Jqc/Pb0/L68/I6M/Ors/HZ0/F5c/FJU/K6s/H58/Nrc/GZk/MbE/JaU/PL0/Lq8/IqM/Obk/HJ0/Fpc/NLU/KKkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABuTAlXA4bAg0gQdxubxsSBlDh0n9ED7CkUZJFUowGhIRI+muJAtQhCuEhLqPE4AgWDYg3QEKhCJkhA8UKVNUHWl9CEIUACSETCITewQeSiUMGgVdhgwgBCcWGSgMHANmGCUnGx0UCAyjDWYgJg8hFCgnE64OXQcbQ6EbCa4eeRpEIh4HIQkJXQUlRCEHKykKbEsQFUMKKAspIddLASpDHRsoGLBmHbtCHhsbfmYrJNArJgTnKCnzA3UrCPKd02bGwgYlFeCdm2BhngE8WvIRwBBuyQgPJTSUMPHBxLwhDxpg+UiySxAAIfkECQMAKgAsAAAAABQAGQCF/EZE/Kak/HZ0/NbU/I6M/L68/O7s/F5c/LK0/IKE/OLk/Jqc/Gps/MrM/Pr8/FJU/K6s/H58/N7c/JaU/Pb0/GZk/Lq8/IqM/Ors/KKk/HJ0/NLU/Fpc/Kqs/Hp8/Nrc/JKU/MbE/PL0/GJk/La0/IaE/Obk/J6c/G5s/M7MAAAA/FZUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABuVAlXBINAROEqJyqaiUSCjDcmpAkYQkxHQosTgWgaECtFVJUJrGhTKklLaORMX5GTocl+3gAUB5HEIhCCJkUx0jDB4HA0IlACELWxNoFSMTKhQjDwIFWyUoKBwjAg4pKysPClsbIKIjEA0QpyspZSEXGycFHCgMpydlF50qGBwHExUcEWUjGEMgERQNA4xTGCNEAwYUG2UqGx52IygdSWUWBEMfBxyk3hDpQgjsB+ZbCMBCFwfsGd4WlzAxYMeLzRYJAoRI4MduRbcyGgaYmCBg4AgCIryZiMAAggMDH5x5szOypLcgACH5BAkDACoALAAAAAAUABkAhfxKTPympPx6fPzW1PxiZPySlPzu7PzGxPxWVPyytPyGhPzi5PxubPyenPz6/PzOzPxSVPyurPyChPze3PxqbPyanPz29PxeXPy6vPyOjPzq7Px2dPxOTPyqrPx+fPza3PxmZPyWlPzy9PzKzPxaXPy2tPyKjPzm5PxydPyipAAAAPzS1AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAblQJVwSBSeFsVk0REgUTrKaEdwcjAcUdVEI/yYREKFITphNFTM09A0TjokIIrmM1ItsKbogAK6lBJCEoB5SgEcACQRHyoWhwMZURlxIQyAHxAcGxhRJgwMEgQSKhEIpVxKJhQoBAQRBx2lCA9RIgMMJgIJJCgUpSlZZYwaJBcREgq/USnJKgUeBrNZKiADQycGJ6dRBhBYQh4UIdIqDxtDDiBObVEJZ0ILFyQkm1kpgEIHxCQC3kopJUIcZLgQD0G1KCXOWKhAUB4CZkkMbEihKQCFCwQyrFNyosMEIQY+aBtHsmSWIAAh+QQJAwAbACwAAAAAFAAZAIX8QkT8oqT80tT8cnT8urz86uz8ioz8Wlz8rqz83tz8fnz8xsT89vT8lpT8ZmT8Tkz8qqz82tz8enz8wsT88vT8kpT8YmT8trT85uT8hoT8zswAAAD8npz8bmz8VlT8Skz8pqT81tT8dnT8vrz87uz8joz8Xlz8srT84uT8goT8ysz8+vz8mpz8amz8UlQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG4MCNcEgsGo9ESoDFQB4Lkgwr4CwUEZcNpoKMDEJD1ESY4CBTjpJwdQk0R4tjqNVygEcYz2nDIh0hHRYeCiEJAgAuKBlIJQ8PLggEGycPHwNZRwp0CggGGxUeoX5HBh0tFS0ICyChHhpIICkDAxYQB6YuLlRIDCUIGCgHJhMQEVZIJAcUQg0KKMdOEFxCJAUJTkMO10IsHYvYCR1EKcJgThcsRB0HB9NIFWMbDBcmJuwoTgoRGxQcKsIHPJhBYmCBAEIa7AX0hARFB2cbNDgwYaHEKCQrVgwhYQybx48ghQQBACH5BAkDACsALAAAAAAUABkAhfxCRPyipPzW1PxydPy6vPyKjPzu7PxaXPyurPzi5Px+fPzGxPyWlPxmZPz6/PxOTPyqrPze3Px6fPzCxPySlPz29PxiZPy2tPzq7PyGhPzOzPyenPxubPxWVPympPza3Px2dPy+vPyOjPzy9PxeXPyytPzm5PyChPzKzPyanPxqbAAAAPxSVAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAbZwJVwSCwaj0aHA8kUcAYV5LJoykwKkWOEMhU6FtnCKHlqLIajSbZSOApUKsl4FSEhVovJEcJRNe4jCg8dVV1EDBwWDywmCxkAACB3RyeLJCcaIxIHHQdzRidwKgsXKAEsHSwaSBR9JxIeB08NmEgoCB4gFwIHJCFZTEIbAUIMCgnBQiYqUSsVCcDBDJMrFypQwSMkzSspBwcXwRcMQhUmDN8c3EYSAisYJQ4ZJJwlUiojAiJjm5zMRw4GZMgwh8O3DhkMEUmwoAsHEhZEGEhGxMAHDBQzamQSBAAh+QQJAwAcACwAAAAAFAAZAIX8Ojz8npz80tT8bmz8urz86uz8hoT8VlT8rqz83tz8enz8xsT89vT8kpT8YmT8Tkz8pqT8QkT82tz8dnT8wsT88vT8joz8Xlz8trT85uT8goT8zswAAAD8mpz8amz8oqT81tT8cnT8vrz87uz8ioz8Wlz8srT84uT8fnz8ysz8+vz8lpT8ZmT8UlT8qqz8RkQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG1UCOcEgsGo/IpLJQUR4XLNQxISBKmqNOqnFEKZrClUElqHwkRpDH8xmSPgtGZXV0DdYgIcF0yXQKRyt3UQwcCxEAEy5IBgMXDy8uIywlBxdgRhotLQ4eKQgBB6J5RxYeAywuJiUhCh0CKkgQAyETAQslFylOBQkJGiccDQqFTsImQgwZVU4bE7EqKR4OGUoqHgkcKhW4JRZKGFwSwSIl5qRGKgMZFMgcGOYHCrFGCSEdEPQIF5UH2UYVFIgg4iKegST0hkC44MDCCGNDKkgABLGixSJBAAAh+QQJAwAsACwAAAAAFAAZAIX8Skz8qqz8enz81tT8YmT8wsT8kpT87uz8VlT8trT8hoT84uT8bmz8zsz8npz8+vz8UlT8srT8goT83tz8amz8ysz8mpz89vT8Xlz8vrz8joz86uz8dnT8Tkz8rqz8fnz82tz8ZmT8xsT8lpT88vT8Wlz8urz8ioz85uT8cnT80tT8oqQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGykCWcEgsGo/IpHKpnJCMmwfR8RSaICKjJEIkKKQbx0dKHFAYkyEGEXmgLAtjgEH5VEuYzCLSOI7oBCssDwgmChyCRwp0ISUFFx4WEBhVRicMGAAdASwZCCUKlUUaCAghISIRDCNpSSsUsAoDGBhxSgUCKwFUBgIXSw8PCwIoDxcHGUwXKX0XGxQYFUsKESi/KJ8MokUJJxEDQhufCIlGKAQnKkMbECXuIEceGODr4wh9RiQHRewlCApMhqDoQEDDvoBCQGxAyLDhkCAAIfkECQMAKgAsAAAAABQAGQCF/EpM/Kak/NbU/Hp8/L68/GJk/O7s/JKU/FZU/LK0/OLk/IaE/MrM/G5s/Pr8/J6c/FJU/K6s/N7c/IKE/MbE/Gps/Pb0/F5c/Lq8/Ors/I6M/NLU/E5M/Kqs/Nrc/H58/MLE/GZk/PL0/JaU/Fpc/La0/Obk/IqM/M7M/HJ0AAAA/KKkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABrhAlXBILBqPyKRySXQwjZ6PqCgxjqZCD2LhFHYOXaGgAs4iEAnh5mEpdhqVjlACQRRMDsFxBK8wVBIIECQeG2FEC3AhDQomAAgUZUcnihABDAkbAVVIBykXHJYDAgKHRisIJCEhARspJksgIRUnrQ8fbUoZIx4gD1MGHblKGAtTDikkckoJDQZDFyQkG0kJA89DBSQIKVhFJQPeQhXbCAFHBOJCyWcoT0IN0lzvKgsFGtjvChn0/f5BACH5BAkDACwALAAAAAAUABkAhfxCRPympPxydPzW1PyKjPxaXPy+vPzu7PyytPx+fPzi5PyWlPxmZPxOTPzKzPz6/PyurPx6fPze3PySlPxiZPzGxPz29Py6vPyGhPzq7PyenPxubPxWVPxGRPyqrPx2dPza3PyOjPxeXPzCxPzy9Py2tPyChPzm5PyanPxqbPxSVPzOzAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAa6QJZwSCwaj8ikcjk8PZhGjYnEBBEDBcxzKDkRBxur0FPgQIYeVYXo2XwUwlKZklGgPpetcLFJRQ4sIxwcKhEEIGJEGH0MGCQgBQAACxZIBBsbDBQXBigFJZVIE5gMDZ5hSwEbFA0FC5t6SCNlDCEOICWxRxkiESMXHhYHCxlLGiUhKFQJBSa6RCsRKSVDEWUaSCUqGxKKZQUjRgciHrohZRwTR1RGnoMrUHEcWfFCFSIhgPUkXvX+/kEAACH5BAkDACwALAAAAAAUABkAhfxKTPympPx6fPzW1PxiZPy+vPySlPzu7PxWVPyGhPzi5PxubPzKzPyytPyenPz6/PxSVPyurPyChPze3PxqbPzGxPyanPz29PxeXPyOjPzq7Px2dPzS1PxOTPyqrPx+fPza3PxmZPzCxPyWlPzy9PxaXPyKjPzm5PxydPzOzPy6vPyipAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAbFQJZwSCwaj8ikcjkUXZhGioQEJW5KiYcS5CEmSojG8CFSESOUwHAEJmhIHokppBWOFpQuKwBGCDIpCgIVXnghHg8MGB0YDCwKFilFCSgUISEVFSYLGiwTJwdGBoYEKwAUJCQDT0cBKAshHV8lgUoilh0EBQYjnUonGBAbHAwRBwkcSh4EGQwJGScGJSEKSBYFIgkhBVrSCJxGBRQfBB5UQg59CUYTGU5FBQjyBlUsA/IIklUa8iZ1UA9CZAhVj4WvggihBAEAIfkECQMAKQAsAAAAABQAGQCF/FJU/Kqs/H58/NbU/Gps/JaU/O7s/MLE/F5c/IqM/OLk/La0/HZ0/KKk/Pr8/M7M/Fpc/LK0/IaE/N7c/HJ0/J6c/Pb0/MrM/GZk/JKU/Ors/FZU/K6s/IKE/Nrc/G5s/Jqc/PL0/MbE/GJk/I6M/Obk/Lq8/Hp8/KakAAAA/NLUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABtHAlHBILBqPyKRyKZxwLMyiZ9MJRYcGCETiUIaswxFkE1EGOpohY4zQWAaBRAKcKnwECmFivJEkUBcTJw9DEh8EFCopB1oFHkMiBHQJFAQYBA8cCRVEBxSPQxmHGCMoGyNdKRYRIHlEKBQfpBkAECUpHhcDUEUHBL8ACQUCEyIKqUUGCZcAEhYlJiYXSCEdHgIAJB4VAhkEEGVGGSIOFQgUIw0lphtkRpQEGxQRaSkP7RsfRiEXKgZFGvBluKJqRDtCBE9sISgEBIl/DHkxnBglCAAh+QQJAwAnACwAAAAAFAAZAIX8Skz8pqT81tT8enz8YmT87uz8vrz8kpT84uT8bmz8VlT8srT8hoT8+vz8ysz8oqT83tz8goT8amz89vT8xsT8mpz86uz8dnT8Xlz8urz8UlT8rqz82tz8fnz8ZmT88vT8wsT8lpT85uT8cnT8Wlz8trT8iowAAAD8zswAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG1sCTcEgsGo/IpHIp3GwmzOJDEflEhxQSidG4niAKkmKhpAiGE4yY8Gl8RBboMDTKDEdiSSjCMA0kHEMMCQkhbRUkEgYiRBQVQyYJEh4dDhsVKEUNDCVDByOTBAEkCV1oBx1yJw+EHh4hGhqMQggRJlZCHCOSEgQDJh0CbiURGaYnHMESkiQObhcDBwsWRA0DjAMJGhtfBwkMHQVFEyMiHwEAEgcEIyFqCglGUxgKAK8OBRYK+/FGHxAIcAlpkGBfCC8nTIjJ5GWBBgYITwgwIS6ixYtLggAAIfkECQMAGwAsAAAAABQAGQCF/D48/KKk/NLU/HJ0/Lq8/Ors/Fpc/IqM/K6s/N7c/H58/MbE/Pb0/GZk/E5M/JaU/Kqs/Nrc/Hp8/MLE/PL0/GJk/JKU/La0/Obk/IaE/M7MAAAA/G5s/FZU/EJE/Kak/NbU/HZ0/L68/O7s/F5c/I6M/LK0/OLk/IKE/MrM/Pr8/Gps/FJU/J6cAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABtfAjXBILBqPyORQpUQyJAhmszgwoChT4sNgyEizBG7HpGQQEx1DB6VsQcwbRkWtOGQUqFaCeOAoBCcECgYHJxQqKgUTHCJDGRwcKxIREwgYRhgHQxaQDRUfBgNfQwsZQiINnQ0WBiwnRREVAhsiBwSRKxUSFgMLBUMiJAQbIwMMBam5HyoUEisaII8aQiAtQhKRA1gpHSwkKxBYQhQrBAUQFSQXIBcSLJ4kRhorHR0AAA4kUCtqHEgFAhaAwCDFQj0LWYDVm5ZwA4YOphpuUBFghMSLGBsGAQAh+QQJAwAbACwAAAAAFAAZAIX8Pjz8oqT80tT8cnT8urz86uz8ioz8Wlz8rqz83tz8fnz8xsT89vT8lpT8ZmT8UlT8qqz82tz8enz8wsT88vT8kpT8YmT8trT85uT8hoT8zswAAAD8npz8bmz8RkT8pqT81tT8dnT8vrz87uz8joz8Xlz8srT84uT8goT8ysz8+vz8mpz8amz8VlQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG28CNcEgsGo/I5FClRC46CGaTeDocUJTpsmPNSLUVa8ukFRLEC+WJMVy0upnMapIlZhQiTobDORA2KhQgHwMQXxkdLCEaKikXbEQUJAhCHxYdHQ4WCAcDX0MMKBscARyYLBYNVhhGBQoJKCoTLCwODiEVAyYpRCooCBcTGwUsiQ4KDBQSBw0jwwoKKhorQiGJFhobEQ8tLSwQJSRsKgMGEQgOLCRCFCUtDw8S2UMjJN0eHiEkCh3d3p9DKCzIVWEFhAUQulVoAklIgQMP5pVRESJDGSICnF3cyJFjEAAh+QQJAwAtACwAAAAAFAAZAIX8RkT8pqT8dnT82tz8Xlz8vrz8joz87uz8UlT8srT8goT8amz8ysz8mpz85uT8+vz8Tkz8rqz8fnz84uT8ZmT8xsT8lpT89vT8Wlz8urz8ioz8cnT80tT8oqT8Skz8qqz8enz83tz8YmT8wsT8kpT88vT8VlT8trT8hoT8bmz8zsz8npz86uwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG5cCWcEgsGo/IpPDyUCINm0jTSYwQMIoSdRjCeFFT6iPlNXG2woaXwgojWRHFwivQKAwjbTGjEWRYFw0EIUITHwIfF0IPFiIpKAWKDCNFFwEKihoJJCkpFBsnGAJuQgEfDCQPAZ0UFBYYBBNGFygrAy0jC54UAiQSAR0HRCUaH2csFCkLImwlICYUCUMrHwMbWhvKFA0tLCbfJkwBFForFAwJFAsUsi3PJhgVKRsOiwleACIoByUsDQgIIBCIoGdIiRMgPAAEiAEgCkVIHpxgMWECiwMCTKhAMyQCGI5CShQESbIklSAAIfkECQMALAAsAAAAABQAGQCF/E5M/Kqs/H58/NbU/GZk/MLE/JaU/O7s/Fpc/La0/IqM/OLk/HJ0/M7M/KKk/Pr8/FZU/LK0/IaE/N7c/G5s/MrM/J6c/Pb0/GJk/L68/JKU/Ors/Hp8/FJU/K6s/IKE/Nrc/Gps/MbE/Jqc/PL0/F5c/Lq8/I6M/Obk/HZ0/NLU/KakAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABuhAlnBILBqPyKSQ9FAeDyGGp+kkckqID6k69CC+EmoVhUWExMmDKlL+LC7JgYKjiWi+lpHAsCiSNAoTQxsjIVssAxIaG0IPEhEWDiqHFQ1EDyIpKCwFIywaFFEGIggMaCwgKRd8LCsUFAQEdyUTpwEJFgecoSEYKRoCGgwZcEIodR4sGwShBBgDFxQQECGDuQQgLK+xDBcXJdMQxSsZLBUIJhEEIQQBQiPTJSwPERTFDSVY7H2IEB0hKj6E4CfkwgoCABBYiJAOQYcOJSwc8qNAggQGIUIBiKAryQU0G05wMXJqpMmTJ4MAACH5BAkDACsALAAAAAAUABkAhfxKTPympPx6fPzW1Py+vPxiZPySlPzu7PyytPyGhPzKzPxubPxWVPzi5PyenPz6/PyurPyChPzGxPxqbPyanPz29Py6vPyOjPzS1Px2dPxeXPzq7PxSVPyqrPx+fPze3PzCxPxmZPyWlPzy9Py2tPyKjPzOzPxydPxaXPzm5PyipAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAb0wJVwSCwaj8ik8PBQHgmTE6TiJDY0GlRkVB16sihRd1WBoM4q50AkiEQY2QjocKwYIibuqoQqDBARKlRDDwkIRR8UHkMSAgqMFCsjg0IKA0QHCRZCFCkrbBcdEgMoJ02ECY8UVAELCyEhIigaGJ5DGx4PDpcgCxMTBRkXHhcAESRDDhgmCSspIb4FBSAVCwAcKKcKCA8CyBO+IQUNDxMM56cmBM4hKiQhwAJNFhwMKEMXG0INBQIaEyECLCnAYMGKBx0uEKlAwV4BCacccCihwIMHPVY8cNBwIoEBAfZCTEEygsAHAiooqAgw4NSYlzBjyhQSBAAh+QQJAwAdACwAAAAAFAAZAIX8QkT8oqT8cnT80tT8Wlz8ioz86uz8urz8Tkz8fnz83tz8ZmT8lpT89vT8xsT8rqz8Skz8qqz8enz82tz8YmT8kpT88vT8wsT8VlT8hoT85uT8bmz8npwAAAD8zsz8RkT8pqT8dnT81tT8Xlz8joz87uz8vrz8UlT8goT84uT8amz8mpz8+vz8ysz8trQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG/sCOcEgsGo/IpLDEUh4rKsGj4SRGRiMCylIVarAEgsmpiWQSpyxBlGxwJAdNYxAeoTiaIwNEFbIkBAIsHhkRRSIVRh4rHEMuGSVDIApHLZRDA1tCHFQpIikaJSmBTUMtiR0reSACG64rBCMmDgp9HA4dLi4dFyoqCxQhFQkVEAgCQgYZHQYCJRoUG78ULg0SACcEpRlcAQwsrSoUFGMoHxgYpRwpHdYMLgvTeRMnGARDK5EdJSEFFL8hmrBIgGGDEAsMiDQgQWDBgoRCPGBIVKKAhyIsHGwgUEAEEwsCDrgI8QCJBRQogKnYMC7DACUsWDTQMMCDAn1dcurcWSQIACH5BAkDABsALAAAAAAUABkAhfxCRPyipPxydPzS1PyKjPzq7PxaXPy6vPyurPx+fPze3PyWlPz29PxmZPxOTPzGxPyqrPx6fPza3PySlPzy9PxiZPzCxPy2tPyGhPzm5PyenAAAAPxubPxWVPxGRPympPx2dPzW1PyOjPzu7PxeXPy+vPyytPyChPzi5PyanPz6/PxqbPxSVPzKzAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAb+wI1wSCwaj8ikkKJSGkenlQDBcA5VAhLJcGoqKQ8Ix7AlUZQHQcrSWmlJFq8RMTkLEQYDCIKRGAsEVUMUFSQTGxkiF0UlA0YlKYtCAR9EECNHLShEHyZDARlGKB0CchsiIXctGxIQASkTH2QQCyklGwUiQiGHJRwrKxUgEwkTHQAVQiapKicKGSS/DRVUCQ4eBk0SAUIPGAwCHA3TGhsBAA4dTRS6QhMaFw0rDSS3FAYdBkIM7RsUJxrkTfOzAQILDkJGlBuEoQGHCg3sMGhwaMMBR0RUBFjBIYGgDRcGqGixwNQQCREaLLAgAYWCBxMIYELCYACEEwIEgMBg4aMKExUMTFoZSlRIEAAh+QQJAwAcACwAAAAAFAAZAIX8Pjz8oqT80tT8cnT8urz86uz8ioz8Wlz8rqz83tz8fnz8xsT89vT8lpT8ZmT8UlT8RkT8qqz82tz8enz8wsT88vT8kpT8YmT8trT85uT8hoT8zswAAAD8npz8bmz8QkT8pqT81tT8dnT8vrz87uz8joz8Xlz8srT84uT8goT8ysz8+vz8mpz8amz8VlQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG/kCOcEgsGo/IpJC0UhoTmtYAwXAKUYHDxXSwOCWpFGtg4mqaSHBIKCgfWqXCcWWRDzXlQCKlMqIwRSFcCBwMFiNFFAlGICwbQw0LRCeLRiooQysaGUMYj0UZBwMrKwwMGSVoG4QcpSgqBAcmDS0mChwqAkIVGgwSBiItFyIWCg0uEBeFIEMdCygmHg4OFyArKS4fB00BJFcaJBMewhcpHBQPAC5NCLpCCB0YDi3ULEITECZNI5JCKwYIWtC7EEFICBcehBD4tCvFhGkXKAxh4YVDAE5EKhgQd2HNEkwFAsxBMEBECDRCEjSwcyQDiwklImA4YcFAJSUkVEQAEWFDBxUrQIMSCQIAIfkECQMAGwAsAAAAABQAGQCF/D48/KKk/NLU/HJ0/Lq8/Ors/IqM/Fpc/K6s/N7c/H58/MbE/Pb0/JaU/GZk/E5M/Kqs/Nrc/Hp8/MLE/PL0/JKU/GJk/La0/Obk/IaE/M7MAAAA/J6c/G5s/FZU/EZE/Kak/NbU/HZ0/L68/O7s/I6M/F5c/LK0/OLk/IKE/MrM/Pr8/Jqc/Gps/FJUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABv7AjXBILBqPyKSQtFIWV5FMa4BgOBkIiWVrOhCUjAaCkjCZDwpUcjQZss6gzOK4ghBJDvNixboYUSNFFwcmGhsrHG1EGnNEKxUsaoclkkIqjY4alSQZTUIhJ0YYBwMkEWwTKkMUFUUUAmYZBy4dKyeeGw0YGxQqHAMiFQoVHi4eGyoRQyMnJC3PDhYBKyUHDw8rBQhDDAYYCh0tWy0bCQcfLisMLEQTARcOLdEiQhAAByvUuI8j0BYpQhi06DAJF68UFSxEKzEkBAdeDUQpkBCN3ZAmGvwYIWEgRQcQRdZRQIJFAYcIFBhQCMEigRMMEDIoSJGCQyUnGxiQsIKzZwEQACH5BAkDAC0ALAAAAAAUABkAhfxGRPympPx2dPzW1Py+vPyOjPxeXPzu7PyytPyChPzi5PzKzPyanPxqbPxSVPz6/PyurPx+fPze3PzGxPyWlPxmZPz29Py6vPyKjPzq7PzS1PyipPxydPxaXPxKTPyqrPx6fPza3PzCxPySlPxiZPzy9Py2tPyGhPzm5PzOzPyenPxubPxWVAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAb0wJZwSCwaj8ik8PBQElGbBKjBgThbmsLFQCIZOhNlSVVqMbpfTKB5JKCEpYbhm0Ewjo/1cDE3vAkbRiUfRA8FdEIbC0UohEQHEWRCDydlQxmBRQ8LEpMaKkQWd4wdHBIBAhsYB0QUrEQKHQYRLA4CKRdEEBqXAScFERQstXlEEioPCiorFSQbFirDAC0mr0IjCgkrDWglcSwAFiIDRJ8mFQ3NBmUhDh4tIiJFDCIN6V0WQgEkLQTyjyc2kGjGb9IiBLyKhDjBoUsFI66OaIgggESDIgpGHZFwguIjBm+SlIAQgYEJAh8YKLjSwkIKBAjZsFQSBAAh+QQJAwArACwAAAAAFAAZAIX8Skz8pqT81tT8fnz8YmT8vrz87uz8kpT8VlT8srT84uT8bmz8ysz8ioz8+vz8npz8UlT8rqz83tz8hoT8amz8xsT89vT8mpz8Xlz8urz86uz8dnT80tT8Tkz8qqz82tz8goT8ZmT8wsT88vT8lpT8Wlz8trT85uT8cnT8zsz8jowAAAD8oqQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG/sCVcEgsGo9IpMIUqRiSxYSKRMBQAhboqpL5LAjVEOiUNEQcpxAYs1GAFEiRQFjAVBer02R0DDyFBxgYIUIfJA5FDg9ZQiMLdogrHgyJF4xCAhsBQw4TkUIOJJeNDHAOFRcFRQ8aRSclKAUoEA8DRREcRRolGAMICAMHrUMpEUQSFwcDJL8EIhlEIwdZIx4UGCwWJggQCCcXRSwpHCAhaiUSDioQHQYNRQoqJiEU5x8rFhsAnUYPIhT1CJSYs0LBAn5FDIDwQEANBoIrHFiYcKSCigFrUhxjgSRBAxRVNA55ANFIAhADQohc8eGAFgYgDqQ4cUIEiT9QLBQ40ICEB4hRWiIiCQIAIfkECQMAKgAsAAAAABQAGQCF/FZU/K6s/IKE/Nrc/G5s/MbE/Jqc/O7s/GJk/Lq8/I6M/Obk/Hp8/NLU/Kak/Pr8/F5c/La0/IqM/OLk/HZ0/M7M/KKk/Pb0/Gps/MLE/JaU/Fpc/LK0/IaE/N7c/HJ0/MrM/J6c/PL0/GZk/L68/JKU/Ors/H58/NbU/KqsAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABvtAlXBILBqJooXoyLykBB2CAMUkPlIFVGe0waSqQhJoQEAgIAFHqHoxXCwjM8SiSnGYg4DqQpFrVA8lHkdiQiYYZx1CBxIPRgENQxUQEBRDHCBGDlRDEQR3i4pFkFYLIBMqFQQUqEQJGUULGx8GAAAddEQNDkUmlCe2JxJFjI5CDxEKJxq2CCUXRRKtjAgWIhUbABsWg0QRESoeDHIFKiS2HBW9UxgYcRAJQgEbCeVFIZ7uZ3qAGRGZxBgEQPCO1xBuRyJokGAGwZohEpYcUWBBAKU/hoYxESEhhAEMCoaU4LRRQ4cMqN4YBKMChIQTHUrAYjnkwYEDxooEAQAh+QQJAwApACwAAAAAFAAZAIX8VlT8rqz8goT82tz8bmz8xsT8mpz87uz8YmT8urz8joz85uT8enz80tT8+vz8qqz8Xlz8trT8ioz84uT8dnT8zsz8oqT89vT8amz8wsT8lpT8Wlz8srT8hoT83tz8cnT8ysz8npz88vT8ZmT8vrz8kpT86uz8fnz81tQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAG/sCUcEgsGocOkkKREB2NFwMHVbBQUE9iqOHpYCiDUyWbQoUGBARi4xEJJtkQSoBRQ0CpicRxdHQuIBAjCBAcQhEkRwd7KQkQhCFCDhIXRh4aQxYQEBJDEXhFAwZIJQSJKQ4cnUUeJUQXHiATIgoAI5VEJh1FCxsfJwAAEA1FbrhCJpvAAAgPRgILRA0KJxrBEJhFIRlDCQgWIhMjABurRCDZEYMQESkeEBsCUBQHARjrFkIeBLtGIRwE7hHKlmLRERMfOCBY16+gqyMWQiiwQ2FIhgRPLlAgIWATgSEdTGTx8KHKiBFOGjzM0iDhAg8pBjAQSSaFiRIUSpSQAKfmCJADE0zwMRIEADs%3D';
		
		var ErrorBox=document.createElement('span');
		ErrorBox.setAttribute('id', 'ErrorBox');
		//ErrorBox.setAttribute('onclick', 'alert(\'Gladiatus Crazy Addon\\nPlease report this bug at apo59m@gmail.com:\\n\\n=========Bug=========\\n\'+document.getElementById(\'BugError\').innerHTML+\'\\nError Link :\'+document.location.href+\'\')');
		ErrorBox.setAttribute('style', 'z-index:3001;position:absolute;top:4px;cursor:pointer;opacity:0.7;left:4px;background-color:white;border:2px solid black;color:black;');
		ErrorBox.innerHTML='<table>'
		+'<tr><td><img src="'+img_error+'"></td>'
		+'<td><b>Gladiatus Crazy Addon</b>'
		+'</td></tr></table>'
		+'<table id="ErrorTable">'
		+'<tr><td colspan="3"><hr/></td></tr>'
		+'<tr><td><b>'+e.name+'</b></td><td>:</td><td>'+e.message+'</td></tr>'
		+'<tr><td><b>Line</b></td><td>:</td><td>'+line+'</td></tr>'
		+'</table>';
		document.body.appendChild(ErrorBox);
		//for (var i in e) alert(i + ' = ' + e[i]);
	}else{
		var ErrorTr=document.createElement('tr');
		ErrorTr.setAttribute('style', 'border-top:1px solid black;');
		ErrorTr.innerHTML='<td colspan="3"><hr/></td>';
		document.getElementById('ErrorTable').appendChild(ErrorTr);
		var ErrorTr=document.createElement('tr');
		ErrorTr.setAttribute('style', 'border-top:1px solid black;');
		ErrorTr.innerHTML='<td><b>'+e.name+'</b></td><td>:</td><td>'+e.message+'</td>';
		document.getElementById('ErrorTable').appendChild(ErrorTr);
		var ErrorTr=document.createElement('tr');
		ErrorTr.innerHTML='<td><b>Line</b></td><td>:</td><td>'+line+'</td>';
		document.getElementById('ErrorTable').appendChild(ErrorTr);
	}
}