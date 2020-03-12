@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="formulaCreate" ng-cloak>
    <!-- top tiles -->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-6">
                        
                        <a href='#' class="btn btn-outline-primary btn-sm pull-right">
                              <i class="fa fa-tag"></i> <% registration.code %>
                        </a>
                        <a href='#' class="btn btn-outline-success btn-sm pull-right">
                              <i class="fa fa-medkit"></i> <% formData.medical_record.code %>
                        </a>
                        
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Tanggal<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" class='form-control' ng-model='formData.date' datepick>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12">Pasien
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="input-group" ng-click='showMedicalRecordModal()'>
                                            <input type="text" class="form-control" ng-model="registration.patient.name" readonly>
                                            <div class="input-group-addon"><i class="fa fa-search"></i></div>
                                        </div>
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
                            <button type="button" class="btn btn-sm btn-primary" ng-click='insertItem()'>
                                <i class="fa fa-plus"></i>
                            </button>
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
                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1">
                            <div class="btn-group">

                                <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button> <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                <button type="button" ng-click='repeat = 1;submitForm()' ng-disabled='disBtn' class="btn btn-primary btn-sm">Simpan dan lanjutkan</button>
                                <button type="button" ng-click='repeat = 0;submitForm()' ng-disabled='disBtn' class="btn btn-success btn-sm">Simpan dan keluar</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

</div>

<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
    <div class="modal-dialog" style='width:80%'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">Daftar Barang</h4>
            </div>
            <div class="modal-body">

                <table class="table table-bordered" id='item_datatable' style='width:100%'>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Kode</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal rekam medis -->
<div class="modal fade" id="medicalRecordModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
        <div class="modal-dialog" style='width:80%'>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">Riwayat rekam medis</h4>
                </div>
                <div class="modal-body">

                    <table class="table table-bordered" id='medical_record_datatable' style='width:100%'>
                        <thead>
                            <tr>
                                <th></th>
                                <th>No. Rekam Medis</th>
                                <th>No. Registrasi</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Dokter</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


<!-- Modal lokasi -->
<div class="modal fade" id="lokasiModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
    <div class="modal-dialog" style='width:80%'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id=""><% lokasiModalTitle %></h4>
            </div>
            <div class="modal-body">

                <table class="table table-bordered" id='lokasi_datatable' style='width:100%'>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary pull-left" ng-click='backwardModal()'>Sebelumnya</button>
            </div>
        </div>
    </div>
</div>

</div>
<!-- /page content -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

@include('footer')
<script src="{{ asset('') }}js/pharmacy/formula/formulaCreateCtrl.js"></script>

