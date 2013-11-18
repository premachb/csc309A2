<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title><?php echo $title; ?></title>
<link href="<?php echo base_url();?>css/default.css" rel="stylesheet" type="text/css" />
<noscript>
Javascript is not enabled! Please turn on Javascript to use this site.
</noscript>

<script type="text/javascript">
//<![CDATA[
base_url = '<?= base_url();?>';
//]]>
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/prototype.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/scriptaculous.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/customtools.js" ></script>
</head>
<body>
<div id="wrapper">
  <div id="header">
  <?php $this->load->view('header');?>
  </div>

  <div id="main">
	<?php echo validation_errors(); ?>
	
	<?php $attributes = array('firstname' => 'firstname', 'lastname' => 'lastname', 'creditcardNumber' => 'creditcardNumber',
	'expireDate' => 'expireDate', 'showtime_id' => 'showtime_id', 'seat' => 'seat')?>
	
	<?php echo form_open('main/booking/' . $showtime_id_pass . '/' . $seat_pass, $attributes, array('id' => 'validationForm')) ?>
	
	<h5>First Name</h5>
	<input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>" required size="50" />
	
	<h5>Last Name</h5>
	<input type="text" name="lastname" value="<?php echo set_value('lastname'); ?>" required size="50" />
	
	<h5>Credit Card Number</h5>
	<input type="text" id="creditcard" name="creditcardNumber" value="<?php echo set_value('creditcardNumber'); ?>" required size="16" />
	
	<h5>Credit Card Expiration Date</h5>
	<input type="text" id="expiredate" name="expireDate" value="<?php echo set_value('expireDate'); ?>" required size="4" />
	
	<input type="hidden" name="showtime_id" value="<?php echo $showtime_id_pass; ?>" />
	
	<input type="hidden" name="seat" value="<?php echo $seat_pass; ?>" />
	
	<div><input type="submit" value="Submit" /></div>
	
	</form>
  </div>

    <script>
    var creditcardNumber = document.getElementById('creditcard');
    var expireDate = document.getElementById('expiredate');
    
    var checkcreditCardValidity = function() {
    	creditcardNumber = document.getElementById('creditcard');
    	
        if ((creditcardNumber.value).length != 16) {
            creditcardNumber.setCustomValidity('The Credit Card Number Length needs to be 16');
        } else {
            creditcardNumber.setCustomValidity('');
        }        
    };
    
    var checkexpireDateValidity = function() {
    	expireDate = document.getElementById('expiredate');
    	
        if ((expireDate.value).length != 4) {
            expireDate.setCustomValidity('The expire date length needs to be 4');
        } else {
            expireDate.setCustomValidity('');
        }        
    };
    
    creditcardNumber.addEventListener('change', checkcreditCardValidity, false);
    expireDate.addEventListener('change', checkexpireDateValidity, false);



   var form = document.getElementById('validationForm');
    form.addEventListener('submit', function() {
        checkexpireDateValidity();
        
        if (!this.checkValidity()) {
            event.preventDefault();
            //Implement you own means of displaying error messages to the user here.
            creditcardNumber.focus();
        }

    }, false);
    
   var form2 = document.getElementById('validationForm');
    form2.addEventListener('submit', function() {
	    checkcreditCardValidity();
	    
	    if (!this.checkValidity()) {
	       event.preventDefault();
	       //Implement you own means of displaying error messages to the user here.
	       creditcardNumber.focus();
	    }
    
    }, false);
   </script>
  
  <div id="footer"> 
  <?php $this->load->view('footer');?>
  </div>
</div>
</body>
</html>