<div class="modal-header">
  <h6 class="modal-title">Detail {{ $item->title }}</h6>
  <button type="button" class="close" data-dismiss="modal" aria-label="close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <dl class="row">
    <dt class="col-sm-4">Title</dt>
    <dd class="col-sm-8">: {{ $item->title }}</dd>
    <dt class="col-sm-4">Location</dt>
    <dd class="col-sm-8">: {{ $item->location }}</dd>
    <dt class="col-sm-4">About</dt>
    <dd class="col-sm-8">: {!! $item->about !!}</dd>
    <dt class="col-sm-4">Featured Event</dt>
    <dd class="col-sm-8">: {{ $item->featured_event }}</dd>
    <dt class="col-sm-4">Language</dt>
    <dd class="col-sm-8">: {{ $item->language }}</dd>
    <dt class="col-sm-4">Foods</dt>
    <dd class="col-sm-8">: {{ $item->foods }}</dd>
    <dt class="col-sm-4">Departure Date</dt>
    <dd class="col-sm-8">: {{ $item->departure_date }}</dd>
    <dt class="col-sm-4">Duration</dt>
    <dd class="col-sm-8">: {{ $item->duration }}</dd>
    <dt class="col-sm-4">Type</dt>
    <dd class="col-sm-8">: {{ $item->type }}</dd>
    <dt class="col-sm-4">Price</dt>
    <dd class="col-sm-8">: {{ $item->price }}</dd>
  </dl>
</div>