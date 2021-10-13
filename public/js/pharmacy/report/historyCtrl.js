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
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
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
        data:'category_name', 
        name:'categories.name' 
      },
      {
        data:'classification_name', 
        name:'classifications.name' 
      },
      {
        data:'subclassification_name', 
        name:'subclassifications.name' 
      },
      {
        data:'generic_name', 
        name:'generics.name' 
      },
      {
        data:'item_name', 
        name:'items.name' 
      },
      {
        data:'piece_name', 
        name:'pieces.name' 
      },
      {
        data:'lokasi_name', 
        name:'permissions.name' 
      },
      {
        data:null, 
        name:'expired_date', 
        searchable:false,
        render:resp => $filter('fullDate')(resp.expired_date),
        "width": "8%"
      },
      {
        data:'early_stock', 
        className : 'text-right',
        orderable : false,
        searchable: false,
        "width": "4%"
      },
      {
        data:'latest_stock', 
        className : 'text-right',
        orderable : false,
        searchable: false,
        "width": "4%"
      },
    ],
    "autoWidth": false,
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  $scope.lokasi = function() {
          $http.get(baseUrl + '/controller/master/lokasi').then(function(data) {
            $scope.formData.lokasi = data.data
          }, function(error) {
            $rootScope.disBtn=false;
            $scope.lokasi()
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
  $scope.lokasi()


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