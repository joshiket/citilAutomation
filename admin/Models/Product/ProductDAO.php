
<?php
	function __autoload($class_name)
	{
		include $class_name . ".class.php";
	}

	Class ProductDAO
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
				case "getAllProducts":
					$msg = $this->getAllProducts();
					break;
				case "getProductById":
					$msg = $this->getProductById();
					break;
				case "deleteProduct":
					$msg = $this->deleteProduct();
					break;
				case "updateProduct":
					$msg = $this->updateProduct();
					break;
				case "newProduct":
					$msg = $this->newProduct();
					break;
				default :
					$msg = "Invalid action.";
					break;
			} // switch 

			return $msg;

		} // processAction()


		public function getAllProducts()
		{
			$obj = new Product();
			$msg = $obj->getProduct("*","","","");
			return $msg;
		}//getAllProducts()


		public function getProductById()
		{
			$msg = "";
			$prodId = $this->fetchData("prodId");
			if( $prodId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$msg = "";
				$obj = new Product();
				$obj->prodId = $prodId;
				$msg = $obj->getProduct("*","prodId =".  $prodId,"","");
			}
			return $msg;
		}//getProductById()


		public function deleteProduct()
		{
			$msg = "";
			$prodId = $this->fetchData("prodId");
			if( $prodId == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Product();
				$obj->primaryKey = "prodId";
				$obj->prodId= $prodId;
				$msg = $obj->deleteProduct();
			}
			return $msg;
		}//deleteProduct()


		public function updateProduct()
		{
			$msg = "";
			$prodId = $this->fetchData("prodId");
			$prodNo = $this->fetchData("prodNo");
			$prodDesc = $this->fetchData("prodDesc");
			if( $prodId == NULL ||  $prodNo == NULL ||  $prodDesc == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Product();
				$obj->primaryKey = "prodId";
				$obj->prodId= $prodId;
				$obj->prodNo= $prodNo;
				$obj->prodDesc= $prodDesc;
				$msg = $obj->updateProduct();
			}
			return $msg;
		}//updateProduct()


		public function newProduct()
		{
			$msg = "";
			$prodNo = $this->fetchData("prodNo");
			$prodDesc = $this->fetchData("prodDesc");
			if( $prodNo == NULL ||  $prodDesc == NULL  )
			{
				$msg = $this->RANS();
			}
			else
			{
				$obj = new Product();
				$obj->primaryKey = "prodId";
				$obj->prodNo= $prodNo;
				$obj->prodDesc= $prodDesc;
				$msg = $obj->newProduct();
			}
			return $msg;
		}//newProduct()


} // Class 

$obj = new ProductDAO();
$msg = $obj->proccessAction();
echo $msg;
?>