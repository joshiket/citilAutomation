app.controller("customerListController", function(dataService, alertService, pageService){
    var clc  = this;
    clc.Customers = {};
    clc.Customers.action="getAllCustomers";
    clc.Customers.primaryKey = "custId";
	clc.Customers.data = [];
	clc.Customers.data2show = [];

	clc.Paging = pageService;	
	

    
    clc.getCustomers = function(){
		console.log("Fetching customers...");
		//console.log(clc.Customers);
		var response = dataService.httpCall(clc.Customers,"Models/Customer/CustomerDAO.php");
		response.then(function(result){
            //console.log(result);
            var data = result.data;
			if(! data.error) 
			{
                clc.Customers.data = angular.fromJson(data.data);
                console.log("Fetching customers - success");
                console.log( clc.Customers.data.length + " record(s) feched.");
				//clc.Customers.data = clc.Customers.data;
				
				clc.Paging.init(clc.Customers);
                //console.log(clc.Customers.data2show);
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
    
    clc.init = function(){ 
		console.clear();
		console.log("initialising ...");
        clc.getCustomers();
    };
    clc.init();    


});

app.controller("customerDetailsController", function(dataService, alertService, $routeParams){
    var cdc = this;
    cdc.Customer = {};
    cdc.Customer.custId = $routeParams.custId;
    cdc.Customer.primaryKey = "custId";
	cdc.Customer.action = "getCustomerById";
	cdc.Customer.data  = [];

	cdc.getCustomer = function(){
		console.log("Fetching Customer...");
		console.log(cdc.Customer);
		var response = dataService.httpCall(cdc.Customer,"Models/Customer/CustomerDAO.php");
		response.then(function(result){
			console.log(result);
			var data = result.data;
			if(!data.error) 
			{
				cdc.Customer.data = angular.fromJson(data.data)[0];
				//console.log(cdc.Customer.data);
				//console.log("Fetching Customer - success");
			}
			else
			{
				console.log("Fetching Customer  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
    };
    
    cdc.init = function(){ 
        console.log("initialising ...");
        cdc.getCustomer();
    };
     cdc.init();	
});
 




