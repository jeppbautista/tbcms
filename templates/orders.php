<?php 
    class View{

        function container_start(){
        ?>
            <div class="container">
        <?php
        }

        function header_text($text){
            ?>
            <div class="row">
              <div class="col-12 col-md-12">
                <h2 id="header_text"><?php echo $text ?></h2>
              </div>
            </div>
            <?php
        }

        function table_header(){
        ?>
            <table class="table table-hover tabl-condensed">
                <thead>
                    <td colspan="2">Order #</td>
                    <td>Foo</td>
                </thead>

        <?php
        }

        function product_row(){
        ?>
            <tr>
                <td style="width:60%">Product</td>
                <td style="width:15%">Quantity</td>
                <td style="width:25%">Status</td>
            </tr>
        <?php
        }

        function container_end(){
        ?>
            </div>
        <?php
        }

        function breakline(){
        ?>
            <br>
        <?php
        }
    }
?>