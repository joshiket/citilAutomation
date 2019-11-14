
<?php
    spl_autoload_register(function($class) {
        include  $class . '.class.php';
    });

	Class CertificationDAO
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
				case "getAllCertifications":
					$msg = $this->getAllCertifications();
					break;
				case "getCertificationById":
					$msg = $this->getCertificationById();
					break;
				case "deleteCertification":
					$msg = $this->deleteCertification();
					break;
				case "updateCertification":
					$msg = $this->updateCertification();
					break;
				case "newCertification":
					$msg = $this->newCertification();
					break;
				default :
					$msg = "Invalid action.";
					break;
			} // switch 

			return $msg;

		} // processAction()


		public function getAllCertifications()
		{
			$obj = new Certification();
			$msg = $obj->getCertification("*","","","",false);
			return $msg;
		}//getAllCertifications()


		public function getCertificationById()
		{
			$msg = "";
			$certiId = $this->fetchData("certiId");
			if( $certiId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$msg = "";
				$obj = new Certification();
				$obj->certiId = $certiId;
				$msg = $obj->getCertification("*","certiId =".  $certiId,"","");
			}
			return $msg;
		}//getCertificationById()


		public function deleteCertification()
		{
			$msg = "";
			$certiId = $this->fetchData("certiId");
			if( $certiId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Certification();
				$obj->primaryKey = "certiId";
				$obj->certiId= $certiId;
				$msg = $obj->deleteCertification();
			}
			return $msg;
		}//deleteCertification()


		public function updateCertification()
		{
			$msg = "";
			$certiId = $this->fetchData("certiId");
			$cprofId = $this->fetchData("cprofId");
			$cprovId = $this->fetchData("cprovId");
			$certiExam = $this->fetchData("certiExam");
			$certiOn = $this->fetchData("certiOn");
			$certiValidTill = $this->fetchData("certiValidTill");
			if( $certiId == NULL ||  $cprofId == NULL ||  $cprovId == NULL ||  $certiExam == NULL ||  $certiOn == NULL ||  $certiValidTill == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Certification();
				$obj->primaryKey = "certiId";
				$obj->certiId= $certiId;
				$obj->cprofId= $cprofId;
				$obj->cprovId= $cprovId;
				$obj->certiExam= $certiExam;
				$obj->certiOn= $certiOn;
				$obj->certiValidTill= $certiValidTill;
				$msg = $obj->updateCertification();
			}
			return $msg;
		}//updateCertification()


		public function newCertification()
		{
			$msg = "";
			$cprofId = $this->fetchData("cprofId");
			$cprovId = $this->fetchData("cprovId");
			$certiExam = $this->fetchData("certiExam");
			$certiExamDesc = $this->fetchData("certiExamDesc");
			$certiOn = $this->fetchData("certiOn");
			$certiValidTill = $this->fetchData("certiValidTill");
			$certiExpires = $this->fetchData("certiExpires");
			//$msg = "$cprofId == NULL ||  $cprovId == NULL ||  $certiExam == NULL || $certiExamDesc == NULL ||$certiOn == NULL ||  $cerytiExpires == NULL";
			//$ds = "cprofId = " . $cprofId . ", cprovId = ".$cprovId. ", certiExam = ".$certiExam . ", certiExamDesc = ".$certiExamDesc.", certiOn = ".$certiOn.", certiExpires = " .$cerytiExpires;
			//return $ds;
			//$ds = (( $cprofId == NULL ||  $cprovId == NULL ||  $certiExam == NULL || $certiExamDesc == NULL ||$certiOn == NULL ||  $certiExpires == NULL )==true) ? 'err' : 'no err';
			//return ($certiExpires == NULL);
			
			if( $cprofId == NULL ||  $cprovId == NULL ||  $certiExam == NULL || $certiExamDesc == NULL ||$certiOn == NULL ||  $certiExpires == NULL )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Certification();
				$obj->primaryKey = "certiId";
				$obj->cprofId= $cprofId;
				$obj->cprovId= $cprovId;
				$obj->certiExam= $certiExam;
				$obj->certiExamDesc = $certiExamDesc;
				$obj->certiOn= $certiOn;
				if($certiExpires == "n")
					$obj->certiValidTill= NULL;
				else
					$obj->certiValidTill= $certiValidTill;				
				$obj->certiExpires = $certiExpires;
				$msg = $obj->newCertification();
			}
			return $msg;
		}//newCertification()


} // Class 

$obj = new CertificationDAO();
$msg = $obj->proccessAction();
echo $msg;
?>