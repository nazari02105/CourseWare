<!DOCTYPE html>

<html lang="en">
<head>
    @include("Signup_And_Login.Template.head")
</head>

<body>
<div class="limiter">
    <div class="container-login100" style="background-image: url('{{ asset("Signup_And_Login/images/bg-01.jpg") }}');">
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="@yield('action')">
                @csrf
                @yield("content")
            </form>
        </div>
    </div>
</div>
<div id="dropDownSelect1"></div>
@include("Signup_And_Login.Template.scripts")
</body>

</html>
