<table class="bordered highlight responsive-table dataTable_JS">
    <thead class="">
        <tr>
            <th>Nombre (slug)</th>
            <th>Estado</th>
            <th>Last edit</th>
            <th>Editar</th>
        </tr>
    </thead>

    <tbody class="">

        @foreach ($pages as $page)
            <tr class="">
                <td>
                    <a href="{{ route('admin::pages.edit', $page->id) }}" style="text-decoration: underline;">{{ $page->translation()->name }}</a>
                </td>
                <td>
                    {{ $page->publish->label }}
                </td>
                <td>
                    {{ $page->edit_date_for_humans }}
                </td>
                <td>
                    <a href="{{ route('admin::pages.edit', $page->id) }}" class="btn-floating waves-effect waves-light">
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
