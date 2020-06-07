app.controller('cashierShow', ['$scope', '$http', '$rootScope','$compile','$filter', function($scope, $http, $rootScope, $compile, $filter) {
    // $scope.title = 'Tambah1 Kasir';
    $('#asuransi_flag').hide()
    $scope.formData = {
      payment_method : 'KREDIT'
    }
    $scope.registration = {}
    $scope.grandtotal = 0
    $scope.grosstotal = 0
    $scope.discount_total = 0
    $scope.qty_total = 0
    $scope.promo = 0
    $compile(angular.element($('tfoot')).contents())($scope);
    var path = window.location.pathname;
    if(window.location.hash == '#cetakan') {
        $('[href="#cetakan"]').trigger('click')
    }   
    $scope.title = 'Pembayaran';
    id = path.replace(/.+\/(\d+)/, '$1');

    $('#pdfDocument').attr('src', baseUrl + '/controller/cashier/cashier/' + id + '/pdf')

    invoice_detail_datatable = $('#invoice_detail_datatable').DataTable({
      ordering:false,
      dom : 'rt',
      'columns' : [
          {data : 'name', orderable:false},
          {data : 'qty', className : 'text-right', width:'10%', orderable:false},
          {data : 'debet_binding', className : 'text-right', orderable:false},
          {data : 'discount', className : 'text-right', orderable:false},
          {data : 'total_binding', className : 'text-right', orderable:false},
      ],
      createdRow: function(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
        $compile($('#buttonBar'))($scope);
      }
    })

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
                var grosstotal = $scope.grosstotal;
                var disc_value = parseInt(resp.disc_value)
                var percent_disc_value = grosstotal * (parseInt(resp.disc_percent) / 100)
                console.log({grosstotal, disc_value, percent_disc_value})
                return $filter('number')(disc_value + percent_disc_value)
            }
          },
          
      ],
      createdRow: function(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
      }
    })

    $('#backButton').click(function() {
        $rootScope.backward()
    })

    $scope.pay = function() {
        var url = baseUrl + '/cashier/pay/' + id
        window.location = url
    }

    $('#payButton').click(function() {
        $scope.pay()
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
            }
            if($scope.formData.status != 3) {
              $('#payButton').show()
            } else {
              $('#payButton').hide()              
            }
            if($scope.formData.massive_discount != null) {
                var massive_discount = $scope.formData.massive_discount.total_credit
                $scope.formData.massive_discount = massive_discount 
            }
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

        var grosstotal = $scope.grosstotal;
        var disc_value = parseInt(resp.disc_value)
        var percent_disc_value = grosstotal * (parseInt(resp.disc_percent) / 100)
        console.log({grosstotal, disc_value, percent_disc_value})
        $scope.promo = disc_value + percent_disc_value
        $scope.countTotal()
        $('#discountModal').modal('hide')
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
        for(grup_nota in detail) {
            $scope.showGrupNota(grup_nota)
            item = detail[grup_nota]
            for(index in item) {
                $scope.formData.invoice_detail[grup_nota][index].subtotal = item[index].qty * item[index].debet
                unit = item[index]
                $scope.showItemDetail(unit, grup_nota, index)

                grosstotal +=  parseInt(unit.qty) * parseInt(unit.debet)
            }
        }

        $scope.grosstotal = grosstotal
        $scope.countTotal()
    }

    $scope.showGrupNota = function(name) {
        var row = {
          'name' : "<b>" + name + "</b>",
        }
        invoice_detail_datatable.row.add(row).draw()
    } 

    $scope.showItemDetail = function(detail, grup_nota, index) {
        var row = detail
        row.name = '<div style="padding-left:8mm">' + row.item.name + '</div>'
        row.total_binding = "<% formData.invoice_detail[\"" + grup_nota + "\"][" + index + "].subtotal | number %>";
        row.debet_binding = $filter('number')(row.debet)
        row.discount = $scope.formData.invoice_detail[grup_nota][ index ].disc_percent
        console.log(row)
        invoice_detail_datatable.row.add(row).draw()
    } 

    
$scope.countTotal = function() {
    var gross, disc_value, netto, unit, grosstotal;
    var grandtotal = 0, discount_total = 0, qty_total = 0, grosstotal = 0
    var detail = $scope.formData.invoice_detail
    var increase_rate

    if($scope.formData.payment_type == 'ASURANSI SWASTA') {
        $('#asuransi_flag').show()
        $('#asuransi_flag').append(' ' + $scope.formData.asuransi_percentage + '%')
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
    $scope.grosstotal = grosstotal
    $scope.grandtotal = grandtotal - (parseInt($scope.promo) || 0) - (parseInt($scope.formData.massive_discount) || 0) 
    $scope.discount_total = parseInt(discount_total) + (parseInt($scope.formData.massive_discount) || 0)
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

}]);