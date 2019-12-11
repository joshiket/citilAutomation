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

app.controller("changePasswordController", function(alertService,dataService,sessionService){
	var cpc = this;
	cpc.User = {};											
	cpc.User.usrEmail = "";
	cpc.User.oldPass = "";
	cpc.User.newPass = "";
	cpc.User.confPass = "";
	cpc.User.action = "changePassword";
	cpc.User.primaryKey = "usrEmail";
	cpc.Alerts = alertService;

	cpc.getUserEmail = function()
	{
		var response = sessionService.getKeyValue("lgUser");
		response.then(function(result){
			//console.log(result.data);
			var data = result.data;
			cpc.User.usrEmail = data.data;
		},
		function(result){
			alert(angular.toJson(result));
		});		

	};

	cpc.changePassword = function(){
		console.log("Changing User Password...");
		//console.log(cpc.User);
		var response = dataService.httpCall(cpc.User,"Models/User/UserDAO.php");
		response.then(function(result){
			var data = result.data;
			console.log(data);
			cpc.Alerts.init(true,data.error,data.msg);
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};



	cpc.init = function(){ 
		console.log("initialising ...");
		cpc.getUserEmail();
		document.forms[0].elements[1].focus();
	};
	 cpc.init();	
});

app.controller("newUserController", function(alertService,dataService,sessionService){
	var nuc = this;
});
