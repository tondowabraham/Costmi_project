<div class="table-responsive">
    <table id="cost_table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Material Name</th>
                <th>Description</th>
                <th>Manufacturer</th>
                <th>Code</th>
                <th>Unit</th>
                <th>Size</th>
                <th>Cost</th>
                <th>Source</th>
                <th>Effective From</th>
                <th>Validity</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($costs as $key => $cost): ?>
                <?php if ($cost['resource_type'] === 'Material'): ?>
                    <tr>
                        <td><?= $cost['material_name'] ?></td>
                        <td><?= $cost['description'] ?></td>
                        <td><?= $cost['material_manufacturer'] ?></td>
                        <td><?= $cost['material_code'] ?></td>
                        <td><?= $cost['unit'] ?></td>
                        <td><?= $cost['size'] ?></td>
                        <td><?= $cost['cost'] ?></td>
                        <td><?= $cost['material_source'] ?></td>
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
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>