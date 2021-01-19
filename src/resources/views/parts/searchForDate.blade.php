<form action="{{ route('weather.getForDate') }}" method="POST">
    @csrf

    <label for="date">{{ __('Date') }}</label>
    <input id="date" type="date" name="date" class="form-control @error('date') is-invalid @enderror" required>

    <div class="alert alert-success">
        {{ session('temperature') }}
    </div>

    @error('date')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-primary">{{ __('Submit form') }}</button>
</form>
