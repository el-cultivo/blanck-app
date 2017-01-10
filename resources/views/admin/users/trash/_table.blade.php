<table class="highlight  responsive-table dataTable_JS">
    <thead class="">
        <tr>
            <th>Nombre</th>
            <th>Roles</th>
            <th>Correo electrónico</th>
            <th class="center-align" >Reactivar</th>
        </tr>
    </thead>
    <tbody class="">
        @foreach ($users_disabled as $user_disable)
            <tr class=" ">


                <td class="">
                    {{ $user_disable->first_name }} {{$user_disable->last_name }}
                </td>

                <td class="">
                    @forelse ($user_disable->roles as $role)
                        {{ $role->label }} <br>
                    @empty
                        <span>cliente</span>
                    @endforelse
                </td>

                <td class="">{{ $user_disable->email }}</td>
                
                <td class="center-align">
                    <div class="">
                        {!! Form::open([
                            'method'             => 'patch',
                            'route'              => ['admin::users.recovery',$user_disable->id],
                            'role'               => 'form' ,
                            'id'                 => 'recovery_user-'.$user_disable->id.'_form',
                        ]) !!}

                            <button type="submit" class="btn-floating waves-effect waves-light " form ="recovery_user-{{$user_disable->id}}_form">
                                <i class="material-icons" >replay</i>
                            </button>

                        {{ Form::close() }}
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
