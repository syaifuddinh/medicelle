@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="formulaShow">
    <!-- top tiles -->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-6">
                        <button type="button" ng-show='formData.is_approve == 0' ng-click='approve()' class="btn btn-primary btn-sm pull-right">
                            Setujui
                        </button>
                       
                        <a href='#' class="btn btn-outline-primary btn-sm pull-right">
                              <i class="fa fa-tag"></i> <% registration.code %>
                        </a>
                        <a href='#' class="btn btn-outline-success btn-sm pull-right">
                              <i class="fa fa-medkit"></i> <% formData.medical_record.code %>
                        </a>
                         <a href='#' class="btn btn-outline-warning btn-sm pull-right" ng-show='formData.is_approve == 0'>
                              <i class="fa fa-bookmark"></i> Draft
                        </a>
                        <a href='#' class="btn btn-outline-dark btn-sm pull-right" ng-show='formData.is_approve == 1'>
                              <i class="fa fa-bookmark"></i> Disetujui
                        </a>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12" style='padding-top:2mm'>
                                            <% formData.date | fullDate %>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Pasien
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12" style='padding-top:2mm'>
                                            <% registration.patient.name %>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal Registrasi
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12" style='padding-top:2mm'>
                                            <% registration.date | fullDate %>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Jenis Pasien
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12 capitalize" style='padding-top:2mm'>
                                            <% registration.patient_type.toLowerCase()  %>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Jenis Kelamin
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12 capitalize" style='padding-top:2mm'>
                                            <% registration.patient.gender.toLowerCase() %>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Alamat
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12 capitalize" style='padding-top:2mm'>
                                            <% registration.patient.address %>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Kota
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12 capitalize" style='padding-top:2mm'>
                                            <% registration.patient.city.name %>, <% registration.patient.city.province.name %>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">No. Telepon
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12 capitalize" style='padding-top:2mm'>
                                            <% registration.patient.phone %>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="ln_solid"></div>
                    <h2>Detail Barang</h2>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id='formula_detail_datatable'>
                                <thead>
                                    <tr>
                                        <td>Barang</td>
                                        <td>Lokasi</td>
                                        <td>Tanggal Kadaluarsa</td>
                                        <td style='width:12mm'>Jumlah Permintaan</td>
                                        <td style='width:10mm'>Stok</td>
                                        <td style='width:17mm'>Satuan</td>
                                        <td style='width:40mm'>Harga Jual</td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="btn-group">

                                <button class="btn btn-primary btn-sm" ng-click="print()" type="button">Cetak</button> 
                                <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button> 
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

</div>

</div>
<!-- /page content -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

@include('footer')
<script src="{{ asset('') }}js/pharmacy/formula/formulaShowCtrl.js"></script>

