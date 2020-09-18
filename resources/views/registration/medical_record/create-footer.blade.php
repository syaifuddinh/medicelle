
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="medicalRecordModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
        <div class="modal-dialog" style='width:80%'>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">Riwayat rekam medis</h4>
                </div>
                <div class="modal-body">

                    <table class="table table-bordered" id='medical_record_datatable' style='width:100%'>
                        <thead>
                            <tr>
                                <th></th>
                                <th>No. Rekam Medis</th>
                                <th>Tanggal</th>
                                <th>Keluhan utama</th>
                                <th>Dokter</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Checklist Laboratorium -->
    <div class="modal fade" id="laboratoryChecklistModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
        <div class="modal-dialog" style='width:80%'>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title pull-left">Checklist Laboratorium</h4>
                    <div class='pull-right'>
                        <div class="input-group">
                              <input type="text" ng-model='checklistKeyword' ng-change='searchChecklist()' class="form-control" placeholder="Cari...">
                              <div class="input-group-btn">
                                    <button class='btn btn-md btn-default' disabled style='padding:1.2mm 1.6mm'>
                                        <i class="fa fa-search"></i>
                                    </button>
                              </div>
                            </div>
                    </div>
                </div>
                <div class="modal-body">
                    @include('polyclinic/polyclinic/radiology/laboratory_treatment')
                </div>
                <div class="modal-footer">
                    <button type="button" class='btn btn-primary btn-sm' ng-click='openLaboratoryChecklistPDF()'>Cetak</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ---------------------------- -->

    <!-- Modal Dokter -->
    <div class="modal fade" id="doctorModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
        <div class="modal-dialog" style='width:80%'>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">Dokter rujukan</h4>
                </div>
                <div class="modal-body">

                    <table class="table table-bordered" id='doctor_datatable' style='width:100%'>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Dokter</th>
                                <th>Spesialis</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ------------- -->
</div>
<!-- /page content -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<div class="btn-group" style='position:fixed;bottom: 7mm;right:9mm'>
    
    <button  type='button' class="btn btn-md btn-success" id='printButton' ng-click='openPDF()'>
        <i class='fa fa-file-pdf-o'></i>
    </button>
    <button allow_update_medical_record type="button" id='submitButton' ng-click='submitForm()' ng-disabled='disBtn' class="btn btn-success btn-md">Simpan</button>
    <a href="#menu_toggle" class="anchor-scroll btn btn-md btn-primary" data-class-to="this" data-on-scroll="blur-effect">
        <i class='fa fa-arrow-up'></i>
    </a>
</div>
@include('footer')
<script src="{{asset('js/jSignature.js')}}"></script>
<script src="{{asset('js/jSignature.CompressorBase30.js')}}"></script>
<script src="{{asset('js/jSignature.CompressorSVG.js')}}"></script>
<script src="{{ asset('') }}vendors/Chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('') }}js/registration/medical_record/medicalRecordCreateCtrl.js"></script>

