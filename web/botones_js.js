/**
 * Created by Rafa on 01/03/2018.
 */
$(document).ready(function(){

    $('#btn_profesores').each(function() {
            animationHover(this, 'pulse');
    });

    $('#btn_add_profesores').each(function() {
        animationHover(this, 'pulse');
    });

    $('#btn_ver_profesores').each(function() {
        animationHover(this, 'pulse');
    });

    $('#btn_alumnos').each(function() {
        animationHover(this, 'pulse');
    });

    $('#btn_add_alumnos').each(function() {
        animationHover(this, 'pulse');
    });

    $('#btn_ver_alumnos').each(function() {
        animationHover(this, 'pulse');
    });

    $('#btn_empresas').each(function() {
        animationHover(this, 'pulse');
    });

    $('#btn_add_empresas').each(function() {
        animationHover(this, 'pulse');
    });

    $('#btn_ver_empresas').each(function() {
        animationHover(this, 'pulse');
    });

    $('#btn_ciclos').each(function() {
        animationHover(this, 'pulse');
    });

    $('#btn_add_ciclos').each(function() {
        animationHover(this, 'pulse');
    });

    $('#btn_ver_ciclos').each(function() {
        animationHover(this, 'pulse');
    });

    $('#btn_fct').each(function() {
        animationHover(this, 'pulse');
    });



    function animationHover(element, animation){
        element = $(element);
        element.hover(
            function() {
                element.addClass('animated ' + animation);
            },
            function(){
                //wait for animation to finish before removing classes
                window.setTimeout( function(){
                    element.removeClass('animated ' + animation);
                }, 2000);
            });
    }



    });


