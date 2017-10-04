<template id="pages-group-template">
    <div :id="label" class="collection" >
        <table class="bordered highlight responsive-table ">
            <thead class="">
                <tr>
                    <th></th>
                    <th>Nombre (index)</th>
                    <th>Estado</th>
                    <th class="center-align"  >Ver</th>
                    <th class="center-align"  >Editar</th>
                </tr>
            </thead>

            <tbody class="">
                <tr :class="index"  v-for="page in sortable_list" >
                    <td>
                        <span class="btn-floating waves-effect waves-light"
                            @click="move(-1, $index, sortable_list)"
                            v-if = 'list.length > 1'>
                            <i class="small">&uarr;</i>
                        </span>
                        <span class="btn-floating waves-effect waves-light"
                            @click="move(1, $index, sortable_list)"
                            v-if = 'list.length > 1'>
                            <i class="small">
                                &darr;
                            </i>
                        </span>
                    </td>
                    <td>
                        @{{{ page.complete_label }}}
                        <small v-if = 'page.main' >
                            <br>
                            Página principal del sitio
                        </small>

                    </td>
                    <td>
                        @{{{ page.publish.label }}}
                    </td>
                    <td  class="center-align" >
                        <a href="@{{ page.public_url }}" class="btn-floating waves-effect waves-light" target="_blank">
                            <i class="material-icons small">input</i>
                        </a>
                    </td>
                    <td class="center-align" >
                        <a href="@{{ page.edit_content_url }}" class="btn-floating waves-effect waves-light">
                            <i class="material-icons small">mode_edit</i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        @include('admin.pages.contents.index._sort-form')
    </div>
</template>
