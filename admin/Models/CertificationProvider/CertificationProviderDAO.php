
<?php
    spl_autoload_register(function($class) {
        include  $class . '.class.php';
    });

	Class CertificationProviderDAO
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
				case "getAllCertificationProviders":
					$msg = $this->getAllCertificationProviders();
					break;
				case "getCertificationProviderById":
					$msg = $this->getCertificationProviderById();
					break;
				case "deleteCertificationProvider":
					$msg = $this->deleteCertificationProvider();
					break;
				case "updateCertificationProvider":
					$msg = $this->updateCertificationProvider();
					break;
				case "newCertificationProvider":
					$msg = $this->newCertificationProvider();
					break;
				default :
					$msg = "Invalid action.";
					break;
			} // switch 

			return $msg;

		} // processAction()


		public function getAllCertificationProviders()
		{
			$obj = new CertificationProvider();
			$msg = $obj->getCertificationProvider("*","","","");
			return $msg;
		}//getAllCertificationProviders()


		public function getCertificationProviderById()
		{
			$msg = "";
			$cprovId = $this->fetchData("cprovId");
			if( $cprovId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$msg = "";
				$obj = new CertificationProvider();
				$obj->cprovId = $cprovId;
				$msg = $obj->getCertificationProvider("*","cprovId =".  $cprovId,"","");
			}
			return $msg;
		}//getCertificationProviderById()


		public function deleteCertificationProvider()
		{
			$msg = "";
			$cprovId = $this->fetchData("cprovId");
			if( $cprovId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new CertificationProvider();
				$obj->primaryKey = "cprovId";
				$obj->cprovId= $cprovId;
				$msg = $obj->deleteCertificationProvide();
			}
			return $msg;
		}//deleteCertificationProvide()


		public function updateCertificationProvider()
		{
			$msg = "";
			$cprovId = $this->fetchData("cprovId");
			$cprovName = $this->fetchData("cprovName");
			if( $cprovId == NULL ||  $cprovName == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new CertificationProvider();
				$obj->primaryKey = "cprovId";
				$obj->cprovId= $cprovId;
				$obj->cprovName= $cprovName;
				$msg = $obj->updateCertificationProvide();
			}
			return $msg;
		}//updateCertificationProvide()


		public function newCertificationProvider()
		{
			$msg = "";
			$cprovName = $this->fetchData("cprovName");
			if( $cprovName == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new CertificationProvider();
				$obj->primaryKey = "cprovId";
				$obj->cprovName= $cprovName;
				$msg = $obj->newCertificationProvider();
			}
			return $msg;
		}//newCertificationProvide()


} // Class 

$obj = new CertificationProviderDAO();
$msg = $obj->proccessAction();
echo $msg;
?>