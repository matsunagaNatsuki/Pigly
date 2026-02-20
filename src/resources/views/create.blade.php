

@section('css')
<link rel="stylesheet" href="{{ asset('/css/create.css')  }}">
@endsection

<dialog id="modal" class="modal">
    <div class="modal-card">

        <h2 class="modal-title">Weight Logを追加</h2>

        <form action="/weight_logs" method="POST">
            @csrf

            <div class="form-group">
                <label>日付 <span class="required">必須</span></label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}">
                <p class="error">@error('date'){{ $message }}@enderror</p>
            </div>

            <div class="form-group">
                <label>体重 <span class="required">必須</span></label>
                <div class="input-unit">
                    <input type="text" name="weight" placeholder="50.0" value="{{ old('weight') }}">
                    <span>kg</span>
                </div>
                <p class="error">
                    @error('weight')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="form-group">
                <label>摂取カロリー <span class="required">必須</span></label>
                <div class="input-unit">
                    <input type="text" name="calorie" placeholder="1200" value="{{ old('calorie') }}">
                    <span>cal</span>
                </div>
                <p class="error">
                    @error('calorie')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="form-group">
                <label>運動時間 <span class="required">必須</span></label>
                <input type="time" name="exercise_time" value="{{ old('exercise_time') }}">
                <p class="error">
                    @error('exercise_time')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="form-group">
                <label>運動内容</label>
                <textarea name="exercise_content" placeholder="運動内容を追加">{{ old('exercise_content') }}</textarea>
                <p class="error">
                    @error('exercise_content')
                        {{ $message }}
                    @enderror
                </p>
            </div>

            <div class="modal-buttons">
                <button type="button" class="btn-back" onclick="closeModal()">戻る</button>
                <button type="submit" class="btn-submit">登録</button>
            </div>

        </form>

    </div>
</dialog>