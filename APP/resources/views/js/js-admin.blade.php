<!-- JS -->
<script src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="{{asset('public/admin/js/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/admin/js/plugins/moment.min.js')}}"></script>
<script src="{{asset('public/admin/js/plugins/bootstrap-datetimepicker.js')}}" type="text/javascript"></script>
<script src="{{asset('public/admin/js/plugins/nouislider.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/admin/js/material-kit.js?v=2.0.7')}}" type="text/javascript"></script>
<script crossorigin src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
<script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha256-JirYRqbf+qzfqVtEE4GETyHlAbiCpC005yBTa4rj6xg=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js" integrity="sha256-Ka8obxsHNCz6H9hRpl8X4QV3XmhxWyqBpk/EpHYyj9k=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('public/js/custom.js') }}"></script>

<script type="text/javascript">

    function logout(){

        $.confirm({
            title:'',
            content:'Log out now?',
            autoClose: 'nope|5000',
            type:'red',
            buttons:{
                acc:{
                    text:'Yes',
                    btnClass:'btn-danger',
                    action:function(){
                        window.location = '../logout';
                    }
                },
                nope:{
                    text:'Cancel',
                    btnClass:'btn-info'
                }
            }
        });
    }
</script>