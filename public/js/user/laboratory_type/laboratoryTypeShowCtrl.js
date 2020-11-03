app.controller('laboratoryTypeShow', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Detail Jenis Pemeriksaan Laboratorium';
    $scope.formData = {}
    var path = window.location.pathname
    id = path.replace(/.+\/(\d+)/, '$1');
    detail_datatable = $('#detail_datatable').DataTable({
        dom: 'rt',
        columns:[
            {
                data: 'name',
            },
            {
                data: null, 
                orderable : false,
                searchable : false,
                className : 'text-right',
                render : r => $filter('number')(r.price)  
            },
            {
                data: null, 
                orderable : false,
                searchable : false,
                className : 'text-right',
                render : r => $filter('number')(r.service_price)  
            },
            {
                data: null, 
                orderable : false,
                searchable : false,
                className : 'text-right',
                render : r => $filter('number')(r.percentage)  
            },
        ],
        createdRow: function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
        }
    });
    $http.get(baseUrl + '/controller/user/laboratory_type/' + id).then(function(data) {
            $scope.formData = data.data
            detail_datatable.rows.add($scope.formData.laboratory_type_detail).draw()
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

    $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
      if(is_delete)
          $http.delete(baseUrl + '/controller/user/laboratory_type/' + id).then(function(data) {
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
          $http.put(baseUrl + '/controller/user/laboratory_type/activate/' + id).then(function(data) {
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