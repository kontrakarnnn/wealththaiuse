@foreach ($data as $portfolio)

    <tr role="row" class="odd">
      <td>{{ $portfolio->type }}</td>
      <td>{{ $portfolio->portfolio_type}}</td>
      <td>{{ $portfolio->status}}</td>
      <td>
        <form class="row" method="POST" action="{{ route('portfolio.destroy', ['id' => $portfolio->id]) }}" onsubmit = "return confirm('Are you sure?')">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <a href="{{ route('portfolio.edit', ['id' => $portfolio->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
            Update
            </a>
            <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
              Delete
            </button>
        </form>
      </td>
  </tr>
@endforeach
