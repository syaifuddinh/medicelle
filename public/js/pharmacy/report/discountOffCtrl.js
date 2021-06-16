app.controller('discountOff', ['$scope', '$rootScope', '$compile', '$http', '$filter', function($scope, $rootScope, $compile, $http, $filter) {
  $scope.formData = {}
  $scope.data = {}
  var path = window.location.pathname;

  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl + '/datatable/pharmacy/discount_off',
      data : d => Object.assign(d, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Laporan Diskon Off - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Laporan Diskon Off'
      },
    ],

    columns:[
      {
        data:null, 
        searchable : false,
        name:'receipt_detail.purchase_order_detail.purchase_order.purchase_request.date',
        render : x => $filter('fullDate')(x.receipt_detail.purchase_order_detail.purchase_order.purchase_request.date)
      },
      {
        data:'receipt_detail.purchase_order_detail.purchase_order.purchase_request.code', 
        name:'receipt_detail.purchase_order_detail.purchase_order.purchase_request.code' 
      },
      {
        data:'contact.name', 
        name:'contact.name' 
      },
      {
        data:'receipt_detail.item.name', 
        name:'receipt_detail.item.name' 
      },
      {
        data:null, 
        searchable:false,
        className:'text-right',
        name:'discount', 
        render : x => $filter('number')(x.discount)
      },
      {
        data:null, 
        searchable:false,
        className:'text-right',
        name:'total_discount_value', 
        render : x => $filter('number')(x.total_discount_value)
      },
      {
        data:null, 
        orderable:false,
        className : 'text-center',
        searchable : false,
        render : function(resp) {
            var outp = ''
            if(resp.is_paid == 0) {
                outp = '<span class="label label-warning">Draft</span>'
            } else {
                outp = '<span class="label label-primary">Terbayar</span>'
            }
            return outp
        }
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  $scope.principal = function() {
        $http.get(baseUrl + '/controller/master/supplier').then(function(data) {
            $scope.data.principal = data.data
        }, function(error) {
          $rootScope.disBtn=false;
          if (error.status==422) {
            var det="";
            angular.forEach(error.data.errors,function(val,i) {
              det+="- "+val+"<br>";
            });
            toastr.warning(det,error.data.message);
          } else {
            
            $scope.principal()
            toastr.error(error.data.message,"Error Has Found !");
          }
        });
    }
    $scope.principal()

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda yakin transaksi ini akan dihapus ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/pharmacy/discountOff/' + id).then(function(data) {
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
        $http.put(baseUrl + '/controller/pharmacy/discountOff/' + id + '/approve').then(function(data) {
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