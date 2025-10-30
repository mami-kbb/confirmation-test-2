@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('content')
<div class="create-content">
    <div class="create-content__header">
        <h2>商品登録</h2>
    </div>
    <form action="/products/register" class="create-form" method="post">
        @csrf
        <div class="create-form__group">
            <label for="name" class="create-form__label">
                商品名<span class="create-form__required">必須</span>
            </label>
            <input type="text" class="create-form__name-input" name="name" id="name" value="{{ old('name') }}" placeholder="商品名を入力">
            <p class="create-form__error-message">
                @error('name')
                {{ $message }}
                @enderror
            </p>
        </div>

        <div class="create-form__group">
            <label for="price" class="create-form__label">
                値段<span class="create-form__required">必須</span>
            </label>
            <input type="text" class="create-form__price-input" name="price" id="price" value="{{ old('price') }}" placeholder="値段を入力">
            <p class="create-form__error-message">
                @if ($errors->has('price'))
                    @foreach ($errors->get('price') as $error)
                    <span>{{ $error }}</span><br>
                    @endforeach
                @endif
            </p>
        </div>

        <div class="create-form__group">
            <label for="img" class="create-form__label">
                画像<span class="create-form__required">必須</span>
            </label>
            <img id="imagePreview" src="" alt="画像プレビュー" style="display:none; width: 200px; margin-top: 10px; border-radius: 5px;">
            <input type="file" class="create-form__img-input" name="image" id="image" value="{{ old('image') }}" accept="image/*">
            <p class="create-form__error-message">
                @if ($errors->has('image'))
                    @foreach ($errors->get('image') as $error)
                    <span>{{ $error }}</span><br>
                    @endforeach
                @endif
            </p>
        </div>

        <div class="create-form__group">
            <label for="seasons" class="create-form__label">
                季節<span class="create-form__required">必須</span>
                <span class="create-form__select">複数選択可</span>
            </label>
            <div class="create-form__season-inputs">
                <div class="create-form__season-option">
                    <label class="create-form__season-label">
                        <input class="create-form__season-input" type="checkbox" name="season[]" id="spring" value="1" {{ (is_array(old('season')) && in_array(1, old('season'))) ? 'checked' : '' }}>
                        <span class="create-form__season-text">春</span>
                    </label>
                </div>
                <div class="create-form__season-option">
                    <label class="create-form__season-label">
                        <input class="create-form__season-input" type="checkbox" name="season[]" id="summer" value="2" {{ (is_array(old('season')) && in_array(2, old('season'))) ? 'checked' : '' }}>
                        <span class="create-form__season-text">夏</span>
                    </label>
                </div>
                <div class="create-form__season-option">
                    <label class="create-form__season-label">
                        <input class="create-form__season-input" type="checkbox" name="season[]" id="autumn" value="3" {{ (is_array(old('season')) && in_array(3, old('season'))) ? 'checked' : '' }}>
                        <span class="create-form__season-text">秋</span>
                    </label>
                </div>
                <div class="create-form__season-option">
                    <label class="create-form__season-label">
                        <input class="create-form__season-input" type="checkbox" name="season[]" id="winter" value="4" {{ (is_array(old('season')) && in_array(4, old('season'))) ? 'checked' : '' }}>
                        <span class="create-form__season-text">冬</span>
                    </label>
                </div>
            </div>
            <p class="create-form__error-message">
                @error('season')
                {{ $message }}
                @enderror
            </p>
        </div>
        <div class="create-form__group">
            <label for="description" class="create-form__label">
                商品説明<span class="create-form__required">必須</span>
            </label>
            <textarea name="description" id="description" class="create-form__description-textarea" value="{{ old('description') }}" placeholder="商品の説明を入力"></textarea>
            <p class="create-form__error-message">
                @if ($errors->has('description'))
                @foreach ($errors->get('description') as $error)
                <span>{{ $error }}</span><br>
                @endforeach
                @endif
            </p>
        </div>
        <div class="create-form__btn">
            <a href="/products" class="create-form__back-btn">戻る</a>
            <input type="submit" class="create-form__send-btn" value="登録" name="send">
        </div>
    </form>
</div>
@endsection