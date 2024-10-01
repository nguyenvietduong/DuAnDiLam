<form id="myForm" class="p-4 pt-3" action="{{ route(__('messages.' . $object . '.store.route')) }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <div class="row">

            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                <div class="col-lg-12 align-self-center">
                    <div class="col-md-12 col-lg-12">
                        <div class="card">
                            <label for="username" class="form-label">Post Photo</label>

                            <div class="card-body pt-0">
                                <div class="d-grid">
                                    <div class="row mb15">

                                        <div class="col-lg-6 col-6">
                                            <div class="form-row">
                                                <input type="file" id="imageInput" name="image" accept="image/*" hidden />
                                                <label class="btn-upload btn btn-primary mt-3" for="imageInput">Upload Image</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-6">
                                            <img id="imagePreview" src="{{ session('image_temp') ? Storage::url(session('image_temp')) : '' }}" alt="Image Preview" style="display: {{ session('image_temp') ? 'block' : 'none' }}; max-width: 100px; margin-left: 10px;">
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
                    </div>
                </div>
            </div>
            <!--end col-->

            <div class="col-lg-8 col-12 mb-2 mb-lg-1">
                <label for="postTitle" class="form-label">Post Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="postTitle" name="title" value="{{ old('title') }}" aria-describedby="emailHelp" placeholder="Enter post title">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end col-->

        </div>
        <!--end row-->
    </div>
    <!--end form-group-->

    <div class="form-group">
        <div class="row">

            <div class="col-lg-3 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2">Select Post Category</label>
                <!-- Select Post Categories -->
                <select id="categories" name="categories[]" multiple="multiple" class="form-select @error('categories') is-invalid @enderror">
                    @if (isset($categories))
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', isset($post) ? $post->categories->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                    @endif
                </select>
                @error('categories')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end col-->

            <div class="col-lg-3 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2">Select Post Tags</label>
                <!-- Select Post Tags -->
                <select id="tags" name="tags[]" multiple="multiple" class="form-select form-select-sm @error('tags') is-invalid @enderror">
                    @if (isset($tags))
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', isset($post) ? $post->tags->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                    @endforeach
                    @endif
                </select>
                @error('tags')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end col-->

            <div class="col-lg-3 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2">Select Friends</label>
                <!-- Select Friends -->
                <select id="friends" name="friends[]" multiple="multiple" class="form-select form-select-sm @error('friends') is-invalid @enderror">
                    @if (isset($friends))
                    @foreach ($friends as $friend)
                    <option value="{{ $friend->id }}" {{ in_array($friend->id, old('friends', isset($post) ? $post->mentions->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                        {{ $friend->name }}
                    </option>
                    @endforeach
                    @endif
                </select>
                @error('friends')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end col-->

            <div class="col-lg-3 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2">Select Status</label>
                <select name="status" class="form-control setupSelect2 @error('status') is-invalid @enderror">
                    @foreach (__('messages.post.status_post') as $key => $val)
                    <option value="{{ $key }}" {{ $key == old('status', isset($post->status) ? $post->status : '') ? 'selected' : '' }}>
                        {{ $val }}
                    </option>
                    @endforeach
                </select>
                @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end col-->

            <div class="col-lg-12 col-12 mb-2 mb-lg-1">
                <label class="form-label mt-2" for="content">Content</label>
                <textarea name="content" class="form-control @error('status') is-invalid @enderror" placeholder="" autocomplete="off" id="editor" data-height="500" {{ isset($disabled) ? 'disabled' : '' }}>{{ old('content', $post->content ?? '') }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end col-->

        </div>
        <!--end row-->
    </div>
    <!--end form-group-->

    <!--end form-group-->
    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn btn-primary me-2" onclick="executeExample('handleDismiss', 'myForm')">{{ __('messages.system.button.create') }}</button>
        <a href="{{ route(__('messages.' . $object . '.index.route')) }}"> <button type="button" class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button></a>
    </div>

</form>
