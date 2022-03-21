$('form button').on("click",function(e){
    if(!$.trim($('#id_title').val()).length || !$.trim($('#id_description').val()).length) {
        e.preventDefault();
    }
});