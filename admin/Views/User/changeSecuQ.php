                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-4">
                            <div class="panel panel-default" style="margin:50px 0px 0px 0px;">
                                <div class="panel-heading">
                                    Change Security Question
                                </div>
                                <div ng-show="csqc.tabs.isCurrentTab(1);">
                                    <div class="panel-body">
                                        <form name="lgForm">
                                            <div class="row">
                                                <!-- /.col-lg-6 (nested) -->
                                                <div class="col-lg-12">                                            
                                                        <div class="form-group input-group">
                                                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                                            <input type="password" class="form-control" placeholder="Password" name="usrPass" ng-model="csqc.User.usrPass" required autofocus>
                                                        </div>
                                                        <div>
                                                            <div ng-messages="lgForm.usrPass.$touched && lgForm.usrPass.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                                                <div ng-message="required"><small><i class="fa fa-asterisk"></i> Password  is mandatory.</small></div>                                                               
                                                            </div> 
                                                        </div>  
                                            
                                                </div>
                                            </div>
                                        </form>
                                            <!-- /.col-lg-6 (nested) -->
        
                                    </div>
                                    <!-- /.panel-body -->
                                    <div class="panel-footer">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-4 col-lg-offset-8">                                                
                                                    <button class="btn btn-primary" ng-show="csqc.User.usrPass != '' " ng-click="csqc.login();">Proceed</button>                                                        
                                                </div>
                                            </div>                                                    
                                        </div>                                     
                                    </div>
                                </div> <!-- tab 1-->
                                <div ng-show="csqc.tabs.isCurrentTab(2);">
                                        <div class="panel-body">
                                            <form name="lgForm">
                                                <div class="row">
                                                    <!-- /.col-lg-6 (nested) -->
                                                    <div class="col-lg-12">                                            
                                                            <div class="form-group">
                                                                <label>Security Question</label>
                                                                <input type="text" class="form-control" name="usrSecuQ" ng-model="csqc.User.usrSecuQ" required autofocus>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Answer</label>
                                                                <input type="text" class="form-control" name="usrSecuAns" ng-model="csqc.User.usrSecuAns" required >
                                                                <div ng-messages="lgForm.usrSecuAns.$touched && lgForm.usrSecuAns.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                                                    <div ng-message="required"><small><i class="fa fa-asterisk"></i> Answer  is mandatory.</small></div>                                                               
                                                                </div> 
                                                            </div>  
                                                
                                                    </div>
                                                </div>
                                                <div class="row" style="margin: 5px 0px 5px 0px;">
                                                    <div class=col-lg-12 ng-show="csqc.Alerts.isComplete()">
                                                        <div class="alert alert-success" ng-show="csqc.Alerts.isComplete() && !csqc.Alerts.hasError()">
                                                            <i class="fa fa-check-circle"></i> {{csqc.Alerts.getMessage()}}
                                                        </div>
                                                        <div class="alert alert-danger" ng-show="csqc.Alerts.isComplete() && csqc.Alerts.hasError()">
                                                            <i class="fa fa-exclamation-triangle"></i> {{csqc.Alerts.getMessage()}}
                                                        </div>                                
                                                    </div>
                                                </div>                                                
                                            </form>
                                                <!-- /.col-lg-6 (nested) -->
            
                                        </div>
                                        <!-- /.panel-body -->
                                        <div class="panel-footer">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-5 col-lg-offset-7">   

                                                        <button class="btn btn-primary" ng-show="csqc.User.usrSecuAns != ''" ng-click="csqc.resetSecurityQuestion();">Save</button>                                                        
                                                    </div>
                                                </div>                                                    
                                            </div>                                     
                                        </div>
                                    </div> <!-- tab 2-->              
                                    <div ng-show="csqc.tabs.isCurrentTab(3);">
                                        <div class="panel-body">
                                            <form name="lgForm">
                                                <div class="row">
                                                    <!-- /.col-lg-6 (nested) -->
                                                    <div class="col-lg-12">                                            
                                                        <p> {{fpc.User.msg}}</p>
                                                
                                                    </div>
                                                </div>
                                            </form>
                                                <!-- /.col-lg-6 (nested) -->
            
                                        </div>
                                        <!-- /.panel-body -->
                                        <div class="panel-footer">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-5 col-lg-offset-7">                                                
                                                        <a class="btn btn-primary" href="#/">Login</a>
                                                    </div>
                                                </div>                                                    
                                            </div>                                     
                                        </div>
                                    </div> <!-- tab 4-->                                                                 
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->