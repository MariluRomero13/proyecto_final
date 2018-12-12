let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let abrir = document.getElementById('cancelar');
let cerrar = document.getElementById('close');
let no = document.getElementById('no');
let si = document.getElementById('si');
let registrar = document.getElementById('registrar');
let venta = document.getElementById('miVenta');
let cerrar2 = document.getElementById('close2');

registrar.addEventListener('click', function(){
    venta.style.display = 'block';
});

abrir.addEventListener('click', function(){
    modal.style.display = 'block';
});

cerrar.addEventListener('click', function(){
    modal.style.display = 'none';
});

cerrar2.addEventListener('click', function(){
    venta.style.display = 'none';
});

no.addEventListener('click', function(){
    modal.style.display = 'none';
});

si.addEventListener('click', function(){
    modal.style.display = 'none';
});

window.addEventListener('click', function(e){
    console.log(e.target);
    if(e.target == flex){
        modal.style.display = 'none';
    }
});

window.addEventListener('click', function(e){
    console.log(e.target);
    if(e.target == flex){
        venta.style.display = 'none';
    }
});