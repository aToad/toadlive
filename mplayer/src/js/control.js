let $ = require("jquery");
let audio = require("./audio.js");
let dom = require("./dom.js");
let getVolume, currentIndex;
let update = require("./update.js");
let play = require("./play.js");

// 播放与暂停
dom.playToggle.click(function() {
    if ($(this).children().first().hasClass("icon-play")) {
        $(this).children().first().removeClass("icon-play");
        $(this).children().first().addClass("icon-pause");
        if ($.trim($(audio).attr("src")).length > 0) {
            audio.play();
        } else {
            alert("还没有选择歌曲哦！");
        }     
    } else {
        audio.pause();
        $(this).children().first().addClass("icon-play")
        $(this).children().first().removeClass("icon-pause");
    } 
});

// 静音与否
dom.volumeToggle.click(function() {
    if ($(this).children().first().hasClass("icon-volume-up")) {
        $(this).children().first().removeClass("icon-volume-up")
        $(this).children().first().addClass("icon-volume-off");
        getVolume = audio.volume;
        audio.volume = 0;
        dom.volumeBar.attr("value", 0);
    } else {
        $(this).children().first().addClass("icon-volume-up")
        $(this).children().first().removeClass("icon-volume-off");
        audio.volume = getVolume; // 返回静音前的音量
        dom.volumeBar.attr("value", 120 * getVolume);
    } 
});

// 音量调节
dom.volumeBar.click(function(e) {
    let start = $(this).offset().left + audio.volume * 120; // 初始音量
    let change = e.clientX - start;
    audio.volume = change/120 + audio.volume; // 改变后的音量
    getVolume = audio.volume; // 记录当前音量
    $(this).attr("value", audio.volume * 120); // 音量位置
});

// 切换进度
dom.playProgress.click(function(e) {   
    let scale = (e.clientX - $(this).offset().left)/$(this).width();
    audio.currentTime = audio.duration * scale;   
});

// 
dom.clickPlay.click(function() {
    let index = Number($(this).index());
    audio.src = decodeURI("../" + $(this).attr("src")); // 歌曲链接
    $(audio).attr("index", index); // jquery 索引
    currentIndex = index; // 当前歌曲
    play(dom, audio, index); // 播放
});

// 
dom.lrc.click(function() {
    if (dom.list.css("visibility") !== "hidden") {
        dom.list.css("visibility", "hidden");
        dom.fullshow.css("visibility", "visible");
    } else {
        dom.list.css("visibility", "visible");
        dom.fullshow.css("visibility", "hidden");
    }  
});