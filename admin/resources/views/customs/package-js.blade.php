<script>
    window.onload = get_package();

    // Master Data

    // Users

    function get_package()
    {
        $.ajax(
            {
                url:'data/package/packages',
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
                                "targets": [0,4,5,6,7,8],
                                "orderable": false
                            },
                            {
                                "searchable": false,
                                "targets": [0,4,5,6,7,8]
                            }
                        ]                        
                    });
                }
            }
        );
    }

    // Add Package

    $(document).on('submit','#add',function(e)
    {
        e.preventDefault();
        $('#addBtn').html('<i class="fa fa-cog fa-spin"></i> Saving');
        $('#addBtn').attr('disabled',true);

        $.ajax(
            {
                url:'misc/package/add_package',
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
                        get_package();
                    } else if(data['status'] == 'warning')
                    {
                        audio_response('warning');
                        toastr.warning(data['message'],data['warning']);
                        $('#addBtn').html('<i class="fa fa-check"></i> Save');
                        $('#addBtn').attr('disabled',false);
                    } else if(data['status'] == 'error')
                    {
                        audio_response('error');
                        toastr.error(data['message'],data['warning']);
                        $('#addBtn').html('<i class="fa fa-check"></i> Save');
                        $('#addBtn').attr('disabled',false);
                    }
                }
            }
        );
    });

    $(document).on('submit','#edit',function(e)
    {
        e.preventDefault();
        $('#editBtn').html('<i class="fa fa-cog fa-spin"></i> Updating');
        $('#editBtn').attr('disabled',true);

        $.ajax(
            {
                url:'misc/package/edit_package',
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
                        get_package();
                    } else if(data['status'] == 'warning')
                    {
                        audio_response('warning');
                        toastr.warning(data['message'],data['warning']);
                        $('#editBtn').html('<i class="fa fa-check"></i> Save');
                        $('#editBtn').attr('disabled',false);
                    } else if(data['status'] == 'error')
                    {
                        audio_response('error');
                        toastr.error(data['message'],data['warning']);
                        $('#editBtn').html('<i class="fa fa-check"></i> Save');
                        $('#editBtn').attr('disabled',false);
                    }
                }
            }
        );
    });
    
    function deactivatePackage(name,key)
    {
        $.confirm(
            {
                title:'Wait a moment!',
                content:'Are you sure to deactivate '+name+'?',
                autoClose:'nope|5000',
                buttons:
                {
                    nope:
                    {
                        text:'No',
                        btnClass:'btn-info'
                    },
                    yup:
                    {
                        text:'Yes, Deactivate '+name,
                        btnClass:'btn-danger',
                        action:function()
                        {
                            $.ajax(
                                {
                                    url:'misc/package/deactivate/'+key,
                                    type:'get',
                                    contentType:false,
                                    processData:false,
                                    success:function(data)
                                    {
                                        if(data['status'] == 'done')
                                        {
                                            audio_response('success');
                                            toastr.success(name+' '+data['message'],data['warning']);
                                            get_package();
                                        } else if(data['status'] == 'error') {
                                            audio_respons('error');
                                            toastr.error(data['message'],data['warning']);
                                        }
                                    }
                                }
                            );
                        }
                    }
                }
            }
        );
    }

    function activatePackage(name,key)
    {
        $.confirm(
            {
                title:'Wait a moment!',
                content:'Are you sure to activate '+name+'?',
                autoClose:'nope|5000',
                buttons:
                {
                    nope:
                    {
                        text:'No',
                        btnClass:'btn-info'
                    },
                    yup:
                    {
                        text:'Yes, Activate '+name,
                        btnClass:'btn-danger',
                        action:function()
                        {
                            $.ajax(
                                {
                                    url:'misc/package/activate/'+key,
                                    type:'get',
                                    contentType:false,
                                    processData:false,
                                    success:function(data)
                                    {
                                        if(data['status'] == 'done')
                                        {
                                            audio_response('success');
                                            toastr.success(name+' '+data['message'],data['warning']);
                                            get_package();
                                        } else if(data['status'] == 'error') {
                                            audio_respons('error');
                                            toastr.error(data['message'],data['warning']);
                                        }
                                    }
                                }
                            );
                        }
                    }
                }
            }
        );
    }
</script>