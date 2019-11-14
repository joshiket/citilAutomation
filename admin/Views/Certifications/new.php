<?php
?>
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-file-signature"></i> OEM Certifications</h3>
                <h6><a href="#/">Dashboard</a> | <a href="#/Certifications/list">OEM Certifications</a> | New OEM Certification</h6>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-file-signature fa-fw"></i> New OEM Certification
                        <div class="pull-right">
                            
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form name="NCF">
                            <div class="row">
                                <div class="col-lg-4 form-group">
                                    <label class="control-label">Certified Professional</label> 
                                    <input type="text" list = "cProfList" class="form-control" ng-model="ncc.Certification.cprofId" name="cprofId" ng-pattern="/^[1-9]{0,9}$/" required autofocus>                                                                        
                                    <datalist id="cProfList">
                                        <option ng-repeat="cp in ncc.CertifiedProfessionals.data" value="{{cp.cprofId}}"> {{cp.cprofName}}
                                    </datalist>
                                    <div ng-messages="NCF.cprofId.$touched && NCF.cprofId.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                        <div ng-message="required"><small><i class="fa fa-asterisk"></i> Certified Professional is mandatory.</small></div>                                                               
                                        <div ng-message="pattern"><small><i class="fa fa-asterisk"></i> Numeric value Expected.</small></div>                                                               
                                    </div>                                                                                        
                                </div>
                                <div class="col-lg-4 form-group">
                                    <label class="control-label">Certification Provider</label>                                     
                                    <input type="text" list="cProvList" class="form-control" ng-model="ncc.Certification.cprovId" name="cprovId"   required>                                                                           
                                    <datalist id="cProvList">
                                        <option ng-repeat="cp in ncc.CertificationProviders.data" value="{{cp.cprovId}}"> {{cp.cprovName}}
                                    </datalist>  
                                    <div ng-messages="NCF.cprovId.$touched && NCF.cprovId.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                        <div ng-message="required"><small><i class="fa fa-asterisk"></i> Certification Provider is mandatory.</small></div>                                                                                             
                                    </div>                                                                        
                                </div>     
                                <div class="col-lg-4 form-group">
                                    <label class="control-label">Exam</label> 
                                    <input type="text" list = "custList" class="form-control" ng-model="ncc.Certification.certiExam" name="certiExam"  required>                                    
                                    <datalist id="custList">
                                        <option ng-repeat="c in nwrc.Customers.data" value="{{c.custId}}"> {{c.custName}} </option>
                                    </datalist>
                                    <div ng-messages="NCF.custId.$certiExam && NCF.certiExam.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                        <div ng-message="required"><small><i class="fa fa-asterisk"></i> Customer Id is mandatory.</small></div>                                                               
                                        <div ng-message="pattern"><small><i class="fa fa-asterisk"></i> Numeric value expected.</small></div>        
                                    </div>                                      
                                </div>                       
                            </div>
                            <div class="row">
                                <div class="col-lg-4 form-group">
                                    <label class="control-label">Exam description</label> 
                                    <input type="text" class="form-control" ng-model="ncc.Certification.certiExamDesc" name="certiExamDesc" >                                                                        
                                </div>                             
                                <div class="col-lg-4 form-group">
                                        <label class="control-label">Certified on</label>                                         
                                        <div class="input-group">
                                             <input type="text" class="form-control dip" ng-model="ncc.Certification.certiOn" name="certiOn"  required>                                     
                                             <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <div ng-messages="NCF.distInvoiceDate.$touched && NCF.distInvoiceDate.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                            <div ng-message="required"><small><i class="fa fa-asterisk"></i>  Certified on date is mandatory.</small></div>                                                               
                                        </div>                                           
                                </div>
                                <div class="col-lg-4 form-group">
                                        <label class="Control-label">&nbsp;</label><br>
                                        <label class="control-label"><input type="checkbox" ng-model="ncc.Certification.cerytiExpires" name="cerytiExpires"> Expires  </label>                                                                                 
                                                                                                                          
                                        <div ng-messages="NCF.distInvoiceDate.$touched && NCF.distInvoiceDate.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                            <div ng-message="required"><small><i class="fa fa-asterisk"></i> Distributor Invoice date is mandatory.</small></div>                                                               
                                        </div>                                           
                                </div>                                                             
                            </div>
                            <div class="row">
                                <div class="col-lg-4 form-group" ng-show="ncc.Certification.cerytiExpires">
                                        <label class="control-label">Valid Till</label> 
                                        <div class="input-group">
                                             <input type="text" class="form-control dip" ng-model="ncc.Certification.certiValidTill" name="distInvoiceDate"  >                                                                                  
                                             <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <div ng-messages="NCF.distInvoiceDate.$touched && NCF.distInvoiceDate.$error" style="color:maroon; text-transform: uppercase;" role="alert">
                                            <div ng-message="required"><small><i class="fa fa-asterisk"></i> Distributor Invoice date is mandatory.</small></div>                                                               
                                        </div>                                           
                                </div>                             
                            </div>     
                            <div class="row" stnyle="margin: 5px 0px 5px 0px;">
                                <div class=col-lg-12 ng-show="ncc.alerts.isComplete()">
                                    <div class="alert alert-success" ng-show="ncc.alerts.isComplete() && !ncc.alerts.hasError()">
                                        <i class="fa fa-check-circle"></i> {{ncc.alerts.getMessage()}}
                                    </div>
                                    <div class="alert alert-success" ng-show="ncc.alerts.isComplete() && ncc.alerts.hasError()">
                                        <i class="fa fa-exclamation-triangle"></i> {{ncc.alerts.getMessage()}}
                                    </div>                                
                                </div>
                            </div>                             
                        </form>                                                            
                    </div>
                    <!-- /.panel-body -->
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-lg-2 col-lg-offset-10 text-right">
                            <button class="btn btn-primary" ng-show="NCF.$valid" ng-click="ncc.newCertification();">Save</button>                                                        
                                <a href="#/customers/list" class="btn btn-default">Back</a>
                            </div>
                        </div>
                    </div><!-- /.panel-footer -->
                </div>

            </div>
            

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->