@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" id='scopeContainer' ng-controller="cureShow">
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
                            @if(Auth::user()->allow_access('master.medical_item.edit'))
                              <a href='{{ route("medical_item.edit", ["id" => $id]) }}' class="btn btn-warning btn-sm" >Edit</a>
                            @endif

                            @if(Auth::user()->allow_access('master.medical_item.destroy'))
                              <button type="button" ng-if='formData.is_active == 1' class="btn btn-danger btn-sm" ng-click='delete({{ $id }})'>Non-aktifkan</button>
                            @endif

                            @if(Auth::user()->allow_access('master.medical_item.activate'))
                              <button type="button" ng-if='formData.is_active == 0' class="btn btn-default btn-sm" ng-click='activate({{ $id }})'>Aktifkan</button>
                              @endif
                        </div>
                    </div>
                </div>
                
          <div class="col-md-12 col-sm-12 col-xs-12">
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                <div class="row">
                    <div class="col-md-6">
                      
                        <div class="form-group">
                          <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Kelompok
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <% formData.group.name %>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <% formData.classification.name %>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Kode
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                    <% formData.unique_code %>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Nama
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <% formData.name %>
                          </div>
                        </div>

                        <div class="form-group"  ng-show='formData.is_category != 1'>
                          <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Satuan jual
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                <% formData.piece.name %>
                          </div>
                        </div>

                        <div class="form-group"  ng-show='formData.is_category != 1'>
                          <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Satuan beli
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                                <% formData.purchase_piece.name %>
                          </div>
                        </div>


                        <div class="form-group"  ng-show='formData.is_category != 1'>
                          <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Grup nota
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <% formData.price.grup_nota.name %>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Keterangan
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <% formData.description %>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12">Harga beli
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <% formData.purchase_price | number %>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12">Harga jual
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <% formData.rate | number %>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12">Margin
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <% formData.additional.margin %>%
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12">HNA
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <% (formData.additional.hna || 0) | number %>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12">HNA + PPN
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <% ((formData.additional.hna || 0) * 110 / 100) | number %>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12">Principal
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <% formData.principal_name %>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12">Harga Eceran Tertinggi
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <% formData.additional.harga_eceran_tertinggi | number %>
                            </div>
                        </div>
                    </div>
                </div>
              <div class="ln_solid"></div>

              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="btn-group">

                    <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                    
                  </div>
                </div>
              </div>

            </form>
          </div>

          <div class="clearfix"></div>
        </div>
                
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
<script src="{{ asset('') }}js/master/cure/cureShowCtrl.js"></script>

