<div class="content">
    <div class="container-fluid">
        <div class="col-lg-12">
            @if (isset($addButton))
                <div class="d-flex justify-content-between mb-3">
                    {{ $addButton }}
                </div>
            @endif
            @if (isset($table))
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <table class="table table-hover">
                            {{ $table }}
                        </table>
                    </div>
                    {{ $pagination }}
                </div>
            @endif
            {{ $slot }}
        </div>
    </div>
</div>
