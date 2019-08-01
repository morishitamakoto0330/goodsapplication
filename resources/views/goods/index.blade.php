@extends('layouts/goodsapp')

@section('title', '商品一覧')

@section('content')
	<form action="/goods/create" method="get">
		<button> 新規商品登録 </button>
	</form>

	<table>
		<tr>
			<th> 商品画像 </th>
			<th> 商品名 </th>
			<th> 説明 </th>
			<th> 価格 </th>
			<th> </th>
		</tr>
	@foreach ( $goods as $good )
		{{ csrf_field() }}
		<tr> 
			<td><img class="good-image" src="/storage/{{ $good->imagePath }}" ></td>
			<!-- 商品タイトルは20文字，商品説明は50文字で折り返すように改行コードを挿入する -->
			<!-- 商品価格は見やすさのために3桁ごとにカンマを付ける -->
			@php
				$title = $good->title;
				$lineWidth = 20;
				$num = strlen($title)/$lineWidth;
				for($i = 1; $i <= $num; $i++) {
					$title = substr_replace($title, "\n", ($i*$lineWidth + $i - 1), 0);
				}

				$desc = $good->desc;
				$lineWidth = 50;
				$num = strlen($desc)/$lineWidth;
				for($i = 1; $i <= $num; $i++) {
					$desc = substr_replace($desc, "\n", ($i*$lineWidth + $i - 1), 0);
				}

				$price = strval($good->price);
				$commaWidth = 3;
				$num = (strlen($price) - 1)/$commaWidth;
				for($i = 1; $i <= $num; $i++) {
					$price = substr_replace($price, ",", (strlen($price) - ($i*$commaWidth + $i - 1)), 0);
				}
			@endphp
			<td> {!! nl2br(e($title)) !!} </td>
			<td> {!! nl2br(e($desc))  !!} </td>
			<td> {{ $price }}円 </td>
			<td> 
				<form action="/goods/{{ $good->id }}/edit" method="get">
					<button> 商品編集 </button>
				</form>
				@include('goods.delete') 
			</td>
		</tr>
	@endforeach
	</table>
@endsection

@section('footer')
	copyright 2019 makoto
@endsection


