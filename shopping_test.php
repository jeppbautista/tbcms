<?php
session_start();
include 'class3.php';
include_once 'templates/shopping.php';
include_once 'objects/generic.php';
$class = new mydesign;
// $class->database_connect();
$view = View;

date_default_timezone_set('Asia/Manila');
$sessiondate = date('mdY');

$limit = 12;
$page = $_SESSION['session_ppage'];
$type = $_SESSION['session_ptype'];

if(isset($_POST['pageno'])) {
    $page=str_replace("'", '', $_REQUEST['pageno']);
    $page=str_replace('"', '', $page);
    $page=str_replace("<", '', $page);
    $page=str_replace('>', '', $page);

    $_SESSION['session_ppage']=$page;
    $page=$_SESSION['session_ppage'];
    echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';
}

if($page==""){$page=1;}

if(isset($_POST['shoptype'])) {
    $type=str_replace("'", '', $_REQUEST['shoptype']);
    $type=str_replace('"', '', $type);
    $type=str_replace("<", '', $type);
    $type=str_replace('>', '', $type);
    $_SESSION['session_ppage']=1;
    $_SESSION['session_ptype']=$type;
    $type=$_SESSION['session_ptype'];
    echo '<script>window.location.assign("https://tbcmerchantservices.com/shopping/");</script>';
}

if($type==""){$type='%%';}

$tbc_to_peso = getAllElements("xtbl_adminaccount")['Tbc_to_Peso'];

$class->doc_type();
$class->html_start('');
$class->head_start();
echo '<link rel="shortcut icon" type="image/x-icon" href="https://tbcmerchantservices.com/images/tbslogo.png" />';
$class->title_page('TBCMS | Online Shop');
$class->script('/js/jquery-3.1.1.js');
$class->script('/js/bootstrap.js');
$class->link('/css/bootstrap.css');
$class->link('css/style-shopping.css');
$class->link('https://www.w3schools.com/w3css/4/w3.css');
$class->link('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
$class->link('/assets/lib/fontawesome-free-5.9.0-web/css/all.min.css');
$class->script('/js/jquery1.3.js');
$class->link('assets/css/custom.css');
$class->head_end();

$class->body_start('id="shopping"');
if(!isset($_SESSION['session_tbcmerchant_ctr'.$sessiondate]))
{
    $class->page_home_header_start();
    $class->page_shopping_header_content1();
    $class->page_home_header_end();
    // $class->page_shopping_navbar_content1();

}
else{
    $ctr=$_SESSION['session_tbcmerchant_ctr'.$sessiondate];
    $account_info = getAllElementsWithCondition("xtbl_account_info", "Main_Ctr", $ctr);

    
    if($account_info['Email_Status']=='INACTIVE' || 
        $account_info['Account_Status']=='INACTIVE' || 
        $account_info['Card_Status']=='INACTIVE') {
		header("location: https://tbcmerchantservices.com/home/");
    }
    else {
        if($account_type=='MERCHANT') {
            $class->page_home_header_start();
            $class->page_home2_header_content();
            $class->page_home_header_end();
            
        }
        else { //if buyer
            $class->page_home_header_start();
            $class->page_home3_header_content();
            $class->page_home_header_end();
        }
    }
    
}
include 'nav_shop.php';
?>
<div class="container-fluid">
    <div class="row shadow">
        <div class="col-md-2">
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading category-heading">
                        <h4 class="panel-title">
                            <a class="category clickable" data-toggle="collapse" href="#collapse1">Categories</a>
                            <a class="category notclickable" data-toggle="collapse" href="#collapse1">Categories</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in wrapper category-list">
                        <ul class="list-group">
                            <li class="list-group-item">&#8226; <a href="#">Baby and toddler</a> </li>
                            <li class="list-group-item">&#8226; <a href="#">Camera</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Computers</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Education</a></li>
                            <li class="list-group-item">&#8226; <a href="#">General services</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Groceries</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Health and beauty</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Home and living</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Home appliances</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Men and women fashion</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Mobiles</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Monitor and TV</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Personal services</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Pets</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Sport</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Toys and games</a></li>
                            <li class="list-group-item">&#8226; <a href="#">Travel</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="carousel slide" data-ride="carousel" id="header-slider">
                <ol class="carousel-indicators">
                    <li data-target="#header-slider" data-slide-to="0" class="active"></li>
                    <li data-target="#header-slider" data-slide-to="1"></li>
                    <li data-target="#header-slider" data-slide-to="2"></li>
                    <li data-target="#header-slider" data-slide-to="3"></li>
                    <li data-target="#header-slider" data-slide-to="4"></li>
                    <li data-target="#header-slider" data-slide-to="5"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="images/shop-Header1.png" style="max-width: 100%;">
                    </div>
                    <div class="item">
                        <img src="images/Header2.png" style="max-width: 100%;">
                    </div>
                    <div class="item">
                        <img src="images/Header3.png" style="max-width: 100%;">
                    </div>
                    <div class="item">
                        <img src="images/Header4.png" style="max-width: 100%;">
                    </div>
                    <div class="item">
                        <img src="images/Header5.png" style="max-width: 100%;">
                    </div>
                    <div class="item">
                        <img src="images/Header6.png" style="max-width: 100%;">
                    </div>
                </div>
                <a class="left carousel-control" href="#header-slider" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#header-slider" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        <div class="col-md-2">
            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading featured-heading">
                        <h4 class="panel-title">
                            <a class="category clickable" data-toggle="collapse" href="#collapse1">Featured products</a>
                            <a class="category notclickable" data-toggle="collapse" href="#collapse1">Featured products</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in wrapper">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="thumb-img">
                                    <img src="https://tbcmerchantservices.com/products/75586e6fe1ff617f27c172b7210899618clorelazinc.png">
                                </div>
                                <div class="thumb-name">
                                    <p>Chlorella with Zinc and Iron (Power Booster)</p>
                                </div>
                                <div class="thumb-price">
                                    <p>&#8369; 850</p>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="thumb-img">
                                    <img src="https://tbcmerchantservices.com/products/75586e6fe1ff617f27c172b7210899618clorelazinc.png">
                                </div>
                                <div class="thumb-name">
                                    <p>Chlorella with Zinc and Iron (Power Booster)</p>
                                </div>
                                <div class="thumb-price">
                                    <p>&#8369; 850</p>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="thumb-img">
                                    <img src="https://tbcmerchantservices.com/products/75586e6fe1ff617f27c172b7210899618clorelazinc.png">
                                </div>
                                <div class="thumb-name">
                                    <p>Chlorella with Zinc and Iron (Power Booster)</p>
                                </div>
                                <div class="thumb-price">
                                    <p>&#8369; 850</p>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="thumb-img">
                                    <img src="https://tbcmerchantservices.com/products/75586e6fe1ff617f27c172b7210899618clorelazinc.png">
                                </div>
                                <div class="thumb-name">
                                    <p>Chlorella with Zinc and Iron (Power Booster)</p>
                                </div>
                                <div class="thumb-price">
                                    <p>&#8369; 850</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    
    <div class="row">
        <div class="col-md-3" style="border-right: 1px solid #999fff; text-align:center">
            <h5> <b>Fast Delivery</b> </h5>
            <img src="/images/delivery-truck.png" alt="">
        </div>
        <div class="col-md-3" style="border-right: 1px solid #999fff; text-align:center">
            <h5> <b>Money Return</b> </h5>
            <img src="/images/growth.png" alt="">
        </div>
        <div class="col-md-3" style="border-right: 1px solid #999fff; text-align:center">
            <h5> <b>Support 24/7</b> </h5>
            <img src="/images/avatar.png" alt="">
        </div>
        <div class="col-md-3" style="text-align:center">
            <h5> <b>Secured Payment</b> </h5>
            <img src="/images/virus.png" alt="">
        </div>
    </div>
    <br>
    <p class="subheader">Our Products</p>
    <hr>
    
</div>
<div class="row">
        <div class="row product-row">
            <div class="col-md-2 col-md-offset-1">
                <div class="shopping-product shadow">
                    
                    <div class="product-img">
                        <img src="https://tbcmerchantservices.com/products/75586e6fe1ff617f27c172b7210899618clorelazinc.png">
                    </div>
                    <div class="product-name">
                        <p>Chlorella with Zinc and Iron (Power Booster)</p>
                    </div>
                    <div class="product-price">
                        <p>&#8369; 850</p>
                        <a class="btn more-info">Details</a>
                    </div>
                
                </div>
            </div>
            <div class="col-md-2">
                <div class="shopping-product shadow">
                    
                    <div class="product-img">
                        <img src="https://tbcmerchantservices.com/products/75586e6fe1ff617f27c172b7210899618clorelazinc.png">
                    </div>
                    <div class="product-name">
                        <p>Chlorella with Zinc and Iron (Power Booster)</p>
                    </div>
                    <div class="product-price">
                        <p>&#8369; 850</p>
                        <a class="btn more-info">Details</a>
                    </div>
                
                </div>
            </div>
            <div class="col-md-2">
                <div class="shopping-product shadow">
                    <div class="product-img">
                        <img src="https://tbcmerchantservices.com/products/39d9013dc47501e6f5a56910f39e35aefblack1.jpg">
                    </div>
                    <div class="product-name">
                        <p>Lady blouse black</p>
                    </div>
                    <div class="product-price">
                        <p>&#8369; 150</p>
                        <a class="btn more-info">Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="shopping-product shadow">
                    <div class="product-img">
                        <img src="https://tbcmerchantservices.com/products/202764161884cec70838d8d3bf65a63b6b0Bboost.jpg">
                    </div>
                    <div class="product-name">
                        <p>B-Boost Oral Vitamin Spray</p>
                    </div>
                    <div class="product-price">
                        <p>&#8369; 1500</p>
                        <a class="btn more-info">Details</a>
                    </div>
                </div>
                
            </div>
            <div class="col-md-2">
                <div class="shopping-product shadow">
                    <div class="product-img">
                        <img src="https://tbcmerchantservices.com/products/736b097d92d78b9a9d2adb5db717655c1phyto2.png">
                    </div>
                    <div class="product-name">
                        <p>PhytoPlus with Moringa Extract</p>
                    </div>
                    <div class="product-price">
                        <p>&#8369; 2000</p>
                        <a class="btn more-info">Details</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-1">
                <div class="shopping-product shadow">
                    
                    <div class="product-img">
                        <img src="https://tbcmerchantservices.com/products/75586e6fe1ff617f27c172b7210899618clorelazinc.png">
                    </div>
                    <div class="product-name">
                        <p>Chlorella with Zinc and Iron (Power Booster)</p>
                    </div>
                    <div class="product-price">
                        <p>&#8369; 850</p>
                        <a class="btn more-info">Details</a>
                    </div>
                
                </div>
            </div>
            <div class="col-md-2">
                <div class="shopping-product shadow">
                    
                    <div class="product-img">
                        <img src="https://tbcmerchantservices.com/products/75586e6fe1ff617f27c172b7210899618clorelazinc.png">
                    </div>
                    <div class="product-name">
                        <p>Chlorella with Zinc and Iron (Power Booster)</p>
                    </div>
                    <div class="product-price">
                        <p>&#8369; 850</p>
                        <a class="btn more-info">Details</a>
                    </div>
                
                </div>
            </div>
            <div class="col-md-2">
                <div class="shopping-product shadow">
                    <div class="product-img">
                        <img src="https://tbcmerchantservices.com/products/39d9013dc47501e6f5a56910f39e35aefblack1.jpg">
                    </div>
                    <div class="product-name">
                        <p>Lady blouse black</p>
                    </div>
                    <div class="product-price">
                        <p>&#8369; 150</p>
                        <a class="btn more-info">Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="shopping-product shadow">
                    <div class="product-img">
                        <img src="https://tbcmerchantservices.com/products/202764161884cec70838d8d3bf65a63b6b0Bboost.jpg">
                    </div>
                    <div class="product-name">
                        <p>B-Boost Oral Vitamin Spray</p>
                    </div>
                    <div class="product-price">
                        <p>&#8369; 1500</p>
                        <a class="btn more-info">Details</a>
                    </div>
                </div>
                
            </div>
            <div class="col-md-2">
                <div class="shopping-product shadow">
                    <div class="product-img">
                        <img src="https://tbcmerchantservices.com/products/736b097d92d78b9a9d2adb5db717655c1phyto2.png">
                    </div>
                    <div class="product-name">
                        <p>PhytoPlus with Moringa Extract</p>
                    </div>
                    <div class="product-price">
                        <p>&#8369; 2000</p>
                        <a class="btn more-info">Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br>
<hr>
<br>
<?php
$class->page_welcome_header_content_start_footer_new();
?>