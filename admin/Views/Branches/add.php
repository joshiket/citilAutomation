<?php
?>
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                    <h3 class="page-header"><i class="fas fa-code-branch"></i></i> Add Customer Branch</h3>
                    <h6><a href="#/">Dashboard</a> |  <a href="#/customers/list">Customers</a> |<a href="#/branchIdes/list"> Customer Branches</a> | Add Customer Branch</h6>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <form name="acbForm">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fas fa-code-branch fa-fw"></i> Add Customer Branch                            
                    </div>
                    <!-- /.panel-heading -->                    
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">                                
                                
                                    <label class="control-label">Customer  </label>
                                    <input type="text"  name="custId" list="custList" class="form-control" placeholder="Customer" ng-model="acbc.CustomerBranch.custId" required autofocus>
                                    <datalist id="custList">
                                        <option ng-repeat="c in acbc.Customers.data" value="{{c.custId}}"> {{c.custName}} </option>
                                    </datalist>
                                    <div ng-messages="acbForm.custId.$touched && acbForm.custId.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                        <div ng-message="required"><small><i class="fa fa-asterisk"></i> Customer is mandatory.</small></div>                                                               
                                    </div>                                     
                                </form>
                            </div>
                            <div class="col-lg-6">                                
                                <form name="acbForm">
                                    <label class="control-label">Branch  </label>
                                    <input type="text"  name="branchId" list="branchList" class="form-control" placeholder="Branch" ng-model="acbc.CustomerBranch.branchId" required autofocus>
                                    <datalist id="branchList">
                                        <option ng-repeat="b in acbc.Branches.data" value="{{b.branchId}}"> {{b.branchName}} </option>
                                    </datalist>                                    
                                    <div ng-messages="acbForm.branchId.$touched && acbForm.branchId.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                        <div ng-message="required"><small><i class="fa fa-asterisk"></i> Branch is mandatory.</small></div>                                                               
                                    </div>                                     
                                
                            </div>                            
                        </div>   
                        <div class="row" stnyle="margin: 5px 0px 5px 0px;">
                            <div class=col-lg-12 ng-show="acbc.alerts.isComplete()">
                                <div class="alert alert-success" ng-show="acbc.alerts.isComplete() && !acbc.alerts.hasError()">
                                    <i class="fa fa-check-circle"></i> {{acbc.alerts.getMessage()}}
                                </div>
                                <div class="alert alert-success" ng-show="acbc.alerts.isComplete() && acbc.alerts.hasError()">
                                    <i class="fa fa-exclamation-triangle"></i> {{acbc.alerts.getMessage()}}
                                </div>                                
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                    <div class="panel-footer">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-8">                                            
                                    <button class="btn btn-primary" ng-show="acbForm.$valid" ng-click="acbc.newCustomerBranch();">Save</button>                                                        
                                    <button class="btn btn-default" ng-click="acbc.resetForm();">Cancel</button>
                                </div>
                            </div>                                                    
                        </div>                         
                    </div>                    
                </div><!--panel-default-->
                </form>
            </div>            
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
<?php
?>    