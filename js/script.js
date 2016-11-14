function date() {
    "use strict";
    var x = document.getElementById('demo').innerHTML = Date();
    return x;
}

var x = 0;

function add() {
    "use strict";
    x++;
    document.getElementById('add').innerHTML = x;
}
var k = document.getElementById('move');

function move() {
    "use strict";
    if (k.style.textAlign.match("right")) {
        k.style.textAlign = "left";
    } else {
        k.style.textAlign = "right";
    }
}

function color() {
    "use strict";
    var j = document.getElementById("color");
    j.style.color = "blue";
}