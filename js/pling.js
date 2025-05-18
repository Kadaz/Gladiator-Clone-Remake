function PlingItem()
{
	this.interval = 0;
	this.count = 0;
	this.id = 0;

	this.add = function(x, y, width, count, text, color, parent, id)
	{
		var div = new Element('div');
		div.id = 'pling' + id;
		div.addClass('pling');
		div.set('html', text);

		div.setStyle('color', color);
		div.setStyle('left', x);
		div.setStyle('top', y);
		div.setStyle('width', width);

		if($(parent)) $(parent).appendChild(div);
		else document.body.appendChild(div);

        var self = this;
		this.interval = window.setInterval(function(){ self.tick(); }, 50);

		this.count = count;
		this.id = id;
	}

	this.remove = function()
	{
		var e = $('pling' + this.id);
		if (e)
            e.parentNode.removeChild(e);

        window.clearInterval(this.interval);
        pling.remove(this.id);
	}

    this.tick = function()
    {
        var e = $('pling' + this.id);
        if(e)
        {
            var top = e.getStyle('top').toInt();
            top -= 2;
            this.count = Math.max(this.count - 2, 0);

            e.setStyle('top',top);

            if (this.count <= 0)
                this.remove();
        }
        else this.remove();
    }
}


function Pling()
{
	this.aktPling = 1;

	this.items = new Array();
	this.items[0] = new Object();

	this.add = function(x, y, width, count, text, color, parent)
	{
		var item = new PlingItem();
		item.add(x, y, width, count, text, color, parent, this.aktPling);
		this.items[0][this.aktPling] = item;

		this.aktPling++;
	}

	this.remove = function(id)
	{
        delete this.items[0][id];
	}

    this.currency = function(gold, rubies, x, y)
    {
        var color = '';
        var prefix = '';
        var text = '';

        if(gold != 0 || rubies != 0)
        {
            if(gold > 0)
            {
                color = '#00FF21';
                prefix = "+";
            }
            else
            {
                color = '#FF0000';
                prefix = "-";
                gold = -gold;
                rubies = -rubies;
            }
            text += '<div class="moneymessage">';
            if(gold > 0) text  += '<span class="goldRow">' + prefix + ' ' + formatZahl(gold) + '&nbsp;</span>';
            if(rubies > 0) text += '<br /><span class="rubyRow">' + prefix + ' ' + formatZahl(rubies) + '&nbsp;</span>';
            text += '</div>';
            this.add(x, y, 150, 50, text, color, null);
        }
    }

    this.portrait = function(message, color, fontSize)
    {
        message = '<span style="font-size:' + fontSize + ';">' + message + '</span>'
        this.add(5, 80, 160, 50, message, color, 'p8_1_1');
    }

    this.item = function(x, y, message, color)
    {
        message = '<div class="itemmessage">' + message + '</div>'
        this.add(x, y, 190, 50, message, color, null);
    }
}

var pling = new Pling();