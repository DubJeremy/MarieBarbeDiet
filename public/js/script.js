(function($){

    
    
    var question = $('#faq > div > div .question');
    var answer = $('#faq > div > div .answer');
    
    answer.hide();
    
    question.on('click', function()
    {
        $(this).children().slideToggle('slow');
        $(this).siblings().children().slideUp();
    });
    

    $(document).ready(function(){
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