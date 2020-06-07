app.controller('cashier', ['$scope', '$compile', '$http', '$filter', function($scope, $compile, $http, $filter) {
  var currentDate = new Date()
  var date = currentDate.getFullYear() + '-' + ( currentDate.getMonth() + 1 ).toString().padStart(2, 0) + '-' + currentDate.getDate().toString().padStart(2, 0)
  $scope.formData = {
      'date_end' : date 
  }
  setTimeout(function () {    
        $('[ng-model="formData.date_end"]').val( $filter('fullDate')($scope.formData.date_end))
  }, 300)
  
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
        name:"code",
        render : function(resp) {
            var url = '#'
            if(roles['allow_show_cashier'] == 1) {
                url = baseUrl + "/cashier/" + resp.id
            } 
            return "<a class='' href='" + url +  "'>" + resp.code + "</a>"
        } 
      },
      {data:"registration.code", name:"registration.code"},
      {data:"registration.medical_record.code", name:"registration.medical_record.code"},
      {
        data:null, 
        orderable:false,
        searchable:false,
        render: resp => $filter('fullDate')(resp.date)
      },
      {
        data:null, 
        name:"registration.patient.name",
        render: function(resp) {
            var url = '#'
            if(roles['allow_show_patient'] == 1) {
                url = baseUrl + "/patient/" + resp.registration.patient_id
            }
            return "<a href='" + url +  "'>" + resp.registration.patient.name + "</a>"
        } 
      },
      {
        data: null, 
        orderable : false,
        searchable : false,
        className : 'text-center',
        render : resp => resp.status == 1 ? '<label class="label label-danger">' + resp.status_name + '</label>' : (resp.status != 5  ? '<label class="label label-success">' + resp.status_name + '</label>' : '<label class="label label-primary">' + resp.status_name + '</label>')
      },
      {
        data: null, 
        orderable : false,
        width:'17mm',
        searchable : false,
        className : 'text-center',
        render : resp => (resp.status != 3 && resp.status != 5 ? "<div class='btn-group'><a allow_edit_cashier class='btn btn-xs btn-success' href='" + baseUrl + "/cashier/pay/" + resp.id +  "' title='Bayar'><i class='fa fa-pencil'></i></a>" : '') +
        "<a class='btn btn-xs btn-default' allow_show_cashier href='" + baseUrl + "/cashier/" + resp.id +  "' title='Detail'><i class='fa fa-file-text-o'></i></a></div>"
      },
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    },
    initComplete : function() {
        var cashierTable = this.api()
        setInterval(function(){
            cashierTable.ajax.reload()
        }, 20000)
    }
  });
  oTable.buttons().container().appendTo( '.export_button' );
  
  $scope.filter = function() {
    is_date = /\d+-\d+-\d+/
    if(is_date.test($scope.formData.date_start) || is_date.test($scope.formData.date_end)) {
      
      oTable.ajax.reload()
    }
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