app.controller('medicalPayment', ['$scope', '$rootScope', '$compile', '$http', '$filter', function($scope, $rootScope, $compile, $http, $filter) {
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
          },
          {
            data:null, 
            className : 'text-right',
            searchable:false,
            orderable : false,
            render : x => $filter('number')(x.debit)
          },
          {
            data:null, 
            className : 'text-right',
            searchable:false,
            orderable : false,
            render : x => $filter('number')(x.kredit)
          },
          {
            data:null, 
            className : 'text-right',
            searchable:false,
            orderable : false,
            render : x => $filter('number')(x.master)
          },
          {
            data:null, 
            className : 'text-right',
            searchable:false,
            orderable : false,
            render : x => $filter('number')(x.tt)
          },
          {
            data:null, 
            className : 'text-right',
            searchable:false,
            orderable : false,
            render : x => $filter('number')(x.tunai)
          },
          {
            data:null, 
            className : 'text-right',
            searchable:false,
            orderable : false,
            render : x => $filter('number')(x.visa)
          }
    ]

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
    order:[[2, 'desc']],
    serverSide: true,
    dom: 'Blfrtip',
    ajax: {
      url : baseUrl + '/datatable/report/medical_payment',
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

  $scope.showTable()

  $scope.filter = function() {
    oTable.ajax.reload();
  }


}]);