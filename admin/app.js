var app = angular.module("app", ["ngRoute","ngMessages"]);  
            
app.config(function($routeProvider){
    $routeProvider
    .when("/",{
        templateUrl : "views/dashboard/dashboard.html",
        controller : "dashBoardController",
        controllerAs : "dbc",
        cache : false
    })
    .when("/customers/list",{
        templateUrl : "views/customers/list.html",
        controller : "customerListController",
        controllerAs : "clc",
        cache : false
    })    
    .when("/customers/details/:custId",{
        templateUrl : "views/customers/details.html",
        controller : "customerDetailsController",
        controllerAs : "cdc",
        cache : false
    })     
    .when("/distributors/list",{
        templateUrl : "views/distributors/list.html",
        controller : "ditributorListController",
        controllerAs : "dlc",
        cache : false
    })    
    .when("/ditributors/detils/:distId",{
        templateUrl : "views/distributors/details.html",
        controller : "ditributorDetailsController",
        controllerAs : "ddc",
        cache : false
    })      
    .when("/managers/list",{
        templateUrl : "views/managers/list.html",
        controller : "managerListController",
        controllerAs : "mlc",
        cache : false
    })    
    .when("/managers/detils/:AcManId",{
        templateUrl : "views/managers/details.html",
        controller : "managerDetailsController",
        controllerAs : "mdc",
        cache : false
    })    
    .when("/products/list",{
        templateUrl : "views/products/list.html",
        controller : "productListController",
        controllerAs : "plc",
        cache : false
    })    
    .when("/products/new",{
        templateUrl : "views/products/new.html",
        controller : "newProductController",
        controllerAs : "npc",
        cache : false
    })     
    .when("/WarrantyRecords/new",{
        templateUrl : "views/WarrantyRecords/new.php",
        controller : "newWarrantyRecordController",
        controllerAs : "nwrc",
        cache : false
    })      
    .when("/WarrantyRecords/list",{
        templateUrl : "views/WarrantyRecords/list.php",
        controller : "WarrantyRecordListController",
        controllerAs : "wrlc",
        cache : false
    })    
    .when("/CertificationProviders/new",{
        templateUrl : "views/CertificationProviders/new.html",
        controller : "newCertificationProviderController",
        controllerAs : "ncpc",
        cache : false
    })      
    .when("/CertificationProviders/list",{
        templateUrl : "views/CertificationProviders/list.html",
        controller : "certificationProviderListController",
        controllerAs : "cplc",
        cache : false
    })  
    .when("/CertifiedProfessionals/new",{
        templateUrl  : "Views/CertifiedProfessionals/new.html",
        controller : "newCertifiedProfessionalController",
        controllerAs : "ncpc",
        cache : false
    })  
    .when("/CertifiedProfessionals/list",{
        templateUrl  : "Views/CertifiedProfessionals/list.html",
        controller : "certifiedProfessionalListController",
        controllerAs : "cplc",
        cache : false
    })          
    .otherwise({ redirectTo : '/'});

});