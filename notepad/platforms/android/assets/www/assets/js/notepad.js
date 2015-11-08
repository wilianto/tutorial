var canvas = document.getElementById("canvas");
var pencil_btn = document.getElementById("pencil");
var eraser_btn = document.getElementById("eraser");
var context = canvas.getContext("2d");
var n = 60; //value of toolbar
var tool;

function init(){
    //set height & width
    canvas.height = window.innerHeight - n;
    canvas.width = window.innerWidth;

    //set listener for touch
    canvas.addEventListener("touchstart", ev_canvas, false);
    canvas.addEventListener("touchmove", ev_canvas, false);
    canvas.addEventListener("touchend", ev_canvas, false);

    //set first tool selected is pencil
    select_pencil();
}

//event listerner for canvas
function ev_canvas(e){
    if(tool != null){
        //call listener
        var func = tool[e.type];
        if(func){
            func(e);
        }
    }
}

//select pencil tool to draw
function select_pencil(){
    tool = new tool_pencil();
    pencil.className = "active";
    eraser.className = "";
}

//select eraser tool to erase
function select_eraser(){
    tool = new tool_eraser();
    pencil.className = "";
    eraser.className = "active";
}

//tool pencil to draw
function tool_pencil(){
    this.selected = false;

    this.touchstart = function(e){
        this.selected = true;
        context.beginPath();
        context.moveTo(e.changedTouches[0].pageX, e.changedTouches[0].pageY - n);
    };

    this.touchmove = function(e){
        if(this.selected){
            e.preventDefault();
            context.lineTo(e.changedTouches[0].pageX, e.changedTouches[0].pageY - n);
            context.stroke();
        }
    };

    this.touchend = function(e){
        context.closePath();
        this.selected = false;
    };
}

//tool pencil to erase
function tool_eraser(){
    this.selected = false;

    this.touchstart = function(e){
        this.selected = true;
        context.beginPath();
        context.moveTo(e.changedTouches[0].pageX, e.changedTouches[0].pageY - n);
    };

    this.touchmove = function(e){
        if(this.selected){
            e.preventDefault();
            context.clearRect(e.changedTouches[0].pageX, e.changedTouches[0].pageY - n, 8, 8);
        }
    };

    this.touchend = function(e){
        context.closePath();
        this.selected = false;
    };
}

//save note to file
function save(){
    window.canvas2ImagePlugin.saveImageDataToLibrary(function(msg){
        console.log(msg);
        alert("Data saved!");
    }, function(err){
        alert(err);
    }, document.getElementById("canvas"));
}

function new_canvas(){
    if(confirm("Are you sure want to clear the canvas?")){
        context.clearRect(0, 0, window.innerWidth, window.innerHeight);
    }
}

function onFailed(error){
    console.log(error);
    alert(error.code);
}
