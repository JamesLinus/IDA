<?php
include $_SERVER['DOCUMENT_ROOT'].'/libraries/phpmailer/PHPMailerAutoload.php';

$body = $_POST['html'];

$mail = new PHPMailer;

$mail-> isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 3;

$mail->Debugoutput = 'html';

$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'michael.anuszewski@gmail.com';                 // SMTP username
$mail->Password = 'Minetopia-2414';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;

$mail->From = 'michael.anuszewski@gmail.com';
$mail->addAddress('michael.anuszewski@gmail.com', 'Mike');
$mail->isHTML(true);

$headers = 'MIME-Version: 1.0' . "\n"; 
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$mail->Subject = 'Here is the subject';
//$mail->Body = image_embed($body, $mail);
$mail->msgHTML($body, $_SERVER['DOCUMENT_ROOT'], true);
function image_embed($body, $mail){
    preg_match_all('/<img[^>]*src="([^"]*)"/i', $body, $matches);
    if (!isset($matches[0])) return;

    foreach ($matches[0] as $index=>$img)
    {
        // make cid
        $id = 'img'.$index;
        $src = $matches[1][$index];
        // now ?????
        $mail->AddEmbeddedImage($src, $id, "IDA_Logo.png","base64","image/png");
        //this replace might be improved 
        //as it could potentially replace stuff you dont want to replace
        $body = str_replace($src,'cid:'.$id, $body);
        echo $src;
    } 
    return $body;
    }

$mail->preSend();
echo $mail->getSentMIMEMessage();
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>