(function(){  

    document.body.addEventListener('click', function() {
        var tiempo = new Date();
        tiempo = moment(tiempo).format('YYYY-MM-DD HH:mm:ss');
        document.getElementById("miTiempo").setAttribute('value', tiempo);
        console.log(tiempo);
    });


})();