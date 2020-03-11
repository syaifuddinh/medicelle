@include('registration/medical_record/create-header')
@include('registration/medical_record/create-physique-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Pemeriksaan fisik</h2>
    
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('umum') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Keadaan umum
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.general_condition' class="form-control col-md-7 col-xs-12" ng-change='submitOne("general_condition")'></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">TB
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    
                                                    <input type="text" ng-model='formData.long' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("long")' only-num>
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
                                                    
                                                    <input type="text" ng-model='formData.weight'  ng-change='submitOne("weight")' class="form-control col-md-7 col-xs-12" only-num>
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
                                                    <input type="text" ng-model='formData.blood_pressure' ng-change='submitOne("blood_pressure")' class="form-control col-md-7 col-xs-12">
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
                                                <textarea class="form-control" ng-model='formData.physique'  ng-change='submitOne("physique")'></textarea>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Nadi
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.pulse' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("pulse")'>
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
                                                    <input type="text" ng-model='formData.temperature'  ng-change='submitOne("temperature")' class="form-control col-md-7 col-xs-12">
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
                                                    <input type="text" ng-model='formData.breath_frequency' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("breath_frequency")'>
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
                                                <textarea class="form-control" ng-model='formData.ekg'></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                         <div class="form-group">
                                            <label class="col-md-4 col-xs-12">Hasil USG
                                            </label>
                                            <div class="col-md-12 col-xs-12">
                                                <textarea class="form-control" ng-model='formData.usg' ng-change='submitOne("usg")'></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <h2>Assesment</h2>
                                <div class="row">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-3 mg-r2">
                                            
                                            <label>Diagnosa</label>
                                            <div class="input-group">
                                                <span ng-show='!diagnose_history.is_other'>
                                                    <select class="form-control" data-placeholder-text-single="'Pilih penyakit'" chosen allow-single-deselect="false" ng-model="diagnose_history.disease_id" ng-options="c.id as ( c.code ? c.code + ' - ' : '') + c.name for c in data.disease">
                                                        <option value=""></option>
                                                    </select>
                                                </span>
                                                <input type="text" class='form-control' ng-model="diagnose_history.disease_id" ng-show='diagnose_history.is_other'>
                                                <span class="input-group-addon" ng-click='diagnose_history.is_other = !diagnose_history.is_other;diagnose_history.disease_id = null'> 
                                                    <i class="fa fa-pencil" ng-show='!diagnose_history.is_other'></i>
                                                    <i class="fa fa-close" ng-show='diagnose_history.is_other'></i>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3 mg-r2">
                                            
                                            <label>ICD-10</label>
                                            <select class="form-control" data-placeholder-text-single="'Pilih penyakit'" chosen allow-single-deselect="false" ng-model="diagnose_history.item_id" ng-options="c.id as ( c.code ? c.code + ' - ' : '') + c.name for c in data.disease">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-md-6 mg-r2">

                                            <label>Keterangan</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" ng-model='diagnose_history.description'>
                                                <div class="input-group-btn">
                                                    <button type='button' class='btn btn-success' ng-click='submitDiagnoseHistory()' ng-disabled='!diagnose_history.disease_id || !diagnose_history.item_id'><i class="fa fa-check"></i></button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='diagnose_history_datatable'>
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
                                
                                <div class="ln_solid"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group pull-right">
                                    <button type="submit" ng-disabled='disBtn' class="btn btn-success btn-sm" ng-click='finished = 1'>Simpan</button>
                                </div>
                                <div class="btn-group pull-left">
                                    <button class="btn btn-default btn-sm" ng-click="backtohome()" type="button">Batal</button>
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/medical_record/create-footer')