<span id="xray" ng-show='pivot.is_referenced == 1 && pivot.is_radiology == 1 && pivot.medical_record_detail.item.price.radiology_group == "X-RAY"'>
    <div class="ln_solid"></div>
    <h2 style='margin-left:2mm'>X-RAY</h2>
    <div class="row">
        <div class="form-group col-md-6">
            <label class="col-md-12 col-xs-12" for="first-name">Thorax / wrist / manus
            </label>
            <div class="col-md-10 col-xs-12">
                <textarea ng-model='pivotData.xray_thorax' class="form-control" ng-change='submitAdditionalPivot("xray_thorax")'></textarea>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class="col-md-12 col-xs-12" for="first-name">Kesimpulan
            </label>
            <div class="col-md-10 col-xs-12">
                <textarea ng-model='pivotData.xray_kesimpulan' class="form-control" ng-change='submitAdditionalPivot("xray_kesimpulan")'></textarea>
            </div>
        </div>
        
        <div class="form-group col-md-6">
            <label class="col-md-12 col-xs-12" for="first-name">Saran
            </label>
            <div class="col-md-10 col-xs-12">
                <textarea ng-model='pivotData.xray_saran' class="form-control" ng-change='submitAdditionalPivot("xray_saran")'></textarea>
            </div>
        </div>
    </div>
</span>