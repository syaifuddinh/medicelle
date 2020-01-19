<h2>Hak Akses</h2>
                      <div class="row">
                        <div class="col-md-12" id='roles_container' style='position:relative'>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fitur</th>
                                        <th>
                                            <div class="pull-right btn-group" ng-hide='is_hidden'>
                                                <button class='btn btn-xs btn-dark' type='button' ng-click='uncheckAll()'>
                                                    <i class="fa fa-close"></i>
                                                </button>
                                                <button class='btn btn-xs btn-success' type='button' ng-click='checkAll()'>
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Setting & user</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Tarif</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.price"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.price.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.price.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.price.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.price.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.price.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ======================================== -->
                                    <tr>
                                        <td style="padding-left:10mm">Promo</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.discount"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.discount.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.discount.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.discount.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.discount.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.discount.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ======================================== -->
                                    <tr>
                                        <th>Master</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Pasien</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.patient"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.patient.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.patient.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.patient.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.patient.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.patient.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ======================================== -->
                                    <tr>
                                        <td style="padding-left:10mm">Tenaga medis</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.medical_worker"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.medical_worker.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.medical_worker.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.medical_worker.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.medical_worker.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.medical_worker.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ======================================== -->

                                    <tr>
                                        <td style="padding-left:10mm">Karyawan/Non Medis</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.employee"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.employee.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.employee.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.employee.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.employee.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.employee.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ======================================== -->
<!-- ======================================== -->

                                    <tr>
                                        <td style="padding-left:10mm">Rekanan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.supplier"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.supplier.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.supplier.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.supplier.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.supplier.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.supplier.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ======================================== -->

                                    <tr>
                                        <td style="padding-left:10mm">Item Medis </td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.medical_item"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.medical_item.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.medical_item.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.medical_item.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.medical_item.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.medical_item.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ======================================== -->    

                                    <tr>
                                        <td style="padding-left:10mm">Daftar Lokasi </td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.lokasi"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.lokasi.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.lokasi.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.lokasi.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.lokasi.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="padding-left:10mm">Satuan </td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.piece"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.piece.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.piece.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.piece.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.piece.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ======================================== --> 
                                    <tr>
                                        <td style="padding-left:10mm">Penyakit(ICD-10) </td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.disease"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.disease.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.disease.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.disease.show1"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.disease.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.disease.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ======================================== -->   
                                    <tr>
                                        <td style="padding-left:10mm">Spesialisasi </td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.specialization"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.specialization.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.specialization.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.specialization.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.specialization.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.specialization.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ======================================== -->   <tr>
                                        <td style="padding-left:10mm">Poliklinik </td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.polyclinic"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.polyclinic.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.polyclinic.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.polyclinic.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.polyclinic.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.polyclinic.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ======================================== -->                                
                                    
                                    <!-- ======================================== -->
                                    <tr>
                                        <th>Registrasi pasien</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["registration"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["registration.create"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["registration.edit"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["registration.show"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Persetujuan kehadiran pasien</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["registration.attend"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Batalkan pasien</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["registration.destroy"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Kasir</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["cashier"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["cashier.edit"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["cashier.show"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Poliklinik</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["polyclinic"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th>Layanan</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Cuti Hamil</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.cuti_hamil"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.cuti_hamil.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.cuti_hamil.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.cuti_hamil.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Hapus</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.cuti_hamil.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Keterangan Dokter</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.keterangan_dokter"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.keterangan_dokter.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.keterangan_dokter.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.keterangan_dokter.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Hapus</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.keterangan_dokter.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="padding-left:10mm">Keterangan Sehat</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.keterangan_sehat"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.keterangan_sehat.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.keterangan_sehat.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.keterangan_sehat.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Hapus</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.keterangan_sehat.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="padding-left:10mm">Layak Terbang</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.layak_terbang"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.layak_terbang.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.layak_terbang.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.layak_terbang.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Hapus</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.layak_terbang.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="padding-left:10mm">Pengantar MRS</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.pengantar_mrs"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.pengantar_mrs.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.pengantar_mrs.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.pengantar_mrs.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Hapus</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.pengantar_mrs.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td style="padding-left:10mm">Rujukan Pasien</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.rujukan_pasien"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.rujukan_pasien.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.rujukan_pasien.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.rujukan_pasien.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Hapus</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.rujukan_pasien.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                          
                        </div>
                      </div>