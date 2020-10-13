app.controller('medicalBill', ['$scope', '$rootScope', '$compile', '$http', '$filter', function($scope, $rootScope, $compile, $http, $filter) {
  $scope.formData = {}
  $scope.data = {}
  var path = window.location.pathname;

  $scope.showTable = function() {
    var columns = [
          {
            data:'code', 
            name:'invoices.code' 
          },
          {
            data:'patient_name', 
            name:'contacts.name' 
          },
          {
            data:null, 
            searchable : false,
            name:'invoices.date',
            render : x => $filter('fullDate')(x.date)
          },
          {
            data:null, 
            className : 'text-right',
            searchable:false,
            name : 'invoices.netto',
            render : x => $filter('number')(x.netto)
          }
    ]
    
    $scope.data.grup_nota.reverse()
    for(g in $scope.data.grup_nota) {
        columns.push({
            data:'col' + $scope.data.grup_nota[g].id, 
            className : 'text-right additional',
            searchable:false,
            orderable:false,
        })
    }

    columns.push({
        data:null, 
        className : 'text-right',
        searchable:false,
        name : 'invoices.paid',
        render : x => $filter('number')(x.paid)
    })
    columns.push({
        data:'status', 
        searchable:false,
        orderable:false
    })
    oTable = $('#listview').DataTable({
    processing: true,
    order:[[1, 'desc']],
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl + '/datatable/report/medical_bill',
      data : d => Object.assign(d, $scope.formData)
    },
    buttons: [
      {
        'extend' : 'excel',
        'enabled' : true,
        'text' : '<span class="fa fa-file-excel-o"></span> Export Excel',
        'className' : 'btn btn-default btn-sm',
        'filename' : 'Laporan Tagihan Pemeriksaan - '+new Date(),
        'sheetName' : 'Data',
        'title' : 'Laporan Tagihan Pemeriksaan'
      },
    ],

    'columns': columns,
        createdRow: function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
        }
      });
    oTable.buttons().container().appendTo( '.export_button' );
  }

 $scope.grup_nota = function() {
      $http.get(baseUrl + '/controller/user/grup_nota').then(function(data) {
        $scope.data.grup_nota = data.data
        var newCol, dt
        var cols = data.data
        cols.reverse()
        for(g in cols) {
            dt = cols[g]
            newCol = $('<th>' + dt.name + '</th>')
            $('.bill_col').after(newCol)
        }
        $scope.showTable()
      }, function(error) {
        $rootScope.disBtn=false;
        $scope.grup_nota()
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
  $scope.grup_nota()

  $scope.filter = function() {
    oTable.ajax.reload();
  }


}]);