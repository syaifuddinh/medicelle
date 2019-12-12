<h2>Hak Akses</h2>
                      <div class="row">
                        <div class="col-md-12" id='roles_container' style='position:relative'>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Fitur</th>
                                        <th></th>
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
                                    <tr>
                                        <td style="padding-left:10mm">Promo</td>
                                        <td class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["setting.discount"]' ng-true-value='"1"' ng-false-value='"0"'>
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
                                        <th>Kasir</th>
                                        <th class='text-right'>
                                            <label class="radio-inline">
                                                <input type="checkbox" name="_a" ng-model='formData.roles["cashier"]' ng-true-value='"1"' ng-false-value='"0"'>
                                            </label>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                          
                        </div>
                      </div>