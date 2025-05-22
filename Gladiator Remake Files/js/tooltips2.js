/* This notice must be untouched at all times.

wz_tooltip.js    v. 3.25

The latest version is available at
http://www.walterzorn.com
or http://www.devira.com
or http://www.walterzorn.de

Copyright (c) 2002-2003 Walter Zorn. All rights reserved.
Created 1. 12. 2002 by Walter Zorn (Web: http://www.walterzorn.com )
Last modified: 21. 4. 2004

Cross-browser tooltips working even in Opera 5 and 6,
as well as in NN 4, Gecko-Browsers, IE4+, Opera 7 and Konqueror.
No onmouseouts required.
Appearance of tooltips can be individually configured
via commands within the onmouseovers.

This program is free software;
you can redistribute it and/or modify it under the terms of the
GNU General Public License as published by the Free Software Foundation;
either version 2 of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY;
without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License
at http://www.gnu.org/copyleft/gpl.html for more details.

*/

/*
Modified by Christian Neise. Copyright of the modifications (c) 2004 by Christian Neise. For the original Version by Walter Zorn downlaod wz_tooltip.js from the same directory.
*/



////////////////  GLOBAL TOOPTIP CONFIGURATION  /////////////////////
var ttDelay        = 50;          // time span until tooltip shows up [milliseconds]
var ttOffsetX      = 8;           // horizontal offset of left-top corner from mousepointer
var ttOffsetY      = 19;          // vertical offset                   "
var ttShadowColor  = '';          // NN4 only
var ttShadowWidth  = 0;
var ttWidth        = 50;
var ttManualBr     = true;        // Do not automatically insert line feeds (turn off when using shadows)
////////////////////  END OF TOOLTIP CONFIG  ////////////////////////



//////////////  TAGS WITH TOOLTIP FUNCTIONALITY  ////////////////////
// List may be extended or shortened:
var tt_tags = new Array('a','area', 'b','center','div','em','h1','h2','h3','i','img','li','ol','pre','span','sub','sup','table','td','th','tr','tt','u','ul');
/////////////////////////////////////////////////////////////////////



///////// DON'T CHANGE ANYTHING BELOW THIS LINE /////////////////////
var tt_obj,                // current tooltip
tt_objW = 0, tt_objH = 0,  // width and height of tt_obj
tt_objX = 0, tt_objY = 0,
tt_offX = 0, tt_offY = 0,
xlim = 0, ylim = 0,        // right and bottom borders of visible client area
tt_above = false,          // true if T_ABOVE cmd
tt_static = false,         // tt_obj static?
tt_sticky = false,         // tt_obj sticky?
tt_wait = false,
tt_vis = false,            // tooltip visibility flag
tt_dwn = false,            // true while tooltip below mousepointer
tt_u = 'undefined',
tt_inputs = new Array();   // drop-down-boxes to be hidden in IE


var tt_db = (document.compatMode && document.compatMode != 'BackCompat')? document.documentElement : document.body? document.body : null,
tt_n = navigator.userAgent.toLowerCase();

// Browser flags
var tt_op = !!(window.opera && document.getElementById),
tt_op6 = tt_op && !document.defaultView,
tt_ie = tt_n.indexOf('msie') != -1 && document.all && tt_db && !tt_op,
tt_n4 = (document.layers && typeof document.classes != "undefined"),
tt_n6 = (!tt_op && document.defaultView && typeof document.defaultView.getComputedStyle != "undefined"),
tt_w3c = !tt_ie && !tt_n6 && !tt_op && document.getElementById;

tt_n = '';


function tt_Int(t_x)
{
	var t_y;
	return isNaN(t_y = parseInt(t_x))? 0 : t_y;
}


function wzReplace(t_x, t_y)
{
	var t_ret = '',
	t_str = this,
	t_xI;
	while ((t_xI = t_str.indexOf(t_x)) != -1)
	{
		t_ret += t_str.substring(0, t_xI) + t_y;
		t_str = t_str.substring(t_xI + t_x.length);
	}
	return t_ret+t_str;
}
String.prototype.wzReplace = wzReplace;


function tt_N4Tags(tagtyp, t_d, t_y)
{
	t_d = t_d || document;
	t_y = t_y || new Array();
	var t_x = (tagtyp=='a')? t_d.links : t_d.layers;
	for (var z = t_x.length; z--;) t_y[t_y.length] = t_x[z];
	for (var z = t_d.layers.length; z--;) t_y = tt_N4Tags(tagtyp, t_d.layers[z].document, t_y);
	return t_y;
}


function tt_GetSelects()
{
	if (!tt_op6 && !tt_ie) return;
	var t_s = tt_op6? 'input' : 'select';
	if (document.all)
	{
		var t_i = document.all.tags(t_s).length; while (t_i--)
			tt_inputs[t_i] = document.all.tags(t_s)[t_i];
	}
	else if (document.getElementsByTagName)
	{
		var t_i = document.getElementsByTagName(t_s).length; while (t_i--)
			tt_inputs[t_i] = document.getElementsByTagName(t_s)[t_i];
	}
	var t_i = tt_inputs.length; while (t_i--)
	{
		tt_inputs[t_i].x = 0;
		tt_inputs[t_i].y = 0;
		var t_o = tt_inputs[t_i];
		while (t_o)
		{
			tt_inputs[t_i].x += t_o.offsetLeft || 0;
			tt_inputs[t_i].y += t_o.offsetTop|| 0;
			t_o = t_o.offsetParent;
		}
	}
}


function tt_Htm(tt, t_id, txt)
{
	var
	t_shc     = (typeof tt.T_SHADOWCOLOR != tt_u)? tt.T_SHADOWCOLOR : (ttShadowColor || 0),
	t_shw     = (typeof tt.T_SHADOWWIDTH != tt_u)? tt.T_SHADOWWIDTH : (ttShadowWidth || 0),
	t_tit     = (typeof tt.T_TITLE != tt_u)? tt.T_TITLE : '',
	t_w       = (typeof tt.T_WIDTH != tt_u)? tt.T_WIDTH  : ttWidth;
    t_br      = (typeof tt.T_MANUAL_BR != tt_u)? tt.T_MANUAL_BR  : ttManualBr;

	if (t_shc || t_shw)
	{
		t_shc = t_shc || '#cccccc';
		t_shw = t_shw || 3;
	}

	var t_y = '<div id="' + t_id + '" style="position:absolute;z-index:1010;';
	t_y += 'left:0px;top:0px;visibility:' + (tt_n4? 'hide' : 'hidden') + ';">';
	t_y += '<table border="0" cellpadding="0" cellspacing="0" width="' + t_w + '">';
	if (t_tit)
	{
		t_y += '<tr><td style="padding-left:3px;" class="tooltip_title">';
		t_y += t_tit + '<\/td><\/tr>';
	}
	t_y += '<tr><td><table width="100%">';
	t_y += '<tr><td>';
	t_y += txt;
	t_y += '<\/td><\/tr><\/table><\/td><\/tr><\/table>';
	if (t_shw)
	{
		var t_spct = Math.round(t_shw*1.3);
		if (tt_n4)
		{
			t_y += '<layer class="bgcolor="' + t_shc + '" left="' + t_w + '" top="' + t_spct + '" width="' + t_shw + '" height="0"><\/layer>';
			t_y += '<layer bgcolor="' + t_shc + '" left="' + t_spct + '" align="bottom" width="' + (t_w-t_spct) + '" height="' + t_shw + '"><\/layer>';
		}
		else
		{
			var t_opa = tt_n6? '-moz-opacity:0.85;' : tt_ie? 'filter:Alpha(opacity=85);' : '';
			t_y += '<div id="' + t_id + 'R" class="tooltip_shadow" style="position:absolute;left:' + t_w + 'px;top:' + t_spct + 'px;width:' + t_shw + 'px;height:1px;overflow:hidden;' + t_opa + '"><\/div>';
			t_y += '<div class="tooltip_shadow" style="position:relative;left:' + t_spct + 'px;top:0px;width:' + (t_w-t_spct) + 'px;height:' + t_shw + 'px;overflow:hidden;' + t_opa + '"><\/div>';
		}
	}
	t_y += '<\/div>';
	return t_y;
}


function tt_Init(again)
{
	if (!(tt_op || tt_n4 || tt_n6 || tt_ie || tt_w3c)) return;

	var ccnt=0;
	var merk_ttshow=0;

	var htm = tt_n4? '<div style="position:absolute;"><\/div>' : '',
	tags,
	t_tj,
	over,
	esc = 'return escape(';
	var i = tt_tags.length;
	while (i--)
	{
		tags = tt_ie? (document.all.tags(tt_tags[i]) || 1)
			: document.getElementsByTagName? (document.getElementsByTagName(tt_tags[i]) || 1)
			: (!tt_n4 && tt_tags[i]=='a')? document.links
			: 1;
		if (tt_n4 && (tt_tags[i] == 'a' || tt_tags[i] == 'layer')) tags = tt_N4Tags(tt_tags[i]);
		var j = tags.length;
		while (j--)
		{

			if (typeof (t_tj = tags[j]).onmouseover == 'function') {
				//if(again) alert(t_tj.onmouseover.toString());
				merk_ttshow = (t_tj.onmouseover.toString().indexOf('tt_Show') != -1);

				if(merk_ttshow) {
					if(dd.elements[t_tj.id])
					{
						var tmp = eval('dd.elements.'+t_tj.id+'.tooltip;');

						//var type = eval('dd.elements.'+t_tj.id+'.contenttype;');
						//var tmp = eval('dd.elements.p3_1_1.tooltip;');
						t_tj.onmouseover = new Function('return escape("'+tmp+'");');
					}
				}

				if (t_tj.onmouseover.toString().indexOf(esc) != -1)
				{

					if (!tt_n6 || tt_n6 && (over = t_tj.getAttribute('onmouseover')) && over.indexOf(esc) != -1)
					{
                        if (over) t_tj.onmouseover = new Function(over);
                        var txt = unescape(t_tj.onmouseover());
                        var test = t_tj.id;
                        var tmp = test.split('_');
                        var posi = tmp[0].substr(1);
                        var targetposi1 = 0;
                        var targetposi2 = 0;

                        if(posi >= 256 && posi != 384)
                        {
                            var type = eval('dd.elements.'+t_tj.id+'.contenttype;');
                            switch(type)
                            {
                                case 1: targetposi1 = 2; break;
                                case 2: targetposi1 = 3; break
                                case 4: targetposi1 = 4; break
                                case 8: targetposi1 = 5; break
                                case 48: targetposi1 = 6; targetposi2 = 7; break
                                case 256: targetposi1 = 9; break
                                case 512: targetposi1 = 10; break
                                case 1024: targetposi1 = 11; break
                            }
                            if (targetposi1 > 0 && dd.elements['p' + targetposi1 +'_1_1'])
                            {
                                var txt2 = "";
                                var txt3 = "";
                                var compareValue = eval('dd.elements.'+t_tj.id+'.compare');

                                if (typeof compareValue == 'undefined' || typeof compareValue[0] == 'undefined')
                                    compareValue = false;

                                txt2 = eval('dd.elements.p' + targetposi1 +'_1_1.tooltip;');
                                if (targetposi2 > 0 && typeof simpleCompareTooltip == 'undefined')
                                    txt3 = eval('dd.elements.p' + targetposi2 +'_1_1.tooltip;');

                                if (txt2)
                                {
                                    var tmpElement = new Element('div');
                                    tmpElement.set('html', txt2);
                                    if (tmpElement.getElement('span.tooltipticker') != null)
                                        tmpElement.getElement('span.tooltipticker').getParent().destroy();
                                    txt2 = tmpElement.get('html');
                                }
                                if (compareValue && compareValue.length > 0)
                                {
                                    if (typeof compareValue[0][0] != 'undefined')
                                    {
                                        txt2 = compareValue[0][0];
                                        if (typeof compareValue[0][1] == 'undefined')
                                            txt3 = '';
                                    }
                                }
                                if (txt2)
                                {
                                    txt2 = "<td valign=top>" + txt2 + "</td>";
                                }

                                if (txt3)
                                {
                                    if (txt3)
                                    {
                                        var tmpElement = new Element('div');
                                        tmpElement.set('html', txt3);
                                        if (tmpElement.getElement('span.tooltipticker') != null)
                                            tmpElement.getElement('span.tooltipticker').getParent().destroy();
                                        txt3 = tmpElement.get('html');
                                    }
                                    if (compareValue && compareValue.length > 0)
                                    {
                                        if (typeof compareValue[0][1] != 'undefined')
                                        {
                                            txt3 = compareValue[0][1];
                                        }
                                    }
                                    if (txt3)
                                    {
                                        txt3 = "<td valign=top>" + txt3 + "</td>";
                                    }
                                }

                                if (txt2 || txt3)
                                {
                                    txt = "<table class='tooltipEquiped'><tr><td valign=top>" + txt + "</td>" + txt2 + txt3 + "</tr></table>";
                                }
                            }

                        }
                        var name = 'tOoLtIp' + (t_tj.id ? '_' + t_tj.id : i + '' + j);

                        if(t_tj.className == 'charstats_bg' || t_tj.className == 'runeImg' || t_tj.className == 'runeImg_grey' || t_tj.id == 'header_values_hp_bar') name = t_tj.id + '_box';

                        // wenn nochmal aufrufen, einfach neu generierten inhalt rein
                        if(again) {
                            var update = tt_GetDiv(name);
                            if (update) {
                                update.innerHTML=txt;
                            }
                            //document.getElementById('tOoLtIp'+i+''+j).innerHTML=txt;
                        }
                        if(!update)
                        {
                            htm += tt_Htm(
                                t_tj,
                                name,
                                txt.wzReplace('& ','&')
                            );
                        }

                        t_tj.onmouseover = new Function('e',
                            'tt_Show(e,'+
                            '"' + name + '",'+
                            (typeof t_tj.T_ABOVE != tt_u) + ','+
                            ((typeof t_tj.T_DELAY != tt_u)? t_tj.T_DELAY : ttDelay) + ','+
                            ((typeof t_tj.T_FIX != tt_u)? '"'+t_tj.T_FIX+'"' : '""') + ','+
                            (typeof t_tj.T_LEFT != tt_u) + ','+
                            ((typeof t_tj.T_OFFSETX != tt_u)? t_tj.T_OFFSETX : ttOffsetX) + ','+
                            ((typeof t_tj.T_OFFSETY != tt_u)? t_tj.T_OFFSETY : ttOffsetY) + ','+
                            (typeof t_tj.T_STATIC != tt_u) + ','+
                            (typeof t_tj.T_STICKY != tt_u) +
                            ');'
                        );
                        t_tj.onmousedown = tt_Hide;
                        t_tj.onmouseout = tt_Hide;
                        if (t_tj.alt) t_tj.alt = "";
                        if (t_tj.title) t_tj.title = "";
					}
				}
			}
		}
	}
	if(!again) document.write(htm);
	else
	{
		document.getElementById('tooltips').innerHTML += htm;
		hideTooltips();
	}
}


function tt_EvX(t_e)
{
	var t_y = tt_Int(t_e.pageX || t_e.clientX || 0) +
		tt_Int(tt_ie? tt_db.scrollLeft : 0) +
		tt_offX;
	if (t_y > xlim) t_y = xlim;
	var t_scr = tt_Int(window.pageXOffset || (tt_db? tt_db.scrollLeft : 0) || 0);
	if (t_y < t_scr) t_y = t_scr;
	return t_y;
}


function tt_EvY(t_e)
{
	var t_y = tt_Int(t_e.pageY || t_e.clientY || 0) +
		tt_Int(tt_ie? tt_db.scrollTop : 0);
	if (tt_above) t_y -= (tt_objH + tt_offY - (tt_op? 31 : 15));
	else if (t_y > ylim || !tt_dwn && t_y > ylim-24)
	{
		t_y -= (tt_objH + 5);
		tt_dwn = false;
	}
	else
	{
		t_y += tt_offY;
		tt_dwn = true;
	}
	return t_y;
}


function tt_ReleasMov()
{
	if (document.onmousemove == tt_Move)
	{
		if (document.releaseEvents) document.releaseEvents(Event.MOUSEMOVE);
		document.onmousemove = null;
	}
}


function tt_HideInput()
{
	if (!(tt_ie || tt_op6) || !tt_inputs) return;
	var t_o;
	var t_i = tt_inputs.length; while (t_i--)
	{
		t_o = tt_inputs[t_i];
		if (tt_vis && tt_objX+tt_objW > t_o.x && tt_objX < t_o.x+t_o.offsetWidth && tt_objY+tt_objH > t_o.y && tt_objY < t_o.y+t_o.offsetHeight)
			t_o.style.visibility = 'hidden';
		else t_o.style.visibility = 'visible';
	}
}


function tt_GetDiv(t_id)
{
	return (
		tt_n4? (document.layers[t_id] || null)
		: tt_ie? (document.all[t_id] || null)
		: (document.getElementById(t_id) || null)
	);
}


function tt_GetDivW()
{
	return (
		tt_n4? tt_obj.clip.width
		: tt_obj.style.pixelWidth? tt_obj.style.pixelWidth
		: tt_obj.offsetWidth
	);
}


function tt_GetDivH()
{
	return (
		tt_n4? tt_obj.clip.height
		: tt_obj.style.pixelHeight? tt_obj.style.pixelHeight
		: tt_obj.offsetHeight
	);
}


// Compat with DragDrop Lib: Ensure z-index of tooltip is lifted beyond toplevel dragdrop element
function tt_SetDivZ()
{
	var t_i = tt_obj.style || tt_obj;
	if (window.dd && dd.z)
		t_i.zIndex = Math.max(dd.z+1, t_i.zIndex);
}


function tt_SetDivPos(t_x, t_y)
{
	var t_i = tt_obj.style || tt_obj;
	var t_px = (tt_op6 || tt_n4)? '' : 'px';
	t_i.left = (tt_objX = t_x) + t_px;
	t_i.top = (tt_objY = t_y) + t_px;
	tt_HideInput();
}


function tt_ShowDiv(t_x)
{
	if (tt_n4) tt_obj.visibility = t_x? 'show' : 'hide';
	else tt_obj.style.visibility = t_x? 'visible' : 'hidden';
	tt_vis = t_x;
	tt_HideInput();
}


function tt_Show(t_e, t_id, t_above, t_delay, t_fix, t_left, t_offx, t_offy, t_static, t_sticky)
{
	if (tt_obj) tt_Hide();
	var t_mf = document.onmousemove || null;
	if (window.dd && (window.DRAG && t_mf == DRAG || window.RESIZE && t_mf == RESIZE)) return;
	var t_uf = document.onmouseup || null;
	if (t_mf && t_uf) t_uf(t_e);

	tt_obj = tt_GetDiv(t_id);
	if (tt_obj)
	{
		tt_dwn = !(tt_above = t_above);
		tt_static = t_static;
		tt_sticky = t_sticky;
		tt_objW = tt_GetDivW();
		tt_objH = tt_GetDivH();
		tt_offX = t_left? -(tt_objW+t_offx) : t_offx;
		tt_offY = t_offy;
		if (tt_op) tt_offY += 21;
		if (tt_n4)
		{
			if (tt_obj.document.layers.length)
			{
				var t_sh = tt_obj.document.layers[0];
				t_sh.clip.height = tt_objH - Math.round(t_sh.clip.width*1.3);
			}
		}
		else
		{
			var t_sh = tt_GetDiv(t_id+'R');
			if (t_sh)
			{
				var t_h = tt_objH - tt_Int(t_sh.style.pixelTop || t_sh.style.top || 0);
				if (typeof t_sh.style.pixelHeight != tt_u) t_sh.style.pixelHeight = t_h;
				else t_sh.style.height = t_h + 'px';
			}
		}

		tt_GetSelects();

		xlim = tt_Int((tt_db && tt_db.clientWidth)? tt_db.clientWidth : window.innerWidth) +
			tt_Int(window.pageXOffset || (tt_db? tt_db.scrollLeft : 0) || 0) -
			tt_objW -
			(tt_n4? 21 : 0);
		ylim = tt_Int(window.innerHeight || tt_db.clientHeight) +
			tt_Int(window.pageYOffset || (tt_db? tt_db.scrollTop : 0) || 0) -
			tt_objH - tt_offY;

		tt_SetDivZ();
		t_e = t_e || window.event;
		if (t_fix) tt_SetDivPos(tt_Int((t_fix = t_fix.split(','))[0]), tt_Int(t_fix[1]));
		else tt_SetDivPos(tt_EvX(t_e), tt_EvY(t_e));

		window.tt_rdl = window.setTimeout(
			'if (tt_sticky)'+
			'{'+
				'tt_ReleasMov();'+
				'window.tt_upFunc = document.onmouseup || null;'+
				'if (document.captureEvents) document.captureEvents(Event.MOUSEUP);'+
				'document.onmouseup = new Function("window.setTimeout(\'tt_Hide();\', 10);");'+
			'}'+
			'else if (tt_static) tt_ReleasMov();'+
			'tt_ShowDiv(\'true\');',
			t_delay
		);

		if (!t_fix)
		{
			if (document.captureEvents) document.captureEvents(Event.MOUSEMOVE);
			document.onmousemove = tt_Move;
		}
	}
}


var tt_area = false;
function tt_Move(t_ev)
{
	if (!tt_obj) return;
	if (tt_n6 || tt_w3c)
	{
		if (tt_wait) return;
		tt_wait = true;
		setTimeout('tt_wait = false;', 5);
	}
	var t_e = t_ev || window.event;
	tt_SetDivPos(tt_EvX(t_e), tt_EvY(t_e));
	if (tt_op6)
	{
		if (tt_area && t_e.target.tagName != 'AREA') tt_Hide();
		else if (t_e.target.tagName == 'AREA') tt_area = true;
	}
}


function tt_Hide()
{
	if (window.tt_obj)
	{
		if (window.tt_rdl) window.clearTimeout(tt_rdl);
		if (!tt_sticky || tt_sticky && !tt_vis)
		{
			tt_ShowDiv(false);
			tt_SetDivPos(-tt_objW, -tt_objH);
			tt_obj = null;
			if (typeof window.tt_upFunc != tt_u) document.onmouseup = window.tt_upFunc;
		}
		tt_sticky = false;
		if (tt_op6 && tt_area) tt_area = false;
		tt_ReleasMov();
		tt_HideInput();
	}
}

function hideTooltips()
{
	var e = document.getElementById('tooltips');
	for(var i = 0; i < e.childNodes.length; i++)
	{
		if(e.childNodes[i].style) e.childNodes[i].style.visibility = 'hidden';
	}
}

tt_Init();