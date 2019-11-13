<?php

	spl_autoload_register(function($class) {
		include $class . '.class.php';
	});
	Class CustomerDAO
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
				case "getAllCustomers":
					$msg = $this->getAllCustomers();
					break;
				case "getCustomerById":
					$msg = $this->getCustomerById();
					break;
				case "getCustomerCount":
					$msg = $this->getCustomerCount();
					break;					
				case "deleteCustomer":
					$msg = $this->deleteCustomer();
					break;
				case "saveCustomer":
					$msg = $this->saveCustomer();
					break;
				case "newCustomer":
					$msg = $this->newCustomer();
					break;
				default :
					$msg = "Invalid action.";
					break;
			} // switch 

			return $msg;

		} // processAction()


		public function getAllCustomers()
		{
			$obj = new Customer();
			$msg = $obj->getCustomer("","*","","","");
			return $msg;
		}//getAllCustomers()

		public function getCustomerCount()
		{
			$obj = new Customer();
			$msg = $obj->getCustomer("SELECT count(*) as count from wdbt.tblCustomers ","*","","","");
			return $msg;
		}//getAllCustomers()		


		public function getCustomerById()
		{
			$msg = "";
			$custId = $this->fetchData("custId");
			if( $custId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$msg = "";
				$obj = new Customer();
				$obj->custId = $custId;				
				$msg = $obj->getCustomer("","*"," where custId =".  $custId,"");
			}
			return $msg;
		}//getCustomerById()


		public function deleteCustomer()
		{
			$msg = "";
			$custId = $this->fetchData("custId");
			if( $custId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Customer();
				$obj->primaryKey = "custId";
				$obj->custId= $custId;
				$msg = $obj->deleteCustomer();
			}
			return $msg;
		}//deleteCustomer()


		public function saveCustomer()
		{
			$msg = "";
			$custId = $this->fetchData("custId");
			$custName = $this->fetchData("custName");
			if( $custId == NULL ||  $custName == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Customer();
				$obj->primaryKey = "custId";
				$obj->custId= $custId;
				$obj->custName= $custName;
				$msg = $obj->saveCustomer();
			}
			return $msg;
		}//saveCustomer()


		public function newCustomer()
		{
			$msg = "";
			$custName = $this->fetchData("custName");
			if( $custName == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Customer();
				$obj->primaryKey = "custId";
				$obj->custName= $custName;
				$msg = $obj->newCustomer();
			}
			return $msg;
		}//newCustomer()


} // Class 

$obj = new CustomerDAO();
$msg = $obj->proccessAction();
echo $msg;
?>