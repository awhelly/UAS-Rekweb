@extends('../layout/' . $layout)
@section('subhead')
<title>Edit Produk</title>
@endsection
@section('subcontent')
<div class="intro-y flex items-center mt-8">
	<h2 class="text-lg font-medium mr-auto">Form Edit Data Produk</h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
	<div class="intro-y col-span-12 lg:col-span-6">
		@if(count($errors) > 0)
		@foreach($errors->all() as $error)
		<div class="alert alert-warning">{{ $error }}</div>
		@endforeach
		@endif
		<!-- BEGIN: Form Layout -->
		<form action="{{ route('produk-update',$data['id']) }}" method='POST'>
			@csrf
			@method("put")
			<div class="intro-y box p-5">
				<label for="crud-form-1" class="form-label">Kategori Produk</label>
				<div class="flex flex-col sm:flex-row items-center">
					<select name="kategori_id" class="form-select mt-2 sm:mr-2" aria-label="Default select example">
						@foreach ($datakategori as $value)
							<option value="{{ $value['id'] }}" 
							@if ($data['kategori_id'] == $value['id'])
								selected	
							@endif
							>{{  $value['nama'] }}</option>
						@endforeach
					</select> 
				</div>
			<div class="mt-3">
				<div>
					<label for="crud-form-1" class="form-label">Kode Produk</label>
					<input id="kode" type="text" class="form-control w-full" name="kode" value="{{ $data['kode'] }}"> 
				</div>
			<div class="mt-3">
				<div>
					<label for="crud-form-1" class="form-label">Nama Produk</label>
					<input id="nama" type="text" class="form-control w-full" name="nama" value="{{ $data['nama'] }}">
				</div>
			<div class="mt-3">
				<div>
					<label for="crud-form-1" class="form-label">Deskripsi Produk</label>
					<input id="deskripsi" type="text" class="form-control w-full" name="deskripsi" value="{{ $data['deskripsi'] }}" >
				</div>
				</div>
			<div class="mt-3">
				<div>
					<label for="crud-form-1" class="form-label">Jumlah Stok</label>
					<input id="qty" type="number" class="form-control w-full" name="qty" value="{{ $data['qty'] }}" >
				</div>
			</div>
			<div class="mt-3">
				<div>
					<label for="crud-form-1" class="form-label">Satuan</label>
					<input id="satuan" type="text" class="form-control w-full" name="satuan" value="{{ $data['satuan'] }}" >
				</div>
			</div>
			<div class="mt-3">
				<div>
					<label for="crud-form-1" class="form-label">Harga</label>
					<input id="harga" type="number" class="form-control w-full" name="harga" value="{{ $data['harga'] }}" >
				</div>
			</div>
			<div class="mt-3">
				<label for="crud-form-1" class="form-label">Status</label>
				<div class="flex flex-col sm:flex-row items-center">
					<select name="status" class="form-select mt-2 sm:mr-2" aria-label="Default select example">
						<option value="Publish">Publish</option>
						<option value="Hide">Hide</option>
					</select> 
				</div>
			</div>
			<div class="mt-3">
				<div class="text-right mt-5">
					<button type="reset" class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
					<button type="submit" class="btn btn-primary w-24">Save</button>
				</div>
			</div>
		</form>
		<!-- END: Form Layout -->
	</div>
</div>
@endsection
			
@section('script')
<script src="{{ mix('dist/js/ckeditor-classic.js') }}"></script>
@endsection