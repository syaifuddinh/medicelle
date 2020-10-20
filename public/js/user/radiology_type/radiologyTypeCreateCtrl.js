app.controller('radiologyTypeCreate', ['$scope', '$http', '$rootScope', '$compile', '$timeout', '$filter', function($scope, $http, $rootScope, $compile, $timeout, $filter) {
    $scope.title = 'Tambah Jenis Pemeriksaan Radiologi';
    $scope.data = {}
    $scope.formData = {
        price : {},
        detail : []
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
            $scope.is_init = 1
            $scope.formData = data.data
            $scope.formData.price.price = data.data.price.custom_price
            $scope.formData.price.service_price = data.data.price.service.service_price
            $scope.formData.price.piece_id = data.data.price.service.piece_id
            var detail = data.data.radiology_type_detail
            var unit
            $scope.formData.detail = []
            for(x in detail) {
                unit = detail[x]
                detail[x].item_name = unit.name
                $scope.insertItem(unit)
            }
            $scope.is_init = 0
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

    $scope.insertItem = function(data = {}) {
        $scope.formData.detail.push(data)
        radiology_type_detail_datatable.row.add(data).draw()
        if($scope.is_init != 1) {
            $timeout(function () {
                $scope.showItemModal($scope.formData.detail.length - 1)
            }, 400)
        }
    }

    $scope.selectItem = function(obj) {
        var tr = $(obj).parents('tr')
        var data = item_datatable.row(tr).data()
        $scope.formData.detail[$scope.currentIndex].item_name= data.name
        $scope.formData.detail[$scope.currentIndex].item_id= data.id
        $('#itemModal').modal('hide')
    }

    $scope.showItemModal = function(index) {
        item_datatable.ajax.reload()
        $scope.currentIndex = index
        $('#itemModal').modal()
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

  radiology_type_detail_datatable = $('#radiology_type_detail_datatable').DataTable({
       dom: 'rt',
       pageLength: 200,
        columns:[
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<div style='height:9mm' ng-click='showItemModal(" + index + ")'><% formData.detail[" + index + "].item_name %></div>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<input type='text' class='form-control' ng-model='formData.detail[" + index + "].qty' style='width:16mm' jnumber2 only-num>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            width : '15mm',
            className : 'text-center',
            render :function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<button  class='btn btn-xs btn-danger' ng-click='deleteDetail(" + index + ", $event.currentTarget)' title='Hapus'><i class='fa fa-trash-o'></i></button>"  
            }  
          },
        ],
        createdRow: function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
          $(row).find('input').focus()
        }
    });

  item_datatable = $('#item_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url : baseUrl+'/datatable/master/medical_item',
      data : function(d) {
        d.length = 6
        d.is_active = 1

        return d
      }
    },
    columns:[
    {
      data:null, 
      name:null,
      searchable:false,
      orderable:false,
      className : 'text-center',
      render : resp => "<button ng-disabled='disBtn' type='button' class='btn btn-xs btn-primary' ng-click='selectItem($event.currentTarget)'>Pilih</button>"
    },
    {data:"unique_code", orderable:false,searchable:false},
    {data:"name", name:"name"},
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

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