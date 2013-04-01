<h2>Registreren</h2>

<p>Om te kunnen reageren op nieuwsberichten of mee te kunnen doen aan peilingen, dient u een account aan te maken.</p>

<form method="post" id="add_partij" action="" class="form form-horizontal well"> 
    
    <?php foreach($formFields as $field): ?>      
        <div class="control-group">
            <label class="control-label"><?php echo $Deelnemer->getFormData($field, 'caption') ?></label>
            <div class="controls">
                <input type="text" name="<?php echo $field ?>" data-validation="<?php echo $Deelnemer->getFormData($field, 'data-validation') ?>" data-error="<?php echo $Deelnemer->getFormData($field, 'data-error') ?>">
            </div>
        </div>
    <?php endforeach; ?>
                
    <div class="control-group">
        <label class="control-label"></label>
        <div class="controls">
            <input class="btn btn-success" type="submit" name="save" value="Registreer" />
        </div>
    </div>
    
</form>

<?php
    echo $Template->loadJavascript('jshelpers/forms.js', URL_CORE_JS);
?>

