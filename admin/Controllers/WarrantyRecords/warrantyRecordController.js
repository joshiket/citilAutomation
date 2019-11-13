app.controller("newWarrantyRecordController", function(dataService, alertService, pageService){
    var nwrc = this;

    nwrc.Customers = {};
    nwrc.Customers.fetchData = {};    
    nwrc.Customers.fetchData.action="getAllCustomers";
    nwrc.Customers.fetchData.primaryKey = "custId";
    nwrc.Customers.data = [];

    nwrc.Distributors = {};
    nwrc.Distributors.fetchData = {};    
    nwrc.Distributors.fetchData.action="getAllDistributors";
    nwrc.Distributors.fetchData.primaryKey = "distId";
    nwrc.Distributors.data = [];
    
    nwrc.Warranty = {};
    nwrc.Warranty.action = "newWarranty";
    nwrc.Warranty.primaryKey = "warrId";
    nwrc.Warranty.citilInvoiceNo = "";
    nwrc.Warranty.citilInvoiceDate = "";
    nwrc.Warranty.custId = "";
    nwrc.Warranty.prodNo = "";
    nwrc.Warranty.prodDesc = "";
    nwrc.Warranty.prodSerial = "";
    nwrc.Warranty.prodQty = "";
    nwrc.Warranty.distId = "";
    nwrc.Warranty.distInvoiceNo = "";
    nwrc.Warranty.distInvoiceDate = "";
    nwrc.Warranty.warrExYears = "";
    nwrc.Warranty.warrExpDate = "";

    angular.element(document).ready(function () {
        $('.dip').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
          });        
    }); 
    
    nwrc.addToDate = function()
    {        
        var d = nwrc.Warranty.distInvoiceDate;
        var dtArr = d.split("-");

        dtArr[2] = parseInt(dtArr[2]);
        var nd = new Date(dtArr[2],dtArr[1]-1,dtArr[0]);
        //console.log(nd.getFullYear());
        var y = nd.getFullYear() + parseInt(nwrc.Warranty.warrExYears);
        dtArr[2] = y;
        nwrc.Warranty.warrExpDate = dtArr[0] + "-" + dtArr[1] + "-"+ dtArr[2];
    }

    nwrc.convertDate= function(d)
    {
        var dtArr = d.split("-");
        var retDt = dtArr[2] + "-" + dtArr[1] + "-" + dtArr[0];
        return retDt; 
    }

    nwrc.getCustomers = function(){
		console.log("Fetching customers...");
		//console.log(nwrc.Customers);
		var response = dataService.httpCall(nwrc.Customers.fetchData,"Models/Customer/CustomerDAO.php");
		response.then(function(result){
            //console.log(result);
            var data = result.data;
            //console.log(data);
			if(! data.error) 
			{ 
				nwrc.Customers.data = angular.fromJson(data.data);
                console.log("Fetching customers - success");
                console.log(nwrc.Customers.data.length + " record(s) fetched.");
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

	nwrc.getDistributors = function(){
		console.log("Fetching distributors...");
		//console.log(nwrc.Distributors.fetchData);
		var response = dataService.httpCall(nwrc.Distributors.fetchData,"Models/Distributor/DistributorDAO.php");
		response.then(function(result){
            //console.log(result);
            var data = result.data;
			if(! result.data.error) 
			{
				nwrc.Distributors.data = angular.fromJson(result.data.data);				
                console.log("Fetching distributors - success");
                console.log(nwrc.Distributors.data.length + " record(s) fetched.");
			}
			else
			{
				console.log("Fetching distributors  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

    


    nwrc.init = function(){ 
        console.clear();
        console.log("initialising ...");
        nwrc.getCustomers();
        nwrc.getDistributors();        
    };
    nwrc.init();
});

app.controller("WarrantyRecordListController", function(dataService, alertService, pageService){
	var wrlc = this;
	wrlc.Warranty = {};
    wrlc.Warranty.data = [];
    wrlc.Warranty.data2show = [];
    wrlc.Warranty.fetchData = {};
	wrlc.Warranty.fetchData.primaryKey = "warrId";
    wrlc.Warranty.fetchData.action = "getAllWarrantyRecords";
    wrlc.Paging = pageService;
    

	wrlc.getWarrantyRecords = function(){
		console.log("Fetching Warranty Records...");
		//console.log(wrlc.Warranty.fetchData);
		var response = dataService.httpCall(wrlc.Warranty.fetchData,"Models/WarrantyRecord/WarrantyRecordDAO.php");
		response.then(function(result){
            console.log(result);
            var data = result.data;
			if(! data.error) 
			{
                wrlc.Warranty.data= angular.fromJson(result.data.data);
                console.log("Fetching Warranty Records - success");
                console.log(wrlc.Warranty.data.length + " record(s) fetched.");
                wrlc.pagingRequired = (wrlc.Warranty.data.length >= 15) ? true : false;
                wrlc.Paging.init(wrlc.Warranty,100);
                console.log(wrlc.Warranty.data2show);
			}
			else
			{
				console.log("Fetching Warranty Records  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

    wrlc.init = function(){ 
        
        console.clear();
        console.log("initialising ...");
        wrlc.getWarrantyRecords();
    };
    wrlc.init();

});