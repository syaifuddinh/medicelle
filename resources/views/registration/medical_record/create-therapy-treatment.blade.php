@include('registration/medical_record/create-header')
@include('registration/medical_record/create-therapy-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Daftar tindakan</h2>
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('tindakan') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-4">
                                            
                                            <label>Tanggal</label>
                                            <input type="text" class='form-control' ng-model="treatment.date"  datepick>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Kelompok</label>
                                            <select class="form-control" data-placeholder-text-single="'Pilih kelompok'" chosen allow-single-deselect="true" ng-model="treatment.destination" ng-options="c as c for c in data.destination" ng-change='changeTreatment()'>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Tindakan / jenis pemeriksaan</label>
                                            <div>
                                                <div style='display:flex'>
                                                    
                                                    <select class="form-control" data-placeholder-text-single="'Pilih tindakan / jenis pemeriksaan'" chosen allow-single-deselect="false" ng-model="treatment.item_id" ng-options="c.id as c.name group by c.price.destination for c in data.treatment" style='display:inline-block'>
                                                        <option value=""></option>
                                                    </select>
                                                    <div>
                                                        
                                                        <button type='button' class='btn btn-success' style='margin-left:1mm;display:inline-block' ng-click='storeDetail(treatment)' ng-disabled='!treatment.item_id || disBtn'><i class="fa fa-check"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group col-md-3">

                                            <label>Reduksi(%)</label>
                                                <input type="text" class="form-control" ng-model='treatment.reduksi' maxlength='3' only-num>

                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='treatment_datatable'>
                                            <thead>
                                                <tr>
                                                    <td>Tanggal</td>
                                                    <td>Tindakan / jenis pemeriksaan</td>
                                                    <td>Reduksi</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                        </div>
                        
                        <div class="ln_solid"></div>
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