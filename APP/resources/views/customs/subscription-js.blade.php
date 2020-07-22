<script>
    window.onload = $(document).ready(function(){
        get_package_info();
    });

    function get_package_info()
    {
        $.ajax({
            url:'data/user_package',
            type:'get',
            contentType:false,
            processData:false,
            success:function(data)
            {
                $('#data').html(data['html']);
            }
        });
    }
</script>