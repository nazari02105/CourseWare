@extends("Admin_Dashboard.Template.main")
@section("title")
    Search
@endsection
@section("name")
    Admin
@endsection
@section("search")
    active
@endsection
@section("searchRole")
    active
@endsection
@section("content")
    <style>
        input,
        input::-webkit-input-placeholder {
            font-size: 20px;
            line-height: 3;
        }
    </style>
    @include("Form_Assets.styles")
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Search</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <form class="signin-form">

                            <div class="form-group">
                                <label for="professor_id">Role</label>
                                <select id="role" style="font-size: 20px" class="form-control">
                                    <option style="background-color: black" value="professor">Professor</option>
                                    <option style="background-color: black" value="student">Student</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input style="font-size: 20px" id="username" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input style="font-size: 20px" id="email" type="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="national_code">National Code</label>
                                <input style="font-size: 20px" id="national_code" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" style="font-size: 20px" class="form-control">
                                    <option style="background-color: black" value="0">expectance</option>
                                    <option style="background-color: black" value="1">Approved</option>
                                </select>
                            </div>

                        </form>
                        <div style="color: darkred" id="result">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include("Form_Assets.scripts")
    <script src="{{ asset("Form/js/search.js") }}"></script>
@endsection
