@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="adjustmentStockShow">
    <!-- top tiles -->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-6">
                        <h3><% title %></h3>
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

                        </div>

                    </div>
                    <div class="ln_solid"></div>
                    <h2>Detail Barang</h2>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id='adjustment_stock_detail_datatable'>
                                <thead>
                                    <tr>
                                        <tr>
                                        <td>Barang</td>
                                        <td>Stok sistem</td>
                                        <td>Stok asli</td>
                                        <td>Lokasi</td>
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
<script src="{{ asset('') }}js/pharmacy/adjustment_stock/adjustmentStockShowCtrl.js"></script>

