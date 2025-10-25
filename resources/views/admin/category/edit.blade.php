<div class="col-lg-4 col-md-6">
    <div class="mt-4">

        <!-- Modal -->
        <div class="modal fade" id="edit-category-{{ $id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{route('admin.categories.update',$category->id)}}" method="post" >
                    @csrf
                    @method('put')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Edit Category</h5>
                            <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-6 mt-2">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                id="nameBasic"
                                                class="form-control"
                                                name="name"
                                                value="{{ $category->name }}"
                                                placeholder="Enter Name"/>
                                        <label for="nameBasic">Name</label>
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="form-floating form-floating-outline">
                                        <select name="status" class="form-select">
                                            <option selected disabled>Select Status</option>
                                            <option @selected($category->status === 1) value="1">Active</option>
                                            <option @selected($category->status === 0) value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-center mt-2">
                                <button type="submit" class="btn btn-primary"> Edit</button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>