<div class="card">
    <div class="card-header title-tab">
        <h4 class="float-start"><?php echo app_lang('boq'); ?></h4>
        
        <div class="title-button-group">
            <?php
            echo modal_anchor(get_uri("bills/task_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('load_bill'), array("class" => "btn btn-default", "title" => app_lang('load_bill')));
            ?>
            <?php
            echo modal_anchor(get_uri("bills/modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_bill'), array("class" => "btn btn-default", "title" => app_lang('add_bill')));
            ?>
        </div>
    </div>
    <div class="table-responsive">
        <table id="bill_table" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Task ID</th>
                    <th>Task Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Rate</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bills as $key => $bill): ?>
                    <tr>
                        <td><?= $bill['task_id'] ?></td>
                        <td><?= $bill['task_name'] ?></td>
                        <td><?= $bill['description'] ?></td>
                        <td><?= $bill['quantity'] ?></td>
                        <td><?= $bill['unit'] ?></td>
                        <td><?= $bill['rate'] ?></td>
                        <td><?= $bill['amount'] ?></td>
                        <td>
                            <?php
                            echo modal_anchor(get_uri('bills/edit_form'), '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit icon-16"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>',
                                array(
                                    "class" => "btn btn-default update-bill-btn",
                                    "title" => app_lang('edit_bill'),
                                    "data-post-id" => $bill['id']
                                )
                            );
                            ?>
                            <a href="<?= site_url('bills/delete_bill/' . $bill['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this bill?');">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash icon-16">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M16 10a3 3 0 0 1-3 3H11a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h2a3 3 0 0 1 3 3z"></path>
                                    <line x1="8" y1="15" x2="16" y2="15"></line>
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('#bill_table').appTable();

        $('.edit-bill-btn').click(function (e) {
            e.preventDefault();
            var billId = $(this).data('bill-id');
            $.ajax({
                url: '<?= site_url('bills/edit_bill/') ?>' + billId,
                method: 'GET',
                dataType: 'html',
                success: function (data) {
                    $('#editModal .modal-body').html(data);
                    $('#editModal').modal('show');
                }
            });
        });
    });
</script>
