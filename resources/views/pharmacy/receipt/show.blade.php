@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="receiptShow">
    <!-- top tiles -->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group pull-right">
                            
                        </div>
                        <a href='#' class="btn btn-outline-primary btn-sm pull-right" ng-show='formData.id'>
                              <i class="fa fa-barcode"></i> <% formData.purchase_order.code %>
                          </a>
                        <a href='#' class="btn btn-outline-dark btn-sm pull-right" ng-show='formData.id'>
                              <i class="fa fa-barcode"></i> <% formData.code %>
                          </a>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                       <div class="row">
                        <div class="col-md-8">

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.date | fullDate %>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Supplier
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.supplier.name %>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.supplier.address %>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Keterangan
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.description %>
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
                                        <td style='width:12mm'>Qty Diterima</td>
                                        <td style='width:10mm'>Qty PO</td>
                                        <td style='width:10mm'>Qty Sisa PO</td>
                                        <td style='width:40mm'>Tanggal Kadaluarsa</td>
                                        <td style='width:30mm'>Harga Beli</td>
                                        <td style='width:10mm'>Diskon</td>
                                        <td style='width:30mm'>HNA</td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                            <div class="btn-group pull-left">

                                <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Kembali</button>
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
<script src="{{ asset('') }}js/pharmacy/receipt/receiptShowCtrl.js"></script>

