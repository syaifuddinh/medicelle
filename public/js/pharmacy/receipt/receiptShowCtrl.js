app.controller('receiptShow', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Detail Penerimaan';
    $scope.data = {}
    var path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');


    receipt_detail_datatable = $('#receipt_detail_datatable').DataTable({
       dom: 'rt',
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
                return "<% formData.detail[" + index + "].purchase_order_detail.qty | number %>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-right',  
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].purchase_order_detail.leftover_qty | number %>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].expired_date | fullDate %>"
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
                return "<% formData.detail[" + index + "].subtotal | number %>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-right',  
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].hna | number %>"
            }
          }
        ],
        createdRow: function(row, data, dataIndex) {
          $compile($('tfoot'))($scope);
          $compile($('[ng-click="backward()"]'))($scope);
          $compile(angular.element(row).contents())($scope);
          $(row).find('input').focus()
        }
    });

  var embedUrl = $('#embedUrl').attr('href')
  \$('#pdfDocument').attr('src', embedUrl)

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda yakin transaksi ini akan dihapus ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/pharmacy/receipt/' + id).then(function(data) {
            toastr.success("Data Berhasil dihapus")
            setTimeout(function() {
                location.href = baseUrl + '/pharmacy/receipt'
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
        receipt_detail_datatable.row.add({}).draw()
    }

  $scope.show = function() {
      $http.get(baseUrl + '/controller/pharmacy/receipt/' + id).then(function(data) {
        $scope.formData = data.data
        var detail = data.data.detail
        var unit
        var grandtotal = 0, hna_total = 0

        for(x in detail) {
            unit = detail[x]
            detail[x].item_name = unit.item.name
            grandtotal += unit.subtotal
            hna_total += unit.hna
            $scope.insertItem(unit)
        }
        $scope.formData.grandtotal = grandtotal
        $scope.formData.hna_total = hna_total

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


   

}]);