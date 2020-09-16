app.controller('laboratoryTypeCreate', ['$scope', '$http', '$rootScope', '$compile', function($scope, $http, $rootScope, $compile) {
    $scope.title = 'Tambah Jenis Pemeriksaan Laboratorium';
    $scope.data = {}
    $scope.formData = {
        'price' : {}
    }
    $scope.price = []
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

    $scope.grup_nota = function() {
        $http.get(baseUrl + '/controller/user/grup_nota').then(function(data) {
            $scope.data.grup_nota = data.data
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.grup_nota()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.grup_nota()

    $scope.piece = function() {
        $http.get(baseUrl + '/controller/master/piece/actived').then(function(data) {
            $scope.data.piece = data.data
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.piece()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.piece()

    counter = -1

    detail_datatable = $('#detail_datatable').DataTable({
       dom: 'rt',
	pageLength: 200,
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
            render : function(resp) {
                return '<input type="number" style="width:100%" value="' + (resp.price || '') + '" onchange="changePrice(this)" class="text-right form-control">'
            }  
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
        }
    });

  changeName = function(obj) {
      var name = $(obj).val()
      var row = $(obj).parents('tr')
      var data = detail_datatable.row(row).data()
      data['name'] = name
      detail_datatable.row(row).data(data).draw()
  }

  changePrice = function(obj) {
      var price = $(obj).val()
      var row = $(obj).parents('tr')
      var data = detail_datatable.row(row).data()
      data['price'] = price
      detail_datatable.row(row).data(data).draw()
      
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