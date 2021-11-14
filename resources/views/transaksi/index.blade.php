@extends('layout')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-left h-100">
            <h2>List Data Transaksi</h2>
        </div> 
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                {!! session('success') !!}
            </div>
        @endif
        <div class="d-flex align-items-center justify-content-between">
            <div class="">
                <a href="{{ route('transaction.create') }}" type="button" class="btn btn-primary">Tambah Transaksi</a>
            </div>
            <form id="search" action="{{ route('transaction.index') }}" method="GET">
                <div class="d-inline-flex">
                    <input type="text"  name="date_start" id="event_date" class="form-control form-control-sm datetimepicker-input" data-toggle="datetimepicker" data-target="#event_date" value="{{ request()->date_start ?? '' }}"  placeholder="11/08/2018"/> 
                    <div class="input-group-addon d-flex align-items-center justify-content-center px-1">
                    <i class="fa fa-calendar fa-2"></i>
                    </div>
                    <div class="p-1">to</div>
                    <input type="text"  name="date_end" id="event_date2" class="form-control form-control-sm datetimepicker-input" data-toggle="datetimepicker" data-target="#event_date2" value="{{ request()->end ?? ''}}"  placeholder="11/08/2018"/> 
                    <div class="input-group-addon d-flex align-items-center justify-content-center px-1">
                    <i class="fa fa-calendar fa-2"></i>
                    </div>
                    <select id="category" name="catagory_id" class="form-control custom-select-sm form-control-sm mx-1" /> 
                    <option value="" selected disabled>Pilih Kategori</option>
                        <option value="1" >Income</option>
                        <option value="2" >Expanse</option>
                    </select>
                    <input type="text"  name="search" id="search" class="form-control form-control-sm" value=""  placeholder="Search"/> 
                    <div class="input-group-addon d-flex align-items-center justify-content-center px-1 border">
                    <i class="fa fa-search fa-2"></i>
                    </div>
                    <button type="submit" class="btn btn-sm btn-secondary mx-2">Search</button>
            
                </div>
            </form>
        </div>
        <div class="row py-4">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Code</th>
                    <th scope="col">Rate Euro</th>
                    <th scope="col">Data Paid</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Nama Transaksi</th>
                    <th scope="col">Nominal (IDR)</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($transaction_list as $index => $item)      
                    <tr>
                        <th scope="row"> {{ $rank++ }}</th>
                        <td>{{ $item->transaction_header->description }}</td>
                        <td>{{ $item->transaction_header->code }}</td>
                        <td>{{ $item->transaction_header->rate_euro }}</td>
                        <td>{{ showDateTime($item->transaction_header->date_paid, 'd F Y') }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->rate_idr }}</td>
                        <td>
                            <div class="btn btn-sm btn-danger pull-right delete" title="Hapus" data-toggle="modal" data-target="#deleteMenu-{{ $index }}" data-id="">
                                <i class="fas fa-trash-alt"></i>
                            </div>
                            
                    <div class="modal fade scale" id="deleteMenu-{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteMenuTitle" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title">Hapus Berita</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">    
                                    <form id="role-menu-form-delete" action="{{ route('transaction.destroy', $item->id) }}" spellcheck="false"  method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="mb-4 pb-2">Apa Anda yakin ingin menghapus data ini ?</div>
                                        <div id="role-menu-form-delete-errors"></div>
                                        <button type="submit" class="btn btn-danger mb-2">Hapus</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            <a href="{{ route('transaction.edit', $item->id) }}" class="btn btn-sm btn-primary pull-right edit">
                            <i class="fas fa-edit"></i>
                        </a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="d-flex justify-content-center my-4">
                  {{  $transaction_list->links() }}
              </div>
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

        $(document).ready(function () {
			$('#event_date2').datepicker({ dateFormat: 'dd-mm-yy' }).val();
        });
</script>
@endpush

@endsection