@include('header')

<!-- /top navigation -->

<!-- page content -->
<div class="right_col" role="main" ng-controller="registrationShow">
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
                            @if(Auth::user()->allow_access('registration.edit'))
                                <a ng-if='formData.status == 1' href='{{ route("registration.edit", ["id" => $id]) }}' class="btn btn-warning btn-sm" >Edit</a>
                            @endif
                            <button type="button" ng-if='formData.is_active == 1' class="btn btn-danger btn-sm" ng-click='delete({{ $id }})'>Non-aktifkan</button>
                            <button type="button" ng-if='formData.is_active == 0' class="btn btn-default btn-sm" ng-click='activate({{ $id }})'>Aktifkan</button>
                        </div>
                        <a href='#' class="btn btn-outline-dark btn-sm pull-right" ng-show='formData.id'>
                              <i class="fa fa-barcode"></i> <% formData.code %>
                          </a>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                       <div class="row">
                        <div class="col-md-6">

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.date | fullDate %>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Pasien
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.patient.name %>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Status registrasi
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.status_name %>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal registrasi
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.date | fullDate %>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12">Jenis pasien
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">

                                    <% formData.patient_type %>


                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12">Jenis kelamin
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">

                                    <% formData.patient.gender %>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Alamat
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <% formData.patient.address %>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="first-name">Kota
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <% formData.patient.city.name %>, <% formData.patient.city.province.name %>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12">Tanggal lahir
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <% formData.patient.birth_date | fullDate %>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12">Umur
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <% formData.patient.age %>

                                </div>
                            </div>


                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12">No. telepon yang bisa dihubungi 
                                </label>
                                <div class="col-md-10 col-xs-12">
                                    <% formData.patient.phone %>

                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <h2>Penanggung jawab</h2>
                            <span ng-show='formData.patient_type == "ASURANSI SWASTA"'>

                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Nama instansi / asuransi
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.pic.name %>



                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">ID Kartu / No. Polis
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.insurance_code %>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Atas nama
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.insurance_owner_name %>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Plafon hutang
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.plafon %>

                                    </div>
                                </div>
                            </span>
                            <span ng-show='formData.patient_type == "UMUM"'>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Jenis
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.family_type %>







                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Nama orang tua/suami/istri
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.patient.family.name %>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Alamat
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.patient.family.address %>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Pekerjaan
                                    </label>
                                    <div class="col-md-10 col-xs-12">
                                        <% formData.patient.family.job %>












                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <h2>Jadwal</h2>
                    

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered" id='registration_detail_datatable'>
                                <thead>
                                    <tr>
                                        <td>Tujuan</td>
                                        <td>Waktu</td>
                                        <td>Dokter</td>
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
<script src="{{ asset('') }}js/registration/registration/registrationShowCtrl.js"></script>

