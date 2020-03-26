<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  @foreach (App\Department::all() as $depList)

  $("#dep{{$depList->id}}").click(function(){
    var dep = $("#dep{{$depList->id}}").val();

    $.ajax({
      type: 'get',
      url: '{{url('/divisionDep')}}',
      data: 'department_id' + dep,
      success:function(data){
        console.log(response);
      }
    });
  });

  @endforeach
});
</script>
