@foreach($group->fields as $object)
    @if(is_a($object, 'Aruberuto\MetadataFields\Model\FieldGroup'))
        {!! $object->renderFieldGroup() !!}
    @elseif(is_a($object, 'Aruberuto\MetadataFields\Model\Field'))
        {!! $object->renderInputField() !!}
    @endif
@endforeach
