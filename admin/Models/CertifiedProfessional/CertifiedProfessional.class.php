
<?php
	Class CertifiedProfessional
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
			$this->messages=parse_ini_file('CertifiedProfessional_msg.ini');
			$this->table = "wdbt.tblCertifiedProfessionals";
			$this->child = "";
			$this->view = "";
			$this->primaryKey = "cprofId";
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
			if($property == "cprofId" || $property == "cprofName" )
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

		public function getCertifiedProfessional($field_list="*" ,$where="", $order="" ,$limit="" )
		{
			$query = "select "  . $field_list . " from " . $this->table;
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
		}// getCertifiedProfessional()

		public function deleteCertifiedProfessional()
		{
			$query = sprintf("DELETE FROM %s WHERE cprofId = %d",$this->table,$this->data["cprofId"]); 
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
		}// deleteCertifiedProfessional()


		public function newCertifiedProfessional()
		{
			$query = sprintf("INSERT INTO %s (cprofName) VALUES('%s' )",$this->table,$this->data['cprofName']); 
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


		public function saveCertifiedProfessional()
		{
			$query = sprintf("UPDATE %s set  cprofName = '%s'where cprofId = %d ",$this->table,$this->data['cprofName'],$this->data['cprofId']); 
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
		} //saveCertifiedProfessional()


	} // Class 

?>