var hotbod = document.querySelector("body");


showBtn.addEventListener('click',function(){
    sendBtn.style.display = "block";

});
function doStuff() {
    hotbod.className += " animate";
}

window.onload = function() {
    doStuff();
};