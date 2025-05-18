var shoparray = new Array();

var ddContainer = ['inv', 'char', ''];

function my_PickFunc()
{
	pickObj.x = dd.obj.x;
	pickObj.y = dd.obj.y;
	pickObj.id = dd.obj.id;
	pickObj.w = dd.obj.w;
	pickObj.h = dd.obj.h;
	pickObj.contentsize = dd.obj.contentsize;
	pickObj.preis = dd.obj.preis;
	pickObj.iid = dd.obj.iid;

	SetToolTip(false);

	var element = document.getElementById(dd.obj.id).parentNode;

    ddContainer.each(function(item, index)
    {
        if(element.id == item)
        {
            document.getElementById(item).style.zIndex = 50;
        }
        else if(isNaN(document.getElementById(item)))
        {
            document.getElementById(item).style.zIndex = 40;
        }
    });
/*
	if(element.id == "inv")
		document.getElementById("inv").style.zIndex = 20;
	else
		document.getElementById("inv").style.zIndex = 10;

	if(element.id == "char")
		document.getElementById("char").style.zIndex = 20;
	else
		document.getElementById("char").style.zIndex = 10;
*/
	SwapBlockingfields(true, dd.obj);

	PICK_ITEM = true;
}

function my_DropFunc() {
	var doll = document.getElementById('doll').value;
	for(var i=0; i < aElts.length;i++) {
		erg = my_tmpDropFunc(dd.obj, aElts[i],doll);
		if (erg=="continue") continue;
		else if (erg == "return" )return;
		else if (erg=="break")break;
		/* if(isDropTarget(aElts[i], dd.obj))
		{
			var test = aElts[i].id;
			var tmp = test.split('_');
			var type = tmp[0].substr(1);

			var test2 = dd.obj.id;
			var tmp2 = test2.split('_');
			var typeDD = tmp2[0].substr(1);

			//if(aElts[i].iid && type < 256 && typeDD > 256 && typeDD < 512) continue;

			if(type == 8)
			{
				dd.obj.moveTo(pickObj.x, pickObj.y);
				SwapBlockingfields(false);
				changeShow();
				SetToolTip(true);
				PICK_ITEM = false;

				if(dd.obj.contenttype == 64)
				{
					//Verbrauchen
					dd.elements[dd.obj.name].hide();
				 	aElts[i].div.style.cursor = 'wait';
				 	changeDraggable(false);
					dd.obj.moveTo(pickObj.x, pickObj.y);
					doll = document.getElementById('plDoll').value;
					sendRequest('get', 'ajax/useitem.php', 'item='+ dd.obj.id +'&doll='+doll);
				}
				return;
			}
			
			if(aElts[i].iid && type < 256 && !dd.obj.enchanttype) continue;
			
			//Crafting
			if (checkCrafting(dd.obj,aElts[i],type)) return;
			
			//Enchanten
			if(checkEnchant(dd.obj, aElts[i], type)) return;

			
			//Ins Inventar
			if(type >= 512)
			{
				x = parseInt(tmp[1])-1;
				y = parseInt(tmp[2])-1;
				field = CalcFieldWithObj(dd.obj, type, maxcols, maxrows);
				if(!(field[x][y] & dd.obj.contentsize)) continue;
			}

			if(!(aElts[i].contenttypeaccept & dd.obj.contenttype)) continue;

			//Bestätigung bevor Item Seelengebunden wird.
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
			//aElts[i].div.style.zindex = 200;

			sendRequest('get', 'ajax/inventoryswap.php', 'old='+ dd.obj.id +'&new='+aElts[i].id+'&doll='+doll);

			tt_Init(1);
			break;
		}
			*/
	}
 	dd.obj.moveTo(pickObj.x, pickObj.y);
	SwapBlockingfields(false);
	changeShow();
	SetToolTip(true);
	PICK_ITEM = false;
}

function my_DragFunc()
{
	return;
}

function selectDoll(link)
{
	document.location.href = link;
}

function selectTask(doll, task)
{
	sendRequest('get', 'ajax/selectTask.php', 'doll='+doll+'&task='+task);
}