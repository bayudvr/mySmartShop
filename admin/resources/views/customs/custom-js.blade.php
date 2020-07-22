<script>
    // Login
    $(document).on('submit','#loginForm',function(e){
        e.preventDefault();

        $.ajax({
            url:'login',
            type:'post',
            data: new FormData(this),
            processData:false,
            contentType:false,
            success:function(data)
            {
                if(data['status'] == 'done')
                {
                    toastr.success(data['message'],data['warning']);
                    window.location = 'dashboard';
                }
                else if(data['status'] == 'warning')
                {
                    audio_response('warning');
                    toastr.warning(data['message'],data['warning']);
                }
                else{
                    audio_response('error');
                    toastr.error(data['message'],data['warning']);
                }
            }
        });
    });

    // Logout
    function logout()
    {
        $.confirm(
            {
                title:'Wait!',
                content:'Want to logout now?',
                autoClose:'nope|5000',
                buttons:
                {
                    yup:
                    {
                        text:'yes',
                        btnClass:'btn-info',
                        action:function()
                        {
                            window.location = 'logout';
                        }
                    },
                    nope:
                    {
                        text:'no',
                        btnClass:'btn-success'
                    }
                }
            }
        );
    }

    function change_password()
    {
        $.confirm({
            title:'Change Password?',
            content:'You have to login again after changing your password, you sure?',
            autoClose:'nope|8000',
            buttons:
            {
                yup:
                {
                    text:'yes',
                    btnClass:'btn-danger',
                    action:function()
                    {
                        showForm('form/change_password');
                    }
                },
                nope:
                {
                    text:'no',
                    btnClass:'btn-info'
                }
            }
        });
    }

    function showForm(link)
    {
        $.ajax({
            url:link,
            type:'get',
            contentType:false,
            processData:false,
            success:function(data)
            {
                $('#forms').html(data['html']);
                $('#modal').modal('show');
            }

        });
    }

    $(document).on('submit','#change_password',function(e){
        e.preventDefault();

        $('#editBtn').html('<i class="fa fa-cog fa-spin"></i> Updating');
        $('#editBtn').attr('disabled',true);

        $.ajax({
            url:'misc/change_password',
            type:'post',
            data: new FormData(this),
            processData:false,
            contentType:false,
            success:function(data)
            {
                if(data['status'] == 'done')
                {
                    audio_response('success');
                    toastr.success(data['message'],data['warning']);
                    window.location = 'logout';
                } else if(data['status'] == 'warning')
                {
                    audio_response('warning');
                    toastr.warning(data['message'],data['warning']);
                    $('#editBtn').html('<i class="fa fa-cog fa-edit"></i> Update');
                    $('#editBtn').attr('disabled',false);
                } else if(data['status'] == 'error')
                {
                    audio_response('error');
                    toastr.error(data['message'],data['warning']);
                    $('#editBtn').html('<i class="fa fa-cog fa-edit"></i> Update');
                    $('#editBtn').attr('disabled',false);
                }
            }
        });
    });

    function audio_response(key)
    {

        var audio = new Audio();

        if(key == 'success')
        {
            audio.src = "{{ asset('storage/sounds/correct.mp3') }}";
        }

        if(key == 'warning')
        {
            audio.src = "{{ asset('storage/sounds/warning.mp3') }}";
        }

        if(key == 'error')
        {
            audio.src = "{{ asset('storage/sounds/error.mp3') }}";
        }

        audio.play();

    }
</script>