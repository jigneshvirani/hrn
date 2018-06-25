$(document).ready(function(){
            $(".nav-item").click(function(){
                $('.nav-item.active').removeClass('active');
    			$(this).addClass('active');
        });
});