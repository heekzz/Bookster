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


function search() {
    "use strict";   
    var input, filter, objects, i, obj;
    input = document.getElementById('searchAndHide');
    filter = input.value.toUpperCase();
    objects = document.getElementsByClassName('bookingobject');
    for (i = 0; i < objects.length; i++) {
        obj = objects[i];
        if (obj.innerHTML.toUpperCase().indexOf(filter) > -1) {
            obj.style.display = '';
        } else {
            obj.style.display = 'none';
        }
    }
}

//$("#searchAndHide").on('keyup', function(){
//    var matcher = new RegExp($(this).val(), 'gi');
//    $('.bookingobject').show().not(function(){
//        return matcher.test($(this).find('.bookingtext').text())
//    }).hide();
//});