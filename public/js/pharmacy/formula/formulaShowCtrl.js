app.controller('formulaShow', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Detail Resep Obat';
    $scope.data = {}
    $scope.registration = {}
    var path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');

    formula_detail_datatable = $('#formula_detail_datatable').DataTable({
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
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].lokasi_name %>"
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
            className:'text-right',
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].qty %>"
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
                return "<% formData.detail[" + index + "].piece_name %>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-right',
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].price | number %>"
            }
          },
          
        ],
        createdRow: function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
        }
    });

    $scope.print = function() {
        var url = baseUrl + '/controller/pharmacy/formula/' + $scope.formData.id + '/pdf'
        window.open(url)
    }

    $scope.showRegistration = function() {
        $rootScope.disBtn = true
        $http.get(baseUrl + '/controller/registration/registration/' + $scope.formData.registration_detail.registration_id).then(function(data) {
          $rootScope.disBtn = false
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
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }

$scope.approve = function(id) {
    is_approve = confirm('Apakah anda yakin transaksi ini disetujui ?');
    if(is_approve)
        var id = $scope.formData.id
        $http.put(baseUrl + '/controller/pharmacy/formula/' + id + '/approve').then(function(data) {
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
        $http.delete(baseUrl + '/controller/pharmacy/formula/' + id).then(function(data) {
            toastr.success("Data Berhasil dihapus")
            setTimeout(function() {
                location.href = baseUrl + '/pharmacy/formula'
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
        formula_detail_datatable.row.add({}).draw()
    }

  $scope.show = function() {
      $http.get(baseUrl + '/controller/pharmacy/formula/' + id).then(function(data) {
        $scope.formData = data.data
        var detail = data.data.detail
          var unit
          formula_detail_datatable.clear().draw()
          for(x in detail) {
              unit = detail[x]
              detail[x].item_name = unit.item.name
              detail[x].piece_name = unit.item.piece.name
              detail[x].price = unit.item.price
              detail[x].lokasi_name = unit.lokasi.name
              detail[x].used_qty = unit.stock.qty
              detail[x].expired_date = unit.stock.expired_date
              $scope.insertItem(unit)
          }

          $scope.formData.detail = detail
          $scope.showRegistration()
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