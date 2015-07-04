<?php
include ("include.inc.php");
$ptitle= "Registration - $cfg[server_name]";
include ("header.inc.php");
?>
<div id="content">
<div class="step">Step 1</div>

<div class="top">Registration</div>
<div class="mid">
<div class="row">


  <div class="col s-4">
        <div><?php
    if ($cfg['Email_Validate']) {
        echo 'This server requires email validation. A letter with your password will be sent to the address provided above.';
    } else {
        echo 'Please enter a valid email address if we need to contact you.';
    }
    ?></div>
    <input id="email" placeholder="Email Address" type="text" />&nbsp;<span id="email_state"></span>
<input id="accname" placeholder="Account Name" type="text" />&nbsp;<span id="accname_state"></span><div>
</div>
<?php
if (!$cfg['Email_Validate']) {?>
    <div>
    Password consists of letters a-z, numbers 0-9, symbols(~!@#%&;,:\^$.|?*+()) and is at least 6 characters long.
    </div>
    <input id="password" placeholder="Password" type="password" />&nbsp;<span id="password_state"></span>

    <input id="confirm" type="password" placeholder="Confirm Password" />&nbsp;<span id="confirm_state"></span><br/><br/>
<?php } ?>

<?php
if($cfg['use_captcha']) {
    echo '<div>Prove you are not a robot</div><input id="captcha" placeholder="captcha" type="text" style="text-transform: uppercase" />'.
    '<img id="captcha_img" width="250px" height="40px" src="doimg.php?'.time().'" alt="Verification Image" /><br/><br/>'.
    '';
}
?>

<input id="rules_check" type="checkbox" onclick="onRulesCheck(this)"/>&nbsp;<label for="rules_check"><b>I agree with server rules</b></label>&nbsp;
<div style="margin-top:20px">
  <button id="submit_button" class="waves-effect waves-light btn-large" disabled onclick="onSubmit()">Submit</button>
</div>
<span id="submit_load" style="color: red; font-weight: bold; text-decoration: blink;"></span>
<div id="submit_errors" style="color: red; font-weight: bold;"></div>
<div id="submit_success" style="color: green; font-weight: bold;"></div>
</div>

</div>


<script type="text/javascript">
//<![CDATA[
function onRulesCheck(node) {
    if (node.checked) {
        node.disabled = true;
        $('#submit_button').prop('disabled', false);
    }
}

function onSubmit() {
    var params = new Array();
    params['email'] = $('email').value;
    params['accname'] = $('accname').value;

    params['rlname'] = $('rlname').value;
    params['location'] = $('location').value;
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
                $(id+'_state').innerHTML = '<img src="resource/cross.png" alt="X" title="'+errors[i].childNodes[0].nodeValue+'"/>';
                return;
            }
        }
        $(id+'_state').innerHTML = '<img src="resource/tick.png" alt="V" />';
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
<div class="bot"></div>
</div>
<?php include ("footer.inc.php");?>
