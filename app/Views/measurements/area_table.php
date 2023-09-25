<div class="table-responsive">
    <table id="measurement_table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Measurement Type</th>
                <th>Task Name</th>
                <th>Timesing</th>
                <th>Number of</th>
                <th>Length</th>
                <th>Breadth</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Unit</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($measurements as $key => $measurement): ?>
                <?php if ($measurement['measurement_type'] === 'Area'): ?>
                    <tr>
                        <td><?= $measurement['task_name'] ?></td>
                        <td><?= $measurement['area_timesing'] ?></td>
                        <td><?= $measurement['area_number_of'] ?></td>
                        <td><?= $measurement['area_length'] ?></td>
                        <td><?= $measurement['area_breadth'] ?></td>
                        <td><?= $measurement['area_description'] ?></td>
                        <td><?= $measurement['area_quantity'] ?></td>
                        <td><?= $measurement['area_total'] ?></td>
                        <td><?= $measurement['area_unit'] ?></td>
                        <td>
                            <?php
                            echo modal_anchor(get_uri("measurements/edit_form"), '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit icon-16"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>', 
                                array(
                                    "class" => "btn btn-default update-measurement-btn",
                                    "title" => app_lang('edit_measurement'),
                                    "data-post-id" => $measurement['id']
                                )
                            );
                            ?>
                            <!-- <a href="<?= site_url('measurements/delete_measurement/' . $measurement['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this measurement?');">
                                Delete
                            </a> -->
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
