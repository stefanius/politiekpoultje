<form method="post" id="add_partij" action="" class="form form-horizontal well">
    <div class="control-group">
        <label class="control-label"><?php echo $Partij->getFormData('naam', 'caption') ?></label>
        <div class="controls">
            <input type="text" 
                   name="<?php echo 'naam' ?>" 
                   data-validation="<?php echo $Partij->getFormData('naam', 'data-validation') ?>" 
                   data-error="<?php echo $Partij->getFormData('naam', 'data-error') ?>">
        </div>
    </div>    

    <div class="control-group">
        <label class="control-label"><?php echo $Partij->getFormData('naam_kort', 'caption') ?></label>
        <div class="controls">
            <input type="text" 
                   name="<?php echo 'naam_kort' ?>" 
                   data-validation="<?php echo $Partij->getFormData('naam_kort', 'data-validation') ?>" 
                   data-error="<?php echo $Partij->getFormData('naam_kort', 'data-error') ?>">
        </div>
    </div>   
    
    <div class="control-group">
        <label class="control-label"><?php echo $Partij->getFormData('opgericht', 'caption') ?></label>
        <div class="controls">
            <input type="text" 
                   class="datepicker"
                   name="<?php echo 'opgericht' ?>" 
                   data-validation="<?php echo $Partij->getFormData('opgericht', 'data-validation') ?>" 
                   data-error="<?php echo $Partij->getFormData('opgericht', 'data-error') ?>">
        </div>
    </div>   

    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <input class="btn btn-success" type="submit" name="save" value="Opslaan" />
        </div>
    </div>
    
</form>

<?php
    echo $Template->loadJavascript('jshelpers/forms.js', URL_CORE_JS);
?>

<script>
    $(function() {
        $( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });    
</script>
    