app.controller('discountOffPaymentCreate', ['$scope', '$http', '$rootScope', '$filter', '$compile', '$timeout', function($scope, $http, $rootScope, $filter, $compile, $timeout) {
    $scope.title = 'Form Pembayaran Diskon Off';
    $scope.data = {}
    $scope.formData = {}
    $scope.dot = '.............................................................................................................'
    $scope.shortDot = '..........'
    $scope.priceSlider = 209
    path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');



    $scope.show = function() {

      $http.get(baseUrl + '/controller/pharmacy/discount_off_payment/' + id).then(function(data) {
          var detail = data.data.detail
          var unit

          for(x in detail) {
              unit = detail[x]
              detail[x].item_name = unit.item.name
              detail[x].supplier_name = unit.supplier.name
              $scope.insertItem(unit)
          }

          $scope.formData = data.data
          $scope.formData.detail = detail

          setTimeout(function () {
              
                $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
                $('[ng-model="formData.date_start"]').val( $filter('fullDate')($scope.formData.date_start))
                $('[ng-model="formData.date_end"]').val( $filter('fullDate')($scope.formData.date_end))

            }, 300)

          for(x in detail) {
              $scope.checkStock(x, detail[x].item_id)
          }
          setTimeout(function () {
                $('#itemModal').modal('hide')
            }, 401)
      }, function(error) {
            $scope.show()
      });
    }
   

    discount_off_payment_detail_datatable = $('#discount_off_payment_detail_datatable').DataTable({
       dom: 'rt',
        columns:[
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-center',
            render :function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<button  class='btn btn-xs btn-danger' ng-click='deleteDetail(" + index + ", $event.currentTarget)' title='Hapus'><i class='fa fa-trash-o'></i></button>"  
            }  
          },
          {
            data:'receipt_detail.purchase_order_detail.purchase_order.purchase_request.code', 
            name:'receipt_detail.purchase_order_detail.purchase_order.purchase_request.code' 
          },
          {
            data:'receipt_detail.item.name', 
            name:'receipt_detail.item.name' 
          },
          {
            data:null, 
            searchable:false,
            className:'text-right',
            name:'discount', 
            render : x => $filter('number')(x.discount)
          },
          {
            data:null, 
            searchable:false,
            className:'text-right',
            name:'total_discount_value', 
            render : x => $filter('number')(x.total_discount_value)
          },
        ],
        createdRow: function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
          $(row).find('input').focus()
        }
    });

    $scope.principal = function() {
        $http.get(baseUrl + '/controller/master/supplier/principal').then(function(data) {
            $scope.data.principal = data.data
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.principal()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.principal()

  discount_off_datatable = $('#discount_off_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url : baseUrl+'/datatable/pharmacy/discount_off',
      data : function(d) {
        d.length = 6
        d.is_paid = 0
        d.contact_id = $scope.formData.contact_id

        return d
      }
    },
    columns:[
    {
      data:null, 
      name:null,
      searchable:false,
      orderable:false,
      className : 'text-center',
      render : resp => "<button ng-disabled='disBtn' type='button' class='btn btn-xs btn-primary' ng-click='selectItem($event.currentTarget)'>Pilih</button>"
    },
    {
        data:'receipt_detail.purchase_order_detail.purchase_order.purchase_request.code', 
        name:'receipt_detail.purchase_order_detail.purchase_order.purchase_request.code' 
    },
    {
        data:'receipt_detail.item.name', 
        name:'receipt_detail.item.name' 
    },
    {
        data:null, 
        searchable:false,
        className:'text-right',
        name:'discount', 
        render : x => $filter('number')(x.discount)
      },
      {
        data:null, 
        searchable:false,
        className:'text-right',
        name:'total_discount_value', 
        render : x => $filter('number')(x.total_discount_value)
      }
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

  supplier_datatable = $('#supplier_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url : baseUrl+'/datatable/master/supplier',
      data : function(d) {
        d.length = 6
        d.is_active = 1
        d.supplier_category = 'supplier'

        return d
      }
    },
    columns:[
    {
      data:null, 
      searchable:false,
      orderable:false,
      className : 'text-center',
      render : resp => "<button type='button' class='btn btn-xs btn-primary' ng-click='selectSupplier($event.currentTarget)'>Pilih</button>"
    },
    {data:"code", name:'code'},
    {data:"name", name:"name"},
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

    $scope.adjustStock = function() {
        if($scope.formData.detail.length > 0) {
            var unit
            var detail = $scope.formData.detail
            for(x in detail) {
                unit = detail[x]
                if(unit.item_id) {
                    $scope.checkStock(x, unit.item_id)
                }
            }
        }
    }

    $scope.backwardModal = function() {
        $('#supplierModal').modal('hide')
        $scope.showItemModal($scope.currentIndex)
    }

    $scope.showDiscountOffModal = function(index) {
        if(!$scope.formData.contact_id) {
            toastr.error('Isi principal terlebih dahulu')
        } else {
            discount_off_datatable.ajax.reload()
            $scope.currentIndex = index
            $('#discountOffModal').modal()
        }
    }


    $scope.showSupplierModal = function(index) {
        $scope.currentIndex = index
        supplier_datatable.ajax.reload()
        $('#supplierModal').modal()
    }

    $scope.selectItem = function(obj) {
        $rootScope.disBtn=true;
        var tr = $(obj).parents('tr')
        var data = discount_off_datatable.row(tr).data()
        discount_off_payment_detail_datatable.row.add(data).draw()
        $rootScope.disBtn=false;
        $('#discountOffModal').modal('hide')
    }

    $scope.checkStock = function(index, item_id) {
      var param = {
          'item_id' : item_id,
          date_start : $scope.formData.date_start,
          date_end : $scope.formData.date_end
        }

      $http.get(baseUrl + '/controller/pharmacy/stock_transaction/check?' + $.param(param)).then(function(data) {
            $rootScope.disBtn=false;
            $scope.formData.detail[index].used_qty = data.data.qty
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

    $scope.selectSupplier = function(obj) {
        var tr = $(obj).parents('tr')
        var data = supplier_datatable.row(tr).data()
        $scope.formData.detail[$scope.currentIndex].supplier_name= data.name
        $scope.formData.detail[$scope.currentIndex].supplier_id= data.id
        $('#supplierModal').modal('hide')
    }

    $scope.reset = function() {
      var now = new Date()
      var id = $scope.formData.id
      var code = $scope.formData.code
      $scope.formData = {
          'id' : id,
          'code' : code,
          detail : []
      }
     
      var currentDate = new Date()
      var date = currentDate.getFullYear() + '-' + ( currentDate.getMonth() + 1 ) + '-' + currentDate.getDate()
      $scope.formData.date = date
      setTimeout(function () {    
            $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
      }, 300)
      discount_off_payment_detail_datatable.clear().draw()
      window.scrollTo(0, 0)
    }
    $scope.reset()
    if(path.indexOf('edit') > -1) {
        $scope.show()
    }

    $scope.insertItem = function(data = {}) {
        $scope.formData.detail.push(data)
        discount_off_payment_detail_datatable.row.add({}).draw()
        $timeout(function () {
            $scope.showItemModal($scope.formData.detail.length - 1)
        }, 400)
    }

    $scope.deleteDetail = function(index, obj) {
        $scope.formData.detail[index] = {}
        var row = $(obj).parents('tr')
        discount_off_payment_detail_datatable.row(row).remove().draw()
    } 


    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      $scope.formData.detail = discount_off_payment_detail_datatable.data().toArray()
      var url = baseUrl + '/controller/pharmacy/discount_off_payment';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/pharmacy/discount_off_payment/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        if($scope.repeat == 1) {
            if(path.indexOf('edit') > -1) {          
                setTimeout(function () {
                  window.location = baseUrl + '/pharmacy/discount_off_payment/create'          
                }, 1000)
            } else {
              
              $scope.reset()
            }
        } else {
            setTimeout(function () {
              window.location = baseUrl + '/pharmacy/discount_off_payment'          
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