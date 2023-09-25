<?php
if (!function_exists("make_project_tabs_data")) {

    function make_project_tabs_data($default_project_tabs = array(), $is_client = false) {
        $project_tab_order = get_setting("project_tab_order");
        $project_tab_order_of_clients = get_setting("project_tab_order_of_clients");
        $custom_project_tabs = array();

        if ($is_client && $project_tab_order_of_clients) {
            //user is client
            $custom_project_tabs = explode(',', $project_tab_order_of_clients);
        } else if (!$is_client && $project_tab_order) {
            //user is team member
            $custom_project_tabs = explode(',', $project_tab_order);
        }

        $final_projects_tabs = array();
        if ($custom_project_tabs) {
            foreach ($custom_project_tabs as $custom_project_tab) {
                if (array_key_exists($custom_project_tab, $default_project_tabs)) {
                    $final_projects_tabs[$custom_project_tab] = get_array_value($default_project_tabs, $custom_project_tab);
                }
            }
        }

        $final_projects_tabs = $final_projects_tabs ? $final_projects_tabs : $default_project_tabs;

        foreach ($final_projects_tabs as $key => $value) {
            echo "<li class='nav-item' role='presentation'><a class='nav-link' data-bs-toggle='tab' href='" . get_uri($value) . "' data-bs-target='#project-$key-section'>" . app_lang($key) . "</a></li>";
        }
    }

}
?>

<div class="page-content project-details-view clearfix">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="project-title-section">
                    <div class="page-title no-bg clearfix mb5 no-border">
                        <div>
                            <h1 class="pl0">
                                <span title="<?php echo $project_info->title_language_key ? app_lang($project_info->title_language_key) : $project_info->status_title; ?>"><i data-feather="<?php echo $project_info->status_icon; ?>" class='icon'></i></span>

                                <?php echo $project_info->title; ?>

                                <?php if (!(get_setting("disable_access_favorite_project_option_for_clients") && $login_user->user_type == "client")) { ?>
                                    <span id="star-mark">
                                        <?php
                                        if ($is_starred) {
                                            echo view('projects/star/starred', array("project_id" => $project_info->id));
                                        } else {
                                            echo view('projects/star/not_starred', array("project_id" => $project_info->id));
                                        }
                                        ?>
                                    </span>
                                <?php } ?>
                            </h1>
                        </div>

                        <div class="project-title-button-group-section">
                            <div class="title-button-group mr0" id="project-timer-box">
                                <?php echo view("projects/project_title_buttons"); ?>
                            </div>
                        </div>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-bottom: 20px;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="summary-tab" data-bs-toggle="tab" data-bs-target="#summary-tab-pane" type="button" role="tab" aria-controls="summary-tab-pane" aria-selected="true">OVERVIEW</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="resplan-tab" data-bs-toggle="tab" data-bs-target="#resplan-tab-pane" type="button" role="tab" aria-controls="resplan-tab-pane" aria-selected="false">RESOURCE PLAN</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="estimate-tab" data-bs-toggle="tab" data-bs-target="#estimate-tab-pane" type="button" role="tab" aria-controls="estimate-tab-pane" aria-selected="false">ESTIMATE</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="budget-tab" data-bs-toggle="tab" data-bs-target="#budget-tab-pane" type="button" role="tab" aria-controls="budget-tab-pane" aria-selected="false">BUDGET</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="costctrl-tab" data-bs-toggle="tab" data-bs-target="#costctrl-tab-pane" type="button" role="tab" aria-controls="costctrl-tab-pane" aria-selected="false">COST CONTROL</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reports-tab" data-bs-toggle="tab" data-bs-target="#reports-tab-pane" type="button" role="tab" aria-controls="reports-tab-pane" aria-selected="false">REPORTS</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="summary-tab-pane" role="tabpanel" aria-labelledby="summary-tab" tabindex="0">
                            <?php echo view('projects/overview_for_client'); ?>
                        </div>
                        <div class="tab-pane fade" id="resplan-tab-pane" role="tabpanel" aria-labelledby="resplan-tab" tabindex="0">
                            <div class="project-title-section">
                                <ul id="project-tabs" data-bs-toggle="ajax-tab" class="nav nav-tabs rounded classic mb20 scrollable-tabs border-white" role="tablist">
                                    <?php
                                    $project_tabs["tasks_list"] = "tasks/index/" . $project_info->id;

                                    $project_tabs["tasks_list"] = "bills/index/" . $project_info->id;

                                    $project_tabs["tasks_kanban"] = "resources/index/";

                                    $project_tabs["comments"] = "costs/index/";

                                    $project_tabs["gantt"] = "production/index/";

                                    $project_tabs["files"] = "projects/files/" . $project_info->id;

                                    $project_tabs_of_hook_of_client = array();
                                    $project_tabs_of_hook_of_client = app_hooks()->apply_filters('app_filter_clients_project_details_tab', $project_tabs_of_hook_of_client, $project_info->id);
                                    $project_tabs_of_hook_of_client = is_array($project_tabs_of_hook_of_client) ? $project_tabs_of_hook_of_client : array();
                                    $project_tabs = array_merge($project_tabs, $project_tabs_of_hook_of_client);

                                    make_project_tabs_data($project_tabs, true);
                                    ?>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade grid-button" id="project-tasks_list-section"></div>
                                <div role="tabpanel" class="tab-pane fade grid-button" id="project-tasks_kanban-section"></div>
                                <div role="tabpanel" class="tab-pane fade" id="project-comments-section"></div>
                                <div role="tabpanel" class="tab-pane fade grid-button" id="project-gantt-section"></div>
                                <div role="tabpanel" class="tab-pane fade" id="project-files-section"></div>

                                <?php
                                $project_tabs_of_hook_targets = $project_tabs_of_hook_of_client;

                                foreach ($project_tabs_of_hook_targets as $key => $value) {
                                    ?>
                                    <div role="tabpanel" class="tab-pane fade" id="project-<?php echo $key; ?>-section"></div>
                                <?php } ?>
                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="estimate-tab-pane" role="tabpanel" aria-labelledby="estimate-tab" tabindex="0">
                            <div class="project-title-section">
                                <ul id="project-tabs" data-bs-toggle="ajax-tab" class="nav nav-tabs rounded classic mb20 scrollable-tabs border-white" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class='nav-link' data-bs-toggle='tab' href="#estimate-measurement-section">Measurement</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class='nav-link' data-bs-toggle='tab' href="#estimate-detailed-section">Detailed Estimate</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class='nav-link' data-bs-toggle='tab' href="#estimate-approximate-section">Approximate Estimate</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class='nav-link' data-bs-toggle='tab' href="#estimate-schedules-section">Schedules</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class='nav-link' data-bs-toggle='tab' href="#estimate-consultancy-section">Consultancy Fees</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class='nav-link' data-bs-toggle='tab' href="#estimate-suumary-section">Summary of Bill</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="estimate-tab-content">
                                    <div role="tabpanel" class="tab-pane fade" id="estimate-measurement-section">
                                        ...
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="estimate-detailed-section">
                                        <?php echo view("detailed_estimates/index"); ?>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="estimate-approximate-section">
                                        ...
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="estimate-schedules-section">
                                        ...
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="estimate-consultancy-section">
                                        ...
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="estimate-summary-section">
                                        ...
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="budget-tab-pane" role="tabpanel" aria-labelledby="budget-tab" tabindex="0">...</div>
                        <div class="tab-pane fade" id="costctrl-tab-pane" role="tabpanel" aria-labelledby="costctrl-tab" tabindex="0">...</div>
                        <div class="tab-pane fade" id="reports-tab-pane" role="tabpanel" aria-labelledby="reports-tab" tabindex="0">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="project-footer-button-section">
    <?php echo view("projects/project_title_buttons"); ?>
</div>

<?php
//if we get any task parameter, we'll show the task details modal automatically
$preview_task_id = get_array_value($_GET, 'task');
if ($preview_task_id) {
    echo modal_anchor(get_uri("tasks/view"), "", array("id" => "preview_task_link", "title" => app_lang('task_info') . " #$preview_task_id", "data-post-id" => $preview_task_id, "data-modal-lg" => "1"));
}
?>

<?php
load_css(array(
    "assets/js/gantt-chart/frappe-gantt.css",
));
load_js(array(
    "assets/js/gantt-chart/frappe-gantt.js",
));
?>

<script type="text/javascript">
    RELOAD_PROJECT_VIEW_AFTER_UPDATE = true;

    $(document).ready(function () {
        setTimeout(function () {
            var tab = "<?php echo $tab; ?>";
            if (tab === "comment") {
                $("[data-bs-target='#project-comments-section']").trigger("click");
            } else if (tab === "customer_feedback") {
                $("[data-bs-target='#project-customer_feedback-section']").trigger("click");
            } else if (tab === "files") {
                $("[data-bs-target='#project-files-section']").trigger("click");
            } else if (tab === "gantt") {
                $("[data-bs-target='#project-gantt-section']").trigger("click");
            } else if (tab === "tasks") {
                $("[data-bs-target='#project-tasks_list-section']").trigger("click");
            } else if (tab === "tasks_kanban") {
                $("[data-bs-target='#project-tasks_kanban-section']").trigger("click");
            } else if (tab === "milestones") {
                $("[data-bs-target='#project-milestones-section']").trigger("click");
            }
        }, 210);


        //open task details modal automatically 

        if ($("#preview_task_link").length) {
            $("#preview_task_link").trigger("click");
        }

    });
</script>

<?php echo view("tasks/batch_update/batch_update_script"); ?>
<?php echo view("tasks/sub_tasks_helper_js"); ?>