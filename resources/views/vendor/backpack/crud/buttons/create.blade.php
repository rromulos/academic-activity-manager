@if ($crud->hasAccess('create'))
	<a href="{{ url($crud->route.'/create') }}" class="btn btn-primary" data-style="zoom-in"><span class="ladda-label"><i class="la la-plus"></i> {{ trans('backpack::crud.add') }} {{ trans('backpack::crud.'.$crud->entity_name_plural) }}</span></a>
@endif
