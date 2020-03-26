@foreach ($persons as $person)
  <h1>{{ $person->name}}<small>posted by {{$person->getPersonUsername()}}</small</h1>
  <p>{{ $person->lname}}</p>

@endforeach
