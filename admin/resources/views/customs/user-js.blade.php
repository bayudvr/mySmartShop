<script>

    window.onload = get_user();

    // Master Data

    // Users

    function get_user()
    {
        $.ajax(
            {
                url:'data/user/users',
                type:'get',
                contentType:false,
                processData:false,
                success:function(data)
                {
                    $('#data').html(data['html']);
                    $('#tdata').DataTable({
                        "responsive": true,
                        "lengthMenu": [5, 15, 20],
                        "pageLength": 5,
                        "autoWidth":true,
                        "columnDefs": [
                            {
                                "targets": [0,4,5,6,7],
                                "orderable": false
                            },
                            {
                                "searchable": false,
                                "targets": [0,4,5,6,7]
                            }
                        ]                        
                    });
                }
            }
        );
    }

    $(document).on('submit','#add',function(e){

        e.preventDefault();
        $('#addBtn').html('<i class="fa fa-cog fa-spin"></i> Saving');
        $('#addBtn').attr('disabled',true);

        $.ajax(
            {
                url:'misc/user/add_user',
                type:'post',
                data: new FormData(this),
                contentType:false,
                processData:false,
                success:function(data)
                {
                    if(data['status'] == 'done')
                    {
                        audio_response('success');
                        toastr.success(data['message'], data['warning']);
                        $('#modal').modal('hide');
                        get_user();
                    } else if(data['status'] == 'warning')
                    {
                        audio_response('warning');
                        toastr.warning(data['message'], data['warning']);
                        $('#addBtn').html('<i class="fa fa-check"></i> Save');
                        $('#addBtn').attr('disabled',false);
                    } else if(data['status'] == 'error')
                    {
                        audio_response('error');
                        toastr.error(data['message'], data['warning']);
                        $('#addBtn').html('<i class="fa fa-check"></i> Save');
                        $('#addBtn').attr('disabled',false);
                    }
                }
            }
        );
    });

    $(document).on('submit','#edit',function(e){

        e.preventDefault();
        $('#editBtn').html('<i class="fa fa-cog fa-spin"></i> Updating');
        $('#editBtn').attr('disabled',true);

        $.ajax({
            url:'misc/user/edit_user',
            type:'post',
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
                if(data['status'] == 'done')
                {
                    audio_response('success');
                    toastr.success(data['message'], data['warning']);
                    $('#modal').modal('hide');
                    get_user();
                } else if(data['status'] == 'warning')
                {
                    audio_response('warning');
                    toastr.warning(data['message'], data['warning']);
                    $('#editBtn').html('<i class="fa fa-check"></i> Save');
                    $('#editBtn').attr('disabled',false);
                } else if(data['status'] == 'error')
                {
                    audio_response('error');
                    toastr.error(data['message'], data['warning']);
                    $('#editBtn').html('<i class="fa fa-check"></i> Save');
                    $('#editBtn').attr('disabled',false);
                }
            }
        });
    });

    // Bad User

    function banUser(name,id)
    {
        $.confirm(
            {
                title:'Wait a moment!',
                content:'Are you sure you want to ban '+name+'?',
                autoClose:'nope|5000',
                buttons:
                {
                    yup:
                    {
                        text:'yes',
                        btnClass:'btn-danger',
                        action:function()
                        {
                            $.ajax(
                                {
                                    url:'misc/user/banUser/'+id,
                                    type:'get',
                                    contentType:false,
                                    processData:false,
                                    success:function(data)
                                    {
                                        if(data['status'] == 'done')
                                        {
                                            audio_response('success');
                                            toastr.info(name+' '+data['message'],data['warning']);
                                            get_user();
                                        } else if(data['status'] == 'error') {
                                            audio_response('error');
                                            toastr.danger(data['message'],data['warning']);
                                        }
                                    }
                                }
                            );
                        }
                    },
                    nope:
                    {
                        text:'nope',
                        btnClass:'btn-success'
                    }
                }
            }
        );
    }

    // Unban User

    function unbanUser(name,id)
    {
        $.confirm(
            {
                title:'Wait a moment!',
                content:'Are you sure you want to unban '+name+'?',
                autoClose:'nope|5000',
                buttons:
                {
                    yup:
                    {
                        text:'yes',
                        btnClass:'btn-danger',
                        action:function()
                        {
                            $.ajax(
                                {
                                    url:'misc/user/unbanUser/'+id,
                                    type:'get',
                                    contentType:false,
                                    processData:false,
                                    success:function(data)
                                    {
                                        if(data['status'] == 'done')
                                        {
                                            audio_response('success');
                                            toastr.info(name+' '+data['message'],data['warning']);
                                            get_user();
                                        } else if(data['status'] == 'error') {
                                            audio_response('error');
                                            toastr.danger(data['message'],data['warning']);
                                        }
                                    }
                                }
                            );
                        }
                    },
                    nope:
                    {
                        text:'nope',
                        btnClass:'btn-success'
                    }
                }
            }
        );
    }

</script>