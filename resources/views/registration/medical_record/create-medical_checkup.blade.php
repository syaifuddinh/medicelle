@include('registration/medical_record/create-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Medical Checkup</h2>
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('medical_checkup') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-5">
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Keadaan umum
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <textarea  ng-model='formData.additional.medical_checkup_general_condition' class="form-control col-md-12 col-xs-12" ng-change='submitOne("additional.medical_checkup_general_condition")'></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">TB
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    
                                                    <input type="text" ng-model='formData.additional.medical_checkup_long' class="form-control col-md-12 col-xs-12"  ng-change='submitOne("additional.medical_checkup_long")' only-num>
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
                                                    
                                                    <input type="text" ng-model='formData.additional.medical_checkup_weight' ng-change='submitOne("additional.medical_checkup_weight")' class="form-control col-md-12 col-xs-12" only-num>
                                                    <div class="input-group-addon">
                                                        KG
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Tensi
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                                <div class="input-group">
                                                    
                                                    <input type="text" ng-model='formData.additional.blood_pressure' ng-change='submitOne("additional.blood_pressure")' class="form-control col-md-12 col-xs-12">
                                                    <div class="input-group-addon">
                                                        mmHg
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Index massa tubuh
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <input type="text" ng-model='formData.additional.index_massa_tubuh' ng-change='submitOne("additional.index_massa_tubuh")' class="form-control col-md-12 col-xs-12" only-num>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-7">
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Nadi
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <div class="input-group">
                                                    <input type="text" ng-model='formData.additional.medical_checkup_pulse' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("additional.medical_checkup_pulse")' only-num>
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
                                                    <input type="text" ng-model='formData.additional.medical_checkup_temperature'  ng-change='submitOne("additional.medical_checkup_temperature")' class="form-control col-md-7 col-xs-12" only-num>
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
                                                    <input type="text" ng-model='formData.additional.medical_checkup_breath_frequency' class="form-control col-md-7 col-xs-12"  ng-change='submitOne("additional.medical_checkup_breath_frequency")' only-num>
                                                    <div class="input-group-addon">
                                                        Rpm
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Kepala
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <input type="text" ng-model='formData.additional.medical_checkup_head' class="form-control col-md-12 col-xs-12"  ng-change='submitOne("additional.medical_checkup_head")'>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Mata
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <input type="text" ng-model='formData.additional.medical_checkup_eye' class="form-control col-md-12 col-xs-12"  ng-change='submitOne("additional.medical_checkup_eye")'>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Hidung
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <input type="text" ng-model='formData.additional.medical_checkup_nose' class="form-control col-md-12 col-xs-12"  ng-change='submitOne("additional.medical_checkup_nose")'>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Telinga
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <input type="text" ng-model='formData.additional.medical_checkup_ear' class="form-control col-md-12 col-xs-12"  ng-change='submitOne("additional.medical_checkup_ear")'>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Kardiovaskuler
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <input type="text" ng-model='formData.additional.medical_checkup_kardiovaskuler' class="form-control col-md-12 col-xs-12"  ng-change='submitOne("additional.medical_checkup_kardiovaskuler")'>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Pulmo
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <input type="text" ng-model='formData.additional.medical_checkup_pulmo' class="form-control col-md-12 col-xs-12"  ng-change='submitOne("additional.medical_checkup_pulmo")'>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Abdomen
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <input type="text" ng-model='formData.additional.medical_checkup_abdomen' class="form-control col-md-12 col-xs-12"  ng-change='submitOne("additional.medical_checkup_abdomen")'>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-xs-12">Ekstramitas
                                            </label>
                                            <div class="col-md-8 col-xs-12">
                                                <input type="text" ng-model='formData.additional.medical_checkup_ekstramitas' class="form-control col-md-12 col-xs-12"  ng-change='submitOne("additional.medical_checkup_ekstramitas")'>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">

                                         <div class="form-group">
                                            <label class="col-md-4 col-xs-12">Keterangan
                                            </label>
                                            <div class="col-md-12 col-xs-12">
                                                <textarea class="form-control" ng-model='formData.additional.medical_checkup_pemeriksaan_penunjang' ng-change='submitOne("additional.medical_checkup_pemeriksaan_penunjang")'></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                         <div class="form-group">
                                            <label class="col-md-4 col-xs-12">Kesimpulan
                                            </label>
                                            <div class="col-md-12 col-xs-12">
                                                <textarea class="form-control" ng-model='formData.additional.medical_checkup_kesimpulan' ng-change='submitOne("additional.medical_checkup_kesimpulan")'></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">

                                         <div class="form-group">
                                            <label class="col-md-4 col-xs-12">Saran-saran
                                            </label>
                                            <div class="col-md-12 col-xs-12">
                                                <textarea class="form-control" ng-model='formData.additional.medical_checkup_saran' ng-change='submitOne("additional.medical_checkup_saran")'></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="ln_solid"></div>
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