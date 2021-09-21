$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function() {
     return this.href == url;
    }).addClass('active').parent();

    while(true){
        if (element.is('li')){
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
});

jQuery(function($) { 
            $('#cp1').colorpicker(); 
            $('#cp2').colorpicker();
            $('#cp3').colorpicker();
            $('#cp4').colorpicker();
            $('#cp5').colorpicker();
            $('#cp6').colorpicker();
            $('#cp7').colorpicker();
            $('#cp8').colorpicker();
            $('#cp9').colorpicker();
            $('#cp10').colorpicker();
            $('#cp11').colorpicker();
            $('#cp12').colorpicker();
            $('#cp13').colorpicker();
            $('#cp14').colorpicker();
            $('#cp15').colorpicker();
            $('#cp16').colorpicker();
            $('#cp17').colorpicker();
            $('#cp18').colorpicker();
            $('#cp19').colorpicker();
            $('#cp20').colorpicker();
            $('#cp21').colorpicker();
            $('#cp22').colorpicker();
            $('#cp23').colorpicker();
            $('#cp24').colorpicker();
            $('#cp25').colorpicker();
            $('#cp26').colorpicker();
            $('#cp27').colorpicker();
            $('#cp28').colorpicker();
            $('#cp29').colorpicker();
            $('#cp30').colorpicker();
            $('#cp31').colorpicker();
            $('#cp32').colorpicker();
            $('#cp33').colorpicker();
            $('#cp34').colorpicker();
            $('#cp35').colorpicker();
            $('#cp36').colorpicker();
            $('#cp37').colorpicker();
            $('#cp38').colorpicker();
            $('#cp39').colorpicker();
            $('#cp40').colorpicker();
            $('#cp41').colorpicker();
            $('#cp42').colorpicker();
            $('#cp43').colorpicker();
            $('#cp44').colorpicker();
            $('#cp45').colorpicker();
            $('#cp46').colorpicker();
            $('#cp47').colorpicker();
            $('#cp48').colorpicker();
            $('#cp49').colorpicker();
            $('#cp50').colorpicker();
            $('#cp51').colorpicker();
            $('#cp52').colorpicker();
            $('#cp53').colorpicker();
            $('#cp54').colorpicker();
            $('#cp55').colorpicker();
            $('#cp56').colorpicker();
            $('#cp57').colorpicker();
            $('#cp58').colorpicker();
            $('#cp59').colorpicker();
            $('#cp60').colorpicker();
            $('#cp61').colorpicker();
            $('#cp62').colorpicker();
            $('#cp63').colorpicker();
            $('#cp64').colorpicker();
            $('#cp65').colorpicker();
            $('#cp66').colorpicker();
            $('#cp67').colorpicker();
            $('#cp68').colorpicker();
            $('#cp69').colorpicker();
            $('#cp70').colorpicker();
            $('#cp71').colorpicker();
            $('#cp72').colorpicker();


            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip(); 
            });
        }); 
