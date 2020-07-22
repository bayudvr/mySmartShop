<script>
    window.onload = $(document).ready(function()
    {
        get_profile('welcome_message');
        get_profile('admin_profiles');
        get_profile('admin_profile_data');
    });

    function get_profile(key)
    {
        $.ajax({
            url:'data/profile/'+key,
            type:'get',
            contentType:false,
            processData:false,
            success:function(data)
            {
                if(key == 'welcome_message')
                {
                    $('#welcome_message').html(data['html']);
                }

                if(key == 'admin_profiles')
                {
                    $('#admin_profiles').html(data['html']);
                }

                if(key == 'admin_profile_data')
                {
                    $('#admin_profile_data').html(data['html']);
                }
            }
        });
    }

    $(document).on('submit','#ubahFoto',function(e){
        e.preventDefault();
        $('#editBtn').html('<i class="fa fa-cog fa-spin"></i> Updating');
        $('#editBtn').attr('disabled',true);

        $.ajax(
            {
                url:'misc/profile/change_profile_picture',
                type:'post',
                data: new FormData(this),
                processData:false,
                contentType:false,
                success:function(data)
                {
                    if(data['status'] == 'done')
                    {
                        audio_response('success');
                        $('#modal').modal('hide');
                        toastr.success(data['message'],data['warning']);
                        get_profile('admin_profiles');
                    } else if(data['status'] == 'warning'){
                        audio_response('warning');
                        toastr.warning(data['message'],data['warning']);
                        $('#editBtn').html('<i class="fa fa-cog fa-edit"></i> Update');
                        $('#editBtn').attr('disabled',false);
                    } else if(data['status'] == 'error') {
                        audio_response('error');
                        toastr.error(data['message'],data['warning']);
                        $('#editBtn').html('<i class="fa fa-cog fa-edit"></i> Update');
                        $('#editBtn').attr('disabled',false);
                    }
                }
            }
        );
    });

    $(document).on('submit','#editProfile',function(e){
        e.preventDefault();
        $('#updateBtn').html('<i class="fa fa-cog fa-spin"></i> Updating');
        $('#updateBtn').attr('disabled',true);

        $.ajax({
            url:'misc/profile/edit_profile',
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
                    get_profile('welcome_message');
                    get_profile('admin_profiles');
                    get_profile('admin_profile_data');
                } else if(data['status'] == 'relog') {
                    window.location = 'logout';
                } else if(data['status'] == 'username_double')
                {
                    audio_response('warning');
                    toastr.warning(data['message'],data['warning']);
                    $('#updateBtn').html('Update');
                    $('#updateBtn').attr('disabled',false);
                } else if(data['status'] == 'warning')
                {
                    audio_response('warning');
                    toastr.warning(data['message'],data['warning']);
                    $('#updateBtn').html('Update');
                    $('#updateBtn').attr('disabled',false);
                } else if(data['status'] == 'error') {
                    audio_response('error');
                    toastr.error(data['message'],data['warning']);
                    $('#updateBtn').html('Update');
                    $('#updateBtn').attr('disabled',false);
                }
            }
        });
    });
</script>