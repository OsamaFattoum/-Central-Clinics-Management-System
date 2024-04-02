<script>
    $(".select2").select2({
        minimumResultsForSearch: Infinity,
        placeholder: "{{ __('site.select_package_placeholder') }}",
    });
    $('.select2-no-search').select2({
			minimumResultsForSearch: Infinity,
			placeholder: "{{ __('site.select_package_placeholder') }}",
            
	});
</script>