app.controller('cashier', ['$scope', '$compile', '$http', '$filter', function($scope, $compile, $http, $filter) {
  $scope.formData = {}
  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl+'/datatable/cashier/cashier',
      data : d => Object.assign(d, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Kasir - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Kasir'
      },
    ],

    columns:[
      {
        data:null, 
        name:"registration.code",
        render : resp => "<a class='' href='" + baseUrl + "/cashier/" + resp.id +  "'>" + resp.registration.code + "</a>"
      },
      {data:"registration.medical_record.code", name:"registration.medical_record.code"},
      {
        data:null, 
        orderable:false,
        searchable:false,
        render: resp => $filter('fullDate')(resp.date)
      },
      {data:"registration.patient.name", name:"registration.patient.name"},
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => resp.status == 1 ? '<label class="label label-danger">' + resp.status_name + '</label>' : '<label class="label label-success">' + resp.status_name + '</label>'
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => (resp.status != 3 ? "<div class='btn-group'><a class='btn btn-xs btn-success' href='" + baseUrl + "/cashier/pay/" + resp.id +  "' title='Bayar'><i class='fa fa-pencil'></i></a>" : '') +
        "<a class='btn btn-xs btn-default' href='" + baseUrl + "/cashier/" + resp.id +  "' title='Detail'><i class='fa fa-file-text-o'></i></a></div>"
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );

  $scope.filter = function() {
      oTable.ajax.reload()
  }

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/cashier/cashier/' + id).then(function(data) {
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
          $http.put(baseUrl + '/controller/cashier/cashier/activate/' + id).then(function(data) {
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