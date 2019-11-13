app.controller("dashBoardController", function(dataService, alertService, pageService){
	var dbc = this;
	dbc.custCnt = 0;
	dbc.W5 = {};
	dbc.W5.data= [];
	dbc.W5.data2show = [];
	dbc.W5.Paging = pageService;
	dbc.W5.pagingRequired=true;
	dbc.W60 = {};
	dbc.W60.data = [];
	dbc.W60.data2show = [];
	dbc.W60.noOfPages = 0;
	dbc.W60.currPage = 0;
	dbc.W60.noOfRecords = 0;
	dbc.W60.pageStart = 0;
	dbc.W60.pageEnd = 0;

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
			//console.log(result);
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
				dbc.W5.pagingRequired = (dbc.W5.data.length >= 15 ) ? true : false;
				dbc.W5.Paging.init(dbc.W5,15,dbc.W5.pagingRequired);
				console.log(dbc.W5.data2show);
			}
			else
			{
				console.log("fetching warranties expiring within 5 days  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

	dbc.notifyD5 = function()
	{
		//console.log(dbc.W5D.length);
		var notifArr = [];
		for(var i=0;i<dbc.W5.data2show.length;i++)
		{
			var row = {};
			if(dbc.W5.data2show[i])
			{
					row.custName = dbc.W5.data2show[i].custName;
					row.prodSerial = dbc.W5.data2show[i].prodSerial;
					row.prodDesc = dbc.W5.data2show[i].prodDesc;
					row.expDate = dbc.W5.data2show[i].expDate;
					row.AcMan = dbc.W5.data2show[i].acMan;
					row.Email = dbc.W5.data2show[i].Email;
					notifArr.push(row);
			}
		}
		console.log(notifArr);
		var data = {};
		data.notifArr = notifArr;
		data.notification = "5 Days";
		var response = dataService.httpCall(data,"Models/Mailer/Mailer.class.php");
		response.then(function(result){
            console.log(result);

		},
		  function(result){
			alert(angular.toJson(result));
		});		

	};

	dbc.getW60D = function(){
		console.log("fetching warranties expiring within 60 days...");
		var data = {};
		data.action="getW60D";
		data.primaryKey = "warrId";
		//console.log(data);
		var response = dataService.httpCall(data,"Models/Notification/NotificationDAO.php");
		response.then(function(result){
			//console.log(result);
			
			var data = result.data;
			
			//console.log(data);
			if(! result.data.error) 
			{
				dbc.W60D = angular.fromJson(result.data.data);
				var uArr = [];
				uArr.push(dbc.W60D[0]);
				for(var i =1; i <dbc.W60D.length;i++)
				{
					if( ! dbc.arrayExists(uArr,dbc.W60D[i]["prodSerial"],dbc.W60D[i]["AcMan"]))
						uArr.push(dbc.W60D[i]);
				}	
				dbc.W60.data = angular.fromJson(uArr);				
				dbc.initPaging(dbc.W60);
				
				console.log("fetching warranties expiring within 60 days - success");
				console.log("fetched " + dbc.W60.data.length + " record(s).");				
			}
			else
			{
				console.log("fetching warranties expiring within 10 days  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

	dbc.arrayExists = function(arr, pS, aM)
	{
		for(var i=0;i<arr.length;i++)
		{
			if(arr[i]["prodSerial"] == pS && arr[i]["AcMan"] == aM )
				return true;

		}
		return false;
	};

	dbc.getW90D = function(){
		console.log("fetching warranties expiring within 90 days...");
		var data = {};
		data.action="getW90D";
		data.primaryKey = "warrId";
		//console.log(data);
		var response = dataService.httpCall(data,"Models/Notification/NotificationDAO.php");
		response.then(function(result){
			console.log(result);
			var data = result.data;
			//console.log(data);

			if(! result.data.error) 
			{
				
				dbc.W90D = angular.fromJson(result.data.data);
				console.log(dbc.W90D);
				var uArr = [];
				uArr.push(dbc.W90D[0]);
				for(var i =1; i <dbc.W90D.length;i++)
				{
					if( ! dbc.arrayExists(uArr,dbc.W90D[i]["prodSerial"],dbc.W90D[i]["AcMan"]))
						uArr.push(dbc.W90D[i]);
				}
				dbc.W90.data = uArr;
				dbc.W90.Paging.init(dbc.W90);
				
				console.log("fetching warranties expiring within 90 days - success");
				console.log("fetched " + dbc.W90.data.length + " record(s).");
			}
			else
			{
				console.log("fetching warranties expiring within 90 days  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};	

	dbc.initPaging = function(obj)
	{
		obj.noOfRecords = obj.data.length;
		obj.noOfPages = parseInt(obj.noOfRecords / dbc.Paging.pageCount);
		obj.noOfPages =  (obj.noOfPages==0) ? 1 : obj.noOfPages;
		obj.currPage = 0;
		obj.pageStart = obj.currPage * dbc.Paging.pageCount
		obj.pageEnd = obj.pageStart + dbc.Paging.pageCount -1;
		if(obj.noOfPages == 1)
			obj.showNext = false;
		else
			obj.showNext = true;
		obj.showPrev = false;
		dbc.populatePage(obj);
	};

	dbc.nextPage = function(obj)
	{	
		obj.currPage = (obj.currPage + 1) % obj.noOfPages;
		obj.pageStart = obj.currPage * dbc.Paging.pageCount;
		obj.pageEnd = obj.pageStart + dbc.Paging.pageCount -1;
		dbc.populatePage(obj);
		if(obj.currPage > 0)
			obj.showPrev = true;
		
		if((obj.currPage+1) == obj.noOfPages)
			obj.showNext = false;
};

	dbc.prevPage = function(obj)	
	{
				
		
		if(obj.currPage == 0 )
		{
			obj.showPrev = false;
			return;
		}
		obj.currPage = (obj.currPage - 1) % obj.noOfPages;
		if(obj.currPage == 0 )
		{
			obj.showPrev = false;
			
		}		
		obj.pageStart = obj.currPage * dbc.Paging.pageCount;
		obj.pageEnd = obj.pageStart + dbc.Paging.pageCount -1;		
		dbc.populatePage(obj);

	};	

	dbc.populatePage= function(obj)
	{
		var k =0;		
		for(var i = obj.pageStart; i<= obj.pageEnd; i++)
		{
			obj.data2show[k] = obj.data[i];
			k++;
		}
	}

	dbc.init = function(){ 
		console.log("initialising ...");
		//dbc.getCustomerCount();
		//dbc.getDistributorCount();
		dbc.getW5D();
		//dbc.getW60D();		
		//dbc.getW90D();	
	};
	dbc.init();	


});