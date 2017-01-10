<template id="{{$modal_id}}-template">
    <div  id="{{$modal_id}}" class="modal">
        <div class="" role="document">
            <div class="modal-content">
                <div class="modal__header">
                    <div class="row">
                        <div class="col s11">
                            <h5 class="">@yield('modal-title')</h5>
                        </div>
                        <div class="col s1">
                            @include('admin.general.modals.partials._header')
                        </div>
                    </div>
                </div>

                <div class="modal__body">
                    <div class="row">
                        <div class="col s12">
                            @yield('modal-content')
                        </div>
                    </div>
                </div>

            </div>

            {{--
            <div class="modal-footer">
                @include('admin.general.modals.partials._footer')
            </div>
            --}}
        </div>
    </div>
</template>
