app.controller('movementShow', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Detail Perpindahan';
    $scope.data = {}
    var path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');


    movement_detail_datatable = $('#movement_detail_datatable').DataTable({
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
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].lokasi_awal_name %>, stok saat ini sejumlah <% formData.detail[" + index + "].stock_in_source %>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].lokasi_akhir_name %>, stok saat ini sejumlah <% formData.detail[" + index + "].stock_in_destination %>"
            }
          }
        ],
        createdRow: function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
        }
    });


    $scope.insertItem = function(data = {}) {
        $scope.formData.detail.push(data)
        movement_detail_datatable.row.add({}).draw()
    }

  $scope.show = function() {
      $http.get(baseUrl + '/controller/pharmacy/movement/' + id).then(function(data) {
        $scope.formData = data.data
        var detail = data.data.detail
          var unit

          for(x in detail) {
              unit = detail[x]
              detail[x].item_name = unit.item.name
              detail[x].lokasi_awal_name = unit.lokasi_awal.name
              detail[x].lokasi_akhir_name = unit.lokasi_akhir.name
              detail[x].stock_in_source = unit.stock_transaction_source.stock.qty
              detail[x].stock_in_destination = unit.stock_transaction_destination.stock.qty
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