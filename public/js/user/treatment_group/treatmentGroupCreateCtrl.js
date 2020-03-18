app.controller('treatmentGroupCreate', ['$scope', '$http', '$rootScope', '$compile', '$timeout', function($scope, $http, $rootScope, $compile, $timeout) {
    $scope.title = 'Tambah Paket Tindakan';
    $scope.formData = {
        detail : []
    }
    $rootScope.disBtn=false
    $scope.formData.laboratory_types = []
    $scope.data = {}
    var path = window.location.pathname;


    treatment_group_detail_datatable = $('#treatment_group_detail_datatable').DataTable({
       dom: 'rt',
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

    price_datatable = $('#price_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url : baseUrl+'/datatable/user/price',
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
      render : resp => "<button type='button' class='btn btn-xs btn-primary' ng-click='selectPrice($event.currentTarget)'>Pilih</button>"
    },
    {data:"grup_nota.slug",name:"grup_nota.slug"},
    {data:"service.name", name:"service.name"},
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });


    $scope.deleteDetail = function(index, obj) {
        $scope.formData.detail[index] = {}
        var row = $(obj).parents('tr')
        treatment_group_detail_datatable.row(row).remove().draw()
    } 

  item_datatable = $('#item_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url : baseUrl+'/datatable/master/bhp',
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


    $scope.selectItem = function(obj) {
        var tr = $(obj).parents('tr')
        var data = item_datatable.row(tr).data()
        $scope.formData.detail[$scope.currentIndex].item_name= data.name
        $scope.formData.detail[$scope.currentIndex].item_id= data.id
        $('#itemModal').modal('hide')
    }

    $scope.selectPrice = function(obj) {
        var tr = $(obj).parents('tr')
        var data = price_datatable.row(tr).data()
        $scope.formData.detail[$scope.currentIndex].item_name= data.service.name
        $scope.formData.detail[$scope.currentIndex].item_id= data.item_id
        $('#itemModal').modal('hide')
    }

  $scope.insertItem = function(data = {}) {
        $scope.formData.detail.push(data)
        treatment_group_detail_datatable.row.add(data).draw()
        if($scope.is_init != 1) {
            $timeout(function () {
                $scope.showItemModal($scope.formData.detail.length - 1)
            }, 400)
        }
    }

  $scope.showItemModal = function(index) {
        item_datatable.ajax.reload()
        $scope.currentIndex = index
        $('#itemModal').modal()
    }

    $scope.show = function() {

        if(/edit/.test(path)) {
            $scope.is_init = 1
            $scope.title = 'Edit Paket Tindakan';
            id = path.replace(/.+\/(\d+)/, '$1');
            $http.get(baseUrl + '/controller/user/treatment_group/' + id).then(function(data) {
                $scope.formData = data.data
                $scope.formData.name = data.data.item.name
                $scope.formData.price = data.data.item.price

                var detail = data.data.detail
                var unit
                $scope.formData.detail = []
                for(x in detail) {
                    unit = detail[x]
                    detail[x].item_name = unit.item.name
                    $scope.insertItem(unit)
                }

                $scope.is_init = 0
            }, function(error) {
              $scope.show()
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
    }
    $scope.show()

    


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


    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/user/treatment_group';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/user/treatment_group/' + id;
          var method = 'put';
      } 
      console.log($scope.formData.detail)
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        setTimeout(function () {
          window.location = baseUrl + '/treatment_group'          
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