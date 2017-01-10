<table class="highlight responsive-table dataTable_JS">
    <thead class="">
        <tr>
            <th>Nombre</th>
            <th>Expositor</th>
            <th>Ubicación</th>
            <th>Tipo de registro</th>
            <th>Publicación</th>
            <th class="center-align">Editar</th>
            <th class="center-align">Desactivar</th>
        </tr>
    </thead>

    <tbody class="">
        @foreach ($films as $film)
            <tr class="">
                <td class="">
                    {{ $film->label }}
                </td>

                <td class="">
                    @if ( $film->speaker)
                        {{ $film->speaker->name }}, <br>
                    @endif
                    @if ( $film->topic)
                        {{ $film->topic->label }}, <br>
                    @endif
                    @if ( $film->category)
                        {{ $film->category->label }}
                    @endif
                </td>

                <td class="">

                    @if ($film->location)
                        {{ ( $film->location->full_address) }}<br>
                    @else
                        Sin dirección
                    @endif

                    {{ $film->date->format("d-m-Y H:i:s") }} <br>
                    <small>{{ $film->timezone }}</small>
                </td>

                <td class="">
                    @if ($film->registrationtype)
                        {{ $film->registrationtype->label}}<br>
                    @endif
                    Cupo: {{number_format( $film->quota, 0 )}}<br>
                    Costo: $ {{  number_format($film->price ,2 ) }}
                </td>
                <td class="">
                    @if ($film->publish)
                        {{ $film->publish->label  }}
                    @else
                        Borrador
                    @endif

                    <br> {{ $film->publish_at->format("d-m-Y") }}

                </td>
                <td class="center-align">
                    <a href="{{ route( 'admin::films.edit', [$film->id] ) }}" class="btn-floating">
                        <i class="material-icons waves-effect waves-light " >mode_edit</i>
                    </a>
                </td>

                <td class="center-align">
                    {!! Form::open([
                        'method'             => 'delete',
                        'route'              => ['admin::films.destroy',$film->id],
                        'role'               => 'form' ,
                        'id'                 => 'delete_films-'.$film->id.'_form',
                        'class'              => ''
                    ]) !!}

                        <button type="submit" class=" btn-floating waves-effect waves-light deep-orange accent-2" form ="delete_films-{{$film->id}}_form">
                            <i class="material-icons">delete</i>
                        </button>
                    {{ Form::close() }}
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
