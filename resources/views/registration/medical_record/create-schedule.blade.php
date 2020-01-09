@include('registration/medical_record/create-header')
                          
                      </nav>
                        <h2>Jadwal Kontrol</h2>
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('anamnesa') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-6">
                                            
                                            <label>Tanggal jadwal kontrol</label>
                                            <div class="input-group">
                                                <input type="text" class='form-control' ng-model="schedule.date"  datepick>
                                                <div class="input-group-btn">
                                                    <button type='button' class='btn btn-success' ng-click='submitSchedule()' ng-disabled='!schedule.date || disBtn'><i class="fa fa-check"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row" style='margin-top:4mm'>
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='schedule_datatable'>
                                            <thead>
                                                <tr>
                                                    <td>Tanggal pemeriksaan</td>
                                                    <td>No registrasi</td>
                                                    <td>Tujuan</td>
                                                    <td>Jenis pasien</td>
                                                    <td>Dokter</td>
                                                    <td>Spesialisasi</td>
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