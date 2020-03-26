<div class="row">
  @php
    $index = 0;
  @endphp
  @foreach ($items as $item)
    <div class="col-md-6">
      <div class="form-group">
          @php
            $stringFormat =  strtolower(str_replace(' ', '', $item));
          @endphp
          <label for="input<?=$stringFormat?>" class="col-sm-3 control-label">{{$item}}</label>
          <div class="col-sm-9">
            <input data-provide="datepicker" data-date-format="dd/mm/yyyy"value="{{isset($oldVals) ? $oldVals[$index] : ''}}" type="text" class="form-control" name="<?=$stringFormat?>" id="input<?=$stringFormat?>" >
          </div>
      </div>
    </div>
  @php
    $index++;
  @endphp
  @endforeach
</div>
