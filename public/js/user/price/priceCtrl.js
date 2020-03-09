app.controller('price', ['$scope', '$compile', '$http', '$filter', function($scope, $compile, $http, $filter) {
  oTable = $('#listview').DataTable({
    processing: true,
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl+'/datatable/user/price',
      data : x => Object.assign(x, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Tarif - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Tarif'
      },
    ],

    columns:[
      {data:"grup_nota.slug", name:"grup_nota.slug"},
      {data:"service.name", name:"service.name"},
      {
        data:null, 
        name:'service.price',
        searchable : false,
        className: 'text-right',
        render : resp => $filter('number')(resp.service.price)
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center capitalize',
        render : function(resp) {
            if(resp.is_registration == 1 || resp.is_sewa_ruangan == 1 || resp.is_sewa_alkes == 1) {
                var outp = []
                if(resp.is_registration == 1) {
                  outp.push('Administrasi')
                } 
                if(resp.is_sewa_ruangan == 1) {
                  outp.push('Sewa ruangan')
                } 
                 if(resp.is_sewa_alkes == 1) {
                  outp.push('Sewa alkes')
                }
                return outp.join(',');
            } else {
                if(resp.destination == 'POLIKLINIK') {
                    return 'Poliklinik ' + resp.polyclinic.name
                } else {
                    return resp.destination ? resp.destination.toLowerCase() : ''
                }
            }
        }
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => resp.is_active == 1 ? '<label class="label label-success">Aktif</label>' : '<label class="label label-danger">Tidak Aktif</label>'
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => 
        "<div class='btn-group'>" + 
        ( 
          resp.is_active == 1 ? "<button allow_destroy_price class='btn btn-xs btn-danger' ng-click='delete(" + resp.id + ")' title='Non-aktifkan'><i class='fa fa-trash-o'></i></button>"
          : "<button allow_activate_price class='btn btn-xs btn-primary' ng-click='activate(" + resp.id + ")' title='Aktifkan'><i class='fa fa-check'></i></button>"
        ) +
        "<a allow_edit_price class='btn btn-xs btn-success' href='" + baseUrl + "/price/edit/" + resp.id +  "' title='Edit'><i class='fa fa-pencil'></i></a><a allow_show_price class='btn btn-xs btn-default' href='" + baseUrl + "/price/" + resp.id +  "' title='Detail'><i class='fa fa-file-text-o'></i></a></div>"
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

  $scope.filter = function() {
    oTable.ajax.reload()
  }

  oTable.buttons().container().appendTo( '.export_button' );

  $scope.delete = function(id) {
    is_delete = confirm('Apakah anda ingin menon-aktifkan data ini ?');
    if(is_delete)
        $http.delete(baseUrl + '/controller/user/price/' + id).then(function(data) {
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
          $http.put(baseUrl + '/controller/user/price/activate/' + id).then(function(data) {
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