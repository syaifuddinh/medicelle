app.controller('movementCreate', ['$scope', '$http', '$rootScope', '$filter', '$compile', '$timeout', function($scope, $http, $rootScope, $filter, $compile, $timeout) {
    $scope.title = 'Form Perpindahan';
    $scope.data = {}
    $scope.formData = {}
    $scope.dot = '.............................................................................................................'
    $scope.shortDot = '..........'
    $scope.priceSlider = 209
    path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');

    $scope.backwardModal = function() {
        if($scope.lokasiType == 1) {
            $('#lokasiModal').modal('hide')
            $scope.showItemModal($scope.currentIndex)
        } else if($scope.lokasiType == 2) {
            $('#lokasiModal').modal('hide')
            $timeout(function() {

                $scope.showLokasiModal($scope.currentIndex, 1)
            }, 800)
        }
    }

    $scope.show = function() {

      $http.get(baseUrl + '/controller/pharmacy/movement/' + id).then(function(data) {
          var detail = data.data.detail
          var unit

          for(x in detail) {
              unit = detail[x]
              detail[x].item_name = unit.item.name
              $scope.insertItem(unit)
          }

          $scope.formData = data.data
          console.log($scope.formData)
          $scope.formData.detail = detail

          setTimeout(function () {
              
                $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
            }, 300)

          for(x in detail) {
              $scope.checkStock(x, detail[x].item_id, detail[x].lokasi_awal_id)
          }
      }, function(error) {
            $scope.show()
      });
    }
   

    movement_detail_datatable = $('#movement_detail_datatable').DataTable({
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
                return "<% formData.detail[" + index + "].stock %>"
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
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<div style='height:9mm' ng-click='showLokasiModal(" + index + ", 1)'><% formData.detail[" + index + "].lokasi_awal_name %></div>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<div style='height:9mm' ng-click='showLokasiModal(" + index + ", 2)'><% formData.detail[" + index + "].lokasi_akhir_name %></div>"
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
    ajax: {
      url : baseUrl+'/datatable/master/item',
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

  lokasi_datatable = $('#lokasi_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url : baseUrl+'/datatable/master/lokasi',
      data : function(d) {
        d.length = 6

        return d
      }
    },
    columns:[
    {
      data:null, 
      searchable:false,
      orderable:false,
      className : 'text-center',
      render : resp => "<button type='button' class='btn btn-xs btn-primary' ng-click='selectLokasi($event.currentTarget)'>Pilih</button>"
    },
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
                    $scope.checkStock(x, unit.item_id, unit.lokasi_awal_id)
                }
            }
        }
    }

    $scope.showItemModal = function(index) {
        item_datatable.ajax.reload()
        $scope.currentIndex = index
        $('#itemModal').modal()
    }


    $scope.showLokasiModal = function(index, lokasiType) {
        $scope.lokasiModalTitle = 'Daftar Lokasi Awal'
        if(lokasiType == 2) {
            $scope.lokasiModalTitle = 'Daftar Lokasi Akhir'          
        }
        $scope.currentIndex = index
        $scope.lokasiType = lokasiType
        $('#lokasiModal').modal()
    }

    $scope.selectItem = function(obj) {
        $rootScope.disBtn=true;
        var tr = $(obj).parents('tr')
        var data = item_datatable.row(tr).data()
        $scope.formData.detail[$scope.currentIndex].item_name= data.name
        $scope.formData.detail[$scope.currentIndex].item_id= data.id
        $('#itemModal').modal('hide')      
        $scope.showLokasiModal($scope.currentIndex, 1)        
    }

    $scope.checkStock = function(index, item_id, lokasi_id) {
      var param = {
          'item_id' : item_id,
          'lokasi_id' : lokasi_id
        }

      $http.get(baseUrl + '/controller/pharmacy/stock_transaction/lokasi/check?' + $.param(param)).then(function(data) {
            $('#itemModal').modal('hide')
            $rootScope.disBtn=false;
            $scope.formData.detail[index].stock = data.data.qty
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

    $scope.selectLokasi = function(obj) {
        var tr = $(obj).parents('tr')
        var data = lokasi_datatable.row(tr).data()
        if($scope.lokasiType == 1) { 
            $scope.formData.detail[$scope.currentIndex].lokasi_awal_name= data.name
            $scope.formData.detail[$scope.currentIndex].lokasi_awal_id= data.id
            $('#lokasiModal').modal('hide')
            $scope.checkStock($scope.currentIndex, $scope.formData.detail[$scope.currentIndex].item_id, data.id)
            $timeout(function(){
                $scope.showLokasiModal($scope.currentIndex, 2)
            }, 800)
        } else if($scope.lokasiType == 2) { 
            $scope.formData.detail[$scope.currentIndex].lokasi_akhir_name= data.name
            $scope.formData.detail[$scope.currentIndex].lokasi_akhir_id= data.id
            $('#lokasiModal').modal('hide')
        }
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
      movement_detail_datatable.clear().draw()
      window.scrollTo(0, 0)
    }
    $scope.reset()
    if(path.indexOf('edit') > -1) {
        $scope.show()
    }

    $scope.insertItem = function(data = {}) {
        $scope.formData.detail.push(data)
        movement_detail_datatable.row.add({}).draw()
        $timeout(function () {
            $scope.showItemModal($scope.formData.detail.length - 1)
        }, 500)
    }

    $scope.deleteDetail = function(index, obj) {
        $scope.formData.detail[index] = {}
        var row = $(obj).parents('tr')
        movement_detail_datatable.row(row).remove().draw()
    } 


    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/pharmacy/movement';
      var method = 'post';
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        if($scope.repeat == 1) {
            if(path.indexOf('edit') > -1) {          
                setTimeout(function () {
                  window.location = baseUrl + '/pharmacy/movement/create'          
                }, 1000)
            } else {
              
              $scope.reset()
            }
        } else {
            setTimeout(function () {
              window.location = baseUrl + '/pharmacy/movement'          
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