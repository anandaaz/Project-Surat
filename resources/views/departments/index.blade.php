@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Departments</h3>
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
        
                        @can('create-department')
                        <a class="btn btn-warning" data-toggle="modal" data-target="#modalDepartment" title="Click to add a new department.">Add New Department</a>                        
                        @endcan
        
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">Departments</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>  
                                <tbody>
                                @foreach ($departments as $department)
                                <tr>                           
                                    <td>{{ $department->name }}</td>
                                    <td>   
                                        <a class="btn btn-primary" href="{{ route('departments.show',$department->id) }}">Detail</a>

                                        @can('edit-department')
                                            <a class="btn btn-primary" href="{{ route('departments.edit',$department->id) }}">Edit</a>
                                        @endcan
                                        
                                        @can('delete-department')
                                            {!! Form::open(['method' => 'DELETE','route' => ['departments.destroy', $department->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $departments->links() !!} 
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@push('modal')
<div class="modal fade" id="modalDepartment" tabindex="-1" role="dialog" aria-labelledby="modalDepartmentTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDepartmentTitle">Add New Department</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::open(array('route' => 'departments.store','method'=>'POST')) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="">Name</label>                                    
                        {!! Form::text('name', null, array('class' => 'form-control')) !!}
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