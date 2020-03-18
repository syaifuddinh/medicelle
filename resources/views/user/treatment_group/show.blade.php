@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="treatmentGroupShow">
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
                          @if(Auth::user()->allow_access('setting.treatment_group.edit'))
                              <a href='{{ route("treatment_group.edit", ["id" => $id]) }}' class="btn btn-warning btn-sm" >Edit</a>
                          @endif

                          @if(Auth::user()->allow_access('setting.treatment_group.destroy'))
                            <button type="button" ng-if='formData.is_active == 1' class="btn btn-danger btn-sm" ng-click='delete({{ $id }})'>Non-aktifkan</button>
                          @endif
                          @if(Auth::user()->allow_access('setting.treatment_group.activate'))
                            <button type="button" ng-if='formData.is_active == 0' class="btn btn-default btn-sm" ng-click='activate({{ $id }})'>Aktifkan</button>
                          @endif
                      </div>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                      
                      <div class="row">
                        
                          <div class="col-md-6 col-sm-12">
                            
                              <div class="form-group">
                                  <label class="col-md-3 col-xs-12" for="first-name">Grup nota
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <% formData.grup_nota.slug %> - <% formData.grup_nota.name %>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-3 col-xs-12" for="first-name">Nama paket tindakan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <% formData.item.name %>
                                  </div>
                              </div>
                             

                              <div class="form-group">
                                  <label class="col-md-3 col-xs-12" for="last-name">Status
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <% formData.is_active == 1 ? "Aktif" : 'Tidak aktif' %>
                                  </div>
                              </div>
                          </div>
                                   
                          <div class="col-md-6 col-sm-12">
                              <div class="form-group">
                                  <label class="col-md-3 col-xs-12" for="first-name">Harga
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <% formData.item.price | number %>
                                  </div>
                              </div>
                             

                              <div class="form-group">
                                  <label class="col-md-3 col-xs-12" for="last-name">Persentase dokter
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <% formData.percentage %>%
                                  </div>
                              </div>
                          </div>
                                              

                      </div>
                      <h2>Detail Tindakan</h2>

                            <div class="row">
                              <div class="col-md-12">
                                  <table class="table" id='treatment_group_detail_datatable'>
                                      <thead>
                                          <tr>
                                              <th>Item</th>
                                              <th>Qty</th>
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
    <script src="{{ asset('') }}js/user/treatment_group/treatmentGroupShowCtrl.js"></script>

