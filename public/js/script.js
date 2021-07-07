(function($){

    
    
    var question = $('#faq > div > div .question');
    var answer = $('#faq > div > div .answer');
    
    answer.hide();
    

    question.on('click', function()
    {
        $(this).children().slideToggle('slow');
        $(this).siblings().children().slideUp();
    });
    

})(jQuery);