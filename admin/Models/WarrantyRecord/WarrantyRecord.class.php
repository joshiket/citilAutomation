
<?php
	Class WarrantyRecord
	{

		private $dbArr;
		private $data = array();
		private $table;
		private $child;
		private $view;
		private $messages = array();
		private $primaryKey;

		public function __construct()
		{
			$this->dbArr=parse_ini_file('../db.ini');
			$this->messages=parse_ini_file('WarrantyRecord_msg.ini');
			$this->table = "wdbt.tblWarranty";
			$this->child = "";
			$this->view = "wdbt.vwnWarranty";
			$this->primaryKey = "warrId";
		} //constructor()

		

 		 public function __get($property ) 
		{
			if(array_key_exists( $property,$this->data ))
				return $this->data[$property];
			else 
				return null;
		} //__get()

		public function __set($property, $value) 
		{
			if($property == "warrId" || $property == "citilInvoiceNo" || $property == "citilInvoiceDate" || $property == "custId" || $property == "prodNo" || $property == "prodDesc" || $property == "prodSerial" || $property == "prodQty" || $property == "distId" || $property == "distInvoiceNo" || $property == "distInvoiceDate" || $property == "warrExYears" || $property == "warrExpDate" )
			{
				$this->data[$property] = $value;
			}

		} //__set()

		public function generateResponse($error, $msg, $data)
		{
			$msgArr['error'] = $error;
			if($data)
				$msgArr['data'] = $msg;
			else
				$msgArr['msg'] = $msg;
			return json_encode($msgArr);
		} // generateResponse()

		public function getWarrantyRecord($field_list="*" ,$where="", $order="" ,$limit="", $table =true )
		{	if($table)
				$query = "select "  . $field_list . " from " . $this->table;
			else
				$query = "select "  . $field_list . " from " . $this->view;

			if($where!= "" ) 
				$query.= $where  ;
			if($order!= "" ) 
				$query.= $order  ;
			if($limit!= "" ) 
				$query.= $limit  ;
			//return $query; 
			try 
			{ 
				$config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
				$con = new PDO("mysql:host=". $this->dbArr['dbserver'] ."; dname = "  . $this->dbArr['dbname'] .";charset=utf8", $this->dbArr['dbuser'] ,$this->dbArr['dbpass'] ,$config);
				$stmt = $con->prepare($query);
				$stmt->execute();
				if($stmt->rowCount()>0)
				{
					$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$msg = $this->generateResponse(FALSE, json_encode($result),TRUE);
					return $msg;
				}
				else
				{
					$msg = $this->generateResponse(TRUE, $this->messages['nrf'], FALSE);
					return $msg;
				}
			}
			catch(PDOException $e)
			{
				$msg = $this->generateResponse(TRUE, $e->getMessage(),TRUE);
				return $msg;
			}//catch 
		}// getWarrantyRecord()

		public function deleteWarrantyRecord()
		{
			$query = sprintf("DELETE FROM %s WHERE warrId = %d",$this->table,$this->data["warrId"]); 
			//return $query;
			try 
			{ 
				$config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
				$con = new PDO("mysql:host=". $this->dbArr['dbserver'] ."; dname = "  . $this->dbArr['dbname'] ."", $this->dbArr['dbuser'] ,$this->dbArr['dbpass'] ,$config);
				$stmt = $con->prepare($query);
				$stmt->execute();
				if($stmt->rowCount()>0)
				{
					$msg = $this->generateResponse(FALSE, $this->messages['del'], FALSE);
					return $msg;
				}
				else
				{
					$msg = $this->generateResponse(TRUE, $stmt->errorInfo(),FALSE);
					return $msg;
				}
			}
			catch(PDOException $e)
			{
				$msg = $this->generateResponse(TRUE, $e->getMessage(),TRUE);
				return $msg;
			}//catch 
		}// deleteWarrantyRecord()


		public function newWarrantyRecord()
		{
			$query = sprintf("INSERT INTO %s (citilInvoiceNo,citilInvoiceDate,custId,prodNo,prodDesc,prodSerial,prodQty,distId,distInvoiceNo,distInvoiceDate,warrExYears,warrExpDate) VALUES('%s','%s',%d,'%s','%s','%s',%d,%d,'%s','%s',%d,'%s' )",$this->table,$this->data['citilInvoiceNo'],$this->data['citilInvoiceDate'],$this->data['custId'],$this->data['prodNo'],$this->data['prodDesc'],$this->data['prodSerial'],$this->data['prodQty'],$this->data['distId'],$this->data['distInvoiceNo'],$this->data['distInvoiceDate'],$this->data['warrExYears'],$this->data['warrExpDate']); 
			//return $query;
			try 
			{ 
				$config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
				$con = new PDO("mysql:host=". $this->dbArr['dbserver'] ."; dname = "  . $this->dbArr['dbname'] ."", $this->dbArr['dbuser'] ,$this->dbArr['dbpass'] ,$config);
				$stmt = $con->prepare($query);
				$stmt->execute();
				if($stmt->rowCount()>0)
				{
					$msg = $this->generateResponse(FALSE, $this->messages['insupd'],  FALSE);
					return $msg;
				}
				else
				{
					$msg = $this->generateResponse(TRUE, $stmt->errorInfo(),FALSE);
					return $msg;
				}
			}
			catch(PDOException $e)
			{
				$msg = $this->generateResponse(TRUE, $e->getMessage(),TRUE);
				return $msg;
			}//catch 
		}// newCustomer()


		public function saveWarrantyRecord()
		{
			$query = sprintf("UPDATE %s set  citilInvoiceNo = '%s', citilInvoiceDate = '%s', custId = %d, prodNo = '%s', prodDesc = '%s', prodSerial = '%s', prodQty = %d, distId = %d, distInvoiceNo = '%s', distInvoiceDate = '%s', warrExYears = %d, warrExpDate = '%s'where warrId = %d ",$this->table,$this->data['citilInvoiceNo'],$this->data['citilInvoiceDate'],$this->data['custId'],$this->data['prodNo'],$this->data['prodDesc'],$this->data['prodSerial'],$this->data['prodQty'],$this->data['distId'],$this->data['distInvoiceNo'],$this->data['distInvoiceDate'],$this->data['warrExYears'],$this->data['warrExpDate'],$this->data['warrId']); 
			//return $query;
			try 
			{ 
				$config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
				$con = new PDO("mysql:host=". $this->dbArr['dbserver'] ."; dname = "  . $this->dbArr['dbname'] ."", $this->dbArr['dbuser'] ,$this->dbArr['dbpass'] ,$config);
				$stmt = $con->prepare($query);
				$stmt->execute();
				if($stmt->rowCount()>0)
				{
					$msg = $this->generateResponse(FALSE, $this->messages['insupd'],  FALSE);
					return $msg;
				}
				else
				{
					$msg = $this->generateResponse(TRUE, $stmt->errorInfo(),FALSE);
					return $msg;
				}
			}
			catch(PDOException $e)
			{
				$msg = $this->generateResponse(TRUE, $e->getMessage(),TRUE);
				return $msg;
			}//catch 
		} //saveWarrantyRecord()


	} // Class 

?>