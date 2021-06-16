app.controller('equipmentCreate', ['$scope', '$http', '$rootScope', '$filter', '$compile', '$timeout', function($scope, $http, $rootScope, $filter, $compile, $timeout) {
    $scope.title = 'Form Penggunaan Barang';
    $scope.data = {}
    $scope.formData = {}
    $scope.dot = '.............................................................................................................'
    $scope.shortDot = '..........'
    $scope.priceSlider = 209
    path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');

    $scope.showLokasi = function() {
        $http.get(baseUrl + '/controller/master/lokasi').then(function(data) {
            $scope.data.lokasi = data.data
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
    $scope.showLokasi()

    $scope.show = function() {

      $http.get(baseUrl + '/controller/pharmacy/equipment/' + id).then(function(data) {
          var detail = data.data.detail
          var unit

          for(x in detail) {
              unit = detail[x]
              detail[x].item_name = unit.item.name
              $scope.insertItem(unit)
          }

          $scope.formData = data.data
          $scope.formData.detail = detail

          setTimeout(function () {
              
                $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))

            }, 300)

          for(x in detail) {
              $scope.checkStock(x, detail[x].item_id, detail[x].lokasi_id)
          }
          setTimeout(function () {
                $('#itemModal').modal('hide')
            }, 400)
      }, function(error) {
            $scope.show()
      });
    }
   

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
                return "<div style='height:9mm' ng-click='showItemModal(" + index + ")'><% formData.detail[" + index + "].item_name %></div>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<select class='form-control' data-placeholder-text-single='\"Pilih Lokasi\"' required='required' chosen allow-single-deselect='false' ng-model='formData.detail[" + index + "].lokasi_id' ng-options='c.id as c.name for c in data.lokasi' ng-change='lokasiChanged(" + $scope.formData.detail[index].id + ")'><option value=''></option></select>"
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
    sScrollY: 300,
    pageLength: 10,
    ajax: {
      url : baseUrl+'/datatable/master/item',
      data : function(d) {
        d.is_active = 1
        d.is_exists = 1

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

  supplier_datatable = $('#supplier_datatable').DataTable({
    processing: true,
    serverSide: true,
    sScrollY: 300,
    pageLength: 10,
    ajax: {
      url : baseUrl+'/datatable/master/supplier',
      data : function(d) {
        d.is_active = 1
        d.supplier_category = 'supplier'

        return d
      }
    },
    columns:[
    {
      data:null, 
      searchable:false,
      orderable:false,
      className : 'text-center',
      render : resp => "<button type='button' class='btn btn-xs btn-primary' ng-click='selectSupplier($event.currentTarget)'>Pilih</button>"
    },
    {data:"code", name:'code'},
    {data:"name", name:"name"},
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

    $scope.adjustStock = function() {
        if($scope.formData.detail.length > 0) {
            var unit
            var detail = $scope.formData.detail
            for(x in detail) {
                unit = detail[x]
                if(unit.item_id) {
                    $scope.checkStock(x, unit.item_id, unit.lokasi_id)
                }
            }
        }
    }

    $scope.lokasiChanged = function(id) {
        var dt = $scope.formData.detail.find(x => x.id == id)
        if(dt) {
            var idx = $scope.formData.detail.findIndex(x => x.id == id)
            $scope.checkStock(idx, dt.item_id, dt.lokasi_id)
        }
    }

    $scope.backwardModal = function() {
        $('#supplierModal').modal('hide')
        $scope.showItemModal($scope.currentIndex)
    }

    $scope.showItemModal = function(index) {
        item_datatable.ajax.reload()
        $scope.currentIndex = index
        $('#itemModal').modal()
    }


    $scope.showSupplierModal = function(index) {
        $scope.currentIndex = index
        supplier_datatable.ajax.reload()
        $('#supplierModal').modal()
    }

    $scope.selectItem = function(obj) {
        $rootScope.disBtn=true;
        var tr = $(obj).parents('tr')
        var data = item_datatable.row(tr).data()
        $scope.formData.detail[$scope.currentIndex].item_name= data.name
        $scope.formData.detail[$scope.currentIndex].item_id= data.id
        $('#itemModal').modal('hide')

        $scope.checkStock($scope.currentIndex, data.id, null)
      
    }

    $scope.checkStock = function(index, item_id, lokasi_id) {
      var param = {
          'item_id' : item_id,
          'lokasi_id' : lokasi_id
      }
      if(item_id && lokasi_id) {
          $http.get(baseUrl + '/controller/pharmacy/stock_transaction/check?' + $.param(param)).then(function(data) {
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

    }

    $scope.selectSupplier = function(obj) {
        var tr = $(obj).parents('tr')
        var data = supplier_datatable.row(tr).data()
        $scope.formData.detail[$scope.currentIndex].supplier_name= data.name
        $scope.formData.detail[$scope.currentIndex].supplier_id= data.id
        $('#supplierModal').modal('hide')
    }

    $scope.reset = function() {
      var now = new Date()
      var id = $scope.formData.id
      var code = $scope.formData.code
      $scope.formData = {
          'id' : id,
          'code' : code,
          detail : []
      }
     
      var currentDate = new Date()
      var date = currentDate.getFullYear() + '-' + ( currentDate.getMonth() + 1 ) + '-' + currentDate.getDate()
      $scope.formData.date = date
      setTimeout(function () {    
            $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
      }, 300)
      equipment_detail_datatable.clear().draw()
      window.scrollTo(0, 0)
    }
    $scope.reset()
    if(path.indexOf('edit') > -1) {
        $scope.show()
    }

    $scope.insertItem = function(data = {}) {
        data.id = Math.round(Math.random() * 999999);
        $scope.formData.detail.push(data)
        equipment_detail_datatable.row.add({}).draw()
        $timeout(function () {
            $scope.showItemModal($scope.formData.detail.length - 1)
        }, 400)
    }

    $scope.deleteDetail = function(index, obj) {
        $scope.formData.detail[index] = {}
        var row = $(obj).parents('tr')
        equipment_detail_datatable.row(row).remove().draw()
    } 


    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/pharmacy/equipment';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/pharmacy/equipment/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        if($scope.repeat == 1) {
            if(path.indexOf('edit') > -1) {          
                setTimeout(function () {
                  window.location = baseUrl + '/pharmacy/equipment/create'          
                }, 1000)
            } else {
              
              $scope.reset()
            }
        } else {
            setTimeout(function () {
              window.location = baseUrl + '/pharmacy/equipment'          
            }, 1000)
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
          toastr.error(error.data.message,"Error Has Found !");
        }
      });
      
    }
}]);