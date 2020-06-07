@include('header')

<!-- /top navigation -->

<!-- page content -->
<script>
    asuransi_rate_percentage = {{ Mod::finance()->asuransi_rate_percentage ?? 0 }}
</script>
<div class="right_col" role="main" ng-controller="cashierShow" ng-cloak>
    <!-- top tiles -->


    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#detail">Detail</a></li>
                <li><a data-toggle="tab" href="#cetakan">Cetakan</a></li>
            </ul>
            <div class="tab-content">
                <div id="detail" class="tab-pane fade in active">
                    <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="col-md-5">
                        <h3><% title %></h3>
                    </div>
                    <div class="col-md-7">
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
                                <a href='{{ route("cashier.amandemen", ["id" => $id]) }}' ng-show='formData.status == 3' class='pull-right btn btn-sm btn-primary'> Amandemen</a>
                                <div style='margin-left:2mm;margin-bottom:3mm'>
                                    <div ng-if='formData.amandemen_to != null'>
                                        Pembayaran ini telah di-amandemen ke
                                        <a href="{{ route('cashier.show', ['id' => '']) }}/<% formData.amandemen_to.id %>">
                                                <% formData.amandemen_to.code %>
                                        </a>
                                    </div>
                                    <div ng-if='formData.amandemen_by != null'>
                                        Pembayaran ini di-amandemen dari
                                        <a href="{{ route('cashier.show', ['id' => '']) }}/<% formData.amandemen_by.id %>">
                                                <% formData.amandemen_by.code %>
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class=" col-md-2 col-sm-2 col-xs-12" for="first-name">Tanggal
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                        <% formData.date | fullDate %>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class=" col-md-2 col-sm-2 col-xs-12" for="first-name">No. Nota
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">                                        
                        <% formData.code %>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class=" col-md-2 col-sm-2 col-xs-12" for="first-name">Keterangan
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">                                        
                        <% formData.description %>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="ln_solid"></div>
                            <h2>Detail pembayaran</h2>
                            <div class="col-md-12">
                                <table class='table' id='invoice_detail_datatable'>
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th style='width:10%'>Qty</th>
                                            <th style='width:15%'>Harga</th>
                                            <th style='width:10%'>Diskon(%)</th>
                                            <th  style='width:20%'>Subtotal <button type='button' id='asuransi_flag' style='margin-left:2mm' class='btn btn-xs btn-primary' ng-show='formData.payment_type == "ASURANSI SWASTA"'><i class='fa fa-arrow-up'></i></button></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th colspan='2' class='text-right'>Total</th>
                                            <th class='text-right' title='Total tagihan yang harus dibayar'><% grosstotal | number%></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th colspan='2' class='text-right'>Diskon(%)</th>
                                            <th class='text-right' title='Diskon untuk seluruh item'>
                                                <% formData.massive_discount | number%>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th  colspan='2' class='text-right'>Total diskon</th>
                                            <th class='text-right' title='Total tagihan yang harus dibayar'><% discount_total | number%></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th  colspan='2' class='text-right' style='padding-top:4mm'>
                                                <span>Promo</span>
                                                <span ng-show='formData.discount_id'><br><% promo_name %></span>
                                            </th>
                                            <th class='text-right' title='Promo'>
                                                <% promo | number %>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th  colspan='2' class='text-right'>Total tagihan</th>
                                            <th class='text-right' title='Total tagihan yang harus dibayar'><% grandtotal | number%></th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th  colspan='2' class='text-right' style='padding-top:4mm'>Dibayar</th>
                                            <th class='text-right' title='Nominal yang terbayar'>
                    <% formData.paid | number %>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th  colspan='2' class='text-right'>Sisa</th>
                                            <th class='text-right' title='Sisa'>
                                                <%  (grandtotal - formData.paid) | number%>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th class='text-right' colspan='3'>
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
                                    <label class="col-md-12 col-xs-12" for="first-name">Jenis
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                <% formData.payment_type %>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-12 col-xs-12" for="first-name">Cara bayar
                                    </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                <% formData.payment_method %>






                                        
                                    </div>
                                </div>


                            </div>
                            <div class="col-md-6">
                                <div class="form-group" ng-show='formData.discount_id'>
                                    <label class="col-md-12 col-xs-12">Keterangan promo
                                    </label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">                                        
                            <% formData.promo_description %>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="btn-group" id='buttonBar'>

                                    <button class="btn btn-default btn-sm" id='backButton' type="button">Kembali</button> 
                                    @if(Auth::user()->allow_access('cashier.edit'))
                                        <button class="btn btn-success btn-sm" ng-show='formData.status != 3 && formData.status != 5' id='payButton' type="button">Bayar</button> 
                                    @endif
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="clearfix"></div>
            </div>
                </div>
                <div id="cetakan" class="tab-pane fade">
                    <div class="dashboard_graph">
                        <p>
                            Jika pdf tidak tampil, silahkan klik
                            <a href="{{ route('controller.cashier.pdf', ['id' => $id]) }}" target="_blank">disini</a>
                        </p>
                        <embed id='pdfDocument' style='width:100%;height:28cm' type='application/pdf'>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <div class="modal fade" id="discountModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true" >
        <div class="modal-dialog" style='width:80%'>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="">Daftar Pasien</h4>
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

</div>
<!-- /page content -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

@include('footer')
<script src="{{ asset('') }}js/cashier/cashier/cashierShowCtrl.js"></script>

