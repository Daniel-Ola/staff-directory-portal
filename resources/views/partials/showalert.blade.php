<div class="alert alert-{{ $status ?? 'info' }} alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>{{ $message ?? 'Something just happened, please contact support' }}</strong> 
</div>