@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Edit Template {{ $letterType->name }}</h3>
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

                    {!! Form::model($letterType, ['method' => 'PUT','route' => ['letter-types.update', $letterType->id]]) !!}
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="">Name</label>                                    
                                {!! Form::text('name', $letterType->name, array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>                                    
                                {!! Form::textarea('description', $letterType->description, array('class' => 'form-control')) !!}
                            </div>
                            @if ($letterType->file_path)
                                <label>Current File : </label>
                                <a href="{{ route('letter-types.download', $letterType->id) }}">{{ str_replace('uploads/softcopy/', '', $letterType->file_path) }}</a>
                            @endif
                            <div class="form-group">
                                <label for="">File</label>                                    
                                {!! Form::file('file', null, array('class' => 'form-control')) !!}
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        
                    </div>
                    {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
