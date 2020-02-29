app.controller('laboratoryTypeCreate', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope, $compile) {
    $scope.title = 'Tambah Jenis Pemeriksaan Laboratorium';
    $scope.formData = {}
    var path = window.location.pathname;
    if(/edit/.test(path)) {
        $scope.title = 'Edit Jenis Pemeriksaan Laboratorium';
        id = path.replace(/.+\/(\d+)/, '$1');
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
    }



    detail_datatable = $('#detail_datatable').DataTable({
       dom: 'rt',
        columns:[
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : resp => '<input type="text" style="width:100%" value="' + (resp.name || '') + '" class="form-control" onchange="changeName(this)">'
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-center',
            render : resp =>  "<button  class='btn btn-xs btn-danger' ng-click='deleteDetail($event.currentTarget)' title='Hapus'><i class='fa fa-trash-o'></i></button>"
          },
        ],
        createdRow: function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
          $(row).find('input').focus()
        }
    });

  changeName = function(obj) {
      var name = $(obj).val()
      console.log(name)
      var input = {
        'name' : name
      }
      var row = $(obj).parents('tr')
      detail_datatable.row(row).data(input).draw()
  }

    $scope.reset = function() {
        $scope.formData = {}
        detail_datatable.clear().draw()
    }

    $scope.deleteDetail = function(obj) {
        var row = $(obj).parents('tr')
        detail_datatable.row(row).remove().draw()
    } 

    $scope.addDetail = function() {
        detail_datatable.row.add({}).draw()
    }

    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/user/laboratory_type';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/user/laboratory_type/' + id;
          var method = 'put';
      } 
      $scope.formData.detail = detail_datatable.data().toArray()
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/laboratory_type'          
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