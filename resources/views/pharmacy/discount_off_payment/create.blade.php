@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" id='scopeContainer' ng-controller="discountOffPaymentCreate" ng-cloak>
    <!-- top tiles -->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-6">
                        <a href='#' class="btn btn-outline-dark btn-sm pull-right" ng-show='formData.id'>
                              <i class="fa fa-barcode"></i> <% formData.code %>
                        </a>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                        <div class="row" style='position: relative;'>
                            <div class="col-md-8">

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tanggal<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" class='form-control' ng-model='formData.date' datepick>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Principal<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <select class="form-control" data-placeholder-text-single="'Pilih principal'" chosen allow-single-deselect="false" ng-model="formData.contact_id" ng-options="c.id as c.name for c in data.principal">
                                                <option value=""></option>
                                            </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Keterangan<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <textarea class='form-control' ng-model='formData.description'></textarea>
                                    </div>
                                </div>
                                <div ng-if='formData.status && formData.status != 1' style='position:absolute;width:100%;height:100%;z-index:1000;top:0;left:0;'></div>
                                <p ng-if='formData.status && formData.status != 1' style='margin-left:11mm'>
                                    <i>* Catatan di header tidak dapat diubah karena permintaan pembelian sudah disetujui</i>
                                </p>
                            </div>
                        </div>
                    <div class="ln_solid"></div>
                    <h2>Detail</h2>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary" ng-click='showDiscountOffModal()'>
                                <i class="fa fa-plus"></i>
                            </button>
                            <table class="table table-bordered table-hover" id='discount_off_payment_detail_datatable'>
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>No PP</th>
                                        <th>Barang</th>
                                        <th style='width:12mm'>Diskon Off (%)</th>
                                        <th style='width:10mm'>Nominal Diskon</th>
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

<div class="modal fade" id="discountOffModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
    <div class="modal-dialog" style='width:80%'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">Daftar Barang</h4>
            </div>
            <div class="modal-body">

                <table class="table table-bordered table-hover" id='discount_off_datatable' style='width:100%'>
                    <thead>
                        <tr>
                            <th></th>
                            <th>No PP</th>
                              <th>Barang</th>
                              <th>Diskon Off (%)</th>
                              <th>Nominal Diskon</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
    <div class="modal-dialog" style='width:80%'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">Daftar Supplier</h4>
            </div>
            <div class="modal-body">

                    <table class="table table-bordered table-hover" id='supplier_datatable' style='width:100%'>
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
<script src="{{ asset('') }}js/pharmacy/discount_off_payment/discountOffPaymentCreateCtrl.js"></script>

