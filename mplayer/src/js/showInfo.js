let currentIndex;

function showInfo(dom, index) {
    let firstChild = dom.clickPlay.eq(index).children().first();
    if (currentIndex !== index) {
        firstChild.html('<span class="icon icon-play-circle"></span>'); // 显示播放按钮
        dom.clickPlay.eq(currentIndex).children().first().html((currentIndex + 1)); //
        dom.lrcList.html(""); // 清空歌词
    }
    currentIndex = index // 记录当前播放曲目的索引

    dom.author.html(dom.clickPlay.eq(index).children().eq(1).html()); // 歌手
    dom.album.html(dom.clickPlay.eq(index).children().eq(2).html()); // 专辑
    dom.title.html(dom.clickPlay.eq(index).children().eq(3).html()); // 歌名
    dom.playToggle.children().first().removeClass("icon-play"); // 移除播放按钮
    dom.playToggle.children().first().addClass("icon-pause"); // 显示暂停按钮
    dom.cover.attr("src", decodeURI("../" + dom.clickPlay.eq(index).attr("cover"))); // 封面 
}

module.exports = showInfo;