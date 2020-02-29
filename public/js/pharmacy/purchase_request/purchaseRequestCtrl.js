app.controller('purchaseRequest', ['$scope', '$rootScope', '$compile', '$http', '$filter', function($scope, $rootScope, $compile, $http, $filter) {
  $scope.formData = {}
  var path = window.location.pathname;

  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl + '/datatable/pharmacy/purchase_request',
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
        orderable:false,
        searchable:false,
        render:resp => $filter('fullDate')(resp.date)
      },
      {
        data:'description', 
        name:'description' 
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => resp.is_approve == 0 ? '<label class="label label-warning">Draf</label>' : '<label class="label label-success">Disetujui</label>'
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => 
        "<div class='btn-group'>" + 
        "<a allow_update_purchase_request class='btn btn-xs btn-success' href='" + baseUrl +"/pharmacy/purchase_request/edit/" + resp.id + "' title='Edit'><i class='fa fa-pencil'></i></a><a allow_update_purchase_request class='btn btn-xs btn-default' href='" + baseUrl +"/pharmacy/purchase_request/" + resp.id + "' title='Detail'><i class='fa fa-file-text-o'></i></a></div>" 
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  $scope.filter = function() {
    oTable.ajax.reload();
  }

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/pharmacy/purchase_request/' + id).then(function(data) {
            oTable.ajax.reload();
            toastr.success("Data Berhasil dinon-aktifkan !");
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

  $scope.activate = function(id) {
    is_activate = confirm('Apakah anda ingin mengaktifkan data ini ?');
      if(is_activate)
          $http.put(baseUrl + '/controller/pharmacy/purchase_request/activate/' + id).then(function(data) {
              toastr.success("Data Berhasil diaktifkan !");
              oTable.ajax.reload();
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
}]);