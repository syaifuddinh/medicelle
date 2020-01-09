@include('registration/medical_record/create-header')
                          
                      </nav>
                        <h2>Daftar Pemeriksaan Radiologi</h2>
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('radiologi') == 1)
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
                                            <button type='button' class='btn btn-sm btn-success submitButton' ng-click='submitResearch("radiology")' ng-disabled='!research.name || disBtn'><i class="fa fa-check"></i></button> </div>
                                    </div>
                                </div>

                                <div class="row" style='margin-top:4mm'>
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='radiology_datatable'>
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
                <h4 class="modal-title" id="">Isi form radiologi</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group" style='padding-bottom:7mm'>
                        <label class="col-md-12 col-xs-12">Kanan
                        </label>
                        <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                            <textarea ng-model="new_research.kanan" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group" style='padding-bottom:7mm'>
                        <label class="col-md-12 col-xs-12">Kiri
                        </label>
                        <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                            <textarea ng-model="new_research.kiri" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group" style='padding-bottom:7mm'>
                        <label class="col-md-12 col-xs-12">Kesimpulan
                        </label>
                        <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                            <textarea ng-model="new_research.kesimpulan" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group" style='padding-bottom:7mm'>
                        <label class="col-md-12 col-xs-12">Saran
                        </label>
                        <div class="col-md-12 col-xs-12" style='padding-bottom:4mm'>
                            <textarea ng-model="new_research.saran" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <button type='button' class="btn btn-sm btn-success" ng-click='submitNewResearch()' ng-disabled='disBtn'>Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                </div>
@include('registration/medical_record/create-footer')