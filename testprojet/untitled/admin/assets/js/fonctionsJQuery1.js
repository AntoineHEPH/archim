$(document).ready(function() {
    $('#vie').hide();
    $('#deuxieme').hide();
    $('#troisieme').hide();
    $('#quatrieme').hide();
    $('#cinquieme').hide();
    $('#cacher').hide();
    $('#montrer_image').hide();
    $('#para1').hide();
    $('h1').click(function(){
        $(this).css({
            'color': 'red',
        })
        $('#vie').show();
    })

    $('#vie').mouseover(function(){
        $(this).css({
            'color': 'pink',
            'font-weight' : 'bold'
        })
    })

    $('#vie').mouseleave(function(){
        $('#para1').show();
    })

    $('#para1').click(function(){
        $('#deuxieme').show();
    })

    $('#para2').click(function(){
        $('#troisieme').show();
    })

    $('#para3').click(function(){
        $('#quatrieme').fadeIn(1000);
        $('#cacher').fadeIn(2000);
    })

    $('#para4').click(function(){
        $('#cinquieme').show();
    })

    $('#cacher').click(function(){
        $('#montrer_image').show();
    })
});