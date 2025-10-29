

<div class="modal fade" id="show-permissions-{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $authoriz->role }} - Permissions
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    @if(!empty($authoriz->permissions))
                        @foreach($authoriz->permissions as $permission)
                            <div class="col-md-4">
                                <p class="mb-2 text-muted text-uppercase">
                                    <i class="bi bi-shield-check text-bold  text-success me-2"></i>
                                    {{ $permission}}
                                </p>
                            </div>
                        @endforeach
                    @else

                        <div class="alert alert-warning mb-0">
                            No permissions assigned for this role.
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
