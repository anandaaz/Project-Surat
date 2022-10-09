@extends('layouts.app')
@section('title')
  CKEditor
@endsection

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Add New Letter Templates</h3>
  </div>
  <div class="section-body">
      <div class="row">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                  
                  @if ($errors->any())                                                
                      <div class="alert alert-dark alert-dismissible fade show" role="alert">
                      <strong>Error!</strong>                        
                          @foreach ($errors->all() as $error)                                    
                              <span class="badge badge-danger">{{ $error }}</span>
                          @endforeach                        
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      </div>
                  @endif


                  {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                  <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12">
                          <div class="form-group">
                            <textarea name="surat" id="surat" rows="10" cols="80">
                              This is my textarea to be replaced with CKEditor 4.
                            </textarea>
                          </div>
                      </div>    
                  </div>
                  <button type="submit" class="btn btn-primary">Save</button>
                  {!! Form::close() !!}
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
@endsection

@section('page_js')
<script src="{{ asset('js/ckeditor-4-19/ckeditor.js') }}"></script>
@endsection

@section('scripts')
<script>


  CKEDITOR.replace('surat');
</script>
@endsection