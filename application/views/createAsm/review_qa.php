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
$prev = "question_and_answer";
$next = "result_condition";
?>
<ul class="pager">
    <li class="previous">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$prev}"); ?>">&larr; Question & Answer</a>
    </li>
    <li class="next">
        <a href="<?php echo base_url("index.php/assessment/create_asm_view/{$next}"); ?>">Result Condition &rarr;</a>
    </li>
</ul>
<hr>
                <div style="text-align: center">
                    <h3>Assessment Name</h3>
                    <p> Type: <small>Assessment Type</small> Creator: <small>Creator Name</small></p>
                    <p>
                        <small>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor
                        id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac,
                        vestibulum at eros. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.
                        </small>
                    </p>
                </div>
                <hr/>
                    <div id="question" style="margin-left: 30px">
                        <input type="text" name="txt" id = "txt" value="" onkeyup = "copyIt()"><br>
                        <input type="text" name="txt1" id = "txt1"  value=""><br>

                        <script type = "text/javascript">
                            function copyIt() {
                            var x = document.getElementById("txt").value;
                            document.getElementById("txt1").value = x;
                        }
                        </script>

                        <h4>1. โต๊ะของคุณเป็นอย่างไร</h4>
                        <div id="answer">
                            <label class="radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                    Option one is this and that—be sure to include why it's great
                            </label>
                            <label class="radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    Option two can be something else and selecting it will deselect option one
                            </label>
                        </div>
                    </div>
                    <br/>
                    <div id="question" style="margin-left: 30px">
                        <h4>2. เก้าอี้ของคุณเป็นอย่างไร</h4>
                        <div id="answer">
                            <label class="radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                Option one is this and that—be sure to include why it's great
                            </label>
                            <label class="radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                Option two can be something else and selecting it will deselect option one
                            </label>
                        </div>
                    </div>
                    <br/>
                    <div id="question" style="margin-left: 30px">
                        <h4>3. ตู้ของคุณเป็นอย่างไร</h4>
                        <div id="answer">
                            <label class="radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                Option one is this and that—be sure to include why it's great
                            </label>
                            <label class="radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                Option two can be something else and selecting it will deselect option one
                            </label>
                        </div>
                    </div>

<hr>




