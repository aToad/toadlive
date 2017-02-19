let $ = require("jquery");

// 内容区域高度随窗口变化
$(".container").css("height", ($(document).height() - 100));
// 进度条宽度随窗口变化
$(".progress").css("width", ($(document).width() - 550));

// 主窗口区域随窗口变化
$(".main").css("width", ($(document).width() - 200));

$(window).on("resize", () => {
    $(".container").css("height", ($(document).height() - 100));
    $(".progress").css("width", ($(document).width() - 550));
    $(".main").css("width", ($(document).width() - 200));
    $(".playing").css("bottom", "50");
});



