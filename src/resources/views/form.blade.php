<pre>
    {{-- {!! print_r($model->fields) !!} --}}

</pre>

@if(isset($model) && property_exists($model, 'fields'))
    @foreach($model->fields as $object)
        @if(is_a($object, 'Aruberuto\MetadataFields\Model\FieldGroup'))
            {!! $object->renderFieldGroup() !!}
        @elseif(is_a($object, 'Aruberuto\MetadataFields\Model\Field'))
            {!! $object->renderInputField() !!}
        @endif
    @endforeach
@endif
