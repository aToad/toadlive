let loadlrc = require("./loadlrc.js");
function next(dom, audio, index, play) {
    dom.lrcList.html(""); // 清空歌词
    index += 1;
    if (index >= dom.clickPlay.length) {
        index = 0;
    }
    audio.src = decodeURI("../" + dom.clickPlay.eq(index).attr("src")); // 歌曲链接 
    play(dom, audio, index); // 播放
    loadlrc(dom, audio, index); // 加载歌词
}

module.exports = next;