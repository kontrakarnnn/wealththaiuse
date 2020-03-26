@foreach ($userauths as $userauth)
    <tr role="row" class="odd">


      <td>{{ $userauth->member_name }}</td>
      <td>{{ $userauth->family_name }}</td>
      <td>{{ $userauth->status}}</td>

      <td>{{ $userauth->description}}</td>
      <td>


            @if($userauth->status == 'Accept')
            <form class="row" method="POST" action="{{ route('familyauth.destroy', ['id' => $userauth->id]) }}" onsubmit = "return confirm('Are you sure?')">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger  btn-margin">
            Kick
            </button>
            </form>
            @elseif($userauth->status == 'Waiting')
            <form class="row" role="form" method="POST" action="{{ route('family.approve', ['id' => $userauth->id]) }}">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <button type="submit" class="btn btn-info  btn-margin">
                Approve
                </button>
            </form>
            @elseif($userauth->status == 'Request')
            <form class="row" method="POST" action="{{ route('familyauth.destroy', ['id' => $userauth->id]) }}" onsubmit = "return confirm('Are you sure?')">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-danger btn-margin">
              Delete
            </button>
            </form>
            @endif



      </td>
  </tr>
@endforeach
