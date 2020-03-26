@extends('system-mgmt.insurance.base')
@section('action-content')
    <!-- Main content -->
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

    <script src="//fb.me/react-0.14.3.js"></script>
<script src="//fb.me/react-dom-0.14.3.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.1.0/jspdf.plugin.autotable.js"></script>


    <style>

    .tablescroll {
      max-height: 70px;
      overflow-y: auto;
    }
    thead { display: table-header-group }
    tfoot { display: table-row-group }
    thead {
display: table-row-group;
}
tfoot {
display: table-row-group;
}
tr {
page-break-inside: avoid;
}
    .pagebreak {
      page-break-inside: avoid
    }
    .rating-star,
   .rating:hover .rating-star {
     position: relative;
       display: block;
     float: right;
       width: 16px;
       height: 16px;
       background: url('https://www.everythingfrontend.com/samples/star-rating/star.png') 0 -16px;
   }
   .rating {
      overflow: hidden;
      display: inline-block;
  }
  .rating-input {
      float: right;
      width: 16px;
      height: 16px;
      padding: 0;
      margin: 0 0 0 -16px;
      opacity: 0;
  }
    .column {
      width: 100%;
      text-align:center;

     /* Should be removed. Only for demonstration */
    }
    .columnshow2 {
      float: left;
      width: 50%;
      padding: 10px;
     /* Should be removed. Only for demonstration */
    }

    .column2 {
      float: left;
      width: 33.33%;
      padding: 10px;

     /* Should be removed. Only for demonstration */
    }
    .column5 {
      text-align:center;
      float: left;

      width: 20%;
      padding: 10px;

     /* Should be removed. Only for demonstration */
    }
    .columnanotherfile {
      float: left;
      width: 40%;
      padding: 10px;

     /* Should be removed. Only for demonstration */
    }
    .columnsome2 {
      float: left;
      width: 50%;

     /* Should be removed. Only for demonstration */
    }
    .column2fordis {
      float: left;
      width: 50%;
     /* Should be removed. Only for demonstration */
    }
    .column22 {
      float: left;
      width: 33.33%;
      padding: 10px;

     /* Should be removed. Only for demonstration */
    }

    .column3 {
      text-align:center;
      width: 33.33%;
      padding: 10px;

     /* Should be removed. Only for demonstration */
    }
    .column4 {
      float: left;
      text-align:center;

      width: 25%;
      padding: 10px;

     /* Should be removed. Only for demonstration */
    }
    @media screen and (max-width: 1110px) {
      .columnsome2 {
        width: 100%;
      }
      .column2fordis {
        width: 100%;
      }
      .column3 {
        width: 100%;
      }
      .column4 {
        width: 100%;
      }
      .column5 {
        width: 100%;
      }
      .column2 {
        width: 100%;
      }
      .column22 {
        width: 100%;
      }
      .columnshow2 {
        width: 50%;
      }
      .columnanotherfile {
        width: 100%;

       /* Should be removed. Only for demonstration */
      }

    }
    #autowidth{
      width:200px;
    }
    .borderna{
      border: 1px solid #ddd;
      border: 1px solid #ddd;
    }
    .card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card>hr{margin-right:0;margin-left:0}.card>.list-group:first-child .list-group-item:first-child{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card>.list-group:last-child .list-group-item:last-child{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-subtitle{margin-top:-.375rem;margin-bottom:0}.card-text:last-child{margin-bottom:0}.card-link:hover{text-decoration:none}.card-link+.card-link{margin-left:1.25rem}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(.25rem - 1px) calc(.25rem - 1px) 0 0}.card-header+.list-group .list-group-item:first-child{border-top:0}.card-footer{padding:.75rem 1.25rem;background-color:rgba(0,0,0,.03);border-top:1px solid rgba(0,0,0,.125)}.card-footer:last-child{border-radius:0 0 calc(.25rem - 1px) calc(.25rem - 1px)}.card-header-tabs{margin-right:-.625rem;margin-bottom:-.75rem;margin-left:-.625rem;border-bottom:0}.card-header-pills{margin-right:-.625rem;margin-left:-.625rem}.card-img-overlay{position:absolute;top:0;right:0;bottom:0;left:0;padding:1.25rem}.card-img{width:100%;border-radius:calc(.25rem - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(.25rem - 1px);border-top-right-radius:calc(.25rem - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(.25rem - 1px);border-bottom-left-radius:calc(.25rem - 1px)}.card-deck{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-deck .card{margin-bottom:15px}@media (min-width:576px){.card-deck{-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}.card-deck .card{display:-ms-flexbox;display:flex;-ms-flex:1 0 0%;flex:1 0 0%;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-bottom:0;margin-left:15px}}.card-group{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-group>.card{margin-bottom:15px}@media (min-width:576px){.card-group{-ms-flex-flow:row wrap;flex-flow:row wrap}.card-group>.card{-ms-flex:1 0 0%;flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-header,.card-group>.card:first-child .card-img-top{border-top-right-radius:0}.card-group>.card:first-child .card-footer,.card-group>.card:first-child .card-img-bottom{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-header,.card-group>.card:last-child .card-img-top{border-top-left-radius:0}.card-group>.card:last-child .card-footer,.card-group>.card:last-child .card-img-bottom{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:.25rem}.card-group>.card:only-child .card-header,.card-group>.card:only-child .card-img-top{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card-group>.card:only-child .card-footer,.card-group>.card:only-child .card-img-bottom{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top{border-radius:0}}.card-columns .card{margin-bottom:.75rem}@media (min-width:576px){.card-columns{-webkit-column-count:3;-moz-column-count:3;column-count:3;-webkit-column-gap:1.25rem;-moz-column-gap:1.25rem;column-gap:1.25rem;orphans:1;widows:1}.card-columns .card{display:inline-block;width:100%}}.accordion .card:not(:first-of-type):not(:last-of-type){border-bottom:0;border-radius:0}.accordion .card:not(:first-of-type) .card-header:first-child{border-radius:0}.accordion .card:first-of-type{border-bottom:0;border-bottom-right-radius:0;border-bottom-left-radius:0}.accordion .card:last-of-type{border-top-left-radius:0;border-top-right-radius:0}
    div.sticky {
      position: -webkit-sticky;
      position: sticky;
      top: 0;
      padding: 5px;
      background-color: #cae8ca;
      border: 2px solid #4CAF50;
    }
    @media screen and (max-width: 1500px) {
    #autowidth{
      width:200px;
    }
  }
</style>
    <section class="content">
  <div class="box">
  <div class="box-header">
    <h3>Distribution Insight report</h3>

  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>

    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">

        <div id="distributioninsight">

          </div>
          <script src="{{ asset ("/js/app.js") }}" type="text/javascript"></script>

        </div>
      </div>

    </div>
  </div>
  <!-- /.box-body -->
</div>

    </section>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">

          $(".name").select2({
                placeholder: "กรุณาเลือก",
                allowClear: true
            });
    </script>
@endsection
