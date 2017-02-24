<table class="bordered highlight responsive-table dataTable_JS">
    <thead class="">
        <tr>
            <th>Nombre (index)</th>
            <th>Página padre</th>
            <th>Estado</th>
            <th class="center-align"  >Ver</th>
            <th class="center-align"  >Editar</th>
        </tr>
    </thead>

    <tbody class="">

        @foreach ($pages as $page)
            <tr class="">
                <td>
                    {{ $page->label }}<br>
                    <small>({{ $page->index }})</small>
                </td>
                <td>
                    {!! $page->parent ? $page->parent->label."<br><small>(".$page->parent->index.")</small>"  :"N/A"  !!}
                </td>
                <td>
                    {{ $page->publish->label }}
                </td>
                <td  class="center-align" >
                    <a href="{{ $page->public_url }}" class="btn-floating waves-effect waves-light" target="_blank">
                        <i class="material-icons small">input</i>
                    </a>
                </td>
                <td class="center-align" >
                    <a href="{{ $page->edit_content_url }}" class="btn-floating waves-effect waves-light">
                        <i class="material-icons small">mode_edit</i>
                    </a>
                </td>
            </tr>

        @endforeach

    </tbody>
</table>

{{--

@foreach ($page->childs as $child)
    <tr class="">
        <td style="text-align: center">
            <a href="{{ route('admin::pages.edit', $child->id) }}" class="btn-floating waves-effect waves-light"><i class="material-icons">input</i></a>
        </td>
        <td style="padding: 1em;">
            <a href="{{ route('admin::pages.edit', $child->id) }}">{{ $child->translation()->name }}</a> <br>
            <small>{{ $page->translation()->slug }}/{{ $child->translation()->slug }}</small> <br>
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
