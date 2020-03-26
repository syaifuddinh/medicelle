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
                          @if(Auth::user()->allow_access('setting.price.edit'))
                              <a href='{{ route("price.edit", ["id" => $id]) }}' class="btn btn-warning btn-sm" >Edit</a>
                          @endif

                          @if(Auth::user()->allow_access('setting.price.destroy'))
                            <button type="button" ng-if='formData.is_active == 1' class="btn btn-danger btn-sm" ng-click='delete({{ $id }})'>Non-aktifkan</button>
                          @endif
                          @if(Auth::user()->allow_access('setting.price.activate'))
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
                                  <label class="col-md-3 col-xs-12" for="first-name">Nama tarif
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
<% formData.service.name %>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-3 col-sm-3 col-xs-12" for="last-name">Jenis
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12" style='position: relative'>
                                    
                                    <label class="radio-inline">
                                        <input type="checkbox" ng-model='formData.is_registration' ng-true-value='1' ng-false-value='0'> Administrasi
                                    </label><br>
                                    <label class="radio-inline">
                                        <input type="checkbox" ng-model='formData.is_sewa_ruangan' ng-true-value='1' ng-false-value='0'> Sewa ruangan
                                    </label><br>
                                    <label class="radio-inline">
                                        <input type="checkbox" ng-model='formData.is_sewa_alkes' ng-true-value='1' ng-false-value='0'> Sewa alkes
                                    </label><br>
                                    <label class="radio-inline">
                                        <input type="checkbox" ng-model='formData.is_treatment' ng-true-value='1' ng-false-value='0'> Tindakan
                                    </label><br>
                                    <label class="radio-inline">
                                        <input type="checkbox" ng-model='formData.is_diagnostic' ng-true-value='1' ng-false-value='0'> Diagnostik
                                    </label><br>
                                    <label class="radio-inline">
                                        <input type="checkbox" ng-model='formData.is_chemoterapy' ng-true-value='1' ng-false-value='0'> Kemoterapi
                                    </label>
                                    <div style='position:absolute;width:100%;height:100%;top:0;left:0'></div>
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
                                              

                          <div class="col-md-6 col-sm-6">
                              <div class="form-group" ng-show=' !formData.is_sewa_ruangan && !formData.is_sewa_alkes'>
                                  <label class="col-md-3 col-xs-12" for="last-name">Tujuan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12 capitalize"  style='padding-left:9.6mm'>
                                        <% formData.destination.toLowerCase() %>
                                  </div>
                              </div>
                            
                              <div class="form-group" ng-show='!formData.is_registration && !formData.is_sewa_ruangan && !formData.is_sewa_alkes'>
                                  <label class="col-md-3 col-xs-12" for="last-name">Kelompok Radiologi
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12 capitalize" style='padding-left:9.6mm'>
                                        <% formData.radiology_type.name.toLowerCase() %>
                                  </div>
                              </div>
                            
                              <div class="form-group" ng-show='!formData.is_registration && !formData.is_sewa_ruangan && !formData.is_sewa_alkes'>
                                  <label class="col-md-3 col-xs-12" for="last-name">Kategori Laboratorium
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12 capitalize">
                                        <ol id="laboratory_treatment_list">
                                            
                                        </ol>
                                  </div>
                              </div>
                            
                            
                              <div class="form-group" ng-show='formData.destination == "POLIKLINIK")'>
                                  <label class="col-md-3 col-xs-12" for="last-name">Poliklinik
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12" style='padding-left:9.6mm'>
<% formData.polyclinic.name %>


                                  </div>
                              </div>
                            
                              
                              <div class="form-group">
                                  <label class="col-md-3 col-xs-12" for="last-name">Harga
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12" style='padding-left:9.6mm'>
                                      <% formData.service.price | number %>
                                  </div>
                              </div>
                              
                              <div class="form-group">
                                  <label class="col-md-3 col-xs-12" for="last-name">Satuan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12" style='padding-left:9.6mm'>
                                        <% formData.service.piece.name %>
                                  </div>
                              </div>
                            
                              <div class="form-group">
                                  <label class="col-md-3 col-xs-12" for="last-name">Qty default
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12" style='padding-left:9.6mm'>
                                      <% formData.qty %>
                                  </div>
                              </div>
                            
                              <div class="form-group">
                                  <label class="col-md-3 col-xs-12" for="last-name">Persentasi dokter
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12" style='padding-left:9.6mm'>
                                      <% formData.percentage %>%
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

