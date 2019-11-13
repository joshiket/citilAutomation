<?php

	include "Notification" . ".class.php";
	Class NotificationDAO
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
				case "getW5D":
					$msg = $this->getW5D();
                    break;
                case "getW10D":
					$msg = $this->getW10D();
					break;       
				case "getW60D":
					$msg = $this->getW60D();
					break; 					
				case "getW90D":
					$msg = $this->getW90D();
					break;    					             
				default :
					$msg = "Invalid action.";
					break;
			} // switch 

			return $msg;

        } // processAction()
        
        public function getW5D()
        {
            $obj = new Notification();
            $msg = $obj->getW5D();
            return $msg;
        }

        public function getW10D()
        {
            $obj = new Notification();
            $msg = $obj->getW5D();
            return $msg;
		}

        public function getW60D()
        {
            $obj = new Notification();
            $msg = $obj->getW60D();
            return $msg;
		}

        public function getW90D()
        {
            $obj = new Notification();
            $msg = $obj->getW90D();
            return $msg;
        }		

    }//class
    $obj = new NotificationDAO();
    $msg = $obj->proccessAction();
    echo $msg;
?>        