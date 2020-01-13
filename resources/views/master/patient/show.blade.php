@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="patientShow">
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
                            @if(Auth::user()->allow_access('master.patient.edit'))
                                <a href='{{ route("patient.edit", ["id" => $id]) }}' class="btn btn-warning btn-sm" >Edit</a>
                            @endif

                            @if(Auth::user()->allow_access('master.patient.destroy'))
                                <button type="button" ng-if='formData.is_active == 1' class="btn btn-danger btn-sm" ng-click='delete({{ $id }})'>Non-aktifkan</button>
                            @endif

                            @if(Auth::user()->allow_access('master.patient.activate'))
                                <button type="button" ng-if='formData.is_active == 0' class="btn btn-default btn-sm" ng-click='activate({{ $id }})'>Aktifkan</button>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">

                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Nama
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <div class="col-md-9 col-sm-9 col-xs-12 capitalize">

                                            <% formData.patient_type.toLowerCase() %> <% formData.name %>
                                        </div>    

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Status
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <% formData.is_active == 1 ? 'Aktif' : 'Tidak Aktif' %>
                                    </div>
                                  </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12">Jenis kelamin
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <% formData.gender %>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Telepon
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.phone %>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">No KTP/SIM
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.civil_code %>
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
                                        <% formData.city.name %>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Kecamatan
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.district_id %>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Desa
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.village.name %>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12">Tanggal lahir
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.birth_date %>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-sm-3 col-xs-12">Umur
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.age %>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-7">

                                <div class="form-group">
                                    <label class="col-md-5 col-sm-3 col-xs-12">Golongan darah
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <% formData.blood_type %>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-5 col-sm-3 col-xs-12">Agama
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <% formData.religion %>
                                        









                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-5 col-sm-3 col-xs-12">Status perkawinan
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <% formData.marriage_status %>
                                        





                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-5 col-sm-3 col-xs-12">Pekerjaan
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <% formData.job %>

                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <h2>Data Keluarga</h2>
                                <div class="form-group">

                                    <label class="col-md-5 col-sm-3 col-xs-12" for="first-name">Nama Ayah/Ibu/Suami/Istri
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">

                                            <% formData.family.name %>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-5 col-sm-3 col-xs-12">Alamat
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <% formData.family.address %>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-5 col-sm-3 col-xs-12" for="first-name">Kota
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <% formData.family.city_id %>

                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-5 col-sm-3 col-xs-12" for="first-name">Telepon
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <% formData.family.phone %>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-5 col-sm-3 col-xs-12">Pekerjaan
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <% formData.family.job %>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
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
<script src="{{ asset('') }}js/master/patient/patientShowCtrl.js"></script>

