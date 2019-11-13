app.controller("userLoginController", function(dataService, alertService){
	var ulc = this;
	ulc.user = {};
	ulc.user.usrEmail = "";
    ulc.user.usrPass = "";
    ulc.user.action="login";
    ulc.user.primaryKey = "usrEmail";
    
	ulc.login = function(){
		console.log("autheticating user...");
		console.log(ulc.user);
		var response = dataService.httpCall(ulc.user,"admin/Models/User/UserDAO.php");
		response.then(function(result){
            console.log(result);
            console.log(result.data);
            var data= angular.fromJson(result.data);
            console.log(data);
            if(!data.error)
            {
                document.location.href="admin/";
            }
            else
            {
                alert("Invalid crdentials.");                
            }
			//alertService.init(true,result.data.error,result.data.msg);
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

    ulc.init = function(){ 
        console.log("initialising ...");        
    };
    ulc.init();    
});
