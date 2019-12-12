
<?php
	include "User" . ".class.php";

	Class UserDAO
	{

		private $request;

		private $action;

		private $primaryKey;

		public function __construct()
		{
			$this->request = json_decode(file_get_contents("php://input"),true);
			$this->action = $this->request["action"];
			$this->primaryKey = $this->request["primaryKey"];
		} //constructor()

		public function RANS()
		{
			$msgArr["error"] = TRUE;
			$msgArr["msg"] = "Required attribute(s) not set.";
			return json_encode($msgArr);
		} // RANS() 

		public function fetchData($key)
		{
			$r = isset($this->request[$key]) ? $this->request[$key] : NULL;
			return $r;
		} // fetchData() 

		public function proccessAction()
		{
			$msg = "";
			switch($this->action)
			{
				case "login":
					$msg = $this->login();
					break;				
				case "getAllUsers":
					$msg = $this->getAllUsers();
					break;
				case "getUserByEmail":
					$msg = $this->getUserByEmail();
					break;
				case "deleteUser":
					$msg = $this->deleteUser();
					break;
				case "updateUser":
					$msg = $this->updateUser();
					break;
				case "changePassword":
					$msg = $this->changePassword();
					break;
				case "newUser":
					$msg = $this->newUser();
					break;
				case "getSecurityQuestion":
					$msg = $this->getSecurityQuestion();
					break;
				case "resetPassword":
					$msg = $this->resetPassword();
					break;
				default :
					$msg = "Invalid action.";
					break;
			} // switch 

			return $msg;

		} // processAction()


		public function login()
		{
			$msg = "";
			$usrEmail = $this->fetchData("usrEmail");
			$usrPass = $this->fetchData("usrPass");
			if( $usrEmail == NULL  || $usrPass == NULL)
			{
				$msg = $this->RANS();
			}	
			else
			{
				$msg = "";
				$obj = new User();
				$obj->usrEmail = $usrEmail;
				$obj->usrPass = $usrPass;
				$msg = $obj->login();
			}
			return $msg;				
		}// login();

		public function changePassword()
		{
			$msg = "";
			$usrEmail = $this->fetchData("usrEmail");
			$usrPass = $this->fetchData("usrPass");			
			$newPass = $this->fetchData("newPass");		
			if( $usrEmail == NULL  || $usrPass == NULL || $newPass == NULL)
			{
				$msg = $this->RANS();
			}	
			else
			{
				$msg = "";
				$obj = new User();
				$obj->usrEmail = $usrEmail;
				$obj->usrPass = $usrPass;
				$obj->newPass = $newPass;
				$msg = $obj->changePassword();
			}
			return $msg;				
		}

		public function getAllUsers()
		{
			$obj = new User();
			$msg = $obj->getUser("*","","","");
			return $msg;
		}//getAllUsers()


		public function getUserByEmail()
		{
			$msg = "";
			$usrEmail = $this->fetchData("usrEmail");
			if( $usrEmail == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$msg = "";
				$obj = new User();
				$obj->usrEmail = $usrEmail;
				$msg = $obj->getUser("*","usreEmail =".  $usreEmail,"","");
			}
			return $msg;
		}//getUserByEmail()


		public function deleteUser()
		{
			$msg = "";
			$usrEmail = $this->fetchData("usrEmail");
			if( $usrEmail == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new User();
				$obj->primaryKey = "usreEmail";
				$obj->usrEmail= $usrEmail;
				$msg = $obj->deleteUser();
			}
			return $msg;
		}//deleteUser()


		public function updateUser()
		{
			$msg = "";
			$usrEmail = $this->fetchData("usrEmail");
			$usrPass = $this->fetchData("usrPass");
			$usrName = $this->fetchData("usrName");
			$usrSecuQ = $this->fetchData("usrSecuQ");
			$usrSecuAns = $this->fetchData("usrSecuAns");
			if( $usrEmail == NULL ||  $usrPass == NULL ||  $usrName == NULL ||  $usrSecuQ == NULL ||  $usrSecuAns == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new User();
				$obj->primaryKey = "usreEmail";
				$obj->usrEmail= $usrEmail;
				$obj->usrPass= $usrPass;
				$obj->$usrName= $usrName;
				$obj->usrSecuQ= $usrSecuQ;
				$obj->usrSecuAns= $usrSecuAns;
				$msg = $obj->updateUser();
			}
			return $msg;
		}//updateUser()

		public function newUser()
		{
			$msg = "";
			$usrEmail = $this->fetchData("usrEmail");
			$usrPass = $this->fetchData("usrPass");
			$usrName = $this->fetchData("usrName");
			$usrSecuQ = $this->fetchData("usrSecuQ");
			$usrSecuAns = $this->fetchData("usrSecuAns");
			if( $usrEmail == NULL ||  $usrPass == NULL ||  $usrName == NULL ||  $usrSecuQ == NULL ||  $usrSecuAns == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new User();			
				$obj->usrEmail= $usrEmail;
				$obj->usrPass= $usrPass;
				$obj->usrName= $usrName;
				$obj->usrSecuQ= $usrSecuQ;
				$obj->usrSecuAns= $usrSecuAns;
				$msg = $obj->newUser();
			}
			return $msg;
		}//newUser()		

		public function getSecurityQuestion()
		{
			$msg = "";
			$usrEmail = $this->fetchData("usrEmail");
			if( $usrEmail == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$msg = "";
				$obj = new User();
				$obj->usrEmail = $usrEmail;
				$msg = $obj->getUser("usrSecuQ"," WHERE usrEmail = '".  $usrEmail,"' ","");
			}
			return $msg;			
		}

		
		public function resetPassword()
		{
			$msg = "";
			$usrEmail = $this->fetchData("usrEmail");
			$usrSecuAns = $this->fetchData("usrSecuAns");
			if( $usrEmail == NULL  || $usrSecuAns == NULL)
			{
				$msg = $this->RANS();
			}
			else
			{
				
				$obj = new User();
				$obj->usrEmail = $usrEmail;
				$obj->usrSecuAns= $usrSecuAns;
				$msg = $obj->resetPassword();
			}
			return $msg;			
		}

} // Class 

$obj = new UserDAO();
$msg = $obj->proccessAction();
echo $msg;
?>