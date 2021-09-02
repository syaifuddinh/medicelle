app.controller('purchaseRequestShow', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Detail Permintaan Pembelian';
    $scope.data = {}
    var path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');

    $compile($('#buttonBar'))($scope);

          
    purchase_request_detail_datatable = $('#purchase_request_detail_datatable').DataTable({
       dom: 'rt',
       paging:false,
       ordering:false,
        columns:[
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].item_name %>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].supplier_name %>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-right',  
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].qty | number %>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-right',  
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].used_qty %>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-right',  
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].stock_qty %>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-right',  
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].purchase_price | number %>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-right',  
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].discount %>%"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-right',  
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].discount_off || 0 %>%"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-right',  
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].subtotal | number %>"
            }
          }
        ],
        createdRow: function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
          $compile($('tfoot'))($scope);
          $(row).find('input').focus()
        }
    });

    var embedUrl = $('#embedUrl').attr('href')
    $('#pdfDocument').attr('src', embedUrl)

  $scope.approve = function(id) {
    is_approve = confirm('Apakah anda yakin transaksi ini disetujui ?');
    if(is_approve)
        $http.put(baseUrl + '/controller/pharmacy/purchase_request/' + id + '/approve').then(function(data) {
            toastr.success("Data berhasil disetujui");
            $scope.show()
        }, function(error) {
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



  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda yakin transaksi ini akan dihapus ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/pharmacy/purchase_request/' + id).then(function(data) {
            toastr.success("Data Berhasil dihapus")
            setTimeout(function() {
                location.href = baseUrl + '/pharmacy/purchase_request'
            }, 800)
        }, function(error) {
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


    $scope.insertItem = function(data = {}) {
        $scope.formData.detail.push(data)
        purchase_request_detail_datatable.row.add({}).draw()
    }

  $scope.show = function() {
      $http.get(baseUrl + '/controller/pharmacy/purchase_request/' + id).then(function(data) {
            purchase_request_detail_datatable.clear().draw()
            $scope.formData = data.data
            var grandtotal = 0
            var detail = data.data.detail
            var unit

            for(x in detail) {
                unit = detail[x]
                detail[x].item_name = unit.item.name
                detail[x].supplier_name = unit.supplier.name
                grandtotal += unit.subtotal
                $scope.insertItem(unit)
                $scope.checkStock(x, unit.item_id)
            }
            $scope.formData.grandtotal = grandtotal

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


    $scope.checkStock = function(index, item_id) {
      var param = {
          'item_id' : item_id,
          date_start : $scope.formData.date_start,
          date_end : $scope.formData.date_end
        }

      $http.get(baseUrl + '/controller/pharmacy/stock_transaction/check?' + $.param(param)).then(function(data) {
            $('#itemModal').modal('hide')
            $rootScope.disBtn=false;
            $scope.formData.detail[index].used_qty = data.data.qty
            $scope.formData.detail[index].stock_qty = data.data.stock_qty
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