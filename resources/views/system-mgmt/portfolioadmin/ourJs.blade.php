
<script>
$(document).ready(function(){
  @foreach(App\Structure::all() as $depList)
  $("#dep{{$depList->id}}").click(function(){
    var dep = $("#dep{{$depList->id}}").val();


  //  alert(dep);
  $.ajax({
    type:'get',
    dataType:'html',
    url: '{{url('/portfolioDep')}}',
    data: 'department_id' + dep,
    success:function(response){
      console.log(response);
      $("#portfolioData").append(response);

    }
  });
  });
  @endforeach
});

</script>
