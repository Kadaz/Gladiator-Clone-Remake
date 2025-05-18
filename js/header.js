var Header = new Class({
    updateGold: function(gold)
    {
        $('sstat_gold_val').innerHTML = gold;
    },

    updateRubies: function(rubies)
    {
        $('sstat_ruby_val').innerHTML = rubies;
    },

    getGold: function()
    {
        return $('sstat_gold_val').innerHTML.replace(/\./g, '').toInt();
    },

    getRubies: function()
    {
        return $('sstat_ruby_val').innerHTML.replace(/\./g, '').toInt();
    },

    updateDungeonPoints: function(points, maxPoints)
    {
        $('dungeonpoints_value').innerHTML = points + ' / ' + maxPoints;
    },

    updateExpeditionPoints: function(points, maxPoints)
    {
        $('expeditionpoints_value').innerHTML = points + ' / ' + maxPoints;
    },

    resetArenaCooldown: function()
    {
        arenaProgressBar.clear();
    },

    resetExpeditionCooldown: function()
    {
        expeditionProgressBar.clear();
    },

    resetDungeonCooldown: function()
    {
        dungeonProgressBar.clear();
    }
});

var headerObject = new Header();
