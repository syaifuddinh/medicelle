@include('header')

<!-- /top navigation -->

<!-- page content -->
<script>
    asuransi_rate_percentage = {{ Mod::finance()->asuransi_rate_percentage ?? 0 }}
</script>
<div class="right_col" role="main" id='scopeContainer' ng-controller="cashierCreate" ng-cloak>
    <!-- top tiles -->


    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-4">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-8">
                        <span class='pull-right' ng-show='formData.registration_id'>
                            
                            <a href='#' ng-show='formData.status != 1' class='btn btn-sm btn-primary'><i class='fa fa-credit-card'></i> <% formData.status_name %></a>
                            <a href='#' ng-show='formData.status == 1' class='btn btn-sm btn-danger'><i class='fa fa-credit-card'></i> <% formData.status_name %></a>
                            <a href='#' class='btn btn-sm btn-info'><i class='fa fa-user'></i> <% registration.patient.name %></a>
                            <a href='#' class='btn btn-sm btn-success'><i class='fa fa-file-text-o'></i> <% registration.code %></a>
                            <a href='#' class='btn btn-sm btn-dark'><i class='fa fa-medkit'></i> <% registration.medical_record.code %></a>
                        </span>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" ng-submit='submitForm()'>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Tanggal<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <input type="text" class='form-control' ng-model='formData.date' required='required' datepick>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">No. Kuitansi
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">                                        
                                        <input type="text" class='form-control' ng-model='formData.code' readonly>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Keterangan
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">                                        
                                        <textarea class='form-control' ng-model='formData.description'></textarea>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="ln_solid"></div>
                            <h2>
                                Detail pembayaran
                                <button type='button' class='btn btn-sm btn-primary' ng-click='insert()' style='float:right'>
                                    <i class='fa fa-plus'></i>
                                </button>
                            </h2>
                            <div class="col-md-12">
                                <table class='table' id='invoice_detail_datatable'>
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th style='width:10px'>Qty</th>
                                            <th style='width:15%'>Harga</th>
                                            <th style='width:15%'>Reduksi</th>
                                            <th style='width:20mm'>Diskon(%)</th>
                                            <th  style='width:20%'>Subtotal <button type='button' id='asuransi_flag' style='margin-left:2mm' class='btn btn-xs btn-primary' ng-show='formData.payment_type == "ASURANSI SWASTA"'><i class='fa fa-arrow-up'></i> {{ Mod::finance()->asuransi_rate_percentage ?? 0 }}%</button></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th colspan='3' class='text-right'>Total</th>
                                            <th class='text-right' title='Total tagihan yang harus dibayar'><% grosstotal | number%></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th colspan='3' class='text-right'>Diskon(%)</th>
                                            <th class='text-right' title='Diskon untuk seluruh item'>
                                                <input type="text" class='form-control' ng-model='formData.massive_discount' ng-change='countTotal()' maxlength='3' only-num>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th  colspan='3' class='text-right'>Total diskon</th>
                                            <th class='text-right' title='Total tagihan yang harus dibayar'><% discount_total | number%></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th  colspan='3' class='text-right' style='padding-top:4mm'>
                                                <span>Promo</span>
                                                <span ng-show='formData.discount_id'><br><% promo_name %></span>
                                            </th>
                                            <th class='text-right' title='Promo'>
                                                <div class="input-group">
                                                    <input type="text" class='form-control text-right' ng-value='0' ng-model='promo' ng-click='showDiscount()' jnumber2 only-num readonly>
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-pencil" ng-show='!formData.discount_id' ng-click='showDiscount()'></i>
                                                        <i class="fa fa-close"  ng-show='formData.discount_id' ng-click='removeDiscount()'></i>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th  colspan='3' class='text-right'>Total tagihan</th>
                                            <th class='text-right' title='Total tagihan yang harus dibayar'><% grandtotal | number%></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th  colspan='3' class='text-right'>Sisa</th>
                                            <th class='text-right' title='Sisa'>
                                                <%  (grandtotal - formData.paid) | number%>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th class='text-right' colspan='4'>
                                                <label>
                                                    <i class="fa fa-users"></i><span style='font-weight:100'> Penjamin dari pasien ini adalah</span> <% registration.patient_type == 'UMUM' ? registration.patient.family.name : registration.pic.name %>
                                                </label >
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    
                        <div class="row" id='formFooter'>
                            
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Jenis<span class="required">*</span>
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <label class='radio-inline'>
                                            <input type="radio" ng-model='formData.payment_type' name='payment_type' ng-value="'BAYAR SENDIRI'" ng-change='countTotal()'> Bayar sendiri
                                        </label>
                                        <label class='radio-inline'>
                                            <input type="radio" ng-model='formData.payment_type' name='payment_type' ng-value="'ASURANSI SWASTA'" ng-change='countTotal()'> Asuransi swasta
                                        </label>
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-12">
                                <div class="form-group" ng-show='formData.discount_id'>
                                    <label class="col-md-12 col-xs-12">Keterangan promo
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">                                        
                                        <textarea class='form-control' ng-model='formData.promo_description'></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <h2>
                                    Metode pembayaran
                                    <button type='button' class='btn btn-sm btn-primary' ng-click='insertPayment()' style='float:right'>
                                        <i class='fa fa-plus'></i>
                                    </button>
                                </h2>
                                <table class='table' id='cashier_payment_datatable'>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Cara Bayar</th>
                                            <th>Nominal</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <th colspan='2'>Terbayar</th>
                                        <th id='paid'></th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1">
                                <div class="btn-group" id='button-container'>

                                    <a class="btn btn-default btn-sm" href='{{ route("cashier.index") }}'>Batal</a>
                                    <button type="button" id='draftButton' ng-click='submitForm()' ng-disabled='disBtn' class="btn btn-primary btn-sm">Draft</button>
                                    <button type="button"  id='payButton' ng-disabled='grandtotal > formData.paid' ng-click='pay = 1;' ng-disabled='disBtn' class="btn btn-success btn-sm">Bayar</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="discountModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
        <div class="modal-dialog" style='width:80%'>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">Daftar Promo</h4>
                </div>
                <div class="modal-body">

                    <table class="table table-bordered" id='discount_datatable' style='width:100%'>
                        <thead>
                            <tr>
                                <th style='width:10%'></th>
                                <th>Kode</th>
                                <th>Promo</th>
                                <th style='width:10%'>Disc(Rp)</th>
                                <th style='width:5%'>Disc(%)</th>
                                <th>Total potongan</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="priceModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
        <div class="modal-dialog" style='width:80%'>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">Daftar Item</h4>
                </div>
                <div class="modal-body">

                    <table class="table table-bordered" id='price_datatable' style='width:100%'>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Grup Nota</th>
                                <th style='width:10%'>Harga</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /page content -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

@include('footer')
<script src="{{ asset('') }}js/cashier/cashier/cashierCreateCtrl.js"></script>

