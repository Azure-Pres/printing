<a href="{{url('admin/templates/update/'.encrypt($template->id))}}" class="btn btn-outline-primary btn-icon-text">
  Edit
  <i class="typcn typcn-document btn-icon-append"></i>                          
</a>

<a target="_blank" href="{{url('qr-pdf/'.encrypt($template->id))}}" class="btn btn-outline-primary btn-icon-text">
  Preview
  <i class="typcn typcn-document btn-icon-append"></i>                          
</a>