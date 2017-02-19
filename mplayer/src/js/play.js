let progress = require("./progress.js");
let showInfo = require("./showInfo.js");
let next = require("./next.js");
let $ = require("jquery");
let loadlrc = require("./loadlrc.js");

function play(dom, audio, index) {
    audio.play();  // 播放
    audio.oncanplay = function() {
        showInfo(dom, index); // 显示歌曲信息
        progress(dom, audio); // 加载进度条
        loadlrc(dom, audio, index); // 加载歌词
    }
    audio.onended = function() {
        next(dom, audio, index, play); // 下一首
    }
}

module.exports = play;