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
                                    <tr>
                                        <td style="padding-left:10mm">Tenaga medis</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.medical_worker"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-left:10mm">Karyawan/Non Medis</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["master.employee"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </td>
                                    </tr>
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
                                </tbody>
                            </table>
                          
                        </div>
                      </div>