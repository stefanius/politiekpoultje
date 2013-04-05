function error_display(box,errorMessage){
        $(box).addClass("error-displayed");
        $(box).closest('.control-group').addClass('error');
        if(errorMessage){ // if error message is set
                if($(box).parent().find('.help-inline.error').length == 0){ // add error message if not yet added
                        $(box).parent().append('<span class="help-inline error">'+errorMessage+'</span>');
                }else{
                        $(box).parent().find('.help-inline.error').html(errorMessage);
                }
        }
}
function error_hide(box,errorMessage){
        $(box).removeClass("error-displayed");
        if($(box).parent().find('.error-displayed').length == 0){ // add error if no items in this row have errors
                $(box).closest('.control-group').removeClass('error');
        }
        if(errorMessage){ // if error message is set
                if($(box).parent().find('.error-displayed').length == 0){ // add error if no items in this row have errors
                        $(box).parent().find('.help-inline.error').remove();
                }
        }
}
$('form').submit(function(){
        console.log('test');
        var error = null;
        $($(this).find('.control-group').find('[data-validation]').get().reverse()).each(function(){ // Select items in reverse order.
                var value	=	$(this).val();
                var validation	=	$(this).attr("data-validation");
                var errorMessage	=	$(this).attr("data-error");
                switch(validation){
                        case 'empty':
                                if(value == ""){
                                        error_display(this,errorMessage);
                                        error = true;
                                }else{
                                        error_hide(this,errorMessage);
                                }
                        break;
                        case 'zipcode':
                                value	=	value.replace( /\s/g, ""); // remove spaces from value
                                if(!value.match(/^[0-9]{4}[a-z|A-Z]{2}$/i)) {
                                        error_display(this,errorMessage);
                                        error = true;
                                }else{
                                        error_hide(this,errorMessage);
                                }
                        break;
                        case 'email':
                                if(!value.match(/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i)){
                                        error_display(this,errorMessage);
                                        error = true;
                                }else{
                                        error_hide(this,errorMessage);
                                }
                        break;
                        case 'phone':
                                if((value.length != 10) || (value.substr(0,1) != "0")){
                                        error_display(this,errorMessage);
                                        error = true;
                                }else{
                                        error_hide(this,errorMessage);
                                }
                        break;
                        case 'length30':
                                if((value.length < 30)){
                                        error_display(this,errorMessage);
                                        error = true;
                                }else{
                                        error_hide(this,errorMessage);
                                }
                        break;
                        case 'date':
                                if(value && !value.match(/^([0-9]{2})-([0-9]{2})-([0-9]{4})$/i)){
                                        error_display(this,errorMessage);
                                        error = true;
                                }else{
                                        error_hide(this,errorMessage);
                                }
                        break;
                        case 'bankaccount':
                                value	=	value.replace( /\s/g, ""); // remove spaces from value
                                value	=	value.replace(/\./g, ""); // remove dots from value
                                value	=	value.replace(/\,/g, ""); // remove comma's from value
                                if(value == ""){
                                        errorMessage	=	'Rekeningnummer niet ingevuld.';
                                        error_display(this,errorMessage);
                                        error = true;
                                }else if(value.substr(0,1) == "P"){
                                        if( value.length < 5 || value.length > 8){
                                                errorMessage	=	'Postbanknummer ongeldig';
                                                error_display(this,errorMessage);
                                                error = true;
                                        }else{
                                                error_hide(this,errorMessage);
                                        }
                                }else{
                                        if(value.length < 9 || value.length > 10){
                                                errorMessage	=	'Bankrekeningnummer geen geldige lengte, postbanknummers beginnen met een P. Gebruik gÃ©Ã©n puntjes.';
                                                error_display(this,errorMessage);
                                                error = true;
                                        }else{
                                                var s = 0;
                                                for(i = 0; i < value.length; i++) s += (9 - i) * parseInt(value.substr(i, 1));
                                                if(s % 11){	// rekeningnummer voldoet niet aan de elf-proef
                                                        errorMessage	=	'Bankrekeningnummer ongeldig';
                                                        error_display(this,errorMessage);
                                                        error = true;
                                                }else{
                                                        error_hide(this,errorMessage);
                                                }
                                        }
                                }
                        break;
                }
        });
        if(error){
                var pos = $(this).offset();
                $('html, body').animate({scrollTop:pos.top}, 'slow');
                return false;
        }else{
                // Do not post form twice
                if(this.beenSubmitted){
                        if(!$(this).find("input[type='submit']").next().is('.submitting-form')){ // next is not submitting-form
                                $('<span class="help-inline submitting-form"><img src="/images/icons/loading.gif" width="15" height="15" />Formulier wordt verstuurd</span>').insertAfter($(this).find("input[type='submit']"));
                        }
                        return false;
                }else{
                        this.beenSubmitted = true;
                }
        }
});