<ul class="collapsible popout" data-collapsible="accordion">
    <li v-for="component in sortable_list" >
        <div class="collapsible-header">

            <div class="pull-left" v-if="section.type.sortable && sortable_list.length > 1" >
                <span class="btn-floating waves-effect waves-light" @click.stop="move(-1, $index, sortable_list)">
                    <i class="small">&uarr;</i>
                </span>
                <span class="btn-floating waves-effect waves-light" @click.stop="move(1, $index, sortable_list)">
                    <i class="small">
                        &darr;
                    </i>
                </span>
            </div>
                <div>
                    <h4  v-if="editing_title === false" v-text='component.index ? component.index : "Pónme un nombre" '   @click="editing_title = true"></h3>
                    <input v-else type="text"  v-model="component.index" @change="editing_title = false" @keyup.enter.prevent="editing_title = false">
                </div>
            <div class="pull-right" v-if="section.type.unlimited">
                {!! Form::open([
    		'method'				=> 'DELETE',
    		'route'					=> ['admin::pages.sections.ajax.components.destroy','&#123;&#123;section.id&#125;&#125;','&#123;&#123;component.id&#125;&#125;'],
    		'role'					=> 'form' ,
    		'id'					=> 'delete_compoment-&#123;&#123;component.id&#125;&#125;_form',
    		'class'					=> '',
    		'data-index'			=> '&#123;&#123;$index&#125;&#125;',
    		'v-on:submit.prevent'	=> 'post'
    	]) !!}

    		<button type="submit" class=" btn-floating waves-effect waves-light deep-orange accent-2" form ="delete_compoment-&#123;&#123; component.id &#125;&#125;_form" @click.stop="">
    			<i class="material-icons">delete</i>
    		</button>

    	{!!Form::close()!!}
            </div>
        </div>
        <div class="collapsible-body">
            <component-form
            :section="section"
            :component= "component"
            :index="index"
            :component-name="component.index"
            ></component-form>
        </div>
    </li>
</ul>

<div v-if="list.length == 0">
    Seccion vacia 
</div>
