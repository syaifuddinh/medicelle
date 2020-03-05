app.controller('movement', ['$scope', '$rootScope', '$compile', '$http', '$filter', function($scope, $rootScope, $compile, $http, $filter) {
  $scope.formData = {}
  var path = window.location.pathname;

  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl + '/datatable/pharmacy/movement',
      data : d => Object.assign(d, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Perpindahan barang - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Perpindahan barang'
      },
    ],

    columns:[
      {
        data:null, 
        orderable:false,
        searchable:false,
        render:resp => $filter('fullDate')(resp.date)
      },
      {
        data:'creator.name', 
        name:'creator.name' 
      },
      
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => 
        "<div class='btn-group'>" + 
        "<a allow_show_movement class='btn btn-xs btn-default' href='" + baseUrl +"/pharmacy/movement/" + resp.id + "' title='Detail'><i class='fa fa-file-text-o'></i></a>" +
         "</div>" 
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
        $http.delete(baseUrl + '/controller/pharmacy/movement/' + id).then(function(data) {
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
        $http.put(baseUrl + '/controller/pharmacy/movement/' + id + '/approve').then(function(data) {
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