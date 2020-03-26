@extends('system-mgmt.portfolio.base')
@section('action-content')
<style>
.responsive {
width: 100%;
height: auto;
}

</style>
    <!-- Main content -->

    <section class="content">

      <div class="box">

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
            //<img class="responsive" src="'.$src.'"  >
            if($re->type == 'vnd.ms-excel'){
              echo '<iframe width="100%" height="800px"  src="'.$src.'"  ></iframe>';

            }
          echo '<img class="responsive" src="'.$src.'"  >';

          ?>




            @endforeach
            @foreach ($filepdf as $key =>$pdf)
            <?php
          //  return $pdf->physical_path;
            $imageroot = '\app'.'\\'.$pdf->physical_path;
            $image =storage_path('app/')."\\".$pdf->physical_path;
            // Read image path, convert to base64 encoding
            $imageData = base64_encode(file_get_contents($image));

            // Format the image SRC:  data:{mime};base64,{data};
            $src = 'data: '.mime_content_type($image).';base64,'.$imageData;

            // Echo out a sample image
            //echo '<img src="' . $src . '">';
              //<img class="responsive" src="'.$src.'"  >
            echo '<iframe width="100%" height="800px"  src="'.$src.'"  ></iframe>';
          //  echo $image;
          //  <iframe width="100%" height="800px"  src="{{ URL::to($pdf->physical_path) }}"  ></iframe>
            ?>





              @endforeach
            <br />
            <br />



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
