TS(".expand").click(function() {
    var that = TS(this),
        parent = that.parent(),
        mdHeight = parseInt(parent.find(".md").css("height"));
    TS(this).parent().css("maxHeight", (mdHeight+110) + "px");
});

TS(".collapse").click(function() {
    TS(this).parent().parent().css("maxHeight", "500px");
});

TS(window).on("scroll", function() {
    if (document.documentElement.scrollTop < 240 || document.documentElement.scrollTop > (TS(".footer").get(0).offsetTop-450)) {
        TS(".sidebar").css({
            position: "static"
        });
    } else {
        TS(".sidebar").css({
            position: "relative",
            top: (document.documentElement.scrollTop-240) + "px"
        });
    }
});
