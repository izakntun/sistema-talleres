<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">¡Confirmar!</h4>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de eliminar el registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <form style="display: inline;" method="POST" action="{{ route('delete_ticket', $result->id) }}">
                    {!! method_field('DELETE') !!}
                    {!! csrf_field() !!}
                    <button class="btn btn-danger" type="submit">Eliminar</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->