@if (isset($delete_data))
<a href ='#' onclick="delete_device('{!! $delete_data !!}')" class='btn btn-default'><i class="ph-trash me-2"></i></a>
@endif

@if (isset($edit_data))
<a href ='#' onclick="edit_device('{!! $edit_data !!}')" class='btn btn-default'><i class="ph-squares-four me-2"></i></a>
@endif