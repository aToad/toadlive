var gulp = require("gulp"), // 主文件
    less = require("gulp-less"), // 编译less
    rename = require("gulp-rename"), // 文件重命名
    combiner = require("stream-combiner2"), // 错误处理
    cleancss = require("gulp-clean-css"), // 压缩CSS
    uglify = require("gulp-uglify"), // 压缩JS
    bs = require("browser-sync").create(), // 实时刷新页面
    reload = bs.reload; // 重载与注入

gulp.task("less", function() {
    var combined = combiner.obj([
        gulp.src(["src/less/*.less", "!src/less/*inc.less"]),
        less(),
        rename({
            dirname: "css",
            suffix: ".min",
            extname: ".css"
        }),
        gulp.dest("static"),
        reload({stream: true})
    ]);
    return combined;
});

gulp.task("exec", ["less"], function() {
    bs.init({
        proxy: "www.toadlive.com"
    });
    gulp.watch("src/less/*.less", ["less"]);
    gulp.watch(["view/{backend,frontend}/*.tpl"]).on("change", reload);
});
