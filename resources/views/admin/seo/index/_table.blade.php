<table class="bordered highlight responsive-table ">
    <thead class="">
        <tr>
            <th>{!! trans('manage_seo.index.table.name') !!}</th>
            <th>{!! trans('manage_seo.index.table.route') !!}</th>
            <th>{!! trans('manage_seo.index.table.edit') !!}</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($seos as $seo)
            <tr>
                <td>
                    <img src="{{ $seo->thumbnail_image->url }}" alt="">
                    <a href="{{ route($seo->route_name, $seo->parameters) }}">
                        <b>{{ $seo->title }}: {{ config('app.name') }}</b> <br><br>
                        {{ substr($seo->description, 0, 160) }} ...
                    </a>
                </td>
                <td>
                    {{ $seo->uri }}
                </td>
                <td class="center-align">
                    <a href="{{ $seo->edit_url }}" class="btn-floating waves-effect waves-light">
                        <i class="material-icons small btn-icon">mode_edit</i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>