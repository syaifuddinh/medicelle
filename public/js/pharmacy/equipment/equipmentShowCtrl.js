app.controller('equipmentShow', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Detail Penggunaan Barang';
    $scope.data = {}
    var path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');


          
    equipment_detail_datatable = $('#equipment_detail_datatable').DataTable({
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
                return "<% formData.detail[" + index + "].lokasi_name %>"
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
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].status_name %>"
            }
          },
          {
            data:null,
            className:'text-center',
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                if(!$scope.formData.detail[index].is_approve) {
                    return "<button ng-click='approve(" + $scope.formData.detail[index].id + ")' class='btn btn-sm btn-primary' type='button' title='Keluarkan dari Stok'><i class='fa fa-check'></i></button>"
                } else {
                    return '';
                }
            }
          }
        ],
        createdRow: function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
          $compile($('tfoot'))($scope);
          $compile($('[ng-click="backward()"]'))($scope);
          $(row).find('input').focus()
        }
    });

    var embedUrl = $('#embedUrl').attr('href')
    $('#pdfDocument').attr('src', embedUrl)

  $scope.approve = function(equipment_detail_id) {
    is_approve = confirm('Apakah anda yakin transaksi ini disetujui ?');
    if(is_approve)
        $http.put(baseUrl + '/controller/pharmacy/equipment/' + id + '/detail/' + equipment_detail_id + '/approve').then(function(data) {
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
        $http.delete(baseUrl + '/controller/pharmacy/equipment/' + id).then(function(data) {
            toastr.success("Data Berhasil dihapus")
            setTimeout(function() {
                location.href = baseUrl + '/pharmacy/equipment'
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
        equipment_detail_datatable.row.add({}).draw()
    }

  $scope.show = function() {
      $http.get(baseUrl + '/controller/pharmacy/equipment/' + id).then(function(data) {
            equipment_detail_datatable.clear().draw()
            $scope.formData = data.data
            var grandtotal = 0
            var detail = data.data.detail
            var unit

            for(x in detail) {
                unit = detail[x]
                detail[x].item_name = unit.item.name
                detail[x].lokasi_name = unit.lokasi.name
                grandtotal += unit.subtotal
                $scope.insertItem(unit)
                $scope.checkStock(x, unit.item_id, unit.lokasi_id)
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


    $scope.checkStock = function(index, item_id, lokasi_id) {
      var param = {
          'item_id' : item_id,
          'lokasi_id' : lokasi_id
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