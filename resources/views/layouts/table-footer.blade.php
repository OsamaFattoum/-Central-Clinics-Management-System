
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>


<!--Internal  Datatable js -->
<script>
    let targets = @json($targetsNotOrdered);
    let searching = @json(isset($searching) ? $searching : true);
    let lengthChange = @json(isset($lengthChange) ? $lengthChange : true);
  
    $('#example1').DataTable({
        pagingType: 'full_numbers',
        lengthChange: lengthChange,
        searching: searching,
		language: {         
            "emptyTable": "{{ __('data_table.emptyTable') }}",
            "info": "{{ __('data_table.info') }}",
            "infoEmpty": "{{ __('data_table.infoEmpty') }}",
            "infoFiltered": "{{ __('data_table.infoFiltered') }}",
            "thousands": ",",
            "lengthMenu": "_MENU_",
            "loadingRecords": "{{ __('data_table.loadingRecords') }}",
            "search": "",
            'searchPlaceholder' : "{{ __('data_table.searchPlaceholder') }}",
            "zeroRecords": "{{ __('data_table.zeroRecords') }}",
            "paginate": {
                "first": "{{ __('data_table.first') }}",
                "last": "{{ __('data_table.last') }}",
                "next": "{{ __('data_table.next') }}",
                "previous": "{{ __('data_table.previous') }}"
            },
            "aria": {
                "orderable": "{{ __('data_table.orderable') }}",
                "orderableReverse": "{{ __('data_table.orderableReverse') }}"
            },
		},
        columnDefs: [ { orderable: false,targets:targets}],
        order: [["{{ $orderIndex }}", 'asc']]
     
	});
</script>

{{-- bulk delete code --}}
<script src="{{URL::asset('assets/js/bulk-delete.js')}}"></script>
