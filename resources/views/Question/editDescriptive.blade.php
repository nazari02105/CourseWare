@extends("Professor_Dashboard.Template.main")
@section("title")
    Questions
@endsection
@section("name")
    {{ $username }}
@endsection
@section("questions")
    active
@endsection
@section("designed")
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
                    <h2 class="heading-section">Edit Question</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        @if(isset($message) && $message != null)
                            <div class="alert alert-danger" style="font-size: 12px">{{ $message }}</div>
                        @endif
                        <form action="{{ "/question/".$question->id."/update" }}" method="POST" class="signin-form">
                            @csrf
                            @method("patch")
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input style="font-size: 20px" name="title" type="text" value="{{ $question->title }}" class="form-control" required>
                            </div>
                            @error('title')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>
                            <div class="form-group">
                                <label for="question">Question:</label>
                                <textarea class="form-control" style="font-size: 20px; color: black" rows = "5" cols = "100" name = "question">
                                    {{ $question->question }}
                                </textarea>
                            </div>
                            @error('question')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @include("Form_Assets.scripts")
@endsection
