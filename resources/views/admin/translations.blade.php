@extends('layouts.admin')

@section('title')
    {!! trans('admin_access.translations.label') !!}
@endsection

@section('h1')
    {!! trans('admin_access.translations.label') !!}
@endsection

@section('content')
    @include('admin.general._page-instructions', [
        'title'         => trans('admin_access.translations.label'),
        'instructions'  => trans('admin_access.translations.instructions')
    ])

	<div class="col s10 col offset-s1 ">
		<h5>
			{!! trans('admin_access.translations.found',[
				"total_trans_find" 	=> $total_trans_find,
				"total_files" 		=> $total_files,
			] ) !!}
		</h5>
		<h6>
			{!! trans('admin_access.translations.checked',[
				"total_trans_checked" 			=> $total_trans_checked,
				"total_trans_no_complete" 		=> $total_trans_no_complete,
			] ) !!}
		</h6>

		<br><br>
	</div>

    <div class="col s10 col offset-s1 ">
        @foreach ($not_complete_files as $file)
            <h6>{{$file->file_name}}</h6>

            <ul class="collapsible popout" data-collapsible="accordion">
                @foreach ($file->lines as  $line => $info)
					@unless ($info->not_completed->isEmpty())
						<li class ="" >
							<div class="collapsible-header ">
								<i class="large material-icons @if ($info->posible_empty) red-text @elseif ($info->posible_dinamic) blue-text @endif" >error</i>
								<span class="" >
									{{trans('admin_access.translations.file.line')}}: {{ $line }}

								</span>
							</div>
							<div class="collapsible-body" >
								@foreach ($info->not_completed as $trans)
									<p >
										<b @if ($trans->posible_empty)class="red-text" @endif>{!! trans('admin_access.translations.file.trans_key') !!}</b>: <span @if ($trans->posible_dinamic)class="blue-text" @endif>{{$trans->trans_key }}</span><br>
										<b>{!! trans('admin_access.translations.file.languages') !!}</b>:
											@foreach ($trans->non_translateds as $key => $lang)
												@unless ($lang->exists)
													@unless ($loop->first)
														|
													@endunless
													<span>
															{{ $lang->language }}
													</span>
												@endunless
											@endforeach
									</p>
								@endforeach
							</div>
						</li>
					@endunless
                @endforeach
            </ul>
        @endforeach
    </div>
@endsection
