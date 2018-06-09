<div class="form-group">
    <label for="{{$field->id}}">{{$field->label}}</label>
    <input id="{{$field->id}}" name="{{$field->name}}[]"  type="file" class="file" data-theme="fa"
        data-remove-class="btn btn-danger" data-allowed-file-types='["image"]'
        data-show-upload="false" data-language="es" multiple data-max-file-count="10" >
</div>
@section('scripts')
@parent
<script>
    var images = [];
    @if(isset($value) &&  is_array($value))
        @foreach($value as $image)
            images.push("{{$image}}");
        @endforeach
    @endif

    $("#{{$field->id}}").fileinput({
        initialPreview: images,
        initialPreviewAsData: true,
        'theme': 'fa'
    });
</script>

@endsection
