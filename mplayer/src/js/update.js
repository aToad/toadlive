let $ = require("jquery");
let dom = require("./dom.js");
let formatTime = require("./formatTime.js");

function update(audio) {
    function inner() {      
        dom.playProgress.attr("value", audio.currentTime); // 进度条位置
        dom.playing.html(formatTime(audio.currentTime)); // 已经播放的时间
        for (let i = 0, child = dom.lrcList.children(), len = child.length; i < len; i ++) {
            if (audio.currentTime * 1000 >= $(child[i]).attr("class")) {
                $(child[i]).prev().css("color", "#000");
                $(child[i]).css("color", "blue");
            }
        }
        if (dom.playProgress.attr("value") <= audio.duration) {
            requestAnimationFrame(inner);
        }
    }
    requestAnimationFrame(inner);
}

module.exports = update;
