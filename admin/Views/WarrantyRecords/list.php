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
                                    <td>Branch</td>
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
                                    <td> {{w.InvNo}}</td>
                                    <td> {{w.InvDate}} </td>
                                    <td> {{w.CustName}} </td>
                                    <td> {{w.Branch}} </td>
                                    <td> {{w.ProdSerial}}</td>
                                    <td> {{w.ProdDesc}}</td>
                                    <td> {{w.ProdQty}}</td>
                                    <td> {{w.ExpDate}}</td>
                                    <td> {{w.Manager}}</td>
                                    <td> 
                                        <div class="dropdown">
                                            <button class="btn btn-xs btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                            <span class="caret"></span></button>
                                            <ul class="dropdown-menu" style="min-width:60px !important;">
                                                <li><a class="btn btn-success btn-xs" href="#/WarrantyRecords/update/{{w.warrId}}"><i class="fa fa-edit"></i></a></li>
                                                <li><a class="btn btn-info btn-xs" href="#/WarrantyRecords/details/{{w.warrId}}"><i class="fa fa-list"></i></a></li>
                                                <li><a class="btn btn-danger btn-xs" href="#/WarrantyRecords/delete/{{w.warrId}}"><i class="fa fa-trash"></i></a></li>
                                            </ul>
                                        </div>                                                                                 
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