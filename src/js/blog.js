TS(".expand").click(function() {
    var that = TS(this),
        parent = that.parent(),
        mdHeight = parseInt(parent.find(".md").css("height"));
    TS(this).parent().css("maxHeight", (mdHeight+110) + "px");
});

TS(".collapse").click(function() {
    TS(this).parent().parent().css("maxHeight", "500px");
});
