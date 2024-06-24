@if (isset($delete_device))
<a href ='#' onclick="delete_device('{!! $delete_device !!}')" class='btn btn-default'><i class="ph-trash me-2"></i></a>
@endif

@if (isset($edit_device))
<a href ='#' onclick="edit_device('{!! $edit_device !!}')" class='btn btn-default'><i class="ph-squares-four me-2"></i></a>
@endif