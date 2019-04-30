<?php

class mydesign {
  public function database_connect() {
        $conn = @mysql_connect('ebitshares.ipagemysql.com', 'urfren_samson', '091074889701_a');
        if (!$conn) { die('Could not connect: ' . mysql_error());  }
        mysql_select_db('xdb_tbcmerchantservices', $conn);
    }

    public function doc_type() {
      echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    }

    public function html_start($xmlns) {
      echo '<html xmlns="'.$xmlns.'">';
    }

  public function html_end() {
      echo '</html>';
    }

    public function head_start() {
      echo '<head>';
    }

    public function head_end() {
      echo '</head>';
    }

    public function link($href){
      echo '<link href="'.$href.'" rel="stylesheet" />';
    }

    public function link_icon($icon) {
      echo '<link rel="shortcut icon" type="image/x-icon" href="'.$icon.'" />';
    }

    public function script($src){
      echo '<script src="'.$src.'"></script>';
    }

    public function meta($http_equiv, $content, $name){
      echo '<meta name="'.$name.'" http-equiv="'.$http_equiv.'" content="'.$content.'">';
    }

    public function title_page($title) {
      echo '<title>'.$title.'</title>';
    }

    public function body_start($attrib) {
      echo '<body '.$attrib.'>';
    }

  public function body_end() {
      echo '</body>';
    }

    public function category_option() {
      $query="select * from xtbl_category Order by Category ASC";
      $rs=mysql_query($query);
      while($row=mysql_fetch_assoc($rs)) {
        echo '<option value="'.$row['Category'].'">'.$row['Category'].'</option>';
      }
    }

    public function country_option() {
      $query="select * from xtbl_country Order by Country ASC";
      $rs=mysql_query($query);
      while($row=mysql_fetch_assoc($rs)) {
        echo '<option value="'.$row['Country'].'">'.$row['Country'].'</option>';
      }
    }

    public function page_welcome_header_start() {
    ?>
      <div style="background-color: rgb(255,255,255,0.5); height: auto; padding-top: 10px;
      background-image: url('https://tbcmerchantservices.com/images/Picture3.jpg'); background-size: 100% auto">
    <?php

    }

    public function page_welcome_header_end() {
      echo '</div>';
    }

    public function edudona_table() {
      ?>


      
      <?php
    }
}

?>
