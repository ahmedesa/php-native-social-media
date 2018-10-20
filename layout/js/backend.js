$(document).ready(function(){
    $('.Changepass').click(function(){
        $.ajax ({
            type: "GET" , 
            url : "change_pass.php" ,
            sucsses: function(x){

                $('.setting').html(x);

            }

        })

    });

});

$(document).ready(function() {
    $('.info').click(function() {
        $.ajax({
            type: "GET",
            url: "1.php",
            beforeSend: function() {
                $(".output").append('<img src = "loading.gif" border = "0 " />');

            },
            success: function(data) {

                $(".output").html(data);
            }
        })
    });
});