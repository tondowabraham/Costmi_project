<div class="card">
    <div class="card-header title-tab">
        <h4 class="float-start"><?php echo app_lang('prod_rates'); ?></h4>
        <div class="title-button-group">
            <?php
            echo modal_anchor(get_uri("production/modal_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_prod_rate'), array("class" => "btn btn-default", "title" => app_lang('add_prod_rate')));
            ?>
        </div>
    </div>
    
    <div class="table-responsive">
        <table id="prod_table" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Activity</th>
                    <th>Capacity</th>
                    <th>Condition</th>
                    <th>Special Condition</th>
                    <th>Output</th>
                    <th>Units/hr</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prodrates as $key => $prodrate): ?>
                    <tr>
                        <td><?= $prodrate['item'] ?></td>
                        <td><?= $prodrate['task_name'] ?></td>
                        <td><?= $prodrate['capacity'] ?></td>
                        <td><?= $prodrate['conditions'] ?></td>
                        <td><?= $prodrate['special_conditions'] ?></td>
                        <td><?= $prodrate['output'] ?></td>
                        <td><?= $prodrate['units_per_hr'] ?></td>
                        <td>
                            <?php
                            echo modal_anchor(get_uri('production/modal_form'), '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit icon-16"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>',
                                array(
                                    "class" => "btn btn-default update-prodrate-btn",
                                    "title" => app_lang('edit_prod_rate'),
                                    "data-post-id" => $prodrate['id']
                                )
                            );
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>  
</div>


<script>
    $(document).ready(function () {
        $('#prod_table').appTable();
    });
</script>
