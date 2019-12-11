<?php

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-user"></i> Change Password</h3>
                <h6><a href="#/">Dashboard</a> |  Users | Change Password</h6>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <form name="cpForm">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-user"></i> Change Password                                            
                </div>
                <!-- /.panel-heading -->            
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">                                
                            
                                <label class="control-label">User Email</label>
                                <input type="text"  name="usrEmail" class="form-control" placeholder="Email" ng-model="cpc.User.usrEmail" readonly >                                                         
                        </div>
                        <div class="col-lg-6">  
                            <label class="control-label">Current Password</label>
                            <input type="password"  name="oldPass" class="form-control" placeholder="Current Password" ng-model="cpc.User.oldPass" required autofocus>      
                            <div ng-messages="cpForm.oldPass.$touched && cpForm.oldPass.$error" class="err-msg" role="alert">
                                <div ng-message="required"><small><i class="fa fa-asterisk"></i> Current Password is mandatory.</small></div>                                                               
                            </div>                         
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col-lg-6">                                                        
                            <label class="control-label">New Password</label>
                            <input type="password"  name="newPass" class="form-control" placeholder="New Password" ng-model="cpc.User.newPass" required >                                                                                                                    
                            <div ng-messages="cpForm.newPass.$touched && cpForm.newPass.$error" class="err-msg" role="alert">
                                <div ng-message="required"><small><i class="fa fa-asterisk"></i> Current Password is mandatory.</small></div>                                                               
                            </div>   																												
                        </div>
                        <div class="col-lg-6">  
                            <label class="control-label">Confirm Password</label>
                             <input type="password"  name="confPass" class="form-control" placeholder="Confirm Password" ng-model="cpc.User.confPass" required >                                                                                     
																												<div ng-messages="cpForm.confPass.$touched && cpForm.confPass.$error" class="err-msg" role="alert">
                                <div ng-message="required"><small><i class="fa fa-asterisk"></i> Current Password is mandatory.</small></div>                                                               
																																<div ng-show="cpc.User.confPass != cpc.User.newPass">Password does not match.</div>
                            </div> 																													
                        </div>
                    </div>                                                 
                    <div class="row" stnyle="margin: 5px 0px 5px 0px;">
                        <div class=col-lg-12 ng-show="ncpc.alerts.isComplete()">
                            <div class="alert alert-success" ng-show="ncpc.alerts.isComplete() && !ncpc.alerts.hasError()">
                                <i class="fa fa-check-circle"></i> {{ncpc.alerts.getMessage()}}
                            </div>
                            <div class="alert alert-success" ng-show="ncpc.alerts.isComplete() && ncpc.alerts.hasError()">
                                <i class="fa fa-exclamation-triangle"></i> {{ncpc.alerts.getMessage()}}
                            </div>                                
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
                <div class="panel-footer">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-3 col-lg-offset-9">                                            
                                <button class="btn btn-primary" ng-show="cpForm.$valid" ng-click="ncpc.newCertifiedProfessional();">Save</button>                                                        
                            </div>
                        </div>                                                    
                    </div>        
                                
                </div>                    
            </div>
            </form>    
        </div>            
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->