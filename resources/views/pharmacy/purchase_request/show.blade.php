@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="purchaseRequestShow">
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
                            @if(Auth::user()->allow_access('pharmacy.purchase_request.update'))
                                <a ng-if='formData.is_approve == 0' href='{{ route("pharmacy.purchase_request.edit", ["id" => $id]) }}' class="btn btn-warning btn-sm" >Edit</a>
                            @endif

                            @if(Auth::user()->allow_access('pharmacy.purchase_request.destroy'))
                            <button type="button" ng-if='formData.is_approve == 0' class="btn btn-danger btn-sm" ng-click='delete({{ $id }})'>Hapus</button>
                            @endif
                            @if(Auth::user()->allow_access('pharmacy.purchase_request.approve'))
                            <button type="button" ng-if='formData.is_approve == 0' class="btn btn-default btn-sm" ng-click='approve({{ $id }})'>Setujui</button>
                            @endif
                        </div>
                        <a href='#' class="btn btn-outline-success btn-sm pull-right" ng-show='formData.is_approve == 0'>
                              <i class="fa fa-paperclip"></i> Draft
                          </a>
                        <a href='#' class="btn btn-outline-primary btn-sm pull-right" ng-show='formData.is_approve == 1'>
                              <i class="fa fa-check"></i> Disetujui
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
                            <table class="table table-bordered" id='purchase_request_detail_datatable'>
                                <thead>
                                    <tr>
                                        <td>Barang</td>
                                        <td>Supplier</td>
                                        <td style='width:12mm'>Jumlah Permintaan</td>
                                        <td style='width:10mm'>Jumlah Terpakai</td>
                                        <td style='width:40mm'>Harga Beli</td>
                                        <td style='width:10mm'>Diskon</td>
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
<script src="{{ asset('') }}js/pharmacy/purchase_request/purchaseRequestShowCtrl.js"></script>

