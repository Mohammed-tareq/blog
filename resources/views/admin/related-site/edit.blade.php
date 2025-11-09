<div class="col-lg-4 col-md-6">
    <div class="mt-4">

        <!-- Modal -->
        <div class="modal fade" id="edit-site-{{ $id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{route('admin.setting.site.update',$site->id)}}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Edit Site</h5>
                            <button
                                    type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 mb-6 mt-2">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                id="nameBasic"
                                                class="form-control"
                                                name="name"
                                                value="{{ $site->name }}"
                                                placeholder="Enter Name"/>
                                        <label for="nameBasic">Name</label>
                                    </div>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="col-md-12 mb-6 mt-2">
                                    <div class="form-floating form-floating-outline">
                                        <input
                                                type="text"
                                                id="nameBasic"
                                                class="form-control"
                                                name="url"
                                                value="{{ $site->url }}"
                                                placeholder="Enter url"/>
                                        <label for="nameBasic">Url</label>
                                    </div>
                                    @error('url')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror

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