@include('registration/assesment/create-header')
                         <ul class="nav nav-pills">
                            <li><a href="{{ route('assesment.edit', ['id' => $id]) }}">Langkah 1</a></li>
                            <li class="active"><a href="#">Langkah 2</a></li>
                            <li><a href="{{ route('assesment.edit.3', ['id' => $id]) }}">Langkah 3</a></li>                            
                            <li><a href="{{ route('assesment.edit.4', ['id' => $id]) }}">Langkah 4</a></li>
                            <li><a href="{{ route('assesment.edit.history', ['id' => $id]) }}">Riwayat</a></li>
                            
                          </ul> 
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Alergi obat & reaksi efek samping</h2>
                        <div class="row">
                            <div class="col-md-12" style='display:flex'>
                                
                                <div class="form-group col-md-5 mg-r2">
                                    
                                    <label>Obat / makanan / lainnya</label>
                                    <div class="input-group">
                                        <input type="text" class='form-control' ng-model='allergy_history.cure' ng-show='!allergy_history.is_unknown'>
                                        <input readonly type="text" class='form-control' value='Tidak diketahui'  ng-show='allergy_history.is_unknown'>
                                        <div class="input-group-addon" ng-click='allergy_history.is_unknown = !allergy_history.is_unknown'>
                                            <i class="fa fa-close" ng-show='!allergy_history.is_unknown'></i>
                                            <i class="fa fa-pencil" ng-show='allergy_history.is_unknown'></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-7 mg-r2">

                                    <label>Reaksi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model='allergy_history.side_effect'>
                                        <div class="input-group-btn">
                                            <button type='button' class='btn btn-success' ng-click='submitAllergyHistory()' ng-disabled='!allergy_history.side_effect'><i class="fa fa-check"></i></button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='allergy_history_datatable'>
                                    <thead>
                                        <tr>
                                            <td>Obat</td>
                                            <td>Reaksi</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="row">
                            
                            <div class="col-md-12" style='display:flex;align-items:center;justify-content:space-between;'>
                                <h2>Skrining resiko jatuh</h2>
                                <div>
                                    
                                    <a class='btn btn-primary pull-right btn-xs'><% risk_level_action %></a>
                                    <a class='btn btn-dark pull-right btn-xs'><% risk_level_status %></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered" id='fallen'>
                                    <thead>
                                        <tr>
                                            <td style='width:30mm'>Kondisi pasien</td>
                                            <td style='width:70mm'>Skala</td>
                                            <td>Nilai</td>
                                            <td>Keterangan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Riwayat jatuh</td>
                                            <td>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.fallen" ng-value='25' ng-change='changeRiskLevel();submitOne("fallen")'>
                                                  <h5>Ya</h5>
                                                </label>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.fallen" ng-value='0' ng-change='changeRiskLevel();submitOne("fallen")'>
                                                      <h5>Tidak</h5>
                                                </label>
                                            </td>
                                            <td class="text-right"><% formData.fallen %></td>
                                            <td><input type="text" class="form-control" ng-model='formData.fallen_description' ng-change='submitOne("fallen_description")'></td>
                                        </tr>
                                        <tr>
                                            <td>Diagnosa sekunder</td>
                                            <td>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.secondary_diagnose" ng-value='15' ng-change='changeRiskLevel();submitOne("secondary_diagnose")'>
                                                  <h5>Ya</h5>
                                                </label>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.secondary_diagnose" ng-value='0' ng-change='changeRiskLevel();submitOne("secondary_diagnose")'>
                                                      <h5>Tidak</h5>
                                                </label>
                                            </td>
                                            <td class="text-right"><% formData.secondary_diagnose %></td>
                                            <td><input type="text" class="form-control" ng-model='formData.secondary_diagnose_description' ng-change='submitOne("secondary_diagnose_description")'></td>
                                        </tr>
                                        <tr>
                                            <td>Alat bantu</td>
                                            <td>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.helper" ng-value='30'>
                                                  <h5>Peralatan khusus</h5>
                                                </label>
                                                <br>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.helper" ng-value='15' ng-change='changeRiskLevel();submitOne("helper")'>
                                                      <h5>Tongkat / walker</h5>
                                                </label>
                                                <br>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.helper" ng-value='0' ng-change='changeRiskLevel();submitOne("helper")'>
                                                      <h5>Kursi roda/tanpa alat bantu</h5>
                                                </label>
                                            </td>
                                            <td class="text-right"><% formData.helper %></td>
                                            <td>
                                                <textarea class="form-control" ng-model='formData.helper_description' ng-change='submitOne("helper_description")'>
                                                </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pasien diinfus</td>
                                            <td>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.infus" ng-value='20' ng-change='changeRiskLevel();submitOne("infus")'>
                                                  <h5>Ya</h5>
                                                </label>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.infus" ng-value='0' ng-change='changeRiskLevel();submitOne("infus")'>
                                                      <h5>Tidak</h5>
                                                </label>
                                            </td>
                                            <td class="text-right"><% formData.infus %></td>
                                            <td><input type="text" class="form-control" ng-model='formData.infus_description' ng-change='submitOne("infus_description")'></td>
                                        </tr>
                                        <tr>
                                            <td>Cara berjalan</td>
                                            <td>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.walking" ng-value='20' ng-change='changeRiskLevel();submitOne("walking")'>
                                                  <h5>Terganggu</h5>
                                                </label>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.walking" ng-value='10' ng-change='changeRiskLevel();submitOne("walking")'>
                                                      <h5>Lemah</h5>
                                                </label>
                                                <label class="radio-inline">
                                                      <input type="radio" ng-model="formData.walking" ng-value='0' ng-change='changeRiskLevel();submitOne("walking")'>
                                                      <h5>Normal</h5>
                                                </label>
                                            </td>
                                            <td class="text-right"><% formData.walking %></td>
                                            <td><input type="text" class="form-control" ng-model='formData.walking_description' ng-change='changeRiskLevel();submitOne("walking_description")'></td>
                                        </tr>
                                        <tr>
                                            <td>Kondisi mental</td>
                                            <td>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.mental" ng-value='15' ng-change='changeRiskLevel();submitOne("mental")'>
                                                  <h5>Keterbatasan daya ingat</h5>
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" ng-model="formData.mental" ng-value='0' ng-change='changeRiskLevel();submitOne("mental")'>
                                                  <h5>Normal</h5>
                                                </label>
                                            </td>
                                            <td class="text-right"><% formData.mental %></td>
                                            <td><input type="text" class="form-control" ng-model='formData.mental_description' ng-change="submitOne('mental_description')"></td>
                                        </tr>
                                        <tfoot>
                                            <tr>
                                                <th colspan='2'>Total</th>
                                                <th class='text-right'><% formData.fallen + formData.secondary_diagnose + formData.helper + formData.infus + formData.walking + formData.mental %></th>
                                            </tr>
                                        </tfoot>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group pull-right">
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm">Selanjutnya</button>
                                </div>
                                <div class="btn-group pull-left">
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm" ng-click='back = 1'>Sebelumnya</button>
                                    <button class="btn btn-default btn-sm" ng-click="backward()" type="button">Batal</button>
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/assesment/create-footer')