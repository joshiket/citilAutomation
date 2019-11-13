app.controller("managerListController", function(dataService, alertService,pageService){
    var mlc  = this;
    mlc.Managers = {};
    mlc.Managers.action="getAllManagers";
    mlc.Managers.primaryKey = "acManId";
	mlc.Managers.data = [];
	mlc.Managers.data2show = [];

	mlc.Paging = pageService;
	
    
    mlc.getManagers = function(){
		console.log("Fetching Managers...");
		//console.log(mlc.Managers);
		var response = dataService.httpCall(mlc.Managers,"Models/Manager/ManagerDAO.php");
		response.then(function(result){
            //console.log(result);
            var data = result.data;
			if(! data.error) 
			{
                mlc.Managers.data = angular.fromJson(data.data);
                console.log("Fetching Managers - success");
                console.log( mlc.Managers.data.length + " record(s) feched.");
				//mlc.Managers.data = mlc.Managers.data;
				pageService.init(mlc.Managers);
				//console.log(mlc.Managers.data2show);
				//alert(mlc.Paging.showNext());
			}
			else
			{
				console.log("Fetching Managers  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
    };
    
    mlc.init = function(){ 
        console.clear();
        console.log("initialising ...");
        mlc.getManagers();
    };
    mlc.init();    


});




