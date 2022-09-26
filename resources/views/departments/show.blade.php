@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <a href="/departments">
                <h3 class="page__heading">Departments</h3>
            </a>
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
                        <div class="card-header">
                            <h5 class="card-title">Person in {{ $activeDepartment->name }} Department</h5>
                        </div>
                        <div class="card-body">
        
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">NPK</th>
                                    <th style="color:#fff;">Name</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>  
                                <tbody>
                                @foreach ($usersInDepartment as $user)
                                <tr>                           
                                    <td>{{ $user->npk ?? '-' }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>   
                                        
                                        @can('remove-user-department')
                                            {!! Form::open(['method' => 'DELETE','route' => ['departments.remove.user', $user->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endcan

                                        @can('assign-user-department')
                                            <a class="btn btn-warning" data-toggle="modal" data-target="#modalMoveUserDepartment" title="Click to move user to another department.">Move User</a>                        
                                    @endcan
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>

                            <div class="pagination justify-content-end">
                                {!! $usersInDepartment->links() !!} 
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@push('modal')
<div class="modal fade" id="modalMoveUserDepartment" tabindex="-1" role="dialog" aria-labelledby="modalMoveUserDepartmentTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalMoveUserDepartmentTitle">Move User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {!! Form::model($user, ['method' => 'PATCH','route' => ['departments.move.user', $user->id]]) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        {!!Form::label('department_id', 'Select User') !!}
                        {!! Form::select('department_id', $departments,[], array('class' => 'form-control')) !!}
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