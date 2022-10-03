@extends('layouts.app')

@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">
        @unlessrole('Admin')
        Users in {{ Auth::user()->department->name }}
        @else
        All Users
        @endrole
      </h3>
  </div>
      <div class="section-body">
          <div class="row">
              <div class="col-lg-12">
                  <div class="card">
                      <div class="card-body">                           
                          <a class="btn btn-warning" href="{{ route('users.create') }}">Add New User</a>        
                         
                            <table class="table table-striped mt-2">
                              <thead style="background-color:#6777ef">                                     
                                  <th style="color:#fff;">NPK</th>
                                  <th style="color:#fff;">Nama</th>
                                  <th style="color:#fff;">username</th>
                                  @role('Admin')
                                  <th style="color:#fff;">Department</th>
                                  @endrole
                                  <th style="color:#fff;">Role User</th>
                                  <th style="color:#fff;">Actions</th>                                                                   
                              </thead>
                              <tbody>
                                @foreach ($users as $user)
                                  <tr>
                                    <td>{{ $user->npk }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    @role('Admin')
                                    <td>{{ $user->department->name }}</td>
                                    @endrole
                                    <td>
                                      @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $rolNombre)                                       
                                          <h5><span class="badge badge-dark">{{ $rolNombre }}</span></h5>
                                        @endforeach
                                      @endif
                                    </td>

                                    <td class="p-2">                                  
                                      <a class="btn btn-warning mb-1" href="{{ route('users.edit',$user->id) }}">Show</a>
                                      <br/>
                                      <a class="btn btn-info mb-1" href="{{ route('users.edit',$user->id) }}">Edit</a>
                                      <br/>

                                      {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                          {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                      {!! Form::close() !!}
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <!-- Centramos la paginacion a la derecha -->
                          <div class="pagination justify-content-end">
                            {!! $users->links() !!}
                          </div>     
                            
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
@endsection