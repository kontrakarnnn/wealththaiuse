@extends('system-mgmt.insurance.base')
@section('action-content')
    <!-- Main content -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <style>


    /* Create two equal columns that floats next to each other */
    .column {
      float: left;
      width: 100%;
      padding: 10px;
     /* Should be removed. Only for demonstration */
    }
    .columnhide {
      display:none;

     /* Should be removed. Only for demonstration */
    }

    .column2 {
      float: left;
      width: 50%;
      padding: 10px;
     /* Should be removed. Only for demonstration */
    }
    .columnnote {
      float: left;
      width: 50%;
      padding: 10px;
     /* Should be removed. Only for demonstration */
    }
    .columnauth {
      float: left;
      width: 25%;
      padding: 10px;
     /* Should be removed. Only for demonstration */
    }
    .columntobe2 {
      float: left;
      width: 62%;
      padding: 10px;

     /* Should be removed. Only for demonstration */
    }
    .column3 {
      float: left;
      width: 33.33%;
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
    @media screen and (max-width: 1500px) {
      .column {
        width: 100%;
      }
      .columnnote {
        width: 100%;
      }
      .columnauth {
        width: 100%;
      }
      .column3 {
        width: 100%;
      }
      .column2 {
        width: 100%;
      }
      .columntobe2 {
        width: 100%;
      }
    }



    .name{


    border: 1px solid #aaaaaa;

    }
      .form-control2{



      border: 1px solid #aaaaaa;

    }
    input {
      padding: 10px;
      width: 100%;


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
    table{
      width:100%;
    }
    .ss{
    }
    .selectwidthauto
{
     width:100%;
}

    .card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem}.card>hr{margin-right:0;margin-left:0}.card>.list-group:first-child .list-group-item:first-child{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card>.list-group:last-child .list-group-item:last-child{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-body{-ms-flex:1 1 auto;flex:1 1 auto;padding:1.25rem}.card-title{margin-bottom:.75rem}.card-subtitle{margin-top:-.375rem;margin-bottom:0}.card-text:last-child{margin-bottom:0}.card-link:hover{text-decoration:none}.card-link+.card-link{margin-left:1.25rem}.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125)}.card-header:first-child{border-radius:calc(.25rem - 1px) calc(.25rem - 1px) 0 0}.card-header+.list-group .list-group-item:first-child{border-top:0}.card-footer{padding:.75rem 1.25rem;background-color:rgba(0,0,0,.03);border-top:1px solid rgba(0,0,0,.125)}.card-footer:last-child{border-radius:0 0 calc(.25rem - 1px) calc(.25rem - 1px)}.card-header-tabs{margin-right:-.625rem;margin-bottom:-.75rem;margin-left:-.625rem;border-bottom:0}.card-header-pills{margin-right:-.625rem;margin-left:-.625rem}.card-img-overlay{position:absolute;top:0;right:0;bottom:0;left:0;padding:1.25rem}.card-img{width:100%;border-radius:calc(.25rem - 1px)}.card-img-top{width:100%;border-top-left-radius:calc(.25rem - 1px);border-top-right-radius:calc(.25rem - 1px)}.card-img-bottom{width:100%;border-bottom-right-radius:calc(.25rem - 1px);border-bottom-left-radius:calc(.25rem - 1px)}.card-deck{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-deck .card{margin-bottom:15px}@media (min-width:576px){.card-deck{-ms-flex-flow:row wrap;flex-flow:row wrap;margin-right:-15px;margin-left:-15px}.card-deck .card{display:-ms-flexbox;display:flex;-ms-flex:1 0 0%;flex:1 0 0%;-ms-flex-direction:column;flex-direction:column;margin-right:15px;margin-bottom:0;margin-left:15px}}.card-group{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column}.card-group>.card{margin-bottom:15px}@media (min-width:576px){.card-group{-ms-flex-flow:row wrap;flex-flow:row wrap}.card-group>.card{-ms-flex:1 0 0%;flex:1 0 0%;margin-bottom:0}.card-group>.card+.card{margin-left:0;border-left:0}.card-group>.card:first-child{border-top-right-radius:0;border-bottom-right-radius:0}.card-group>.card:first-child .card-header,.card-group>.card:first-child .card-img-top{border-top-right-radius:0}.card-group>.card:first-child .card-footer,.card-group>.card:first-child .card-img-bottom{border-bottom-right-radius:0}.card-group>.card:last-child{border-top-left-radius:0;border-bottom-left-radius:0}.card-group>.card:last-child .card-header,.card-group>.card:last-child .card-img-top{border-top-left-radius:0}.card-group>.card:last-child .card-footer,.card-group>.card:last-child .card-img-bottom{border-bottom-left-radius:0}.card-group>.card:only-child{border-radius:.25rem}.card-group>.card:only-child .card-header,.card-group>.card:only-child .card-img-top{border-top-left-radius:.25rem;border-top-right-radius:.25rem}.card-group>.card:only-child .card-footer,.card-group>.card:only-child .card-img-bottom{border-bottom-right-radius:.25rem;border-bottom-left-radius:.25rem}.card-group>.card:not(:first-child):not(:last-child):not(:only-child){border-radius:0}.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-footer,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-header,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-bottom,.card-group>.card:not(:first-child):not(:last-child):not(:only-child) .card-img-top{border-radius:0}}.card-columns .card{margin-bottom:.75rem}@media (min-width:576px){.card-columns{-webkit-column-count:3;-moz-column-count:3;column-count:3;-webkit-column-gap:1.25rem;-moz-column-gap:1.25rem;column-gap:1.25rem;orphans:1;widows:1}.card-columns .card{display:inline-block;width:100%}}.accordion .card:not(:first-of-type):not(:last-of-type){border-bottom:0;border-radius:0}.accordion .card:not(:first-of-type) .card-header:first-child{border-radius:0}.accordion .card:first-of-type{border-bottom:0;border-bottom-right-radius:0;border-bottom-left-radius:0}.accordion .card:last-of-type{border-top-left-radius:0;border-top-right-radius:0}


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
       width: 65%;
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
       width: 33.33%;
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



   .wizard .nav-tabs > li a {
       width: 85px;
       height: 70px;
       margin: 35px auto;
       border: none;
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

    </style>
    <section class="content">


  <div class="box">
  <div class="box-header">

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

      {{--}}    <div id="insurance">

      </div>--}}
          <script src="{{ asset ("/js/app.js") }}" type="text/javascript"></script>
          <div id="insurance2">

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
                placeholder: "Select",
                //allowClear: true
            });
    </script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change','.country',function(){
            //  console.log("hmm its change");

                var department_id=$(this).val();
                //console.log(department_id);
                var div=$(this).parent();
                var op=" ";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findProvince')!!}',
                    data:{'id':department_id},

                    success:function(data){





                      op+='<option value="0" selected disabled>-เลือกจังหวัด-</option>';
                      for(var i=0; i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].name_in_thai+'</option>';

                      }
                      $('.pro').html(" ");
                      $('.pro').append(op);

                    },
                    error:function(){

                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change','.prodis',function(){
            //  console.log("hmm its change");

                var department_id=$(this).val();
                //console.log(department_id);
                var div=$(this).parent();
                var op=" ";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findDistrict')!!}',
                    data:{'id':department_id},

                    success:function(data){





                      op+='<option value="0" selected disabled>-เลือกเขต-</option>';
                      for(var i=0; i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].name_in_thai+'</option>';

                      }
                      $('.dis').html(" ");
                      $('.dis').append(op);

                    },
                    error:function(){

                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change','.dissub',function(){
            //  console.log("hmm its change");

                var department_id=$(this).val();
                //console.log(department_id);
                var div=$(this).parent();
                var op=" ";
                var op2=" ";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findSubdistrict')!!}',
                    data:{'id':department_id},

                    success:function(data){





                      op+='<option value="0" selected disabled>-เลือกแขวง-</option>';

                      for(var i=0; i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].name_in_thai+'</option>';
                        op2+='<input id="add2_postcode" type="text" class="form-control subdis2" name="add2_postcode" value="'+data[i].zip_code+'"  >';
                      }
                      $('.subdis').html(" ");
                      $('.subdis').append(op);
                      $('.subdis2').html(" ");
                      $('.subdis2').append(op2);

                    },
                    error:function(){

                    }
                });
            });
        });
    </script>


    <!-- /.content -->

    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change','.country2',function(){
            //  console.log("hmm its change");

                var department_id=$(this).val();
                //console.log(department_id);
                var div=$(this).parent();
                var op=" ";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findProvince')!!}',
                    data:{'id':department_id},

                    success:function(data){




                      op+='<option value="0" selected disabled>-เลือกจังหวัด-</option>';
                      for(var i=0; i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].name_in_thai+'</option>';

                      }
                      $('.pro2').html(" ");
                      $('.pro2').append(op);

                    },
                    error:function(){

                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change','.prodis2',function(){
            //  console.log("hmm its change");

                var department_id=$(this).val();
                //console.log(department_id);
                var div=$(this).parent();
                var op=" ";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findDistrict')!!}',
                    data:{'id':department_id},
                    success:function(data){
                      op+='<option value="0" selected disabled>-เลือกเขต-</option>';
                      for(var i=0; i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].name_in_thai+'</option>';

                      }
                      $('.dis2').html(" ");
                      $('.dis2').append(op);

                    },
                    error:function(){

                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change','.dissub2',function(){
            //  console.log("hmm its change");

                var department_id=$(this).val();
                //console.log(department_id);
                var div=$(this).parent();
                var op=" ";
                var op2=" ";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('findSubdistrict')!!}',
                    data:{'id':department_id},

                    success:function(data){





                      op+='<option value="0" selected disabled>-เลือกแขวง-</option>';

                      for(var i=0; i<data.length;i++){
                        op+='<option value="'+data[i].id+'">'+data[i].name_in_thai+'</option>';
                        op2+='<input id="add2_postcode" type="text" class="form-control subdis2" name="add2_postcode" value="'+data[i].zip_code+'"  >';
                      }
                      $('.subdis2').html(" ");
                      $('.subdis2').append(op);
                      $('.subdis3').html(" ");
                      $('.subdis3').append(op2);

                    },
                    error:function(){

                    }
                });
            });
        });
    </script>

    <script type="text/javascript">
      $('.subject-list').on('change', function() {
        $('.subject-list').not(this).prop('checked', false);
    });
    </script>
    <script>
    $(document).ready(function(){
        $('.check').click(function() {
            $('.check').not(this).prop('checked', false);
        });
    });
    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".publicadd").click(function(){
              var html = $(".clonepublic").html();
              $(".incrementpublic").after(html);
          });

          $("body").on("click",".publicremove",function(){
              $(this).parents(".control-grouppublic").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".partneradd").click(function(){
              var html = $(".clonepartner").html();
              $(".incrementpartner").after(html);
          });

          $("body").on("click",".partnerremove",function(){
              $(this).parents(".control-grouppartner").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".useradd").click(function(){
              var html = $(".cloneuser").html();
              $(".incrementuser").after(html);
          });

          $("body").on("click",".userremove",function(){
              $(this).parents(".control-groupuser").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".guildadd").click(function(){
              var html = $(".cloneguild").html();
              $(".incrementguild").after(html);
          });

          $("body").on("click",".guildremove",function(){
              $(this).parents(".control-groupguild").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".groupmemadd").click(function(){
              var html = $(".clonegroupmem").html();
              $(".incrementgroupmem").after(html);
          });

          $("body").on("click",".groupmemremove",function(){
              $(this).parents(".control-groupgroupmem").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".grouppidadd").click(function(){
              var html = $(".clonegrouppid").html();
              $(".incrementgrouppid").after(html);
          });

          $("body").on("click",".grouppidremove",function(){
              $(this).parents(".control-groupgrouppid").remove();
          });

        });

    </script>
    <script type="text/javascript">

        $(document).ready(function() {

          $(".grouppartadd").click(function(){
              var html = $(".clonegrouppart").html();
              $(".incrementgrouppart").after(html);
          });

          $("body").on("click",".grouppartremove",function(){
              $(this).parents(".control-groupgrouppart").remove();
          });

        });

    </script>
@endsection
