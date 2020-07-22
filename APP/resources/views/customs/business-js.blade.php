<script>
    window.onload = $(document).ready(function(){
        get_business();
    });

    function get_business()
    {
        $.ajax({
            url:'data/businesses',
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
                            "targets": [0,3,6,7],
                            "orderable": false
                        },
                        {
                            "searchable": false,
                            "targets": [0,3,6,7]
                        }
                    ]
                });
            }
        });
    }

    $(document).on('submit','#add',function(e){
        e.preventDefault();
        
        $('#addBtn').html('<i class="fa fa-cog fa-spin"></i>Saving</button>');
        $('#addBtn').attr('disabled',true);

        $.ajax({
            url:'misc/business/add',
            type:'post',
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
                if(data['status'] == 'done')
                {
                    audio_response('success');
                    $('#modal').modal('hide');
                    toastr.success(data['message'],data['warning']);
                    get_business();
                } else if(data['status'] == 'warning')
                {
                    audio_response('warning');
                    toastr.warning(data['message'],data['warning']);
                    $('#addBtn').html('<i class="fa fa-check"></i>Save</button>');
                    $('#addBtn').attr('disabled',false);
                } else if(data['status'] == 'error')
                {
                    audio_response('error');
                    toastr.error(data['message'],data['warning']);
                    $('#addBtn').html('<i class="fa fa-check"></i>Save</button>');
                    $('#addBtn').attr('disabled',false);
                }
            }
        });
    });

    $(document).on('submit','#edit',function(e){
        e.preventDefault();

        $('#editBtn').html('<i class="fa fa-edit"></i>Updating</button>');
        $('#editBtn').attr('disabled',true);

        $.ajax({
            url:'misc/business/edit',
            type:'post',
            data: new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
                if(data['status'] == 'done')
                {
                    audio_response('success');
                    $('#modal').modal('hide');
                    toastr.success(data['message'],data['warning']);
                    get_business();
                } else if(data['status'] == 'warning')
                {
                    audio_response('warning');
                    toastr.warning(data['message'],data['warning']);
                    $('#editBtn').html('<i class="fa fa-edit"></i>Update</button>');
                    $('#editBtn').attr('disabled',false);
                } else if(data['status'] == 'error')
                {
                    audio_response('error');
                    toastr.error(data['message'],data['warning']);
                    $('#editBtn').html('<i class="fa fa-edit"></i>Update</button>');
                    $('#editBtn').attr('disabled',false);
                }
            }
        });
    });

    function openBusiness(name,id)
    {
        $.confirm(
            {
                title:'Wait a moment',
                content:'Do you want to re-open '+name+'?',
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
                                    url:'misc/business/open/'+id,
                                    type:'get',
                                    contentType:false,
                                    processData:false,
                                    success:function(data)
                                    {
                                        if(data['status'] == 'done')
                                        {
                                            audio_response('success');
                                            toastr.info(name+' '+data['message'], data['warning']);
                                            get_business();
                                        } else if(data['status'] == 'error')
                                        {
                                            audio_response('error');
                                            toastr.error(data['message'], data['warning']);
                                        }
                                    }
                                }
                            );
                        }
                    },
                    nope:
                    {
                        text:'no',
                        btnClass:'btn-info'
                    }
                }
            }
        );
    }

    function closeBusiness(name,id)
    {
        $.confirm(
            {
                title:'Wait a moment',
                content:'Do you want to close '+name+'?',
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
                                    url:'misc/business/close/'+id,
                                    type:'get',
                                    contentType:false,
                                    processData:false,
                                    success:function(data)
                                    {
                                        if(data['status'] == 'done')
                                        {
                                            audio_response('success');
                                            toastr.info(name+' '+data['message'], data['warning']);
                                            get_business();
                                        } else if(data['status'] == 'error')
                                        {
                                            audio_response('error');
                                            toastr.error(data['message'], data['warning']);
                                        }
                                    }
                                }
                            );
                        }
                    },
                    nope:
                    {
                        text:'no',
                        btnClass:'btn-info'
                    }
                }
            }
        );
    }

    function deleteBusiness(name,id)
    {
        $.confirm(
            {
                title:'Wait a moment',
                content:'Do you want to delete '+name+'?',
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
                                    url:'misc/business/delete/'+id,
                                    type:'get',
                                    contentType:false,
                                    processData:false,
                                    success:function(data)
                                    {
                                        if(data['status'] == 'done')
                                        {
                                            audio_response('success');
                                            toastr.info(name+' '+data['message'], data['warning']);
                                            get_business();
                                        } else if(data['status'] == 'error')
                                        {
                                            audio_response('error');
                                            toastr.error(data['message'], data['warning']);
                                        }
                                    }
                                }
                            );
                        }
                    },
                    nope:
                    {
                        text:'no',
                        btnClass:'btn-info'
                    }
                }
            }
        );
    }
</script>