app.controller("ditributorListController", function(dataService, alertService, pageService){
    var dlc  = this;
    dlc.Distributors = {};
    dlc.Distributors.action="getAllDistributors";
    dlc.Distributors.primaryKey = "distId";
	dlc.Distributors.data = [];
	dlc.Distributors.data2show = [];

	dlc.Paging = pageService;
	dlc.pagingRequired = true;
	
    dlc.getDistributors = function(){
		console.log("Fetching Distributors...");
		//console.log(dlc.Customers);
		var response = dataService.httpCall(dlc.Distributors,"Models/Distributor/DistributorDAO.php");
		response.then(function(result){
            //console.log(result);
            var data = result.data;
			if(! data.error) 
			{
                dlc.Distributors.data = angular.fromJson(data.data);
                console.log("Fetching distributors - success");
                 console.log( dlc.Distributors.data.length + " record(s) feched.");
				//dlc.Distributors.data = dlc.Distributors.data;
				dlc.pagingRequired = (dlc.Distributors.data.length >=15) ? true : false;
				pageService.init(dlc.Distributors, 15,dlc.pagingRequired);
				console.log(dlc.Distributors.data2show);
				//alert(dlc.Paging.showNext());
			}
			else
			{
				console.log("Fetching Distributors  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
    };
    
    dlc.init = function(){ 
        console.log("initialising ...");
        dlc.getDistributors();
    };
    dlc.init();    


});




