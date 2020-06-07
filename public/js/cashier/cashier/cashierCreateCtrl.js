app.controller('cashierCreate', ['$scope', '$http', '$rootScope','$compile','$filter', function($scope, $http, $rootScope, $compile, $filter) {
// $scope.title = 'Tambah1 Kasir';
$scope.formData = {
    payment_method : 'KREDIT'
}
$scope.promo_detail = {}
$scope.registration = {}
$scope.grandtotal = 0
$scope.grosstotal = 0
$scope.discount_total = 0
$scope.qty_total = 0
$scope.promo = 0
$compile(angular.element($('tfoot')).contents())($scope);
var path = window.location.pathname;

$scope.title = 'Pembayaran';
id = path.replace(/.+\/(\d+)(\/.+)*/, '$1');
$('#asuransi_flag').hide()

invoice_detail_datatable = $('#invoice_detail_datatable').DataTable({
    ordering:false,
    dom : 'rt',
    'columns' : [
    {data : 'name', orderable:false},
    {data : 'qty_binding', className : 'text-right', width:'15mm', orderable:false},
    {data : 'debet_binding', className : 'text-right', orderable:false},
    {data : 'discount', className : 'text-right', orderable:false},
    {
        data : 'total_binding', 
        className : 'text-right', 
        orderable:false,
    },
    ],
    createdRow: function(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
        $compile(angular.element($('#formFooter')).contents())($scope);
    },
})

price_datatable = $('#price_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url : baseUrl+'/datatable/user/price',
    },
    columns:[
      {
        data:null, 
        name:"service.name",
        render:resp => "<a ng-click='updateItem($event.currentTarget)' style='cursor:context-menu'>" + resp.service.name + "</a>"
      },
      {
        data:null, 
        name:"grup_nota.name",
        render:resp => "<b>" + resp.grup_nota.name + "</b>"
      },
      {
        data:null, 
        name:'service.price',
        searchable : false,
        className: 'text-right',
        render : resp => $filter('number')(resp.service.price)
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

discount_datatable = $('#discount_datatable').DataTable({
    dom : 'rt',
    processing: true,
    serverSide: true,
    ajax: {
        url : baseUrl+'/datatable/master/actived_discount',
        data : function(d) {
            d.length = 6

            return d
        }
    },
    columns : [
    {
        data:null, 
        width:'8%',
        searchable:false,
        orderable:false,
        className : 'text-center',
        render:resp => "<button type='button' class='btn btn-xs btn-primary' ng-click='selectDiscount($event.currentTarget)'>Pilih</button>"
    },
    {data : 'code', className : 'text-right', width:'10%', orderable:false},
    {data : 'name', className : 'text-right', orderable:false},
    {
        data : null, 
        className : 'text-right', 
        width:'8%',
        orderable:false,
        render:resp => $filter('number')(resp.disc_value)
    },
    {data : 'disc_percent', className : 'text-right', width:'10%', orderable:false},
    {
        data:null, 
        width:'8%',
        searchable:false,
        orderable:false,
        className : 'text-right',
        render : function(resp) {
            var grosstotal = $scope.grosstotal - $scope.discount_subtotal;
            var disc_value = parseInt(resp.disc_value)
            var percent_disc_value = grosstotal * (parseInt(resp.disc_percent) / 100)
            return $filter('number')(disc_value + percent_disc_value)
        }
    },

    ],
    createdRow: function(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
    }
})

$scope.show = function() {
    $http.get(baseUrl + '/controller/cashier/cashier/' + id).then(function(data) {
        $scope.formData = data.data.invoice
        $scope.formData.invoice_detail = data.data.invoice_detail 
        if($scope.formData.promo != null) {
            $scope.promo = $scope.formData.promo.total_credit 
        }
        if($scope.formData.promo_info != null) {
            var promo_info = $scope.formData.promo_info
            $scope.promo_name = promo_info.code + ' - ' + promo_info.name 
            $scope.promo_detail = $scope.formData.promo_info
        }

        $scope.formData.massive_discount = $scope.formData.discount_total_percentage
        $scope.registration()
        $scope.showInvoiceDetail()
        setTimeout(function () {    
            $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
        }, 300)
        $compile(angular.element($('#formFooter')).contents())($scope);
    }, function(error) {
        $rootScope.disBtn=false;
        if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
                det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
        } else {
            $scope.show()
            toastr.error(error.data.message,"Error Has Found !");
        }
    });
}
$scope.show()

$scope.showDiscount = function() {
    discount_datatable.ajax.reload()
    setTimeout(function(){

        $('#discountModal').modal()
    }, 400)
}

$scope.selectDiscount = function(e) {
    var tr = $(e).parents('tr')
    var resp = discount_datatable.row(tr).data()

    $scope.formData.discount_id = resp.id
    $scope.promo_name = resp.code + ' - ' + resp.name
    $scope.promo_detail = resp
    $scope.countTotal()
    $('#discountModal').modal('hide')
}

$scope.delete = function(id, el) {
    var details = $scope.formData.invoice_detail
    var grup_nota, target, tr;
    for(x in details) {
        grup_nota = details[x]
        target = grup_nota.findIndex(z => z.id == id)
        if(target > -1) {
            $scope.formData.invoice_detail[x].splice(target, 1)
            tr = $(el).parents('tr')
            invoice_detail_datatable.row(tr).remove().draw()
            if($scope.formData.invoice_detail[x].length == 0) {
                tr = $("[grup-nota='" + x + "']").parents('tr')
                delete $scope.formData.invoice_detail[x]
                invoice_detail_datatable.row(tr).remove().draw()
            }
            
            $scope.countTotal()
            break
        }
    }
}

$scope.edit = function(id, el) {
    $scope.is_edit = true
    $scope.currentEdit = {
        'id' : id,
        'el' : el
    }
    $('#priceModal').modal()
}
$scope.insert = function() {
    $scope.is_edit = false
    $('#priceModal').modal()
}

$scope.updateItem = function(el) {
    var tr = $(el).parents('tr')
    var data = price_datatable.row(tr).data()
    var grup_nota = data.grup_nota.name
    var details = $scope.formData.invoice_detail
    var key, target, detail
    
    if($scope.is_edit) {
        for(x in details) {
            key = details[x]
            target = key.findIndex(z => z.id == $scope.currentEdit.id)
            if(target > -1) {
                target = details[x][target]
                detail = {
                    id : target.id,
                    item_id : data.service.id,
                    debet : data.service.price,
                    qty : target.qty,
                    disc_percent : target.disc_percent,
                    item : {
                        name : data.service.name
                    },
                    reduksi_reference : {
                        total_credit : 0,
                        credit : 0
                    }
                }
                $scope.delete($scope.currentEdit.id, $scope.currentEdit.el)
                break
            }
        }
        
    } else {
        detail = {
            id : Math.floor(Math.random() * 1000),
            item_id : data.service.id,
            debet : data.service.price,
            qty : 1,
            item : {
                name : data.service.name
            },
            reduksi_reference : {
                total_credit : 0,
                credit : 0
            }
        }
    }

    console.log(detail)
    if(details[grup_nota]) {
        $scope.formData.invoice_detail[grup_nota].push(detail) 
    } else {
        $scope.formData.invoice_detail[grup_nota] = [
            detail
        ]
    }
    
    invoice_detail_datatable.clear().draw()
    $scope.showInvoiceDetail()
    $scope.is_edit = false
    $('#priceModal').modal('hide')
}

$scope.countPromo = function(resp) {
    var grosstotal = $scope.grosstotal - $scope.discount_subtotal;
    var disc_value = parseInt($scope.promo_detail.disc_value)
    var percent_disc_value = grosstotal * (parseInt($scope.promo_detail.disc_percent) / 100)
    console.log({grosstotal, disc_value, percent_disc_value})
    $scope.promo = disc_value + percent_disc_value
}

$scope.removeDiscount = function(e) {
    $scope.formData.discount_id = null
    $scope.promo_name = null

    $scope.promo = 0
    $scope.countTotal()
    $('#discountModal').modal('hide')
}

$scope.showInvoiceDetail = function() {
    var detail = $scope.formData.invoice_detail
    var item;
    var unit;
    var qty_total = 0, grosstotal = 0
    var grup_nota
    for(grup_nota in detail) {
        $scope.showGrupNota(grup_nota)
        item = detail[grup_nota]
        for(index in item) {
            item[index].debet -= item[index].reduksi_reference.total_credit
            $scope.formData.invoice_detail[grup_nota][index].subtotal = item[index].qty * item[index].debet
            unit = item[index]
            $scope.showItemDetail(unit, grup_nota, index)

        }
    }

    $scope.countTotal()
}

$scope.showGrupNota = function(name) {
    var row = {
        'name' : "<b grup-nota='" + name + "'>" + name + "</b>",
    }
    invoice_detail_datatable.row.add(row).draw()
} 

$scope.showItemDetail = function(detail, grup_nota, index) {
    var row = detail
    row.name = '<div><button class="btn btn-sm btn-danger" style="margin-right:2mm" ng-click="delete(' + row.id + ', $event.currentTarget)"><i class="fa fa-trash"></i></button><a style="cursor:context-menu" ng-click="edit(' + row.id + ', $event.currentTarget)">' + row.item.name + '</a></div>'
    row.total_binding = "<% formData.invoice_detail[\"" + grup_nota + "\"][" + index + "].subtotal | number %>";
    row.qty_binding = "<input type='text' class='form-control' ng-change='countTotal()' ng-model='formData.invoice_detail[\"" + grup_nota + "\"][" + index + "].qty' only-num>";
    row.debet_binding = $filter('number')(row.debet)
    row.discount = "<input class='form-control' ng-change='countTotal()' ng-model='formData.invoice_detail[\"" + grup_nota + "\"][" + index + "].disc_percent' style='width:20mm' maxlength='3' only-num></input>"
    invoice_detail_datatable.row.add(row).draw()
} 

$scope.countTotal = function() {
    var gross, disc_value, netto, unit, grosstotal, discount_total_value;
    var grandtotal = 0, discount_total = 0, qty_total = 0, grosstotal = 0
    var detail = $scope.formData.invoice_detail
    var increase_rate

    if($scope.formData.payment_type == 'ASURANSI SWASTA') {
        $('#asuransi_flag').show()
    } else {
        $('#asuransi_flag').hide()        
    }
    for(grup_nota in detail) {
        for(index in detail[grup_nota]) {
            increase_rate = $scope.formData.payment_type == 'ASURANSI SWASTA' ? asuransi_rate_percentage : 0 
            unit = detail[grup_nota][index]
            gross = unit.qty * unit.debet;
            gross += (gross * (increase_rate/100))
            disc_value = gross * ((unit.disc_percent || 0) / 100) 
            grosstotal += gross
            netto = gross - disc_value
            $scope.formData.invoice_detail[grup_nota][index].subtotal = netto
            grandtotal += parseInt(netto)
            discount_total += parseInt(disc_value)
            $scope.formData.invoice_detail[grup_nota][index].subtotal = gross
        }
    }

    discount_total_value = (parseInt($scope.formData.massive_discount) || 0) / 100 * grandtotal
    $scope.grosstotal = grosstotal
    $scope.discount_subtotal = parseInt(discount_total)
    $scope.countPromo()
    $scope.grandtotal = grandtotal - (parseInt($scope.promo) || 0) - (parseInt(discount_total_value) || 0) 
    $scope.discount_total = parseInt(discount_total) + (parseInt(discount_total_value) || 0)
}

$scope.registration = function() {
    $http.get(baseUrl + '/controller/registration/registration/' + $scope.formData.registration_id).then(function(data) {
        $scope.registration = data.data
    }, function(error) {
        $rootScope.disBtn=false;
        if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
                det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
        } else {
            $scope.registration()
            toastr.error(error.data.message,"Error Has Found !");
        }
    });
}

$('#payButton').click(function(){
    $scope.pay = 1
    $scope.submitForm()
});
$('#draftButton').click(function(){
    $scope.submitForm()
});

$scope.submitForm=function() {
    $rootScope.disBtn=true;
    var url = $scope.pay == 1 ? baseUrl + '/controller/cashier/cashier/pay/' + id : baseUrl + '/controller/cashier/cashier/' + id;
    $scope.formData.pay = $scope.pay || '0' 
    var is_amandemen = /amandemen/.test(path)
    if(is_amandemen) {
        url = baseUrl + '/controller/cashier/cashier/' + id + '/amandemen'
    }
    var method = 'put';
    $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        if(roles['allow_show_cashier'] == 1) {
            setTimeout(function () {
                window.location = baseUrl + '/cashier/' + data.data.invoice_id + '#cetakan'          
            }, 1000)
        }
    }, function(error) {
        $rootScope.disBtn=false;
        if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
                det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
        } else {
            toastr.error(error.data.message,"Error Has Found !");
        }
    });

}
}]);