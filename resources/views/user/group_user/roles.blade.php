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
                                        <td style="padding-left:10mm">Perusahaan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.company"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Keuangan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.finance"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="padding-left:10mm">User</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.user"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.user.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.user.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.user.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.user.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.user.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ======================================== -->
                                    
                                    <tr>
                                        <td style="padding-left:10mm">Departemen</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.group_user"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.group_user.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.group_user.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.group_user.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.group_user.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.group_user.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ======================================== -->
                                    
                                    <tr>
                                        <td style="padding-left:10mm">Grup Nota</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.grup_nota"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.grup_nota.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.grup_nota.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.grup_nota.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.grup_nota.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.grup_nota.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
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
                                    <!-- ======================================== -->
                                    <tr>
                                        <td style="padding-left:10mm">Signa</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.signa"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.signa.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.signa.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.signa.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.signa.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.signa.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
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
                                    <!-- ======================================== -->
                                    
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
                                        <td style="padding-left:10mm">Obat </td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.obat"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.obat.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.obat.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.obat.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.obat.activate"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Non-aktifkan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.obat.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
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
                                    <!-- ================================================================ -->
                                    <tr>
                                        <th>Poliklinik</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["polyclinic"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["polyclinic.edit"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["polyclinic.show"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Selesaikan Pemeriksaan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["polyclinic.finish"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ================================================================ -->
                                    <!-- ================================================================ -->
                                    <tr>
                                        <th>Radiologi</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["radiology"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["radiology.edit"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["radiology.show"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Selesaikan Pemeriksaan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["radiology.finish"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ================================================================ -->
                                    <!-- ================================================================ -->
                                    <tr>
                                        <th>Laboratorium</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["laboratory"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["laboratory.edit"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["laboratory.show"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Selesaikan Pemeriksaan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["laboratory.finish"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ================================================================ -->
                                    <!-- ================================================================ -->
                                    <tr>
                                        <th>Kemoterapi</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["chemoterapy"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["chemoterapy.edit"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["chemoterapy.show"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Selesaikan Pemeriksaan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["chemoterapy.finish"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ================================================================ -->
                                    <!-- ================================================================ -->
                                    <tr>
                                        <th>Ruang Tindakan</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["ruang_tindakan"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["ruang_tindakan.edit"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["ruang_tindakan.show"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Selesaikan Pemeriksaan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["ruang_tindakan.finish"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ================================================================ -->
                                    <!-- ================================================================ -->
                                    <tr>
                                        <th>Medical Checkup</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["medical_checkup"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["medical_checkup.edit"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["medical_checkup.show"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Selesaikan Pemeriksaan</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["medical_checkup.finish"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- ================================================================ -->
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
                                    <tr>
                                        <td style="padding-left:10mm">Persetujuan Tindakan Medis</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.persetujuan_tindakan_medis"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.persetujuan_tindakan_medis.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.persetujuan_tindakan_medis.edit"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.persetujuan_tindakan_medis.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Hapus</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["surat.persetujuan_tindakan_medis.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Farmasi</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["pharmacy"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Permintaan Pembelian</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["pharmacy.purchase_request"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["pharmacy.purchase_request.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["pharmacy.purchase_request.update"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Setujui</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["pharmacy.purchase_request.approve"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["pharmacy.purchase_request.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Hapus</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["pharmacy.purchase_request.destroy"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="padding-left:10mm">Order Pembelian</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["pharmacy.purchase_order"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    
                                    <tr>
                                        <td style="padding-left:20mm">Edit</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["pharmacy.purchase_order.update"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["pharmacy.purchase_order.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="padding-left:10mm">Penerimaan Barang</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["pharmacy.receipt"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <!-- =========================================== -->
                                    
                                    <tr>
                                        <td style="padding-left:20mm">Tambah</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["pharmacy.receipt.create"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:20mm">Detail</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["pharmacy.receipt.show"]' ng-true-value='"1"' ng-false-value='"0"' >
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                          
                        </div>
                      </div>