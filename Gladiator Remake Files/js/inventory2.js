var shoparray = new Array();

function my_PickFunc() {
	pickObj.x = dd.obj.x;
	pickObj.y = dd.obj.y;
	pickObj.id = dd.obj.id;

	SetToolTip(false);


	var element = document.getElementById(dd.obj.id).parentNode;

	if(element.id == "inv")
	{
		dd.obj.level = 0;
		document.getElementById("inv").style.zIndex = 20;
	}
	else
		document.getElementById("inv").style.zIndex = 10;

	if(element.id == "shop")
		document.getElementById("shop").style.zIndex = 20;
	else if(isNaN(document.getElementById("shop")))
		document.getElementById("shop").style.zIndex = 10;

	if(element.id == "char")
		document.getElementById("char").style.zIndex = 20;
	else
		document.getElementById("char").style.zIndex = 10;

	SwapBlockingfields(true, dd.obj);
	SwapBlockingfieldsShop(true, dd.obj);

	PICK_ITEM = true;
}

function SwapBlockingfieldsShop(state, obj) {
	for (var i = 0; i < aElts.length; i++)
	{
		if (!state)
		{
			if (!(aElts[i].div.innerHTML && aElts[i].iid > 0))
				aElts[i].hide();
			$(aElts[i].div).removeClass('slotAvailable');
			$(aElts[i].div).removeClass('slotUnavailable');
		}
		else
		{
			var point = GetPointByObjShop(aElts[i]);
			if (!point[0])
				continue;
			if (obj.id==aElts[i].id)
			{
				//aElts[i].div.style.border = "dashed #b28b60 1px";
				continue;
			}

			if ((aElts[i].div.innerHTML && aElts[i].iid > 0) || !(aElts[i].contenttypeaccept & obj.contenttype)
				|| (obj.quest > 0) || ( obj.unique > 0 && aElts[i].posi >= 352 && aElts[i].posi <= 357)
			  )
			{
				$(aElts[i].div).addClass('slotUnavailable');
				aElts[i].show();
			}
		}
	}
}

function GetPointByObjShop(obj) {

	var point = new Array(3);
	var x, y = 0;
	var result = false;

	var test = obj.id;
	var tmp = test.split('_');
	var type = tmp[0].substr(1);

	if(type < 512 && type >= 256)
	{
		test = test.substr(3);
		temp = new Array();
		temp = test.split('_');
		x = parseInt(temp[0])-1; y = parseInt(temp[1])-1;
		result = true;
	}

	point[0] = result;
	point[1] = x;
	point[2] = y;

	return point;
}

function my_DropFunc()
{
	var doll = document.getElementById('doll').value;
	var money = 0;
	var money2 = 0;

	var premium = 0;
	var x = 0, y = 0;
	for(var i=0; i < aElts.length;i++) {

		if(isDropTarget(aElts[i],dd.obj))
		{
			var test = aElts[i].id;
			var tmp = test.split('_');
			var type = tmp[0].substr(1);

			var test2 = dd.obj.id;
			var tmp2 = test2.split('_');
			var typeDD = tmp2[0].substr(1);
			// guild storage in/out
			// type: target
			// typeDD: origin
			if( ( type >= 352 && type <= 357) || ( typeDD >= 352 && typeDD <= 357) )
			{
				if( dd.obj.quest > 0) continue;
				if( dd.obj.unique == 1) continue;
				if( !(aElts[i].contenttypeaccept & dd.obj.contenttype)) continue;
				x = parseInt(tmp[1])-1;
				y = parseInt(tmp[2])-1;

				if((( type-typeDD) != 0) && (
								( ( type < C_INT_INVLOC_MERC1) && ( doll > 1) && ( doll < 7))
								||
								( ( type >= C_INT_INVLOC_BAG0) && ( type <= C_INT_INVLOC_BAG4))
								||
								( ( type >= C_INT_INVLOC_HEAD) && ( type <= C_INT_INVLOC_AMUL))))
				{
					if( dd.obj.level > maxLevel) continue;
				}

				// storage out
				if( !( rank == 1 || rank == 2) && (( type-typeDD) != 0)
					&& (
							( ( type < C_INT_INVLOC_MERC1) && ( doll > 1) && ( doll < 7))
							||
							( ( type >= C_INT_INVLOC_BAG0) && ( type <= C_INT_INVLOC_BAG4))
							||
							( ( type >= C_INT_INVLOC_HEAD) && ( type <= C_INT_INVLOC_AMUL))
						)
					)
				{
					switch( typeDD - C_INT_INVLOC_GUILD_STORAGE0)
					{
						case 0 : if( (right &    2) !=    2) continue; break;
						case 1 : if( (right &    8) !=    8) continue; break;
						case 2 : if( (right &   32) !=   32) continue; break;
						case 3 : if( (right &  128) !=  128) continue; break;
						case 4 : if( (right &  512) !=  512) continue; break;
						case 5 : if( (right & 2048) != 2048) continue; break;
					}
				}

				// storage in
				if( !( rank == 1 || rank == 2) && (( type-typeDD) != 0)
					&& (type >= C_INT_INVLOC_GUILD_STORAGE0 && type < C_INT_INVLOC_BAG0))
				{
					switch( typeDD - C_INT_INVLOC_GUILD_STORAGE0)
					{
						case 0 : if( (right &    1) !=    1) continue; break;
						case 1 : if( (right &    4) !=    4) continue; break;
						case 2 : if( (right &   16) !=   16) continue; break;
						case 3 : if( (right &   64) !=   64) continue; break;
						case 4 : if( (right &  256) !=  256) continue; break;
						case 5 : if( (right & 1024) != 1024) continue; break;
					}
				}

				if( (type - C_INT_INVLOC_GUILD_STORAGE0) == (( storageStage -1)/2))
				{
					switch( ( storageStage %2))
					{
						case 0 : storage_col = 6;
								 storage_row = 8;
								 break;
						case 1 :
						default: storage_col = 6;
								 storage_row = 4;
								 break;
					}
				}
				else
				{
					if ( type >= 352 && type <= 357)
					{
						storage_col = 6;
						storage_row = 8;
					}
					else
					{
						storage_col = 8;
						storage_row = 4;
					}
				}

				field = CalcFieldWithObj(dd.obj, type, storage_col, storage_row);
				if(!(field[x][y] & dd.obj.contentsize)) continue;


				//Best?tigung bevor Item Seelengebunden wird.
				if (showUniqueItemAlarm(dd.obj,aElts[i],type,doll,typeDD)) return;

				my_SwapContent (aElts[i],dd.obj);

				newXY(aElts[i]);
				newXY(dd.obj);

				if(type < 256)
					reformEquiped(aElts[i], aElts[i].w, aElts[i].h, true);
				else if(typeDD < 256)
				{
					reformEquiped(dd.obj, aElts[i].w, aElts[i].h, false);
					dd.obj.contentsize = dd.obj.contentsizebase;
					newXY(dd.obj);
				}
				aElts[i].maximizeZ();

				sendRequest('get', 'ajax/guildstorageswap.php', 'old='+ dd.obj.id +'&new='+aElts[i].id+'&doll='+doll);

				tt_Init(1);
				break;
			}


			//if(aElts[i].iid && type < 256 && typeDD > 256 && typeDD < 512) continue;
			if(aElts[i].iid && type < 256 && !dd.obj.enchanttype) continue;
			if(aElts[i].iid && (type < 256 || type >= 512) && dd.obj.enchanttype && typeDD >= 256 && typeDD < 512) continue;
			//Crafting
			if (checkCrafting(dd.obj,aElts[i],typeDD, type)) return;
			//Enchanten
			if(checkEnchant(dd.obj, aElts[i],type)) return;

			//Ins Inventar
			if(type >= 512)
			{
				x = parseInt(tmp[1])-1;
				y = parseInt(tmp[2])-1;
				field = CalcFieldWithObj(dd.obj, type, maxcols, maxrows);
				if(!(field[x][y] & dd.obj.contentsize)) continue;
			}

			//Pr?fen ob genug Ressourcen vorhanden beim Kauf
			if((type >= 512 || type < 256) && typeDD > 256 && typeDD < 512)
			{
				if(res1 < dd.obj.preis) continue;
				if(res2 < dd.obj.preis2) continue;
			}

			//In den Shop
			if(type == aktShopPage)
			{
				temp = new Array();
				temp = test.split('_');
				x = parseInt(temp[1])-1; y = parseInt(temp[2])-1;

				field = CalcFieldWithObj(dd.obj, aktShopPage, 6, 8);
				if(aElts[i].iid > 0) continue;
				if(!(field[x][y] & dd.obj.contentsize)) continue;
				if(dd.obj.quest > 0) continue;
			}

			if(!(aElts[i].contenttypeaccept & dd.obj.contenttype)) continue;

			if(type == aktShopPage && (typeDD >= 512 || typeDD < 256))	//Verkaufen
				money = dd.obj.preis;
			else if((type >= 512 || type < 256) && typeDD == aktShopPage) //Kaufen
			{
				money = -dd.obj.preis;
				money2 = -dd.obj.preis2;
			}

			if(money != 0 || money2 != 0)
			{
				x = aElts[i].x;
                x -= (75 - (dd.obj.w / 2));
				y = aElts[i].y;
				premium = dd.obj.premium;
				changeDraggable(false);
			}

			//Best?tigung bevor Item Seelengebunden wird.
			if (showUniqueItemAlarm(dd.obj,aElts[i],type,doll,typeDD)) return;

			my_SwapContent (aElts[i],dd.obj);

			newXY(aElts[i]);
			newXY(dd.obj);
			if(type < 256)
				reformEquiped(aElts[i], aElts[i].w, aElts[i].h, true);
			else if(typeDD < 256)
			{
				reformEquiped(dd.obj, aElts[i].w, aElts[i].h, false);
				dd.obj.contentsize = dd.obj.contentsizebase;
				newXY(dd.obj);
			}
			aElts[i].maximizeZ();

            var inventoryParam = '';
            // Shop
            if (aktShopPage >= 256 && aktShopPage <= 338)
                inventoryParam = '&shopPage='+aktShopPage;
            // Guildstorage
            else if (aktShopPage >= 352 && aktShopPage <= 357)
                inventoryParam = '&guildStoragePage='+aktShopPage;

			sendRequest('get', 'ajax/inventoryswap.php', 'old='+ dd.obj.id +'&new='+aElts[i].id+'&doll='+doll+inventoryParam);

			tt_Init(1);
			break;
		}
	}

 	dd.obj.moveTo(pickObj.x, pickObj.y);

	SwapBlockingfields(false);
//	SwapBlockingfieldsShop(false);
	changeShow();
	SetToolTip(true);
	PICK_ITEM = false;

    if(money != 0 || money2 != 0)
	{
        pling.currency(money, money2, x, y);
	}

}

function my_DragFunc()
{
	return;
}

function checkBuy()
{
	/*for(var i=0; i < aElts.length;i++)
	{
		var test = aElts[i].id;
		var tmp = test.split('_');
		var type = tmp[0].substr(1);

		if(type > 256 && type < 512 && aElts[i].iid > 0)
		{
			//im Shop
			if(goldUser < aElts[i].preis)
				aElts[i].setDraggable(false);
			else
				aElts[i].setDraggable(true);
		}
	}*/
}

function selectDoll(link)
{
	document.location.href = link;
}

function selectTask(doll, task)
{
	sendRequest('get', 'ajax/selectTask.php', 'doll='+doll+'&task='+task);
}