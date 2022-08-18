<!DOCTYPE html>
<html lang="en">

<head>
    @include("Professor_Dashboard.Template.style")
</head>

<body>
<section id="container">

    <!--header start-->
    @include("Professor_Dashboard.Template.header")
    <!--header end-->

    <!--left sidebar start-->
    @include("Professor_Dashboard.Template.leftBar")
    <!--left sidebar end-->

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">

                <div class="col-lg-9 ">
                    @yield("content")
                </div>

                <!--right sidebar start-->
                @include("Professor_Dashboard.Template.rightBar")
                <!--right sidebar start-->

            </div>
        </section>
    </section>
    <!--main content end-->

    <!--footer start-->
    @include("Professor_Dashboard.Template.footer")
    <!--footer end-->

</section>
@include("Professor_Dashboard.Template.scripts")
</body>

</html>
