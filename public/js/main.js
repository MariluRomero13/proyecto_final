let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let abrir = document.getElementById('cancelar');
let cerrar = document.getElementById('close');
let no = document.getElementById('no');
let si = document.getElementById('si');

abrir.addEventListener('click', function(){
    modal.style.display = 'block';
});

cerrar.addEventListener('click', function(){
    modal.style.display = 'none';
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