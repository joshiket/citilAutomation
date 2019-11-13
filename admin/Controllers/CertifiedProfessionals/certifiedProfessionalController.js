app.controller("newCertifiedProfessionalController", function(dataService,alertService,pageService){
	var ncpc = this;
	ncpc.CertifiedProfessional = {};
	ncpc.CertifiedProfessional.primaryKey = "cprofId";
	ncpc.CertifiedProfessional.action = "newCertifiedProfessional";
    ncpc.CertifiedProfessional.cprofName = "";
    ncpc.alerts = alertService;
    
	ncpc.newCertifiedProfessional = function(){
		console.log("Saving Certified Professional...");
		console.log(ncpc.CertifiedProfessional);
		var response = dataService.httpCall(ncpc.CertifiedProfessional,"Models/CertifiedProfessional/CertifiedProfessionalDAO.php");
		response.then(function(result){
			console.log(result);
			var data = result.data;
			ncpc.alerts.init(true, data.error, data.msg);
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

    ncpc.init = function(){ 
        console.clear();
        console.log("initialising ...");
    };
    ncpc.init();

});

app.controller("certifiedProfessionalListController", function(dataService,alertService,pageService){
	
	var cplc = this;	
	cplc.CertifiedProfessionals = {};
	cplc.CertifiedProfessionals.data = [];
	cplc.CertifiedProfessionals.data2show = [];
	cplc.CertifiedProfessionals.fetchData = {};
	cplc.CertifiedProfessionals.fetchData.primaryKey = "cprovId";
	cplc.CertifiedProfessionals.fetchData.action = "getAllCertifiedProfessionals";
	cplc.CertifiedProfessionals.Paging = pageService;
	cplc.CertifiedProfessionals.pagingRequired = true;

	cplc.getCertifiedProfessionals = function(){
		console.log("Fetching Certified professionals...");
		//console.log(cplc.CertifiedProfessionals.fetchData);
		var response = dataService.httpCall(cplc.CertifiedProfessionals.fetchData,"Models/CertifiedProfessional/CertifiedProfessionalDAO.php");
		response.then(function(result){
			console.log(result);
			if(! result.data.error) 
			{
				cplc.CertifiedProfessionals.data = angular.fromJson(result.data.data);
				cplc.CertifiedProfessionals.pagingRequired = (cplc.CertifiedProfessionals.data.length >= 15) ? true: false;
				if(cplc.CertifiedProfessionals.data.length >= 15)
					cplc.CertifiedProfessionals.Paging.init(cplc.CertifiedProfessionals,15,cplc.CertifiedProfessionals.pagingRequired);
				else
				cplc.CertifiedProfessionals.Paging.init(cplc.CertifiedProfessionals,cplc.CertifiedProfessionals.data.length,cplc.CertifiedProfessionals.pagingRequired);
				console.log(cplc.CertifiedProfessionals.data2show);
				//console.log("Fetching Certified professionals - success");
			}
			else
			{
				console.log("Fetching Certified professionals  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

	cplc.init = function(){ 
		console.clear();
		console.log("initialising ...");
		cplc.getCertifiedProfessionals();
	};
	 cplc.init();	


});
