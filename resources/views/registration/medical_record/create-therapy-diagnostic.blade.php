<style type="text/css">
    div table tr td.regular {
        padding:0;
    }
    div table tr td.regular table {
        margin:0;
    }
</style>
@include('registration/medical_record/create-header')
@include('registration/medical_record/create-therapy-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <div style='margin-bottom:5mm'>
                            <h2 style='display:inline-block'>Daftar diagnostik</h2>
                            <button style='margin-top:10mm' class="btn btn-sm btn-primary pull-right" type="button" ng-click='printLaboratory()'>Cetak Laporan Laboratorium</button>
                        </div>
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('diagnostik') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-3">
                                            <label>Tanggal</label>
                                            <input type="text" class='form-control' ng-model="diagnostic.date"  datepick>
                                        </div>
                                        <div style='margin-left:2mm' class="form-group col-md-3">
                                            <label>Kelompok</label>
                                            <select class="form-control" data-placeholder-text-single="'Pilih kelompok'" chosen allow-single-deselect="true" ng-model="diagnostic.destination" ng-options="c as c for c in data.destination" ng-change='changeDiagnostic()'>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div style='margin-left:2mm' class="form-group col-md-3">
                                            <label>Tindakan / jenis pemeriksaan</label>
                                            <div style='display:flex'>
                                                <select class="form-control" data-placeholder-text-single="'Pilih tindakan / jenis pemeriksaan'" chosen allow-single-deselect="false" ng-model="diagnostic.item_id" ng-options="c.id as c.name group by c.price.destination for c in data.diagnostic" ng-change='changeDiagnosticDestination()'>
                                                    <option value=""></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div style='margin-left:2mm' class="form-group col-md-3">
                                            <label>
                                                &nbsp;
                                                <span ng-if='diagnostic.destination == "LABORATORIUM"'>
                                                    
                                                    Checklist Laboratorium
                                                </span>
                                            </label>
                                            <div style='display:flex'>
                                                <div class="btn-group">
                                                    <button ng-if='diagnostic.destination == "LABORATORIUM"' type='button' ng-disabled='!diagnostic.item_id' class="btn-sm btn btn-primary" ng-click='editLaboratoryChecklist()'>
                                                        <i class="fa fa-pencil"></i> Isi disini
                                                    </button>
                                                    <button type='button' class='btn btn-success btn-md' style='padding:1.85mm 3mm' ng-click='storeDetail(diagnostic)' ng-disabled='!diagnostic.item_id || disBtn'><i class="fa fa-check"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='diagnostic_datatable'>
                                            <thead>
                                                <tr>
                                                    <td>Tanggal</td>
                                                    <td>Tindakan / jenis pemeriksaan</td>
                                                    <td style='padding:2mm'>Pemeriksaan</td>
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