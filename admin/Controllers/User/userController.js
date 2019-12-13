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
                alert("Invalid credentials.");                
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
	nuc.User = {};
	nuc.User.action = "newUser";
	nuc.User.primaryKey = "usrEmail";
	nuc.User.usrEmail = "";
	nuc.User.usrPass = "";
	nuc.User.confPass = "";
	nuc.User.usrName ="";
	nuc.User.usrSecuQ = "";
	nuc.User.usrSecuAns = "";	
	nuc.Alerts = alertService;

	nuc.newUser = function(){
		//console.log("Creating User...");
		//console.log(nuc.User);
		var response = dataService.httpCall(nuc.User,"Models/User/UserDAO.php");
		response.then(function(result){
			//console.log(result);
			var data = result.data;
			console.log(data);
			alertService.init(true,result.data.error,result.data.msg);
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

	nuc.resetForm = function(){		
		nuc.User.usrEmail = "";
		nuc.User.usrPass = "";
		nuc.User.confPass = "";
		nuc.User.usrName ="";
		nuc.User.usrSecuQ = "";
		nuc.User.usrSecuAns = "";
		nuc.Alerts.init(false,false,"");		
	};


	nuc.init = function(){ 
		console.clear();
		console.log("initialising ...");
		document.forms[0].elements[0].focus();
		nuc.Alerts.init(false,false,"");
	};
	 nuc.init();

});

app.controller("forgotPassController", function(alertService,dataService){
	var fpc = this;
	fpc.User = {};
	fpc.User.usrEmail = "";
	fpc.User.usrSecuQ = "";
	fpc.User.usrSecuAns = "";
	fpc.User.action = "getSecurityQuestion";
	fpc.User.primaryKey = "usrEmail";
	fpc.User.msg = "";

	fpc.tabs = {};
	fpc.tabs.ctab = 1;

	fpc.tabs.setCurrrentTab = function(n){
		fpc.tabs.ctab = n;
	};

	fpc.tabs.isCurrentTab = function(n){
		var f = (fpc.tabs.ctab == n ) ? true : false;
		return f;
	}

	fpc.getSecurityQuestion = function(){
		console.log("Fetching Security Question...");
		//console.log(fpc.User);
		var response = dataService.httpCall(fpc.User,"admin/Models/User/UserDAO.php");
		response.then(function(result){
			console.log(result);
			var data  = result.data;
			if(!data.error)
			{
				var data = angular.fromJson(data.data);
				fpc.User.usrSecuQ =(data[0].usrSecuQ);
				fpc.User.action = "resetPassword";
				fpc.tabs.setCurrrentTab(2)
				//fpc.User.usrSecuQ
			}
			else
			{
				alert(data.msg);
			}
			//alertService.init(true,result.data.error,result.data.msg);
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};	

	fpc.resetPassword = function(){
		console.log("Reseting Password...");
		//console.log(fpc.User);
		var response = dataService.httpCall(fpc.User,"admin/Models/User/UserDao.php");
		response.then(function(result){
			console.log(result);
			var data = result.data;
			if(!data.error)
			{
				fpc.User.msg = data.msg;
				fpc.tabs.setCurrrentTab(3);
			}
			else
			{
				alert(data.msg);
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

	
});

app.controller("changeSecuQController", function(alertService,dataService,sessionService){
	var csqc = this;
	csqc.User = {};
	csqc.User.primaryKey = "usrEmail";
	csqc.User.action = "login";
	csqc.User.usrEmail = "";
	csqc.User.usrPass = "";
	csqc.User.usrSecuQ = "";
	csqc.User.usrSecuAns = "";
	csqc.Alerts = alertService;

	csqc.tabs = {};
	csqc.tabs.ctab = 0;

	csqc.tabs.setCurrrentTab = function(n){
		csqc.tabs.ctab = n;					
	};

	csqc.tabs.isCurrentTab = function(n){
		var f = (csqc.tabs.ctab == n ) ? true : false;
		return f;
	}	

	csqc.getUserEmail = function()
	{
		var response = sessionService.getKeyValue("lgUser");
		response.then(function(result){
			//console.log(result.data);
			var data = result.data;
			csqc.User.usrEmail = data.data;
		},
		function(result){
			alert(angular.toJson(result));
		});		

	};	

	csqc.login = function(){
		console.log("autheticating user...");
		console.log(csqc.User);
		var response = dataService.httpCall(csqc.User,"Models/User/UserDAO.php");
		response.then(function(result){
            console.log(result);
            console.log(result.data);
            var data= angular.fromJson(result.data);
            console.log(data);
            if(!data.error)
            {
				
				csqc.User.action = "getSecurityQuestion";
				csqc.getSecurityQuestion();
            }
            else
            {
                alert(data.msg);                
            }
			//alertService.init(true,result.data.error,result.data.msg);
		},
		  function(result){
			alert(angular.toJson(result));
		});		
	}	

	csqc.getSecurityQuestion = function(){
		console.log("Fetching Security Question...");
		//console.log(fpc.User);
		var response = dataService.httpCall(csqc.User,"Models/User/UserDAO.php");
		response.then(function(result){
			console.log(result);
			var data  = result.data;
			if(!data.error)
			{
				var data = angular.fromJson(data.data);
				csqc.User.usrSecuQ =(data[0].usrSecuQ);
				csqc.User.action = "resetSecurityQuestion";
				csqc.tabs.setCurrrentTab(2)
				//fpc.User.usrSecuQ
			}
			else
			{
				alert(data.msg);
			}
			//alertService.init(true,result.data.error,result.data.msg);
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};	

	csqc.resetSecurityQuestion = function(){
		//console.log("Reseting Security Question...");
		console.log(csqc.User);
		var response = dataService.httpCall(csqc.User,"Models/User/UserDAO.php");
		response.then(function(result){
			//console.log(result);
			var data = result.data;
			console.log(data);
			csqc.Alerts.init(true,data.error,data.msg);
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};



	csqc.init = function(){ 
		console.clear();
		console.log("initialising ...");
		csqc.tabs.setCurrrentTab(1);
		csqc.getUserEmail();
		csqc.Alerts.init(false,false,"");
	};
	csqc.init();
});