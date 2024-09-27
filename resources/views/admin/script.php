<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', function (e) {
            if ($(e.target).closest('.storeresponse').length) {
                let $this = $(e.target).closest('.storeresponse');
                let id = $this.data('id');
                let responseText = $this.closest('.modal-content').find('.response').val();
                $.ajax({
                    url: 'storeresponse',
                    method: 'POST',
                    data: {
                        id: id, response: responseText
                    },
                    success: function (res) {
                        $('#staticmodal').modal('hide');
                        location.reload();
                    }
                })
            }
        });



        //static modal show, event handling
        $('#staticmodal').on('show.bs.modal', function (e) {
            let target = $(e.relatedTarget);
            let targetId = target.attr('id');
            if (targetId === 'responsemodal') {
                let id = target.closest('tr').data('id');
                $('#staticmodal .modal-content').html(' ');
                $.ajax({
                    url: 'createresponse',
                    data: { id: id },
                    method: 'GET',
                    success: function (res) {
                        $('#staticmodal .modal-content').html(res);
                    }
                })
            }
        });
    })
</script>