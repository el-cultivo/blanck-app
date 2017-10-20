<table class="bordered highlight responsive-table ">
    <thead class="">
        <tr>
            <th>{!! trans('manage_pages.index.table.name') !!} <small><br>(index)</small></th>
            <th>{!! trans('manage_pages.index.table.parent') !!}</th>
            <th>{!! trans('manage_pages.index.table.sections') !!}</th>
            <th class="center-align" >{!! trans('manage_pages.index.table.edit') !!}</th>
            <th class="center-align" >{!! trans('manage_pages.index.table.delete') !!}</th>
        </tr>
    </thead>

    <tbody class="">
        @foreach ($pages as $page_edit)
            <tr class="">
                <td>
                    {{ $page_edit->label }}
                    <small>
                        <br>
                        ({{ $page_edit->index }})
                        @if ($page_edit->main)
                            <br>
                            {!! trans('manage_pages.index.table.main_page') !!}
                        @endif
                    </small>
                </td>
                <td>
                    {!! $page_edit->parent ? $page_edit->parent->label."<br><small>(".$page_edit->parent->index.")</small>"  : trans('manage_pages.index.table.not_child')  !!}
                </td>
                <td>
                    @if ($page_edit->sections->isEmpty())
                        {!! trans('manage_pages.index.table.sections_empty') !!}
                    @else
                        {!!$page_edit->sections->implode("index",",<br/>")!!}
                    @endif
                </td>
                <td class="center-align" >
                    <a href="{{ $page_edit->edit_url }}" class="btn-floating waves-effect waves-light">
                        <i class="material-icons small">mode_edit</i>
                    </a>
                </td>
                <td class="center-align">
                    @unless ($page_edit->main)
                        {!! Form::open([
                            'method'             => 'delete',
                            'route'              => ['admin::pages.destroy',$page_edit->id],
                            'role'               => 'form' ,
                            'id'                 => 'delete_page-'.$page_edit->id.'_form',
                            'class'              => ''
                        ]) !!}

                            <button type="submit" class=" btn-floating waves-effect waves-light deep-orange accent-2" form ="delete_page-{{$page_edit->id}}_form">
                                <i class="material-icons">delete</i>
                            </button>
                        {{ Form::close() }}
                    @endunless
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{--

@foreach ($page_edit->childs as $child)
    <tr class="">
        <td style="text-align: center">
            <a href="{{ route('admin::pages.edit', $child->id) }}" class="btn-floating waves-effect waves-light"><i class="material-icons">input</i></a>
        </td>
        <td style="padding: 1em;">
            <a href="{{ route('admin::pages.edit', $child->id) }}">{{ $child->translation()->name }}</a> <br>
            <small>{{ $page_edit->translation()->slug }}/{{ $child->translation()->slug }}</small> <br>
        </td>
        <td>
            <span>{{ $child->publish->label }}</span>
        </td>
        <td style="padding: 1em;text-align: right;">
            {{ $child->edit_date_for_humans }} <br>
        </td>
        <td style="text-align: center">
            <a href="{{ route('admin::pages.edit', $child->id) }}" class="btn-floating waves-effect waves-light red"><i class="material-icons">mode_edit</i></a>
        </td>
    </tr>
@endforeach

--}}
