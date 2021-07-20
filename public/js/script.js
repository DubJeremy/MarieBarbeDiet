(function($){
    
    var burger = $('header #burger');
    var menu = $('header #menu ');
    var cross = $('header #cross')
    var nav = $('header nav ul li');

    menu.hide();
    
    burger.on('click', function()
        {
            nav.slideToggle();
            menu.slideToggle();
            
            nav.on('click', function()
            {
                menu.slideUp();

                nav.slideUp();
            });
            
            cross.on('click', function()
            {
                menu.slideUp();
                nav.slideUp();
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