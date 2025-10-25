<div class="card-body">
    <form action="{{url()->current()}}" method="get">
        <div class="row">
            <div class=" col-md-2">
                <select name="sort_by" class="form-select">
                    <option selected disabled>Sort By</option>
                    <option value="name">Name</option>
                    <option value="created_at">Created At</option>
                </select>
            </div>
            <div class=" col-md-2">
                <select name="order" class="form-select">
                    <option selected disabled>Order By</option>
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
            <div class=" col-md-2">
                <select name="paginate" class="form-select">
                    <option selected disabled>Limit By</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class=" col-md-2">
                <select name="status" class="form-select">
                    <option selected disabled>Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-evenly">
                <div class=" col-md-8">
                    <input type="text" class="form-control" name="keyword" placeholder="Search">
                </div>
                <div class=" col-md-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>