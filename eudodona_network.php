<?php

  include 'class.php';
  $class = new mydesign;
  $class->doc_type();
  $class->html_start('');
  $class->head_start();
  $class->title_page('TBCMS : EDUDONA');

  $class->script('https://tbcmerchantservices.com/js/jquery-3.1.1.js');
  $class->script('https://tbcmerchantservices.com/js/bootstrap.js');
  $class->link('https://tbcmerchantservices.com/css/bootstrap.css');
  $class->script('https://tbcmerchantservices.com/js/jquery.js');

?>
<div style="background-color: rgb(255,255,255,0.5); height: auto; padding-top: 10px; background-image: url('https://tbcmerchantservices.com/images/Picture3.jpg'); background-size: 100% auto">
    <div class="container">
      <div class="col-md-10" style="padding-bottom: 5px;">
        <img width="230px" src="https://tbcmerchantservices.com/images/tbsheader.png">
      </div>
      <div class="col-md-2" style="padding-bottom: 5px; text-align: center;">
      </div>
    </div>
  </div>
<div class="wrapper">
  <div class="container">
    <div class="row ph-1">
      <div class="col-md-6 left align-middle"><img id = "img-network" src="https://tbcmerchantservices.com/images/network.jpg" alt=""></div>
      <div class="col-md-6 col-xs-12 right">
        <div class="row">
          <h1 class="text-left"> Be a part of </h1>
          <h1 class="text-right"> TBCMS Edudona Network</h1>
        </div>
        <br>
        <div class = "row">
          <div class="col-md-4 div-center">
            <button class="btn btn-primary" id = "btn-register">Register Now</button>
          </div>
        </div>
        <br>

        <div class = "row" style="margin-top:10vh">
          <h4>Download the TBCMS app NOW!</h4>
        </div>

        <div class = "row">
          <div class="col-md-4 div-center">
            <a href='https://play.google.com/store/apps/details?id=tbcservices.thebillioncoinapp&pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1'>
              <img id="img-google-play" alt='Get it on Google Play' src='https://tbcmerchantservices.com/images/google-play-badge.png'/>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class = "ph-2">
  <div class="container">
    <div class="row">
      <div class = "col-md-6">
        <div class = "col-md-6 div-center">
          <h3 class = "text-justify"> <strong>How does EDUDONA works?</strong> </h3>
          <p>Watch our slideshow presentation and start donating and earning.</p>
          <a href="https://docs.google.com/presentation/d/1LbQLboXtDeczKGSf4kzaXjzxrs8G7y5mhr9_h7YEYnA/edit?usp=sharing" target="_blank" class = "btn btn-success">  WATCH SLIDESHOW</a>
        </div>
      </div>
      <div class = "col-md-6">
        <div class = "col-md-6 div-center">
          <h3 class = "text-justify"> <strong>Already a part of the EDUDONA family?</strong> </h3>
          <p>Great! We hope you are having a good time.</p>
          <button class = "btn btn-success">Proceed to Dashboard</button>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  h1 {
    font-size: 43px;
  }

  .container{
    width: 95%:
    margin-bottom: 30px;
  }
  .div-center{
    margin: 0 auto;
    float: none;
  }

  .ph-1 {
    height: 90vh;
  }

  .ph-2 {
    background: #F49D04 !important;
    color: white;
    height: 50vh;
    padding: 10vh;
  }


  .right {
    margin-top: 15vh;
  }

  .wrapper {
    width: 95%;
    margin:  0 auto;
  }

  #btn-register {
    border-radius: 5%;
    width: 100%;
  }

  #img-google-play {
    width: 100%;
  }

  #img-network {
    width: 100%;
    margin-top: 15vh;
  }

</style>

<?php $class->page_welcome_header_content_start_footer2(); ?>
<!-- https://play.google.com/store/apps/details?id=tbcservices.thebillioncoinapp -->
