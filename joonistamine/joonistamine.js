function kustuta(){
    var t=document.getElementById("louend").getContext("2d")
    t.clearRect(0,0,600,600);
}
function every(){
    jalad();
    keha();
    käed();
    pea();
    kaela();
    nägu();
}
function jalad(){
    var t=document.getElementById("louend").getContext("2d")
    t.fillStyle="#b84295";
    t.fillRect(70,140,30,50)
    
    t.fillStyle="#b84295";
    t.fillRect(101,140,30,50)
    
    t.fillStyle="0082fc";
    t.fillRect(70,140,60,3)
    
    t.fillStyle="0082fc";
    t.fillRect(100,130,1,60)
}
function keha(){
    var t=document.getElementById("louend").getContext("2d")
    t.fillStyle="#b84295";
    t.fillRect(70,84,61,56)
}
function käed(){
    var t=document.getElementById("louend").getContext("2d")

    t.fillStyle="#b84295";
    t.fillRect(50,84,20,45)

    t.fillStyle="#b84295";
    t.fillRect(131,84,20,45)

    t.fillStyle="#0082fc";
    t.fillRect(50,129,20,10)

    t.fillStyle="#0082fc";
    t.fillRect(131,129,20,10)


}
function kaela(){
    var t=document.getElementById("louend").getContext("2d")

    t.fillStyle="#0082fc";
    t.fillRect(90,81,20,3)
}
function pea(){
    var t=document.getElementById("louend").getContext("2d")

    t.beginPath();
    t.arc(100,57,25,Math.PI*2,0,true);
    t.closePath();
    t.fillStyle="pink";
    t.fill();
    
}
function nägu(){
    var t=document.getElementById("louend").getContext("2d")

    t.fillStyle="#000000";
    t.fillRect(90,52,5,5)

    t.fillStyle="#000000";
    t.fillRect(105,52,5,5)

    t.fillStyle="#000000";
    t.fillRect(95,72,10,2)

    t.fillStyle="#000000";
    t.fillRect(105,70,2,2)

    t.fillStyle="#000000";
    t.fillRect(93,70,2,2)


    

    t.fillStyle="#0082fc";
    t.fillRect(109,36,7,7)

    t.fillStyle="#0019fc";
    t.fillRect(115,38,8,8)

    t.fillStyle="#0019fc";
    t.fillRect(103,33,8,8)
}