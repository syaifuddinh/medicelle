@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="specializationShow">
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
                          
                          <a href='{{ route("specialization.edit", ["id" => $id]) }}' class="btn btn-warning btn-sm" >Edit</a>
                          <button type="button" ng-if='formData.is_active == 1' class="btn btn-danger btn-sm" ng-click='delete({{ $id }})'>Non-aktifkan</button>
                          <button type="button" ng-if='formData.is_active == 0' class="btn btn-default btn-sm" ng-click='activate({{ $id }})'>Aktifkan</button>
                      </div>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>

                      <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12" for="first-name">Kode
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <% formData.code %>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12" for="first-name">Nama
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <% formData.name %>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-2 col-sm-2 col-xs-12" for="first-name">Status
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <% formData.is_active == 1 ? 'Aktif' : 'Tidak Aktif' %>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      @include('master/specialization/medical_record_roles')
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
    <script src="{{ asset('') }}js/master/specialization/specializationShowCtrl.js"></script>

