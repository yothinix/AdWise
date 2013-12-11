<style>
    /* ROW CONTENT
    -------------------------------------------------- */

    /* Center align the text within the three columns below the carousel */
    .row .span4 {
        text-align: center;
    }
    .row h3 {
        font-weight: normal;
    }
    .row .span4 p {
        margin-left: 10px;
        margin-right: 10px;
    }

    .nav-tabs a {
        font-size: 14px;
    }
</style>

<h2 style="margin-top: -30px">Create Assessment</h2>
<hr/>
<?php
$page = "review_condition";
?>
<ul class="pager">
    <li class="previous">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$page}"); ?>">&larr; Review Condition</a>
    </li>
</ul>
<hr>

                <form class="form-horizontal"> <!--//Save ASM_info_data to initialize-->
                    <div class="control-group">
                        <label class="control-label" for="creator">Creator</label>
                        <div class="controls">
                            <input type="text" id="creator" placeholder="Name">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="inputBirthday"> Birthday </label>
                        <div class="controls">
                            <div class='input-append' id='datetimepicker1'>
                                <input type='text' name="birthday" data-format='yyyy-MM-dd'>
                                <span class='add-on'>
                                    <i data-date-icon='icon-calendar'></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <script type='text/javascript'>
                        $(function() {
                            $('#datetimepicker1').datetimepicker({
                            language: 'pt-BR'
                            });
                        });
                    </script>
                    <hr/>
                    <div style="text-align: center">
                        <button type="submit" class="btn btn-success btn-large input-large">Submit</button>
                    </div>
                </form>
<hr>

<script type="text/javascript" src="<?php echo base_url("/assets/js/bootstrap-datetimepicker.min.js"); ?>"></script>




