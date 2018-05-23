<div id="modal-all" class="modal">
    <form class="form-all" action="{{ Route('route_service_data') }}" method="post">
        <div class="modal-content">
            <h4 class="modal__title">Modal Header</h4>
            <p class="modal__description">A bunch of text</p>
            <div class="progress modal__progress">
                <div class="indeterminate"></div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-white red btn">Отменить</a>
            <a href="#!" class="modal-action waves-effect waves-white btn green modal__target">Принять</a>
        </div>
        {{ csrf_field() }}
    </form>
</div>