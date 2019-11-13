app.service("dataService", function($http){
    
    this.httpCall = function(data,url){
            var response = $http.post(url,data);
            return response;
    };

    this.revDate = function(dt)    
    {
        if(dt)
        {
            var dtArr = dt.split('-');
            if(dtArr[0].length == 4)
            {
                return dt;
            }
            else
            {
                var rstr = dtArr[2] + '-' + dtArr[1] + '-' + dtArr[0];
                return rstr;
            }
        }
    };
});