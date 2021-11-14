@extends('layout')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-left h-100">
            <h2>Edit Data</h2>
        </div> 
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                {!! session('success') !!}
            </div>
        @endif
        
        <div class="col-xl-12 col-md-12 col-sm-12 py-4">
            <form action="{{ route('transaction.update', $data->id) }}" id="user-form" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                      <th><strong>Deskripsi</strong> <span class="text-danger">*</span></th>
                                      <td><textarea name="description" id="message" class="form-control  texteditor  @error('description') is-invalid @enderror " rows=" 5 " placeholder=""> {{ old('description', $data->transaction_header->description) }} </textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                  <th><strong>Code</strong> <span class="text-danger">*</span></th>
                                  <td><input type="text" name="code" id="title" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $data->transaction_header->code) }}" placeholder="Code" /> 
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                </tr>
                                <tr>
                                    <th><strong>Rate Euro</strong> <span class="text-danger">*</span></th>
                                    <td><input type="text" name="rate_euro" id="title" class="form-control @error('rate_euro') is-invalid @enderror" value="{{ old('rate_euro', $data->transaction_header->rate_euro) }}" placeholder="Rate Euro" /> 
                                      @error('rate_euro')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                      @enderror
                                  </td>
                                  </tr>
                                  <tr>
                                      <th><strong>Date Paid</strong> <span class="text-danger">*</span></th>
                                      <td>
                                        <div class="input-group"  data-target-input="nearest">
                                            <input type="text"  name="date_paid" id="event_date" class="form-control datetimepicker-input @error('date_paid') is-invalid @enderror" data-toggle="datetimepicker" data-target="#event_date" value="{{ old('date_paid',  $data->transaction_header->date_paid) }}"  placeholder="11/08/2018"/>
                                            <div class="input-group-append" data-target="#event_date" data-toggle="datetimepicker">
                                                <div class="input-group-addon d-flex align-items-center justify-content-center px-4"><i class="fa fa-calendar"></i></div>
                                            </div>
                                            @error('date_paid')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div> 
                                      </td>
                                  </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row border">
                    <h2>Data Transaksi</h2>
                    <div class="col-md-12">
                        <div class="border">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th width="25%">
                                            <strong>Category</strong> <span class="text-danger">*</span>
                                        </th>
                                        <td>
                                            <select id="category" name="category" class="form-control custom-select @error('category') is-invalid @enderror" /> 
                                                <option value="" disabled>Pilih Kategori</option>
                                                     @foreach ($category as $category)
                                                        <option {{ old('category', $data->transaction_category_id) == $category->id  ? "selected" : "" }}  value="{{ $category->id }}"> {{ ucfirst($category->name) }}</option>
                                                     @endforeach 
                                                {{-- <option value="1" >Income</option> --}}
                                                {{-- <option value="" >Expanse</option> --}}
                    
                                            </select>
                                        </td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="25%"></th>
                                        <td>
                                            <table class="table table-striped">
                                                <thead>
                                                  <tr>
                                                    <th scope="col">Nama Transaksi</th>
                                                    <th scope="col">Nominal (IDR)</th>
                                                  </tr>
                                                </thead>
                                                <tbody  id="table_1">
                                                  <tr>
                                                    <td>
                                                        <input type="hidden" name="category" id="name" class="hidden" value="1"/>
                                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $data->name) }}" placeholder="Nama Transaksi" /> </td>
                                                    <td><input type="text" name="rate_idr" id="name" class="form-control @error('rate_idr') is-invalid @enderror" value="{{ old('rate_idr', $data->rate_idr) }}" placeholder="Rate Idr" /> </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                        </td>
                                        <td width="20%"> <button type="button" id="plus" class="btn btn-success rounded-pill disabled"><i class="fa fa-plus" aria-hidden="true"></i></button> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        
                    </div>

                </div>

                <div class="d-flex justify-content-end py-4">
                    <div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="#" type="button" class="btn btn-danger">Batal</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="{{ asset('default') }}/vendor/datetimepicker/moment.min.js"></script>
    <script type="text/javascript">    
		$(document).ready(function () {
			$('#event_date').datepicker({ dateFormat: 'dd-mm-yy' }).val();
        });

        let plus =  document.getElementById("plus");
        let count = 0;

        plus.addEventListener('click', (event) => {
            count++;
            let element = event.target;

            // menambah satu row table 1
            let tableRef = document.getElementById("table_1");

            let newRow = tableRef.insertRow(-1);
            let cell1 = newRow.insertCell(0);
            let cell2 = newRow.insertCell(1);

            // isi table
            cell1.innerHTML = `
            <input type="hidden" name="detail[${count}][category]" id="name" class="form-control @error('name') is-invalid @enderror" value="1" />
            
            <input type="text" name="detail[${count}][name]" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama Transaksi" />`;
            cell2.innerHTML = `<input type="text" name="detail[${count}][rate_idr]" id="name" class="form-control @error('rate_idr') is-invalid @enderror" value="{{ old('rate_idr') }}" placeholder="Rate Idr" />`;
        });


        let plus_2 = document.getElementById("plus_2");
        let count_2 = 0;

        plus_2.addEventListener('click', (event) => {
            // menambah satu row table
            count_2++;
            let tableRef_2 = document.getElementById("table_2");

            let newRow_2 = tableRef_2.insertRow(-1);
            let cell1_2 = newRow_2.insertCell(0);
            let cell2_2 = newRow_2.insertCell(1);

            // isi table
            cell1_2.innerHTML = `
            <input type="hidden" name="detail_2[${count_2}][category]" id="name" class="form-control @error('name') is-invalid @enderror" value="2" />
            <input type="text" name="detail_2[${count_2}][name]" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Nama Transaksi" />`;
            cell2_2.innerHTML = `<input type="text" name="detail_2[${count_2}][rate_idr]" id="name" class="form-control @error('rate_idr') is-invalid @enderror" value="{{ old('rate_idr') }}" placeholder="Rate Idr" />`;

        })

    </script>
@endpush

@endsection