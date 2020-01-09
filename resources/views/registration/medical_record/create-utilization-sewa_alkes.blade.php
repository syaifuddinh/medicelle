@include('registration/medical_record/create-header')
@include('registration/medical_record/create-utilization-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Daftar Sewa Alkes</h2>
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('sewa_alkes') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-4">
                                            <label>Tanggal</label>
                                            <input type="text" class='form-control' ng-model="sewa_alkes.date"  datepick>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Lokasi</label>
                                            <select class="form-control" data-placeholder-text-single="'Pilih lokasi'" chosen allow-single-deselect="false" ng-model="sewa_alkes.lokasi_id" ng-options="c.id as c.name for c in data.lokasi">
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label>Nama</label>
                                            <div class="input-group" ng-click='showSewaAlkes()'>
                                                <input type="text" class="form-control" ng-model='sewa_alkes.name' readonly>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>Qty</label>
                                            <div class="input-group">
                                                <input type="text" class='form-control' ng-model="sewa_alkes.qty" jnumber2 only-num>
                                                <div class="input-group-addon">
                                                    <% sewa_alkes.piece ? sewa_alkes.piece.name : 'Item' %>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-1" style='margin-top:1.2mm;margin-right:2mm'>
                                            <br>
                                            <button type='button' class='btn btn-success' ng-click='submitSewaAlkes()' ng-disabled='!sewa_alkes.item_id || !sewa_alkes.qty || !sewa_alkes.lokasi_id'><i class="fa fa-check"></i></button>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='sewa_alkes_datatable'>
                                            <thead>
                                                <tr>
                                                    <td>Tanggal</td>
                                                    <td>Lokasi</td>
                                                    <td>Nama</td>
                                                    <td>Qty</td>
                                                    <td>Satuan</td>
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

<div class="modal fade" id="sewaAlkesModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
    <div class="modal-dialog" style='width:80%'>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="">Daftar BHP</h4>
            </div>
            <div class="modal-body">

                <table class="table table-bordered" id='browse_sewa_alkes_datatable' style='width:100%'>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nama</th>
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