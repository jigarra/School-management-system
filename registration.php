<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>S M S</title>
</head>

<body class="bg-primary">
  <div class="container">
    <!-- Outer Row -->       
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="container">  
              <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-3 p-4">Create an Account!</h1>
                            </div>
                            <hr>
              <form class="shadow-lg" >
               <div class="row py-2">
                <div class="col">
                  <label for="Fname"> First Name</label>
                  <input type="text" class="form-control" id="Fname" placeholder="First name" required="Fname">
                </div>
                <div class="col">
                  <label for="  Lname"> Last Name</label>
                  <input type="text" class="form-control" id="Lname" placeholder="Last name" required>
                </div>
              </div> 
              <div class="row">
                <div class="col">
                  <label> E-mail</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                </div>
                <div class="col">
                  <label>Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                </div>
              </div>
              <div class="form-row"> 
               <div class="col">
                <label for="validationDefaultUsername">Username</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend2">@</span>
                  </div>
                  <input type="text" class="form-control" id="validationDefaultUsername" placeholder="Username" aria-describedby="inputGroupPrepend2" required>
                </div>
              </div>
            </div>
            <div class="form-row"> 
             <div class="form-group-col col-md-6">
              <label for="input">Standard</label>
              <select id="input" class="form-control" required>
                <option selected>Choose...</option>
                <option>L.K.G</option>
                <option>H.K.G</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
                <option>11</option>
                <option>12</option>
              </select>
            </div>
            <div class="col"> 

              <!--Date picker -->
              <div class="form-group col-md-6">
                <label for="birthdaytime">Birthday:</label>
                <input type="date" id="birthdaytime" name="birthdaytime" id=" datetime-local  " >
              </div>
            </div>
          </div>

          <div class="row">
            <div class=" col">
              <label for="FormControlTextarea1">Address</label>
              <textarea class="form-control" id="FormControlTextarea1" rows="2" required></textarea>
            </div>
            <div class=" col" > 
             <label for="FormControlTextarea1">Discription</label>
             <textarea class="form-control" id="FormControlTextarea1" rows="2" required></textarea>
           </div>
         </div>
       </div>

       <div class="modal-footer  w-50 ml-5">
        <center> 

         <div class="form-check ">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" data-success="modal">Submit</button>
      </center>
    </form> 
  </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>