app.controller("dashBoardController", function(dataService, alertService, pageService){
	var dbc = this;
	dbc.custCnt = 0;
	dbc.distCnt=0;

	dbc.W5 = {};
	dbc.W5.data= [];
	dbc.W5.data2show = [];
	dbc.W5.Paging = pageService;
	
	dbc.W30 = {};
	dbc.W30.data = [];
	dbc.W30.data2show = [];
	dbc.W30.Paging = pageService;
	
	dbc.W60 = {};
	dbc.W60.data = [];
	dbc.W60.data2show = [];
	dbc.W60.Paging = pageService;

	dbc.W90 = {};
	dbc.W90.data = [];
	dbc.W90.data2show = [];
	dbc.W90.Paging = pageService;

	dbc.getCustomerCount = function(){
		console.log("Fetching customer count...");
		var data ={};
		data.action="getCustomerCount";
		data.primaryKey = "custId";
		//console.log(data);
		var response = dataService.httpCall(data,"Models/Customer/CustomerDAO.php");
		response.then(function(result){
			//console.log(result);
			var data = angular.fromJson(result.data);
			//console.log(data);
			if(! data.error) 
			{
				
				//console.log(data.data[0]);				
				dbc.custCnt = angular.fromJson(data.data)[0].count;
				console.log("Fetching cutomer count - success");
			}
			else
			{
				dbc.custCnt = 0;
				console.log("Fetching cutomer count  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

	dbc.getDistributorCount = function(){
		console.log("Fetching distributor count...");
		var data = {};
		data.action = "getDistributorCount";
		data.primaryKey = "distId";
		//console.log(data);		
		var response = dataService.httpCall(data,"Models/Distributor/DistributorDAO.php");
		response.then(function(result){
			var data = angular.fromJson(result.data);
			//console.log(data);			
			//console.log(result);
			if(!data.error) 
			{
				//dbc.listvar = angular.fromJson(result.data.data);
				dbc.distCnt = angular.fromJson(data.data)[0].count;
				console.log("Fetching distributor count - success");
			}
			else
			{
				console.log("Fetching distributor count  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

	dbc.getW5D = function(){
		console.log("fetching warranties expiring within 5 days...");
		var data = {};
		data.action="getW5D";
		data.primaryKey = "warrId";
		//console.log(data);
		var response = dataService.httpCall(data,"Models/Notification/NotificationDAO.php");
		response.then(function(result){
			console.log(result);
			var data = result.data;
			dbc.W5.data = angular.fromJson(data.data);
			//console.log(data);
		
			if(! data.error) 
			{
				/*dbc.W5.data = angular.fromJson(result.data.data);
				var uArr = [];
				uArr.push(dbc.W5D[0]);
				for(var i =1; i <dbc.W5D.length;i++)
				{
					if( ! dbc.arrayExists(uArr,dbc.W5D[i]["prodSerial"],dbc.W5D[i]["AcMan"]))
						uArr.push(dbc.W5D[i]);
				}	
				dbc.W5D = uArr;			*/
				//console.log(dbc.W5D);
				console.log("fetching warranties expiring within 5 days - success");
				console.log("fetched " + dbc.W5.data.length + " record(s).");				
				dbc.W5.Paging.init(dbc.W5);
				console.log(dbc.W5.data2show);
			}
			else
			{
				console.log("fetching warranties expiring within 5 days  -  " + result.data.msg );
				dbc.W5.Paging.Paging.required = false;
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

	dbc.getW30D = function(){
		console.log("fetching warranties expiring within 30 days...");
		var data = {};
		data.action="getW30D";
		data.primaryKey = "warrId";
		//console.log(data);
		var response = dataService.httpCall(data,"Models/Notification/NotificationDAO.php");
		response.then(function(result){
			//console.log(result);
			var data = result.data;
			//console.log(data);
			//dbc.W5.data = angular.fromJson(data.data);
			//console.log(data);
		
			if(! data.error) 
			{
				dbc.W30.data = angular.fromJson(result.data.data);				
				dbc.W30.Paging.init(dbc.W30);
				//alert(dbc.W30.Paging.Paging.required);
				//console.log(dbc.W5D);
				console.log("fetching warranties expiring within 30 days - success");
				console.log("fetched " + dbc.W30.data.length + " record(s).");
				console.log(dbc.W30.Paging.pagingRequired());
			}
			else
			{
				console.log("fetching warranties expiring within 30 days  -  " + data.msg );
				dbc.W30.Paging.Paging.required = false;
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};	

	dbc.getW60D = function(){
		console.log("fetching warranties expiring within 30 days...");
		var data = {};
		data.action="getW60D";
		data.primaryKey = "warrId";
		//console.log(data);
		var response = dataService.httpCall(data,"Models/Notification/NotificationDAO.php");
		response.then(function(result){
			//console.log(result);
			var data = result.data;
			//console.log(data);								
			if(! data.error) 
			{
				dbc.W60.data = angular.fromJson(result.data.data);				
				dbc.W60.Paging.init(dbc.W60);
				//alert(dbc.W30.Paging.Paging.required);
				//console.log(dbc.W5D);
				console.log("fetching warranties expiring within 60 days - success");
				console.log("fetched " + dbc.W60.data.length + " record(s).");

			}
			else
			{
				console.log("fetching warranties expiring within 60 days  -  " + data.msg );
				dbc.W60.Paging.Paging.required = false;
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};	

	dbc.getW90D = function(){
		console.log("fetching warranties expiring within 90 days...");
		var data = {};
		data.action="getW90D";
		data.primaryKey = "warrId";
		//console.log(data);
		var response = dataService.httpCall(data,"Models/Notification/NotificationDAO.php");
		response.then(function(result){
			//console.log(result);
			var data = result.data;
			// nconsole.log(data);

			if(! data.error) 
			{
				
				dbc.W90.data = angular.fromJson(result.data.data);
				console.log(dbc.W90.data);

				
				//dbc.W90.Paging.init(dbc.W90);
				
				console.log("fetching warranties expiring within 90 days - success");
				console.log("W90 fetched " + dbc.W90.data.length + " record(s).");				
				dbc.W90.Paging.init(dbc.W90);
			}
			else
			{
				console.log("fetching warranties expiring within 90 days  -  " + result.data.msg );
				dbc.W90.Paging.Paging.required = false;
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};	

	dbc.notify = function(data,title)
	{
		var response = dataService.httpCall(data,"Models/Mailer/Mailer.class.php");
		response.then(function(result){
			console.log(result);
			var data = angular.fromJson(result.data);
			///console.log(data.length);
			var tcnt = data.length;
			var scnt = 0;
			for(var i =0;i<data.length;i++)
			{
				if(data[i].mailSent);
					scnt++;
			}
			alert(title + "\n" + scnt + " of " + tcnt + " mail(s) sent.");
			//console.log(data);			

		},
		  function(result){
			alert(angular.toJson(result));
		});	
	}; 

	dbc.notifyD5 = function()
	{
		//console.log(dbc.W5D.length);		
		var data = {};
		data.notification = "wdbt.vw5days";
		data.mailMsg = "5 days";
		dbc.notify(data,"Warranties expiring with 5 days.");		
	};

	dbc.notifyW30D = function(){
		var data = {};
		data.notification = "wdbt.vw30days";
		data.mailMsg = "30 days";	
		dbc.notify(data,"Warranties expiring with 30 days.");	
	};	

	dbc.notify60D = function(){
		//console.log("fetching warranties expiring within 60 days...");
		var data = {};
		data.notification = "wdbt.vw60days";
		data.mailMsg = "60 days";
		dbc.notify(data,"Warranties expiring with 60 days.");	
	};

	dbc.notifyD90 = function()
	{
		//console.log(dbc.W5D.length);
		var data = {};
		data.notification = "wdbt.vw90days";
		data.mailMsg = "90 days";
		dbc.notify(data,"Warranties expiring with 90 days.");	
	};	

	dbc.init = function(){ 
		console.log("initialising ...");
		dbc.getCustomerCount();
		dbc.getDistributorCount();
		dbc.getW5D();
		dbc.getW30D();		
		dbc.getW60D();		
		dbc.getW90D();	
	};
	dbc.init();	


});