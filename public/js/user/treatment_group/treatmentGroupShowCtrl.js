app.controller('treatmentGroupShow', ['$scope', '$http', '$rootScope','$compile', function($scope, $http, $rootScope, $compile, $filter) {
    $scope.title = 'Detail Paket Tindakan';
    $scope.formData = {
        detail : []
    }
    var path = window.location.pathname
    id = path.replace(/.+\/(\d+)/, '$1');

    $scope.insertItem = function(data = {}) {
        $scope.formData.detail.push(data)
        treatment_group_detail_datatable.row.add(data).draw()
        if($scope.is_init != 1) {
            $timeout(function () {
                $scope.showItemModal($scope.formData.detail.length - 1)
            }, 400)
        }
    }

    $scope.show = function() {
        $http.get(baseUrl + '/controller/user/treatment_group/' + id).then(function(data) {
            $scope.formData = data.data
            var detail = data.data.detail
            $scope.formData.detail = []
                for(x in detail) {
                    unit = detail[x]
                    detail[x].item_name = unit.item.name
                    $scope.insertItem(unit)
                }
        }, function(error) {
          $scope.show()
        });
    }
    $scope.show()

    treatment_group_detail_datatable = $('#treatment_group_detail_datatable').DataTable({
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
            className : 'text-right',
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].qty %>"
            }
          }
        ],
        createdRow: function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
          $(row).find('input').focus()
        }
    });

    $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
      if(is_delete)
          $http.delete(baseUrl + '/controller/user/treatment_group/' + id).then(function(data) {
              toastr.success("Data Berhasil dinon-aktifkan !");
              setTimeout(function () {
                  location.reload();
              }, 1500)
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

    $scope.activate = function(id) {
    is_activate = confirm('Apakah anda ingin mengaktifkan data ini ?');
      if(is_activate)
          $http.put(baseUrl + '/controller/user/treatment_group/activate/' + id).then(function(data) {
              toastr.success("Data Berhasil diaktifkan !");
              setTimeout(function () {
                  location.reload();
              }, 1500)
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
    
}]);