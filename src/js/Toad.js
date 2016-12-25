function Toad(param) {
    this.elements = [];

    if (typeof param === "string") {

        var arr = param.split(" "),
            temp = [];

        for (var i = 0, len = arr.length; i < len; i++) {

            if (temp.length === 0) {
                temp.push(document);
            }

            switch (arr[i].charAt(0)) {
                case "#":
                    this.elements = [];
                    this.elements.push(this.getId(arr[i].substr(1)));
                    temp = this.elements;
                    break;

                case ".":
                    this.elements = [];
                    for(var k = 0, length2 = temp.length; k < length2; k++){
                        this.elements = this.elements.concat(this.getClass(arr[i].substr(1), temp[k]));
                    }
                    temp = this.elements;
                    break;

                default:
                    this.elements = [];
                    for (var j = 0, length3 = temp.length; j < length3; j++){
                        this.elements = this.elements.concat(this.getTag(arr[i], temp[j]));
                    }
                    temp = this.elements;
                    break;
            }
        }

        this.elements = temp;
        temp = null;
    } else if (typeof param === "object") {
        this.elements = [];
        this.elements.push(param);
    }
}

Toad.getViewport = function() {
    return {
        width: document.documentElement.clientWidth,
        height: document.documentElement.clientHeight
    };
};

Toad.getScreen = function() {
    return {
        width: screen.width,
        height: screen.height
    }
}

Toad.getStyle = function(element, attr) {
    if (typeof window.getComputedStyle !== "undefined") {
        return window.getComputedStyle(element, null)[attr];
    } else {
        return element.currentStyle[attr];
    }
};

Toad.ajax = function(obj) {
    var xhr = new XMLHttpRequest(),
        query = (function(obj) {
            var temp = [];
            for (var key in obj) {
                if (obj.hasOwnProperty(key)) {
                    temp.push(encodeURIComponent(key) + "=" + encodeURIComponent(obj[key]));
                }
            }
            return temp.join("&");
        })(obj.data);

    if (obj.method.toLowerCase() === "get") {
        obj.url += (obj.url.indexOf("?") > -1) ? "" : "?";
        obj.url += query;
    }

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status >= 200 && xhr.status < 300 || xhr.status === 304) {
                obj.fn(xhr);
            }
        }
    };

    xhr.open(obj.method, obj.url, true);

    if (obj.method.toLowerCase() === "get") {
        xhr.send(null);
    } else if (obj.method.toLowerCase() === "post") {
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(query);
    }
};

Toad.inArray = function(item, array) {
    if (typeof Array.prototype.indexOf !== "undefined") { // es5
        return array.indexOf(item) > -1;
    } else { // 向下兼容
        for (var i = 0, len = array.length; i < len; i++) {
            if (item === array[i]) {
                return true;
            }
        }
    }
};

// 是否全屏
Toad.isFullScreen = function() {
    if (Toad.getBrowser().browser === "chrome") {
        return document.webkitIsFullScreen;
    } else if (Toad.getBrowser().browser === "firefox") {
        return document.mozFullScreen;
    } else if (Toad.getBrowser().browser === "edge") {

    } else if (Toad.getBrowser().browser === "opr") {
        return document.webkitIsFullScreen;
    } else {
        alert("您的浏览器不支持全屏属性！");
    }
};

// 进入全屏
Toad.fullScreen = function(elem) {
    if (typeof elem.requestFullscreen !== "undefined") {
        elem.requestFullscreen();
    } else if (typeof elem.webkitRequestFullScreen !== "undefined") { // opera|chrome 's' 可大可小
        elem.webkitRequestFullScreen();
    } else if (typeof elem.mozRequestFullScreen !== "undefined") { // firefox 's' 必须大写
        elem.mozRequestFullScreen();
    } else if (typeof elem.msRequestFullscreen !== "undefined") { // ie 'screen' 的 's' 是小写
        elem.msRequestFullscreen();
    }
};

// 退出全屏
Toad.cancelFullScreen = function() {
    if (Toad.getBrowser().browser === "edge") {
        document.msExitFullscreen();
    } else if (Toad.getBrowser().browser.indexOf("ie") > -1) {
        alert("浏览器不支持此方法！");
    } else {
        var arr = ["moz", "webkit"];
        arr.forEach( function(item, index) {
            try {
                document[item + "CancelFullScreen"]();
            } catch(e) {
                // statements
                console.log(e);
            }
        });
    }
};


// 全屏事件
Toad.fullscreenchange = function(fn) {
    var arr = ["moz", "ms", "webkit"];
    arr.forEach(function(item, index) {
        try {
            document["on" + item + "fullscreenchange"] = fn;
        } catch(e) {
            // statements
        }
    });
};

Toad.getBrowser = function() {
    var f = /(firefox)\/(\d+)/,
        c = /(chrome)\/(\d+)/,
        m = /trident/,
        o = /(opr)\/(\d+)/,
        userAgent = navigator.userAgent.toLowerCase();

    if (f.test(userAgent)) {
        var firfox = f.exec(userAgent);
        return {
            browser: firfox[1],
            version: firfox[2]
        };

    } else if (o.test(userAgent)) {
        var opera = o.exec(userAgent);
        return {
            browser: opera[1],
            version: opera[2]
        };

    } else if (c.test(userAgent)) {
        var chrome = c.exec(userAgent);
        return {
            browser: chrome[1],
            version: chrome[2]
        };

    } else if (m.test(userAgent)) {
        var edge = /rv\:(\d+)/,
            ie = /msie\s(\d+)/;

        if (edge.test(userAgent)) {
            var arr = edge.exec(userAgent);
            return {
                browser: "edge",
                version: arr[1]
            };

        } else if (ie.test(userAgent)) {

            var arr2 = ie.exec(userAgent);

            switch (arr2[1]) {
                case "10":
                    return {
                        browser: "ie10",
                        version: 10
                    };

                case "9":
                    return {
                        browser: "ie9",
                        version: 9
                    };

                case "8":
                    return {
                        browser: "ie8",
                        version: 8
                    };

                default:
                    return {
                        browser: "ie"
                    };
                    break;
            }
        }
    }
};

Toad.trim = function(str) {
    if (typeof str.trim !== "undefined") {
        return str.trim();
    } else {
        return str.replace(/(^\s*)|(\s*$)/g, "");
    }
};

Toad.prototype.getId = function(id) {
    if (typeof document.querySelector !== "undefined") {
        return document.querySelector("#" + id); // DOM 拓展
    } else {
        return document.getElementById(id); // 向下兼容
    }
};

Toad.prototype.getClass = function(classname, parent) {
    var node = arguments.length === 2 ? parent : document, // 使用条件操作符赋值
        temp = []; // 存放节点

    if (typeof document.getElementsByClassName !== "undefined") { // html5

        var elems = node.getElementsByClassName(classname);

        if (typeof Array.from !== "undefined") { // ES6
            temp = Array.from(elems);
        } else { // 向下兼容
            for (var k = 0, lenk = elems.length; k < lenk; k++) {
                temp.push(elems[k]);
            }
        }

    } else { // 向下兼容

        var all = document.getElementsByTagName("*");

        for (var i = 0, len = all.length; i < len; i++) {
            if (all[i].className === classname) {
                temp.push(all[i]);
            }
        }
    }
    return temp;
};

Toad.prototype.getTag = function(tag, parent) {
    var node = arguments.length === 2 ? parent : document,
        temp = [];

    if (typeof Array.from !== "undefined") { // ES6
        temp = Array.from(node.getElementsByTagName(tag));
    } else { // 向下兼容
        var all = node.getElementsByTagName(tag);
        for (var i = 0, len = all.length; i < len; i++) {
            temp.push(all[i]);
        }
    }
    return temp;
};

Toad.prototype.hasClass = function(classname) {
    for (var i = 0, len = this.elements.length; i < len; i++) {

        if (typeof this.elements[i].classList !== "undefined") { // html5
            return this.elements[i].classList.contains(classname);
        } else { // 向下兼容
            var arr = this.elements[i].className.split(/\s+/);
            for(var k = 0, length3 = arr.length; k < length3; k++){
                if (arr[k].toLowerCase() === classname) {
                    return true;
                }
            }
        }
    }
};

Toad.prototype.toggleClass = function(classname) {
    for (var i = 0, len = this.elements.length; i < len; i++) {

        if (typeof this.elements[i].classList !== "undefined") { // html5
            return this.elements[i].classList.toggle(classname);
        } else { // 向下兼容
            var arr = this.elements[i].className.split(/\s+/),
                pos = -1;
            for(var k = 0, length3 = arr.length; k < length3; k++){
                if (arr[k].toLowerCase() === classname) {
                    pos = k;
                } else {
                    pos = -1;
                }
            }
            if (pos === -1) { // 不存在类名
                this.elements[i].className = Toad.trim(this.elements[i].className + " " + classname);
            } else {
                arr.splice(pos, 1);
                this.elements[i].className = arr.join(" ");
            }

        }
    }
    return this;
}

Toad.prototype.fullScreen = function(argument){
    for (var i = 0, len = this.elements.length; i < len; i++) {
        Toad.fullScreen(this.elements[i]);
    }
    return this;
};

Toad.prototype.addClass = function(classname) {
    for (var i = 0, len = this.elements.length; i < len; i++) {

        if (typeof this.elements[i].classList !== "undefined") { // html5
            this.elements[i].classList.add(classname);
        } else { // 向下兼容
            var str = Toad.trim(this.elements[i].className);

            if (str) { // 非空字符串
                var arr = this.elements[i].className.split(/\s+/);
                for(var k = 0, length3 = arr.length; k < length3; k++){
                    if (arr[k].toLowerCase() === classname) {
                        return;
                    }
                }
                this.elements[i].className = str + " " + classname;

            } else {
                this.elements[i].className = classname;
            }
        }
    }
    return this;
};

Toad.prototype.removeClass = function(classname) {
    for (var i = 0, len = this.elements.length; i < len; i++) {

        if (typeof this.elements[i].classList !== "undefined") { // html5
            this.elements[i].classList.remove(classname);
        } else { // 向下兼容

            var arr = this.elements[i].className.split(/\s+/),
                pos = -1;

            for(var k = 0, length3 = arr.length; k < length3; k++){
                if (arr[k].toLowerCase() === classname) {
                    pos = k;
                }
            }
            arr.splice(pos, 1);
            this.elements[i].className = arr.join(" ");
        }
    }
    return this;
};

Toad.prototype.appendChild = function(tag) {
    for (var i = 0, len = this.elements.length; i < len; i++) {
        this.elements[i].appendChild(document.createElement(tag));
    }
    return this;
};

Toad.prototype.removeChild = function(node) {
    for (var i = 0, len = this.elements.length; i < len; i++) {
        this.elements[i].removeChild(node);
    }
    return this;
};

Toad.prototype.lastChild = function(node) {
    for (var i = 0, len = this.elements.length; i < len; i++) {
        this.elements[i] = this.elements[i].lastElementChild;
    }
    return this;
};

Toad.prototype.css = function(attr, value){
    for (var i = 0, len = this.elements.length; i < len; i++) {

        if (arguments.length === 1) {

            if (typeof attr === "object") {
                var str = "";
                for (var variable in attr) {
                    if (attr.hasOwnProperty(variable)) {
                        str += variable + ":" + attr[variable] + ";";
                    }
                }
                this.elements[i].style.cssText = str;
            } else {
                return Toad.getStyle(this.elements[i], attr);
            }
        } else if (arguments.length === 2) {
            this.elements[i].style[attr] = value;
        }
    }
    return this;
};

Toad.prototype.get = function(num) {
    var element = this.elements[num];
    return element;
};

Toad.prototype.length = function() {
    return this.elements.length;
};

Toad.prototype.eq = function(num) {
    var elem = this.elements[num];
    this.elements = [];
    this.elements.push(elem);
    return this;
};

Toad.prototype.attr = function(name, value) {
    for (var i = 0, len = this.elements.length; i < len; i++) {
        if (arguments.length === 1) {
            return this.elements[i][name];
        } else {
            this.elements[i][name] = value;
        }
    }
    return this;
};

Toad.prototype.html = function(value) {
    for (var i = 0, len = this.elements.length; i < len; i++) {
        if (arguments.length === 1) {
            this.elements[i].innerHTML = value;
        } else {
            return this.elements[i].innerHTML;
        }
    }
    return this;
};

Toad.prototype.data = function(name, value){
    for (var i = 0, len = this.elements.length; i < len; i++) {
        if (arguments.length === 1) {
            if (typeof this.elements[i].dataset !== "undefined") { // html5
                return this.elements[i].dataset[name];
            } else { // 向下兼容
                return this.elements[i].getAttribute(name);
            }

        } else {
            if (typeof this.elements[i].dataset !== "undefined") { // html5
                this.elements[i].dataset[name] = value;
            } else { // 向下兼容
                this.elements[i].setAttribute(name, value);
            }
        }
    }
    return this;
};

Toad.prototype.center = function() {
    for (var i = 0, len = this.elements.length; i < len; i++) {
        var top = (Toad.getViewport().height - parseInt(Toad.getStyle(this.elements[i], "height")))/2 + "px",
            left = (Toad.getViewport().width - parseInt(Toad.getStyle(this.elements[i], "width")))/2 + "px";
        this.elements[i].style.cssText = "position: fixed; top: " + top + "; left: " + left;
    }
    return this;
};

Toad.prototype.on = function(type, fn) {
    for (var i = 0, len = this.elements.length; i < len; i++) {
        if (typeof window.addEventListener !== "undefined") {
            this.elements[i].addEventListener(type, fn, false);
        } else { // ie 8 以下

        }
    }
    return this;
};

Toad.prototype.off = function(type, fn) {
    for (var i = 0, len = this.elements.length; i < len; i++) {
        if (typeof window.removeEventListener !== "undefined") {
            this.elements[i].removeEventListener(type, fn, false);
        } else { // ie 8 以下

        }
    }
    return this;
};

Toad.prototype.find = function(param) {
        if (typeof param === "string") {
            var arr = param.split(" "),
                temp = this.elements;

            for (var i = 0, len = arr.length; i < len; i++) {

                switch (arr[i].charAt(0)) {
                    case "#":
                        this.elements = [];
                        this.elements.push(this.getId(arr[i].substr(1)));
                        temp = this.elements;
                        break;

                    case ".":
                        this.elements = [];
                        for (var k = 0, length2 = temp.length; k < length2; k++) {
                            this.elements = this.elements.concat(this.getClass(arr[i].substr(1), temp[k]));
                        }
                        temp = this.elements;
                        break;

                    default:
                        this.elements = [];
                        for (var j = 0, length3 = temp.length; j < length3; j++){
                            this.elements = this.elements.concat(this.getTag(arr[i], temp[j]));
                        }
                        temp = this.elements;
                        break;
                }
            }
            this.elements = temp;
            temp = null;
        } else if (typeof param === "object") {
            this.elements.push(param);
        }
        return this;
};

Toad.prototype.form = function(name) {
    this.elements.push(document.forms[name]);
    return this;
};

Toad.prototype.value = function(name, value) {
    for (var i = 0, len = this.elements.length; i < len; i++) {
        if (arguments.length === 1) {
            return this.elements[i].elements[name];
        } else {
            this.elements[i].elements[name] = value;
        }
    }
    return this;
}

Toad.prototype.parent = function() {
    for (var i = 0, len = this.elements.length; i < len; i++) {
        this.elements[i] = this.elements[i].parentNode;
    }
    return this;
};

Toad.prototype.click = function(fn){
    for (var i = 0, len = this.elements.length; i < len; i++) {
        this.elements[i].addEventListener("click", fn, false);
    }
    return this;
};

var TS = function(param) {
    return new Toad(param);
};
