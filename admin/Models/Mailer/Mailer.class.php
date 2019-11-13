<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    /* Exception class. */
    require '.\PHPMailer\src\Exception.php';

    /* The main PHPMailer class. */
    require '.\PHPMailer\src\PHPMailer.php';

    /* SMTP class, needed if you want to use SMTP. */
    require '.\PHPMailer\src\SMTP.php';

    include "Logger.class.php";
	Class Mailer
	{

		private $request;

		private $notifications;

        private $view;
        
        private $dbArr;

        private $mailMsg;

		public function __construct()
		{
            $this->request = json_decode(file_get_contents("php://input"),true);		
            $this->dbArr=parse_ini_file('../db.ini');	
            $this->view = $this->request["notification"];
            $this->mailMsg = $this->request["mailMsg"];
        } //constructor()
        
		public function generateResponse($error, $msg, $data)
		{
			$msgArr['error'] = $error;
			if($data)
				$msgArr['data'] = $msg;
			else
				$msgArr['msg'] = $msg;
			return json_encode($msgArr);
		} // generateResponse()

        public function getDistinctACManagers()
        {
			try 
			{ 
                $query = sprintf("SELECT distinct acManId, acMan, Email  FROM %s where acManId <> 4",$this->view);
				$config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
				$con = new PDO("mysql:host=localhost; dbname = wdbt;charset=utf8", "root" ,"root" ,$config);
				$stmt = $con->prepare($query);
				$stmt->execute();
				if($stmt->rowCount()>0)
				{
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$msg = $this->generateResponse(FALSE, json_encode($result),TRUE);
					return $msg;
				}
				else
				{
					$msg = $this->generateResponse(TRUE, "No records found.", FALSE);
                    //return $msg;
                    echo "No records found.";
				}
			}
			catch(PDOException $e)
			{
				$msg = $this->generateResponse(TRUE, $e->getMessage(),TRUE);
				return $msg;
            }//catch             
        }

        function getManagerWarrantyRecords($acManId)
        {
            $query = sprintf("SELECT custName,prodNo,prodSerial,prodDesc,prodQty,expDate FROM %s WHERE acManId=%d",$this->view,$acManId);
            //return $query;
            try 
            { 
                
                $config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
                $con = new PDO("mysql:host=localhost; dbname = wdbt;charset=utf8", "root" ,"root" ,$config);
                $stmt = $con->prepare($query);
                $stmt->execute();
                if($stmt->rowCount()>0)
                {
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $msg = $this->generateResponse(FALSE, json_encode($result),TRUE);
                    return $msg;
                }
                else
                {
                    $msg = $this->generateResponse(TRUE, "No records found.", FALSE);
                    //return $msg;
                    echo "No records found.";
                }
            }
            catch(PDOException $e)
            {
                $msg = $this->generateResponse(TRUE, $e->getMessage(),TRUE);
                return $msg;
            }//catch                    
        }        
        
        public function process()
		{
            $lobj = new Logger();
            $lobj->log("Started \n");
            $manager = $this->getDistinctACManagers();
            $lobj->log("Fetching distinct managers \n ");
            $manager= json_decode($manager);
            $messages = array();
            $msgArr = array();
            if(is_object($manager))
            {
                if(!$manager->error)
                {
                    $lobj->log("Distinct managers fetched - success\n ");
                    $managers = $manager->data;
                    $managers = json_decode($managers,TRUE);
                    $lobj->log(sizeof($managers) . " managers fetched \n ");
                    //return $log;
                    for($i =0; $i<sizeof($managers);$i++)
                    {
                        $lobj->log("Fetching records of " .$i . "-" . $managers[$i]['acMan'] ."\n ");
                        
                        $managerRecord = $this->getManagerWarrantyRecords($managers[$i]['acManId']);
                        $lobj->log($managerRecord . "\n");
                        
                        $managerRecord = json_decode($managerRecord);
                        if(is_object($managerRecord))
                        {
                            if(!$managerRecord->error)
                            {
                                $lobj->log("Manager Records fetched successfully \n ");                                
                                $managerRecords =json_decode($managerRecord->data,TRUE);
                                $lobj->log(sizeof($managerRecords) . " records fetched \n");
                                $mailContent = "<table class=\"table table-striped\">\n <thead>\n <tr style=\"font-weight:bold;background:#c1bfbf\"> <td> Customer </td> <td> Product No </td> ";
                                $mailContent .= "<td> Product Serial </td> <td> Product Desc. </td><td> Product Qty. </td> <td> Warranty Expires on </td> </tr> </thead> <tbody>";
                                for($j=0;$j<sizeof($managerRecords);$j++)
                                {
                                    
                                    $row = "<tr>\n";
                                    $row .= sprintf("<td> %s </td>",$managerRecords[$j]['custName']);
                                    $row .= sprintf("<td> %s </td>",$managerRecords[$j]['prodNo']);
                                    $row .= sprintf("<td> %s </td>",$managerRecords[$j]['prodSerial']);
                                    $row .= sprintf("<td> %s </td>",$managerRecords[$j]['prodDesc']);
                                    $row .= sprintf("<td> %s </td>",$managerRecords[$j]['prodQty']);
                                    $row .= sprintf("<td> %s </td>",$managerRecords[$j]['expDate']);
                                    $row .= "<tr>";   
                                    $mailContent .= $row;                         
                                }
                                $mailContent.= "</tbody></table>";
                                //echo $managers[$i]['acMan'] ."," . $managers[$i]['Email'] . "<br>";
                                //echo $mailContent . "<br>";
                                $msg = $this->sendMail($mailContent,$managers[$i]['acMan'],$managers[$i]['Email']);
                                $msgArr["acMan"] = $managers[$i]['acMan'];
                                $msgArr["mailSent"] =  ! $msg;
                                $msgArr["msg"] =  "Mail sent.";
                                array_push($messages,$msgArr);
                            }
                            else
                            {
                                $lobj->log("Manager records fehing error " .  $managers[$i]['acMan'] ."\n");
                                $msgArr["acMan"] = $mangers[$i]['acMan'];
                                $msgArr["error"] = TRUE;
                                $msgArr["msg"] =  "No records found.";
                                array_push($messages,$msgArr);
                            }
                        }
                    }   //for             
                }
                else
                {
                    $lobj->log("Distinct managers fetched - error\n");
                    $msgArr["error"] = TRUE;
                    $msgArr["msg"] = $manager->msg;
                    array_push($messages,$msgArr);
                }
            }
            return json_encode($messages);
            //return $log;
        } // processAction()

        public function sendMail($mailContent, $acMan, $email)
        {
            $msg = 0;
            $mail = new PHPMailer(TRUE);   
            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 2; // debugging: 1 = errors and messages, 2 = messages only
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
               <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css\">
               </head>
               <body> 

                   Dear " . $acMan .", 
                   <h5> Warranties of the following product(s) is expiring within " . $this->mailMsg . "
                   </h5>";
            $content .= $mailContent;
            $content .= "

                </body>
            </html";
            $mail->Body = $content;
            $mail->AddAddress("ketan_j@citilindia.com");
            //$mail->AddAddress($email);
            if($acMan == "Prafulla Patil")
            {
                $mail->AddCC("sameer_b@citilindia.com");
            }
            //$mail->AddCC("kiran_k@citilindia.com");
            //$mail->AddCC("kiran_t@citilindia.com");
            //$mail->AddCC("rahul_c@citilindia.com");
            //$mail->AddCC("ketan_j@citilindia.com");
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