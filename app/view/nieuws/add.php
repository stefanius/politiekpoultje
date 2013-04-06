<form method="post" id="add_nieuws" action="">
    <dl>
        <dt>Titel:</dt> <dd><input type="text" name="titel"></dd><br/>
        <dt>Url:</dt>  <dd><input type="text" name="urlpart"></dd><br/>
        <dt>Teaser:</dt> <dd><textarea class="ckeditor" name="teaser"></textarea></dd><br/>
        <dt>Content:</dt> <dd><textarea class="ckeditor" name="content"></textarea></dd><br/>
        <input type="submit" name="save" value="Opslaan" />
    </dl>
</form>

<?php
    echo $Template->loadJavascript('packages/ckeditor/ckeditor.js', URL_ASSETS);
?>

<script type="text/javascript">
    CKEDITOR.replace( 'teaser',
    {
        toolbar :
        [
                { name: 'basicstyles', items : [ 'Bold','Italic','Underline' ] },
        ],
        uiColor : '#9AB8F3'
    });
    
    CKEDITOR.replace( 'content',
    {
        toolbar :
        [
                { name: 'basicstyles', items : [ 'Bold','Italic','Underline' ] },
                { name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
                { name: 'tools', items : [ 'Maximize','-','About' ] }
        ],
        uiColor : '#9AB8F3'
    });
</script>

