
<?php
	Class Product
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
			$this->messages=parse_ini_file('Product_msg.ini');
			$this->table = "wdbt.tblProducts";
			$this->child = "";
			$this->view = "";
			$this->primaryKey = "prodId";
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
			if($property == "prodId" || $property == "prodNo" || $property == "prodDesc" )
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

		public function getProduct($field_list="*" ,$where="", $order="" ,$limit="" )
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
		}// getProduct()

		public function deleteProduct()
		{
			$query = sprintf("DELETE FROM %s WHERE prodId = %d",$this->table,$this->data["prodId"]); 
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
		}// deleteProduct()


		public function newProduct()
		{
			$query = sprintf("INSERT INTO %s (prodNo,prodDesc) VALUES('%s','%s' )",$this->table,$this->data['prodNo'],$this->data['prodDesc']); 
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


		public function saveProduct()
		{
			$query = sprintf("UPDATE %s set  prodNo = '%s', prodDesc = '%s'where prodId = %d ",$this->table,$this->data['prodNo'],$this->data['prodDesc'],$this->data['prodId']); 
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
		} //saveProduct()


	} // Class 

?>