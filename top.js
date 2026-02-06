jQuery(function(){
    $(function () {
        $(window).scroll(function () { 
            if ($(this).scrollTop() > 500 ) {  
                $('#scrollUp').css('right','-20px'); 
            } else { 
                $('#scrollUp').removeAttr( 'style' ); 
            }
        });
    });
});