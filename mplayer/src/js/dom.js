let $ = require("jquery");

let playToggle = $("#play-toggle"); // 暂停或播放切换
let next = $("#next"); // 下一首
let prev = $("#prev"); // 上一首
let volumeToggle = $("#volume-toggle"); // 静音与否
let volumeBar = $("#volume-bar"); // 音量条
let playing = $("#playing"); // 播放时间
let duration = $("#duration"); // 歌曲结束时间
let playProgress = $("#play-progress"); // 播放进度条
let clickPlay = $(".click-play"); // 点击列表列时播放
let author = $(".author");
let title = $(".title");
let cover = $(".cover");
let album = $(".album");
let lrc = $("#lrc");
let list = $("#list");
let fullshow = $("#fullshow");
let lrcList = $("#lrc-list");

module.exports = {
    playToggle: playToggle,
    volumeBar: volumeBar,
    volumeToggle: volumeToggle,
    next: next,
    prev: prev,
    playing: playing,
    duration: duration,
    playProgress: playProgress,
    clickPlay: clickPlay,
    author: author,
    title: title,
    cover: cover,
    lrc: lrc,
    list: list,
    fullshow: fullshow,
    album: album,
    lrcList: lrcList
}
