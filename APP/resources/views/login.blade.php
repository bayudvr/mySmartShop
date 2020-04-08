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
      <form class="signup" id="signupForm">
         <h1 class="signup1 mt-5">SIGN UP</h1>
         <br><br><br><br>
			<input name="username" type="text" placeholder="Username*" class="username" required/>
			
			<input name="email" type="text" placeholder="Email*" class="username" required/>
			
			<input name="password" type="password" placeholder="Password*" class="username" required/>
         
         <button type="submit" class="btn">Sign Up</button>
      </form>
      <form class="signin" id="signinForm">
         
         <h1 class="signup1 mt-5">SIGN IN</h1>
         <br><br><br><br>
         <input name="username" type="text" placeholder="Username*" class="username" required/>
			
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
