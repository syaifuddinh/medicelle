app.controller('equipment', ['$scope', '$rootScope', '$compile', '$http', '$filter', function($scope, $rootScope, $compile, $http, $filter) {
  $scope.formData = {}
  $scope.statuses = []
  var path = window.location.pathname;

  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    order:[[0, 'desc']],
    ajax: {
      url : baseUrl + '/datatable/pharmacy/equipment',
      data : d => Object.assign(d, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Penggunaan Barang - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Penggunaan Barang'
      },
    ],

    columns:[
      {
        data:null, 
        name:'date',
        searchable:false,
        render:resp => $filter('fullDate')(resp.date)
      },
      {
        data:'description', 
        name:'description' 
      },
      {
        data:'user.name', 
        name:'user.name' 
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => 
        "<div class='btn-group'>" + 
        (resp.approved == 0 ? "<a class='btn btn-xs btn-success' href='" + baseUrl +"/pharmacy/equipment/edit/" + resp.id + "' title='Edit'><i class='fa fa-pencil'></i></a>"  : '' )+ 
        "<a class='btn btn-xs btn-default' href='" + baseUrl +"/pharmacy/equipment/" + resp.id + "' title='Detail'><i class='fa fa-file-text-o'></i></a>" +
         (resp.approved == 0 ? "<button type='button' class='btn btn-xs btn-danger' ng-click='delete(" + resp.id + ")'><i class='fa fa-trash-o'></i></button>" : "" ) + 
         "</div>" 
      }
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

      $scope.showEquipment = function() {
        $http.get(baseUrl + '/controller/user/setting/equipment').then(function(data) {
            $scope.statuses = data.data.status
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
          $scope.showPicSetting()
        });
    }
    $scope.showEquipment()

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda yakin transaksi ini akan dihapus ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/pharmacy/equipment/' + id).then(function(data) {
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
        $http.put(baseUrl + '/controller/pharmacy/equipment/' + id + '/approve').then(function(data) {
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