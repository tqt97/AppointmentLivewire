<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'update' : 'store' }}">
                <div class="modal-header">
                    <h5 class="modal-title text-blue">
                        @if ($showEditModal == false)
                            <i class="fas fa-user-plus mr-2"></i>
                            {{ $addNew }}
                        @else
                            <i class="fas fa-edit ml-2"></i>
                            {{ $edit }}
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>
                        @if ($showEditModal == false)
                            Save
                        @else
                            Save changes
                        @endif
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
