@extends('layouts.admin')


@section('title')
    Copies
@endsection

@section('h1')
    Copies
@endsection


@section('content')

    @foreach ($copies_by_page as $page_slug => $copies)
        <div class="col s10 offset-s1">
                <h5>{{ trans('manage_copies.'.$page_slug.'.title') }}</h5>
                <ul class="collapsible popout" data-collapsible="accordion">

                    @foreach ($copies as $key => $copy)
                        <li  >
                           <div class="collapsible-header">
                               <h6 >
                                   {{ trans('manage_copies.'.$page_slug.'.'.$copy->key.'.title') }}
                               </h6>
                           </div>
                           <div class="collapsible-body">
                               {!! Form::open([
                                   'method'                => "PATCH",
                                   'route'                 => ['admin::copies.update',$copy->id],
                                   'role'                  => 'form' ,
                                   'id'                    => "update_component_".$copy->id."_form" ,
                                   'class'                 => "row"
                                   ]) !!}

                                   <div class="col s12" >
                                       @foreach($languages as $language)
                                           <div class="input-field" >
                                               {!! Form::label("value[".$language->iso6391."]", trans('manage_copies.'.$page_slug.'.'.$copy->key.'.label').' ('.$language->label.'):', ['class' => 'input-label active']) !!}
                                               {!! Form::textarea("value[".$language->iso6391."]", $copy->{$language->iso6391."_value"}, [
                                                   'class'       => 'materialize-textarea validate summernote_JS',
                                                   'placeholder' => trans('manage_copies.'.$page_slug.'.'.$copy->key.'.placeholder')." (".$language->label.")",
                                                   // 'required'    => 'required',
                                                   'form'        => "update_component_".$copy->id."_form"
                                               ]) !!}
                                           </div>
                                       @endforeach
                                   </div>

                                   <div class="col s12">
                                       <div class=" pull-right">
                                           {!! Form::submit("Guardar", [
                                               'class' => 'btn waves-effect waves-light',
                                               'form'  => "update_component_".$copy->id."_form"
                                           ]) !!}
                                       </div>
                                       <br><br>
                                   </div>

                               {!! Form::close() !!}
                           </div>
                       </li>
                    @endforeach

                </ul>
        </div>
        <div class="col s10 offset-s1">
            <br> <div class="divider"></div>
        </div>
    @endforeach




@endsection
