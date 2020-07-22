<script>
    $(document).on('submit','#signupForm',function(e){
        e.preventDefault();

        $('#regisBtn').html('<i class="fa fa-cog fa-spin"></i> Registering');
        $('#regisBtn').attr('disabled',true);

        $.ajax({
            url:'misc/signup',
            type:'post',
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
                if(data['status'] == 'done')
                {
                    audio_response('success');
                    toastr.success(data['message'],data['warning']);
                    window.location = './';
                } else if(data['status'] == 'warning')
                {
                    audio_response('warning');
                    toastr.warning(data['message'],data['warning']);
                    $('#regisBtn').html('Register Now');
                    $('#regisBtn').attr('disabled',false);
                } else if(data['status'] == 'error')
                {
                    audio_response('error');
                    toastr.error(data['message'],data['warning']);
                    $('#regisBtn').html('Register Now');
                    $('#regisBtn').attr('disabled',false);
                }
            }
        });
    });
</script>