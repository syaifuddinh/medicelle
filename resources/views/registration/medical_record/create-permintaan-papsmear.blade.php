@include('registration/medical_record/create-header')
@include('registration/medical_record/create-permintaan-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Pemeriksaan Papsmear</h2>
    
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('umum') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Hari pertama haid terakhir / menopause
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="text" datepick  ng-model='formData.hpht' class="form-control col-md-7 col-xs-12" ng-change='submitOne("hpht")'></input>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Riwayat vaksinasi
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.riwayat_vaksinasi' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.riwayat_vaksinasi")'></textarea>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Riwayat kontrasepsi
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_kontrasepsi' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_kontrasepsi")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Riwayat papsmear(Tanggal & Hasil)
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.obgyn_papsmear' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.obgyn_papsmear")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Keluhan saat ini
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_keluhan' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_keluhan")'></textarea>
                                            </div>
                                        </div>
                                        

                                    </div>
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Tanggal pengambilan papsmear
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input  ng-model='formData.additional.papsmear_date' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_date")' datepick>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Jumlah slide papsmear
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_jumlah_slide' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_jumlah_slide")'></textarea>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Lokasi pengambilan
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_lokasi' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_lokasi")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Gambaran portio cervix / vagina
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_cervix' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_cervix")'></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-md-12 col-sm-12 col-xs-12">Informasi klinis
                                            </label>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea  ng-model='formData.additional.papsmear_description' class="form-control col-md-7 col-xs-12" ng-change='submitOne("additional.papsmear_description")'></textarea>
                                            </div>
                                        </div>
                                        

                                    </div>
                                    
                                </div>

                                <div class="ln_solid"></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="btn-group pull-left">
                                    <button class="btn btn-default btn-sm" ng-click="backtohome()" type="button">Batal</button>
                                    <button class="btn btn-warning btn-sm" type="button" ng-click='reset()'>Reset</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
@include('registration/medical_record/create-footer')