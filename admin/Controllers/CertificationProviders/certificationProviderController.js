app.controller("newCertificationProviderController", function(dataService, alertService, pageService){
    var ncpc = this;
    ncpc.certificationProvider = {};
    ncpc.certificationProvider.primaryKey="cprovId";
    ncpc.certificationProvider.action="newCertificationProvider";
    ncpc.certificationProvider.cprovName = "";
    ncpc.alerts = alertService;
    
	ncpc.newCertificationProvider = function(){
		console.log("Saving Certification Provider...");
		console.log(ncpc.certificationProvider);
		var response = dataService.httpCall(ncpc.certificationProvider,"Models/CertificationProvider/CertificationProviderDAO.php");
		response.then(function(result){
            console.log(result);       
            var data = result.data;     
            console.log(data);
            ncpc.alerts.init(true, data.error, data.msg);
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};



    ncpc.init = function(){ 
        console.clear();
        console.log("initialising ...");
        ncpc.alerts.init(false,false,"");
    };
    ncpc.init();
});

app.controller("certificationProviderListController", function(dataService, alertService, pageService){

    var cplc = this;
    cplc.CertificateProviders = {};
    cplc.CertificateProviders.fetchData = {};
    cplc.CertificateProviders.fetchData.primaryKey = "cprovId";
    cplc.CertificateProviders.fetchData.action = "getAllCertificationProviders";

    cplc.CertificateProviders.data = [];
    cplc.CertificateProviders.data2show = [];
    cplc.Paging = pageService;
    cplc.pagingRequired = true;

	cplc.getCertificationProviders = function(){
		console.log("Fetching certification providers...");
		//console.log(cplc.CertificateProviders.fetchData);
		var response = dataService.httpCall(cplc.CertificateProviders.fetchData,"Models/CertificationProvider/CertificationProviderDAO.php");
		response.then(function(result){
            console.log(result);
            var data = result.data;
			if(! data.error) 
			{
                cplc.CertificateProviders.data =  angular.fromJson(data.data);            
                console.log("Fetching certification providers - success");
                console.log(cplc.CertificateProviders.data.length + " record(s) fetched.");
                cplc.pagingRequired = (cplc.CertificateProviders.data.length>=15) ? true : false; 
                cplc.Paging.init(cplc.CertificateProviders,15,cplc.pagingRequired);
                //console.log(cplc.pagingRequired + "|" + cplc.Paging.pagingRequired());
                if(!cplc.pagingRequired)
                    cplc.CertificateProviders.data2show = cplc.CertificateProviders.data;
                console.log(cplc.CertificateProviders.data2show);
			}
			else
			{
				console.log("Fetching certification providers  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
    };
    
    cplc.init = function(){ 
        console.log("initialising ...");
        cplc.getCertificationProviders();
    };
    cplc.init();





});