<?php

namespace App\Main;

class SideMenu {
	/**
	 * List of side menu items.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public static function menu()	{
		return [
			'penjualan' => [
				'icon' => 'shopping-cart',
				'title' => 'Penjualan',
				'route_name' => 'cart-index',
				'params' => [
					'layout' => 'side-menu',
				],
			],
			'kategori' => [
				'icon' => 'folder',
				'title' => 'Kategori',
				'route_name' => 'kategori-index',
				'params' => [
					'layout' => 'side-menu',
				],
			],
			'produk' => [
				'icon' => 'tag',
				'title' => 'Produk',
				'route_name' => 'produk-index',
				'params' => [
					'layout' => 'side-menu',
				],
			],
		];
	}
}
