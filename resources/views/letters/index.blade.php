@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Form Masuk</h3>
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
                            <h4>Pilih Department</h4>
                        </div>
                        <div class="card-body">
        
                        <table class="table table-striped mt-2">
                            <thead style="background-color:#6777ef">                                                       
                                <th style="color:#fff;">Department</th>
                                <th style="color:#fff;">Actions</th>
                            </thead>  
                            <tbody>
                            @foreach ($departments as $department)
                            <tr>
                                <td>{{ $department->name }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('letters.show',$department->id) }}">Lihat Form</a>
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
