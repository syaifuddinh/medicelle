@include('registration/medical_record/create-header')
                          
                      </nav>
                        <h2>Daftar Pemeriksaan Laboratorium</h2>
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('laboratorium') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-6">
                                            
                                            <label>Tanggal pemeriksaaan</label>
                                            <input type="text" class='form-control' ng-model="research.date"  datepick>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Jenis pemeriksaan</label>
                                            <input type="text" ng-model='research.name' class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-6">
                                            <label>Tanggal hasil</label>
                                            <input type="text" class='form-control' ng-model="research.result_date"  datepick>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>File</label>
                                            <input type="file" name='file' id='file'>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-6">
                                            <button type='button' class='btn btn-sm btn-success' ng-click='submitResearch("laboratory")' ng-disabled='!research.name || disBtn'><i class="fa fa-check"></i></button> </div>
                                    </div>
                                </div>

                                <div class="row" style='margin-top:4mm'>
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='laboratory_datatable'>
                                            <thead>
                                                <tr>
                                                    <td>Tanggal pemeriksaan</td>
                                                    <td>Jenis pemeriksaan</td>
                                                    <td>Tanggal hasil</td>
                                                    <td>File</td>
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
                    <div class="modal fade" id="newResearchModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
    <div class="modal-dialog" style='width:50%'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">Isi form laboratorium</h4>
            </div>
            <div class="modal-body">
                <form>
                    <ul class="nav nav-tabs">
                          <li class="active"><a data-toggle="tab" href="#hematologi">HEMATOLOGI</a></li>
                          <li><a data-toggle="tab" href="#darah_lengkap">DARAH LENGKAP</a></li>
                          <li><a data-toggle="tab" href="#kimia_klinik">KIMIA KLINIK</a></li>
                          <li><a data-toggle="tab" href="#imuno">IMUNO / SEROLOGI</a></li>
                    </ul>
                    <div class="tab-content">
                          <div id="hematologi" class="tab-pane fade in active">
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Hasil
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.hasil_hematologi" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Satuan
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.satuan_hematologi" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Nilai normal
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.nilai_normal_hematologi" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Keterangan
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.keterangan_hematologi" class="form-control"></textarea>
                                    </div>
                                </div>
                          </div>

                          <div id="darah_lengkap" class="tab-pane fade">
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Hasil
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.hasil_darah_lengkap" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Satuan
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.satuan_darah_lengkap" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Nilai normal
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.nilai_normal_darah_lengkap" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Keterangan
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.keterangan_darah_lengkap" class="form-control"></textarea>
                                    </div>
                                </div>
                          </div>

                          <div id="kimia_klinik" class="tab-pane fade">
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Hasil
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.hasil_kimia_klinik" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Satuan
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.satuan_kimia_klinik" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Nilai normal
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.nilai_normal_kimia_klinik" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Keterangan
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.keterangan_kimia_klinik" class="form-control"></textarea>
                                    </div>
                                </div>
                          </div>

                          <div id="imuno" class="tab-pane fade">
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Hasil
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.hasil_umuno" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Satuan
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.satuan_umuno" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Nilai normal
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.nilai_normal_umuno" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style='padding-bottom:7mm'>
                                    <label class="col-md-12 col-xs-12">Keterangan
                                    </label>
                                    <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                                        <textarea ng-model="new_research.additional.keterangan_umuno" class="form-control"></textarea>
                                    </div>
                                </div>
                          </div>
                    </div>
                    
                    <div class="form-group col-md-12">
                        <button type='button' class="btn btn-sm btn-success" ng-click='submitNewResearch()' ng-disabled='disBtn'>Simpan</button>
                    </div>


                    <div class="ln_solid"></div>
                </form>
            </div>
        </div>
    </div>
</div>
                </div>
@include('registration/medical_record/create-footer')