(function($){

    
    
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
    
    // -----------------------------------------------

    var burger = $('header #burger');
    var menu = $('header nav div:nth-child(3) ');
    var cross = $('header #cross')
    var menu = $('header nav ul li');

    cross.on('click', function()
      {
        menu.slideToggle();
        console.log('ok');
      
        heading.on('click', function()
         {
             menu.slideUp();
         });
    });
    
})(jQuery);