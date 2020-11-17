<?php 
/**
 * 
 */
class Globals 
{
	public function sendMail($to, $subject, $content)
	{
		require_once(APPPATH.'/libraries/phpmailer/class.phpmailer.php');
		require_once(APPPATH.'/libraries/phpmailer/class.smtp.php');
		$mail = new PHPMailer();

        $mail->IsSMTP(); // set mailer to use SMTP
     
		$name = "Timviec365.com.vn";
		$usernameSmtp = 'AKIA4H45CLBRDNNBQ4NW';
		$passwordSmtp = 'BBhUIbTmBLQkalYzuYFoRFjnWZRXhzkiyod+qfGtxvME';  
		$host = 'email-smtp.eu-west-1.amazonaws.com';
		$port = 587;
		$sender = 'no-reply@timviec365.com.vn';
		$senderName = 'Timviec365.com.vn';

		$mail             = new PHPMailer(true);

		$mail->IsSMTP(); 
		$mail->SetFrom($sender, $senderName);
		$mail->Username   = $usernameSmtp;  // khai bao dia chi email
		$mail->Password   = $passwordSmtp;              // khai bao mat khau   
		$mail->Host       = $host;    // sever gui mail.
		$mail->Port       = $port;         // cong gui mail de nguyen 
		$mail->SMTPAuth   = true;    // enable SMTP authentication
		$mail->SMTPSecure = "tls";   // sets the prefix to the servier        
		$mail->CharSet  = "utf-8";
		$mail->SMTPDebug  = 0;   // enables SMTP debug information (for testing)
		// xong phan cau hinh bat dau phan gui mail
		$mail->isHTML(true);
		$mail->Subject    = $subject;// tieu de email 
		$mail->Body       = $content;
		$mail->addAddress($to,$name);
		if(!$mail->Send()){
			echo $mail->ErrorInfo;
		}
        if(!$mail->Send())
        {
        	return false;
        }
        else
        {
        	return true;
        }
    }
}
?>