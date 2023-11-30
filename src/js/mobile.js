const mobileMenuBtn = document.querySelector('#mobile-menu');
const cerrarMenuBtn = document.querySelector('#cerrar-menu');
const sidebar = document.querySelector('.sidebar');

if(mobileMenuBtn){
    mobileMenuBtn.addEventListener('click', function() {
        sidebar.classList.toggle('mostrar');
    })
}
if(cerrarMenuBtn){
    cerrarMenuBtn.addEventListener('click', function(){
        sidebar.classList.add('ocultar');
        setTimeout(() => {
            sidebar.classList.remove('mostrar');
            sidebar.classList.remove('ocultar');
        }, 800);
    });
}
//eliminar la clase de mostrar en tamasño tablet
const anchoPantalla = document.body.clientWidth;
window.addEventListener('resize', function() {
    const anchoPantalla = document.body.clientWidth;
    if(anchoPantalla >= 768){
        sidebar.classList.remove('mostrar');
    }
});