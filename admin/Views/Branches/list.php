<?php
?>
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                    <h3 class="page-header"><i class="fas fa-code-branch"></i></i> Customer Branch</h3>
                    <h6><a href="#/">Dashboard</a> |  <a href="#/customers/list">Customers</a> |<a href="#/CustomerBranches/list"> Customer Branches</a> | Manage Customer Branches</h6>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fas fa-code-branch fa-fw"></i> Manage Customer Branches                            
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                    <div class="row">
                            <div class="col-lg-4 col-lg-offset-4">
                                <div class="form-group input-group">
                                    <input type="text" class="form-control" ng-model="query">
                                    <div class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>                    
                        <div class="row">
                            <div class="col-lg-12">                                
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <td> Sr.No. </td>
                                            <td> Customer </td>
                                            <td> Branch </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="cb in cblc.CustomerBranches.data2show | filter:query track by $index">
                                            <td> {{$index +1}}
                                            <td>{{cb.custName}}</td>
                                            <td>{{cb.branchName}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>   
                        <div class="row" stnyle="margin: 5px 0px 5px 0px;">
                            <div class=col-lg-12 ng-show="cblc.Paging.pagingRequired()">
                                <div class="col-lg-9 text-left">
                                    <button class="btn btn-primary btn-xs" ng-show="cblc.Paging.showPrevious()" ng-click="cblc.Paging.First(cblc.CustomerBranches);"> <i class="fa fa-backward"></i></button>
                                    <button class="btn btn-primary btn-xs" ng-show="cblc.Paging.showNext()" ng-click="cblc.Paging.Last(cblc.CustomerBranches);"> <i class="fa fa-forward"></i></button>
                                </div>                             
                                <div class="col-lg-2 text-right" style="margin-top:-5px;">
                                    <h6>Page {{cblc.Paging.getCurrentPage()}} of {{cblc.Paging.getNoOfPages()}}</h6>
                                </div>
                                <div class="col-lg-1 text-left">                                
                                    <button class="btn btn-primary btn-xs" ng-show="cblc.Paging.showPrevious()" ng-click="cblc.Paging.Previous(cblc.CustomerBranches);"> <i class="fa fa-angle-left"></i></button>
                                    <button class="btn btn-primary btn-xs" ng-show="cblc.Paging.showNext()" ng-click="cblc.Paging.Next(cblc.CustomerBranches);"> <i class="fa fa-angle-right"></i></button>
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