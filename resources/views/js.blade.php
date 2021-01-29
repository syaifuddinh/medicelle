<script src="{{ asset('') }}js/cached.js"></script>
<script>
        requireCSS('css.bootstrap', '1.0', '{{ asset('') }}vendors/bootstrap/dist/css/bootstrap.min.css', function(){
            requireCSS('css.classic', '1.0', "{{ asset('') }}css/classic.css")
            requireCSS('css.classic.date', '1.0', "{{ asset('') }}css/classic.date.css")
            requireCSS('css.classic.time', '1.0', "{{ asset('') }}css/classic.time.css")
            requireCSS('css.font-awesome', '1.1', "{{ asset('') }}vendors/font-awesome/css/font-awesome.min.css")
            requireCSS('css.toastr', '1.0', "{{ asset('') }}css/toastr.css")
            requireCSS('css.bootstrap-chosen', '1.0', "{{ asset('') }}css/bootstrap-chosen.css")
            requireCSS('css.custom', '1.0', "{{ asset('') }}build/css/custom.min.css")
            requireCSS('css.dataTables', '1.0', "{{ asset('') }}vendors/datatables.net-bs/css/dataTables.bootstrap.min.css")
            requireCSS('css.select2', '1.0', "{{ asset('') }}vendors/select2/dist/css/select2.min.css")
        })
    </script>