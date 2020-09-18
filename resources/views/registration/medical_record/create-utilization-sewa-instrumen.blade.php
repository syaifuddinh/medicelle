@include('registration/medical_record/create-header')
@include('registration/medical_record/create-utilization-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Daftar Sewa Instrumen</h2>
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('sewa_instrumen') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-4">
                                            <label>Tanggal</label>
                                            <input type="text" class='form-control' ng-model="sewa_instrumen.date"  datepick>
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label>Sewa Instrumen</label>
                                            <div class="input-group" ng-click='showSewaInstrumen()'>
                                                <input type="text" class="form-control" ng-model='sewa_instrumen.name' readonly>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-search"></i>
                                                </div>
                                            </div>
                                            <p ng-show='sewa_instrumen.item_id'></p>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Qty</label>
                                            <div class="input-group">
                                                <input type="text" class='form-control' ng-model="sewa_instrumen.qty" jnumber2 only-num>
                                                <div class="input-group-addon">
                                                    <% sewa_instrumen.piece ? sewa_instrumen.piece.name : 'Item' %>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-1" style='margin-top:1.2mm;margin-right:2mm'>
                                            <br>
                                            <button type='button' class='btn btn-success' ng-click='storeDetail(sewa_instrumen)' ng-disabled='!sewa_instrumen.item_id || !sewa_instrumen.qty || disBtn'><i class="fa fa-check"></i></button>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='sewa_instrumen_datatable'>
                                            <thead>
                                                <tr>
                                                    <td>Tanggal</td>
                                                    <td>Sewa Instrumen</td>
                                                    <td>Qty</td>
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

<div class="modal fade" id="sewaInstrumenModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
    <div class="modal-dialog" style='width:80%'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">Daftar Sewa Instrumen</h4>
            </div>
            <div class="modal-body">

                <table class="table table-bordered" id='browse_sewa_instrumen_datatable' style='width:100%'>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Instrumen</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@include('registration/medical_record/create-footer')