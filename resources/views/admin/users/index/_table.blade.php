<table class="highlight responsive-table dataTable_JS">
    <thead class="">
        <tr>
            <th>Nombre</th>
            <th>Roles</th>
            <th>Correo electrónico</th>
            <th class="center-align" >Editar</th>
            <th class="center-align" >Desactivar</th>
        </tr>
    </thead>

    <tbody class="">
        @foreach ($users as $user_edit)
            <tr class="">
                <td class="">
                    {{ $user_edit->first_name }} {{$user_edit->last_name }}
                </td>

                <td class="">
                    @forelse ($user_edit->roles as $role)
                        {{ $role->label }} <br>
                    @empty
                        <span>cliente</span>
                    @endforelse
                </td>

                <td class="">{{ $user_edit->email }}</td>

                <td class="center-align">
                    <a href="{{ route( 'admin::users.edit', [$user_edit->id] ) }}" class="btn-floating">
                        <i class="material-icons waves-effect waves-light " >mode_edit</i>
                    </a>
                </td>


                <td class="center-align">


                    @if( $user_edit->id != $user->id )
                        {!! Form::open([
                            'method'             => 'delete',
                            'route'              => ['admin::users.destroy',$user_edit->id],
                            'role'               => 'form' ,
                            'id'                 => 'delete_user-'.$user_edit->id.'_form',
                            'class'              => ''
                        ]) !!}

                            <button type="submit" class=" btn-floating waves-effect waves-light deep-orange accent-2" form ="delete_user-{{$user_edit->id}}_form">
                                <i class="material-icons">delete</i>
                            </button>
                        {{ Form::close() }}
                    @endif

                </td>

            </tr>
        @endforeach
    </tbody>
</table>
