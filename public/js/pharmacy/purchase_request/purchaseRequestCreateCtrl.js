app.controller('purchaseRequestCreate', ['$scope', '$http', '$rootScope', '$filter', '$compile', function($scope, $http, $rootScope, $filter, $compile) {
    $scope.title = 'Form Permintaan Pembelian';
    $scope.data = {}
    $scope.dot = '.............................................................................................................'
    $scope.shortDot = '..........'
    $scope.priceSlider = 209
    path = window.location.pathname;
    id = path.replace(/.+\/(\d+)/, '$1');
   

    purchase_request_detail_datatable = $('#purchase_request_detail_datatable').DataTable({
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
                return "<div style='height:9mm' ng-click='showSupplierModal(" + index + ")'><% formData.detail[" + index + "].supplier_name %></div>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<input type='text' class='form-control' ng-model='formData.detail[" + index + "].qty' jnumber2 only-num>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<div><% formData.detail[" + index + "].used_qty %></div>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<input type='text' class='form-control' ng-model='formData.detail[" + index + "].price' only-num jnumber2>"
            }
          },
          {
            data: null, 
            orderable : false,
            searchable : false,
            render : function(resp) {
                var index = $scope.formData.detail.length - 1
                return "<input type='text' class='form-control' ng-model='formData.detail[" + index + "].discount' maxlength='2' only-num>"
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
      render : resp => "<button type='button' class='btn btn-xs btn-primary' ng-click='selectItem($event.currentTarget)'>Pilih</button>"
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
    ajax: {
      url : baseUrl+'/datatable/master/supplier',
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
      render : resp => "<button type='button' class='btn btn-xs btn-primary' ng-click='selectSupplier($event.currentTarget)'>Pilih</button>"
    },
    {data:"code", name:'code'},
    {data:"name", name:"name"},
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

    $scope.showItemModal = function(index) {
        $scope.currentIndex = index
        $('#itemModal').modal()
    }


    $scope.showSupplierModal = function(index) {
        $scope.currentIndex = index
        $('#supplierModal').modal()
    }

    $scope.selectItem = function(obj) {
        var tr = $(obj).parents('tr')
        var data = item_datatable.row(tr).data()
        $scope.formData.detail[$scope.currentIndex].item_name= data.name
        $scope.formData.detail[$scope.currentIndex].item_id= data.id
        $('#itemModal').modal('hide')
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
      $scope.formData = {
          detail : []
      }
     
      var currentDate = new Date()
      var date = currentDate.getFullYear() + '-' + ( currentDate.getMonth() + 1 ) + '-' + currentDate.getDate()
      $scope.formData.date = date
      setTimeout(function () {    
            $('[ng-model="formData.date"]').val( $filter('fullDate')($scope.formData.date))
      }, 300)
      purchase_request_detail_datatable.clear().draw()
      window.scrollTo(0, 0)
    }

    $scope.insertItem = function() {
        $scope.formData.detail.push({})
        purchase_request_detail_datatable.row.add({}).draw()
    }

    $scope.deleteDetail = function(index, obj) {
        $scope.formData.detail[index] = {}
        var row = $(obj).parents('tr')
        purchase_request_detail_datatable.row(row).remove().draw()
    } 


  $scope.reset()
}]);