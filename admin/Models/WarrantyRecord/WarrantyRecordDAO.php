
<?php
	
	spl_autoload_register(function($class) {
        include  $class . '.class.php';
    });

	Class WarrantyRecordDAO
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
				case "getAllWarrantyRecords":
					$msg = $this->getAllWarrantyRecords();
					break;
				case "getWarrantyRecordById":
					$msg = $this->getWarrantyRecordById();
					break;
				case "deleteWarrantyRecord":
					$msg = $this->deleteWarrantyRecord();
					break;
				case "updateWarrantyRecord":
					$msg = $this->updateWarrantyRecord();
					break;
				case "newWarrantyRecord":
					$msg = $this->newWarrantyRecord();
					break;
				default :
					$msg = "Invalid action.";
					break;
			} // switch 

			return $msg;

		} // processAction()


		public function getAllWarrantyRecords()
		{
			$obj = new WarrantyRecord();
			$msg = $obj->getWarrantyRecord("*","","","",false);
			return $msg;
		}//getAllWarrantyRecords()


		public function getWarrantyRecordById()
		{
			$msg = "";
			$warrId = $this->fetchData("warrId");
			if( $warrId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$msg = "";
				$obj = new WarrantyRecord();
				$obj->warrId = $warrId;
				$msg = $obj->getWarrantyRecord("*","warrId =".  $warrId,"","");
			}
			return $msg;
		}//getWarrantyRecordById()


		public function deleteWarrantyRecord()
		{
			$msg = "";
			$warrId = $this->fetchData("warrId");
			if( $warrId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new WarrantyRecord();
				$obj->primaryKey = "warrId";
				$obj->warrId= $warrId;
				$msg = $obj->deleteWarrantyRecord();
			}
			return $msg;
		}//deleteWarrantyRecord()


		public function updateWarrantyRecord()
		{
			$msg = "";
			$warrId = $this->fetchData("warrId");
			$citilInvoiceNo = $this->fetchData("citilInvoiceNo");
			$citilInvoiceDate = $this->fetchData("citilInvoiceDate");
			$custId = $this->fetchData("custId");
			$prodNo = $this->fetchData("prodNo");
			$prodDesc = $this->fetchData("prodDesc");
			$prodSerial = $this->fetchData("prodSerial");
			$prodQty = $this->fetchData("prodQty");
			$distId = $this->fetchData("distId");
			$distInvoiceDate = $this->fetchData("distInvoiceDate");
			$warrExYears = $this->fetchData("warrExYears");
			$warrExpDate = $this->fetchData("warrExpDate");
			if( $warrId == NULL ||  $citilInvoiceNo == NULL ||  $citilInvoiceDate == NULL ||  $custId == NULL ||  $prodNo == NULL ||  $prodDesc == NULL ||  $prodSerial == NULL ||  $prodQty == NULL ||  $distId == NULL ||  $distInvoiceDate == NULL ||  $warrExYears == NULL ||  $warrExpDate == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new WarrantyRecord();
				$obj->primaryKey = "warrId";
				$obj->warrId= $warrId;
				$obj->citilInvoiceNo= $citilInvoiceNo;
				$obj->citilInvoiceDate= $citilInvoiceDate;
				$obj->custId= $custId;
				$obj->prodNo= $prodNo;
				$obj->prodDesc= $prodDesc;
				$obj->prodSerial= $prodSerial;
				$obj->prodQty= $prodQty;
				$obj->distId= $distId;
				$obj->distInvoiceDate= $distInvoiceDate;
				$obj->warrExYears= $warrExYears;
				$obj->warrExpDate= $warrExpDate;
				$msg = $obj->updateWarrantyRecord();
			}
			return $msg;
		}//updateWarrantyRecord()


		public function newWarrantyRecord()
		{
			$msg = "";
			$citilInvoiceNo = $this->fetchData("citilInvoiceNo");
			$citilInvoiceDate = $this->fetchData("citilInvoiceDate");
			$custId = $this->fetchData("custId");		
			$prodNo = $this->fetchData("prodNO");	
			$prodDesc = $this->fetchData("prodDesc");
			$prodSerial = $this->fetchData("prodSerial");
			$prodQty = $this->fetchData("prodQty");
			$distId = $this->fetchData("distId");
			$distInvoiceNo = $this->fetchData("distInvoiceNo");
			$distInvoiceDate = $this->fetchData("distInvoiceDate");
			$warrExYears = $this->fetchData("warrExYears");
			$warrExpDate = $this->fetchData("warrExpDate");
			if( $citilInvoiceNo == NULL ||  $citilInvoiceDate == NULL ||  $custId == NULL ||  $prodDesc == NULL ||  $prodSerial == NULL ||  $prodQty == NULL ||  $distId == NULL || $distInvoiceNo == NULL ||$distInvoiceDate == NULL ||  $warrExYears == NULL ||  $warrExpDate == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new WarrantyRecord();
				$obj->primaryKey = "warrId";
				$obj->citilInvoiceNo= $citilInvoiceNo;
				$obj->citilInvoiceDate= $citilInvoiceDate;
				$obj->custId= $custId;
				$obj->prodNo= $prodNo;
				$obj->prodDesc= $prodDesc;
				$obj->prodSerial= $prodSerial;
				$obj->prodQty= $prodQty;
				$obj->distId= $distId;
				$obj->distInvoiceNo = $distInvoiceNo;
				$obj->distInvoiceDate= $distInvoiceDate;
				$obj->warrExYears= $warrExYears;
				$obj->warrExpDate= $warrExpDate;
				$msg = $obj->newWarrantyRecord();
			}
			return $msg;
		}//newWarrantyRecord()


} // Class 

$obj = new WarrantyRecordDAO();
$msg = $obj->proccessAction();
echo $msg;
?>