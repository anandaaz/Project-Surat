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
                            <h5 class="card-title">Person in {{ $activeDepartment->name ?? '' }} Department</h5>
                        </div>
                        <div class="card-body">
        
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">NPK</th>
                                    <th style="color:#fff;">Name</th>
                                    <th style="color:#fff;">Position</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>  
                                <tbody>
                                @foreach ($usersInDepartment as $user)
                                <tr>                           
                                    <td>{{ $user->npk ?? '-' }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ implode(',', $user->getRoleNames()->toArray())}}</td>
                                    <td>   
                                        
                                        @can('remove-user-department')
                                            {!! Form::open(['method' => 'DELETE','route' => ['departments.remove.user', $user->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
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
