(function($){
    
    var burger = $('header #burger');
    var menu = $('header nav >div:nth-child(2) ');
    var cross = $('header nav #cross')
    var nav = $('header nav ul li');
    var windowsSize = $(window).width();

    if (windowsSize < 1100)
    {
        menu.hide();
    }
    cross.hide();
    
    burger.on('click', function()
        {
            burger.slideToggle('fast');
            menu.slideToggle();
            cross.slideToggle('slow');
            nav.slideDown();
            
            // nav.on('click', function()
            // {
            //     menu.slideUp();

            //     nav.slideUp();
            // });
            
            cross.on('click', function()
            {
                menu.slideUp();
                cross.slideUp('fast');
                burger.slideDown('slow');
            });
        });
        
        // -----------------------------------------------
        
        var question = $('#faq > div > div .question');
        var answer = $('#faq > div > div .answer');
        
        answer.hide();
        
        question.on('click', function()
        {
            $(this).children().slideToggle('slow');
            $(this).siblings().children().slideUp();
        });

    // -----------------------------------------------
    
    $(document).ready(function()
    {
        $('.carousel').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: false,
            
        });
    });
    

    
})(jQuery);