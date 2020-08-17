@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" id='scopeContainer' ng-controller="purchaseOrderShow">
    <!-- top tiles -->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#detail">Detail</a></li>
                <li><a data-toggle="tab" href="#cetakan">Cetakan</a></li>
            </ul>
            <div class="tab-content">
                <div id="detail" class="tab-pane fade in active">
                    <div class="dashboard_graph">

                        <div class="row x_title">
                            <div class="col-md-6">
                                <h3><% title %></h3>
                            </div>
                            <div class="col-md-6">
                                <div class="btn-group pull-right">
                                    
                                </div>


                                <a href='<% receipt_url %>' class="btn btn-primary btn-sm pull-right" ng-show='formData.is_receipt_completed == 0'>
                                  Buat penerimaan
                              </a>

                              <a href='#' class="btn btn-outline-primary btn-sm pull-right" ng-show='formData.id'>
                                  <i class="fa fa-barcode"></i> <% formData.purchase_request.code %>
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
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Periode
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.date_start | fullDate %> s/d <% formData.date_end | fullDate %>
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
                                <table class="table table-bordered" id='purchase_order_detail_datatable'>
                                    <thead>
                                        <tr>
                                            <td>Barang</td>
                                            <td style='width:12mm'>Jumlah Permintaan</td>
                                            <td style='width:10mm'>Jumlah Terpakai</td>
                                            <td style='width:40mm'>Harga Beli</td>
                                            <td style='width:10mm'>Diskon</td>
                                            <td style='width:40mm'>Subtotal</td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5" style='text-align:left'>Grandtotal</th>
                                            <th><% formData.grandtotal | number %></th>
                                        </tr>
                                    </tfoot>
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
        <div id="cetakan" class="tab-pane fade">
            <div class="dashboard_graph">
                <p>
                    Jika pdf tidak tampil, silahkan klik
                    <a id='embedUrl' href="{{  route('controller.pharmacy.purchase_order.pdf', ['id' => $id]) }}" target="_blank">disini</a>
                </p>
                <embed id='pdfDocument' style='width:100%;height:28cm' type='application/pdf'>
                </div>
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
<script src="{{ asset('') }}js/pharmacy/purchase_order/purchaseOrderShowCtrl.js"></script>

