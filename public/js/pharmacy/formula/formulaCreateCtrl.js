app.controller('formulaCreate', ['$scope', '$http', '$rootScope', '$filter', '$compile', '$timeout', function($scope, $http, $rootScope, $filter, $compile, $timeout) {
    $scope.title = 'Form Resep Obat';
    $scope.data = {}
    $scope.formData = {}
    $scope.dot = '.............................................................................................................'
    $scope.shortDot = '..........'
    $scope.priceSlider = 209
    path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');

    medical_record_datatable = $('#medical_record_datatable').DataTable({
          processing: true,
          serverSide: true,
          dom: 'frtip',
          ajax: {
            url : baseUrl+'/datatable/registration/medical_record',
          },

          columns:[
            {
              data: null, 
              orderable : false,
              searchable : false,
              className : 'text-center',
              render : resp => '<button class="btn btn-sm btn-primary" ng-disabled="disBtn" ng-click="selectMedicalRecord($event.currentTarget)">Pilih</button>'
            },
            {data:"code", name:"code", width : '35mm' },
            {data:"registration_detail.registration.code", name:"registration_detail.registration.code", width : '35mm' },
            {
              data:null, 
              orderable:false,
              searchable:false,
              width : '45mm',
              render:resp => $filter('fullDate')(resp.registration_detail.registration.date)
            },
            {data:"patient.name", name:"patient.name", orderable:false, searchable:false},
            {data:"registration_detail.doctor.name", name:"registration_detail.doctor.name", orderable:false, searchable:false},
          ],
          createdRow: function(row, data, dataIndex) {
            $compile(angular.element(row).contents())($scope);
          }
        });

    $scope.showMedicalRecordModal = function() { 
          medical_record_datatable.ajax.reload()  
          $('#medicalRecordModal').modal()
          
    }

    $scope.selectMedicalRecord = function(obj) {
          var tr = $(obj).parents('tr')
          var data = medical_record_datatable.row(tr).data()
          $scope.formData.registration_detail_id = data.registration_detail.registration_id
          $scope.formData.medical_record_id = data.id
          $scope.formData.medical_record = data
          if(path.indexOf('edit') > -1) {
              $scope.formData.registration_detail.registration_id = data.registration_detail.registration_id
          } else {
              $scope.formData.registration_detail = {
                  'registration_id' : data.registration_detail.registration_id  
              }
          }
          $scope.showRegistration()
          $('#medicalRecordModal').modal('hide')
    }

    $scope.show = function() {

      $http.get(baseUrl + '/controller/pharmacy/formula/' + id).then(function(data) {
          var detail = data.data.detail
          var unit

          for(x in detail) {
              unit = detail[x]
              detail[x].item_name = unit.item.name
              detail[x].piece_name = unit.item.piece.name
              detail[x].price = unit.item.price
              detail[x].lokasi_name = unit.lokasi.name
              detail[x].used_qty = unit.stock.qty
              detail[x].expired_date = unit.stock.expired_date
              $scope.insertItem(unit, 0)
          }

          $scope.formData = data.data
          $scope.formData.detail = detail
          $scope.showRegistration()
          setTimeout(function () {
              
                $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
                $('[ng-model="formData.date_start"]').val( $filter('fullDate')($scope.formData.date_start))
                $('[ng-model="formData.date_end"]').val( $filter('fullDate')($scope.formData.date_end))
            }, 300)
      }, function(error) {
            $scope.show()
      });
    }

    formula_detail_datatable = $('#formula_detail_datatable').DataTable({
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
                return "<div style='height:9mm' ng-click='showLokasiModal(" + index + ")'><% formData.detail[" + index + "].lokasi_name %></div>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].expired_date | fullDate %>"
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
                return "<% formData.detail[" + index + "].used_qty | number %>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-right',  
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].piece_name %>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            className : 'text-right',
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<% formData.detail[" + index + "].price | number %>"
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
        d.is_active = 1

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
                    $scope.checkStock(x, unit.item_id)
                }
            }
        }
    }

    $scope.backwardModal = function() {
        $('#lokasiModal').modal('hide')
        $scope.showItemModal($scope.currentIndex)
    }

    $scope.showItemModal = function(index) {
        item_datatable.ajax.reload()
        $scope.currentIndex = index
        $('#itemModal').modal()
    }


    $scope.showLokasiModal = function(index) {
        $scope.currentIndex = index
        lokasi_datatable.ajax.reload()
        $('#lokasiModal').modal()
    }

    $scope.selectItem = function(obj) {
        $rootScope.disBtn=true;
        var tr = $(obj).parents('tr')
        var data = item_datatable.row(tr).data()
        $scope.formData.detail[$scope.currentIndex].item_name= data.name
        $scope.formData.detail[$scope.currentIndex].piece_name= data.piece.name
        $scope.formData.detail[$scope.currentIndex].item_id= data.id
        $scope.formData.detail[$scope.currentIndex].price= data.price
        $('#itemModal').modal('hide')
        $scope.showLokasiModal($scope.currentIndex)

        $scope.checkStock($scope.currentIndex, data.id, $scope.formData.detail[$scope.currentIndex].lokasi_id)
      
    }

    $scope.showRegistration = function() {
        $rootScope.disBtn = true
        $http.get(baseUrl + '/controller/registration/registration/' + $scope.formData.registration_detail.registration_id).then(function(data) {
          $rootScope.disBtn = false
          $scope.registration = data.data
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

    $scope.approve = function() {
          $http.put(baseUrl + '/controller/pharmacy/registration/' + $scope.formData.registration_detail.registration_id).then(function(data) {
            $scope.registration = data.data
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

    $scope.checkStock = function(index, item_id, lokasi_id) {
      var param = {
          'item_id' : item_id,
          'lokasi_id' : lokasi_id,
        }

      $http.get(baseUrl + '/controller/pharmacy/stock_transaction/lokasi/check?' + $.param(param)).then(function(data) {
            $rootScope.disBtn=false;
            $scope.formData.detail[index].used_qty = data.data.qty
            $scope.formData.detail[index].expired_date = data.data.expired_date
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
        $scope.formData.detail[$scope.currentIndex].lokasi_name= data.name
        $scope.formData.detail[$scope.currentIndex].lokasi_id= data.id
        $scope.checkStock($scope.currentIndex, $scope.formData.detail[$scope.currentIndex].item_id, data.id)
        $('#lokasiModal').modal('hide')
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
      $scope.registration = {}
      var currentDate = new Date()
      var date = currentDate.getFullYear() + '-' + ( currentDate.getMonth() + 1 ) + '-' + currentDate.getDate()
      $scope.formData.date = date
      setTimeout(function () {    
            $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
      }, 300)
      formula_detail_datatable.clear().draw()
      window.scrollTo(0, 0)
    }
    $scope.reset()
    if(path.indexOf('edit') > -1) {
        $scope.show()
    }

    $scope.insertItem = function(data = {}, show = 1) {
        $scope.formData.detail.push(data)
        formula_detail_datatable.row.add({}).draw()
        if(show == 1) {
            $timeout(function () {
                $scope.showItemModal($scope.formData.detail.length - 1)
            }, 400)
        }
    }

    $scope.deleteDetail = function(index, obj) {
        $scope.formData.detail[index] = {}
        var row = $(obj).parents('tr')
        formula_detail_datatable.row(row).remove().draw()
    } 


    $scope.submitForm=function() {
      $rootScope.disBtn=true;
      var url = baseUrl + '/controller/pharmacy/formula';
      var method = 'post';
      if($scope.formData.id) {
          var url = baseUrl + '/controller/pharmacy/formula/' + id;
          var method = 'put';
      } 
      $http[method](url, $scope.formData).then(function(data) {
        $rootScope.disBtn = false
        toastr.success("Data Berhasil Disimpan !");
        if($scope.repeat == 1) {
            if(path.indexOf('edit') > -1) {          
                setTimeout(function () {
                  window.location = baseUrl + '/pharmacy/formula/create'          
                }, 1000)
            } else {
              
              $scope.reset()
            }
        } else {
            setTimeout(function () {
              window.location = baseUrl + '/pharmacy/formula'          
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