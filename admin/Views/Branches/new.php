<?php
?>
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                    <h3 class="page-header"><i class="fas fa-code-branch"></i></i> Customer Branch</h3>
                    <h6><a href="#/">Dashboard</a> |  <a href="#/customers/list">Customers</a> |<a href="#/CustomerBranches/list"> Customer Branches</a> | New Customer Branch</h6>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fas fa-code-branch fa-fw"></i> New Customer Branch                            
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">                                
                                <form name="ncbForm">
                                    <label class="control-label">Branch Name </label>
                                    <input type="text"  name="branchName" class="form-control" placeholder="Certification Provider Name" ng-model="ncbc.Branch.branchName" required autofocus>
                                    <div ng-messages="ncbForm.branchName.$touched && ncbForm.branchName.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                        <div ng-message="required"><small><i class="fa fa-asterisk"></i> Certified Professional is mandatory.</small></div>                                                               
                                    </div>                                     
                                </form>
                            </div>
                        </div>   
                        <div class="row" stnyle="margin: 5px 0px 5px 0px;">
                            <div class=col-lg-12 ng-show="ncbc.alerts.isComplete()">
                                <div class="alert alert-success" ng-show="ncbc.alerts.isComplete() && !ncbc.alerts.hasError()">
                                    <i class="fa fa-check-circle"></i> {{ncbc.alerts.getMessage()}}
                                </div>
                                <div class="alert alert-success" ng-show="ncbc.alerts.isComplete() && ncbc.alerts.hasError()">
                                    <i class="fa fa-exclamation-triangle"></i> {{ncbc.alerts.getMessage()}}
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                    <div class="panel-footer">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3 col-lg-offset-9">                                            
                                    <button class="btn btn-primary" ng-show="ncbForm.$valid" ng-click="ncbc.newBranch();">Save</button>                                                        
                                </div>
                            </div>                                                    
                        </div>                         
                    </div>                    
                </div><!--panel-default-->
            </div>            
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
<?php
?>    