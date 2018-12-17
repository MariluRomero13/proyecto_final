let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');

let no = document.getElementById('no');

let registrar = document.getElementById('registrar');
let cerrar = document.getElementById('close');
let vender = document.getElementById('vender');


registrar.addEventListener('click', function(){
    modal.style.display = 'block';
});

cerrar.addEventListener('click', function(){
    modal.style.display = 'none';
});

vender.addEventListener('click', function(){
    modal.style.display = 'none';

});

//no.addEventListener('click', function(){
    //modal.style.display = 'none';
//});

window.addEventListener('click', function(e){
    console.log(e.target);
    if(e.target == flex){
        modal.style.display = 'none';
    }
});