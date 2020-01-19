@include('header')
 
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" ng-controller="doctor">
          <!-- top tiles -->
          <nav style='margin-bottom:2mm'>
            
             <ul class="nav nav-pills">
                <li class="active"><a href="{{ route('doctor.index') }}">Dokter</a></li>
                <li><a href="{{ route('nurse.index') }}">Medis</a></li>
                <li><a href="{{ route('nurse_helper.index') }}">Penunjang medis</a></li>
              </ul> 
          </nav>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">
                <div class="row x_title" ng-show='!isFilter'>
                    <form action="" class='form-horizontal form-label-left'>
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Status
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <label class="radio-inline">
                              <input type="radio" ng-model="formData.is_active" name='is_active' ng-value='null' ng-change="filter()">
                              <h5>Semua</h5>
                            </label>
                            <label class="radio-inline">
                              <input type="radio" ng-model="formData.is_active" name='is_active' ng-value='"1"' ng-change="filter()">
                              <h5>Aktif</h5>
                            </label>
                            <label class="radio-inline">
                              <input type="radio" ng-model="formData.is_active" name='is_active' ng-value='"0"' ng-change="filter()">
                              <h5>
                              Tidak aktif  
                              </h5>
                            </label>
                            </div>


                          </div>

              <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Spesialisasi
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <select class="form-control" data-placeholder-text-single="'Pilih Spesialisasi'" required='required' chosen allow-single-deselect="false" ng-model="formData.specialization_id" ng-options="c.id as c.name for c in data.specialization" ng-change="filter()">
                      <option value=""></option>
                  </select>
                </div>
              </div>


              <div class="form-group">
                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Poliklinik
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                  <select class="form-control" data-placeholder-text-single="'Pilih Poliklinik'" required='required' chosen allow-single-deselect="false" ng-model="formData.polyclinic_id" ng-options="c.id as c.name for c in data.polyclinic" ng-change="filter()">
                      <option value=""></option>
                  </select>

                  <div class="form-group">
                      <button type='button' class='btn btn-warning btn-sm' ng-click='formData={};filter()'>Reset</button>
                  </div>
                </div>
              </div>

                        
                    </form>
                </div>
                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Dokter</h3>
                  </div>
                  <div class="col-md-6">
                      <div class="btn-group pull-right export_button">
                          <button type='button' ng-click='isFilter = !isFilter' class='btn btn-primary btn-sm'>Filter</button>
                          @if(Auth::user()->allow_access('master.medical_worker.create'))
                              <a href="{{ route('doctor.create') }}" class='btn btn-success btn-sm'>Tambah</a>
                          @endif
                      </div>                    
                  </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                  <table class="table table-bordered" id='listview'>
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nama</th>
                          <th>Telepon</th>
                          <th>Spesialisasi</th>
                          <th>Poli</th>
                          <th>Kota</th>
                          <th>Status</th>
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

        </div>
        <!-- /page content -->

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
    @include('footer')
    <script src="{{ asset('') }}js/master/doctor/doctorCtrl.js"></script>

