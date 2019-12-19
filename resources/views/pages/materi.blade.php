@extends('layout.app')

@section('site-title', 'Materi')
@section('page-title', 'Kelola Materi')
@section('isMateri', 'active')

@section('custom-style-library')
	<link href="{{ asset('vendor/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('main-content')

<div class="row">
	<div class="col-12">
		<div class="card border-left-primary">
			<div class="card-body">
				<div class="row col justify-content-between mb-3">
					<h5 class="card-title text-primary font-weight-bold my-auto">Daftar Materi</h5>
					<button class="btn btn-outline-primary" data-toggle="modal" data-target="#add-materi-modal">Tambah Materi</button>
				</div>
				<div class="table-responsive">
					<table class="table table-striped table-hover datatables">
						<thead>
							<tr>
								<th>No.</th>
								<th>Judul Video</th>
								<th>Video</th>
								<th>Opsi</th>
							</tr>
						</thead>
						<tbody>
						@php $no = 1 @endphp
						@foreach($materis as $materi)
							<tr>
								<td>{{ $no }}.</td>
								<td>{{ $materi->judul_materi }}</td>
								<td>{{ $materi->filename }}</td>
								<td class="d-flex align-items-center">
									<a href="{{ route('materi.edit', $materi->id_materi) }}"><i class="fas fa-edit" title="Edit" data-toggle="tooltip"></i></a>
									<form method="POST" action="{{ route('materi.destroy', $materi->id_materi) }}" onsubmit="return confirm('Anda yakin?')">
										@csrf
										@method('DELETE')

										<button class="btn"><i class="fas fa-trash text-danger" title="Delete" data-toggle="tooltip"></i></button>
									</form>
								</td>
							</tr>
							@php $no++ @endphp
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('modal-content')

<div class="modal fade" id="add-materi-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Materi</h5>
			</div>
			<div class="modal-body">
				<div class="alert alert-success d-none">
					Video berhasil diupload
					<button class="close" data-dismiss="alert">&times;</button>
				</div>
				<form method="POST" action="{{ route('materi.store') }}">
					@csrf
					<div class="form-group">
						<label class="control-label">Judul Video</label>
						<input type="text" name="judul" class="form-control" required>
					</div>
					<div class="form-group">
						<label class="control-label">Video</label>
						<div class="input-group">
							<div class="custom-file">
								<input type="file" name="video" class="custom-file-input" id="video-upload" data-url="{{ route('materi.handleUpload') }}" accept="video/*" required>
								<label class="custom-file-label" id="upload-video-label">Pilih video</label>
							</div>
							<div class="input-group-append" id="container-upload-btn"></div>
						</div>
						<small class="form-text text-muted">Pilih video terlebih dahulu, kemudian klik Upload sebelum klik Simpan.</small>
						<div class="progress progress-sm d-none">
							<div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary float-right">Simpan</button>
						<a href="javascript:void(0)" data-dismiss="modal" class="btn btn-danger float-right mr-2">Batal</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('necessary-library')
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-file-upload/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('vendor/jquery-file-upload/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('vendor/jquery-file-upload/jquery.fileupload.js') }}"></script>
@endsection