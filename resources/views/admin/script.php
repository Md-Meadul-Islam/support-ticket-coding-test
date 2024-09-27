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
            if ($(e.target).closest('.closeticket').length) {
                let $this = $(e.target).closest('.closeticket');
                let row = $this.closest('tr');
                let td = $this.closest('td');
                let id = row.data('id');
                $.ajax({
                    url: 'changestatus',
                    data: { id: id },
                    method: 'GET',
                    success: function (res) {
                        if (res.success) {
                            $this.remove();
                            td.append('<a class="openticket btn btn-success btn-sm cursor-pointer">Open</a>');
                        }
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