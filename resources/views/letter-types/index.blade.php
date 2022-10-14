@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Jenis Form</h3>
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
        
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">Nama Form</th>
                                    <th style="color:#fff;">Aksi</th>
                                </thead>  
                                <tbody>
                                @foreach ($letterTypes as $type)
                                <tr>                           
                                    <td>{{ $type->name }}</td>
                                    <td>
                                        <a class="btn btn-success" href="{{ route('letter-types.show',$type->id) }}">Lihat Form</a>
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
