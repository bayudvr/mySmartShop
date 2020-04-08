<!-- JS -->
<script src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script crossorigin src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha256-JirYRqbf+qzfqVtEE4GETyHlAbiCpC005yBTa4rj6xg=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('public/js/custom.js') }}"></script>

<script type="text/javascript">
    $(document).on('submit','#signinForm',function(e) {
        e.preventDefault();
        
        $.ajax({
            url:'auth',
            method:'post',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success:function(response){
                
                if(response == 'done'){
                    
                    toastr.success('Logged In');
                    window.location = '';
                }else{
                    toastr.error('Account Not Found');
                }
            }
        });
    });

    $(document).on('submit','#signupForm',function(e) {
        e.preventDefault();

        $.ajax({
            url:'register',
            method:'post',
            data: new FormData(this),
            contentType: false,
            processData: false,
            success:function(response){
                
                if(response == 'done'){
                    
                    toastr.success('Account Registered');
                    $("#left").addClass("left_hover"); 
                    $("#right").removeClass("right_hover");
                    $(".s1class").css({"color":"#EE9BA3"});
                    $(".s2class").css({"color":"#748194"});
                    $(".signup").css({"display":"none"});
                    $(".signin").css({"display":""});
                }else if(response == 'misspass'){

                    toastr.info("Passwords don't match");
                }else{
                    toastr.error('Something went wrong, please wait a couple minutes');
                }
            }
        });
    });
</script>