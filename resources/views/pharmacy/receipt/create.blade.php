@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="receiptCreate" ng-cloak>
    <!-- top tiles -->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-6">
                        <a href='#' class="btn btn-outline-primary btn-sm pull-right" ng-show='formData.id'>
                              <i class="fa fa-barcode"></i> <% purchase_order_code %>
                          </a>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                        <div class="row">
                            <div class="col-md-8">

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tanggal<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" class='form-control' ng-model='formData.date' datepick>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Supplier
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12" style='padding-top:2mm'>
                                        <% formData.supplier.name %>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Alamat
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12" style='padding-top:2mm'>
                                        <% formData.supplier.address %>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Keterangan<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <textarea class='form-control' ng-model='formData.description'></textarea>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="ln_solid"></div>
                    <h2>Detail Barang</h2>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id='receipt_detail_datatable'>
                                <thead>
                                    <tr>
                                        <td>Barang</td>
                                        <td style='width:19mm'>Qty Diterima</td>
                                        <td style='width:12mm'>Qty Awal</td>
                                        <td style='width:12mm'>Qty Sisa</td>
                                        <td style='width:40mm'>Tanggal kadaluarsa</td>
                                        <td style='width:40mm'>Harga Beli</td>
                                        <td style='width:10mm'>Diskon</td>
                                        <td style='width:40mm'>HNA</td>
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
                                <button type="button" ng-click='submitForm()' ng-disabled='disBtn' class="btn btn-primary btn-sm">Simpan</button>
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
<script src="{{ asset('') }}js/pharmacy/receipt/receiptCreateCtrl.js"></script>

