$(function(){
    if($.cookie('studentToken')){
        $('#login-button').addClass('hidden');
        $('#logout-button').removeClass('hidden');


    }else{
        $('#login-button').removeClass('hidden');
        $('#logout-button').addClass('hidden');

    }
})