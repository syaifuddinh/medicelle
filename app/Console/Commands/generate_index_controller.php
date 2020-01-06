<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class generate_index_controller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:index_controller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
       
        $features = config('app.features');
        foreach($features as $x) {
            foreach($x['child'] as $y) {
                // Membuat file
                $controller_name = str_replace('_', ' ', trim($y['slug']));
                $controller_name = ucwords($controller_name);
                $controller_name = preg_replace('/(\s)/', '', $controller_name);
                $api_path = $x['slug'] . '/' . $y['slug'];
                $page = '
                app.controller("ControllerName", function($scope, $compile, $http, $filter){
    $scope.formData = {};
    $scope.data = {};

  $http.get("get_url(\'APIPath\')").then(function(data) {
    $scope.data=data.data;
  });


    oTable = $("#datatable").DataTable({
    processing: true,
    serverSide: true,
    ajax: {  
      url : get_url("DatatablePath"),
      data : function(d) {
        FilterColumn
        
        return d;
      }
    },
    columns:[
      ColumnName
      {
        data:null,
        name:"action",
        className : "text-center",
        render : function(resp) {
          var id = resp.id;
          var outp = "<div class=\"btn-group\"><button class=\"btn btn-info btn-xs\" title=\"Detail\" ng-click=\"detailData(" + id + ")\" ><i class=\"mdi mdi-folder\"></i></button><button class=\"btn btn-danger btn-xs\" title=\"Delete\" ng-click=\"deleteData(" + id + ")\"><i class=\"mdi mdi-delete\"></i></button></div>";

          return outp;
        }
      },
      // {data:"action",name:"action",className:"text-center"},
    ],
    createdRow: function(row, data, dataIndex) {
      $compile(angular.element(row).contents())($scope);
    }
  });

  $scope.deleteData=function(ids) {
    var cfs=confirm("Apakah Anda Yakin?");
    if (cfs) {
      $http.delete( get_url("APIPath") ).then(function success(data) {
        // $state.reload();
        oTable.ajax.reload();
        toastr.success("Data Berhasil Dihapus!");
      }, function error(data) {
        toastr.error("Tidak dapat menghapus data karna sudah tercatat transaksi!","Error Has Found!");
      });
    }
  }

  $scope.detailData=function(ids) {
    location.href = "http://" + location.host + location.pathname + "/show/" + ids;
  }

    $scope.resetData = function() {
        $scope.formData = {};
    }

    $scope.formData.id_customer = 3;
    // $("[ng-model="formData.is_active"]").select2();

});

                ';   
                // Generate filter
                $filter_fields = "";
                $filter_column = '';
                $column_name = '';
                if(array_key_exists('index', $y)) {
                    if(array_key_exists('column', $y['index'])) {

                        if(array_key_exists('filter', $y['index'])) {

                            foreach ($y['index']['filter'] as $filter) {
                                if(preg_match('/date/', $filter['column']) == true) {

                                    $filter_column .= "d." . $filter['column'] . "_start = \$scope.formData." . $filter['column'] . "_start;\n";
                                    $filter_column .= "d." . $filter['column'] . "_end = \$scope.formData." . $filter['column'] . "_end;\n";
                                }
                                else {
                                    $filter_column .= "d." . $filter['column'] . " = \$scope.formData.{\$filter['column']};\n";
                                }
                            }

                            foreach ($y['index']['column'] as $column) {
                                $nickname = '';
                                if( preg_match('/date/', $column) == true ) {
                                    $column_name .= "{
                                        data:null,
                                        name:\"$column\",
                                        render: function(resp) {
                                            return \$filter('fullDate')(resp.\$column);
                                        }
                                    },\n";
                                }
                                else if( preg_match('/id_.+/', $column) == true ) {
                                    if( preg_match('/id_.+_header/', $column) == true ) {
                                        $nickname = preg_replace('/id_(.+)_header/',  '$1_header.$1_number', $column); 
                                        $column_name .= "{data:\"$nickname\",name:\"$nickname\"},\n";
                                    }
                                    else {

                                        $nickname = preg_replace('/id_(.+)/',  'master_$1.$1_name', $column); 
                                        $column_name .= "{data:\"$nickname\",name:\"$nickname\"},\n";
                                    }

                                }
                                else {
                                    $column_name .= "{data:\"$column\",name:\"$column\"},\n";
                                }
                            }
                        }


                    }


                    $page = str_replace('ColumnName', $column_name, $page);
                    $page = str_replace('FilterColumn', $filter_column, $page);
                    $page = str_replace('ControllerName', $controller_name, $page);
                    $page = str_replace('APIPath', $api_path, $page);
                    $page = str_replace('DatatablePath', $api_path . '/datatable', $page);

                    
                    $path = 'public/controller/' . $x['slug'] . '/' . $controller_name . 'Ctrl.js';
                    $this->createDir($path);
                    File::put($path, $page);
                }
            }
        }
    }

    public function createDir($path)
    {
        $dir = dirname($path);

        if (!file_exists($dir))
        {
            mkdir($dir, 0777, true);
        }
    }
}
