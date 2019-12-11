<?php
	Class User
	{

		private $dbArr;
		private $data = array();
		public $table;
		private $child;
		private $view;
		private $messages = array();
		private $primaryKey;
		public  $salt;

		public function __construct()
		{
			$this->dbArr=parse_ini_file('../db.ini');
			$this->messages=parse_ini_file('User_msg.ini');
			$this->table = "wdbt.tblUsers";
			$this->child = "";
			$this->view = "";
			$this->primaryKey = "usrEmail";

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
			if($property == "usrEmail" || $property == "usrPass" || $property == "usrName" || $property == "usrSecuQ" || $property == "usrSecuAns" || $property == "newPass")
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

		public function getUser($field_list="*" ,$where="", $order="" ,$limit="" )
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
		}// getUser()

		public function deleteUser()
		{
			$query = sprintf("DELETE FROM %s WHERE usrEmail = %s",$this->table,$this->data["usrEmail"]); 
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
		}// deleteUser()


		public function newUser()
		{
			$query = sprintf("INSERT INTO %s (usrEmail,usrPass,usrName,usrSecuQ,usrSecuAns) VALUES(%s,%s,%s,%s,%s )",$this->table,$this->usrEmail,$this->usrPass,$this->usrName,$this->usrSecuQ,$this->usrSecuAns); 
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


		public function saveUser($query="")
		{
			
			if($query == "")
				$query = sprintf("UPDATE %s set  usrPass = %s, usrName = %s, usrSecuQ = %s, usrSecuAns = %s where usrEmail = %s ",$this->usrPass,$this->usrName,$this->usrSecuQ,$this->usrSecuAns,$this->usrEmail); 
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
		} //saveUser()

		public function encryptAsync( $val)
		{
			return md5($val . $this->salt);
		}//encryptAsync

		public function encryptSync($str)
		{
			$str = strrev($str);
			$encstr = "";
			for($i=0; $i< strlen($str);$i++)
			{
				$ch = dechex(ord(substr($str,$i,1)));
				if(strlen($ch) == 1 )
					$ch =  "0".$ch;
				
				$encstr = $encstr . $ch;
			}
			return $encstr;

		}//encryptSync()

		public function login()
		{
			$msg = "";
			$query = sprintf("select usrPass from %s where usrEmail = '%s'",$this->table, $this->usrEmail);
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
					$dbPass = $result[0]["usrPass"];
					$this->usrPass = $this->encryptAsync($this->usrPass);
					if($dbPass == $this->usrPass)
					{
						session_start();
						$_SESSION["lgUser"] = $this->usrEmail;						
						$msg = $this->generateResponse(FALSE,$this->messages["usrlogins"],FALSE);												
					}
					else
					{
						$msg = $this->generateResponse(TRUE, $this->messages['usrloginerr'], FALSE);	
					}
				}
				else
				{
					$msg = $this->generateResponse(TRUE, $this->messages['usrloginerr'], FALSE);					
				}
				//return $msg;
			}
			catch(PDOException $e)
			{
				$msg = $this->generateResponse(TRUE, $e->getMessage(),TRUE);
				//return $msg;
			}//catch 
			return $msg;
		}//login()

		public function changePassword()
		{
			$msg = "";
			$msg = $this->login();
			$msg = json_decode($msg);
			if(is_object($msg))
			{
				if(!$msg->error)
				{
					$this->usrPass = $this->encryptAsync($this->newPass);
					$query = sprintf("UPDATE %s SET usrPass = '%s' WHERE usrEmail ='%s' ",$this->table,$this->usrPass,$this->usrEmail);
					$msg = $this->saveUser($query);
					$msg1 = json_decode($msg);
					if(is_object($msg1) && ! $msg1->error)
					{
						$msg = $this->generateResponse(FALSE, "Password changed.", FALSE);
					}
				}
				else
				{
					$msg = $this->generateResponse(TRUE, $this->messages['usrloginerr'], FALSE);
				}
			}
			else
			{
				$msg = $this->generateResponse(TRUE,"Unknown error.",FALSE);
			}
			return $msg;
		}//changePassword()


	} // Class 

?>