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
    };
    ncbc.init();    
});