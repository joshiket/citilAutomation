
<?php
	include "Distributor" . ".class.php";

	Class DistributorDAO
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
				case "getAllDistributors":
					$msg = $this->getAllDistributors();
					break;
				case "getDistributorCount":
					$msg = $this->getDistributorCount();
					break;					
				case "getAllDisributorById":
					$msg = $this->getAllDisributorById();
					break;
				case "deleteDistributor":
					$msg = $this->deleteDistributor();
					break;
				case "saveDistributor":
					$msg = $this->saveDistributor();
					break;
				case "newDistributor":
					$msg = $this->newDistributor();
					break;
				default :
					$msg = "Invalid action.";
					break;
			} // switch 

			return $msg;

		} // processAction()


		public function getAllDistributors()
		{
			$obj = new Distributor();			
			$msg = $obj->getDistributor("","*","","","");
			return $msg;
		}//getAllDisributors()

		public function getDistributorCount()
		{			
			$obj = new Distributor();
			$msg = $obj->getDistributor("SELECT count(*) as count from wdbt.tblDistributors ","*","","","");
			return $msg;
		}//getDistributorCount()


		public function getAllDisributorById()
		{
			$msg = "";
			$distId = $this->fetchData("distId");
			if( $distId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$msg = "";
				$obj = new Distributor();
				$obj->distId = $distId;
				$msg = $obj->getDistributor("*","distId =".  $distId,"","");
			}
			return $msg;
		}//getAllDisributorById()


		public function deleteDistributor()
		{
			$msg = "";
			$distId = $this->fetchData("distId");
			if( $distId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Distributor();
				$obj->primaryKey = "distId";
				$obj->distId= $distId;
				$msg = $obj->deleteDistributor();
			}
			return $msg;
		}//deleteDistributor()


		public function saveDistributor()
		{
			$msg = "";
			$distId = $this->fetchData("distId");
			$distName = $this->fetchData("distName");
			if( $distId == NULL ||  $distName == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Distributor();
				$obj->primaryKey = "distId";
				$obj->distId= $distId;
				$obj->distName= $distName;
				$msg = $obj->saveDistributor();
			}
			return $msg;
		}//saveDistributor()


		public function newDistributor()
		{
			$msg = "";
			$distName = $this->fetchData("distName");
			if( $distName == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Distributor();
				$obj->primaryKey = "distId";
				$obj->distName= $distName;
				$msg = $obj->newDistributor();
			}
			return $msg;
		}//newDistributor()


} // Class 

$obj = new DistributorDAO();
$msg = $obj->proccessAction();
echo $msg;
?>