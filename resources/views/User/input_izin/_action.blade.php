<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="ph-list"></i>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        @if (isset($detail))
        <a href ='#' onclick="getDetailIzinData('{!! $detail !!}')" class='bg-hover btn btn-default' style="width: 100%"><i class="ph-eye"></i>&nbsp Detail</a>
        @endif
        @if (isset($delete))
          @if($status == 'APPROVAL WALIKELAS')
            <a href ='#' onclick="deleteIzin('{!! $delete !!}')" class='bg-hover btn btn-default' style="width: 100%"><i class="ph-trash"></i>&nbsp Delete</a>
          @endif
        @endif
    </ul>
</div>