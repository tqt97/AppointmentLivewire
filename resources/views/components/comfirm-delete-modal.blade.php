<div class="modal fade" id="confirmDestroyModal" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger align-items-center">
                <h4 class="modal-title text-white">
                    <i class="fas fa-question-circle"></i>
                    Delete confirmation
                </h4>
                <button type="button" class="close text-white justify-content-center" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to <b>delete</b> this record ?</h5>
                <p>The record will be deleted automatically</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" wire:click.prevent="destroy">
                    Delete
                    <i class="fas fa-trash-alt"></i>
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cancel
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
</div>
