@extends('../layout/' . $layout)
@section('subhead')
<title>Dashboard - Rekayasa Web</title>
@endsection
@section('subcontent')
<h2 class="intro-y text-lg font-medium mt-10">List Data Kategori</h2>
<div class="grid grid-cols-12 gap-6 mt-5">
	<div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
		<a href="{{ route('kategori-create') }}"><button class="btn btn-primary shadow-md mr-2">
			Tambah Kategori</button></a>
			<div class="hidden md:block mx-auto text-slate-500">Showing list data entries</div>
			<div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
			</div>
		</div>
		<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
			@if (session('success'))
			{{ session('success') }}
			@endif
			<table class="table table-report -mt-2">
				<thead>
					<tr>
						<th class="whitespace-nowrap">ID</th>
						<th class="whitespace-nowrap">Kode</th>
						<th class="whitespace-nowrap">Nama Kategori</th>
						<th class="whitespace-nowrap">Deskripsi</th>
						<th class="text-center whitespace-nowrap">Status</th>
						<th class="text-center whitespace-nowrap">ACTIONS</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($data as $value)
					<tr class="intro-x">
						<td class="w-40">{{ $value['id'] }}</td>
						<td>{{ $value['kode'] }}</td>
						<td>{{ $value['nama'] }}</td>
						<td>{{ $value['deskripsi'] }}</td>
						<td class="text-center">
						@if ($value['status'] == 'Publish')
						<button class="btn btn-rounded btn-success-soft w-24 mt-1 mr-1 mb-1">Publish</button>
						@else
						<button class="btn btn-rounded btn-secondary-soft w-24 mt-1 mr-1 mb-1">Hide</button>
						@endif
						</td>
						<td class="table-report__action w-56">
							
							<form action="{{ route('kategori-destroy', $value['id']) }}" method='POST'>
								@csrf
								@method('delete')
								<div class="flex justify-center items-center">
									<a class="flex items-center mr-3" href="{{ route('kategori-edit', $value['id']) }}">
										<i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
									</a>
									<button class="flex items-center text-danger" type="submit" data-tw-toggle="modal"
									data-tw-target="#delete-confirmation-modal">
									<i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
								</button>
								
							</div>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endsection
	