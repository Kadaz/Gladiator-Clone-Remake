var blackoutDialogDivId;
var confirmNeeded;
var confirmed;
var showAlert;
var blackoutScreen = false;

function blackoutDialog(switchOn, dialogDivId, msieAbsPosY, abortFunction, canCancel)
{
	if (dialogDivId != undefined)
	{
		var dialogDivObj=document.getElementById(dialogDivId);
		if (!dialogDivObj.parentNode.tagName.match(/^body$/i))
		{
			dialogDivObj.parentNode.removeChild(dialogDivObj);
			document.body.appendChild(dialogDivObj);
		}
	}

	if (switchOn==true && document.getElementById('breakDiv'))
		blackoutDialog(false, blackoutDialogDivId, msieAbsPosY);

	if (switchOn==true)
	{
		blackoutDialogDivId=dialogDivId;
		var div = document.createElement('div');
		div.id = 'breakDiv';

        if (canCancel != undefined && canCancel == false)
        {
            div.className = 'break_div break_div2';
        }
        else
        {
            div.onmousedown = function()
            {
                blackoutDialog(false);
                if (abortFunction)
                {
                    eval(abortFunction);
                }
            };
            div.className = 'break_div';
        }


		if (navigator.userAgent.indexOf('MSIE')>=0)
		{
			var width=document.documentElement.clientWidth;
			var height=document.documentElement.clientHeight;
		}
		else
		{
			var width=window.innerWidth;
			var height=window.innerHeight;
		}
		div.style.zIndex=500;
		div.style.overflow='hidden';
		if (navigator.userAgent.indexOf('MSIE 6.0')>=0)
		{
			document.body.style.width='100%';
			document.body.style.height='100%';
			div.style.width=document.body.offsetWidth+'px';
			div.style.height=document.body.offsetHeight+'px';
		}
		else
		{
			div.style.position='fixed';
			div.style.width='100%';
			div.style.height='100%';
		}
		document.body.appendChild(div);
		document.getElementById(dialogDivId).style.display='block';

		// Fuer IE6-7
		if ((navigator.userAgent.indexOf("MSIE") >= 0) && (navigator.userAgent.indexOf("MSIE 8") < 0))
		{
			var windowHeight = document.documentElement.clientHeight;
			var popupHeight = document.getElementById(dialogDivId).offsetHeight;
			var scrolled = document.documentElement.scrollTop;
			var top = Math.floor((windowHeight / 2) - (popupHeight / 2)) + scrolled;
		}
		else
			var top=Math.floor(height / 2)-Math.floor(document.getElementById(dialogDivId).offsetHeight/2);

		var left=Math.floor((width-document.getElementById(dialogDivId).offsetWidth)/2);
        if($(document.body).getStyle('direction') == 'rtl')
		    document.getElementById(dialogDivId).style.right=left+'px';
        else
            document.getElementById(dialogDivId).style.left=left+'px';
		document.getElementById(dialogDivId).style.top=top+'px';
		document.getElementById(dialogDivId).style.zIndex=501;
	}
	else
	{
		if (document.getElementById('breakDiv'))
			document.body.removeChild(document.getElementById('breakDiv'));
		document.getElementById(blackoutDialogDivId).style.display='none';
		document.getElementById(blackoutDialogDivId).style.zIndex = -1;
	}
    blackoutScreen = switchOn;
}

function blackoutDialogFlex(onClickAction, diaTxt, switchOn, dialogDivId, msieAbsPosY, abortFunction)
{
	document.getElementById('link' + dialogDivId).onclick = function()
	{
		eval(onClickAction);
	};

	if (diaTxt != '')
	    document.getElementById('dialogTxt' + dialogDivId).innerHTML = diaTxt;

	blackoutDialog(switchOn, 'blackoutDialog' + dialogDivId, msieAbsPosY, abortFunction);
}

var pickX = 0;
var pickY = 0;
function blackoutDialogDD(switchOn, dialogDivId, msieAbsPosY)
{
	pickX = pickObj.x;
	pickY = pickObj.y;
	blackoutDialog(switchOn, dialogDivId, msieAbsPosY);
	document.getElementById('breakDiv').onmousedown=function() { cancelDragDrop(); };
}

function cancelDragDrop()
{
	showAlert = '';
	ddObject.moveTo(pickX, pickY);
	SwapBlockingfields(false);
	changeShow();
	SetToolTip(true);
	PICK_ITEM = false;
	blackoutDialog(false);
	changeDraggable(true);
	pickX = 0;
	pickY = 0;
}

function doDragDrop()
{
	showAlert = '';
	ddObject.unique=1;
	confirmed = true;

	my_tmpDropFunc(ddObject,targetObject,targetDoll);
	ddObject.moveTo(pickX, pickY);
	SwapBlockingfields(false);
	changeShow();
	SetToolTip(true);
	PICK_ITEM = false;
	blackoutDialog(false);

	confirmed = false;
}