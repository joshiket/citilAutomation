app.controller("newCertificationController", function(dataService,alertService){
    var ncc = this;
    
	ncc.Certification = {};
	ncc.Certification.cprofId = "";
	ncc.Certification.cprovId = "";
	ncc.Certification.certiExam = "";
	ncc.Certification.certiExamDesc = "";
	ncc.Certification.certiOn = "";
	ncc.Certification.certiExpires = false;
	ncc.Certification.certiValidTill = null;
	ncc.Certification.action = "newCertification";
	ncc.Certification.primaryKey = "certiId";

    ncc.CertifiedProfessionals = {};
    ncc.CertifiedProfessionals.fetchData  = {};
    ncc.CertifiedProfessionals.fetchData.primaryKey="cprofId";
    ncc.CertifiedProfessionals.fetchData.action = "getAllCertifiedProfessionals";
    ncc.CertifiedProfessionals.data = [];

    ncc.CertificationProviders = {};
    ncc.CertificationProviders.fetchData  = {};
    ncc.CertificationProviders.fetchData.primaryKey="cprovId";
    ncc.CertificationProviders.fetchData.action = "getAllCertificationProviders";
	ncc.CertificationProviders.data = [];

	ncc.alerts = alertService;
	
    angular.element(document).ready(function () {
        $('.dip').datepicker({
            format: 'dd-mm-yyyy',
            todayHighlight: true,
          });        
    }); 	

	ncc.getCertifiedProfessionals = function(){
		console.log("Fetching Certified Professionals...");
		console.log(ncc.CertifiedProfessionals.fetchData);
		
		var response = dataService.httpCall(ncc.CertifiedProfessionals.fetchData,"Models/CertifiedProfessional/CertifiedProfessionalDAO.php");
		response.then(function(result){
            //console.log(result);
            var data = result.data;
			if(!data.error) 
			{
				ncc.CertifiedProfessionals.data = angular.fromJson(result.data.data);
                console.log("Fetching Certified Professionals - success");
                console.log(ncc.CertifiedProfessionals.data);				
			}
			else
			{
				console.log("Fetching Certified Professionals  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

    ncc.getCertificationProviders = function(){
		console.log("Fetching Certification Providers...");
		//console.log(ncc.CertifiedProfessionals.fetchData);
		var response = dataService.httpCall(ncc.CertificationProviders.fetchData,"Models/CertificationProvider/CertificationProviderDAO.php");
		response.then(function(result){
            //console.log(result);
            var data = result.data;
			if(!data.error) 
			{
				ncc.CertificationProviders.data = angular.fromJson(result.data.data);
                console.log("Fetching  Certification Providers - success");
                console.log(ncc.CertificationProviders.data);				
			}
			else
			{
				console.log("Fetching Certification Providers  -  " + result.data.msg );
			}
		},
		  function(result){
			alert(angular.toJson(result));
		});
	};

	ncc.changeDateFormat  = function(dt)
	{
		var dtArr = dt.split('-');
		var rtDate = dtArr[2] + "-" + dtArr[1] + "-" + dtArr[0];
		return rtDate;
	};
	

    
    ncc.newCertification = function(){
		console.log("Saving Certification...");
		ncc.Certification.certiOn = ncc.changeDateFormat(ncc.Certification.certiOn);
		alert(ncc.Certification.certiExpires);
		if(ncc.Certification.certiExpires == true)
			ncc.Certification.certiValidTill = ncc.changeDateFormat(ncc.Certification.certiValidTill);
		else
			ncc.Certification.certiValidTill = null;
		ncc.Certification.certiExpires = (ncc.Certification.certiExpires == true) ? "y" : "n";
		console.log(ncc.Certification);

		var response = dataService.httpCall(ncc.Certification,"Models/Certification/CertificationDAO.php");		
		response.then(function(result){			
			//console.log(result);
			var data = result.data;
			console.log(data);
			ncc.alerts.init(true,data.error,data.msg);
		},
		  function(result){
			alert(angular.toJson(result));
        });
    
    };    

    ncc.init = function(){ 
        console.clear();
        console.log("initialising ...");
        ncc.getCertifiedProfessionals();        
        ncc.getCertificationProviders();
    };
     ncc.init();
    
});

app.controller("certificationListController", function(dataService,alertService,pageService){
	var clc = this;
	clc.Certifications = {};
	clc.Certifications.fetchData = {};
	clc.Certifications.fetchData.primaryKey = "primaryKey";
	clc.Certifications.fetchData.action = "getAllCertifications";
	clc.Certifications.data = [];
	clc.Certifications.data2show = [];
    clc.Certifications.Paging = pageService;
    
	clc.getCertifications = function(){
		console.log("Fetching OEM Certifications...");
		//console.log(clc.Certifications.fethData);
		var response = dataService.httpCall(clc.Certifications.fetchData,"Models/Certification/CertificationDAO.php");
		response.then(function(result){
            //console.log(result);
            var data = result.data;
            //console.log(data);
            if(!data.error)
            {
                clc.Certifications.data = angular.fromJson(data.data);
                clc.Certifications.Paging.init(clc.Certifications);
                console.log("Fetching OEM Certifications - success");
                console.log(clc.Certifications.data.length + " record(s) fetched.");
				console.log(clc.Certifications.data2show);
				
            }
            else
            {
                console.log("Fetching OEM Certifications - " + data.msg);
            }
			
		},
		  function(result){
			alert(angular.toJson(result));
		});
    };
    
    clc.init = function(){ 
        console.log();
        console.log("initialising ...");
        clc.getCertifications();
    };
     clc.init();    

});