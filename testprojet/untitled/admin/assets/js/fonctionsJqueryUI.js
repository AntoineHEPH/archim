$(document).ready(function () {
    //code ici
    $('h2').css('color','red');

    $('#p1').hide();
    $('#div1').hide();

    $('#cliquer').click(function(){
        $(this).css({
            'color': 'red',
            'font-weight' : 'bold',
            'font-size' : '200%'
        })
        $('#p1').show();
        $('#div1').fadeIn(1000);
    })


    $('#p1').mouseover(function(){
        $('#div1').css('background-color', 'pink')
    })
    $('#calendrier').datepicker();

    $('#tirer').click(function(){
        $('#menu').toggle('slide');
    })
});