<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    /* Exception class. */
    require '.\PHPMailer\src\Exception.php';

    /* The main PHPMailer class. */
    require '.\PHPMailer\src\PHPMailer.php';

    /* SMTP class, needed if you want to use SMTP. */
    require '.\PHPMailer\src\SMTP.php';
	Class Mailer
	{

		private $request;

		private $notifications;

		private $nmsg;

		public function __construct()
		{
			$this->request = json_decode(file_get_contents("php://input"),true);
			$this->notifications = new ArrayObject($this->request["notifArr"]);
			$this->nmsg = $this->request["notification"];
		} //constructor()



		public function process()
		{
            for($i=0; $i < sizeof($this->notifications);$i++)
            {
                $this->sendMail($this->notifications[$i]["custName"],$this->notifications[$i]["prodSerial"],$this->notifications[$i]["prodDesc"],$this->notifications[$i]["expDate"],$this->notifications[$i]["AcMan"],$this->notifications[$i]["Email"]);
            }	
            return "done";
        } // processAction()

        public function sendMail($custName, $prodSerial, $prodDesc, $expDate, $acMan, $email)
        {
            $msg = 0;
            $mail = new PHPMailer(TRUE);   
            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "mail.citilindia.com";
            $mail->Port = 465; // or 587
            $mail->SMTPDebug = 0;
            $mail->IsHTML(true);
            $mail->Username = "ketan_j@citilindia.com";
            $mail->Password = "India789@";
            $mail->SetFrom("ketan_j@citilindia.com");
            $mail->Subject = "Warranty Expiry Notifications";         
            $content = "<!doctype html>
            <html>
               <head>
           
               </head>
               <body> 
                   Dear " . $acMan ."
                   <h4> Warranties of the following product(s) is expiring within " . $this->nmsg . "
                   </h4>
                   Customer : " . $custName . " <br>
                   Product Serial : " . $prodSerial . " <br>
                   Product Desc : " . $prodDesc . " <br>
                   Expires on  : " . $expDate . " <br>
                </body>
            </html";
            $mail->Body = $content;
            $mail->AddAddress($email);
            if(!$mail->Send()) 
            {
               return true;
            }
            else 
            {
                return false;
            }            
        }
    }
    $obj = new Mailer();
    $msg = $obj->process();
    echo $msg;    