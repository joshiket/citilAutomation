<?php
?>
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-file-contract"></i> Warranty records</h3>
                <h6><a href="#/">Dashboard</a> | <a href="#/WarranRecords/list">Warranty Records</a> | New Warranty Record</h6>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-file-contract fa-fw"></i> New Warranty record
                        <div class="pull-right">
                            
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form name="NWRF">
                            <div class="row">
                                <div class="col-lg-4 form-group">
                                    <label class="control-label">CITIL Invoice no.</label> 
                                    <input type="text" class="form-control" ng-model="nwrc.Warranty.citilInvoiceNo" name="citilInvoiceNo" required autofocus>                                                                        
                                    <div ng-messages="NWRF.citilInvoiceNo.$touched && NWRF.citilInvoiceNo.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                        <div ng-message="required"><small><i class="fa fa-asterisk"></i> CITIL Invoice no. is mandatory.</small></div>                                                               
                                    </div>                                                                                        
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label class="control-label">CITIL Invoice date</label> 
                                    <div class="input-group">
                                        <input type="text" class="form-control dip" ng-model="nwrc.Warranty.citilInvoiceDate" name="citilInvoiceDate"  placeholder="dd-mm-yyyy" required>                                    
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        <div ng-messages="NWRF.citilInvoiceDate.$touched && NWRF.citilInvoiceDate.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                             <div ng-message="required"><small><i class="fa fa-asterisk"></i> CITIL Invoice date is mandatory.</small></div>                                                               
                                        </div>                                          
                                    </div>
                                </div>     
                                <div class="col-lg-4 form-group">
                                    <label class="control-label">Customer Id</label> 
                                    <input type="text" list = "custList" class="form-control" ng-model="nwrc.Warranty.custId" name="custId"  ng-pattern="/^[1-9]\d*$/" required>                                    
                                    <datalist id="custList">
                                        <option ng-repeat="c in nwrc.Customers.data" value="{{c.custId}}"> {{c.custName}} </option>
                                    </datalist>
                                    <div ng-messages="NWRF.custId.$touched && NWRF.custId.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                        <div ng-message="required"><small><i class="fa fa-asterisk"></i> Customer Id is mandatory.</small></div>                                                               
                                        <div ng-message="pattern"><small><i class="fa fa-asterisk"></i> Numeric value expected.</small></div>        
                                    </div>                                      
                                </div>                       
                            </div>
                            <div class="row">
                                    <div class="col-lg-4 form-group">
                                        <label class="control-label">Product no.</label> 
                                        <input type="text" class="form-control" ng-model="nwrc.Warranty.prodNo" name="prodNo" >                                                                             
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label class="control-label">Product desc.</label> 
                                        <input type="text" class="form-control" ng-model="nwrc.Warranty.prodDesc" name="prodDesc"   required>                                    
                                        <div ng-messages="NWRF.prodDesc.$touched && NWRF.prodDesc.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                            <div ng-message="required"><small><i class="fa fa-asterisk"></i> Product desc. is mandatory.</small></div>                                                               
                                        </div>                                           
                                    </div>     
                                    <div class="col-lg-4 form-group">
                                        <label class="control-label">Product Serial</label> 
                                        <input type="text" class="form-control" ng-model="nwrc.Warranty.prodSerial" name="prodSerial"  required>                                    
                                        <div ng-messages="NWRF.prodSerial.$touched && NWRF.prodSerial.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                            <div ng-message="required"><small><i class="fa fa-asterisk"></i> Product Serial is mandatory.</small></div>                                                               
                                        </div>                                           
                                    </div>                       
                            </div>     
                            <div class="row">
                                    <div class="col-lg-4 form-group">
                                        <label class="control-label">Product qty.</label> 
                                        <input type="text" class="form-control" ng-model="nwrc.Warranty.prodQty" name="prodQty" ng-pattern="/^[1-9]\d*$/" required>                                    
                                        <div ng-messages="NWRF.prodQty.$touched && NWRF.prodQty.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                            <div ng-message="required"><small><i class="fa fa-asterisk"></i> Product qty. is mandatory.</small></div>                                                               
                                            <div ng-message="pattern"><small><i class="fa fa-asterisk"></i> Numeric value expected.</small></div>        
                                        </div>                                         
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label class="control-label">Distributor Id</label> 
                                        <input type="text" class="form-control" list = "distList" ng-model="nwrc.Warranty.distId" name="distId" ng-pattern="/^[1-9]\d*$/"   required>    
                                        <datalist id="distList">
                                            <option ng-repeat="d in nwrc.Distributors.data" value="{{d.distId}}"> {{d.distName}} </option>
                                        </datalist>
                                        <div ng-messages="NWRF.distId.$touched && NWRF.distId.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                            <div ng-message="required"><small><i class="fa fa-asterisk"></i> Distributor Id is mandatory.</small></div>                                                               
                                            <div ng-message="pattern"><small><i class="fa fa-asterisk"></i> Numeric value expected.</small></div>        
                                        </div>                                         
                                    </div>     
                                    <div class="col-lg-4 form-group">
                                        <label class="control-label">Distributor Invoice no.</label> 
                                        <input type="text" class="form-control" ng-model="nwrc.Warranty.distInvoiceNo" name="distInvoiceNo"  required>                                    
                                        <div ng-messages="NWRF.distInvoiceNo.$touched && NWRF.distInvoiceNo.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                            <div ng-message="required"><small><i class="fa fa-asterisk"></i> Distributor Invoice no. is mandatory.</small></div>                                                               
                                        </div>                                         
                                    </div>                       
                            </div> 
                            <div class="row">
                                    <div class="col-lg-4 form-group">
                                        <label class="control-label">Distributor Invoice date</label> 
                                        <div class="input-group">
                                             <input type="text" class="form-control dip" ng-model="nwrc.Warranty.distInvoiceDate" name="distInvoiceDate"  required>                                     
                                             <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <div ng-messages="NWRF.distInvoiceDate.$touched && NWRF.distInvoiceDate.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                            <div ng-message="required"><small><i class="fa fa-asterisk"></i> Distributor Invoice date is mandatory.</small></div>                                                               
                                        </div>                                         
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label class="control-label">Warranty duration in years</label> 
                                        <input type="text" class="form-control" ng-model="nwrc.Warranty.warrExYears" name="warrExYears" ng-blur="nwrc.addToDate();" ng-pattern="/^[1-9]\d*$/"    required>                                    
                                        <div ng-messages="NWRF.warrExYears.$touched && NWRF.warrExYears.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                            <div ng-message="required"><small><i class="fa fa-asterisk"></i> Warranty duration is mandatory.</small></div>                                                               
                                            <div ng-message="pattern"><small><i class="fa fa-asterisk"></i> Numeric value expected.</small></div>        
                                        </div>                                         
                                    </div>     
                                    <div class="col-lg-4 form-group">
                                        <label class="control-label">Warranty expiry date</label> 
                                        <input type="text" class="form-control" ng-model="nwrc.Warranty.warrExpDate" name="warrExpDate" readonly>                                    
                                        <div ng-messages="NWRF.custId.$touched && NWRF.custId.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                            <div ng-message="required"><small><i class="fa fa-asterisk"></i> Customer Id is mandatory.</small></div>                                                               
                                        </div>                                         
                                    </div>                       
                            </div>    
                            <div class="row" stnyle="margin: 5px 0px 5px 0px;">
                                <div class=col-lg-12 ng-show="nwrc.alerts.isComplete()">
                                    <div class="alert alert-success" ng-show="nwrc.alerts.isComplete() && !nwrc.alerts.hasError()">
                                        <i class="fa fa-check-circle"></i> {{nwrc.alerts.getMessage()}}
                                    </div>
                                    <div class="alert alert-success" ng-show="nwrc.alerts.isComplete() && nwrc.alerts.hasError()">
                                        <i class="fa fa-exclamation-triangle"></i> {{nwrc.alerts.getMessage()}}
                                    </div>                                
                                </div>
                            </div>                               
                        </form>                                                            
                    </div>
                    <!-- /.panel-body -->
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-8 text-right">
                            <button class="btn btn-primary" ng-show="NWRF.$valid" ng-click="nwrc.newWarrantyRecord();">Save</button>                                                        
                                <button class="btn btn-default" ng-click="nwrc.reset();">Cancel</button>
                            </div>
                        </div>
                    </div><!-- /.panel-footer -->
                </div>

            </div>
            

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->