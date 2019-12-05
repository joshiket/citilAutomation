
<?php
	spl_autoload_register(function($class) {
		include $class . '.class.php';
	});

	Class CustomerBranchDAO
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
				case "getAllCustomerBranches":
					$msg = $this->getAllCustomerBranches();
					break;
				case "getCustomerBranchById":
					$msg = $this->getCustomerBranchById();
					break;
				case "deleteCustomerBranch":
					$msg = $this->deleteCustomerBranch();
					break;
				case "updateCustomerBranch":
					$msg = $this->updateCustomerBranch();
					break;
				case "newCustomerBranch":
					$msg = $this->newCustomerBranch();
					break;
				default :
					$msg = "Invalid action.";
					break;
			} // switch 

			return $msg;

		} // processAction()


		public function getAllCustomerBranches()
		{
			$obj = new CustomerBranch();
			$msg = $obj->getCustomerBranch("*",""," order by custName","",false);
			return $msg;
		}//getAllCustomerBranches()


		public function getCustomerBranchById()
		{
			$msg = "";
			$custBranchId = $this->fetchData("custBranchId");
			if( $custBranchId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$msg = "";
				$obj = new CustomerBranch();
				$obj->custBranchId = $custBranchId;
				$msg = $obj->getCustomerBranch("*","custBranchId =".  $custBranchId,"","");
			}
			return $msg;
		}//getCustomerBranchById()


		public function deleteCustomerBranch()
		{
			$msg = "";
			$custBranchId = $this->fetchData("custBranchId");
			if( $custBranchId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new CustomerBranch();
				$obj->primaryKey = "custBranchId";
				$obj->custBranchId= $custBranchId;
				$msg = $obj->deleteCustomerBranch();
			}
			return $msg;
		}//deleteCustomerBranchId()


		public function updateCustomerBranch()
		{
			$msg = "";
			$custBranchId = $this->fetchData("custBranchId");
			$custId = $this->fetchData("custId");
			$branchId = $this->fetchData("branchId");
			if( $custBranchId == NULL ||  $custId == NULL ||  $branchId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new CustomerBranch();
				$obj->primaryKey = "custBranchId";
				$obj->custBranchId= $custBranchId;
				$obj->custId= $custId;
				$obj->branchId= $branchId;
				$msg = $obj->updateCustomerBranch();
			}
			return $msg;
		}//updateCustomerBranchId()


		public function newCustomerBranch()
		{
			$msg = "";
			$custId = $this->fetchData("custId");
			$branchId = $this->fetchData("branchId");
			if( $custId == NULL ||  $branchId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new CustomerBranch();
				$obj->primaryKey = "custBranchId";
				$obj->custId= $custId;
				$obj->branchId= $branchId;
				$msg = $obj->newCustomerBranch();
			}
			return $msg;
		}//newCustomerBranchId()


} // Class 

$obj = new CustomerBranchDAO();
$msg = $obj->proccessAction();
echo $msg;
?>