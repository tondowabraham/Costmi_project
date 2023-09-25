<div class="table-responsive">
    <table id="resource_table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Labour Name</th>
                <th>Name Code</th>
                <th>Trade</th>
                <th>Trade Code</th>
                <th>Category</th>
                <th>Category Code</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($resources as $key => $resource): ?>
                <?php if ($resource['resource_type'] === 'Labour'): ?>
                    <tr>
                        <td><?= $resource['labour_name'] ?></td>
                        <td><?= $resource['labour_code'] ?></td>
                        <td><?= $resource['trade'] ?></td>
                        <td><?= $resource['trade_code'] ?></td>
                        <td><?= $resource['trade_category'] ?></td>
                        <td><?= $resource['trade_category_code'] ?></td>
                        <td><?= $resource['trade_status'] ?></td>
                        <td><?= $resource['notes'] ?></td>
                        <td>
                            <?php
                            echo modal_anchor(get_uri('resources/modal_form'), '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit icon-16"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>',
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