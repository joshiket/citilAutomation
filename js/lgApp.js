var app = angular.module("lgApp", ["ngRoute","ngMessages"]);  
            
app.config(function($routeProvider){
    $routeProvider
    .when("/",{
        templateUrl : "admin/views/user/login.html",
        controller : "userLoginController",
        controllerAs : "ulc",
        cache : false
    })
    .when("/forgotPass",{
        templateUrl : "admin/views/user/forgot-pass.html",
        controller : "forgotPassController",
        controllerAs : "fpc",
        cache : false
    })
    .otherwise({ redirectTo : '/'});

});