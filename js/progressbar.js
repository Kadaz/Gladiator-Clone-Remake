function ProgressBar(divIdText, divId, classProgress, classReady, readyText, start, nowInit, end)
{
	this.divIdText = divIdText;
	this.divId = divId;
    this.classProgress = classProgress;
    this.classReady = classReady;
    this.readyText = readyText;
	this.start = start;
	this.nowInit = nowInit;
	this.end = end+1;
	this.timer = 0;
	this.inversed = false;

	this.init = function()
	{
		this.updateIntervall = 100;
		this.clientStart = this.clientTimestamp();
		this.now = this.nowInit;

        var percent = this.calcPercentDone();

        if (percent < 100)
        {
            $(this.divId).addClass(this.classProgress);
            this.setText(this.divIdText);
        }
        else
        {
            $(this.divId).addClass(this.classReady);
        }
        
        this.setDiv(this.calcPercentDone(), this.divId);
        var self = this;
        this.timer = window.setTimeout(function() { self.update(self.divId) }, this.updateIntervall);
	}

	this.cancel = function()
	{
		this.removeText(this.divIdText);
		if(this.inversed) this.inverse();
		this.setDiv(0,this.divId);
		window.clearTimeout(this.timer);
	}

	this.calcPercentDone = function()
	{
		return parseInt(100*(this.now - this.start)/(this.end-this.start));
	}

	this.update = function(div)
	{
		this.now = this.nowInit + (this.clientTimestamp()-this.clientStart)/1000;
		if(this.inversed)
			var percentOld = 100-parseInt(document.getElementById(div).style.width);
		else
			var percentOld = parseInt(document.getElementById(div).style.width);
		if(percentOld < 100)
		{
			this.setDiv(this.calcPercentDone(),div);
			this.setText(this.divIdText);
			var self = this;
			this.timer = window.setTimeout(function() { self.update(div) }, this.updateIntervall);
		}
		else
		{
			this.removeText(this.divIdText);
			if(this.inversed) this.inverse();
            $(this.divId).removeClass(this.classProgress);
            $(this.divId).addClass(this.classReady);
            $(this.divIdText).set('html', this.readyText);
		}
	}

    this.clear = function()
    {
        document.getElementById(this.divId).style.width = '100%';
    }

	this.setDiv = function(percent, div)
	{
		if(percent>100) percent = 100;

		if(this.inversed)
			$(div).style.width = (100-percent)+'%';
		else
			$(div).style.width = percent+'%';        
	}

	this.inverse = function()
	{
		this.inversed = !this.inversed;
	}

	this.setText = function(div)
	{
		var rest = this.end - this.now;
		rest = Math.max(0, rest);
		restTime = this.formatTime(rest);
        
		if (document.getElementById(div))
        {
            document.getElementById(div).innerHTML = restTime;
        }
	}

	this.removeText = function(div)
	{
		if(document.getElementById(div)) document.getElementById(div).innerHTML = '';
	}

	this.clientTimestamp = function()
	{
		var userDate = new Date();
		return parseInt(userDate.getTime());
	}

    this.formatTime = function(sek)
    {
        var h = Math.floor(sek/3600); sek -= (h*3600);
        var m = Math.floor(sek/60);   sek -= (m*60);
        var s = Math.floor(sek);

        var text = "";

        text += this.fillZero(h.toString(), 2);
        text += ":" + this.fillZero(m.toString(), 2);
        text += ":" + this.fillZero(s.toString(), 2);

        return text;
    }
    
    this.fillZero = function(zahl, laenge)
    {
        var neu = zahl;
        while(neu.length < laenge)
        {
            neu = "0" + neu;
        }
        return neu;
    }
}