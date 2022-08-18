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
                    <h2 class="heading-section">Update Question</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        @if(isset($message))
                            <div class="alert alert-danger" style="font-size: 12px">{{ $message }}</div>
                        @endif
                        <form action="{{ "/question/".$question->id."/update" }}" method="POST" class="signin-form">
                            @csrf
                            @method("patch")
                            <input type="hidden" name="test_numbers" id="test_numbers" value="{{ count($options)-1 }}">
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
                                <label for="tests">Tests:</label>
                                <div id="tests">
                                    @for($i = 0; $i<count($options); ++$i)
                                        <input type="text" name="member{{$i}}" class="form-control text-dark" required style="font-size: 20px;" value="{{ $options[$i] }}">
                                        @if($right_answer == $i)
                                            <input class="col-5" onclick="uncheckCheckBoxes(this)" type="checkbox" name="checkbox{{$i}}" checked>
                                        @endif
                                        @if($right_answer != $i)
                                            <input class="col-5" onclick="uncheckCheckBoxes(this)" type="checkbox" name="checkbox{{$i}}">
                                        @endif
                                        <button type="button" onclick="deleteTest(this)" class="col-6 btn-danger" name="delete{{$i}}">delete</button>
                                    @endfor
                                </div>
                                <label onclick="addFields()" style="color: blue">Add Test</label>
                            </div>
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
            checkbox.classList.add("col-5");
            checkbox.addEventListener("click", uncheckCheckBoxes);
            container.appendChild(checkbox);

            var deleteBtn = document.createElement("button");
            deleteBtn.type = "button";
            deleteBtn.name = "delete" + count;
            deleteBtn.classList.add("col-6");
            deleteBtn.classList.add("btn-danger");
            deleteBtn.textContent = "delete";
            deleteBtn.addEventListener("click", deleteTest);
            container.appendChild(deleteBtn);
        }

        function uncheckCheckBoxes (element){
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("tests");
            //get number of child to put id and name for next input field
            var count = container.childElementCount/3;

            var status = this.checked;
            var status2 = element.checked;

            var i = 0;
            while (i<count){
                var checkbox = document.getElementsByName("checkbox"+i)[0];
                checkbox.checked = false;
                i = i + 1;
            }

            this.checked = status;
            element.checked = status2;
        }

        function deleteTest (element){
            var container = document.getElementById("tests");
            var count = container.childElementCount/3 - 1;

            let main = null;
            if (element instanceof PointerEvent){//I should use this
                main = this;
            }
            else{//I should use element
                main = element;
            }

            let number = main.name.substr(6);
            let checkbox = document.getElementsByName("checkbox"+number)[0];
            let member = document.getElementsByName("member"+number)[0];
            checkbox.remove();
            member.remove();
            main.remove();

            number = parseInt(number) + 1;
            while (number < count+1){
                let checkbox = document.getElementsByName("checkbox"+number)[0];
                let member = document.getElementsByName("member"+number)[0];
                let deleteBtn = document.getElementsByName("delete"+number)[0];
                checkbox.name = "checkbox"+(number-1);
                member.name = "member"+(number-1);
                member.placeholder = "Test " + (number-1);
                deleteBtn.name = "delete"+(number-1);
                number = number + 1;
            }

            count = container.childElementCount/3 - 1;
            var testNumber = document.getElementById("test_numbers");
            testNumber.value = count;
        }
    </script>
@endsection
