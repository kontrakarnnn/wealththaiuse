<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('view.update', ['id' => $serviccenter->id]) }}">
      <div class="modal-body">

        <p>{{$serviccenter->id}}</p>
          <input>
            <p>Some text in the modal.</p>
              <p>Some text in the modal.</p>
                <p>Some text in the modal.</p>
                  <p>Some text in the modal.</p>
                    <p>Some text in the modal.</p>
                      <p>Some text in the modal.</p>
                        <p>Some text in the modal.</p>
                          <p>Some text in the modal.</p>
                            <p>Some text in the modal.</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
