
<?php
	Class Certification
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
			$this->messages=parse_ini_file('Certification_msg.ini');
			$this->table = "wdbt.tblCertifications";
			$this->child = "";
			$this->view = "wdbt.vwCertifications";
			$this->primaryKey = "certiId";
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
			if($property == "certiId" || $property == "cprofId" || $property == "cprovId" || $property == "certiExam" || $property == "certiExamDesc" || $property == "certiOn" || $property == "certiValidTill" || $property == "cerytiExpires")
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

		public function getCertification($field_list="*" ,$where="", $order="" ,$limit="",$table=true )
		{
			if($table)
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
				$con = new PDO("mysql:host=". $this->dbArr['dbserver'] ."; dname = "  . $this->dbArr['dbname'] ."", $this->dbArr['dbuser'] ,$this->dbArr['dbpass'] ,$config);
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
		}// getCertification()

		public function deleteCertification()
		{
			$query = sprintf("DELETE FROM %s WHERE certiId = %d",$this->table,$this->data["certiId"]); 
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
		}// deleteCertification()


		public function newCertification()
		{
			
			if($this->certiValidTill == "")		
			{		
				$query = sprintf("INSERT INTO %s (cprofId,cprovId,certiExam, certiExamDesc,certiOn,certiValidTill, cerytiExpires) VALUES(%d,%d,'%s','%s','%s',NULL,'%s')",$this->table,$this->data['cprofId'],$this->data['cprovId'],$this->data['certiExam'],$this->certiExamDesc ,$this->data['certiOn'],$this->cerytiNotExpires); 
			}
			else
				$query = sprintf("INSERT INTO %s (cprofId,cprovId,certiExam, certiExamDesc,certiOn,certiValidTill, cerytiExpires) VALUES(%d,%d,'%s','%s','%s','%s','%s')",$this->table,$this->data['cprofId'],$this->data['cprovId'],$this->data['certiExam'],$this->certiExamDesc ,$this->data['certiOn'],$this->certiValidTill,$this->cerytiNotExpires); 
			
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


		public function saveCertification()
		{
			$query = sprintf("UPDATE %s set  cprofId = %d, cprovId = %d, certiExam = '%s', certiOn = '%s', certiValidTill = '%s'where certiId = %d ",$this->table,$this->data['cprofId'],$this->data['cprovId'],$this->data['certiExam'],$this->data['certiOn'],$this->data['certiValidTill'],$this->data['certiId']); 
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
		} //saveCertification()


	} // Class 

?>