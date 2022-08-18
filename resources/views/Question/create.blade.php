@extends("Professor_Dashboard.Template.main")
@section("title")
    Questions
@endsection
@section("name")
    {{ $username }}
@endsection
@section("course")
    active
@endsection
@section("courses")
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
                    <h2 class="heading-section">Create New Descriptive Question</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <form action="/question/store" method="POST" class="signin-form">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{ $id }}">
                            <input type="hidden" name="professor_id" value="{{ \Illuminate\Support\Facades\Auth::guard("professor")->user()->id }}">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input style="font-size: 20px" name="title" type="text" class="form-control" placeholder="Title" required value="{{ old("title") }}">
                            </div>
                            @error('title')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>
                            <div class="form-group">
                                <label for="question">Question:</label>
                                <textarea class="form-control" style="font-size: 20px; color: black" rows = "5" cols = "100" name = "question">
                                    {{ old("question") }}
                                </textarea>
                            </div>
                            @error('question')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>
                            <input type="hidden" name="type" value="descriptive">
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <br><br><br><br><br>


            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Create New Test Question</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        @if(isset($message))
                            <div class="alert alert-danger" style="font-size: 12px">{{ $message }}</div>
                        @endif
                        <form action="/question/store" method="POST" class="signin-form">
                            @csrf
                            <input type="hidden" name="test_numbers" id="test_numbers" value="-1">
                            <input type="hidden" name="exam_id" value="{{ $id }}">
                            <input type="hidden" name="professor_id" value="{{ \Illuminate\Support\Facades\Auth::guard("professor")->user()->id }}">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input style="font-size: 20px" name="title" type="text" class="form-control" placeholder="Title" required value="{{ old("title") }}">
                            </div>
                            @error('title')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>
                            <div class="form-group">
                                <label for="question">Question:</label>
                                <textarea class="form-control" style="font-size: 20px; color: black" rows = "5" cols = "100" name = "question">
                                    {{ old("question") }}
                                </textarea>
                            </div>
                            @error('question')
                            <div class="alert alert-danger" style="font-size: 12px">{{ "- ".$message }}</div>
                            @enderror
                            <br>
                            <input type="hidden" name="type" value="test">
                            <div class="form-group">
                                <label for="tests">Tests:</label>
                                <div id="tests">

                                </div>
                                <label onclick="addFields()" style="color: blue">Add Test</label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>
    @include("Form_Assets.scripts")
    <script type="text/javascript">
        function addFields() {
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("tests");
            //get number of child to put id and name for next input field
            var count = container.childElementCount/3;
            // Create an <input> element, set its type and name attributes
            var input = document.createElement("input");
            input.type = "text";
            input.name = "member" + count;
            input.classList.add("form-control");
            input.classList.add("text-dark");
            input.style.cssText = "font-size: 20px";
            input.placeholder = "Test " + (count+1);
            input.required = true;
            container.appendChild(input);

            var number = document.getElementById("test_numbers");
            number.value = count;

            var checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.name = "checkbox" + count;
            checkbox.addEventListener("click", uncheckCheckBoxes);
            container.appendChild(checkbox);

            // Append a line break
            container.appendChild(document.createElement("br"));
        }

        function uncheckCheckBoxes (){
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("tests");
            //get number of child to put id and name for next input field
            var count = container.childElementCount/3;

            var status = this.checked;

            var i = 0;
            while (i<count){
                var checkbox = document.getElementsByName("checkbox"+i)[0];
                checkbox.checked = false;
                i = i + 1;
            }

            this.checked = status;
        }
    </script>
@endsection
