<?php
    var_dump($min_sup);
    $controller = "manage/manage_parameter/1";
    echo form_open($controller)
?>
    <div class="control-group">
        <label class="control-label" for="min_sup">Minimum Support</label>
        <div class="controls">
            <input type="text" name="min_sup" id="min_sup" class="input-large" value="<?php echo $min_sup; ?>"/>
            <button type="submit" class="btn btn-primary input-large">Submit</button>
        </div>
    </div>
<?php
        echo form_close();
?>
