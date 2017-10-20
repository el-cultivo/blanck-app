<div class="row">
    <div class="col s12">
        <div class="divisor"></div>
    </div>
</div>

<div class="row modal__row-footer">
    <div class="col s6 ">
        <a href="{{ route("client::pages.index") }}">
            <img class="footer__logo" src="/images/logo-default.svg" alt="El cultivo" />
        </a>
    </div>
    <div class="col s6 right-align ">
		{!! trans('admin.layout.development_by',["name" => '<a href="http://www.elcultivo.mx/" target="_blank">El Cultivo</a>']) !!}
    </div>
</div>
