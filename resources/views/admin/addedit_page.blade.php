@extends('layout.master')
@section('title', isset($page_info) ? 'Edit Page' : 'Add Page')
@section('main_content')

<style>
  .iframe-container {
    overflow: hidden;
    padding-top: 56.25%;
    position: relative;
  }

  .iframe-container iframe {
    border: 0;
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
  }
</style>


  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-sm-12">
        <div class="card " >
          <div class="card-header">
            <h5 class="mb-0">{{ isset($page_info) ? 'Edit Page' : 'Add Page' }}</h5>
          </div>
          <div class="card-body">
            <form action="{{ url('admin/pages/add_edit') }}" method="post">
              @csrf
              <!-- Hidden ID field for editing -->
              @if(isset($page_info))
                <input type="hidden" name="id" value="{{ $page_info->id }}">
              @endif

              <!-- Page Title -->
              <div class="form-group row">
                <label for="pageTitle" class="col-sm-3 col-form-label">Page Title</label>
                <div class="col-sm-8">
                  <input type="text" name="page_title" id="pageTitle"
                         class="form-control @error('page_title') is-invalid @enderror"
                         value="{{ old('page_title', $page_info->page_title ?? '') }}">
                  @error('page_title')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <!-- Page Description -->
              <div class="form-group row mt-3">
                <label for="pageContent" class="col-sm-3 col-form-label">Page Description</label>
                <div class="col-sm-8">
                  <textarea name="page_content" id="pageContent"
                            class="summernote form-control @error('page_content') is-invalid @enderror">{{ old('page_content', $page_info->page_content ?? '') }}</textarea>
                  @error('page_content')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <!-- Page Order -->
              <div class="form-group row mt-3">
                <label for="pageOrder" class="col-sm-3 col-form-label">Page Order</label>
                <div class="col-sm-8">
                  <input type="number" name="page_order" id="pageOrder"
                         class="form-control @error('page_order') is-invalid @enderror"
                         value="{{ old('page_order', $page_info->page_order ?? '') }}"
                         min="0">
                  @error('page_order')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <!-- Status -->
              <div class="form-group row mt-3">
                <label for="status" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-8">
                  <select class="form-control @error('status') is-invalid @enderror" name="status" id="status">
                    <option value="1" {{ old('status', $page_info->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $page_info->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                  </select>
                  @error('status')
                    <span class="invalid-feedback">{{ $message }}</span>
                  @enderror
                </div>
              </div>

              <!-- Submit Button -->
              <div class="form-group mt-4">
                <div class="offset-sm-3 col-sm-8">
                  <button type="submit" class="btn btn-primary">
                    {{ isset($page_info) ? 'Update Page' : 'Add Page' }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
