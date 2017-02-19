function toArray(items) {
    var temp = [];
    for (var i = 0, len = items.length; i < len; i++) {
        temp[i] = items[i];
    }
    return temp;
}

function getStyle(elem, attr) {
    return window.getComputedStyle(elem)[attr];
}

function css() {
    var itemHeight = getViewport().height - 130;
    var move = getElem(".move");
    getElem(".skill-list").style.height = itemHeight + "px";
    getElem(".company-list").style.height = itemHeight + "px";
    getElem(".company-list").style.paddingTop = (itemHeight - 75)/2 + "px";
    move.style.height = itemHeight + "px";
    toArray(getElems(".item")).forEach(function(item, index, arr) {
        item.style.height = itemHeight + "px";
        item.addEventListener("touchstart", function(e) {
            var touch = e.touches[0];
            var start = touch.clientY;
            item.addEventListener("touchmove", function(e) {
                if (e.touches[0].clientY < start) {
                    if (item.nextElementSibling !== null) {
                        move.style.transform = "translateY(" + (-itemHeight * (index + 1)) + "px" + ")";
                    } else {
                        move.style.transform = "translateY(" + (-itemHeight * (index)) + "px" + ")";
                    }             
                } else {
                    if (item.previousElementSibling !== null) {
                        move.style.transform = "translateY(" + (-itemHeight * (index - 1)) + "px" + ")";
                    } else {
                        move.style.transform = "translateY(" + (-itemHeight * (index)) + "px" + ")";
                    }
                }
            }, false)
        }, false);
    });
}

function getViewport() {
    return {
        width: document.documentElement.clientWidth,
        height: document.documentElement.clientHeight
    }
}

function getElem(selector) {
    return document.querySelector(selector);
}

function getElems(selector) {
    return document.querySelectorAll(selector);
}

function toggleNav(toggle, click) {
    var container = getElem(toggle);
    var article = container.children;
    container.style.height = (getViewport().height - 50) + "px";
    for (var k=0, lenk = article.length; k < lenk; k++) {
        article[k].style.height = (getViewport().height - 50) + "px";
    }
    var list = getElem(click);
    var li = list.children;
    toArray(li).forEach(function(item, index) {
        item.addEventListener("touchstart", function() {
            getElem(".active").classList.remove("active");
            getElem(".click").classList.remove("click");
            this.classList.add("click");
            article[index].classList.add("active");
        }, false); 
    });
}

toggleNav(".container", ".list");
css();

window.onresize = function() {
    toggleNav(".container", ".list");
    css();
}

// 数据
var scores = [75, 80, 90, 40, 40];
var languages = ["JS", "CSS", "HTML", "NODE", "PHP"];

// 画布
var width = 300, height = 300;
var svg = d3.select(".me").append("svg")
            .attr("class", "svg")
            .attr("width", width)
            .attr("height", height);
var padding = {left: 30, right: 30, top: 20, bottom: 20};

// 比例尺
var xScale = d3.scaleBand().domain(languages).range([0, width - padding.left - padding.right]);
var yScale = d3.scaleLinear().domain([0, 100]).range([height - padding.top - padding.bottom, 0]);

// 坐标轴
var xAxis = d3.axisBottom().scale(xScale);
var yAxis = d3.axisLeft().scale(yScale);
var ryAxis = d3.axisRight().scale(yScale);

//
svg.append("g").attr("transform", "translate(30, 280)").call(xAxis);
svg.append("g").attr("transform", "translate(30, 20)").call(yAxis);
svg.append("g").attr("transform", "translate(270, 20)").call(ryAxis);

// 矩形
svg.selectAll("rect").data(scores).enter().append("rect")
   .attr("x", function(d, i) { return i * xScale.step(); })  
   .attr("width", xScale.step()/2)
   .attr("transform", "translate(40, 20)")
   .attr("fill", "steelblue")
   .attr("height", 0)
   .attr("y", 260)
   .transition().delay(function(d, i) {return i * 200}).duration(2000).ease(d3.easeBounceOut)
   .attr("y", function(d) { return yScale(d); })
   .attr("height", function(d) { return height - padding.top - padding.bottom - yScale(d); })

// 文字
svg.selectAll(".score").data(scores).enter().append("text")
   .attr("class", "score")
   .style("fill", "#fff")
   .attr("x", function(d, i) { return i * xScale.step() + 20; })
   .attr("dx", function(){ return xScale.step()/2 }).attr("dy", 20).text(function(d) { return d; })
   .attr("y", 270)
   .transition().delay(function(d, i) { return i * 200}).duration(2000).ease(d3.easeBounceOut)
   .attr("y", function(d) { return yScale(d) + 15; })