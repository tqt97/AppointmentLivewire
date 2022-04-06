<div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
        <div class="inner">
            <div class="d-flex justify-content-between">
                <h3 wire:loading.delay.remove>{{ $rolesCount }}</h3>
                <div wire:loading.delay>
                    <x-animation.ball-beat />
                </div>
                <select wire:change="getRolesCount($event.target.value)"
                    style="height:2rem;outline:2px solid transparent;" class="px-1 rounded border-0">
                    <option value="">All</option>
                    <option value="admin">Admin</option>
                    <option value="user">user</option>
                </select>
            </div>
            <p>User of roles</p>
        </div>
        <div class="icon">
            <i class="ion ion-bag"></i>
        </div>
        <a href="{{ route('admin.users') }}" class="small-box-footer">
            View all<i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</div>
