@include('registration/medical_record/create-header')
@include('registration/medical_record/create-therapy-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Daftar obat</h2>
                        <div id='role_layer' style="position:relative">
                                @if(Specialization::readonly('obat') == 1)
                                    <div style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:1000"></div>
                                @endif
                                <div class="row">
                                    <div class="col-md-12" style='display:flex'>
                                        <div class="form-group col-md-4">
                                            
                                            <label>Tanggal</label>
                                            <input type="text" class='form-control' ng-model="drug.date"  datepick>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Obat</label>
                                            <select class="form-control" data-placeholder-text-single="'Pilih obat'" chosen allow-single-deselect="false" ng-model="drug.item_id" ng-options="c.id as c.name group by c.generic.name  for c in data.drug" ng-change='changeDrugPiece()'>
                                                <option value=""></option>
                                            </select>
                                            <p ng-show='drug.item_id'>Memiliki stok sebanyak <% stock %></p>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Qty</label>
                                            <div class="input-group">
                                                <input type="text" class='form-control' ng-model="drug.qty" maxlength="4" jnumber2 only-num>
                                                <div class="input-group-addon">
                                                    <% !drug.item_id ? 'Item' : piece_name %>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-md-12" style='display:flex'>
                                        
                                        <div class="form-group col-md-4">
                                            <label>Signa 1</label>
                                            <div class="input-group">
                                                <div class="input-group-addon" ng-click='drug.is_new_signa1 = !drug.is_new_signa1'>
                                                    <i class="fa fa-pencil" ng-show='!drug.is_new_signa1'></i>
                                                    <i class="fa fa-close" ng-show='drug.is_new_signa1'></i>
                                                </div>
                                                <span ng-show='!drug.is_new_signa1'>
                                                        <select class="form-control" data-placeholder-text-single="'Pilih signa 1'" chosen allow-single-deselect="false" ng-options="c.id as c.name group by c.group.name  for c in data.signa1" ng-model="drug.signa1">
                                                            <option value=""></option>
                                                        </select>
                                                </span>
                                                <input type="text" class="form-control" ng-model='drug.signa1' ng-show='drug.is_new_signa1'>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label>Signa 2</label>
                                            <div class="input-group">
                                                <div class="input-group-addon" ng-click='drug.is_new_signa2 = !drug.is_new_signa2'>
                                                    <i class="fa fa-pencil" ng-show='!drug.is_new_signa2'></i>
                                                    <i class="fa fa-close" ng-show='drug.is_new_signa2'></i>
                                                </div>
                                                <span ng-show='!drug.is_new_signa2'>
                                                        <select class="form-control" data-placeholder-text-single="'Pilih signa 2'" chosen allow-single-deselect="false" ng-options="c.id as c.name for c in data.signa2" ng-model="drug.signa2">
                                                            <option value=""></option>
                                                        </select>
                                                </span>
                                                <input type="text" class="form-control" ng-model='drug.signa2' ng-show='drug.is_new_signa2'>
                                                <div class="input-group-btn">
                                                    <button type='button' class='btn btn-success' ng-click='storeDetail(drug)' ng-disabled='!drug.item_id || disBtn'><i class="fa fa-check"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered" id='drug_datatable'>
                                            <thead>
                                                <tr>
                                                    <td>Tanggal</td>
                                                    <td>Obat</td>
                                                    <td>Qty</td>
                                                    <td>Satuan</td>
                                                    <td>Signa 1</td>
                                                    <td>Signa 2</td>
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