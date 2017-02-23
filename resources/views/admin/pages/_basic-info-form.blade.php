{!! Form::open([
    'method'             => $form_method,
    'route'              => $form_route,
    'role'               => 'form' ,
    'id'                 => $form_id,
    'class'              => 'col s10  offset-s1',
    ]) !!}
    <div class="row">

        <div class="input-field col s12">

            @if ($user->hasPermission("manage_pages"))
                {!! Form::label('index', "Identificador de la página:", [
                    'class' => 'active',
                    ]) !!}
                {!! Form::text('index', $page_edit->index, [
                    'class'         => 'validate',
                    'required'      => 'required',
                    'form'          => $form_id,
                    'placeholder'   =>  "Home"
                ]) !!}
            @else
                <p class="text__p text__p--instructions"><strong>dfs{{ $page_edit->index }}</strong></p>
            @endif

        </div>

        <div class="input-field col s4 offset-s4 ">
            {!! Form::date('publish_at', $page_edit->publish_at ? $page_edit->publish_at->format("Y-m-d") : date("Y-m-d"), [
                'class'         => 'validate  datepicker',
                'required'      => 'required',
                'placeholder'   => date("Y-m-d"),
                'form'          => $form_id,
                "id"            => "publish_at"
            ])  !!}
            {!! Form::label('publish_at', "Fecha de publicación:", [
                'class' => 'input-label active'
            ]) !!}
        </div>

        <div class="input-field col s4">
            {!! Form::select('publish_id', $publishes_list, $page_edit->publish_id, [
                'class'         => 'validate',
                'required'      => 'required',
                'placeholder'   => "Seleccionar",
                'form'          => $form_id,
            ])  !!}
            {!! Form::label('publish_id', "Estatus de publicación:", [
                'class' => 'input-label active'
            ]) !!}
        </div>

        @unless ($page_edit->main)
            <div class="col s12"></div>
            <div class="col s4 ">

                <label for="">
                    Abrir en nueva ventana ?
                </label>
                <div class=" switch ">
                    No
                    <label>
                        {!! Form::checkbox("tblank", true , $page_edit->tblank, [
                            'class'     => 'input__checkbox',
                            'form'      => $form_id,
                        ]) !!}
                        <span class="lever"></span>
                    </label>
                    Sí
                </div>
            </div>
            <div class="input-field col s8 ">
                {!! Form::select('parent_id', $pages_list, $page_edit->parent_id, [
                    'class'         => 'validate',
                    // 'required'      => 'required',
                    'placeholder'   => "Seleccionar",
                    'form'          => $form_id,
                ])  !!}
                {!! Form::label('parent_id', "Página padre", [
                    'class' => 'input-label active'
                ]) !!}
            </div>
        @endunless


        <div class="col s12 ">

            @foreach($languages as $lang)
                <div class="input-field ">
                    {!! Form::label('label_'.$lang->iso6391, "Nombre la página: (".$lang->label.")", [
                        'class' => 'active',
                        ]) !!}
                    {!! Form::text('label['.$lang->iso6391.']', $page_edit->id ? $page_edit->translation($lang->iso6391)->label : null, [
                        'class'         => 'validate',
                        'required'      => 'required',
                        'form'          => $form_id,
                        'placeholder'   =>  "Home",
                        'id'            => 'label_'.$lang->iso6391

                    ]) !!}
                </div>
            @endforeach
        </div>

        <div class="col s12 ">
            <div class="pull-right">
                {!! Form::submit("Guardar", [
                    'class' => 'btn waves-effect waves-light',
                    'form'  => $form_id
                ]) !!}
            </div>
        </div>
    </div>
{!! Form::close() !!}
