@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reports</h3>
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
                            
                            <div class="row">
                                <div class="col-xs-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('department', 'Pilih Department') !!}
                                        <select name="department" id="department" class="form-control form-filter">
                                            <option value="0" selected>Pilih Department</option>
                                            @foreach ($departments as $key => $item)
                                                <option value="{{ $key }}" {{ $department == $key ? 'selected' : '' }}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
    
                                <div class="col-xs-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                                        {!! Form::label('letter_type', 'Pilih Jenis Form') !!}
                                        <select name="letter_type" id="letter_type" class="form-control form-filter">
                                            <option value="0" selected>Pilih Jenis Form</option>
                                            @foreach ($letterTypes as $key => $item)
                                                <option value="{{ $key }}" {{ $letterType == $key ? 'selected' : '' }}>{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-xs-3 col-md-3 col-sm-3">
                                    <div class="form-group mt-4">
                                        <a id="btn-filter" class="btn btn-lg btn-info ">Filter</a>
                                        <a href="{{ route('reports.filter', [0,0]) }}" id="btn-reset" class="btn btn-lg btn-danger">Reset</a>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-striped mt-2">
                                <thead style="background-color:#6777ef">                                                       
                                    
                                     @if ($letterType !== '6')
                                        <th style="color:#fff;">NPK</th>
                                        <th style="color:#fff;">Nama</th>
                                    @endif

                                    @if ($department == '%')
                                        <th style="color:#fff;">Department</th>
                                    @endif
                                    <th style="color:#fff;">Actions</th>
                                </thead>  
                                <tbody>
                                @if ($letterType == null || $letterType == '0')
                                    <tr>
                                        <td align="center" colspan="{{ $department == '%' ? 5 : 4 }}">
                                            Data tidak ditemukan! Mohon Pilih Salah Satu Jenis Form!
                                        </td>
                                    </tr>
                                @else
                                    
                                    @forelse ($forms as $form)
                                    <tr>            
                                        @if ($letterType !== '6')
                                            <td>{{ $form->npk }}</td>
                                            <td>{{ $form->name }}</td>
                                        @endif               
                                        @if ($department == '%')
                                            <td>{{ $form->user->department->name ?? $form->department->name }}</td>
                                        @endif
                                       
                                        <td>   
                                             {!! Form::open(['method' => 'POST','route' => ['reports.download'],'style'=>'display:inline']) !!}
                                               {!! Form::text('path', $form->evidence, ['hidden']) !!}
                                                {!! Form::submit('Download', ['class' => 'btn btn-primary']) !!}
                                            {!! Form::close() !!}
                                            {{-- <a class="btn btn-primary" href="{{ route('reports.download',[$form->evidence]) }}" target="_blank">Download Evidence</a> --}}
                                        @if ($letterType == '6')
                                            <a href="{{ route('letters.perintah-kerja-lembur.show-detail', $form->id) }}" class="btn btn-secondary text-dark">Detail</a>
                                        @endif

                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                        <td colspan="4" align="center"> Data tidak ditemukan!</td>
                                        </tr>
                                    @endforelse
                                 @endif
                                </tbody>               
                            </table>

                            <div class="pagination justify-content-end">
                                @if (sizeof($forms) !== 0)
                                    {!! $forms->links() !!} 
                                @endif
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        const btnFilter = document.getElementById('btn-filter');
        const departmentEl = document.getElementById('department');
        const letterTypeEl = document.getElementById('letter_type');

        let paramsDepartment = 0;
        let paramsLetterType = 0;
        const BASE_URL = {!! json_encode(url('reports')) !!}
        let URL = BASE_URL + '/' + paramsDepartment + '/' + paramsLetterType;

        const changeURL = () => {
            URL = BASE_URL + '/' + paramsDepartment + '/' + paramsLetterType;
            document.getElementById('btn-filter').setAttribute('href', URL);
            console.log(btnFilter);
        }

        const changeDepartmentValue = () => {
            paramsDepartment = departmentEl.value;
        }

        const changeLetterTypeValue = () => {
            paramsLetterType = letterTypeEl.value;
        }

        const resetDepartmentValue = () => {
            paramsDepartment = 0;
        }

        const resetLetterTypeValue = () => {
            paramsLetterType = 0;
        }


        departmentEl.addEventListener('change', () => {
            console.log(departmentEl);
            resetDepartmentValue();   
            changeDepartmentValue(); 
            changeURL();
        });
        

        letterTypeEl.addEventListener('change', () => {
            resetLetterTypeValue()
            changeLetterTypeValue()
            changeURL(); 
        });

        changeDepartmentValue();
        changeLetterTypeValue();
    });
</script>
@endsection