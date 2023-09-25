<div class="table-responsive">
    <table id="directTable" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Reference</th>
                <th>Task Name</th>
                <th>Quantity</th>
                <th>Unit</th>
                <th>Labour</th>
                <th>Description Code</th>
                <th>Manufacturer</th>
                <th>Unit</th>
                <th>Size</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($resources as $key => $resource): ?>
                <?php if ($resource['resource_type'] === 'Material'): ?>
                    <tr>
                        <td><?= $resource['material_name'] ?></td>
                        <td><?= $resource['material_name_code'] ?></td>
                        <td><?= $resource['material_group'] ?></td>
                        <td><?= $resource['material_group_code'] ?></td>
                        <td><?= $resource['description'] ?></td>
                        <td><?= $resource['description_code'] ?></td>
                        <td><?= $resource['material_manufacturer'] ?></td>
                        <td><?= $resource['unit'] ?></td>
                        <td><?= $resource['size'] ?></td>
                        <td><?= $resource['notes'] ?></td>
                        <td>
                            <?php
                            echo modal_anchor(get_uri('detailed_estimates/direct_costs_form'), '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit icon-16"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>',
                                array(
                                    "class" => "btn btn-default update-resource-btn",
                                    "title" => app_lang('edit_resource'),
                                    "data-post-id" => $resource['id']
                                )
                            );
                            ?>
                            <!-- <a href="<?= site_url('resources/delete_resource/' . $resource['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this resource?');">
                                Delete
                            </a> -->
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
