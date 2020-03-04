@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="receipt">
          <!-- top tiles -->
          

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                
                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Penerimaan</h3>
                  </div>
                  <div class="col-md-6">
                      <div class="btn-group pull-right export_button">
                          
                          <button type='button' ng-click='showPurchaseOrder()'class='btn btn-success btn-sm'>Tambah</button>
                      </div>                    
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered" id='listview'>
                      <thead>
                        <tr>
                          <th style='width:14%'>No. Penerimaan</th>
                          <th style='width:14%'>No. Order</th>
                          <th style='width:14%'>Supplier</th>
                          <th style='width:14%'>Tanggal</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                </div>

                <div class="clearfix"></div>
              </div>
            </div>

          </div>


<div class="modal fade" id="purchaseOrderModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
    <div class="modal-dialog" style='width:80%'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">Daftar Purchase Order</h4>
            </div>
            <div class="modal-body">

                <table class="table table-bordered" id='purchase_order_datatable' style='width:100%'>
                    <thead>
                        <tr>
                            <th></th>
                            <th>No. Order</th>
                            <th>No. PP</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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
    <script src="{{ asset('') }}js/pharmacy/receipt/receiptCtrl.js"></script>

