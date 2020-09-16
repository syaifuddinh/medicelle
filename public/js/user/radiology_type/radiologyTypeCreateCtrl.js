app.controller('radiologyTypeCreate', ['$scope', '$http', '$rootScope', '$compile', '$timeout', '$filter', function($scope, $http, $rootScope, $compile, $timeout, $filter) {
    $scope.title = 'Tambah Jenis Pemeriksaan Radiologi';
    $scope.data = {}
    $scope.formData = {
        price : {}
    }
    var path = window.location.pathname;
    $scope.countGrandtotal = function() {
      var price_text = $('.price-text')
      var grandtotal = 0;
      if(price_text.length > 0) {
        for(p = 0;p < price_text.length;p++) {
            grandtotal += parseInt($(price_text[p]).val() || 0)
        }
      }

      grandtotal = $filter('number')(grandtotal)
      $('#grandtotal').text(grandtotal) 
  }
    if(/edit/.test(path)) {
        $scope.title = 'Edit Jenis Pemeriksaan Radiologi';
        id = path.replace(/.+\/(\d+)/, '$1');
        $http.get(baseUrl + '/controller/user/radiology_type/' + id).then(function(data) {
            $scope.formData = data.data
            $scope.formData.price.price = data.data.price.custom_price
            $scope.formData.price.piece_id = data.data.price.service.piece_id
            detail_datatable.rows.add($scope.formData.radiology_type_detail).draw()
            $scope.countGrandtotal()
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

    $scope.deleteDetail = function(obj) {
        var row = $(obj).parents('tr')
        detail_datatable.row(row).remove().draw()
        $scope.countGrandtotal()
    } 

    $scope.addDetail = function() {
        detail_datatable.row.add({}).draw()
    }

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
      $(obj).val(price)
      $scope.countGrandtotal()
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
            render : function(resp) {
                return '<input type="number" style="width:100%" value="' + (resp.price || '') + '" onchange="changePrice(this)" class="text-right form-control price-text">'
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
          $compile($('tfoot'))($scope);
          $(row).find('input').focus()
        }
    });
    $timeout(function() {
        $compile($('tfoot'))($scope);
    }, 1000)

  changeName = function(obj) {
      var name = $(obj).val()
      var input = {
        'name' : name
      }
      var row = $(obj).parents('tr')
      detail_datatable.row(row).data(input).draw()
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
      var url = baseUrl + '/controller/user/radiology_type';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/user/radiology_type/' + id;
          var method = 'put';
      } 
      $scope.formData.detail = detail_datatable.data().toArray()
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/radiology_type'          
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