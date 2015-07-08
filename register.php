<?php 
include ("include.inc.php");
$ptitle= "Registration - $cfg[server_name]";
include ("header.inc.php");
?>
<div id="content">
<fieldset>
<legend>Registration</legend>
</fieldset>

<div class="mid">
<style>

tr > td{
padding-top:5px;
}
.form-control{
	width:300px;
	display:inline;
}
</style>
<table>
<tr><td style="width:230px; vertical-align: top"><label for="email"><b>Email address:</b></label></td><td>

<input class="form-control" placeholder="Email" id="email" type="text" />&nbsp;<span id="email_state"></span><div></div></td></tr>
<tr><td style="vertical-align: top"><label for="accname"><b>Desired Account Number:</b></label></td>
<td><input class="form-control" placeholder="Account Name" id="accname" type="text" />&nbsp;<span id="accname_state"></span><div>
</div></td></tr>
<?php
if (!$cfg['Email_Validate']) {?>

    <tr>
	<td style="vertical-align: top"><label for="password"><b>Choose a password:</b></label>
    </td><td>
	<p>
		Password consists of letters a-z, numbers 0-9, symbols(~!@#%&;,:\^$.|?*+()) and is at least 6 characters long.
		</p>
		<input class="form-control" placeholder="Password" id="password" type="password" />&nbsp;<span id="password_state"></span></td></tr>
    <tr><td style="vertical-align: top"><label for="confirm"><b>Re-enter password:</b></label>
    </td><td><input class="form-control" placeholder="Password Confirm" id="confirm" type="password" />&nbsp;<span id="confirm_state"></span><br/><br/></td></tr>
<?php } ?>

<?php
if($cfg['use_captcha']) {
    echo '<tr><td style="vertical-align: top"><b>Verification:</b></td><td><input class="form-control" id="captcha" placeholder="Captcha" type="text" style="text-transform: uppercase" />'.
    '<div>Type the characters you see in the picture below</div>'.
    '<img id="captcha_img" width="250px" height="40px" src="doimg.php?'.time().'" alt="Verification Image" /><br/><br/>'.
    '</td></tr>';
}
?>
<tr><td>
<input id="rules_check" type="checkbox" style="display:none" checked onclick="onRulesCheck(this)"/>
<span id="submit_load" style="color: red; font-weight: bold; text-decoration: blink;"></span>
<div id="submit_errors" style="color: red; font-weight: bold;"></div>
<div id="submit_success" style="color: green; font-weight: bold;"></div>
</td>
<td>
<button type="submit" id="submit_button" class="btn btn-primary" onclick="onSubmit()">Register <i class="glyphicon glyphicon-chevron-right"></i></button>
</td>
</tr>
</table>

<script type="text/javascript">
//<![CDATA[
function onRulesCheck(node) {
    if (node.checked) {
        node.disabled = true;
        $('submit_button').disabled = false;
    }
}

function onSubmit() {
    var params = new Array();
    params['email'] = $('email').value;
    params['accname'] = $('accname').value;

    params['captcha'] = $('captcha').value;
    params['submit'] = 'yes';
<?php if (!$cfg['Email_Validate']) {?>
    params['password'] = $('password').value;
    params['confirm'] = $('confirm').value;
<?php } else { ?>
    $('submit_load').innerHTML = 'Please wait...';
<?php } ?>
    $('submit_button').disabled = true;
    new Ajax.Request('modules/account_create.php', {
        method: 'post',
        parameters: params,
        onSuccess: function(transport) {
            var param = transport.request.options.parameters;
            var XML = parseXML(transport.responseText);
            var errors = XML.getElementsByTagName('error');
            var success = XML.getElementsByTagName('success');
            $('submit_errors').innerHTML = '';
            $('submit_success').innerHTML = '';
            $('submit_load').innerHTML = '';
            
            for (var i = 0; i < errors.length; i++) {
                $('submit_errors').innerHTML += errors[i].attributes.getNamedItem('id').value + ': ' + errors[i].childNodes[0].nodeValue + '<br/>';
            }
            if (success.length > 0) {
                $('submit_success').innerHTML = success[0].childNodes[0].nodeValue;
            } else {
                $('submit_button').disabled = false;
            }
            $('captcha_img').src = 'doimg.php?' + Date.parse(new Date().toString());

        },
        onFailure: function() {alert('AJAX failed.')}
    });
}

function updateState(id, XML) {
        if($(id).value == '') {
            $(id+'_state').innerHTML = '';
            return;
        }
        var errors = XML.getElementsByTagName('error');
        for (var i = 0; i < errors.length; i++) {
            if (errors[i].attributes.getNamedItem('id').value == id) {
                $(id+'_state').innerHTML = '<i class="glyphicon glyphicon-remove" alt="X" title="'+errors[i].childNodes[0].nodeValue+'"></i>';
                return;
            }
        }
        $(id+'_state').innerHTML = '<i class="glyphicon glyphicon-ok" alt="V"></i>';
    }

var observerCallback = function(el, value) {
    var params = new Array();
    params['el_id'] = el.id;
    params['email'] = $('email').value;
    params['accname'] = $('accname').value;
<?php if (!$cfg['Email_Validate']) {?>
    params['password'] = $('password').value;
    params['confirm'] = $('confirm').value;
<?php } ?>
    new Ajax.Request('modules/account_create.php', {
            method: 'post',
            parameters: params,
            onSuccess: function(transport) {
                var param = transport.request.options.parameters;
                var XML = parseXML(transport.responseText);
                if (param.el_id == 'accname') {
                    updateState('accname', XML);
                    updateState('password', XML);
                } else if (param.el_id == 'password') {
                    updateState('password', XML);
                    updateState('confirm', XML);
                } else {
                    updateState(param.el_id, XML);
                }
            },
            onFailure: function() {alert('AJAX failed.')}
    });
}

new Form.Element.Observer('email', 2, observerCallback);
new Form.Element.Observer('accname', 2, observerCallback);
<?php if (!$cfg['Email_Validate']) {?>
new Form.Element.Observer('password', 2, observerCallback);
new Form.Element.Observer('confirm', 2, observerCallback);
<?php } ?>
//]]>
</script>
</div>
<div style="height:60px"></div>

<div id="download">
<fieldset><legend>Download Client</legend></fieldset>
<div class="row">
      <div class="col-sm-4">
	  <div class="list-group">
	  <a class="list-group-item list-group-item-info" href="/public/Tibia%20Classic%207.6.zip">
        <i class="large-text glyphicon glyphicon-grain"></i>
        <h3>Windows Custom Client</h3>
			Click here to download the custom 7.6 game client.
		</a>
		

      </div>
	  </div>
      <div class="col-sm-4">
	  	  <div class="list-group">
	  	  <div class="list-group-item" >
		  

        <i class="large-text glyphicon glyphicon-tree-deciduous"></i>
        <h3>Windows & IP Changer</h3>
		You can use the normal Tibia 7.6 client, but you will need the the OTLand IP Changer, which requires the .NET Framework.
		<div><a class="btn btn-primary" href="http://download.otservlist.org/client/tibia76.zip">Download Tibia 7.6</a></div>
		 </div>
		 <div class="list-group-item">
		 		<a href="http://static.otland.net/ipchanger.exe" class="btn btn-primary">Download IP Changer</a>
				<div><a href="http://www.microsoft.com/download/en/details.aspx?displaylang=en&id=21">Microsoft .NET Framework 3.5</a></div>

		</div>
		 <div class="list-group-item">
			<p><b>IP: </b> tibiagame.com</p>
			<p><b>Port:</b> 7171</p>
		</div>		
		</div>
		
      </div>
      <div class="col-sm-4">
	  	  <div class="list-group">

	  	  <div class="list-group-item">

        <i class="large-text glyphicon glyphicon-leaf"></i>
        <h3>Mac</h3>
			Download the custom client for Windows and use Wine to run Windows programs. 
			<div><a class="btn btn-primary" href="https://www.winehq.org/download/">Download Wine</a></div>
		</div>
		</div>
      </div>
    </div>

</div>

<div class="bot"></div>
</div>
<?php include ("footer.inc.php");?>