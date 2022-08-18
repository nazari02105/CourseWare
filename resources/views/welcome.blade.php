<!DOCTYPE html>
<html>
<head>
    <title>Main</title>
    <link rel="stylesheet" type="text/css" href="{{ asset("Main_Page/style.css") }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<br>
<div style="color: white" align="center">
    <h1>Welcome to course ware</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="card p-0">
                <div class="card-image"> <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqvH0zeogs05W_TSj0bssWF1G5fVEHPPHIK5C_GyG5cixZEVIoEYChmrgeOr7dglWXM_E&usqp=CAU" width="100" height="300" alt=""> </div>
                <div class="card-content d-flex flex-column align-items-center">
                    <h4 class="pt-2">Professor</h4>
                    <h5>Part</h5>
                    <ul class="social-icons d-flex justify-content-center">
                        <li style="--i:1"> <a href="/professor/login"> <i class="fa fa-sign-in" aria-hidden="true"></i> </a> </li>
                        <li style="--i:2"> <a href="/professor/create"> <i class="fa fa-user-plus" aria-hidden="true"></i> </a> </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="card p-0">
                <div class="card-image"> <img src="https://img.freepik.com/free-photo/happy-young-female-student-holding-notebooks-from-courses-smiling-camera-standing-spring-clothes-against-blue-background_1258-70161.jpg?size=626&ext=jpg" width="100" height="300" alt=""> </div>
                <div class="card-content d-flex flex-column align-items-center">
                    <h4 class="pt-2">Student</h4>
                    <h5>Part</h5>
                    <ul class="social-icons d-flex justify-content-center">
                        <li style="--i:1"> <a href="/student/login"> <i class="fa fa-sign-in" aria-hidden="true"></i> </a> </li>
                        <li style="--i:2"> <a href="/student/create"> <i class="fa fa-user-plus" aria-hidden="true"></i> </a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div style="color: white" align="center">
        <div class="col-lg-4">
            <div class="card p-0">
                <div class="card-image"> <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSp39JjBhwY7RW8jjE3fVdYRmcfzAajPVV4vQ&usqp=CAU" width="100" height="300" alt=""> </div>
                <div class="card-content d-flex flex-column align-items-center">
                    <h4 class="pt-2">Admin</h4>
                    <h5>Part</h5>
                    <ul class="social-icons d-flex justify-content-center">
                        <li style="--i:1"> <a href="/admin/login"> <i class="fa fa-sign-in" aria-hidden="true"></i> </a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
