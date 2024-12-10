var x;
var y;

function pageLoad(){
    x = document.getElementById("login");
    y = document.getElementById("register");
    var form_state = document.getElementById("form_state").value;
    // console.log(form_state);
    if(form_state == "signup"){
        register();
    }
}

window.onload = pageLoad;

function login() {
    x.style.left = "4px";
    y.style.right = "-520px";
    x.style.opacity = 1;
    y.style.opacity = 0;
}

function register() {
    console.log(x ,y);
    x.style.left = "-510px";
    y.style.right = "5px";
    x.style.opacity = 0;
    y.style.opacity = 1;
}