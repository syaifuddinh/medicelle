@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" id='scopeContainer' ng-controller="patient">
    <!-- top tiles -->

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
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tanggal lahir
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="input-daterange input-group" style="width:100%;">
                                <input type="text" class="input-sm form-control" ng-model="formData.birth_date" ng-change='filter()' dateonlypick/>
                              </div>
                              <div class="form-group">
                                  <button type='button' class='btn btn-warning btn-sm' ng-click='formData={};filter()'>Reset</button>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row x_title">
                    <div class="col-md-6">
                        <h3>Pasien</h3>
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group pull-right export_button">
                            <button type='button' ng-click='isFilter = !isFilter' class='btn btn-primary btn-sm'>Filter</button>
                            @if(Auth::user()->allow_access('master.patient.create'))
                                <a href="{{ route('patient.create') }}" class='btn btn-success btn-sm'>Tambah</a>
                            @endif
                            <button ng-show='params.length > 0' type='button' ng-click='exportCard()' class='btn btn-primary btn-sm'>Export Kartu Pasien</button>
                        </div>                    
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table class="table table-bordered" id='listview'>
                        <thead>
                            <tr>
                                <th></th>
                                <th>No KTP/SIM</th>
                                <th>Nama</th>
                                <th>Telepon</th>
                                <th>Tanggal lahir</th>
                                <th>Umur</th>
                                <th>Jenis kelamin</th>
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
<script src="{{ asset('') }}js/master/patient/patientCtrl.js"></script>

