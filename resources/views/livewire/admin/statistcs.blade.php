<div class="col-md-12 mb-4">
    <div class="card h-100">
        <div class="card-header">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Summary Data</h5>
                <div class="dropdown">
                    <button
                            class="btn text-body-secondary p-0"
                            type="button"
                            id="transactionID"
                            data-bs-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        <i class="icon-base ri ri-more-2-line icon-24px"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                        <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                        <a class="dropdown-item" href="javascript:void(0);">Share</a>
                        <a class="dropdown-item" href="javascript:void(0);">Update</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row g-6">
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="avatar">
                            <div class="avatar-initial bg-primary rounded shadow-xs">
                                <i class="icon-base ri ri-blogger-line icon-24px"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">Categories</p>
                            <h5 class="mb-0">{{ $categories }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="avatar">
                            <div class="avatar-initial bg-success rounded shadow-xs">
                                <i class="icon-base ri ri-pencil-line icon-24px"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">Posts</p>
                            <h5 class="mb-0">{{ $posts }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="avatar">
                            <div class="avatar-initial bg-warning rounded shadow-xs">
                                <i class="icon-base ri ri-macbook-line icon-24px"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">Comments</p>
                            <h5 class="mb-0">{{ $comments }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="d-flex align-items-center">
                        <div class="avatar">
                            <div class="avatar-initial bg-info rounded shadow-xs">
                                <i class="icon-base ri ri-user-2-line icon-24px"></i>
                            </div>
                        </div>
                        <div class="ms-3">
                            <p class="mb-0">Users</p>
                            <h5 class="mb-0">{{ $users }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
