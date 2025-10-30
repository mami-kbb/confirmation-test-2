@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="products-content">
    <div class="products-content__header">
        <h2>{{ $message }}</h2>
        @if(empty($keyword))
        <a href="/products/register" class="product-register">+&nbsp;商品を追加</a>
        @endif
    </div>
    <div class="products-content__item">
        <div class="products-search">
            <form class="products-search__form" action="/products/search" method="get">
                <div class="search-group">
                    <input type="text" class="products-search__input" name="keyword" value="{{ $keyword ?? '' }}" placeholder="商品名で検索">
                    <div class="products-search__button">
                        <button type="submit" class="products-search__button-submit">検索</button>
                    </div>
                </div>
                <div class="search-group__select">
                    <p class="products-search__select-label">価格順で表示</p>
                    <select name="price" class="price-select" onchange="this.form.submit()">
                        <option value="">価格で並び替え</option>
                        <option value="high" {{ (isset($priceOrder) && $priceOrder == 'high') ? 'selected' : '' }}>価格が高い順</option>
                        <option value="low" {{ (isset($priceOrder) && $priceOrder == 'low') ? 'selected' : '' }}>価格が低い順</option>
                    </select>
                </div>
            </form>
            @if(!empty($priceOrder))
            <div class="filter-tag">
                <span>
                    @if($priceOrder == 'high')高い順に表示
                    @elseif($priceOrder == 'low') 低い順に表示
                    @endif
                </span>
                <a href="{{ route('products.search', ['keyword' => $keyword]) }}" class="reset-tag">×</a>
            </div>
            @endif
        </div>
        <div class="products-list">
            <div class="products-list__div">
                @forelse($products as $product)
                <a href="{{ route('products.show', $product->id) }}" class="product-card">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    <div class="product-card__text">
                        <h3>{{ $product->name }}</h3>
                        <p class="product-price">&yen;{{ number_format($product->price) }}</p>
                    </div>
                </a>
                @empty
                <p class="message">該当する商品が見つかりませんでした。</p>
                @endforelse
            </div>
            <div class="pagination">
                {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection