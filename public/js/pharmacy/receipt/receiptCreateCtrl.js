app.controller('receiptCreate', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Form Penerimaan';
    $scope.data = {}
    $scope.formData = {}
    $scope.dot = '.............................................................................................................'
    $scope.shortDot = '..........'
    $scope.priceSlider = 209
    path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');
    purchase_order_id = path.replace(/.+\/(\d+)\/create/, '$1');



    receipt_detail_datatable = $('#receipt_detail_datatable').DataTable({
       dom: 'rt',
        columns:[
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<div style='height:9mm'><% formData.detail[" + index + "].item_name %></div>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<input type='text' class='form-control' ng-model='formData.detail[" + index + "].qty' style='width:20mm' jnumber2 only-num>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return $scope.formData.detail[index].qty_po
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return $scope.formData.detail[index].leftover_qty
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<input type='text' style='width:40mm' class='form-control' ng-model='formData.detail[" + index + "].expired_date' datepick>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<input type='text' style='width:40mm' class='form-control' ng-model='formData.detail[" + index + "].purchase_price' only-num jnumber2>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<input type='text' class='form-control' ng-model='formData.detail[" + index + "].discount' maxlength='3' style='width:12mm' only-num>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<input type='text' class='form-control' ng-model='formData.detail[" + index + "].hna' style='width:40mm' only-num jnumber2>"
            }
          },
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
        ],
        createdRow: function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
        }
    });


    $scope.showPurchaseOrder = function() {

      $http.get(baseUrl + '/controller/pharmacy/purchase_order/' + purchase_order_id).then(function(data) {
          var detail = data.data.detail
          var unit

          for(x in detail) {
              unit = detail[x]
              detail[x].item_name = unit.item.name
              detail[x].qty_po = unit.qty
              detail[x].qty = unit.leftover_qty
              detail[x].purchase_order_detail_id = unit.id
              $scope.insertItem(unit)
          }

          $scope.formData = data.data
          $scope.formData.purchase_order_id = $scope.formData.id
          $scope.purchase_order_code = data.data.code
          $scope.formData.detail = detail

          setTimeout(function () {
              
                $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
                $('[ng-model="formData.date_start"]').val( $filter('fullDate')($scope.formData.date_start))
                $('[ng-model="formData.date_end"]').val( $filter('fullDate')($scope.formData.date_end))
            }, 300)

      }, function(error) {
            $scope.showPurchaseOrder()
      });
    }
    $scope.showPurchaseOrder()


    $scope.showItemModal = function(index) {
        item_datatable.ajax.reload()
        $scope.currentIndex = index
        $('#itemModal').modal()
    }


    $scope.showSupplierModal = function(index) {
        $scope.currentIndex = index
        $('#supplierModal').modal()
    }

    $scope.selectItem = function(obj) {
        $rootScope.disBtn=true;
        var tr = $(obj).parents('tr')
        var data = item_datatable.row(tr).data()
        $scope.formData.detail[$scope.currentIndex].item_name= data.name
        $scope.formData.detail[$scope.currentIndex].item_id= data.id
        

      
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
      receipt_detail_datatable.clear().draw()
      window.scrollTo(0, 0)
    }
    $scope.reset()
    if(path.indexOf('edit') > -1) {
        $scope.show()
    }

    $scope.insertItem = function(data = {}) {
        $scope.formData.detail.push(data)
        receipt_detail_datatable.row.add({}).draw()
    }

    $scope.deleteDetail = function(index, obj) {
        $scope.formData.detail[index] = {}
        var row = $(obj).parents('tr')
        receipt_detail_datatable.row(row).remove().draw()
    } 


    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/pharmacy/receipt';
      $http.post(url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
              window.location = baseUrl + '/pharmacy/receipt'          
            }, 1000)
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