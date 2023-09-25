<div class="card">
    <div class="card-header title-tab">
        <h4 class="float-start"><?php echo app_lang('detailed_est'); ?></h4>
        <div class="title-button-group">
            <button class="btn btn-default" id="direct" onclick="showTable('Direct')">Direct Cost Analysis</button>
            <button class="btn btn-default" id="indirect" onclick="showTable('Indirect')">Indirect Cost Analysis</button>

            <?php
            echo modal_anchor(get_uri("detailed_estimates/direct_costs_form"), "<i data-feather='plus-circle' class='icon-16'></i> " . app_lang('add_est'), array("class" => "btn btn-default", "title" => app_lang('add_est')));
            ?>
        </div>
    </div>
    
</div>


<!-- <script>
    $(document).ready(function () {
        $('#analysis_table').appTable();

        $('.edit-resource-btn').click(function (e) {
            e.preventDefault();
            var analysisId = $(this).data('analysis-id');
            $.ajax({
                url: '<?= site_url('detailed_estimates/edit_est/') ?>' + analysisId,
                method: 'GET',
                dataType: 'html',
                success: function (data) {
                    $('#editModal .modal-body').html(data);
                    $('#editModal').modal('show');
                }
            });
        });
    });

    function showTable(analysisType) {
        var tableRows = document.querySelectorAll("#analysis_table tbody tr");
        
        tableRows.forEach(function(row) {
            var analysisTypeCell = row.querySelector("td:nth-child(1)");
            if (analysisTypeCell.textContent === analysisType) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    }

    function showTable(tableType) {
        const directTable = document.getElementById("directTable");
        const indirectTable = document.getElementById("indirectTable");
        
        directTable.style.display = "none";
        indirectTable.style.display = "none";
        
        if (tableType === "Direct") {
            directTable.style.display = "block";
        } else if (tableType === "Indirect") {
            indirectTable.style.display = "block";
        }
    }
</script> -->
