@include('registration/medical_record/create-header')
@include('registration/medical_record/create-physique-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Pemeriksaan Anak</h2>
                        
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('children') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-7">
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-xs-12">BB lahir
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.prebirth_weight' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("prebirth_weight")' only-num>
                                                    <div class="input-group-addon">
                                                        KG
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-xs-12">PB lahir
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.additional.pb_lahir' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("additional.pb_lahir")' only-num>
                                                    <div class="input-group-addon">
                                                        CM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-xs-12">BB sekarang
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.postbirth_weight'  ng-change='submitOne("postbirth_weight")' class="form-control col-md-7 col-xs-12" only-num>
                                                    <div class="input-group-addon">
                                                        KG
                                                    </div>
                                                </div>
                                            </div>
                                        </div>     
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-xs-12">PB sekarang
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.additional.pb_sekarang' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("additional.pb_sekarang")' only-num>
                                                    <div class="input-group-addon">
                                                        CM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Keadaan umum
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <trix-editor angular-trix  ng-model='formData.additional.children_general_condition' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.children_general_condition")'></trix-editor>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">TB
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.additional.children_long' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("additional.children_long")' only-num>
                                                    <div class="input-group-addon">
                                                        CM
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">BB
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    
                                                    <input type="text" ng-model='formData.additional.children_weight'  ng-change='submitOne("additional.children_weight")' class="form-control col-md-7 col-xs-12" only-num>
                                                    <div class="input-group-addon">
                                                        KG
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Tensi
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.additional.children_blood_pressure' ng-change='submitOne("additional.children_blood_pressure")' class="form-control col-md-7 col-xs-12">
                                                    <div class="input-group-addon">
                                                        MMHG
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Pemeriksaan fisik
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <trix-editor angular-trix class="form-control" ng-model='formData.additional.children_physique'  ng-change='submitOne("additional.children_physique")'></trix-editor>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Nadi
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.additional.children_pulse' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("additional.children_pulse")'>
                                                    <div class="input-group-addon">
                                                        Bpm
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Suhu
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.additional.children_temperature'  ng-change='submitOne("additional.children_temperature")' class="form-control col-md-7 col-xs-12">
                                                    <div class="input-group-addon">
                                                        <sup>o</sup>C
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Frek. nafas
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.additional.children_breath_frequency' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("additional.children_breath_frequency")'>
                                                    <div class="input-group-addon">
                                                        Rpm
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Bacaan EKG
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <trix-editor angular-trix class="form-control" ng-model='formData.additional.children_ekg' ng-change='submitOne("additional.children_ekg")'></trix-editor>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Lingkar Kepala
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <input type='text' class="form-control" ng-model='formData.additional.children_lingkar_kepala' ng-change='submitOne("additional.children_lingkar_kepala")'>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="form-group">
                                            <label class="col-md-4 col-xs-12">Hasil Pemeriksaan Penunjang
                                            </label>
                                            <div class="col-md-12 col-xs-12">
                                                <trix-editor angular-trix class="form-control" ng-model='formData.additional.children_usg' ng-change='submitOne("additional.children_usg")'></trix-editor>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        
                        <div class="ln_solid"></div>

                        <div class="ln_solid"></div>
                                <h2>Assesment</h2>
                                <div class="row">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-3 mg-r2">
                                            
                                            <label>Diagnosa</label>
                                            <input type="text" class='form-control' ng-model="children_diagnose_history.additional.diagnose_name" ng-show='children_diagnose_history.is_other'>
                                        </div>

                                        <div class="form-group col-md-3 mg-r2">
                                            
                                            <label>ICD-10</label>
                                            <select class="form-control" data-placeholder-text-single="'Pilih penyakit'" chosen allow-single-deselect="false" ng-model="children_diagnose_history.item_id" ng-options="c.id as ( c.code ? c.code + ' - ' : '') + c.name for c in data.disease">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-md-6 mg-r2">

                                            <label>Keterangan</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" ng-model='children_diagnose_history.description'>
                                                <div class="input-group-btn">
                                                    <button type='button' class='btn btn-success' ng-click='storeDetail(children_diagnose_history)' ng-disabled='!children_diagnose_history.additional.diagnose_name || disBtn'><i class="fa fa-check"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                   
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='children_diagnose_history_datatable'>
                                            <thead>
                                                <tr>
                                                    <td>Diagnosa</td>
                                                    <td>ICD-10</td>
                                                    <td>Keterangan</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>

                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <!-- <div class="btn-group pull-right">
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm" ng-click='finished = 1'>Simpan</button>
                                </div> -->
                                <div class="btn-group pull-left">
                                    <button class="btn btn-default btn-sm" ng-click="backtohome()" type="button">Batal</button>
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/medical_record/create-footer')