@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="detail-content">
    <h3><span class="detail-content__title">商品一覧</span>＞{{ $product['name']}}</h3>
    <form class="form" action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
        @method('patch')
        @csrf
        <div class="form-group__div">
            <div class="form-group__img">
                <img src="{{ asset( $product->image) }}" width="200" alt="{{ $product->name }}">
                <input type="file" class="form-group__img-input" name="image" accept="image/*">
                <p class="form__error-message">
                    @if ($errors->has('image'))
                        @foreach ($errors->get('image') as $error)
                        <span>{{ $error }}</span><br>
                        @endforeach
                    @endif
                </p>
            </div>
            <div class="form-group">
                <div class="form-group_name">
                    <label for="name" class="form-group__label">商品名</label>
                    <input type="text" class="form-group__name-input" name="name" value="{{ old('name', $product->name) }}">
                    <p class="form__error-message">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
                <div class="form-group__price">
                    <label for="price" class="form-group__label">値段</label>
                    <input type="text" class="form-group__price-input" name="price" value="{{ old('price', $product->price) }}">
                    <p class="form__error-message">
                        @if ($errors->has('price'))
                            @foreach ($errors->get('price') as $error)
                            <span>{{ $error }}</span><br>
                            @endforeach
                        @endif
                    </p>
                </div>
                <div class="form-group__season">
                    <label for="season" class="form-group__label">季節</label>
                    <div class="checkboxes">
                        @foreach(['春'=>1, '夏'=>2, '秋'=>3, '冬'=>4] as $label => $val)
                            <label>
                                <input class="form-group__season-input" type="checkbox" name="season[]" value="{{ $val }}"
                                    {{ in_array($val, old('season', $selectedSeasons)) ? 'checked' : '' }}>
                                {{ $label }}
                            </label>
                        @endforeach
                    </div>
                    <p class="form__error-message">
                        @error('season')
                        {{ $message }}
                        @enderror
                    </p>
                </div>
            </div>
        </div>
        <div class="form-group__description">
            <label for="description" class="form-group__label">商品説明</label>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
            <p class="form__error-message">
                @if ($errors->has('description'))
                    @foreach ($errors->get('description') as $error)
                    <span>{{ $error }}</span><br>
                    @endforeach
                @endif
            </p>
        </div>

        <div class="form__btn">
            <a href="/products" class="form__back-btn">戻る</a>
            <input type="submit" class="form__btn-submit" value="変更を保存" >
        </div>
    </form>

    <form action="/products/{{ $product->id }}/delete" class="delete-form">
        @method('delete')
        @csrf
        <div class="delete-form__btn">
            <button class="delete-form__btn-submit" type="submit">
                <img src="{{ asset('images/vector.svg') }}" alt="削除" class="delete-icon">
            </button>
        </div>
    </form>
</div>
@endsection