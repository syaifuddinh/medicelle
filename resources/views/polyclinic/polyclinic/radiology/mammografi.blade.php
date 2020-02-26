<span id="mammografi" ng-show='pivot.is_referenced == 1 && pivot.is_radiology == 1 && pivot.medical_record_detail.item.price.radiology_group == "MAMMOGRAFI"'>
    <div class="ln_solid"></div>
    <h2 style='margin-left:2mm'>MAMMOGRAFI</h2>
    <div class="row">
        <div class="form-group col-md-6">
            <label class="col-md-12 col-xs-12" for="first-name">CC Kanan
            </label>
            <div class="col-md-10 col-xs-12">
                <textarea ng-model='pivotData.mammografi_cc_kanan' class="form-control" ng-change='submitAdditionalPivot("mammografi_cc_kanan")'></textarea>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-md-12 col-xs-12" for="first-name">MLO Kanan
            </label>
            <div class="col-md-10 col-xs-12">
                <textarea ng-model='pivotData.mammografi_mlo_kanan' class="form-control" ng-change='submitAdditionalPivot("mammografi_mlo_kanan")'></textarea>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-md-12 col-xs-12" for="first-name">Kesimpulan
            </label>
            <div class="col-md-10 col-xs-12">
                <textarea ng-model='pivotData.mammografi_kesimpulan' class="form-control" ng-change='submitAdditionalPivot("mammografi_kesimpulan")'></textarea>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-md-12 col-xs-12" for="first-name">CC Kiri
            </label>
            <div class="col-md-10 col-xs-12">
                <textarea ng-model='pivotData.mammografi_cc_kiri' class="form-control" ng-change='submitAdditionalPivot("mammografi_cc_kiri")'></textarea>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-md-12 col-xs-12" for="first-name">MLO Kiri
            </label>
            <div class="col-md-10 col-xs-12">
                <textarea ng-model='pivotData.mammografi_mlo_kiri' class="form-control" ng-change='submitAdditionalPivot("mammografi_mlo_kiri")'></textarea>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-md-12 col-xs-12" for="first-name">Saran
            </label>
            <div class="col-md-10 col-xs-12">
                <textarea ng-model='pivotData.mammografi_saran' class="form-control" ng-change='submitAdditionalPivot("mammografi_saran")'></textarea>
            </div>
        </div>
    </div>
</span>