@extends('layouts.app')

@section('content')
 @php
    use Illuminate\Support\Carbon;
@endphp
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Form Surat Perintah Lembur</h3>
        </div>
        
        @include('layouts.partials.alert')

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
                            <div class="row flex justify-content-between">
                                <div class="d-flex">
                                    <a href="{{ route('letters.perintah-kerja-lembur.create') }}" class="btn btn-primary" title="Klik untuk mengajukan form perintah kerja lembur.">Tambahkan Form Perintah Lembur</a>                        
                                </div>
                                
                                <div class="d-flex">
                                    <a href="{{ route('letter-types.download', 6) }}" class="btn btn-secondary mr-auto" title="Click to Download Template.">Download Template Form</a>                        
                                </div>

                            </div>
                            
                            <hr/>
                        
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    <th style="color:#fff;">Hari/Tanggal</th>
                                    <th style="color:#fff;">Department</th>
                                    <th style="color:#fff;">Actions</th>
                                </thead>  
                                <tbody>
                                   
                                @foreach ($suratPerintahLembur as $perintahLembur)
                                <tr>  
                                    <td>
                                        {{ Carbon::parse($perintahLembur->waktu)->format('l, j F Y')               }}                              
                                    </td>
                                    <td>{{ $perintahLembur->department->name }}</td>
                                    <td class="p-1">  

                                        @if ($perintahLembur->evidence !== null)
                                            
                                        <a class="btn btn-success mb-1" href="{{ route('letters.perintah-kerja-lembur.download',[$perintahLembur->id]) }}">Download</a>
                                        <br/>
                                        @endif

                                        <a class="btn btn-primary mb-1" href="{{ route('letters.perintah-kerja-lembur.show-detail',$perintahLembur->id) }}">Detail</a>
                                        <br/>
                                        
                                        @unlessrole('Operator')
                                        <a class="btn btn-info mb-1" href="{{ route('letters.perintah-kerja-lembur.edit-detail',$perintahLembur->id) }}">Edit</a>
                                        <br/>

                                            {!! Form::open(['method' => 'DELETE','route' => ['letters.perintah-kerja-lembur.destroy', $perintahLembur->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        @endunlessrole
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>               
                            </table>

                            <div class="pagination justify-content-end">
                                @role('Admin')
                                {!! $suratPerintahLembur->links() !!} 
                                @endrole
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
