app.controller('receipt', ['$scope', '$rootScope', '$compile', '$http', '$filter', function($scope, $rootScope, $compile, $http, $filter) {
  $scope.formData = {}
  var path = window.location.pathname;

  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl + '/datatable/pharmacy/receipt',
      data : d => Object.assign(d, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Rekam Medis - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Rekam Medis'
      },
    ],

    columns:[
      {
        data:null, 
        name:'code',
        render : resp => "<a href='" + baseUrl +"/pharmacy/receipt/" + resp.id + "'>" + resp.code + "</a>"  
      },
      {
        data:'purchase_order.code', 
        name:'purchase_order.code' 
      },
      {
        data:'supplier.name', 
        name:'supplier.name' 
      },

      {
        data:null, 
        orderable:false,
        searchable:false,
        render:resp => $filter('fullDate')(resp.date)
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => 
        "<div class='btn-group'>" + 
        "<a allow_show_receipt class='btn btn-xs btn-default' href='" + baseUrl +"/pharmacy/receipt/" + resp.id + "' title='Detail'><i class='fa fa-file-text-o'></i></a>" +
         "</div>" 
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  purchase_order_datatable = $('#purchase_order_datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url : baseUrl + '/datatable/pharmacy/purchase_order',
      data : function(d) {
          d.status = 4
      }
    },
    
    columns:[
      {
        data:null, 
        name:null,
        searchable:false,
        orderable:false,
        className : 'text-center',
        render : resp => "<button ng-disabled='disBtn' type='button' class='btn btn-xs btn-primary' ng-click='selectPurchaseOrder($event.currentTarget)'>Pilih</button>"
      },
      {
        data:'code', 
        name:'code' 
      },
      {
        data:'purchase_request.code', 
        name:'purchase_request.code' 
      },
      {
        data:null, 
        orderable:false,
        searchable:false,
        render:resp => $filter('fullDate')(resp.date)
      }
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

  $scope.showPurchaseOrder = function() {
      purchase_order_datatable.ajax.reload()
      $('#purchaseOrderModal').modal()
  }

  $scope.selectPurchaseOrder = function(obj) {
      var tr = $(obj).parents('tr')
      var data = purchase_order_datatable.row(tr).data() 

      location.href = baseUrl + '/pharmacy/receipt/purchase_order/' + data.id + '/create'
  }

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda yakin transaksi ini akan dihapus ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/pharmacy/receipt/' + id).then(function(data) {
            oTable.ajax.reload();
            toastr.success("Data berhasil dihapus");
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


  $scope.approve = function(id) {
    is_approve = confirm('Apakah anda yakin transaksi ini disetujui ?');
    if(is_approve)
        $http.put(baseUrl + '/controller/pharmacy/receipt/' + id + '/approve').then(function(data) {
            oTable.ajax.reload();
            toastr.success("Data berhasil disetujui");
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


  $scope.filter = function() {
    oTable.ajax.reload();
  }

}]);