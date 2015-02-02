<?php
$metaTITLE['fr'] = 'Contact';
$metaTITLE['en'] = 'Contact';
$bodyClass = 'contact';

include 'includes/header.php';
?>
<div style="overflow:auto;">
<div class="left-box">
	<div class="left-box-top"></div>
    <div class="left-box-content">
    	<h2>Contact</h2>
		
        
		<div class="contact-box" id="contact-montreal">
            <div class="contact-info">
            	<div class="google-map">
            		<iframe width="300" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.ca/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=1207+rue+St-Andr%C3%A9,++Montr%C3%A9al,+QC+H2L+3S8&amp;aq=&amp;sll=49.891235,-97.15369&amp;sspn=31.042996,93.076172&amp;ie=UTF8&amp;hq=&amp;hnear=1207+Rue+Saint-Andr%C3%A9,+Montr%C3%A9al,+Qu%C3%A9bec+H2L+4Z9&amp;ll=45.515422,-73.555922&amp;spn=0.016419,0.045447&amp;z=15&amp;output=embed"></iframe>
                </div>
                <?php if($_conf['translation']['lang'] == 'en'){ ?>
                
                <!-- DÉBUT ANGLAIS -->
                
            	<h4>Le Lab Mastering</h4>
                <p>1207 rue St-Andr&eacute;,</p>
				<p>Montr&eacute;al, QC H2L 3S8</p>
				<p>&nbsp;</p>
                <p class="contact-phone">(514) 312-2122</p>
                <p><a href="mailto:info@lelabmastering.com" class="blue">info@lelabmastering.com</a></p>
                
                <!-- FIN ANGLAIS -->
                
                <?php } else { ?>
                <!-- DÉBUT FRANÇAIS -->
                
               <h4>Le Lab Mastering</h4>
                <p>1207 rue St-Andr&eacute;,</p>
				<p>Montr&eacute;al, QC H2L 3S8</p>
				<p>&nbsp;</p>
                <p class="contact-phone">(514) 312-2122</p>
                <p><a href="mailto:info@lelabmastering.com" class="blue">info@lelabmastering.com</a></p>
                
                
                <!-- FIN FRANÇAIS -->
                <?php } ?>
            </div>
        </div>
        <div class="contact-box" id="contact-vegas">
            <div class="contact-info">
            	<div class="google-map">
            		<iframe width="300" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.ca/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=3570+Las+Vegas+Boulevard+South,++Las+Vegas&amp;aq=&amp;sll=36.119562,-115.173347&amp;sspn=0.010261,0.022724&amp;ie=UTF8&amp;hq=&amp;hnear=3570+Las+Vegas+Blvd+S,+Las+Vegas,+Nevada+89109,+%C3%89tats-Unis&amp;z=14&amp;ll=36.119562,-115.173347&amp;output=embed"></iframe>
                </div>
                <?php if($_conf['translation']['lang'] == 'en'){ ?>
                
                <!-- DÉBUT ANGLAIS -->
            	<h4>Le Lab Mastering</h4>
                <p>3570 Las Vegas Boulevard South,</p>
				<p>Las Vegas, NV 89109</p>
				<p>&nbsp;</p>
                <p class="contact-phone">(702) 562-2356</p>
                <p><a href="mailto:info@lelabmastering.com" class="blue">info@lelabmastering.com</a></p>
                
                <!-- FIN ANGLAIS -->
                
                <?php } else { ?>
                <!-- DÉBUT FRANÇAIS -->
                
              <h4>Le Lab Mastering</h4>
                <p>3570 Las Vegas Boulevard South,</p>
				<p>Las Vegas, NV 89109</p>
				<p>&nbsp;</p>
                <p class="contact-phone">(702) 562-2356</p>
                <p><a href="mailto:info@lelabmastering.com" class="blue">info@lelabmastering.com</a></p>
                
                <!-- FIN FRANÇAIS -->
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="left-box-bottom"></div>
</div>

<div id="right-col">
    <div class="right-box">
        <div class="right-box-top"></div>
        <div class="right-box-content">
			<?php if($_conf['translation']['lang'] == 'en'){ ?>
            
            <!-- DÉBUT ANGLAIS -->
        	<h3>Booking</h3>
            <p>Please fill up the form below and we'll get back to you as soon as possible.</p>
            <form id="booking">
            	<p>
                	<label for="name">Your Name</label>
                	<input class="required" id="booking-name" type="text" name="name" maxlength="50" tabindex="1" />
                </p>
                <p>
            		<label for="phone">Phone num</label>
                    <input class="required phone-field" id="booking-phone3" type="text" name="phone" maxlength="4" style="width:55px" tabindex="4" /><span class="phone-field"> - </span>
                    <input class="required phone-field" id="booking-phone2" type="text" name="phone" maxlength="3" tabindex="3" /><span class="phone-field"> - </span>
                	<input class="required phone-field" id="booking-phone1" type="text" name="phone" maxlength="3" tabindex="2" />
                    
                    
                </p>
                <p>
            		<label for="email">Email</label>
                	<input class="required" id="booking-email" type="text" name="email" maxlength="50" tabindex="5" />
                </p>
                <p class="message">
                	<label for="message">Message</label>
                    <textarea class="required" id="booking-message" name="message" tabindex="6"></textarea>
                </p>
                <p>
                	<input type="button" onclick="validateBeforeSend();" class="submit" value="Send" tabindex="7" />
                </p>
            </form>
            <p id="booking-alert"></p>

            <h3>File Upload</h3>
            <p>You can securely upload your files here:</p>
            <a id="webcargo" href="https://www.webcargo.net/request/index/id/4330987/dp/06C23dgxEpz7UXqRBH" target="_blank">Upload</a>
                
            <!-- FIN ANGLAIS -->
            
            <?php } else { ?>
            <!-- DÉBUT FRANÇAIS -->
            
            <h3>R&eacute;servation</h3>
            <p>Veuillez remplir le formulaire ci-bas et nous vous r&eacute;pondrons dans les plus brefs d&eacute;lais.</p>
            <form id="booking">
            	<p>
                	<label for="name">Votre nom</label>
                	<input class="required" id="booking-name" type="text" name="name" maxlength="50" tabindex="1" />
                </p>
                <p>
            		<label for="phone">T&eacute;l&eacute;phone</label>
                    <input class="required phone-field" id="booking-phone3" type="text" name="phone" maxlength="4" style="width:55px" tabindex="4" /><span class="phone-field"> - </span>
                    <input class="required phone-field" id="booking-phone2" type="text" name="phone" maxlength="3" tabindex="3" /><span class="phone-field"> - </span>
                	<input class="required phone-field" id="booking-phone1" type="text" name="phone" maxlength="3" tabindex="2" />
                    
                    
                </p>
                <p>
            		<label for="email">Courriel</label>
                	<input class="required" id="booking-email" type="text" name="email" maxlength="50" tabindex="5" />
                </p>
                <p class="message">
                	<label for="message">Message</label>
                    <textarea class="required" id="booking-message" name="message" tabindex="6"></textarea>
                </p>
                <p>
                	<input type="button" onclick="validateBeforeSend();" class="submit" value="Envoyer" tabindex="7" />
                </p>
            </form>
            <p id="booking-alert"></p>
                
            <h3>Transfert de Fichier</h3>
            <p>Vous pouvez nous transf&eacute;rer vos fichiers de fa&ccedil;on s&eacute;curitaire:</p>
            <a id="webcargo" href="https://www.webcargo.net/request/index/id/4330987/dp/06C23dgxEpz7UXqRBH" target="_blank">Transf&eacute;rer</a>
            <!-- FIN FRANÇAIS -->
            <?php } ?>
            
        </div>
        <div class="right-box-bottom"></div>
    </div>
</div>    
</div>


<!-- SCRIPT DE VALIDATION -->
<script type="text/javascript">
function validateBeforeSend(){
	var valid = true;
	var empty = '';
	var validemail = '';
	var validphone = '';
	$('.required').removeClass('booking-error');
	
	
	$('.required').each(function(){
		var tmpHTML = '';
		if(trim($(this).val()) == '' || $(this).val() == 'null'){
			$(this).addClass('booking-error');
			empty = 'One or more fields are empty, please fill all the required fields.<br/>';
			valid = false;
		}
	});
	
	for(var i=1;i<=3;i++){
		if(isNaN($('#booking-phone' + i).val())){
			$('#booking-phone' + i).addClass('booking-error');
			validphone = 'Please enter only numbers in the phone number fields.<br/>';
			valid = false;
		}
	}
	
	if(isNotEmail($('#booking-email').val())){
		$('#booking-email').addClass('booking-error');
		validemail = 'Please enter a valid email address.<br/>';
		valid = false;
	}
	
	$('#booking-alert').html('<div class="booking-alert-error">' + empty + validphone + validemail + '</div>');
	
	if(valid) sendBooking();
}

function isNotEmail(email){
	var regex = /^[A-Z0-9\._%\+\-]+@[A-Z0-9\.\-]+\.(?:[A-Z]{2}|com|org|net|edu|gov|mil|biz|info|mobi|name|aero|asia|jobs|museum)$/i;
	if(regex.exec(email)) return false;
	else return true;
}

function trim (myString){
	return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
} 

function sendBooking(){
	$.ajax({
	  type: "POST",
	  url: "<?php echo $_conf['path']['base_url']; ?>actions/sendBooking.php",
	  data: "name=" + $('#booking-name').val() + "&phone=" + $('#booking-phone1').val() + '-' +$('#booking-phone2').val() + '-' + $('#booking-phone3').val() + "&email=" + $('#booking-email').val() + "&engineer=" + $('#booking-engineer').val() + "&message=" + $('#booking-message').val() + '&lang=<?php echo $_conf['translation']['lang']; ?>',
	  success: function(msg){
			$('#booking-alert').html('<div class="booking-alert-success">' + msg + '</div>');
	  }
	});	
}
</script>

<?php
include 'includes/footer.php';
?>