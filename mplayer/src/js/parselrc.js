let $ = require("jquery");

function parselrc(lrcString, lrcList) {
    
    let rows = lrcString.split("\n");
    for (let i = 0; i < rows.length; i++) {
        let tmp = rows[i].split("]");
        if ($.trim(tmp[1]).length > 0) {
            var time = tmp[0].slice(1).split(":");
            let ms = time[0] * 60 * 1000 + time[1] * 1000;

            let lrc = document.createElement("li");
            lrc.className = ms;
            lrc.innerHTML = tmp[1];
            lrcList.append(lrc);
        }
    }
}

module.exports = parselrc;