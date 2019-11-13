
<?php
    spl_autoload_register(function($class) {
        include  $class . '.class.php';
    });

	Class CertifiedProfessionalDAO
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
				case "getAllCertifiedProfessionals":
					$msg = $this->getAllCertifiedProfessionals();
					break;
				case "getCertifiedProfessionalById":
					$msg = $this->getCertifiedProfessionalById();
					break;
				case "deleteCertifiedProfessional":
					$msg = $this->deleteCertifiedProfessional();
					break;
				case "updateCertifiedProfessional":
					$msg = $this->updateCertifiedProfessional();
					break;
				case "newCertifiedProfessional":
					$msg = $this->newCertifiedProfessional();
					break;
				default :
					$msg = "Invalid action.";
					break;
			} // switch 

			return $msg;

		} // processAction()


		public function getAllCertifiedProfessionals()
		{
			$obj = new CertifiedProfessional();
			$msg = $obj->getCertifiedProfessional("*","","","");
			return $msg;
		}//getAllCertifiedProfessionals()


		public function getCertifiedProfessionalById()
		{
			$msg = "";
			$cprofId = $this->fetchData("cprofId");
			if( $cprofId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$msg = "";
				$obj = new CertifiedProfessional();
				$obj->cprofId = $cprofId;
				$msg = $obj->getCertifiedProfessional("*","cprofId =".  $cprofId,"","");
			}
			return $msg;
		}//getCertifiedProfessionalById()


		public function deleteCertifiedProfessional()
		{
			$msg = "";
			$cprofId = $this->fetchData("cprofId");
			if( $cprofId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new CertifiedProfessional();
				$obj->primaryKey = "cprofId";
				$obj->cprofId= $cprofId;
				$msg = $obj->deleteCertifiedProfessional();
			}
			return $msg;
		}//deleteCertifiedProfessional()


		public function updateCertifiedProfessional()
		{
			$msg = "";
			$cprofId = $this->fetchData("cprofId");
			$cprofName = $this->fetchData("cprofName");
			if( $cprofId == NULL ||  $cprofName == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new CertifiedProfessional();
				$obj->primaryKey = "cprofId";
				$obj->cprofId= $cprofId;
				$obj->cprofName= $cprofName;
				$msg = $obj->updateCertifiedProfessional();
			}
			return $msg;
		}//updateCertifiedProfessional()


		public function newCertifiedProfessional()
		{
			$msg = "";
			$cprofName = $this->fetchData("cprofName");
			if( $cprofName == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new CertifiedProfessional();
				$obj->primaryKey = "cprofId";
				$obj->cprofName= $cprofName;
				$msg = $obj->newCertifiedProfessional();
			}
			return $msg;
		}//newCertifiedProfessional()


} // Class 

$obj = new CertifiedProfessionalDAO();
$msg = $obj->proccessAction();
echo $msg;
?>