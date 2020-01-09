@include('registration/medical_record/create-header')
@include('registration/medical_record/create-physique-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Pemeriksaan payudara</h2>
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('breast') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12">
                                        <div style='position:relative;'>
                                            <div style="position:absolute;top:0;left:0;width:100%;height:100%;" ng-show='!is_fill_signature'></div>      
                                            <div class="signature"  ng-show='is_fill_signature' style='width:20mm'></div>
                                            <img src="<% formData.additional.breast_visual %>" ng-show='!is_fill_signature && formData.additional.breast_visual' alt="">
                                            <img src="{{ asset('images/breast.bmp') }}" ng-show='!is_fill_signature && !formData.additional.breast_visual' alt="">
                                        </div>
                                        <div class="form-group" style='padding-bottom:7mm'>
                                            <div class="btn-group">
                                                
                                                <button type='button' class='btn btn-sm btn-danger' ng-click='resetSignature();is_fill_signature = 0' ng-show='is_fill_signature'>Batal</button>
                                                <button type='button' class='btn btn-sm btn-success' ng-click='resetSignature();is_fill_signature = !is_fill_signature' ng-show='!is_fill_signature'>Ubah</button>
                                                <button type='button' class='btn btn-sm btn-primary submitButton' ng-click='storeSignature();' ng-show='is_fill_signature'>Simpan</button>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-4 col-xs-12">Keterangan
                                            </label>
                                            <div class="col-md-12 col-xs-12">
                                                <textarea class="form-control" ng-model='formData.breast_description' ng-change='submitOne("breast_description")'></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        
                        <div class="ln_solid"></div>
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