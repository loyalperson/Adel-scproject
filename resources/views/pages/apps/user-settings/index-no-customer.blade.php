<x-default-layout>
    @section('title')
        User Settings
    @endsection

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <form action="{{ route('user.settings.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('username', auth()->user()->name) }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</x-default-layout>

<script>
    function validatePasswordMatch() {
        var password = document.getElementById("password").value;
        var passwordConfirmation = document.getElementById("password_confirmation").value;

        if (password !== passwordConfirmation) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
</script>