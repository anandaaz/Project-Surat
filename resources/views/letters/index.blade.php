@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Letters</h3>
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
        
                        @can('create-letter')
                        <a class="btn btn-warning" data-toggle="modal" data-target="#modalLetter" title="Click to add a new department.">Add New Letter Category</a>                        
                        @endcan
        
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">Name</th>
                                    <th style="color:#fff;">Department</th>
                                    <th style="color:#fff;">Letters Category</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>  
                                <tbody>
                                @foreach ($letters as $letter)
                                <tr>
                                    <td>{{ $letter->user->name }}</td>
                                    <td>{{ $letter->user->department->name }}</td>
                                    <td>{{ $letter->name }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('letters.show',$letter->id) }}">Detail</a>

                                        @can('edit-letter')
                                            <a class="btn btn-primary" href="{{ route('letters.edit',$letter->id) }}">Edit</a>
                                        @endcan
                                        
                                        @can('delete-letter')
                                            {!! Form::open(['method' => 'DELETE','route' => ['letters.destroy', $letter->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $letters->links() !!} 
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@push('modal')
<div class="modal fade" id="modalLetter" tabindex="-1" role="dialog" aria-labelledby="modalLetterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLetterTitle">Add New Letters</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(array('route' => 'letters.store','method'=>'POST')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="">NPK</label>                                    
                    <div class="form-group">
                        {!! Form::select('name', $usersModified,[], array('class' => 'form-control select2', 'style'=>"width: 100%")) !!}
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>                                    
                        {!! Form::text('name', null, array('class' => 'form-control', 'read-only'=>'true')) !!}
                    </div>
                   
                    <div class="form-group">
                        <label for="">Department</label>
                        {!! Form::select('department_id', $departments,[], array('class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label for="">Letter Category</label>
                        {!! Form::select('letter_type_id', $letterTypes,[], array('class' => 'form-control')) !!}
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