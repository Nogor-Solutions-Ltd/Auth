@if (!session('success'))
<div
    style="max-width: 500px; margin: auto; padding: 30px; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.2);">
    <h2 style="margin-bottom: 20px; text-align: center; font-weight: 600; font-size: 28px; color: #000;">Reset Password
    </h2>
    <p style="font-size: 16px; color: #666; margin-bottom: 30px; line-height: 1.5;">Please enter your new password.</p>

    <form method="POST" action="{{ route('app.password.store') }}">
        @csrf
        <div style="margin-bottom: 20px;">
            <input type="hidden" name="model" value="{{ $model }}">
            <div style="margin-bottom: 20px;">
                <label for="password"
                    style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 16px; color: #000;">New
                    password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password"
                    style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #000; border-radius: 5px; color: #000; background-color: #fff;"
                    required>
                @error('password')
                <div class="invalid-feedback" style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div style="margin-bottom: 20px;">
                <label for="password_confirmation"
                    style="display: block; margin-bottom: 5px; font-weight: 600; font-size: 16px; color: #000;">Confirm
                    new password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    id="password_confirmation" name="password_confirmation"
                    style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #000; border-radius: 5px; color: #000; background-color: #fff;"
                    required>
                @error('password_confirmation')
                <div class="invalid-feedback" style="color: red;">
                    {{ $message }}
                </div>
                @enderror
            </div>
            @error('email')
            <div class="invalid-feedback" style="color: red;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <input hidden name="_uid" value="{{ Request::get('uid') }}">
        <input hidden name="model" value="{{ $model }}">

        <button type="submit" class="btn btn-primary"
            style="display: block; width: 100%; padding: 10px; font-size: 16px; background-color: #000; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
            Reset </button>
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

@else

<div
    style="max-width: 500px; margin: auto; padding: 30px; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.2);">

    <center><svg fill="#000000" height="80px" width="80px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 52 52" xml:space="preserve">
            <g>
                <path d="M26,0C11.664,0,0,11.663,0,26s11.664,26,26,26s26-11.663,26-26S40.336,0,26,0z M26,50C12.767,50,2,39.233,2,26
                S12.767,2,26,2s24,10.767,24,24S39.233,50,26,50z"></path>
                <path d="M38.252,15.336l-15.369,17.29l-9.259-7.407c-0.43-0.345-1.061-0.274-1.405,0.156c-0.345,0.432-0.275,1.061,0.156,1.406
                l10,8C22.559,34.928,22.78,35,23,35c0.276,0,0.551-0.114,0.748-0.336l16-18c0.367-0.412,0.33-1.045-0.083-1.411
                C39.251,14.885,38.62,14.922,38.252,15.336z"></path>
            </g>
        </svg></center>

    <h2 style="margin-bottom: 20px; text-align: center; font-weight: 600; font-size: 28px; color: #000;">Success!!!
    </h2>

    <form>
        @csrf
        <a onclick="window.location.href='/'" class="btn btn-primary"
            style="text-align:center; display: block; width: 100%; padding: 10px; font-size: 16px; background-color: #000; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
            Go Back To Home </a>
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
</form>

@endif
