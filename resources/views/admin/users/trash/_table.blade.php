<table class="highlight  responsive-table ">
    <thead class="">
        <tr>
            <th>{!! trans('manage_users.trash.table.name') !!}</th>
            <th>{!! trans('manage_users.trash.table.roles') !!}</th>
            <th>{!! trans('manage_users.trash.table.email') !!}</th>
            <th class="center-align" >{!! trans('manage_users.trash.table.recovery') !!}</th>
        </tr>
    </thead>
    <tbody class="" v-if= "filtered_list.length > 0" >
		<tr class="" v-for="user in filtered_list">
            <td class="">
                @{{ user.full_name }}
            </td>

            <td class="">
				<span v-if = "user.roles.length > 0">
					<span v-for = "role in user.roles" > @{{role.label}}<br> </span>
				</span>
                <span v-else >cliente</span>
            </td>

            <td class="">
				@{{user.email}}
			</td>

            <td class="center-align">
                <div class="">
                    {!! Form::open([
                        'method'             => 'patch',
                        'route'              => ['admin::users.recovery','user' =>'&#123;&#123;user.id&#125;&#125;'],
                        'role'               => 'form' ,
                        'id'                 => 'recovery_user-&#123;&#123;user.id&#125;&#125;_form',
                    ]) !!}

                        <button type="submit" class="btn-floating waves-effect waves-light " form ="recovery_user-&#123;&#123;user.id&#125;&#125;_form">
                            <i class="material-icons" >replay</i>
                        </button>
                    {{ Form::close() }}
                </div>
            </td>
        </tr>
    </tbody>
	<tbody v-if= "filtered_list.length == 0"  >
		<tr>
			<td colspan=4 class="center-align">
				{!! trans('manage_users.trash.table.empty') !!}
			</td>
		</tr>
	</tbody>
</table>
