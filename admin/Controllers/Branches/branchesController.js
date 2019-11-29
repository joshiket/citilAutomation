app.controller("newCustomerBranchController", function(dataService, alertService){
	var ncbc = this;
	ncbc.Branch = {};
    ncbc.Branch.action = "newBranch";
    ncbc.Branch.primaryKey = "branchId";
    ncbc.Branch.branchName = "";
    ncbc.alerts = alertService;

	ncbc.newBranch = function(){
		console.log("Saving Branch...");
		//console.log(ncbc.Branch);
		var response = dataService.httpCall(ncbc.Branch,"Models/Branch/BranchDAO.php");
		response.then(function(result){
            console.log(result);
            var data = result.data;
			alertService.init(true,data.error,data.msg);
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};    

    ncbc.init = function(){ 
        console.clear();
        console.log("initialising ...");
		ncbc.alerts.init(false,false,"");
		document.forms[0].elements[0].focus();
    };
    ncbc.init();    
});

app.controller("addCustomerBranchController", function(alertService,dataService){
	var acbc = this;
	acbc.CustomerBranch = {};
	acbc.CustomerBranch.primaryKey = "custBranchId";
	acbc.CustomerBranch.action = "newCustomerBranch";
	acbc.CustomerBranch.custId = "";
	acbc.CustomerBranch.branchId = "";
	acbc.alerts=alertService;

	acbc.Customers = {};
	acbc.Customers.fetchData = {};
	acbc.Customers.fetchData.primaryKey = "custId";
	acbc.Customers.fetchData.action="getAllCustomers";
	acbc.Customers.data = [];

	acbc.Branches = {};
	acbc.Branches.fetchData = {};
	acbc.Branches.fetchData.primaryKey = "branchId";
	acbc.Branches.fetchData.action="getAllBranches";
	acbc.Branches.data = [];	

	acbc.resetForm = function(){
		acbc.CustomerBranch.custId = "";
		acbc.CustomerBranch.branchId = "";
	};

	acbc.getCustomers = function(){
		console.log("Fetching Customers...");
		//console.log(acbc.CustomersfetchData);
		var response = dataService.httpCall(acbc.Customers.fetchData,"Models/Customer/CustomerDAO.php");
		response.then(function(result){
			var data = result.data;
			//console.log(data);
			if(! data.error) 
			{
				acbc.Customers.data = angular.fromJson(data.data);				
				console.log("Fetching Customers - success");
				console.log("Fetched " + acbc.Customers.data.length + " record(s).");
				

			}
			else
			{
				console.log("Fetching Customers  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};


	acbc.getBranches = function(){
		console.log("Fetching Branches...");
		//console.log(acbc.Branches.fetchData);
		var response = dataService.httpCall(acbc.Branches.fetchData,"Models/Branch/BranchDAO.php");
		response.then(function(result){
			var data = result.data;
			//console.log(data);
			if(! data.error) 
			{
				acbc.Branches.data = angular.fromJson(data.data);				
				console.log("Fetching Branches - success");
				console.log("Fetched " + acbc.Branches.data.length + " record(s).");

			}
			else
			{
				console.log("Fetching Customers  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

	acbc.newCustomerBranch = function(){
		console.log("Saving Customer Branch...");
		console.log(acbc.CustomerBranch);
		var response = dataService.httpCall(acbc.CustomerBranch,"Models/CustomerBranch/CustomerBranchDAO.php");
		response.then(function(result){
			//console.log(result);
			var data = result.data
			console.log(data);
			alertService.init(true,data.error,data.msg);
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

	acbc.init = function(){ 
		console.clear();
		console.log("initialising ...");
		acbc.alerts.init(false,false,"");
		acbc.getCustomers();
		acbc.getBranches();
		//alert(document.getElementsByName('acbForm')[0].childNodes[1]);
		document.forms[0].elements[0].focus();
	};

	acbc.init();
});

app.controller("customerBranchListController", function(dataService,pageService){
	var cblc = this;
	cblc.CustomerBranches = {};
	cblc.CutomerBranches.fetchData = {};
	CustomerBranches.fetchData.primaryKey = "custBranchId";
	cblc.CustomerBranches.fetchData.action = "getAllCustomerBranches";
	cblc.CustomerBranches.data = [];
	cblc.CustomerBranches.data2show = [];
	cblc.Paging = pageService

	cblc.getCustomerBranches = function(){
		console.log("Fetching Customer Branches...");
		//console.log(cblc.CutomerBranches.fetchData);
		var response = dataService.httpCall(cblc.CutomerBranches.fetchData,"MOdels/CustomerBranch/CustomerBranchDAO.php");
		response.then(function(result){
			//console.log(result);
			var data= result.data;
			if(! data.error) 
			{
				cblc.CustomerBranches.data = angular.fromJson(data.data);				
				console.log("Fetching Customer Branches - success");
				console.log("Fetched " + cblc.CustomerBranches.data.length + " record(s).");
				cblc.Paging.init(cblc.CustomerBranches);
			}
			else
			{
				console.log("Fetching Customer Branches  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};


});