<?php
    class View{
        function container_start(){
        ?>
            <div class="container">
        <?php
        }

        function table_header(){
        ?>
            <table class="table">
            <tr>

            </tr>
        <?php
        }

        function modal_accept(){
        ?>
            <div id="modal_accept" class="modal fade">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header"><h4>CONFIRMATION</h4></div>
                        <div class="modal-body">
                            <b>ARE YOU SURE YOU WANT TO ACCEPT THIS REQUEST?</b>
                        </div>
                        <div class="modal-footer">
                            <form method="POST">
                                <input name="temporary_value" hidden/>
                                <input type="submit" name="temporary_value_submit" hidden />
                            </form>
                            <a href="javascript:void(0)" onclick="$('[name=temporary_value_submit]').click();"
                                class="btn btn-primary">&nbsp YES &nbsp</a>
                            <a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal">
                                &nbsp&nbsp NO &nbsp&nbsp</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }

        function modal_denied(){
        ?>
            <div id="modal_denied" class="modal fade">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header"><h4>CONFIRMATION</h4></div>
                        <div class="modal-body">
                            <b>ARE YOU SURE YOU WANT TO DENY THIS REQUEST?</b>
                        </div>
                        <div class="modal-footer">
                            <form method="POST">
                                <input name="temporary_valueD" hidden/>
                                <input type="submit" name="temporary_value_submitD" hidden />
                            </form>
                            <a href="javascript:void(0)" onclick="$('[name=temporary_value_submitD]').click();"
                                class="btn btn-primary">&nbsp YES &nbsp</a>
                            <a href="javascript:void(0)" class="btn btn-danger" data-dismiss="modal">
                                &nbsp&nbsp NO &nbsp&nbsp</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }

        function table_footer(){
        ?>
            </table>
        <?php
        }

        function container_end(){
        ?>
            </div> 
        <?php
        }

        function div_end(){
        ?>
            </div>
        <?php
        }
    }
?>