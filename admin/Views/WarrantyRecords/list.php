<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-user-tie"></i> Warranty Records</h3>
                    <h6><a href="#/">Dashboard</a> | <a href="#/WarranRecords/list">Warranty Records</a> | Manage Warranty Records</h6>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-file-contract fa-fw"></i> Warranty Records
                        <div class="pull-right">
                            
                        </div>
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
                        <table class="table table-striped table-hover table-bordered table-condensed">
                            <thead>
                                <tr style="font-weight:bold;">
                                    <td>Sr.no.</td>
                                    <td>CITIL Invoice No.</td> 
                                    <td>CITIL Invoice Date</td>
                                    <td>Customer</td>
                                    <td>Prod. Serial</td>
                                    <td>Prod. Desc</td>
                                    <td>Prod. Qty</td>
                                    <td>Expiry Date</td>
                                    <td>Manager</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                 <tr ng-repeat="w in wrlc.Warranty.data2show  | filter:query track by $index">
                                    <td> {{$index+1}}</td> 
                                    <td> {{w.citilInvoiceNo}}</td>
                                    <td> {{w.citilInvoiceDate}} </td>
                                    <td> {{w.custName}} </td>
                                    <td> {{w.prodSerial}}</td>
                                    <td> {{w.prodDesc}}</td>
                                    <td> {{w.prodQty}}</td>
                                    <td> {{w.expDate}}</td>
                                    <td> {{w.acManName}}</td>
                                    <td> 
                                        <a href="#/managers/update/{{m.acManId}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                        <a href="#/managers/details/{{m.acManId}}" class="btn btn-info btn-xs"><i class="fa fa-list"></i></a>
                                        <a href="#/managers/delete/{{m.acManId}}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                    </td>
                                 </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-lg-9 text-left">
                                <button class="btn btn-primary btn-xs" ng-show="wrlc.Paging.showPrevious()" ng-click="wrlc.Paging.First(wrlc.Warranty);"> <i class="fa fa-backward"></i></button>
                                <button class="btn btn-primary btn-xs" ng-show="wrlc.Paging.showNext()" ng-click="wrlc.Paging.Last(wrlc.Warranty);"> <i class="fa fa-forward"></i></button>
                            </div>                             
                            <div class="col-lg-2 text-right" style="margin-top:-5px;">
                                <h6>Page {{wrlc.Paging.getCurrentPage()}} of {{wrlc.Paging.getNoOfPages()}}</h6>
                            </div>
                            <div class="col-lg-1 text-left">                                
                                <button class="btn btn-primary btn-xs" ng-show="wrlc.Paging.showPrevious()" ng-click="wrlc.Paging.Previous(wrlc.Warranty);"> <i class="fa fa-angle-left"></i></button>
                                <button class="btn btn-primary btn-xs" ng-show="wrlc.Paging.showNext()" ng-click="wrlc.Paging.Next(wrlc.Warranty);"> <i class="fa fa-angle-right"></i></button>
                            </div>
                        </div>                        
                    </div>
                    <!-- /.panel-body -->
                </div>

            </div>
            

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->