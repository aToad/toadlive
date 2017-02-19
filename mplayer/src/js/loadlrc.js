let $ = require("jquery");
let update = require("./update.js");
let parselrc = require("./parselrc.js");

function loadlrc(dom, audio, currentIndex) {

    let jsonURL = location.protocol + "//" + location.host + "/" + dom.clickPlay.eq(currentIndex).attr("lrc");
    if ($.trim(dom.lrcList.html()).length === 0) {
        $.getJSON(jsonURL, (data) => {  
            parselrc(data["lyric"], dom.lrcList);
        });
    }
}

module.exports = loadlrc;