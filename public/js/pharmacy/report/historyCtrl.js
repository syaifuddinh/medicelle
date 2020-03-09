app.controller('history', ['$scope', '$rootScope', '$compile', '$http', '$filter', function($scope, $rootScope, $compile, $http, $filter) {
  $scope.formData = {}
  var path = window.location.pathname;

  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl + '/datatable/pharmacy/history',
      data : d => Object.assign(d, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Laporan Distribusi Barang - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Laporan Distribusi Barang'
      },
    ],

    columns:[
      {
        data:'item.group.name', 
        name:'item.group.name' 
      },
      {
        data:'item.classification.name', 
        name:'item.classification.name' 
      },
      {
        data:'item.subclassification.name', 
        name:'item.subclassification.name' 
      },
      {
        data:'item.generic.name', 
        name:'item.generic.name' 
      },
      {
        data:'item.name', 
        name:'item.name' 
      },
      {
        data:'item.piece.name', 
        name:'item.piece.name' 
      },
      {
        data:'lokasi.name', 
        name:'lokasi.name' 
      },
      {
        data:null, 
        name:'expired_date', 
        searchable:false,
        render:resp => $filter('fullDate')(resp.expired_date)
      },
      {
        data:'early_stock', 
        className : 'text-right',
        orderable : false,
        searchable: false
      },
      {
        data:'latest_stock', 
        className : 'text-right',
        orderable : false,
        searchable: false
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda yakin transaksi ini akan dihapus ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/pharmacy/history/' + id).then(function(data) {
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
        $http.put(baseUrl + '/controller/pharmacy/history/' + id + '/approve').then(function(data) {
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