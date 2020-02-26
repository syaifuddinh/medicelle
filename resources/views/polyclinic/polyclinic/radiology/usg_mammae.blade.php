<span id="usg_mammae" ng-show='pivot.is_referenced == 1 && pivot.is_radiology == 1 && pivot.medical_record_detail.item.price.radiology_group == "USG MAMMAE"'>
    <div class="ln_solid"></div>
    <h2 style='margin-left:2mm'>USG MAMMAE</h2>
    <div class="row">
        <div class="form-group col-md-6">
            <label class="col-md-12 col-xs-12" for="first-name">Kanan
            </label>
            <div class="col-md-10 col-xs-12">
                <textarea ng-model='pivotData.usg_mammae_kanan' class="form-control" ng-change='submitAdditionalPivot("usg_mammae_kanan")'></textarea>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-md-12 col-xs-12" for="first-name">Kesimpulan
            </label>
            <div class="col-md-10 col-xs-12">
                <textarea ng-model='pivotData.usg_mammae_kesimpulan' class="form-control" ng-change='submitAdditionalPivot("usg_mammae_kesimpulan")'></textarea>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-md-12 col-xs-12" for="first-name">Kiri
            </label>
            <div class="col-md-10 col-xs-12">
                <textarea ng-model='pivotData.usg_mammae_kiri' class="form-control" ng-change='submitAdditionalPivot("usg_mammae_kiri")'></textarea>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-md-12 col-xs-12" for="first-name">Saran
            </label>
            <div class="col-md-10 col-xs-12">
                <textarea ng-model='pivotData.usg_mammae_saran' class="form-control" ng-change='submitAdditionalPivot("usg_mammae_saran")'></textarea>
            </div>
        </div>
    </div>
</span>