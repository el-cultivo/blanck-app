<div class="col s8 offset-s1">

    <table class="highlight responsive-table dataTable_JS">
        <thead class="">
            <tr>
                <th >Nombre</th>
                <th class="right" >Desactivar</th>
                <th class="right" >Editar</th>
            </tr>
        </thead>

        <tbody class="">
            <tr class="" v-for="category in list">
                <td class="" >
                    @{{category.label}}
                </td>

                <td class="right">
                    {!! Form::open([
                        'method'                => 'DELETE',
                        'route'                 => ['admin::categories.ajax.destroy','&#123;&#123;category.id&#125;&#125;'],
                        'role'                  => 'form' ,
                        'id'                    => 'delete_category-&#123;&#123;category.id&#125;&#125;_form',
                        'class'                 => '',
                        'data-index'            => '&#123;&#123;$index&#125;&#125;',
                        'v-on:submit.prevent'   => 'post'
                    ]) !!}

                        <button type="submit" class=" btn-floating waves-effect waves-light deep-orange edit-category__button" form ="delete_category-&#123;&#123; category.id &#125;&#125;_form">
                            <i class="material-icons">delete</i>
                        </button>

                    {!!Form::close()!!}

                </td>

                <td class="right">
                    <span
                        {{-- data-target="categories-modal-edit" --}}
                        {{-- data-index="@{{$index}}" --}}
                        class=" btn-floating waves-effect waves-light edit-category__button"
                        @click="openModal('#categories-modal-edit' ,$index)">
                        <i class="material-icons waves-effect waves-light " >mode_edit</i>
                    </span>
                </td>

            </tr>
        </tbody>
    </table>
</div>
