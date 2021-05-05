document.onclick = disappear

//Makes the dropdown to disappear
function disappear() {
    var x = document.getElementById("livesearch");
    x.style.display = "none";
}

//Makes the dropdown to appear
function appear() {
    var x = document.getElementById("livesearch");
    x.style.display = "block";
}

//Prevents scrolling when navigating with up and down arrows through the dropdown list
window.addEventListener("keydown", function(e) {
    if(["Space","ArrowUp","ArrowDown","ArrowLeft","ArrowRight"].indexOf(e.code) > -1) {
        e.preventDefault();
    }
}, false);

//Toggles the appearence of the bar
function toggle_bar() {
    var bar = document.getElementById("bar");

    bar.classList.toggle('bar_hidden'); // toggle the hideP class
    bar.classList.toggle('bar_visible'); // toggle the hideP class

    var main = document.getElementById("main");

    main.classList.toggle('main_narrow'); // toggle the hideP class
    main.classList.toggle('main_wide'); // toggle the hideP class
}

//Toggles registration form
function toggle_bar_reg_form() {
    var reg_form = document.getElementById("bar_reg_form");
    var login_form = document.getElementById("bar_login_form");

    reg_form.classList.toggle('bar_reg_form_hidden'); // toggle the class
    reg_form.classList.toggle('bar_reg_form_visible'); // toggle the hideP class

    //Hide the login form if visible
    if (login_form.classList.item(0) === "bar_login_form_visible") {
        login_form.classList.toggle('bar_login_form_hidden'); // toggle the hideP class
        login_form.classList.toggle('bar_login_form_visible'); // toggle the hideP class
    }
}

//Toggles login form
function toggle_bar_login_form() {
    var login_form = document.getElementById("bar_login_form");
    var reg_form = document.getElementById("bar_reg_form");

    login_form.classList.toggle('bar_login_form_hidden'); // toggle the hideP class
    login_form.classList.toggle('bar_login_form_visible'); // toggle the hideP class

    //Hide reg form if visible
    if (reg_form.classList.item(0) === "bar_reg_form_visible") {
        reg_form.classList.toggle('bar_reg_form_hidden'); // toggle the class
        reg_form.classList.toggle('bar_reg_form_visible'); // toggle the hideP class
    }
}

//Displays the result after sending an AJAX request to the server
function search(str=null) {
    if(str != null) {
        var word = str;
    } else {
        var word = document.getElementById("input").value;
    }

    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("result").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","/current_version_of_projects/dict/procedural/project_root/search/search?word="+word,true);
    xmlhttp.send();
}

/* This block takes the inserted part of the word and sends it to the handler in order to
show the next closest 5 words in db */
function showResult(str) {
    if (str.length==0) {
        document.getElementById("livesearch").innerHTML="";
        document.getElementById("livesearch").style.border="0px";
        return;
    }
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("livesearch").innerHTML=this.responseText;
            document.getElementById("livesearch").style.border="1px solid gray";
        }
    }
    xmlhttp.open("GET","/current_version_of_projects/dict/procedural/project_root/search/livesearch?wordpart="+str,true);
    xmlhttp.send();

    appear();

    var identifier = -1;

    var main = document.getElementById("main");
    main.onkeydown = checkKeycode

    function checkKeycode(e) {
        var keycode;
        keycode = window.event.keyCode || window.event.which;

        if (keycode === 40) {
            if (identifier > -2 && identifier < 9) {
                identifier++;
                var element = document.getElementById(identifier);
                if(typeof(element) != 'undefined' && element != null) {
                    highlight();
                } else {
                    identifier--;
                }
            }
        }

        if (keycode === 38) {
            if (identifier > 0 && identifier < 10) {
                identifier--;
                highlight();
            } else if (identifier === 0) {
                highlight_input();
            }
        }

        if (keycode === 8 || keycode === 39 || keycode === 37 || keycode === 36 || (keycode > 48 & keycode < 57) || keycode === 8 || keycode === 36 || (keycode > 48 & keycode < 58) || (keycode > 64 & keycode < 91)) {
            highlight_input();
        }

        function highlight() {
            document.getElementById(identifier).focus();
        }

        function highlight_input() {
            document.getElementById("input").focus();
        }
    }
}

//Prevents the forms from submitting and reloading the page
window.onload = function () {
    var srch_btn = document.getElementById("srch_btn");

    srch_btn.addEventListener("click", function(event) {
        event.preventDefault();
    });
}

//Searches for the inserted word when Enter is pressed
function searchByEnter(str) {
    var keycode;
    keycode = window.event.keyCode || window.event.which;

    if(keycode === 13) {
        // Get the input field
        const search_form = document.getElementById("search_form");

        search_form.onsubmit = function (e) {
            e.preventDefault();
        }
        search(str);
        disappear();
    }
}

