<?php
class MainView{
    function docType(){
    ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <?php
    }

    function htmlStart(){
    ?>
        <html xmlns="">
    <?php
    }

    function htmlEnd(){
    ?>
        </html>
    <?php
    }

    function headStart(){
    ?>
        <head>
    <?php
    }

    function headEnd(){
    ?>
        </head>
    <?php
    }

    function link($href){
    ?>
        <link href='<?php echo $href ?>' rel="stylesheet" />
    <?php
    }

    function linkIcon($icon){
    ?>
        <link rel='shortcut icon' type='image/x-icon' href='<?php echo $icon ?>' />
    <?php
    }

    public function script($src)
	{
    ?>
		<script src= '<?php echo $src ?>' ></script>
    <?php
    }

	public function meta($http_equiv, $content, $name)
	{
    ?>
		<meta name= '<?php echo $name ?>' http-equiv='<?php echo $http_equiv ?>' content='<?php echo $content ?>'>
    <?php
    }

    function titlePage($titlePage){
    ?>
        <title> <?php echo $titlePage ?> </title>
    <?php
    }
}
?>