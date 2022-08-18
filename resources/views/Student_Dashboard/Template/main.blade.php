<!DOCTYPE html>
<html lang="en">

<head>
    @include("Student_Dashboard.Template.style")
</head>

<body>
<section id="container">

    <!--header start-->
    @include("Student_Dashboard.Template.header")
    <!--header end-->

    <!--left sidebar start-->
    @include("Student_Dashboard.Template.leftBar")
    <!--left sidebar end-->

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">

                <div class="col-lg-9 ">
                    @yield("content")
                </div>

                <!--right sidebar start-->
                @include("Student_Dashboard.Template.rightBar")
                <!--right sidebar start-->

            </div>
        </section>
    </section>
    <!--main content end-->

    <!--footer start-->
    @include("Student_Dashboard.Template.footer")
    <!--footer end-->

</section>
@include("Student_Dashboard.Template.scripts")
</body>

</html>
