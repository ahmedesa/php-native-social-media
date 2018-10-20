    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

 <footer id="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">
                         &copy; Copyright 2018. AHMED ESSA</p>
                    </div>
                </div>
            </div>
        </footer>

<!--ajax like and unlike request   -->
<script type = "text/javascript">
  $(document).ready(function(){
    
    $(document).on('click', '.like', function(){
      var id=$(this).val();
      var $this = $(this);
      $this.toggleClass('like');
      if($this.hasClass('like')){
        $this.text('Like'); 
      } else {
        $this.text('Unlike');
        $this.addClass("unlike"); 
      }
        $.ajax({
          type: "POST",
          url: "like.php",
          data: {
            id: id,
            unlike: 1,
          },
          success: function(){
            showLike(id);
          }
        });
    });
    
    $(document).on('click', '.unlike', function(){
      var id=$(this).val();
      var $this = $(this);
      $this.toggleClass('unlike');
      if($this.hasClass('unlike')){
        $this.text('Unlike'); 
      } else {
        $this.text('Like');
        $this.addClass("like"); 
      }
        $.ajax({
          type: "POST",
          url: "like.php",
          data: {
            id: id,
            like: 1,
          },
          success: function(){
            showLike(id);
          }
        });
    });
    
  });
  
  function showLike(id){
    $.ajax({
      url: 'showlikes.php',
      type: 'POST',
      async: false,
      data:{
        id: id,
        showlike: 1
      },
      success: function(response){
        $('#show_like'+id).html(response);
        
      }
    });
  }
  
</script>  
  <!--ajax setting page request  : change pass  -->

   <script>
        $(document).ready(function() {
            $('.Changepass').click(function() {
            
           
                $.ajax({
                    type: "GET",
                    url: "change_pass.php",
                 
                    success: function(data) {

                        $(".setting").html(data);
                    }
                })
            });
        });
    </script>


  <!--ajax setting page request  : change profileimg  -->


   <script>
        $(document).ready(function() {
            $('.Changeimg').click(function() {
            
           
                $.ajax({
                    type: "GET",
                    url: "change_profileimg.php",
                 
                    success: function(data) {

                        $(".setting").html(data);
                    }
                })
            });
        });
    </script>

  <!--ajax send message  -->
<script>
$(document).ready(function()
    {
        $(document).on('keypress', function(e) {
            if(e.keyCode==13){
         $('#my_form').submit();
         $('#comment').val("");
             }
        });
  });
</script>
<script type="text/javascript">


function godown(){

$(function () {
         $('.chat-box-main').animate({
              scrollTop: $(".chat-box-main").offset().top + $(".chat-box-main")[0].scrollHeight
          }, 1000);
});


}


function post(id)
{
  var comment = document.getElementById("comment").value;
  if(comment && id)
  {
    $.ajax
    ({
      type: 'post',
      url: 'msgjax.php',
      data: 
      {
       user_comm:comment,
       user_name:id
      },
      success: function (response) 
      {
      document.getElementById("comment").value="";
      }
    });
  }
  
  return false;
}
</script>


<script>
 function autoRefresh(){
  if(location.pathname == "/SocialNetwork/chat.php" ){
      var reciver = document.getElementById("userid").value;
      $("#result").load("load.php?reciver="+reciver).show();
    }
}
 
  setInterval('autoRefresh()', 1000);
</script>



  <script type="text/javascript">
    $(document).ready(function () {
        if(location.pathname == "/SocialNetwork/chat.php" ){
 godown();
}
    });
</script>



   	 </body>
		</html>