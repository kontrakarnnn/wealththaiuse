@extends('system-mgmt.portfolio.base')
@section('action-content')

    <!-- Main content -->

    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of Port</h3>

        </div>

    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>

    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		<div class="row">
      </div>
      <div class="row">
        <div class="col-sm-12">
			<div style="overflow-x:auto;">
        <div class="card"  >
          @foreach ($file as $key =>$re)
          <?php
          $imageroot = '\app'.'\\'.$re->physical_path;
          $image =storage_path('app/')."\\".$re->physical_path;
          // Read image path, convert to base64 encoding
          $imageData = base64_encode(file_get_contents($image));

          // Format the image SRC:  data:{mime};base64,{data};
          $src = 'data: '.mime_content_type($image).';base64,'.$imageData;

          // Echo out a sample image
          //echo '<img src="' . $src . '">';

          echo '<img  src="'.$src.'" width="460" height="345" alt="Card image cap">';

          ?>




            @endforeach
            <br />
            <br />
            @foreach ($files as $key =>$re)
            <a href="{{ asset('app/'.$re->physical_path) }}" >เอกสาร{{++$key}}</a>

            @endforeach


		</div>

        </div>
      </div>

    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>
@endsection
