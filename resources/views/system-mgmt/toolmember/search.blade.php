@extends('system-mgmt.toolmember.base')
@section('action-content')
    <!-- Main content -->


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <style>
    .card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card>hr{margin-right:0;margin-left:0}.card>.list-group:first-child .list-group-item:first-child{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card>.list-group:last-child .list-group-item:last-child{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-subtitle{margin-top:-.375rem;margin-bottom:0}.card-text:last-child{margin-bottom:0}.card-link:hover{text-decoration:none}.card-link+.card-link{margin-left:1.25rem}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(.25rem - 1px) calc(.25rem - 1px) 0 0}.card-header+.list-group .list-group-item:first-child{border-top:0}.card-footer{padding:.75rem 1.25rem;background-color:rgba(0,0,0,.03);border-top:1px solid rgba(0,0,0,.125)}.card-footer:last-child{border-radius:0 0 calc(.25rem - 1px) calc(.25rem - 1px)}.card-header-tabs{margin-right:-.625rem;margin-bottom:-.75rem;margin-left:-.625rem;border-bottom:0}.card-header-pills{margin-right:-.625rem;margin-left:-.625rem}.card-img-overlay{position:absolute;top:0;right:0;bottom:0;left:0;padding:1.25rem}.card-img{width:100%;border-radius:calc(.25rem - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(.25rem - 1px);border-top-right-radius:calc(.25rem - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(.25rem - 1px);border-bottom-left-radius:calc(.25rem - 1px)}.card-deck{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-deck .card{margin-bottom:15px}@media (min-width:576px){.card-deck{-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}.card-deck .card{display:-ms-flexbox;display:flex;-ms-flex:1 0 0%;flex:1 0 0%;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-bottom:0;margin-left:15px}}.card-group{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-group>.card{margin-bottom:15px}@media (min-width:576px){.card-group{-ms-flex-flow:row wrap;flex-flow:row wrap}.card-group>.card{-ms-flex:1 0 0%;flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-header,.card-group>.card:first-child .card-img-top{border-top-right-radius:0}.card-group>.card:first-child .card-footer,.card-group>.card:first-child .card-img-bottom{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-header,.card-group>.card:last-child .card-img-top{border-top-left-radius:0}.card-group>.card:last-child .card-footer,.card-group>.card:last-child .card-img-bottom{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:.25rem}.card-group>.card:only-child .card-header,.card-group>.card:only-child .card-img-top{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card-group>.card:only-child .card-footer,.card-group>.card:only-child .card-img-bottom{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top{border-radius:0}}.card-columns .card{margin-bottom:.75rem}@media (min-width:576px){.card-columns{-webkit-column-count:3;-moz-column-count:3;column-count:3;-webkit-column-gap:1.25rem;-moz-column-gap:1.25rem;column-gap:1.25rem;orphans:1;widows:1}.card-columns .card{display:inline-block;width:100%}}.accordion .card:not(:first-of-type):not(:last-of-type){border-bottom:0;border-radius:0}.accordion .card:not(:first-of-type) .card-header:first-child{border-radius:0}.accordion .card:first-of-type{border-bottom:0;border-bottom-right-radius:0;border-bottom-left-radius:0}.accordion .card:last-of-type{border-top-left-radius:0;border-top-right-radius:0}

    <style>


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

    .table-borderless > tbody > tr > td,
    .table-borderless > tbody > tr > th,
    .table-borderless > tfoot > tr > td,
    .table-borderless > tfoot > tr > th,
    .table-borderless > thead > tr > td,
    .table-borderless > thead > tr > th {
        border: none;
    }
    @import url(http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css);
    .col-item
    {
        border: 1px solid #E1E1E1;
        border-radius: 5px;
        background: #FFF;
    }
    .col-item .photo img
    {
        margin: 0 auto;
        width: 100%;
    }

    .col-item .info
    {
        padding: 10px;
        border-radius: 0 0 5px 5px;
        margin-top: 1px;
    }

    .col-item:hover .info {
        background-color: #F5F5DC;
    }
    .col-item .price
    {
        /*width: 50%;*/
        float: left;
        margin-top: 5px;
    }

    .col-item .price h5
    {
        line-height: 20px;
        margin: 0;
    }

    .price-text-color
    {
        color: #219FD1;
    }

    .col-item .info .rating
    {
        color: #777;
    }

    .col-item .rating
    {
        /*width: 50%;*/
        float: left;
        font-size: 17px;
        text-align: right;
        line-height: 52px;
        margin-bottom: 10px;
        height: 52px;
    }

    .col-item .separator
    {
        border-top: 1px solid #E1E1E1;
    }

    .clear-left
    {
        clear: left;
    }

    .col-item .separator p
    {
        line-height: 20px;
        margin-bottom: 0;
        margin-top: 10px;
        text-align: center;
    }

    .col-item .separator p i
    {
        margin-right: 5px;
    }
    .col-item .btn-add
    {
        width: 50%;
        float: left;
    }

    .col-item .btn-add
    {
        border-right: 1px solid #E1E1E1;
    }

    .col-item .btn-details
    {
        width: 50%;
        float: left;
        padding-left: 10px;
    }
    .controls
    {
        margin-top: 20px;
    }
    [data-slide="prev"]
    {
        margin-right: 10px;
    }

    </style>

    <section class="content">

      <div class="box">
  <div class="box-header">
<h3 class="box-title">Products</h3>
</div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('toolmember.search') }}">
         {{ csrf_field() }}
         @component('layouts.searchmarketplace', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent
          <br />
          <div class="row">

            <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Product Type</label>
                  <div class="col-md-9">

                    <select  class="form-control" name="tool_type">
                      <option value="" ></option>
                      @foreach ($tooltype as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>
          {{--}}  <div class="col-md-6">
              <div class="form-group">

                  <label for="file_category_name" class="col-sm-3 control-label">Tool Category</label>
                  <div class="col-md-9">

                    <select  class="form-control" name="cat_id">
                      <option value="" ></option>
                      @foreach ($toolcat as $sta)
                          <option value="{{$sta->id}}">{{$sta->name}}</option>
                      @endforeach
                    </select>

                </div>

              </div>
            </div>--}}


          </div>
          <br />
        @endcomponent
      </form>
      
	  <a class="btn btn-primary" href="/toolmember">Show All Tool </a>


    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            @foreach ($data as $type=> $serviccente)
              <div class="col-sm-3">
                  <br />
                  <div class="col-item">
                      <div class="photo">
                        @if($serviccente->attachment !=NULL)
                        <?php
                        $imageroot = '\tool'.'\\'.$serviccente->attachment;
                        $image =public_path('tool')."/".$serviccente->attachment;
                      // Read image path, convert to base64 encoding
                      $imageData = base64_encode(file_get_contents($image));

                      // Format the image SRC:  data:{mime};base64,{data};
                      $src = 'data: '.mime_content_type($image).';base64,'.$imageData;

                      // Echo out a sample image
                      //echo '<img src="' . $src . '">';

                       echo '<a href="/toolmember/toolset/'.$serviccente->id.'"><img class="img-responsive" src="'.$src.'" alt="{{$serviccente->name}}"></a>';
                      ?>
                        @endif
                      </div>
                      <div class="info">
                          <div class="row">
                              <div class="price col-md-6">
                                  <h5>
                                      {{$serviccente->name}}</h5>
                                  <h5 class="price-text-color">
                                      Version : {{$serviccente->last_version}}</h5>
                              </div>
                              <div class="rating hidden-sm col-md-6">
                                @if($serviccente->star == 1)
                                <i class="price-text-color fa fa-star"></i>
                                @elseif($serviccente->star == 2)
                                <i class="price-text-color fa fa-star"></i>
                                <i class="price-text-color fa fa-star"></i>
                                @elseif($serviccente->star == 3)
                                <i class="price-text-color fa fa-star"></i>
                                <i class="price-text-color fa fa-star"></i>
                                <i class="price-text-color fa fa-star"></i>
                                @elseif($serviccente->star == 4)
                                <i class="price-text-color fa fa-star"></i>
                                <i class="price-text-color fa fa-star"></i>
                                <i class="price-text-color fa fa-star"></i>
                                <i class="price-text-color fa fa-star"></i>
                                @elseif($serviccente->star == 5)
                                <i class="price-text-color fa fa-star"></i>
                                <i class="price-text-color fa fa-star"></i>
                                <i class="price-text-color fa fa-star"></i>
                                <i class="price-text-color fa fa-star"></i>
                                <i class="price-text-color fa fa-star"></i>
                                @else
                                @endif

                              </div>
                          </div>
                          <div class="separator clear-left">

                              <p class="btn-details" style="margin-left:22%;">
                                  <i class="fa fa-list"></i><a href="/toolmember/toolset/{{ $serviccente->id }}" class="hidden-sm">More details</a></p>
                          </div>
                          <div class="clearfix">
                          </div>
                      </div>
                  </div>
              </div>
              @endforeach



          </div>

        </div>
      </div>

    </div>
  </div>
  <!-- /.box-body -->
</div
    </section>

    <!-- /.content -->
@endsection
