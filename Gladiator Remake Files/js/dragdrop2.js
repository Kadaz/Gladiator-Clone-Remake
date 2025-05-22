var showAlert = '';
var targetDoll = 0;
var targetObj = null;
var ddObject = null;
var confirmNeeded;
var confirmed;

function InvAddCharDiv(div,cols,rows) {
	for(var i=1;i<=cols;i++) {
		for(var j=1;j<=rows;j++) {
			var x=(i-1)*32;
			var y=(j-1)*32;
			AddCharDiv("p"+div+"_"+i+"_"+j, x, y, 1, 1, 1, 0xFFFF, 0, 0, 0, 0, 0,0,0,0,0,"");
		}
	}
}

function InvAddShopDiv(div,cols,rows,accept) {
	for(var i=1;i<=cols;i++) {
		for(var j=1;j<=rows;j++) {
			var x=(i-1)*32;
			var y=(j-1)*32;
			AddCharDiv("p"+div+"_"+i+"_"+j, x, y, 1, 1, 1, accept, 0, 0, 0, 0, 0,0,0,0,0,"");
		}
	}
}



function AddCharDiv(name,x,y,typ,size,bsize,taccept,iid,preis,preis2,premium,quest,enchtype,unique,level,quality,tooltip, diff) {

    var e = document.getElementById(name);

	e.ddObj.defx = e.ddObj.x = e.ddObj.cssx = 0;
	e.ddObj.defy = e.ddObj.y = e.ddObj.cssy = 0;
	e.ddObj.moveBy(x,y);
	e.ddObj.contenttype=typ;
	e.ddObj.contentsize=size;
	e.ddObj.contentsizebase=bsize;
	e.ddObj.contenttypeaccept=taccept;
	e.ddObj.enchanttype = enchtype;
	e.ddObj.iid=iid;
	e.ddObj.preis=preis;
	e.ddObj.preis2=preis2;
	e.ddObj.premium=premium;
	e.ddObj.quest=quest;
	e.ddObj.tooltip=tooltip;
    e.ddObj.compare=diff;
	e.ddObj.unique=unique;
	e.ddObj.maximizeZ();
	e.ddObj.level = level;
    e.ddObj.quality = quality;
    newXY(e.ddObj);
}

function SetToolTip(state) {
return;
	var flag = (state)?'visible':'hidden';
	document.getElementById('tt2').style.visibility = flag;
	document.getElementById('tt3').style.visibility = flag;
}

function GetPointByObj(obj) {

	var point = new Array(3);
	var x, y = 0;
	var result = false;

	var test = obj.id;
	var tmp = test.split('_');
	var type = tmp[0].substr(1);

	if(type >= 512)
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

function my_SwapContent(from, to)
{
    var clone = to.div.cloneNode(true);
	var tmp = null;
	while(to.div.childNodes.length) to.div.removeChild(to.div.firstChild);
    cloneNodes(from.div, to.div);

    while(from.div.childNodes.length) from.div.removeChild(from.div.firstChild);
    cloneNodes(clone, from.div);

    //old = to.div.innerHTML;		to.div.innerHTML = from.div.innerHTML;	from.div.innerHTML = old;
	old = to.hasHighlightDiv;   to.hasHighlightDiv = from.hasHighlightDiv;		from.hasHighlightDiv = old;
	old = to.contentsize;		to.contentsize = from.contentsize;		from.contentsize = old;
    old = to.contenttype;		to.contenttype = from.contenttype;		from.contenttype = old;
    old = to.enchanttype;		to.enchanttype = from.enchanttype;		from.enchanttype = old;
    old = to.tooltip;			to.tooltip = from.tooltip;				from.tooltip = old;

    old = to.iid;				to.iid = from.iid;						from.iid = old;
    old = to.preis;				to.preis = from.preis;					from.preis = old;
    old = to.preis2;			to.preis2 = from.preis2;				from.preis2 = old;
    old = to.premium;			to.premium = from.premium;				from.premium = old;
    old = to.unique;			to.unique = from.unique;				from.unique = old;
    old = to.level;  			to.level = from.level;				    from.level = old;
	old = to.quest;  			to.quest = from.quest;				    from.quest = old;
    old = to.quality;  			to.quality = from.quality;				from.quality = old;
}

function cloneNodes(from, to)
{
    var child = from.firstChild;

    while(child != null)
    {
        tmp = child.cloneNode(true);
        if (tmp.id != "")
        {
            var idzusatz  = tmp.id
            idzusatz = idzusatz.replace(from.id, "");
            tmp.id = to.id + idzusatz;
        }
        to.appendChild(tmp);
        child = child.nextSibling;
    }
}

function SwapBlockingfields(state, obj)
{
	for (var i=0; i < aElts.length;i++)
    {

		if ($(aElts[i].div).hasClass('slotAvailable') == true)
			continue;
		if (aElts[i].id == 'playerface')
			continue;

		if (!state)
			$(aElts[i].div).removeClass('slotUnavailable');
		else
		{
			var point = GetPointByObj(aElts[i]);
			if (!point[0]) continue;
			if (obj.id==aElts[i].id)
			{
				//aElts[i].div.style.border = "dashed #b28b60 1px";
				continue;
			}
			if (!(aElts[i].div.innerHTML || aElts[i].iid > 0))
				continue;

			$(aElts[i].div).addClass('slotUnavailable');
		}
	}
}

function reformEquiped(obj, width, height, drop)
{
	var left = 0;
	var top = 0;

	switch(obj.contentsizebase)
	{
		case 16:
			left = (64 - width) / 2;
			top =  (64 - height) / 2;
			break;
		case 32:
			left = (64 - width) / 2;
			top = (96 - height) / 2;
			break;
	}

	if(!drop)
	{
		left = -(left);
		top = -(top);
		pickObj.x += left;
		pickObj.y += top;
	}

	obj.moveBy(left, top);
}

function changeShow()
{
	for(var i=0; i < aElts.length;i++)
	{
		if(aElts[i].id == "playerface") continue;
		if(!(aElts[i].div.innerHTML || aElts[i].iid > 0))
		{
			aElts[i].hide();
		}
		else
		{
			aElts[i].show();
		}
	}
}

function CalcFieldWithObj(obj, filterType, myCols, myRows) {
	var rows = myCols;
	var cols = myRows;
	var x, y, i = 0;
	var fieldblockval = 'X';

	var field = new Array(rows+3);
	for (i=0; i < field.length; i++ ) field[i] = new Array(cols+3);

	for( i=0; i < aElts.length; i++) {

		var test = aElts[i].id;
		if(obj != null)
			if(test == obj.id) continue;

		var tmp = test.split('_');
		var type = tmp[0].substr(1);

		if(type != filterType) continue;
		if(!aElts[i].div.innerHTML && !(aElts[i].iid > 0)) continue;

		temp = new Array();
		temp = test.split('_');
		x = parseInt(temp[1])-1; y = parseInt(temp[2])-1;



		switch (aElts[i].contentsize) {
		case 1:
			field[x][y] = fieldblockval; break;
		case 2:
			field[x][y] = field[x][y+1] = fieldblockval; break;
		case 4:
			field[x][y] = field[x+1][y] = fieldblockval; break;
		case 8:
			field[x][y] = field[x][y+1] = field[x][y+2] = fieldblockval; break;
		case 16:
			field[x][y] = fieldblockval;
			field[x][y+1] = fieldblockval;
			field[x+1][y] = fieldblockval;
			field[x+1][y+1] = fieldblockval;
			break;
		case 32:
			field[x][y] = fieldblockval;
			field[x][y+1] = fieldblockval;
			field[x+1][y] = fieldblockval;
			field[x+1][y+1] = fieldblockval;
			field[x][y+2] = fieldblockval;
			field[x+1][y+2] = fieldblockval;
			break;
		}

	}

	// nutzbares feld mit 0 fuellen
	for(x=0;x < rows;x++) for(y=0;y < cols;y++) if(field[x][y]!=fieldblockval) field[x][y]=0;

	var v=0;

	for(x=0;x < rows;x++) {
		for(y=0;y < cols;y++) {
			if(field[x][y]==fieldblockval) continue; // is was drin
			v = 1;
			x1y = (field[x+1][y]	==0);
			x1y1 = (field[x+1][y+1]	==0);
			xy1 = (field[x][y+1]	==0);
			x1y2 = (field[x+1][y+2]	==0);
			xy2 = (field[x][y+2]	==0);

			if(xy1) v+=2;
			if(x1y) v+=4;
			if(xy1 && xy2) v+=8;
			if(x1y && xy1 && x1y1) v+=16;
			if(x1y && xy1 && x1y1 && xy2 && x1y2) v+=32;

			field[x][y]=v;
		}
	}
	return field;
}

//TODO
function newXY(obj) {

	var newx = 32;
	var newy = 32;
	var val  = obj.contentsize;

//	if(obj.contentsizebase>1) val = obj.contentsizebase;

	switch(val) {
	case 0:
		break;
	case 1:
		break;
	case 2:
		newy = 2*32;
		break;
	case 4:
		newx = 2*32;
		break;
	case 8:
		newy = 3*32;
		break;
	case 16:
		newx = 2*32;
		newy = 2*32;
		break;
	case 32:
		newx = 2*32;
		newy = 3*32;
		break;
	}
	obj.css.width	=newx + 'px';
	obj.w	=newx;
	obj.css.height	=newy + 'px';
	obj.h	=newy;
}

function calcX(obj)
{
	var newx = 32;
	var newy = 32;
	var val  = obj.contentsize;

	if(obj.contentsizebase>1) val = obj.contentsizebase;

	switch(val) {
	case 0:
		break;
	case 1:
		break;
	case 2:
		newy = 2*32;
		break;
	case 4:
		newx = 2*32;
		break;
	case 8:
		newy = 3*32;
		break;
	case 16:
		newx = 2*32;
		newy = 2*32;
		break;
	case 32:
		newx = 2*32;
		newy = 3*32;
		break;
	}
	return newx;
}

function calcY(obj)
{
	var newx = 32;
	var newy = 32;
	var val  = obj.contentsize;

	if(obj.contentsizebase>1) val = obj.contentsizebase;

	switch(val) {
	case 0:
		break;
	case 1:
		break;
	case 2:
		newy = 2*32;
		break;
	case 4:
		newx = 2*32;
		break;
	case 8:
		newy = 3*32;
		break;
	case 16:
		newx = 2*32;
		newy = 2*32;
		break;
	case 32:
		newx = 2*32;
		newy = 3*32;
		break;
	}
	return newy;
}

function print_r(theObj){
  if(theObj.constructor == Array ||
     theObj.constructor == Object){

     var s = "";

    //document.write("<ul>")
    s += "+\n";
    for(var p in theObj){
      if(theObj[p].constructor == Array||
         theObj[p].constructor == Object){
		//document.write("<li>["+p+"] => "+typeof(theObj)+"</li>");
		s += "-["+p+"] => "+typeof(theObj);
        //document.write("<ul>")
        s += "  ";
        s += print_r(theObj[p]);
        //document.write("</ul>")
        s += "\n";
      } else {
		//document.write("<li>["+p+"] => "+theObj[p]+"</li>");
		s += "\t["+p+"] => "+theObj[p] + "\n";
      }
    }
    //document.write("</ul>")
    //s += "\n";
  }
  return s;
}

function changeDraggable(state)
{
	for( i=0; i < aElts.length; i++)
	{
		if(aElts[i].iid > 0 && aElts[i].div.innerHTML)
		{
			aElts[i].setDraggable(state);
		}
	}
}

// usage: format_zahl( number [, number]  [, bool]  )
function formatZahl(zahl, k, fix)
{
    if(!k) k = 0;
    var neu = '';
    // Runden
    var f = Math.pow(10, k);
    zahl = '' + parseInt( zahl * f + (0.5 * (zahl > 0 ? 1 : -1)) ) / f ;
    // Komma ermittlen
    var idx = zahl.indexOf('.');
    // fehlende Nullen einf�gen
    if(fix)
    {
         zahl += (idx == -1 ? '.' : '' )
         + f.toString().substring(1);
    }
    // Nachkommastellen ermittlen
    idx = zahl.indexOf('.');
    if( idx == -1) idx = zahl.length;
    else neu = ',' + zahl.substr(idx + 1, k);

    // Tausendertrennzeichen
    while(idx > 0)
    {
        if(idx - 3 > 0)
        neu = '.' + zahl.substring( idx - 3, idx) + neu;
        else
        neu = zahl.substring(0, idx) + neu;
        idx -= 3;
    }
    return neu;
}


function isDropTarget(target, ddObj)
{
		var targetId = target.id;
		var tmp = targetId.split('_');
		var targetType = parseInt(tmp[0].substr(1));
		if(
			ddObj.id != target.id &&
			targetType > 15 &&
			target.id != 'p8_1_1' &&
			ddObj.x >= target.x - 16 &&
			ddObj.x <  target.x + (target.w-16) &&
			ddObj.y >= target.y - 16 &&
			ddObj.y <  target.y + (target.h-16) &&
			ddObj.div.innerHTML
		)
		return true;

		var ddMidx = Math.round(ddObj.x + (ddObj.w/2));
		var ddMidy = Math.round(ddObj.y + (ddObj.h/2));
		if(
			ddObj.id != target.id &&
			target.id != 'p8_1_1' &&
			ddMidx >= target.x &&
			ddMidx <  target.x + target.w &&
			ddMidy >= target.y &&
			ddMidy <  target.y + target.h &&
			ddObj.div.innerHTML
		)
		return true;

		if(
			ddObj.id != target.id &&
			target.id == 'p8_1_1' &&
			ddObj.x >= target.x &&
			ddObj.x < target.x + target.w &&
			ddObj.y >= target.y &&
			ddObj.y < target.y + target.h &&
			ddObj.div.innerHTML
		)
		return true;

		return false;

}

function checkCrafting(ddObj, targetObj, typeDD, type)
{
	if (ddObj.contenttype != 64 || targetObj.contenttype != 64) return false;
	if (typeDD < 512) return false;
	if (type < 512) return false;

	if(!targetObj.iid || !ddObj.iid) return false;
	if (isNaN (type)) return false;

	changeShow();
	SwapBlockingfields(false);
	SetToolTip(true);
	PICK_ITEM = false;
	changeDraggable(false);

	dd.elements[ddObj.name].hide();
 	ddObj.moveTo(pickObj.x, pickObj.y);
	pickObj.x = targetObj.x;
	pickObj.y = targetObj.y;
	sendRequest('get', 'ajax/crafting.php', 'bItem='+targetObj.iid+'&item='+ddObj.iid);
	return true;
}

function showUseItemAlarm(ddObj,targetObj,type,doll,typeDD, blackOutDialogID)
{

		if (showAlert != ddObj.id)
		{
			showAlert = ddObj.id;
			targetDoll = doll;
			targetObject = targetObj;
			ddObject = ddObj;
			itemType = type;
			itemTypeDD = typeDD
			blackoutDialogDD(true,('blackoutDialog'+blackOutDialogID),350);
			return true;
		}
		return false;

}

function showUniqueItemAlarm(ddObj,targetObj,type,doll,typeDD)
{
	if (showAlert)
	{
		return true;
	}
	if (type == 2 || type == 3 || type == 4 || type == 5 || type == 6 || type == 7 || type == 9 || type == 10 || type == 11)
	{
		if (showAlert != ddObj.id && ddObj.unique == 0)
		{
			showAlert = ddObj.id;
			targetDoll = doll;
			targetObject = targetObj;
			ddObject = ddObj;
			itemType = type;
			itemTypeDD = typeDD
			blackoutDialogDD(true,'blackoutDialogsoulboundConfirm',350);
			return true;
		}
		return false;
	}
	//alert('TEST2 type: '+type);
	return false;
}

function checkEnchant(ddObj, targetObj, type)
{
	if(targetObj.iid && !ddObj.enchanttype) return false;
	if(type >= 256 && type < 512) return false;
	if(!targetObj.iid) return false;
	if (isNaN (type)) return false;

	if(!(targetObj.contenttype & ddObj.enchanttype)) return false;

	changeShow();
	SwapBlockingfields(false);
	SetToolTip(true);
	PICK_ITEM = false;
	changeDraggable(false);

	dd.elements[ddObj.name].hide();
 	ddObj.moveTo(pickObj.x, pickObj.y);
	pickObj.x = targetObj.x;
	pickObj.y = targetObj.y;
	var doll = (document.getElementById("plDoll") ? document.getElementById("plDoll").value : 1);
	var index = targetObj.id.indexOf("_");
	var pos = targetObj.id.substring(1,index);
	sendRequest('get', 'ajax/enchantItem.php', 'ench='+ ddObj.id +'&item=' + targetObj.id + '&doll='+doll);
	return true;

}

function getPositionType(ddObjId)
{
    var tmp = ddObjId.split('_');
    return tmp[0].substr(1);
}

function getPositionX(ddObjId)
{
    var tmp = ddObjId.split('_');
    return parseInt(tmp[1]);
}

function getPositionY(ddObjId)
{
    var tmp = ddObjId.split('_');
    return parseInt(tmp[2]);
}

function my_tmpDropFunc(ddObj, targetObj ,doll)
{
	if(isDropTarget(targetObj, ddObj) || confirmed)
	{
        var typeTarget = getPositionType(targetObj.id);
        var typeDD = getPositionType(ddObj.id);

		// Item-Types to Confirm using
		toConfirm = new Array();
		//toConfirm.push(new Array(32768, 'confirmCostume'));

        //Itembox
        if (typeTarget == 384)
        {
            onDropOnItembox(ddObj, targetObj)
            return "break";
        }

        if (typeDD == 384 && onDropFromItembox(ddObj, targetObj))
            return "break";

        //Essen
		if(typeTarget == 8)
		{
			ddObj.moveTo(pickObj.x, pickObj.y);
			SwapBlockingfields(false);
			changeShow();
			SetToolTip(true);
			PICK_ITEM = false;

			// Gurt, Style
			if(ddObj.contenttype == 64 || ddObj.contenttype == 32768)
			{
				// If a Confirmation needed, not confirmed an the type requires a confirmation...
				if (confirmNeeded && !confirmed && in_multi_array(toConfirm, ddObj.contenttype))
				{
					// Get the correct BlackOutDialogBox (Defined in array).
					for (key in toConfirm)
					{
						if (ddObj.contenttype == toConfirm[key][0])
						{
							blackOutDialogBoxToUse = toConfirm[key][1];
							if (showUseItemAlarm(ddObj,targetObj,typeTarget,doll,typeDD,blackOutDialogBoxToUse))
								return "return";
						}
					}
				}

				//Verbrauchen
				dd.elements[ddObj.name].hide();
			 	targetObj.div.style.cursor = 'wait';
			 	changeDraggable(false);
				ddObj.moveTo(pickObj.x, pickObj.y);
				doll = document.getElementById('plDoll').value;
				sendRequest('get', 'ajax.php', 'mod=overview&submod=useItem&item='+ ddObj.id +'&doll='+doll);
			}
			return "return";
		}

		//Crafting
		if (checkCrafting(ddObj,targetObj,typeDD,typeTarget))
            return "return";

		//Enchanten
		if (targetObj.iid && typeTarget < 256 && !ddObj.enchanttype)
            return "continue";
		if (checkEnchant(ddObj, targetObj, typeTarget))
            return "return";

		//Ins Inventar
		if (typeTarget >= 512)
		{
			x = getPositionX(targetObj.id)-1;
			y = getPositionY(targetObj.id)-1;
			field = CalcFieldWithObj(ddObj, typeTarget, maxcols, maxrows);
			if(!(field[x][y] & ddObj.contentsize))
                return "continue";
		}

		if(!(targetObj.contenttypeaccept & ddObj.contenttype))
            return "continue";

		//Bestätigung bevor Item Seelengebunden wird.
		if (showUniqueItemAlarm(ddObj,targetObj,typeTarget,doll,typeDD))
            return "return";

		my_SwapContent (targetObj,ddObj);
		newXY(targetObj);
		newXY(ddObj);
		if(typeTarget < 256)
			reformEquiped(targetObj, targetObj.w, targetObj.h, true);
		else if(typeDD < 256)
		{
			reformEquiped(ddObj,targetObj.w, targetObj.h, false);
			ddObj.contentsize = ddObj.contentsizebase;
			newXY(dd.obj);
		}
		targetObj.maximizeZ();
		//aElts[i].div.style.zindex = 200;

		// Pruefen ob von Lager verschoben wird
		var from = ddObj.id.substring(1, 4);
		var storage = false;
		if (from >= 352 &&  from <= 357)
			storage = true;
		if (storage)
			sendRequest('get', 'ajax/guildstorageswap.php', 'old='+ ddObj.id +'&new='+targetObj.id+'&doll='+doll);
		else
			sendRequest('get', 'ajax/inventoryswap.php', 'old='+ ddObj.id +'&new='+targetObj.id+'&doll='+doll);
		tt_Init(1);
		return "break";
	}
}

function in_array(haystack, needle)
{
	for (var i = 0; i < haystack.length; i++)
	{
		if (haystack[i] == needle)
		{
			return true;
		}
	}
	return false;
}

function in_multi_array(haystack, needle)
{
    if(in_array(haystack, needle))
    {
        return true;
    }
    else
    {
        for (var i = 0; i < haystack.length; i++)
        {
			if (haystack[i] instanceof Array)
            {
                if(in_multi_array(haystack[i]), needle)
                {
					return true;
                }
            }
        }
    }
    return false;
}


INIT_DHTML = false;