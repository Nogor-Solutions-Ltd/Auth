<div
    style="max-width: 500px; margin: auto; padding: 30px; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.2);">
    <h2 style="margin-bottom: 20px; text-align: center; font-weight: 600; font-size: 28px; color: #000;">Forgot Password
    </h2>
    <p style="font-size: 16px; color: #666; margin-bottom: 30px; line-height: 1.5;">Enter your email address below and
        we'll send you a link to reset your password.</p>
    <form method="POST" action="{{ route('app.forget.store') }}">
        @csrf
        <div style="margin-bottom: 20px;">
            <label for="email"
                style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 16px; color: #000;">Email
                address</label>
            <input type="hidden" name="model" value="{{ $model }}">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #000; border-radius: 5px; color: #000; background-color: #fff;"
                value="{{ old('email') }}" required>
            @error('email')
            <div class="invalid-feedback" style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary"
            style="display: block; width: 100%; padding: 10px; font-size: 16px; background-color: #000; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Send
            Password Reset Link</button>
    </form>

    @if (session('success'))
    <div class="alert alert-success"
        style="margin-top: 20px; padding: 10px; border-radius: 5px; background-color: #28a745; color: #fff; text-align: center;">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-success"
        style="margin-top: 20px; padding: 10px; border-radius: 5px; background-color: red; color: #fff; text-align: center;">
        {{ session('error') }}
    </div>
    @endif

</div>
