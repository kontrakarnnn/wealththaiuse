@extends('system-mgmt.portfolio.base')
@section('action-content')

    <!-- Main content -->
    <style>
    .card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card>hr{margin-right:0;margin-left:0}.card>.list-group:first-child .list-group-item:first-child{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card>.list-group:last-child .list-group-item:last-child{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-subtitle{margin-top:-.375rem;margin-bottom:0}.card-text:last-child{margin-bottom:0}.card-link:hover{text-decoration:none}.card-link+.card-link{margin-left:1.25rem}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(.25rem - 1px) calc(.25rem - 1px) 0 0}.card-header+.list-group .list-group-item:first-child{border-top:0}.card-footer{padding:.75rem 1.25rem;background-color:rgba(0,0,0,.03);border-top:1px solid rgba(0,0,0,.125)}.card-footer:last-child{border-radius:0 0 calc(.25rem - 1px) calc(.25rem - 1px)}.card-header-tabs{margin-right:-.625rem;margin-bottom:-.75rem;margin-left:-.625rem;border-bottom:0}.card-header-pills{margin-right:-.625rem;margin-left:-.625rem}.card-img-overlay{position:absolute;top:0;right:0;bottom:0;left:0;padding:1.25rem}.card-img{width:100%;border-radius:calc(.25rem - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(.25rem - 1px);border-top-right-radius:calc(.25rem - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(.25rem - 1px);border-bottom-left-radius:calc(.25rem - 1px)}.card-deck{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-deck .card{margin-bottom:15px}@media (min-width:576px){.card-deck{-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}.card-deck .card{display:-ms-flexbox;display:flex;-ms-flex:1 0 0%;flex:1 0 0%;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-bottom:0;margin-left:15px}}.card-group{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-group>.card{margin-bottom:15px}@media (min-width:576px){.card-group{-ms-flex-flow:row wrap;flex-flow:row wrap}.card-group>.card{-ms-flex:1 0 0%;flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-header,.card-group>.card:first-child .card-img-top{border-top-right-radius:0}.card-group>.card:first-child .card-footer,.card-group>.card:first-child .card-img-bottom{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-header,.card-group>.card:last-child .card-img-top{border-top-left-radius:0}.card-group>.card:last-child .card-footer,.card-group>.card:last-child .card-img-bottom{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:.25rem}.card-group>.card:only-child .card-header,.card-group>.card:only-child .card-img-top{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card-group>.card:only-child .card-footer,.card-group>.card:only-child .card-img-bottom{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top{border-radius:0}}.card-columns .card{margin-bottom:.75rem}@media (min-width:576px){.card-columns{-webkit-column-count:3;-moz-column-count:3;column-count:3;-webkit-column-gap:1.25rem;-moz-column-gap:1.25rem;column-gap:1.25rem;orphans:1;widows:1}.card-columns .card{display:inline-block;width:100%}}.accordion .card:not(:first-of-type):not(:last-of-type){border-bottom:0;border-radius:0}.accordion .card:not(:first-of-type) .card-header:first-child{border-radius:0}.accordion .card:first-of-type{border-bottom:0;border-bottom-right-radius:0;border-bottom-left-radius:0}.accordion .card:last-of-type{border-top-left-radius:0;border-top-right-radius:0}

    * {
      box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column {
      float: left;
      width: 50%;
      padding: 10px;
     /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
      .column {
        width: 100%;
      }
    }
    .container2 {
      display: inline-block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 15px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default radio button */
    .container2 input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
    }

    /* Create a custom radio button */
    .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #BDBDB9;
      border-radius: 50%;
    }

    /* On mouse-over, add a grey background color */
    .container2:hover input ~ .checkmark {
      background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .container2 input:checked ~ .checkmark {
      background-color: #2196F3;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .checkmark:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .container2 input:checked ~ .checkmark:after {
      display: block;
    }

    /* Style the indicator (dot/circle) */
    .container2 .checkmark:after {
    top: 9px;
    left: 9px;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: white;
    }


      .form-control2{
      padding: 10px;
      width: 100%;

      font-family: Raleway;
      border: 1px solid #aaaaaa;

    }
    input {
      padding: 10px;
      width: 100%;
      font-size: 17px;
      font-family: Raleway;
      border: 1px solid #aaaaaa;
    }
    body {
      background-image: url(../img/home4.jpg);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    }
    h2,
    h4 {
      margin-top: 0;
    }
    .form {

      background: #ffffff;
      box-shadow: 0 5px 10px rgba(0, 0, 0, .4);
      margin: 4em;
      min-width: 480px;
      padding: 1em;
      border: 5px solid #FFFFFF;
     border-radius: 12px;
    }
    .wizard {
      margin: 20px auto;
      background: #fff;
    }

      .wizard .nav-tabs {
          position: relative;
          margin: 40px auto;
          margin-bottom: 0;
          border-bottom-color: #e0e0e0;
      }

      .wizard > div.wizard-inner {
          position: relative;
      }

    .connecting-line {
      height: 2px;
      background: #3e5e9a;
      position: absolute;
      width: 80%;
      margin: 0 auto;
      left: 0;
      right: 0;
      top: 50%;
      z-index: 1;
    }

    .wizard .nav-tabs > li.active > a, .wizard .nav-tabs > li.active > a:hover, .wizard .nav-tabs > li.active > a:focus {
      color: #3e5e9a;
      cursor: default;
      border: 0;
      border-bottom-color: transparent;
    }

    span.round-tab {
      width: 70px;
      height: 70px;
      line-height: 70px;
      display: inline-block;
      border-radius: 100px;
      background: #fff;
      border: 2px solid #3e5e9a;
      z-index: 2;
      position: absolute;
      left: 0;
      text-align: center;
      font-size: 25px;
    }
    span.round-tab i{
      color:#3e5e9a;

    }
    .wizard li.active span.round-tab {
      background: #fff;
      border: 2px solid #999;

    }
    .wizard li.active span.round-tab i{
      color: #999;
    }

    span.round-tab:hover {
      color: #333;
      border: 2px solid #333;
    }

    .wizard .nav-tabs > li {
      width: 25%;
    }

    .wizard li:after {
      content: " ";
      position: absolute;
      left: 46%;
      opacity: 0;
      margin: 0 auto;
      bottom: 0px;
      border: 5px solid transparent;
      border-bottom-color: #5bc0de;
      transition: 0.1s ease-in-out;
    }

    .wizard li.active:after {
      content: " ";
      position: absolute;
      left: 46%;
      opacity: 1;
      margin: 0 auto;
      bottom: 0px;
      border: 10px solid transparent;
      border-bottom-color: #5bc0de;
    }

    .wizard .nav-tabs > li a {
      width: 70px;
      height: 70px;
      margin: 20px auto;
      border-radius: 100%;
      padding: 0;
    }

      .wizard .nav-tabs > li a:hover {
          background: transparent;
      }

    .wizard .tab-pane {
      position: relative;
      padding-top: 50px;
    }

    .wizard h3 {
      margin-top: 0;
    }

    @media( max-width : 585px ) {

      .wizard {
          width: 90%;
          height: auto !important;
      }

      span.round-tab {
          font-size: 16px;
          width: 50px;
          height: 50px;
          line-height: 50px;
      }

      .wizard .nav-tabs > li a {
          width: 50px;
          height: 50px;
          line-height: 50px;
      }

      .wizard li.active:after {
          content: " ";
          position: absolute;
          left: 35%;
      }



    }


    .card-header{
      background-color:#00325d;				;
      color:white;
    }
    .responsive {
  width: 100%;
  height: auto;
}
.iframe-container {
    position: relative;
    overflow: hidden;
    padding-top: 56.25%;
}
.iframe-container iframe {
  position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}

    </style>
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
        <div class="card" >
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
          echo '<img class="responsive" src="'.$src.'"  >';

          ?>




            @endforeach
            @foreach ($filepdf as $key =>$pdf)
            <?php
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
