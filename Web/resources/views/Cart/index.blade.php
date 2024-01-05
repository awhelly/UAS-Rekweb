@extends('../layout/' . $layout)
@section('subhead')
<title>Penjualan</title>
@endsection
@section('subcontent')
<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
  <h2 class="text-lg font-medium mr-auto">
      Point of Sale {{ $datacart['id'] }}
  </h2>
  <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
		@if ($datacart['id'] = 0)
			<a href="javascript:;" data-tw-toggle="modal" data-tw-target="#new-order-modal" class="btn btn-primary shadow-md mr-2">Pesanan Baru</a> 	
		@else
			<a href="javascript:;" data-tw-toggle="modal" data-tw-target="#new-order-modal" class="btn btn-primary shadow-md mr-2">Pesanan Baru</a> 	
		@endif
    
			<div class="pos-dropdown dropdown ml-auto sm:ml-0">
          <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
              <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="chevron-down"></i> </span>
          </button>
          <div class="pos-dropdown__dropdown-menu dropdown-menu">
              <ul class="dropdown-content">
                  <li>
                      <a href="" class="dropdown-item"> <i data-lucide="activity" class="w-4 h-4 mr-2"></i> <span class="truncate">INV-0206020 - Nicolas Cage</span> </a>
                  </li>
                  <li>
                      <a href="" class="dropdown-item"> <i data-lucide="activity" class="w-4 h-4 mr-2"></i> <span class="truncate">INV-0206022 - Arnold Schwarzenegger</span> </a>
                  </li>
                  <li>
                      <a href="" class="dropdown-item"> <i data-lucide="activity" class="w-4 h-4 mr-2"></i> <span class="truncate">INV-0206021 - Denzel Washington</span> </a>
                  </li>
              </ul>
          </div>
      </div>
  </div>
</div>
<div class="intro-y grid grid-cols-12 gap-5 mt-5">
  <!-- BEGIN: Item List -->
  <div class="intro-y col-span-12 lg:col-span-8">
      <div class="lg:flex intro-y">
          <div class="relative">
              <input type="text" class="form-control py-3 px-4 w-full lg:w-64 box pr-10" placeholder="Search item...">
              <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0 text-slate-500" data-lucide="search"></i> 
          </div>
          <select class="form-select py-3 px-4 box w-full lg:w-auto mt-3 lg:mt-0 ml-auto">
              <option>Sort By</option>
              <option>A to Z</option>
              <option>Z to A</option>
              <option>Lowest Price</option>
              <option>Highest Price</option>
          </select>
      </div>
      <div class="grid grid-cols-12 gap-5 mt-5">
				@foreach ($dataKategori as $kategori)
					<div class="col-span-12 sm:col-span-4 2xl:col-span-3 box p-5 cursor-pointer zoom-in">
						<div class="font-medium text-base">{{ $kategori['nama'] }}</div>
						<div class="text-slate-500">{{ \App\Helper::count('kategori',$kategori['id'],'produk') }} Produk</div>
					</div>
				@endforeach
      </div>
      <div class="grid grid-cols-12 gap-5 mt-5 pt-5 border-t">
				@foreach ($dataProduk as $produk)
				<a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal" class="intro-y block col-span-12 sm:col-span-4 2xl:col-span-3">
					<div class="box rounded-md p-3 relative zoom-in">
						<div class="flex-none relative block before:block before:w-full before:pt-[50%]">
							<div class="absolute top-0 left-0 w-full h-full image-fit">
								{{-- <img alt="Midone - HTML Admin Template" class="rounded-md" src="dist/images/food-beverage-16.jpg"> --}}
							</div>
						</div>
						<div class="block font-medium text-center truncate mt-3">{{ $produk['nama'] }}</div>
						<div class="block font-small text-center mt-3">Rp{{ number_format($produk['harga'],0,',','.') }}</div>
					</div>
				</a>
				@endforeach

      </div>
  </div>
  <!-- END: Item List -->
  <!-- BEGIN: Ticket -->
  <div class="col-span-12 lg:col-span-4">
      <div class="intro-y pr-1">
          <div class="box p-2">
              <ul class="nav nav-pills" role="tablist">
                  <li id="ticket-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#ticket" type="button" role="tab" aria-controls="ticket" aria-selected="true" > Ticket </button>
                  </li>
                  <li id="details-tab" class="nav-item flex-1" role="presentation">
                      <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false" > Details </button>
                  </li>
              </ul>
          </div>
      </div>
      <div class="tab-content">
          <div id="ticket" class="tab-pane active" role="tabpanel" aria-labelledby="ticket-tab">
              <div class="box p-2 mt-5">
                  <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-darkmode-600 hover:bg-slate-100 dark:hover:bg-darkmode-400 rounded-md">
                      <div class="max-w-[50%] truncate mr-1">Crispy Mushroom</div>
                      <div class="text-slate-500">x 1</div>
                      <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-2"></i> 
                      <div class="ml-auto font-medium">$39</div>
                  </a>
                  <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-darkmode-600 hover:bg-slate-100 dark:hover:bg-darkmode-400 rounded-md">
                      <div class="max-w-[50%] truncate mr-1">Pocari</div>
                      <div class="text-slate-500">x 1</div>
                      <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-2"></i> 
                      <div class="ml-auto font-medium">$34</div>
                  </a>
                  <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-darkmode-600 hover:bg-slate-100 dark:hover:bg-darkmode-400 rounded-md">
                      <div class="max-w-[50%] truncate mr-1">Milkshake</div>
                      <div class="text-slate-500">x 1</div>
                      <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-2"></i> 
                      <div class="ml-auto font-medium">$46</div>
                  </a>
                  <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-darkmode-600 hover:bg-slate-100 dark:hover:bg-darkmode-400 rounded-md">
                      <div class="max-w-[50%] truncate mr-1">Ultimate Burger</div>
                      <div class="text-slate-500">x 1</div>
                      <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-2"></i> 
                      <div class="ml-auto font-medium">$65</div>
                  </a>
                  <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#add-item-modal" class="flex items-center p-3 cursor-pointer transition duration-300 ease-in-out bg-white dark:bg-darkmode-600 hover:bg-slate-100 dark:hover:bg-darkmode-400 rounded-md">
                      <div class="max-w-[50%] truncate mr-1">Curry Penne and Cheese</div>
                      <div class="text-slate-500">x 1</div>
                      <i data-lucide="edit" class="w-4 h-4 text-slate-500 ml-2"></i> 
                      <div class="ml-auto font-medium">$90</div>
                  </a>
              </div>
              <div class="box flex p-5 mt-5">
                  <input type="text" class="form-control py-3 px-4 w-full bg-slate-100 border-slate-200/60 pr-10" placeholder="Use coupon code...">
                  <button class="btn btn-primary ml-2">Apply</button>
              </div>
              <div class="box p-5 mt-5">
                  <div class="flex">
                      <div class="mr-auto">Subtotal</div>
                      <div class="font-medium">$250</div>
                  </div>
                  <div class="flex mt-4">
                      <div class="mr-auto">Discount</div>
                      <div class="font-medium text-danger">-$20</div>
                  </div>
                  <div class="flex mt-4">
                      <div class="mr-auto">Tax</div>
                      <div class="font-medium">15%</div>
                  </div>
                  <div class="flex mt-4 pt-4 border-t border-slate-200/60 dark:border-darkmode-400">
                      <div class="mr-auto font-medium text-base">Total Charge</div>
                      <div class="font-medium text-base">$220</div>
                  </div>
              </div>
              <div class="flex mt-5">
                  <button class="btn w-32 border-slate-300 dark:border-darkmode-400 text-slate-500">Clear Items</button>
                  <button class="btn btn-primary w-32 shadow-md ml-auto">Charge</button>
              </div>
          </div>
          <div id="details" class="tab-pane" role="tabpanel" aria-labelledby="details-tab">
              <div class="box p-5 mt-5">
                  <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 pb-5">
                      <div>
                          <div class="text-slate-500">Time</div>
                          <div class="mt-1">02/06/20 02:10 PM</div>
                      </div>
                      <i data-lucide="clock" class="w-4 h-4 text-slate-500 ml-auto"></i> 
                  </div>
                  <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 py-5">
                      <div>
                          <div class="text-slate-500">Customer</div>
                          <div class="mt-1">Robert De Niro</div>
                      </div>
                      <i data-lucide="user" class="w-4 h-4 text-slate-500 ml-auto"></i> 
                  </div>
                  <div class="flex items-center border-b border-slate-200 dark:border-darkmode-400 py-5">
                      <div>
                          <div class="text-slate-500">People</div>
                          <div class="mt-1">3</div>
                      </div>
                      <i data-lucide="users" class="w-4 h-4 text-slate-500 ml-auto"></i> 
                  </div>
                  <div class="flex items-center pt-5">
                      <div>
                          <div class="text-slate-500">Table</div>
                          <div class="mt-1">21</div>
                      </div>
                      <i data-lucide="mic" class="w-4 h-4 text-slate-500 ml-auto"></i> 
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- END: Ticket -->
</div>
<!-- BEGIN: New Order Modal -->
<div id="new-order-modal" class="modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="font-medium text-base mr-auto">
					Pesanan Baru
				</h2>
			</div>
			<form action="{{ route('cart-store') }}" method='POST'>
				@csrf
			<div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
				<div class="col-span-12">
					<label for="pos-form-1" class="form-label">Nama</label>
					<input id="pos-form-1" type="text" class="form-control flex-1" placeholder="Nama Pelanggan" name="pembeli">
				</div>
			</div>
			<div class="modal-footer text-right">
				<button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-32 mr-1">Cancel</button>
				<button type="submit" class="btn btn-primary w-32">Create Ticket</button>
			</div>
			</form>
		</div>
  </div>
</div>
<!-- END: New Order Modal -->
</div>
<!-- END: Content -->
	@endsection
	