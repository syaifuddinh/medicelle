app.controller('adjustmentStockShow', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Detail Perpindahan';
    $scope.data = {}
    var path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');


    adjustment_stock_detail_datatable = $('#adjustment_stock_detail_datatable').DataTable({
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
                return "<% formData.detail[" + index + "].previous_qty | number %>"
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
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].lokasi_name %>, stok saat ini sejumlah <% formData.detail[" + index + "].stock_at_now %>"
            }
          },
        ],
        createdRow: function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
        }
    });


    $scope.insertItem = function(data = {}) {
        $scope.formData.detail.push(data)
        adjustment_stock_detail_datatable.row.add({}).draw()
    }

  $scope.show = function() {
      $http.get(baseUrl + '/controller/pharmacy/adjustment_stock/' + id).then(function(data) {
        $scope.formData = data.data
        var detail = data.data.detail
          var unit

          for(x in detail) {
              unit = detail[x]
              detail[x].item_name = unit.item.name
              detail[x].lokasi_name = unit.lokasi.name
              detail[x].stock_at_now = unit.stock_transaction.stock.qty
              $scope.insertItem(unit)
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
        $scope.show()
        toastr.error(error.data.message,"Error Has Found !");
      }
    });
  }

  $scope.show()

}]);