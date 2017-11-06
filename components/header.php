<!--Contains the top menus outlook and buttons. -->
<div class="header headerBackground">
  <div class="header-nav">
      <nav class="navbar navbar-default " role="navigation">
        <div class="container-fluid">
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="navbar-fixed-top" id="">
            <!-- <ul class="nav navbar-nav navbar-left">
              <li><a  style="cursor: pointer;" id="pokeForum">Svenska</a></li>
              <li><a  style="cursor: pointer;" id="news">English</a></li>
            </ul> -->
            <ul class="nav navbar-nav navbar-right">
              <li onclick="buttonPressed()" class="barCircle"><i id="openCloseBtn" style="margin-top:35%; margin-left: 35%; margin-bottom:35%; margin-right: 35%;" class="openButton fa fa-bars" aria-hidden="true"></i></li>
            </ul>


          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
  </div>
  <div class="jumbotron">
    <div class="row">
      <center><h1>Rasmus Lennartsson</h1></center>
    </div>
    <div style="margin-top: -2%;" class="row">
        <center><h3>-Programmerare-</h3></center>
    </div>
  </div>
</div>

<div class="overlay-right"> 
  <div class="col-md-offset-3 col-md-6 overlay-content-right">
    <div class="header-nav">
      <nav class="custom-menu-navbar" role="navigation">
          <div class="container-fluid">
            <div class="main-menu" id="main-menu">
              <ul class="menu-nav">
                <li><a class="menuLink navigationMenu" style="cursor: pointer;" id="#about">Om mig</a></li>
                <li><a class="menuLink navigationMenu" style="cursor: pointer;" id="#projects">Projekt</a></li>
                <li><a class="menuLink navigationMenu" style="cursor: pointer;" id="#cv">Mitt CV</a></li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
      </nav>
    </div>
  </div>
</div>


<script type="text/javascript">
  // Function to change menu button an slide in the menu.
  
    function buttonPressed(){
      var delay = 50;

      if($("#openCloseBtn").hasClass("openButton")){
        $(".overlay-right").css('width', '25%');
        $(".openButton").fadeOut(delay);

        setTimeout(function() { 
          $(".openButton").removeClass('fa fa-bars').addClass('closeButton').addClass('fa fa-times').removeClass('openButton').fadeIn(delay);
        }, delay);
      }else if($("#openCloseBtn").hasClass("closeButton")){
        $(".overlay-right").css('width', '0%');
        $(".closeButton").fadeOut(delay);

        setTimeout(function() { 
          $(".closeButton").removeClass('fa fa-times').addClass('openButton').addClass('fa fa-bars').removeClass('closeButton').fadeIn(delay);
        }, delay);
      }else{
        ;
      }  
    }
    
  $(document).ready(function(){
      $('.menuLink').on('click', function(){
        var nav = $(this).attr('id');
        $('html, body').animate({ scrollTop: $(nav).offset().top, queue:false, duration: 2000, easing: 'linear'});
        buttonPressed();
    });

  });

</script>