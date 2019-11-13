
<?php
	include "Manager" . ".class.php";

	Class ManagerDAO
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
			//return $msg;
			switch($this->action)
			{
				case "getAllManagers":
					$msg = $this->getAllManagers();
					break;
				case "getManagerById":
					$msg = $this->getManagerById();
					break;
				case "deleteManager":
					$msg = $this->deleteManager();
					break;
				case "updateManager":
					$msg = $this->updateManager();
					break;
				case "newManager":
					$msg = $this->newManager();
					break;
				default :
					$msg = "Invalid action.";					
					break;
			} // switch 

			return $msg;

		} // processAction()


		public function getAllManagers()
		{
			$obj = new Manager();
			$msg = $obj->getManager("*","","","",false);
			return $msg;
			
		}//getAllManagers()


		public function getManagerById()
		{
			$msg = "";
			$acManId = $this->fetchData("acManId");
			if( $acManId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$msg = "";
				$obj = new Manager();
				$obj->acManId = $acManId;
				$msg = $obj->getManager("*","acManId =".  $acManId,"","");
			}
			return $msg;
		}//getManagerById()


		public function deleteManager()
		{
			$msg = "";
			$acManId = $this->fetchData("acManId");
			if( $acManId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Manager();
				$obj->primaryKey = "acManId";
				$obj->acManId= $acManId;
				$msg = $obj->deleteManager();
			}
			return $msg;
		}//deleteManager()


		public function updateManager()
		{
			$msg = "";
			$acManId = $this->fetchData("acManId");
			$acManName = $this->fetchData("acManName");
			$acManEmail = $this->fetchData("acManEmail");
			if( $acManId == NULL ||  $acManName == NULL ||  $acManEmail == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Manager();
				$obj->primaryKey = "acManId";
				$obj->acManId= $acManId;
				$obj->acManName= $acManName;
				$obj->acManEmail= $acManEmail;
				$msg = $obj->updateManager();
			}
			return $msg;
		}//updateManager()


		public function newManager()
		{
			$msg = "";
			$acManName = $this->fetchData("acManName");
			$acManEmail = $this->fetchData("acManEmail");
			if( $acManName == NULL ||  $acManEmail == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Manager();
				$obj->primaryKey = "acManId";
				$obj->acManName= $acManName;
				$obj->acManEmail= $acManEmail;
				$msg = $obj->newManager();
			}
			return $msg;
		}//newManager()


} // Class 

$obj = new ManagerDAO();
$msg = $obj->proccessAction();
echo $msg;
?>