<script>

    window.onload = get_admin();

    // Master Data

    // Admin
    function get_admin()
    {
        $.ajax(
            {
                url:'data/admin/admins',
                type:'get',
                processData:false,
                contentType:false,
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
                                "targets": [0,5,6],
                                "orderable": false
                            },
                            {
                                "searchable": false,
                                "targets": [0,5,6]
                            }
                        ]                        
                    });
                }
            }
        );
    }

    // Crud

    // Add Admin

    $(document).on('submit','#add',function(e){

        e.preventDefault();
        $('#addBtn').html('<i class="fa fa-cog fa-spin"></i> Saving');
        $('#addBtn').attr('disabled',true);

        $.ajax({
            url:'misc/admin/add_admin',
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
                    $('#modal').modal('hide');
                    get_admin();
                } else if(data['status'] == 'warning')
                {
                    audio_response('warning');
                    toastr.warning(data['message'],data['warning']);
                    $('#addBtn').html('<i class="fa fa-check"></i> Save');
                    $('#addBtn').attr('disabled',false);
                } else if(data['status'] == 'error') {
                    audio_response('error');
                    toastr.error(data['message'],data['warning']);
                    $('#addBtn').html('<i class="fa fa-check"></i> Save');
                    $('#addBtn').attr('disabled',false);
                }
            }
        });
    });

    // Edit Admin

    $(document).on('submit','#edit',function(e){

        e.preventDefault();
        $('#editBtn').html('<i class="fa fa-cog fa-spin"></i> Updating');
        $('#editBtn').attr('disabled',true);

        $.ajax({
            url:'misc/admin/edit_admin',
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
                    $('#modal').modal('hide');
                    get_admin();
                } else if(data['status'] == 'warning')
                {
                    audio_response('warning');
                    toastr.warning(data['message'],data['warning']);
                    $('#editBtn').html('<i class="fa fa-edit"></i> Update');
                    $('#editBtn').attr('disabled',false);
                } else if(data['status'] == 'error') {
                    audio_response('error');
                    toastr.error(data['message'],data['warning']);
                    $('#editBtn').html('<i class="fa fa-edit"></i> Update');
                    $('#editBtn').attr('disabled',false);
                }
            }
        });
    });

    // Bad Admin

    function banAdmin(name,id)
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
                                    url:'misc/admin/banAdmin/'+id,
                                    type:'get',
                                    contentType:false,
                                    processData:false,
                                    success:function(data)
                                    {
                                        if(data['status'] == 'done')
                                        {
                                            audio_response('success');
                                            toastr.info(name+' '+data['message'],data['warning']);
                                            get_admin();
                                        } else if(data['status'] == 'error') {
                                            audio_response('error');
                                            toastr.error(data['message'],data['warning']);
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

    // Unban Admin

    function unbanAdmin(name,id)
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
                                    url:'misc/admin/unbanAdmin/'+id,
                                    type:'get',
                                    contentType:false,
                                    processData:false,
                                    success:function(data)
                                    {
                                        if(data['status'] == 'done')
                                        {
                                            audio_response('success');
                                            toastr.info(name+' '+data['message'],data['warning']);
                                            get_admin();
                                        } else if(data['status'] == 'error') {
                                            audio_response('error');
                                            toastr.error(data['message'],data['warning']);
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