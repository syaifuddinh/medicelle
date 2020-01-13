@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="employeeShow">
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
                          
                          @if(Auth::user()->allow_access('master.employee.edit'))
                              <a href='{{ route("employee.edit", ["id" => $id]) }}' class="btn btn-warning btn-sm" >Edit</a>
                          @endif

                          @if(Auth::user()->allow_access('master.employee.destroy'))
                              <button type="button" ng-if='formData.is_active == 1' class="btn btn-danger btn-sm" ng-click='delete({{ $id }})'>Non-aktifkan</button>
                          @endif

                          @if(Auth::user()->allow_access('master.employee.activate'))
                              <button type="button" ng-if='formData.is_active == 0' class="btn btn-default btn-sm" ng-click='activate({{ $id }})'>Aktifkan</button>
                          @endif
                      </div>
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
<div class="row">
             <div class="col-md-6">
              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Kode
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.code %>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Nama
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.name %>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">PIN
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.pin %>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12">Jenis kelamin
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.gender %>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.address %>
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Kota
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <% formData.city.name %>, <% formData.city.province.name %>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12">Tempat lahir
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.birth_place %>
                </div>
              </div>


            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12">Tanggal lahir
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.birth_date | fullDate%>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12">Tanggal masuk
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.start_date | fullDate%>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Dept
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <% formData.group_user.name %>
                </div>
              </div>


              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Status pernikahan
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.marriage_status %>
                </div>
              </div>


              <div class="form-group">
                <label class="col-md-3 col-sm-3 col-xs-12">Diskon(%)
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
<% formData.supplier_disc_percent %>%
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
    <script src="{{ asset('') }}js/master/employee/employeeShowCtrl.js"></script>

