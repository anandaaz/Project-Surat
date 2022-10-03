@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Jenis Form Department {{ $department->name }}</h3>
        </div>
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

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
        
                            @can('create-letter-type')
                            <a class="btn btn-warning" href="{{ route('letter-types.new',$department->id) }}">Tambah Template Form</a>                        
                            @endcan
            
        
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">Letters</th>
                                    <th style="color:#fff;">Descriptions</th>
                                    <th style="color:#fff;">Dibuat Oleh</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>  
                                <tbody>
                                @foreach ($letterTypes as $letterType)
                                <tr>                           
                                    <td>{{ $letterType->name }}</td>
                                    <td>{{ $letterType->description }}</td>
                                    <td>{{ implode(',', $letterType->user->getRoleNames()->toArray()) . ' - ' . $letterType->user->name }} </td>
                                    <td>
                                        <a class="btn btn-success" href="{{ route('letter-types.download',$letterType->id) }}">Download</a>

                                        @can('edit-letter-type')
                                            <a class="btn btn-primary" href="{{ route('letter-types.edit',$letterType->id) }}">Edit</a>
                                        @endcan
                                        
                                        @can('delete-letter-type')
                                            {!! Form::open(['method' => 'DELETE','route' => ['letter-types.destroy', $letterType->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $letterTypes->links() !!} 
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

//modal create 
@push('modal')
<div class="modal fade" id="modalLetterType" tabindex="-1" role="dialog" aria-labelledby="modalLetterTypeTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLetterTypeTitle">Add New Templates</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(array('route' => 'letter-types.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">

                        {!! Form::text('department_id', $department->id, array('class' => 'form-control', 'hidden')) !!}
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>                                    
                        {!! Form::text('name', null, array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>                                    
                        {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label for="">File</label>                                    
                        {!! Form::file('file', null, array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            {!! Form::close() !!}
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endpush
