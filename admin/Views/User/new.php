<?php
    session_start();
    if($_SESSION["lgUser"] != "admin@admin.com")
    {
?>
    <script>
        document.location.href = "#/";
    </script>
<?php        
    }
    else
    { 
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-user"></i> New User</h3>
                <h6><a href="#/">Dashboard</a> |  Users | New User </h6>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <form name="newUserForm">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-file-user"></i> New User
                </div>
                <!-- /.panel-heading -->            
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6">                                                            
                                <label class="control-label">User Email</label>
                                <input type="email"  name="usrEmail" class="form-control" placeholder="Email" ng-model="nuc.User.usrEmail"  ng-pattern="/^(([^<>()\[\]\.,;:\s@\”]+(\.[^<>()\[\]\.,;:\s@\”]+)*)|(\”.+\”))@(([^<>()[\]\.,;:\s@\”]+\.)+[^<>()[\]\.,;:\s@\”]{2,})$/i" required>                                                         
                                <div ng-messages="newUserForm.usrEmail.$touched && newUserForm.usrEmail.$error" class="err-msg" role="alert">
                                     <div ng-message="required"><small><i class="fa fa-asterisk"></i> Email is mandatory.</small></div>                                                               
                                     <div ng-message="pattern"><small><i class="fa fa-asterisk"></i> Valid email required.</small></div>                                                               
                           			</div>                                 
                        </div>
                        <div class="col-lg-6">  
                            <label class="control-label"> Password</label>
                            <input type="password"  name="usrPass" class="form-control" placeholder="Password" ng-model="nuc.User.usrPass" required autofocus>      
                            <div ng-messages="newUserForm.usrPass.$touched && newUserForm.usrPass.$error" class="err-msg" role="alert">
                                <div ng-message="required"><small><i class="fa fa-asterisk"></i>  Password is mandatory.</small></div>                                                               
                            </div>                         
                        </div>
                    </div>   
                    <div class="row">
                        <div class="col-lg-6">  
                            <label class="control-label">Confirm Password</label>
                             <input type="password"  name="confPass" class="form-control" placeholder="Confirm Password" ng-model="nuc.User.confPass" required >                                                                                     
														 <div ng-messages="newUserForm.confPass.$touched && newUserForm.confPass.$error" class="err-msg" role="alert">                                                                                            
																<div ng-show="nuc.User.confPass != nuc.User.usrPass"><i class="fa fa-asterisk"></i> Password does not match.</div>
                            </div> 																													
                        </div>
                        <div class="col-lg-6">  
                            <label class="control-label">Name</label>
                            <input type="text"  name="usrName" class="form-control" placeholder="Full name" ng-model="nuc.User.usrName" required >                                                                                     
							<div ng-messages="newUserForm.usrName.$touched && newUserForm.usrName.$error" class="err-msg" role="alert">                                                                                            
								<div ng-message="required"><i class="fa fa-asterisk"></i> Password does not match.</div>
                            </div> 																													
                        </div>                      
                    </div>        
                    <div class="row">
										<div class="col-lg-6">                                                        
                            <label class="control-label">Security Question</label>
                            <input type="text"  name="secuQ" class="form-control" placeholder="Security Question" ng-model="nuc.User.usrSecuQ" required >                                                                                                                    
                            <div ng-messages="newUserForm.secuQ.$touched && newUserForm.secuQ.$error" class="err-msg" role="alert">
                                <div ng-message="required"><small><i class="fa fa-asterisk"></i> Security question is mandatory.</small></div>                                                               
                            </div>   																												
                        </div>  
                        <div class="col-lg-6">  
                            <label class="control-label">Answer</label>
                             <input type="text"  name="secuAns" class="form-control" placeholder="Security Answer" ng-model="nuc.User.usrSecuAns" required >                                                                                     
														 <div ng-messages="newUserForm.secuAns.$touched && newUserForm.secuAns.$error" class="err-msg" role="alert">
                                <div ng-message="required"><small><i class="fa fa-asterisk"></i> Security answer is mandatory.</small></div>                                                               																																
                            </div> 																													
                        </div>
                    </div>                                                               
                    <div class="row" stnyle="margin: 5px 0px 5px 0px;">
                        <div class=col-lg-12 ng-show="nuc.Alerts.isComplete()">
                            <div class="alert alert-success" ng-show="nuc.Alerts.isComplete() && !nuc.Alerts.hasError()">
                                <i class="fa fa-check-circle"></i> {{nuc.Alerts.getMessage()}}
                            </div>
                            <div class="alert alert-danger" ng-show="nuc.Alerts.isComplete() && nuc.Alerts.hasError()">
                                <i class="fa fa-exclamation-triangle"></i> {{nuc.Alerts.getMessage()}}
                            </div>                                
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
                <div class="panel-footer">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-8">                                            
                                <button class="btn btn-primary" ng-show="newUserForm.$valid" ng-click="nuc.newUser();">Save</button>                                                        
								<button class="btn btn-default" ng-click="nuc.resetForm();">Cancel</button>
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
<?php
    }
?>