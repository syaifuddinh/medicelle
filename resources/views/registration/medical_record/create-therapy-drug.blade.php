@include('registration/medical_record/create-header')
@include('registration/medical_record/create-therapy-header')
                          
                      </nav>
                        <div class="ln_solid"></div>
                        <h2>Daftar obat</h2>
                        <div class="row">
                            <div class="col-md-12" style='display:flex'>
                                <div class="form-group col-md-4 mg-r2">
                                    
                                    <label>Tanggal</label>
                                    <input type="text" class='form-control' ng-model="drug.date"  datepick>
                                </div>
                                <div class="form-group col-md-3 mg-r2">
                                    <label>Obat</label>
                                    <select class="form-control" data-placeholder-text-single="'Pilih obat'" chosen allow-single-deselect="false" ng-model="drug.item_id" ng-options="c.id as c.name group by c.group.name  for c in data.drug" ng-change='changeDrugPiece()'>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Qty</label>
                                    <div class="input-group">
                                        <input type="text" class='form-control' ng-model="drug.qty" maxlength="4" jnumber2 only-num>
                                        <div class="input-group-addon">
                                            <% !drug.item_id ? 'Item' : piece_name %>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Signa1</label>
                                    <select class="form-control" data-placeholder-text-single="'Pilih signa 1'" chosen allow-single-deselect="false" ng-model="drug.signa1">
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="form-group col-md-4">

                                    <label>Reduksi</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" ng-model='drug.reduksi'  maxlength='2' only-num>
                                        <div class="input-group-btn">
                                            <button type='button' class='btn btn-success' ng-click='submitDrug()' ng-disabled='!drug.item_id'>Tambah</button>
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
                                            <td>Reduksi</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
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