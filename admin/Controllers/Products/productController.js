app.controller("productListController", function(dataService, alertService, pageService){
	var plc  = this;
	
    plc.Products = {};
    plc.Products.action="getAllProducts";
    plc.Products.primaryKey = "prodId";
	plc.Products.data = [];
	plc.Products.data2show = [];
	
	plc.Paging = pageService;
	plc.pagingRequired = true;
	
    plc.getProducts = function(){
		console.log("Fetching products...");
		//console.log(plc.Customers);
		var response = dataService.httpCall(plc.Products,"Models/Product/ProductDAO.php");
		response.then(function(result){
            console.log(result);
            var data = result.data;
			if(! data.error) 
			{
				plc.Products.data = angular.fromJson(data.data);				
                console.log("Fetching products - success");
				console.log( plc.Products.data.length + " record(s) feched.");		
				plc.pagingRequired = (plc.Products.data.length >=15) ? true : false;		
				plc.Paging.init(plc.Products, 15,plc.pagingRequired);
                console.log(plc.Products.data2show);
			}
			else
			{
				console.log("Fetching customers  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
    };
    
    plc.init = function(){ 
		console.clear();
		console.log("initialising ...");
        plc.getProducts();
    };
    plc.init();    

});