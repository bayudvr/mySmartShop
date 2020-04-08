<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @include('plugin.plugin')
</head>
<body>

<div class="container">
   <div class="c1">
      
      <div class="c11">
         <h1 class="mainhead">PILIH SALAH SATU DIBAWAH</h1>
      </div>
      <div id="left"><h1 class="s1class"><span>SIGN</span><span class="su">IN</span>
      </h1></div>
      <div id="right"><h1 class="s2class"><span>SIGN</span><span class="su">UP</span></h1></div>
   </div>
   <div class="c2">
      <center>
         <img src="{{asset('public/img/MSS.png')}}" alt="" style="width:100px; height:100px; object-fit:contain;">
      </center>
      <form class="signup" method="POST" id="signupForm">
         <h1 class="signup1 mt-5">SIGN UP</h1>
         @csrf
         <input name="name" type="text" placeholder="Full Name*" class="username" required/>

			<input name="email" type="email" placeholder="Email*" class="username" required/>
			
			<input name="password" type="password" placeholder="Password*" class="username" required/>

		<input name="cpassword" type="password" placeholder="Confirm Password*" class="username" required/>
 
         
         <button type="submit" class="btn">Sign Up</button>
      </form>
      <form class="signin" method="POST" id="signinForm">
         
         <h1 class="signup1 mt-5">SIGN IN</h1>
         @csrf

			<input name="email" type="email" placeholder="Email*" class="username" required/>
			
		<input name="password" type="password" placeholder="Password*" class="username" required/>
        
         <button type="submit" class="btn">Get Started</button>
         
         <br><br><br><br>
         <a href=""><p class="signup2">Forget Password?</p></a>
      </form>
      
   </div>
</div>

</body>
</html>
@include('js.js')
