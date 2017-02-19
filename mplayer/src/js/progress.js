let update = require("./update.js");
let formatTime = require("./formatTime.js");

function progress(dom, audio) {
    dom.playProgress.attr("max", audio.duration); // 进度条最大值
    dom.duration.html(formatTime(audio.duration)); // 播放时长
    update(audio);    
}

module.exports = progress;