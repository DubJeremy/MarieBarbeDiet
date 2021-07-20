(function($){
    
    var burger = $('header #burger');
    var menu = $('header nav div:nth-child(3) ');
    var cross = $('header #cross')
    var nav = $('header nav ul li');
    
    burger.on('click', function()
        {
            menu.slideToggle();
            console.log('ok');
          
            nav.on('click', function()
            {
                menu.slideUp();
            });

            cross.on('click', function()
            {
                menu.slideUp();
            });
        });
        
        // -----------------------------------------------
        
        var question = $('#faq > div > div .question');
        var answer = $('#faq > div > div .answer');
        
        answer.hide();
        
        question.on('click', function()
        {
            console.log('ok');
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