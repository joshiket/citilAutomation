
<?php
    spl_autoload_register(function($class) {
        include  $class . '.class.php';
    });

	Class BranchDAO
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
				case "getAllBranches":
					$msg = $this->getAllBranches();
					break;
				case "getBranchById":
					$msg = $this->getBranchById();
					break;
				case "deleteBranch":
					$msg = $this->deleteBranch();
					break;
				case "updateBranch":
					$msg = $this->updateBranch();
					break;
				case "newBranch":
					$msg = $this->newBranch();
					break;
				default :
					$msg = "Invalid action.";
					break;
			} // switch 

			return $msg;

		} // processAction()


		public function getAllBranches()
		{
			$obj = new Branch();
			$msg = $obj->getBranch("*","","","");
			return $msg;
		}//getAllBranches()


		public function getBranchById()
		{
			$msg = "";
			$branchId = $this->fetchData("branchId");
			if( $branchId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$msg = "";
				$obj = new Branch();
				$obj->branchId = $branchId;
				$msg = $obj->getBranch("*","branchId =".  $branchId,"","");
			}
			return $msg;
		}//getBranchById()


		public function deleteBranch()
		{
			$msg = "";
			$branchId = $this->fetchData("branchId");
			if( $branchId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Branch();
				$obj->primaryKey = "branchId";
				$obj->branchId= $branchId;
				$msg = $obj->deleteBranch();
			}
			return $msg;
		}//deleteBranch()


		public function updateBranch()
		{
			$msg = "";
			$branchId = $this->fetchData("branchId");
			$branchName = $this->fetchData("branchName");
			if( $branchId == NULL ||  $branchName == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Branch();
				$obj->primaryKey = "branchId";
				$obj->branchId= $branchId;
				$obj->branchName= $branchName;
				$msg = $obj->updateBranch();
			}
			return $msg;
		}//updateBranch()


		public function newBranch()
		{
			$msg = "";
			$branchName = $this->fetchData("branchName");
			if( $branchName == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Branch();
				$obj->primaryKey = "branchId";
				$obj->branchName= $branchName;
				$msg = $obj->newBranch();
			}
			return $msg;
		}//newBranch()


} // Class 

$obj = new BranchDAO();
$msg = $obj->proccessAction();
echo $msg;
?>