app.controller('purchaseRequest', ['$scope', '$rootScope', '$compile', '$http', '$filter', function($scope, $rootScope, $compile, $http, $filter) {
  $scope.formData = {}
  $scope.statuses = []
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
        name:'code',
        render : function(resp) {
            if(roles['allow_show_pharmacy_purchase_request']) {
                return "<a href='" + baseUrl +"/pharmacy/purchase_request/" + resp.id + "'>" + resp.code + "</a>" 
            } else {
                return resp.code
            }
        }
      },

      {
        data:null, 
        orderable:false,
        searchable:false,
        render:resp => $filter('fullDate')(resp.date)
      },
      {
        data:null, 
        orderable:false,
        searchable:false,
        render:resp => $filter('fullDate')(resp.date_start) + ' s/d ' + $filter('fullDate')(resp.date_end)
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
        render : resp => resp.status < 4 ? '<label class="label label-warning">' + resp.status_name + '</label>' : '<label class="label label-success">' + resp.status_name + '</label>'
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => 
        "<div class='btn-group'>" + 
        ( resp.status == 1 ? "<a allow_update_pharmacy_purchase_request class='btn btn-xs btn-success' href='" + baseUrl +"/pharmacy/purchase_request/edit/" + resp.id + "' title='Edit'><i class='fa fa-pencil'></i></a>" : "") + 
        "<a allow_show_pharmacy_purchase_request class='btn btn-xs btn-default' href='" + baseUrl +"/pharmacy/purchase_request/" + resp.id + "' title='Detail'><i class='fa fa-file-text-o'></i></a>" +
         (resp.status < 4 ? "<button allow_approve_pharmacy_purchase_request type='button' class='btn btn-xs btn-primary' ng-click='approve(" + resp.id + ")'><i class='fa fa-check'></i></button>" : "" ) + 
         (resp.status == 1 ? "<button type='button' allow_destroy_pharmacy_purchase_request class='btn btn-xs btn-danger' ng-click='delete(" + resp.id + ")'><i class='fa fa-trash-o'></i></button>" : "" ) + 
         "</div>" 
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

      $scope.showPurchaseRequest = function() {
        $http.get(baseUrl + '/controller/user/setting/purchase_request').then(function(data) {
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
    $scope.showPurchaseRequest()

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda yakin transaksi ini akan dihapus ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/pharmacy/purchase_request/' + id).then(function(data) {
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
        $http.put(baseUrl + '/controller/pharmacy/purchase_request/' + id + '/approve').then(function(data) {
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