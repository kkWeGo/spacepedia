function slidediv(id, contains, change, page, setFixed, setOpacity, setLista) {
    var e = document.getElementById(id);
    var title = document.getElementById('title');
    var navbar = document.getElementById('navbar');
    var body = document.getElementById('body');
    var lista = document.getElementById('lista');
    if (e.classList.contains(contains)) {
        if (setOpacity) {
            title.setAttribute('style', 'opacity: 0');
            navbar.setAttribute('style', 'opacity: 0');
            if (setLista){
                lista.setAttribute('style', 'opacity: 0');
            }
        }
        if(setFixed){
            doRedirect(page);
            setTimeout(function(){e.setAttribute('style', 'position: fixed')}, 1100);
            body.setAttribute('style', 'overflow: hidden')
        }
        e.classList.remove(contains);
        e.classList.add(change);
    } else {
        if(setFixed){
            doRedirect(page);
            setTimeout(function(){e.setAttribute('style', 'position: absolute')}, 1100);
            body.setAttribute('style', 'overflow: scroll')
        }
        if (setOpacity) {
            title.setAttribute('style', 'opacity: 1');
            navbar.setAttribute('style', 'opacity: 1');
            if (setLista){
                lista.setAttribute('style', 'opacity: 1');
            }
        }
        e.classList.remove(change);
        e.classList.add(contains); 
    }
}
function doRedirect(page) {
    location.href = page;
}
function init() {
    slidediv('div-search', 'div-top', 'div-center', '#hero', 0, 0);
    slidediv('div-account-r', 'div-top', 'div-center', '#hero', 0, 0);
    slidediv('div-account-l', 'div-top', 'div-center', '#hero', 0, 0);
    slidediv('cut', 'div-left', 'div-center', '#hero', 0, 0);
}
function initb(){
    slidediv('init', 'div-right', 'div-center', '#hero', 0, 0);
}
function slidedivmsg(){
    slidediv('div-msg', 'div-right', 'div-center', '#hero', 1, 1);
}
function slidedivmsgadmin(){
    slidediv('div-msg', 'div-right', 'div-center', '#hero', 0, 0);
}
function scroll(){
    var el = document.getElementById('title');
    var bounding = el.getBoundingClientRect();
    console.log(bounding.top);
    if (bounding.top <= -125) {
        document.getElementById('navbar').classList.replace('notfixed', 'fixed');
    } else {
        document.getElementById('navbar').classList.replace('fixed', 'notfixed');
    }
    
}