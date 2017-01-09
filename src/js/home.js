TS("body").css("height", Toad.getViewport().height + "px"); // 初始化为视窗高度
TS(".entry").css("height", Toad.getViewport().height + "px");
toggleImage(); // 图片预加载

TS("#year").html(new Date().getFullYear());
TS("#month").html(new Date().getMonth() + 1);
TS("#day").html(new Date().getDate());
TS("#hour").html(new Date().getHours());
TS("#minute").html(new Date().getMinutes());
TS("#second").html(new Date().getSeconds());

function update() {
    setTimeout(function() {
        TS("#year").html(new Date().getFullYear());
        TS("#month").html(new Date().getMonth() + 1);
        TS("#day").html(new Date().getDate());
        TS("#hour").html(new Date().getHours());
        TS("#minute").html(new Date().getMinutes());
        TS("#second").html(new Date().getSeconds());
        update();
    }, 1000);
}

update();

TS("#next-image").click(function() {
    if (TS(".circle").css("display") === "none") {
        TS(".entry").css("display", "none");
        TS(".circle").css("display", "block");
    }
    toggleImage(); // 点击切换图片
});

TS(".circle").click(function() {
    TS(".entry").css("display", "block");
    TS(".circle").css("display", "none");
});

function toggleImage() {
    TS(".bg").removeChild(TS(".img").get(0));
    TS(".img").eq(0).toggleClass("img-active");
    TS(".img").eq(0).toggleClass("img-fade");
    TS(".img").eq(1).toggleClass("img-active");
    TS(".img").eq(1).toggleClass("img-src");
    document.title = TS(".img-active").data("title") + " | " + TS(".img-active").data("author");
    Toad.ajax({
		method: "get",
		url: "toggle.php",
		data: {
            requestImage: true
		},
		fn: function(xhr) {
            var ajax = JSON.parse(xhr.responseText);
            TS(".bg").appendChild("div");
            TS(".bg").lastChild().addClass("img").addClass("img-src").css("backgroundImage", "url('" + ajax.src + "')").data("author", ajax.author).data("title", ajax.title);
		}
	});
}

TS("#fullscreen").click(function() {
    TS(this).css("display", "none");
    TS("#exit-fullscreen").css("display", "block");
    Toad.fullScreen(document.documentElement);
    Toad.fullscreenchange(function() {
        document.onkeyup = function(e) { // 非火狐浏览器
            if (e.keyCode === 27) {
                TS("#exit-fullscreen").css("display", "none");
                TS("#fullscreen").css("display", "block");
            }
        };
        window.onresize = function() { // 火狐浏览器下无法监听 esc 键的解决方法
            if (! Toad.isFullScreen()) {
                TS("#exit-fullscreen").css("display", "none");
                TS("#fullscreen").css("display", "block");
            }
        };
    });
});

TS("#exit-fullscreen").click(function() {
    TS(this).css("display", "none");
    TS("#fullscreen").css("display", "block");
    Toad.cancelFullScreen(document.documentElement);
});

TS("#music-toggle").click(function() {

    var music = TS("#music").get(0);

    if (music.paused) {

        TS(this).removeClass("icon-play"); // 图标切换
        TS(this).addClass("icon-pause"); // 图标切换
        TS(this).attr("title", "暂停"); // 切换提示
        music.play(); // 播放

    } else {

        TS(this).removeClass("icon-pause"); // 切换图标
        TS(this).addClass("icon-play"); // 切换图标
        TS(this).attr("title", "播放"); // 切换提示
        music.pause(); //  暂停
    }
});

TS("#music-next").click(function() {

    var music = TS("#music").get(0);

    Toad.ajax({
        method: "get",
        url: "toggle.php",
        data: {
            requestSong: true
        },
        fn: function(xhr) {
            music.src = xhr.responseText;
            music.play();
            TS("#music-toggle").removeClass("icon-play"); // 图标切换
            TS("#music-toggle").addClass("icon-pause"); // 图标切换
            TS("#music-toggle").attr("title", "暂停"); // 切换提示
        }
    });

});
