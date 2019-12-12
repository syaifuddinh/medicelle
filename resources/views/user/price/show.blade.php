@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="priceShow">
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
                          
                          <a href='{{ route("price.edit", ["id" => $id]) }}' class="btn btn-warning btn-sm" >Edit</a>
                          <button type="button" ng-if='formData.is_active == 1' class="btn btn-danger btn-sm" ng-click='delete({{ $id }})'>Non-aktifkan</button>
                          <button type="button" ng-if='formData.is_active == 0' class="btn btn-default btn-sm" ng-click='activate({{ $id }})'>Aktifkan</button>
                      </div>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                      
                      <div class="row">
                        
                          <div class="col-md-6 col-sm-12">
                            
                              <div class="form-group">
                                  <label class="col-md-5 col-sm-3 col-xs-12" for="first-name">Grup nota
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.grup_nota.slug %> - <% formData.grup_nota.name %>


                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-md-5 col-sm-3 col-xs-12" for="first-name">Nama tarif
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.service.name %>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-5 col-sm-3 col-xs-12" for="last-name">Apakah tarif administrasi
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.is_registration == 1 ? 'Ya' : 'Tidak' %>
                                  </div>
                              </div>
                          </div>
                                              

                          <div class="col-md-6 col-sm-6">
                              <div class="form-group" ng-hide='formData.is_registration == 1'>
                                  <label class="col-md-3 col-sm-3 col-xs-12" for="last-name">Tujuan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12 capitalize">
<% formData.destination.toLowerCase() %>








                                  </div>
                              </div>
                            
                              <div class="form-group" ng-show='formData.destination == "POLIKLINIK" && (formData.is_registration == 0)'>
                                  <label class="col-md-3 col-sm-3 col-xs-12" for="last-name">Poliklinik
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.polyclinic.name %>


                                  </div>
                              </div>
                            
                              <div class="form-group">
                                  <label class="col-md-3 col-sm-3 col-xs-12" for="last-name">Harga
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.service.price | number %>
                                  </div>
                              </div>
                            
                              <div class="form-group">
                                  <label class="col-md-3 col-sm-3 col-xs-12" for="last-name">Qty default
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.qty %>
                                  </div>
                              </div>
                            
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
    <script src="{{ asset('') }}js/user/price/priceShowCtrl.js"></script>

