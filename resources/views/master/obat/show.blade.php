@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="obatShow">
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
                            @if(Auth::user()->allow_access('master.obat.edit'))
                              <a href='{{ route("obat.edit", ["id" => $id]) }}' class="btn btn-warning btn-sm" >Edit</a>
                            @endif

                            @if(Auth::user()->allow_access('master.obat.destroy'))
                              <button type="button" ng-if='formData.is_active == 1' class="btn btn-danger btn-sm" ng-click='delete({{ $id }})'>Non-aktifkan</button>
                            @endif

                            @if(Auth::user()->allow_access('master.obat.activate'))
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
                          <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Jenis Administrasi
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <% formData.group.name %>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Kelas
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <% formData.classification.name %>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Sub-Kelas
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <% formData.subclassification.name %>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Generik
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <% formData.generic.name %>
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
                            <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Komposisi
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <% formData.additional.ingredient %>
                            </div>
                        </div>
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
                            <label class="col-md-3 col-sm-3 col-xs-12">Tanggal kadaluarsa
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <% formData.additional.expired_date | fullDate %>%
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
<script src="{{ asset('') }}js/master/obat/obatShowCtrl.js"></script>

