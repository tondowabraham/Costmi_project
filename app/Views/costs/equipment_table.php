<div class="table-responsive">
    <table id="cost_table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Equipment Name</th>
                <th>Name Code</th>
                <th>Category</th>
                <th>Category Code</th>
                <th>Manufacturer</th>
                <th>Model</th>
                <th>Power Rating</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($costs as $key => $cost): ?>
                <?php if ($cost['resource_type'] === 'Equipment'): ?>
                    <tr>
                        <td><?= $cost['equipment_name'] ?></td>
                        <td><?= $cost['equipment_name_code'] ?></td>
                        <td><?= $cost['equipment_category'] ?></td>
                        <td><?= $cost['equipment_manufacturer'] ?></td>
                        <td><?= $cost['equipment_code'] ?></td>
                        <td><?= $cost['equipment_model'] ?></td>
                        <td><?= $cost['power_rating'] ?></td>
                        <td><?= $cost['equipment_status'] ?></td>
                        <td><?= $cost['equipment_rate'] ?></td>
                        <td><?= $cost['effective_from'] ?></td>
                        <td><?= $cost['validity'] ?></td>
                        <td><?= $cost['notes'] ?></td>
                        <td>
                            <?php
                            echo modal_anchor(get_uri('costs/modal_form'), '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit icon-16"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>',
                                array(
                                    "class" => "btn btn-default update-cost-btn",
                                    "title" => app_lang('edit_cost'),
                                    "data-post-id" => $cost['id']
                                )
                            );
                            ?>
                            <!-- <a href="<?= site_url('costs/delete_cost/' . $cost['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this cost?');">
                                Delete
                            </a> -->
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>